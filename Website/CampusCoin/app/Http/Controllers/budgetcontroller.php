<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BudgetController extends Controller
{
    private function availableCategories()
    {
        return Category::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', auth()->id());
            })
            ->orderBy('name');
    }

    private function currentMonth()
    {
        return now()->startOfMonth()->toDateString(); // e.g. 2026-10-01
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
            ->where('user_id', auth()->id())
            ->where('month', $this->currentMonth())
            ->get();

        // Expense transactions of this month, summed per category.
        $txSpent = DB::table('transactions')
            ->where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereDate('transaction_date', '>=', now()->startOfMonth()->toDateString())
            ->whereDate('transaction_date', '<=', now()->endOfMonth()->toDateString())
            ->groupBy('category_id')
            ->selectRaw('category_id, SUM(amount) as total')
            ->pluck('total', 'category_id');

        $budgets->each(function ($budget) use ($txSpent) {
            $tx = (float) ($txSpent[$budget->category_id] ?? 0);
            $budget->setAttribute('tx_spent', $tx);
            // manual spending + transactions
            $budget->setAttribute('total_spent', (float) $budget->amount_spent + $tx);
        });

        return view('budget-goal', compact('categories', 'budgets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $budget = Budget::firstOrNew([
            'user_id'     => auth()->id(),
            'category_id' => $data['category_id'],
            'month'       => $this->currentMonth(),
        ]);

        if ($budget->exists) {
            // purana limit + naya limit
            $budget->limit_amount = (float) $budget->limit_amount + (float) $data['limit_amount'];
        } else {
            $budget->limit_amount = $data['limit_amount'];
            $budget->amount_spent = 0;
        }

        $budget->save();

        if ($request->expectsJson()) {
            return response()->json($budget->load('category'), 201);
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget added.');
    }

    public function update(Request $request, Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);

        $data = $request->validate($this->rules());

        $exists = Budget::where('user_id', auth()->id())
            ->where('category_id', $data['category_id'])
            ->where('month', $budget->month)
            ->where('id', '!=', $budget->id)
            ->exists();

        if ($exists) {
            $message = 'This category already has a budget this month.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 422);
            }

            return back()->withErrors(['category_id' => $message]);
        }

        try {
            $budget->update([
                'category_id'  => $data['category_id'],
                'limit_amount' => $data['limit_amount'],
                'amount_spent' => $data['amount_spent'] ?? $budget->amount_spent,
            ]);
        } catch (QueryException $e) {
            $message = 'This category already has a budget this month.';

            return $request->expectsJson()
                ? response()->json(['message' => $message], 422)
                : back()->withErrors(['category_id' => $message]);
        }

        if ($request->expectsJson()) {
            return response()->json($budget->load('category'));
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget updated.');
    }

    public function destroy(Request $request, Budget $budget)
    {
        abort_if($budget->user_id !== auth()->id(), 403);

        $budget->delete();

        if ($request->expectsJson()) {
            return response()->json(['deleted' => true]);
        }

        return redirect()->route('budgets.goal')->with('success', 'Budget deleted.');
    }
}