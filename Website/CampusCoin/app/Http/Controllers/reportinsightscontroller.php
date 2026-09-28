<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportInsightsController extends Controller
{
    /**
     * Full-month report. Use /report-insights?month=2026-09 to pick a month.
     * Without ?month it shows the current month.
     */
    public function index(Request $request)
    {
        $reportMonth = $this->resolveMonth($request->query('month'));
        $start = $reportMonth->copy()->startOfMonth();
        $end   = $reportMonth->copy()->endOfMonth();

        $prevStart = $start->copy()->subMonthNoOverflow()->startOfMonth();
        $prevEnd   = $prevStart->copy()->endOfMonth();

        /* ---------- Totals for the month ---------- */
        $current  = $this->totals($start, $end);
        $previous = $this->totals($prevStart, $prevEnd);

        $totalIncome   = (float) $current->income;
        $totalExpenses = (float) $current->expense;
        $netBalance    = $totalIncome - $totalExpenses;
        $savingsRate   = $totalIncome > 0
            ? round(($netBalance / $totalIncome) * 100, 1)
            : 0;

        $expenseChange = $previous->expense > 0
            ? round((($totalExpenses - $previous->expense) / $previous->expense) * 100)
            : null;

        $incomeChange = $previous->income > 0
            ? round((($totalIncome - $previous->income) / $previous->income) * 100)
            : null;

        /* ---------- Expenses per category (whole month) ---------- */
        $categoryTotals = $this->baseQuery($start, $end)
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.type', 'expense')
            ->groupBy('categories.id', 'categories.name')
            ->selectRaw('categories.id as category_id, categories.name as category_name, SUM(transactions.amount) as total')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) use ($totalExpenses) {
                $row->total = (float) $row->total;
                $row->share = $totalExpenses > 0
                    ? round(($row->total / $totalExpenses) * 100)
                    : 0;
                return $row;
            });

        $topCategories = $categoryTotals->take(5);

        /* ---------- Daily spending, day 1 to last day of month ---------- */
        $dailyRaw = $this->baseQuery($start, $end)
            ->where('transactions.type', 'expense')
            ->groupBy(DB::raw('DATE(transactions.transaction_date)'))
            ->selectRaw('DATE(transactions.transaction_date) as d, SUM(transactions.amount) as total')
            ->pluck('total', 'd');

        $dailyChart = [];
        $maxDaily = max(1, (float) ($dailyRaw->max() ?? 0));

        for ($day = 1; $day <= $start->daysInMonth; $day++) {
            $date  = $start->copy()->day($day);
            $total = (float) ($dailyRaw[$date->toDateString()] ?? 0);

            $dailyChart[] = [
                'day'    => $day,
                'label'  => ($day === 1 || $day % 5 === 0) ? (string) $day : '',
                'total'  => $total,
                'height' => round(($total / $maxDaily) * 100),
            ];
        }

        $highestDay = collect($dailyChart)->sortByDesc('total')->first();
        $highestDay = ($highestDay && $highestDay['total'] > 0) ? $highestDay : null;

        // Average over the days that have passed (all days for a finished month)
        $daysCounted = $start->isSameMonth(now())
            ? max(1, now()->day)
            : $start->daysInMonth;

        $avgDaily = $totalExpenses / $daysCounted;

        /* ---------- Budgets vs actual spending for this month ---------- */
        $budgetReport = Budget::with('category')
            ->where('user_id', auth()->id())
            ->where('month', $start->toDateString())
            ->get()
            ->map(function ($budget) use ($categoryTotals) {
                $limit = (float) $budget->limit_amount;
                $spent = (float) optional($categoryTotals->firstWhere('category_id', $budget->category_id))->total;
                $usage = $limit > 0 ? round(($spent / $limit) * 100) : 0;

                return (object) [
                    'name'      => optional($budget->category)->name ?? 'Category',
                    'limit'     => $limit,
                    'spent'     => $spent,
                    'remaining' => $limit - $spent,
                    'usage'     => $usage,
                    'status'    => $usage >= 100 ? 'exceeded' : ($usage >= 80 ? 'warning' : 'ok'),
                ];
            });

        /* ---------- Last 6 months overview (ending on selected month) ---------- */
        $sixStart = $start->copy()->subMonthsNoOverflow(5)->startOfMonth();

        $monthlyRaw = $this->baseQuery($sixStart, $end)
            ->where('transactions.type', 'expense')
            ->groupBy(DB::raw("DATE_FORMAT(transactions.transaction_date, '%Y-%m')"))
            ->selectRaw("DATE_FORMAT(transactions.transaction_date, '%Y-%m') as ym, SUM(transactions.amount) as total")
            ->pluck('total', 'ym');

        $maxMonthly = max(1, (float) ($monthlyRaw->max() ?? 0));
        $monthlyChart = [];

        for ($i = 5; $i >= 0; $i--) {
            $m     = $start->copy()->subMonthsNoOverflow($i);
            $total = (float) ($monthlyRaw[$m->format('Y-m')] ?? 0);

            $monthlyChart[] = [
                'label'  => $m->format('M'),
                'total'  => $total,
                'height' => round(($total / $maxMonthly) * 100),
            ];
        }

        return view('reports-insights', [
            'reportMonth'   => $start,
            'prevMonth'     => $start->copy()->subMonthNoOverflow()->format('Y-m'),
            'nextMonth'     => $start->copy()->addMonthNoOverflow()->format('Y-m'),
            'hasNextMonth'  => $start->copy()->addMonthNoOverflow()->lte(now()->startOfMonth()),
            'totalIncome'   => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'netBalance'    => $netBalance,
            'savingsRate'   => $savingsRate,
            'expenseChange' => $expenseChange,
            'incomeChange'  => $incomeChange,
            'txCount'       => (int) $current->tx,
            'avgDaily'      => $avgDaily,
            'highestDay'    => $highestDay,
            'topCategories' => $topCategories,
            'dailyChart'    => $dailyChart,
            'budgetReport'  => $budgetReport,
            'monthlyChart'  => $monthlyChart,
        ]);
    }

    /* ================= helpers ================= */

    private function resolveMonth(?string $value): Carbon
    {
        try {
            if ($value) {
                return Carbon::createFromFormat('!Y-m', $value)->startOfMonth();
            }
        } catch (\Throwable $e) {
            // fall through to current month
        }

        return now()->startOfMonth();
    }

    /** Transactions of the logged-in user between two dates (inclusive). */
    private function baseQuery(Carbon $from, Carbon $to)
    {
        return DB::table('transactions')
            ->where('transactions.user_id', auth()->id())   // remove if transactions has no user_id column
            ->whereDate('transactions.transaction_date', '>=', $from->toDateString())
            ->whereDate('transactions.transaction_date', '<=', $to->toDateString());
    }

    private function totals(Carbon $from, Carbon $to)
    {
        $row = $this->baseQuery($from, $to)
            ->selectRaw("
                COALESCE(SUM(CASE WHEN transactions.type = 'income'  THEN transactions.amount END), 0) as income,
                COALESCE(SUM(CASE WHEN transactions.type = 'expense' THEN transactions.amount END), 0) as expense,
                COUNT(*) as tx
            ")
            ->first();

        $row->income  = (float) $row->income;
        $row->expense = (float) $row->expense;

        return $row;
    }
}