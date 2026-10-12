<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Budget;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::where(function ($q) {
            $q->where('user_id', Auth::id())
                ->orWhere('is_default', 1);
        });

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->get();

        $totalCategories = $categories->count();

        $incomeCount = $categories->where('type', 'income')->count();

        $expenseCount = $categories->where('type', 'expense')->count();

        $customCount = $categories->where('is_default', 0)->count();

        return view('categories', compact(
            'categories',
            'totalCategories',
            'incomeCount',
            'expenseCount',
            'customCount'
        ));
    }

    /**
     * Validation rules shared by store() and update().
     *
     * The name must be unique per type among the categories this user can
     * see: their own AND the shared defaults. That matches the DB unique
     * index (user_id + type + name) and also stops a user from creating a
     * twin of a default category, which would show up twice in their list.
     */
    private function categoryRules(Request $request, ?int $ignoreId = null): array
    {
        $unique = Rule::unique('categories', 'name')
            ->where(function ($q) use ($request) {
                $q->where('type', $request->input('type'))
                    ->where(function ($q) {
                        $q->where('user_id', Auth::id())
                            ->orWhere('is_default', 1);
                    });
            });

        if ($ignoreId) {
            $unique->ignore($ignoreId);
        }

        return [
            'name' => ['required', 'string', 'max:255', $unique],
            'type' => ['required', 'in:income,expense'],
            'budget_class' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function categoryMessages(Request $request): array
    {
        return [
            'name.unique' => 'You already have ' . ($request->input('type') === 'income' ? 'an income' : 'an expense')
                . ' category named "' . $request->input('name') . '".',
        ];
    }

    public function store(Request $request)
    {
        // Trim first so "Freelancing " can't slip past the uniqueness check.
        $request->merge(['name' => trim((string) $request->input('name'))]);

        $validated = $request->validate(
            $this->categoryRules($request),
            $this->categoryMessages($request)
        );

        Category::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'budget_class' => $validated['budget_class'] ?? null,
            'is_default' => 0,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully.');
    }

    /**
     * Categories a user is allowed to edit/delete: their own, OR
     * legacy rows left with a NULL user_id by the old store() bug.
     * True shared defaults (is_default = 1) are excluded — nobody
     * edits/deletes those from this page.
     */
    private function editableCategoryQuery()
    {
        return Category::where('is_default', 0)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                    ->orWhereNull('user_id');
            });
    }

    public function edit($id)
    {
        $category = $this->editableCategoryQuery()->findOrFail($id);

        return view('category-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->editableCategoryQuery()->findOrFail($id);

        $request->merge(['name' => trim((string) $request->input('name'))]);

        $validated = $request->validate(
            $this->categoryRules($request, $category->id),
            $this->categoryMessages($request)
        );

        // Claim ownership of legacy (NULL user_id) rows as they get touched.
        $category->update([
            'user_id' => $category->user_id ?? Auth::id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'budget_class' => $validated['budget_class'] ?? null,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = $this->editableCategoryQuery()->findOrFail($id);

        // Category ke saath uske budgets bhi hatao, warna budget-goal page
        // par "Attempt to read property name on null" error aata hai.
        // Dono kaam ek saath hon (ya dono na hon) is liye transaction.
        DB::transaction(function () use ($category) {
            Budget::where('category_id', $category->id)->delete();

            $category->delete();
        });

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category and its budgets deleted successfully.');
    }
}