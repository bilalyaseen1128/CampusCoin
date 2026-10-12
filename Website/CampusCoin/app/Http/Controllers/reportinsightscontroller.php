<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportInsightsController extends Controller
{
    /** Daily bars sirf itne dino tak dikhate hain (us se zyada par sirf weekly). */
    private const MAX_DAILY_DAYS = 62;

    /** Date range ki had (din). */
    private const MAX_RANGE_DAYS = 366;

    /** Active category / income-source filters (baseQuery inhe use karta hai). */
    private array $filters = ['category_id' => null, 'income_source' => null];

    /**
     * Report page.
     *   /report-insights?month=2026-09                      -> ek mahina
     *   /report-insights?date_from=2026-09-01&date_to=...   -> custom date range
     *   &category_id=3        -> sirf ek category
     *   &income_source=7      -> income sirf is source (income category) se
     */
    public function index(Request $request)
    {
        $userId = auth()->id();

        /* ---------- Filter options (user ki apni + default categories) ---------- */
        $filterCategories = Category::where(function ($q) use ($userId) {
                $q->where('user_id', $userId)->orWhere('is_default', 1);
            })
            ->orderBy('name')
            ->get();

        $categoryId = $this->validId($request->query('category_id'), $filterCategories);
        $sourceId   = $this->validId($request->query('income_source'), $filterCategories->where('type', 'income'));

        $this->filters = ['category_id' => $categoryId, 'income_source' => $sourceId];

        /* ---------- Period: custom range ya mahina ---------- */
        $from = $this->parseDate($request->query('date_from'));
        $to   = $this->parseDate($request->query('date_to'));

        $rangeMode = (bool) ($from || $to);

        if ($rangeMode) {
            $to   = $to ?? now()->startOfDay();
            $from = $from ?? $to->copy()->startOfMonth();

            if ($from->gt($to)) {
                [$from, $to] = [$to, $from];
            }

            if ($this->daysBetween($from, $to) > self::MAX_RANGE_DAYS) {
                $from = $to->copy()->subDays(self::MAX_RANGE_DAYS - 1);
            }

            $start       = $from->copy()->startOfDay();
            $end         = $to->copy()->endOfDay();
            $reportMonth = null;
        } else {
            $reportMonth = $this->resolveMonth($request->query('month'));
            $start       = $reportMonth->copy()->startOfMonth();
            $end         = $reportMonth->copy()->endOfMonth();
        }

        $days = $this->daysBetween($start, $end);

        // Pichla period (comparison ke liye)
        if ($rangeMode) {
            $prevEnd      = $start->copy()->subDay()->endOfDay();
            $prevStart    = $prevEnd->copy()->subDays($days - 1)->startOfDay();
            $compareLabel = 'vs previous period';
        } else {
            $prevStart    = $start->copy()->subMonthNoOverflow()->startOfMonth();
            $prevEnd      = $prevStart->copy()->endOfMonth();
            $compareLabel = 'vs last month';
        }

        /* ---------- Totals ---------- */
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

        /* ---------- Category-wise (expense + income) ---------- */
        $expenseCategories = $this->categoryBreakdown($start, $end, 'expense', $totalExpenses);
        $incomeCategories  = $this->categoryBreakdown($start, $end, 'income', $totalIncome);

        /* ---------- Daily + weekly breakdown ---------- */
        $dailyRows = $this->baseQuery($start, $end)
            ->groupBy(DB::raw('DATE(transactions.transaction_date)'))
            ->selectRaw("
                DATE(transactions.transaction_date) as d,
                SUM(CASE WHEN transactions.type = 'income'  THEN transactions.amount ELSE 0 END) as income,
                SUM(CASE WHEN transactions.type = 'expense' THEN transactions.amount ELSE 0 END) as expense
            ")
            ->get()
            ->keyBy('d');

        $showDaily  = $days <= self::MAX_DAILY_DAYS;
        $multiMonth = $start->format('Y-m') !== $end->format('Y-m');
        $lastDate   = Carbon::parse($end->toDateString());

        $dailyChart  = [];
        $weeklyChart = [];
        $cursor      = Carbon::parse($start->toDateString());

        for ($i = 0; $i < $days; $i++) {
            $row     = $dailyRows->get($cursor->toDateString());
            $income  = $row ? (float) $row->income : 0.0;
            $expense = $row ? (float) $row->expense : 0.0;

            if ($showDaily) {
                $dailyChart[] = [
                    'label'   => $cursor->format($multiMonth ? 'j/n' : 'j'),
                    'full'    => $cursor->format('j M'),
                    'income'  => $income,
                    'expense' => $expense,
                ];
            }

            // Har 7 din ka ek bucket (period ke pehle din se)
            $w = intdiv($i, 7);

            if (! isset($weeklyChart[$w])) {
                $ws = $cursor->copy();
                $we = $cursor->copy()->addDays(6);

                if ($we->gt($lastDate)) {
                    $we = $lastDate->copy();
                }

                $label = $ws->format('Y-m') === $we->format('Y-m')
                    ? $ws->format('j') . '–' . $we->format('j M')
                    : $ws->format('j M') . '–' . $we->format('j M');

                $weeklyChart[$w] = ['label' => $label, 'full' => $label, 'income' => 0.0, 'expense' => 0.0];
            }

            $weeklyChart[$w]['income']  += $income;
            $weeklyChart[$w]['expense'] += $expense;

            $cursor->addDay();
        }

        $weeklyChart = array_values($weeklyChart);

        // Highest spending day
        $topRow     = $dailyRows->sortByDesc(fn ($r) => (float) $r->expense)->first();
        $highestDay = ($topRow && (float) $topRow->expense > 0)
            ? ['label' => Carbon::parse($topRow->d)->format('j M'), 'total' => (float) $topRow->expense]
            : null;

        // Average daily spend (sirf guzre hue dino se)
        $lastCounted   = $end->lt(now()) ? $end : now();
        $daysCounted   = $start->gt(now()) ? 1 : max(1, $this->daysBetween($start, $lastCounted));
        $avgDailySpend = $totalExpenses / $daysCounted;

        /* ---------- Budgets vs actual ----------
         * "Spent" budgets.amount_spent se aata hai, taake Budgets page se match kare.
         */
        $budgetQuery = Budget::with('category')
            ->where('user_id', $userId)
            ->whereBetween('month', [
                $start->copy()->startOfMonth()->toDateString(),
                $end->copy()->startOfMonth()->toDateString(),
            ])
            ->orderBy('month');

        if ($categoryId) {
            $budgetQuery->where('category_id', $categoryId);
        }

        $budgetReport = $budgetQuery->get()->map(function ($budget) use ($multiMonth) {
            $limit = (float) $budget->limit_amount;
            $spent = (float) $budget->amount_spent;
            $usage = $limit > 0 ? round(($spent / $limit) * 100) : 0;

            $name = optional($budget->category)->name ?? 'Category';

            if ($multiMonth) {
                $name .= ' (' . Carbon::parse($budget->month)->format('M Y') . ')';
            }

            return (object) [
                'name'      => $name,
                'limit'     => $limit,
                'spent'     => $spent,
                'remaining' => $limit - $spent,
                'usage'     => $usage,
                'status'    => $usage >= 100 ? 'exceeded' : ($usage >= 80 ? 'warning' : 'ok'),
            ];
        });

        /* ---------- Last 6 months: income vs expense (period ke aakhri mahine tak) ---------- */
        $anchor   = $end->copy()->startOfMonth();
        $sixStart = $anchor->copy()->subMonthsNoOverflow(5)->startOfMonth();

        $monthlyRaw = $this->baseQuery($sixStart, $anchor->copy()->endOfMonth())
            ->groupBy(DB::raw("DATE_FORMAT(transactions.transaction_date, '%Y-%m')"))
            ->selectRaw("
                DATE_FORMAT(transactions.transaction_date, '%Y-%m') as ym,
                SUM(CASE WHEN transactions.type = 'income'  THEN transactions.amount ELSE 0 END) as income,
                SUM(CASE WHEN transactions.type = 'expense' THEN transactions.amount ELSE 0 END) as expense
            ")
            ->get()
            ->keyBy('ym');

        $monthlyChart = [];

        for ($i = 5; $i >= 0; $i--) {
            $m   = $anchor->copy()->subMonthsNoOverflow($i);
            $row = $monthlyRaw->get($m->format('Y-m'));

            $monthlyChart[] = [
                'label'   => $m->format('M'),
                'income'  => $row ? (float) $row->income : 0.0,
                'expense' => $row ? (float) $row->expense : 0.0,
            ];
        }

        /* ---------- Active filters ka text (heading + print ke liye) ---------- */
        $activeFilters = [];

        if ($rangeMode) {
            $activeFilters[] = 'Dates: ' . $start->format('j M Y') . ' – ' . $end->format('j M Y');
        }
        if ($categoryId) {
            $activeFilters[] = 'Category: ' . $filterCategories->firstWhere('id', $categoryId)->name;
        }
        if ($sourceId) {
            $activeFilters[] = 'Income source: ' . $filterCategories->firstWhere('id', $sourceId)->name;
        }

        $monthMode = ! $rangeMode;

        return view('reports-insights', [
            'rangeMode'         => $rangeMode,
            'periodLabel'       => $rangeMode
                ? $start->format('j M Y') . ' – ' . $end->format('j M Y')
                : $start->format('F Y'),
            'periodSub'         => $start->format('j M Y') . ' to ' . $end->format('j M Y'),
            'monthValue'        => $monthMode ? $start->format('Y-m') : '',
            'prevMonth'         => $monthMode ? $start->copy()->subMonthNoOverflow()->format('Y-m') : null,
            'nextMonth'         => $monthMode ? $start->copy()->addMonthNoOverflow()->format('Y-m') : null,
            'hasNextMonth'      => $monthMode && $start->copy()->addMonthNoOverflow()->lte(now()->startOfMonth()),
            'keepFilters'       => array_filter(['category_id' => $categoryId, 'income_source' => $sourceId]),
            'filterCategories'  => $filterCategories,
            'incomeSources'     => $filterCategories->where('type', 'income')->values(),
            'selectedCategory'  => $categoryId,
            'selectedSource'    => $sourceId,
            'dateFrom'          => $rangeMode ? $start->toDateString() : '',
            'dateTo'            => $rangeMode ? $end->toDateString() : '',
            'activeFilters'     => $activeFilters,
            'compareLabel'      => $compareLabel,
            'totalIncome'       => $totalIncome,
            'totalExpenses'     => $totalExpenses,
            'netBalance'        => $netBalance,
            'savingsRate'       => $savingsRate,
            'expenseChange'     => $expenseChange,
            'incomeChange'      => $incomeChange,
            'txCount'           => (int) $current->tx,
            'highestDay'        => $highestDay,
            'avgDailySpend'     => $avgDailySpend,
            'expenseCategories' => $expenseCategories,
            'incomeCategories'  => $incomeCategories,
            'budgetReport'      => $budgetReport,
            'monthlyChart'      => $this->scale($monthlyChart),
            'dailyChart'        => $this->scale($dailyChart),
            'weeklyChart'       => $this->scale($weeklyChart),
            'showDaily'         => $showDaily,
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

    private function parseDate(?string $value): ?Carbon
    {
        if (! $value) {
            return null;
        }

        try {
            return Carbon::createFromFormat('!Y-m-d', $value)->startOfDay();
        } catch (\Throwable $e) {
            return null;
        }
    }

    /** URL se aayi id sirf tab maano jab woh allowed list mein ho. */
    private function validId($value, $allowed): ?int
    {
        if (! is_numeric($value)) {
            return null;
        }

        $id = (int) $value;

        return $allowed->contains('id', $id) ? $id : null;
    }

    /** Dono tareekhon samet kitne din (inclusive). */
    private function daysBetween(Carbon $a, Carbon $b): int
    {
        $x = Carbon::parse($a->toDateString());
        $y = Carbon::parse($b->toDateString());

        return (int) abs($x->diffInDays($y)) + 1;
    }

    /**
     * Transactions of the logged-in user between two dates (inclusive),
     * soft-deleted rows excluded, aur active filters lage hue.
     */
    private function baseQuery(Carbon $from, Carbon $to)
    {
        $query = DB::table('transactions')
            ->where('transactions.user_id', auth()->id())
            ->whereNull('transactions.deleted_at')   // DB::table() does not apply soft deletes automatically
            ->whereDate('transactions.transaction_date', '>=', $from->toDateString())
            ->whereDate('transactions.transaction_date', '<=', $to->toDateString());

        // Category filter: sab rows par
        if ($this->filters['category_id']) {
            $query->where('transactions.category_id', $this->filters['category_id']);
        }

        // Income source filter: sirf income wali rows ko mehdood karta hai, expenses waise hi
        if ($this->filters['income_source']) {
            $source = $this->filters['income_source'];

            $query->where(function ($q) use ($source) {
                $q->where('transactions.type', '!=', 'income')
                  ->orWhere('transactions.category_id', $source);
            });
        }

        return $query;
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

    /** Category totals for one type (income / expense) with each category's share of the grand total. */
    private function categoryBreakdown(Carbon $from, Carbon $to, string $type, float $grand)
    {
        return $this->baseQuery($from, $to)
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.type', $type)
            ->groupBy('categories.id', 'categories.name')
            ->selectRaw('categories.id as category_id, categories.name as category_name, SUM(transactions.amount) as total')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) use ($grand) {
                $row->total = (float) $row->total;
                $row->share = $grand > 0 ? round(($row->total / $grand) * 100) : 0;

                return $row;
            });
    }

    /** Adds income_h / expense_h (bar heights in %) relative to the biggest value in the list. */
    private function scale(array $rows): array
    {
        $max = 1;

        foreach ($rows as $r) {
            $max = max($max, $r['income'], $r['expense']);
        }

        foreach ($rows as &$r) {
            $r['income_h']  = $r['income'] > 0 ? max(round(($r['income'] / $max) * 100), 3) : 0;
            $r['expense_h'] = $r['expense'] > 0 ? max(round(($r['expense'] / $max) * 100), 3) : 0;
        }
        unset($r);

        return $rows;
    }
}