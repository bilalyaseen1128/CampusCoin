<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        // ---- This month's income / expenses ----
        $monthlyIncome = (float) Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$monthStart, $monthEnd])
            ->sum('amount');

        $monthlyExpense = (float) Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$monthStart, $monthEnd])
            ->sum('amount');

        // ---- Essential (need) vs Flexible (want) expenses, via categories.budget_class ----
        $essentialExpense = (float) Transaction::query()
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.user_id', $userId)
            ->where('transactions.type', 'expense')
            ->where('categories.budget_class', 'need')
            ->whereBetween('transactions.transaction_date', [$monthStart, $monthEnd])
            ->sum('transactions.amount');

        $flexibleExpense = (float) Transaction::query()
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.user_id', $userId)
            ->where('transactions.type', 'expense')
            ->where('categories.budget_class', 'want')
            ->whereBetween('transactions.transaction_date', [$monthStart, $monthEnd])
            ->sum('transactions.amount');

        $monthlySavings = $monthlyIncome - $monthlyExpense;
        $savingsRate = $monthlyIncome > 0
            ? round(($monthlySavings / $monthlyIncome) * 100, 1)
            : 0;

        $monthlyReport = [
            'title' => 'Monthly Financial Report — ' . Carbon::now()->format('F Y'),
            'rows' => [
                ['Income', $this->money($monthlyIncome)],
                ['Total Expenses', $this->money($monthlyExpense)],
                ['Total Savings', $this->money($monthlySavings)],
                ['Essential Expenses', $this->money($essentialExpense)],
                ['Flexible Expenses', $this->money($flexibleExpense)],
                ['Savings Rate', $savingsRate . '%'],
            ],
        ];

        // ---- Savings Summary, using the user's real monthly_savings_goal ----
        $goal = (float) $user->monthly_savings_goal;
        $progress = $goal > 0
            ? round(($monthlySavings / $goal) * 100, 1)
            : 0;
        $remaining = $goal - $monthlySavings;

        $savingsSummary = [
            'title' => 'Savings Summary — ' . Carbon::now()->format('F Y'),
            'rows' => [
                ['Saved This Month', $this->money($monthlySavings)],
                ['Monthly Savings Goal', $this->money($goal)],
                ['Progress', $progress . '%'],
                ['Remaining to Goal', $this->money(max($remaining, 0))],
            ],
        ];

        return response()->json([
            'monthly' => $monthlyReport,
            'savings' => $savingsSummary,
        ]);
    }

    private function money(float $value): string
    {
        return '₨' . number_format($value, 2);
    }
}