<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $startOfThisMonth = Carbon::now()->startOfMonth();
        $endOfThisMonth   = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        // ---- Totals for current month ----
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startOfThisMonth, $endOfThisMonth])
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfThisMonth, $endOfThisMonth])
            ->sum('amount');

        $currentBalance = $totalIncome - $totalExpense;

        // ---- Totals for last month (for % change) ----
        $lastMonthIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');

        $lastMonthExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');

        $incomeChange  = $this->percentChange($lastMonthIncome, $totalIncome);
        $expenseChange = $this->percentChange($lastMonthExpense, $totalExpense);

        // ---- Budget for current month ----
        $budgetLimit = Budget::where('user_id', $userId)
            ->whereYear('month', $startOfThisMonth->year)
            ->whereMonth('month', $startOfThisMonth->month)
            ->sum('limit_amount');

        $budgetSpent = Budget::where('user_id', $userId)
            ->whereYear('month', $startOfThisMonth->year)
            ->whereMonth('month', $startOfThisMonth->month)
            ->sum('amount_spent');

        // Agar budgets table amount_spent update nahi ho raha, to actual expenses se le lo
        if ($budgetSpent == 0 && $totalExpense > 0) {
            $budgetSpent = $totalExpense;
        }

        $budgetRemaining  = max($budgetLimit - $budgetSpent, 0);
        $budgetPercentUsed = $budgetLimit > 0 ? round(($budgetSpent / $budgetLimit) * 100) : 0;

        // ---- Last 6 months expense trend (for chart) ----
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }

        $monthlyExpenses = $months->map(function ($month) use ($userId) {
            $sum = Transaction::where('user_id', $userId)
                ->where('type', 'expense')
                ->whereYear('transaction_date', $month->year)
                ->whereMonth('transaction_date', $month->month)
                ->sum('amount');

            return [
                'label'  => $month->format('M'),
                'amount' => (float) $sum,
            ];
        });

        $monthlyIncome = $months->map(function ($month) use ($userId) {
            $sum = Transaction::where('user_id', $userId)
                ->where('type', 'income')
                ->whereYear('transaction_date', $month->year)
                ->whereMonth('transaction_date', $month->month)
                ->sum('amount');

            return [
                'label'  => $month->format('M'),
                'amount' => (float) $sum,
            ];
        });

        // ---- Recent transactions ----
        $recentTransactions = Transaction::with('category')
            ->where('user_id', $userId)
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->take(4)
            ->get();

        return view('dashboard', [
            'totalIncome'        => $totalIncome,
            'totalExpense'       => $totalExpense,
            'currentBalance'     => $currentBalance,
            'incomeChange'       => $incomeChange,
            'expenseChange'      => $expenseChange,
            'budgetLimit'        => $budgetLimit,
            'budgetSpent'        => $budgetSpent,
            'budgetRemaining'    => $budgetRemaining,
            'budgetPercentUsed'  => $budgetPercentUsed,
            'monthlyExpenses'    => $monthlyExpenses,
            'monthlyIncome'      => $monthlyIncome,
            'recentTransactions' => $recentTransactions,
        ]);
    }

    /**
     * Percent change between two values (protects against division by zero).
     */
    private function percentChange($old, $new): float
    {
        if ($old == 0) {
            return $new > 0 ? 100 : 0;
        }

        return round((($new - $old) / $old) * 100, 1);
    }
}