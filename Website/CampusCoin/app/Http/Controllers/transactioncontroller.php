<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\TransactionHistory;

class TransactionController extends Controller
{
    // Show transactions
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', Auth::id())
            ->with('category');

        // Filter by type
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by starting date
        if ($request->date_from) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $request->date_from
            );
        }

        // Filter by ending date
        if ($request->date_to) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $request->date_to
            );
        }

        // Get transactions
        $transactions = $query
            ->orderBy('transaction_date', 'desc')
            ->get();

        // Current month transactions
        $monthTransactions = Transaction::where(
            'user_id',
            Auth::id()
        )
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->get();

        // Total income
        $income = $monthTransactions
            ->where('type', 'income')
            ->sum('amount');

        // Total expense
        $expense = $monthTransactions
            ->where('type', 'expense')
            ->sum('amount');

        // Balance
        $balance = $income - $expense;

        // Expense ratio
        $expenseRatio = $income > 0
            ? ($expense / $income) * 100
            : 0;

        // User categories + default categories
        $categories = Category::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhere('is_default', 1);
        })
            ->orderBy('name')
            ->get();

        return view('income-expense', compact(
            'transactions',
            'categories',
            'income',
            'expense',
            'balance',
            'expenseRatio'
        ));
    }


    // Add new transaction
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Save transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
        ]);

        // Save transaction history
        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'description' => $transaction->description,
            'category_id' => $transaction->category_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'transaction_date' => $transaction->transaction_date,
            'action' => 'created',
            'old_values' => null,
            'new_values' => $transaction->toArray(),
            'created_at' => now(),
        ]);

        return redirect()
            ->route('income.expense')
            ->with('success', 'Transaction added successfully.');
    }


    // Show edit form
    public function edit($id)
    {
        $transaction = Transaction::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        $categories = Category::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhere('is_default', 1);
        })
            ->orderBy('name')
            ->get();

        return view('transaction-edit', compact(
            'transaction',
            'categories'
        ));
    }


    // Update transaction
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Find user's transaction
        $transaction = Transaction::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        // Save old values before update
        $oldValues = $transaction->toArray();

        // Update transaction
        $transaction->update([
            'category_id' => $request->category_id,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
        ]);

        // Save edit history
        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'description' => $transaction->description,
            'category_id' => $transaction->category_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'transaction_date' => $transaction->transaction_date,
            'action' => 'updated',
            'old_values' => $oldValues,
            'new_values' => $transaction->toArray(),
            'created_at' => now(),
        ]);

        return redirect()
            ->route('income.expense')
            ->with('success', 'Transaction updated successfully.');
    }


    // Delete transaction
    public function destroy($id)
    {
        $transaction = Transaction::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        // Save deletion in history
        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'description' => $transaction->description,
            'category_id' => $transaction->category_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'transaction_date' => $transaction->transaction_date,
            'action' => 'deleted',
            'old_values' => $transaction->toArray(),
            'new_values' => null,
            'created_at' => now(),
        ]);

        // Delete transaction
        $transaction->delete();

        return redirect()
            ->route('income.expense')
            ->with('success', 'Transaction deleted successfully.');
    }
}