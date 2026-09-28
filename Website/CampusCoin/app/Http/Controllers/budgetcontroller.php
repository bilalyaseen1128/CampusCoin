<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BudgetController extends Controller
{
    /**
     * Categories the logged-in user may use:
     * default ones (user_id = NULL) + their own custom ones.
     */
    private function availableCategories()
    {
        return Category::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', auth()->id());
            })
            ->orderBy('name');
    }

    /**
     * Value stored in the `month` column for the current month.
     * Adjust to match your column type (check with: DESCRIBE budgets;):
     * Your column is DATE, so the first day of the month is stored (e.g. 2026-09-01).
     */
    private function currentMonth()
    {
        return now()->startOfMonth()->toDateString(); // e.g. 2026-09-01
    }

    private function rules(): array
    {
        return [
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($q) {
                    $q->whereNull('user_id')->orWhere('user_id', auth()->id());
                }),
            ],
            'limit_amount' => ['required', 'numeric', 'min:0.01'],
            'amount_spent' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function index()
    {
        $categories = $this->availableCategories()->get();

        $budgets = Budget::with('category')
            ->where('user_id', auth()->id())   // remove this line if budgets has no user_id column
            ->where('month', $this->currentMonth())
            ->get();

        // Expense transactions of this month, summed per category.
        // They are deducted from each budget automatically.
        $txSpent = DB::table('transactions')
            ->where('user_id', auth()->id())   // remove if transactions has no user_id column
            ->where('type', 'expense')
            ->whereDate('transaction_date', '>=', now()->startOfMonth()->toDateString())
            ->whereDate('transaction_date', '<=', now()->endOfMonth()->toDateString())
            ->groupBy('category_id')
            ->selectRaw('category_id, SUM(amount) as total')
            ->pluck('total', 'category_id');

        $budgets->each(function ($budget) use ($txSpent) {
            $budget->setAttribute('tx_spent', (float) ($txSpent[$budget->category_id] ?? 0));
        });

        return view('budget-goal', compact('categories', 'budgets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        // One budget per category: saving again updates the limit instead of failing
        $budget = Budget::updateOrCreate(
            [
                'user_id'     => auth()->id(),  // remove if budgets has no user_id column
                'category_id' => $data['category_id'],
                'month'       => $this->currentMonth(),
            ],
            [
                'limit_amount' => $data['limit_amount'],
                'amount_spent' => $data['amount_spent'] ?? 0,
            ]
        );

        if ($request->expectsJson()) {
            return response()->json($budget->load('category'), 201);
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget saved.');
    }

    public function update(Request $request, Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);  // remove if budgets has no user_id column

        $data = $request->validate($this->rules());

        $budget->update([
            'category_id'  => $data['category_id'],
            'limit_amount' => $data['limit_amount'],
            'amount_spent' => $data['amount_spent'] ?? $budget->amount_spent,
        ]);

        if ($request->expectsJson()) {
            return response()->json($budget->load('category'));
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget updated.');
    }

    public function destroy(Request $request, Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);  // remove if budgets has no user_id column

        $budget->delete();

        if ($request->expectsJson()) {
            return response()->json(['deleted' => true]);
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget deleted.');
    }
}