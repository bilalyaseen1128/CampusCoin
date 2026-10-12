<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reports & Insights | CampusCoin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Shared navbar styles (same file used across the site) -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<style>

        :root {
            --bg: #eef2fb;
            --card-bg: #ffffff;
            --text: #101828;
            --text-muted: #667085;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #e8effe;
            --border: #e6eaf3;
            --shadow: rgba(20, 35, 80, .10);
            --overlay-1: #1d4ed8;
            --overlay-2: #0b1330;
            --success: #16a34a;
            --star: #fbbf24;

            --navbar: var(--card-bg);
            --surface-2: #f3f5fa;
            --text-light: var(--text-muted);
            --primary-light: #60a5fa;
            --expense: #ef4444;
            --transition: 0.25s ease;
        }

        body.dark {
            --bg: #0a0f1e;
            --card-bg: #111a2e;
            --text: #eef1f8;
            --text-muted: #8a96b3;
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-soft: #16233f;
            --border: #202c49;
            --shadow: rgba(0, 0, 0, .45);
            --overlay-1: #16327a;
            --overlay-2: #05070f;
            --success: #22c55e;

            --navbar: var(--card-bg);
            --surface-2: #1a2540;
            --text-light: var(--text-muted);
            --primary-light: #60a5fa;
            --expense: #f87171;
        }

        /* Old names mapped to the new root variables */
        body {
            --body: var(--bg);
            --surface: var(--card-bg);
            --radius: 16px;

            --income: var(--success);
            --warning: #f59e0b;
        }

        body.dark {
            --warning: #fbbf24;
        }


/* ================= RESET ================= */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: "Inter", sans-serif;
    background: var(--body);
    color: var(--text);
    min-height: 100vh;
    transition: background var(--transition), color var(--transition);
}

button, input, select { font-family: inherit; }
button { cursor: pointer; }
a { text-decoration: none; color: inherit; }


/* ================= MAIN ================= */

.main-content { min-height: 100vh; }

.content {
    padding: 30px 35px 50px;
    max-width: 1400px;
    margin: 0 auto;
}


/* ================= HEADING + TOOLBAR ================= */

.page-top {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.page-heading h1 {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 4px;
}

.page-heading p {
    color: var(--text-light);
    font-size: 12px;
}

.active-filters {
    margin-top: 6px;
    color: var(--primary);
    font-size: 12px;
    font-weight: 700;
}

.toolbar {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 40px;
    padding: 0 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--surface-2);
    color: var(--text);
    font-size: 12.5px;
    font-weight: 700;
    transition: var(--transition);
}

.btn:hover { border-color: var(--primary); color: var(--primary); }

.btn.disabled {
    opacity: 0.4;
    pointer-events: none;
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
    color: #ffffff;
}

.btn-primary:hover {
    background: var(--primary-dark);
    border-color: var(--primary-dark);
    color: #ffffff;
}


/* ================= FILTER BAR ================= */

.filter-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: 0 12px 30px var(--shadow);
    padding: 18px 20px;
    margin-bottom: 20px;
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(5, 1fr) auto;
    gap: 14px;
    align-items: end;
}

.filter-field label {
    display: block;
    margin-bottom: 6px;
    color: var(--text-light);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.filter-field input,
.filter-field select {
    width: 100%;
    min-height: 40px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--surface-2);
    color: var(--text);
    font-size: 12.5px;
    font-weight: 600;
}

.filter-field input:focus,
.filter-field select:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-actions {
    display: flex;
    gap: 8px;
}

.filter-hint {
    margin-top: 12px;
    color: var(--text-light);
    font-size: 11.5px;
}


/* ================= CARD ================= */

.card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: 0 12px 30px var(--shadow);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border);
}

.card-header h2 { font-size: 15px; font-weight: 800; }

.card-header small {
    color: var(--text-light);
    font-size: 11.5px;
    font-weight: 600;
}


/* ================= STAT TILES ================= */

.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

.stat-tile {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: 0 12px 30px var(--shadow);
    padding: 18px 20px;
}

.stat-tile span {
    display: block;
    color: var(--text-light);
    font-size: 11.5px;
    font-weight: 600;
    margin-bottom: 6px;
}

.stat-tile strong {
    display: block;
    font-size: 21px;
    font-weight: 800;
}

.stat-tile strong.income { color: var(--income); }
.stat-tile strong.expense { color: var(--expense); }

.stat-tile small {
    display: block;
    margin-top: 6px;
    color: var(--text-light);
    font-size: 11px;
}

.trend-up { color: var(--expense); font-weight: 700; }
.trend-down { color: var(--income); font-weight: 700; }


/* ================= REPORT ROWS ================= */

.report-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.report-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 22px;
    border-top: 1px solid var(--border);
    font-size: 13px;
}

.report-item:first-of-type { border-top: 0; }
.report-item span { color: var(--text-light); }
.report-item strong { font-size: 14px; font-weight: 800; }
.report-item strong.income { color: var(--income); }
.report-item strong.expense { color: var(--expense); }

.cat-row {
    padding: 14px 22px;
    border-top: 1px solid var(--border);
}

.cat-row:first-of-type { border-top: 0; }

.cat-row-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-size: 13px;
    margin-bottom: 8px;
}

.cat-row-top span { font-weight: 600; }
.cat-row-top strong { font-size: 13.5px; font-weight: 800; }
.cat-row-top em { color: var(--text-light); font-style: normal; font-size: 11.5px; margin-left: 6px; }

.meter {
    height: 7px;
    border-radius: 999px;
    background: var(--surface-2);
    overflow: hidden;
    border: 1px solid var(--border);
}

.meter i {
    display: block;
    height: 100%;
    border-radius: inherit;
    background: var(--primary);
}

.meter i.warning { background: var(--warning); }
.meter i.exceeded { background: var(--expense); }
.meter i.income { background: var(--income); }
.meter i.expense { background: var(--expense); }

.budget-meta {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 7px;
    color: var(--text-light);
    font-size: 11.5px;
}

.scroll-list {
    max-height: 360px;
    overflow-y: auto;
}


/* ================= CHARTS (income vs expense pairs) ================= */

.legend {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 22px 0;
    color: var(--text-light);
    font-size: 11.5px;
    font-weight: 700;
}

.legend span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.legend i {
    width: 10px;
    height: 10px;
    border-radius: 3px;
    display: inline-block;
}

.legend i.income { background: var(--income); }
.legend i.expense { background: var(--expense); }

.chart-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.chart {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 10px;
    padding: 20px 22px 22px;
}

.chart.daily { min-width: 760px; gap: 4px; }

.bar-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    min-width: 0;
}

.pair {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 3px;
    height: 150px;
    width: 100%;
}

.pair .bar {
    flex: 1;
    max-width: 24px;
    border-radius: 6px 6px 2px 2px;
    transition: var(--transition);
}

.chart.daily .pair .bar { max-width: 9px; border-radius: 3px 3px 1px 1px; }

.bar.income { background: linear-gradient(180deg, #4ade80, var(--income)); }
.bar.expense { background: linear-gradient(180deg, #fca5a5, var(--expense)); }

.bar-col:hover .bar { opacity: 0.8; }

.bar-label {
    color: var(--text-light);
    font-size: 11px;
    font-weight: 600;
    text-align: center;
}

.chart.daily .bar-label { font-size: 9.5px; }

.bar-values {
    text-align: center;
    font-size: 10.5px;
    font-weight: 700;
    line-height: 1.5;
}

.bar-values .inc { color: var(--income); display: block; }
.bar-values .exp { color: var(--expense); display: block; }

.view-toggle {
    display: inline-flex;
    gap: 6px;
}

.view-toggle button {
    min-height: 32px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface-2);
    color: var(--text-light);
    font-size: 12px;
    font-weight: 700;
    transition: var(--transition);
}

.view-toggle button.active {
    background: var(--primary);
    border-color: var(--primary);
    color: #ffffff;
}

[hidden] { display: none !important; }

.empty-note {
    padding: 22px;
    color: var(--text-light);
    font-size: 12.5px;
    text-align: center;
}

.section-gap { margin-top: 20px; }


/* ================= FOOTER ================= */

.site-footer {
    background: var(--navbar);
    border-top: 1px solid var(--border);
    margin-top: 60px;
    transition: background var(--transition);
}


/* ================= RESPONSIVE ================= */

@media (max-width: 1100px) {
    .stat-grid { grid-template-columns: repeat(2, 1fr); }
    .filter-form { grid-template-columns: repeat(2, 1fr); }
    .filter-actions { grid-column: 1 / -1; }
}

@media (max-width: 850px) {
    .content { padding: 25px 20px; }
}

@media (max-width: 700px) {
    .report-grid { grid-template-columns: 1fr; }
    .stat-grid { grid-template-columns: 1fr; }
    .filter-form { grid-template-columns: 1fr; }
}


/* ================= PRINT / SAVE AS PDF ================= */

@media print {
    nav, header, .navbar, .toolbar, .filter-card, .view-toggle, .site-footer { display: none !important; }

    body, body.dark { background: #ffffff !important; color: #111111 !important; }

    .content { padding: 0; max-width: 100%; }

    .card, .stat-tile {
        box-shadow: none !important;
        border: 1px solid #d9d9d9 !important;
        background: #ffffff !important;
        break-inside: avoid;
    }

    .scroll-list { max-height: none; overflow: visible; }

    .bar, .meter i { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
}
</style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    @include('nav')


    <!-- ================= MAIN CONTENT ================= -->

    <main class="main-content">

        <section class="content">

            <!-- Heading + navigation -->
            <div class="page-top">

                <div class="page-heading">
                    <h1>Reports & Insights</h1>
                    <p>Full report for {{ $periodLabel }} · {{ $periodSub }}</p>

                    @if(count($activeFilters))
                        <div class="active-filters">
                            <i class="fa-solid fa-filter"></i> {{ implode('  ·  ', $activeFilters) }}
                        </div>
                    @endif
                </div>

                <div class="toolbar">

                    @unless($rangeMode)
                        <a class="btn" href="{{ url()->current() }}?{{ http_build_query(array_merge($keepFilters, ['month' => $prevMonth])) }}" title="Previous month">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>

                        <a class="btn {{ $hasNextMonth ? '' : 'disabled' }}" href="{{ url()->current() }}?{{ http_build_query(array_merge($keepFilters, ['month' => $nextMonth])) }}" title="Next month">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    @endunless

                    <a class="btn" href="{{ url()->current() }}{{ count($keepFilters) ? '?' . http_build_query($keepFilters) : '' }}">This month</a>

                    <button class="btn btn-primary" type="button" onclick="window.print()">
                        <i class="fa-solid fa-file-pdf"></i> Print report
                    </button>

                </div>

            </div>


            <!-- Filters -->
            <div class="filter-card">

                <form method="GET" action="{{ url()->current() }}" class="filter-form">

                    <div class="filter-field">
                        <label for="f_month">Month</label>
                        <input type="month" id="f_month" name="month"
                               value="{{ $monthValue }}" max="{{ now()->format('Y-m') }}">
                    </div>

                    <div class="filter-field">
                        <label for="f_from">Date from</label>
                        <input type="date" id="f_from" name="date_from"
                               value="{{ $dateFrom }}" max="{{ now()->format('Y-m-d') }}">
                    </div>

                    <div class="filter-field">
                        <label for="f_to">Date to</label>
                        <input type="date" id="f_to" name="date_to"
                               value="{{ $dateTo }}" max="{{ now()->format('Y-m-d') }}">
                    </div>

                    <div class="filter-field">
                        <label for="f_category">Category</label>
                        <select id="f_category" name="category_id">
                            <option value="">All categories</option>
                            <optgroup label="Expense">
                                @foreach($filterCategories->where('type', 'expense') as $c)
                                    <option value="{{ $c->id }}" {{ $selectedCategory == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Income">
                                @foreach($filterCategories->where('type', 'income') as $c)
                                    <option value="{{ $c->id }}" {{ $selectedCategory == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div class="filter-field">
                        <label for="f_source">Income source</label>
                        <select id="f_source" name="income_source">
                            <option value="">All sources</option>
                            @foreach($incomeSources as $s)
                                <option value="{{ $s->id }}" {{ $selectedSource == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Apply
                        </button>
                        <a href="{{ url()->current() }}" class="btn">Clear</a>
                    </div>

                </form>

                <p class="filter-hint">
                    Date from / to dalne par mahine ki jagah yehi period use hota hai.
                    Income source sirf income ko mehdood karta hai, expenses waise hi rehte hain.
                </p>

            </div>


            <!-- Key numbers -->
            <div class="stat-grid">

                <div class="stat-tile">
                    <span>Total Income</span>
                    <strong class="income">₨{{ number_format($totalIncome, 0) }}</strong>
                    <small>
                        @if(!is_null($incomeChange))
                            <span class="{{ $incomeChange >= 0 ? 'trend-down' : 'trend-up' }}">
                                {{ $incomeChange >= 0 ? '▲' : '▼' }} {{ abs($incomeChange) }}%
                            </span>
                            {{ $compareLabel }}
                        @else
                            No income before this period to compare
                        @endif
                    </small>
                </div>

                <div class="stat-tile">
                    <span>Total Expenses</span>
                    <strong class="expense">₨{{ number_format($totalExpenses, 0) }}</strong>
                    <small>
                        @if(!is_null($expenseChange))
                            <span class="{{ $expenseChange <= 0 ? 'trend-down' : 'trend-up' }}">
                                {{ $expenseChange >= 0 ? '▲' : '▼' }} {{ abs($expenseChange) }}%
                            </span>
                            {{ $compareLabel }}
                        @else
                            No expenses before this period to compare
                        @endif
                    </small>
                </div>

                <div class="stat-tile">
                    <span>Net Balance</span>
                    <strong class="{{ $netBalance >= 0 ? 'income' : 'expense' }}">
                        {{ $netBalance < 0 ? '-' : '' }}₨{{ number_format(abs($netBalance), 0) }}
                    </strong>
                    <small>Savings rate {{ $savingsRate }}%</small>
                </div>

                <div class="stat-tile">
                    <span>Transactions</span>
                    <strong>{{ $txCount }}</strong>
                </div>

            </div>


            <div class="report-grid">

                <!-- Financial summary -->
                <div class="card">
                    <div class="card-header">
                        <h2>Financial Summary</h2>
                        <small>{{ $periodLabel }}</small>
                    </div>

                    <div class="report-item">
                        <span>Total Income</span>
                        <strong class="income">₨{{ number_format($totalIncome, 0) }}</strong>
                    </div>

                    <div class="report-item">
                        <span>Total Expenses</span>
                        <strong class="expense">₨{{ number_format($totalExpenses, 0) }}</strong>
                    </div>

                    <div class="report-item">
                        <span>Net Balance</span>
                        <strong>{{ $netBalance < 0 ? '-' : '' }}₨{{ number_format(abs($netBalance), 0) }}</strong>
                    </div>

                    <div class="report-item">
                        <span>Savings Rate</span>
                        <strong>{{ $savingsRate }}%</strong>
                    </div>

                    <div class="report-item">
                        <span>Average daily spending</span>
                        <strong>₨{{ number_format($avgDailySpend, 0) }}</strong>
                    </div>

                    <div class="report-item">
                        <span>Highest spending day</span>
                        <strong>
                            @if($highestDay)
                                {{ $highestDay['label'] }} · ₨{{ number_format($highestDay['total'], 0) }}
                            @else
                                —
                            @endif
                        </strong>
                    </div>
                </div>

                <!-- Expenses by category (all categories) -->
                <div class="card">
                    <div class="card-header">
                        <h2>Expenses by Category</h2>
                        <small>Share of total expenses</small>
                    </div>

                    <div class="scroll-list">
                        @forelse($expenseCategories as $cat)
                            <div class="cat-row">
                                <div class="cat-row-top">
                                    <span>{{ $cat->category_name }}</span>
                                    <div>
                                        <strong>₨{{ number_format($cat->total, 0) }}</strong>
                                        <em>{{ $cat->share }}%</em>
                                    </div>
                                </div>
                                <div class="meter"><i class="expense" style="width: {{ min($cat->share, 100) }}%"></i></div>
                            </div>
                        @empty
                            <p class="empty-note">
                                No expenses found for {{ $periodLabel }}.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>


            <div class="report-grid section-gap">

                <!-- Income by category / source -->
                <div class="card">
                    <div class="card-header">
                        <h2>Income by Source</h2>
                        <small>Share of total income</small>
                    </div>

                    <div class="scroll-list">
                        @forelse($incomeCategories as $cat)
                            <div class="cat-row">
                                <div class="cat-row-top">
                                    <span>{{ $cat->category_name }}</span>
                                    <div>
                                        <strong>₨{{ number_format($cat->total, 0) }}</strong>
                                        <em>{{ $cat->share }}%</em>
                                    </div>
                                </div>
                                <div class="meter"><i class="income" style="width: {{ min($cat->share, 100) }}%"></i></div>
                            </div>
                        @empty
                            <p class="empty-note">
                                No income found for {{ $periodLabel }}.
                            </p>
                        @endforelse
                    </div>
                </div>

                <!-- Budgets vs actual -->
                <div class="card">
                    <div class="card-header">
                        <h2>Budget vs Actual</h2>
                        <small>{{ $periodLabel }} budgets</small>
                    </div>

                    <div class="scroll-list">
                        @forelse($budgetReport as $b)
                            <div class="cat-row">
                                <div class="cat-row-top">
                                    <span>{{ $b->name }}</span>
                                    <div>
                                        <strong>₨{{ number_format($b->spent, 0) }} / ₨{{ number_format($b->limit, 0) }}</strong>
                                        <em>{{ $b->usage }}%</em>
                                    </div>
                                </div>

                                <div class="meter">
                                    <i class="{{ $b->status === 'ok' ? '' : $b->status }}" style="width: {{ min($b->usage, 100) }}%"></i>
                                </div>

                                <div class="budget-meta">
                                    <span>
                                        @if($b->status === 'exceeded')
                                            Over budget by ₨{{ number_format(abs($b->remaining), 0) }}
                                        @elseif($b->status === 'warning')
                                            Near limit
                                        @else
                                            On track
                                        @endif
                                    </span>
                                    <span>
                                        @if($b->remaining >= 0)
                                            ₨{{ number_format($b->remaining, 0) }} left
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="empty-note">No budgets found for {{ $periodLabel }}.</p>
                        @endforelse
                    </div>
                </div>

            </div>


            <!-- 6 month income vs expense -->
            <div class="card section-gap">
                <div class="card-header">
                    <h2>Income vs Expenses</h2>
                    <small>Last 6 months{{ $rangeMode ? ' (up to end of range)' : '' }}</small>
                </div>

                @if(collect($monthlyChart)->sum('income') + collect($monthlyChart)->sum('expense') > 0)

                    <div class="legend">
                        <span><i class="income"></i> Income</span>
                        <span><i class="expense"></i> Expenses</span>
                    </div>

                    <div class="chart-scroll">
                        <div class="chart">
                            @foreach($monthlyChart as $m)
                                <div class="bar-col"
                                     title="{{ $m['label'] }} · Income ₨{{ number_format($m['income'], 0) }} · Expenses ₨{{ number_format($m['expense'], 0) }}">
                                    <div class="pair">
                                        <div class="bar income" style="height: {{ $m['income_h'] }}%"></div>
                                        <div class="bar expense" style="height: {{ $m['expense_h'] }}%"></div>
                                    </div>
                                    <div class="bar-label">{{ $m['label'] }}</div>
                                    <div class="bar-values">
                                        <span class="inc">₨{{ number_format($m['income'] / 1000, 1) }}k</span>
                                        <span class="exp">₨{{ number_format($m['expense'] / 1000, 1) }}k</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @else

                    <p class="empty-note">No history yet to chart.</p>

                @endif
            </div>


            <!-- Daily / weekly breakdown -->
            <div class="card section-gap">
                <div class="card-header">
                    <h2>Daily & Weekly Breakdown</h2>

                    <div class="view-toggle">
                        @if($showDaily)
                            <button type="button" class="active" data-view="daily">Daily</button>
                            <button type="button" data-view="weekly">Weekly</button>
                        @else
                            <button type="button" class="active" data-view="weekly">Weekly</button>
                        @endif
                    </div>
                </div>

                @if($txCount > 0)

                    <div class="legend">
                        <span><i class="income"></i> Income</span>
                        <span><i class="expense"></i> Expenses</span>
                    </div>

                    @if($showDaily)
                        <!-- Daily -->
                        <div class="chart-scroll" id="view-daily">
                            <div class="chart daily" style="min-width: {{ max(760, count($dailyChart) * 24) }}px;">
                                @foreach($dailyChart as $d)
                                    <div class="bar-col"
                                         title="{{ $d['full'] }} · Income ₨{{ number_format($d['income'], 0) }} · Expenses ₨{{ number_format($d['expense'], 0) }}">
                                        <div class="pair">
                                            <div class="bar income" style="height: {{ $d['income_h'] }}%"></div>
                                            <div class="bar expense" style="height: {{ $d['expense_h'] }}%"></div>
                                        </div>
                                        <div class="bar-label">{{ $d['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Weekly -->
                    <div class="chart-scroll" id="view-weekly" {{ $showDaily ? 'hidden' : '' }}>
                        <div class="chart" style="min-width: {{ max(0, (count($weeklyChart) - 6) * 80) ?: 0 }}px;">
                            @foreach($weeklyChart as $w)
                                <div class="bar-col"
                                     title="{{ $w['full'] }} · Income ₨{{ number_format($w['income'], 0) }} · Expenses ₨{{ number_format($w['expense'], 0) }}">
                                    <div class="pair">
                                        <div class="bar income" style="height: {{ $w['income_h'] }}%"></div>
                                        <div class="bar expense" style="height: {{ $w['expense_h'] }}%"></div>
                                    </div>
                                    <div class="bar-label">{{ $w['label'] }}</div>
                                    <div class="bar-values">
                                        <span class="inc">+₨{{ number_format($w['income'], 0) }}</span>
                                        <span class="exp">-₨{{ number_format($w['expense'], 0) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @unless($showDaily)
                        <p class="filter-hint" style="padding: 0 22px 18px;">
                            Period 62 din se lamba hai, is liye sirf weekly view dikhaya ja raha hai.
                        </p>
                    @endunless

                @else

                    <p class="empty-note">No transactions found for {{ $periodLabel }}.</p>

                @endif
            </div>

        </section>

    </main>


    <!-- ================= FOOTER ================= -->
    <footer class="site-footer" style="background:var(--navbar); border-top:1px solid var(--border);">

        <div class="footer-inner" style="max-width:1400px; margin:0 auto; padding:24px 35px; display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;">

            <span style="color:var(--text-light); font-size:12px;">© 2026 CampusCoin. All Rights Reserved.</span>

            <div class="footer-links" style="display:flex; align-items:center; flex-wrap:wrap; gap:18px;">
                <a href="/dashboard" style="color:var(--text-light); font-size:12px;">Dashboard</a>
                <a href="/income-expense" style="color:var(--text-light); font-size:12px;">Income & Expenses</a>
                <a href="/budgets-goal" style="color:var(--text-light); font-size:12px;">Budget Goals</a>
                <a href="/report-insights" style="color:var(--text-light); font-size:12px;">Reports</a>
                <a href="/saving-tips" style="color:var(--text-light); font-size:12px;">Saving Tips</a>
            </div>

        </div>

    </footer>


    <!-- JavaScript -->
    <script>
        // Daily / Weekly toggle
        document.querySelectorAll('.view-toggle button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var view = btn.dataset.view;

                document.querySelectorAll('.view-toggle button').forEach(function (b) {
                    b.classList.toggle('active', b === btn);
                });

                var daily  = document.getElementById('view-daily');
                var weekly = document.getElementById('view-weekly');

                if (daily)  daily.hidden  = view !== 'daily';
                if (weekly) weekly.hidden = view !== 'weekly';
            });
        });

        // Date range chuni jaye to month khali kar do (dono ek saath na jayein)
        (function () {
            var month = document.getElementById('f_month');
            var from  = document.getElementById('f_from');
            var to    = document.getElementById('f_to');

            function sync() {
                if (from.value || to.value) { month.value = ''; }
            }

            from.addEventListener('change', sync);
            to.addEventListener('change', sync);
            month.addEventListener('change', function () {
                if (month.value) { from.value = ''; to.value = ''; }
            });
        })();
    </script>
    <script src="{{ asset('js/script.js') }}" defer></script>

</body>
</html>