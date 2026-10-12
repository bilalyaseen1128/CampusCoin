<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Services\RecurringTransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(private RecurringTransactionService $recurring)
    {
    }

    public function index()
    {
        $userId = Auth::id();

        // Jin recurring rules ka waqt aa gaya, unki transactions pehle bana do
        $this->recurring->generateDue($userId);

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

        $budgetRemaining   = max($budgetLimit - $budgetSpent, 0);
        $budgetPercentUsed = $budgetLimit > 0 ? round(($budgetSpent / $budgetLimit) * 100) : 0;

        // ---- Last 6 months trend (for chart) ----
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

        // ---- Top spending categories (this month) ----
        $topCategories = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startOfThisMonth, $endOfThisMonth])
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->with('category')
            ->take(3)
            ->get()
            ->map(function ($row) use ($totalExpense) {
                return [
                    'name'    => $row->category->name ?? 'Uncategorized',
                    'total'   => (float) $row->total,
                    'percent' => $totalExpense > 0 ? round(($row->total / $totalExpense) * 100) : 0,
                ];
            });

        // ---- Quick add: categories + sab se zyada use hone wali ----
        $categories = Category::where(function ($q) use ($userId) {
                $q->where('user_id', $userId)->orWhere('is_default', 1);
            })
            ->orderBy('name')
            ->get();

        $usedIds = Transaction::where('user_id', $userId)
            ->whereNotNull('category_id')
            ->select('category_id', DB::raw('COUNT(*) as uses'))
            ->groupBy('category_id')
            ->orderByDesc('uses')
            ->take(4)
            ->pluck('category_id');

        $quickCategories = $usedIds
            ->map(fn ($id) => $categories->firstWhere('id', $id))
            ->filter()
            ->values();

        if ($quickCategories->count() < 4) {
            $fill = $categories
                ->where('type', 'expense')
                ->whereNotIn('id', $quickCategories->pluck('id'))
                ->take(4 - $quickCategories->count());

            $quickCategories = $quickCategories->concat($fill)->values();
        }

        // ---- Smart tips ----
        $tips = $this->buildTips(
            $totalIncome,
            $totalExpense,
            $expenseChange,
            $budgetLimit,
            $budgetPercentUsed,
            $topCategories,
            $recentTransactions->isEmpty()
        );

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
            'topCategories'      => $topCategories,
            'categories'         => $categories,
            'quickCategories'    => $quickCategories,
            'tips'               => $tips,
        ]);
    }

    /**
     * User ke apne numbers se 3 tak tips banata hai.
     * Har tip: type (warning / success / info), icon, text.
     */
    private function buildTips($income, $expense, $expenseChange, $budgetLimit, $budgetPercent, $topCategories, bool $noTransactions): array
    {
        $tips = [];

        if ($noTransactions) {
            return [[
                'type' => 'info',
                'icon' => 'fa-circle-plus',
                'text' => 'Add your first income or expense to start getting personal tips.',
            ]];
        }

        if ($income > 0 && $expense > $income) {
            $tips[] = [
                'type' => 'warning',
                'icon' => 'fa-triangle-exclamation',
                'text' => 'You have spent ₨' . number_format($expense - $income, 0) . ' more than you earned this month. Try cutting one non-essential expense.',
            ];
        }

        if ($budgetLimit > 0 && $budgetPercent >= 100) {
            $tips[] = [
                'type' => 'warning',
                'icon' => 'fa-bullseye',
                'text' => 'You have reached your monthly budget limit. Avoid new spending until next month.',
            ];
        } elseif ($budgetLimit > 0 && $budgetPercent >= 80) {
            $tips[] = [
                'type' => 'warning',
                'icon' => 'fa-bullseye',
                'text' => "{$budgetPercent}% of your budget is used. Slow down to stay within your limit.",
            ];
        } elseif ($budgetLimit == 0) {
            $tips[] = [
                'type' => 'info',
                'icon' => 'fa-bullseye',
                'text' => 'No budget set for this month. Set a limit in Budget Goals to track your spending.',
            ];
        }

        $top = $topCategories->first();
        if ($top && $top['percent'] >= 40) {
            $tips[] = [
                'type' => 'info',
                'icon' => 'fa-chart-pie',
                'text' => "{$top['name']} takes {$top['percent']}% of your spending. Small cuts here save the most.",
            ];
        }

        if ($expenseChange >= 20 && $expense > 0) {
            $tips[] = [
                'type' => 'warning',
                'icon' => 'fa-arrow-trend-up',
                'text' => 'Your spending is up ' . $expenseChange . '% compared to last month.',
            ];
        }

        if ($income > 0 && $expense <= $income) {
            $saved = round((($income - $expense) / $income) * 100);

            if ($saved >= 20) {
                $tips[] = [
                    'type' => 'success',
                    'icon' => 'fa-piggy-bank',
                    'text' => "Great job! You are saving {$saved}% of your income this month.",
                ];
            }
        }

        if (empty($tips)) {
            $tips[] = [
                'type' => 'success',
                'icon' => 'fa-circle-check',
                'text' => 'You are on track this month. Keep recording every expense.',
            ];
        }

        return array_slice($tips, 0, 3);
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