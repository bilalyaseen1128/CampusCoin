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
    --primary: #7c5cff;
    --primary-dark: #6546e8;
    --primary-light: #9b83ff;

    --income: #22c55e;
    --income-bg: rgba(34, 197, 94, 0.12);

    --expense: #ef4444;
    --expense-bg: rgba(239, 68, 68, 0.12);

    --warning: #f59e0b;

    --body: #f5f6fa;
    --surface: #ffffff;
    --surface-2: #f8f9fc;

    --navbar: #ffffff;

    --text: #171923;
    --text-light: #737887;

    --border: #e5e7eb;

    --shadow: 0 10px 30px rgba(20, 20, 40, 0.07);

    --radius: 16px;

    --transition: 0.3s ease;
}

body.dark {
    --body: #0f1117;
    --surface: #181b24;
    --surface-2: #20242f;

    --navbar: #141720;

    --text: #f5f7fa;
    --text-light: #a7adba;

    --border: #303542;

    --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);

    background: var(--body);
    color: var(--text);
}

body.dark .card,
body.dark .stat-tile {
    background: var(--surface);
    border-color: var(--border);
}

body.dark .btn,
body.dark .month-input {
    background: var(--surface-2);
    color: var(--text);
    border-color: var(--border);
}

body.dark .bar {
    background: linear-gradient(180deg, var(--primary-light), var(--primary));
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

button, input { font-family: inherit; }
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
    margin-bottom: 25px;
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
    background: var(--surface);
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

.month-input {
    min-height: 40px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--surface);
    color: var(--text);
    font-size: 12.5px;
    font-weight: 600;
}

.month-input:focus {
    outline: none;
    border-color: var(--primary);
}


/* ================= CARD ================= */

.card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
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
    box-shadow: var(--shadow);
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

.budget-meta {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 7px;
    color: var(--text-light);
    font-size: 11.5px;
}


/* ================= CHART ================= */

.chart {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 14px;
    padding: 30px 26px 24px;
    height: 220px;
}

.chart.daily {
    gap: 4px;
    padding: 26px 22px 20px;
}

.bar-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    height: 100%;
    gap: 10px;
    min-width: 0;
}

.bar {
    width: 100%;
    max-width: 34px;
    border-radius: 8px 8px 3px 3px;
    background: linear-gradient(180deg, var(--primary-light), var(--primary));
    transition: var(--transition);
}

.chart.daily .bar { border-radius: 4px 4px 2px 2px; max-width: 18px; }

.bar-wrapper:hover .bar {
    transform: scaleY(1.03);
    transform-origin: bottom;
}

.bar-wrapper span {
    color: var(--text-light);
    font-size: 11px;
    font-weight: 600;
    min-height: 13px;
}

.chart.daily .bar-wrapper span { font-size: 9.5px; }

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

.footer-inner {
    max-width: 1400px;
    margin: 0 auto;
    padding: 50px 35px 0;
}

.footer-columns {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    padding-bottom: 40px;
    border-bottom: 1px solid var(--border);
}

.footer-col h4 {
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 18px;
    letter-spacing: 0.3px;
}

.footer-col ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-col ul li a {
    color: var(--text-light);
    font-size: 12.5px;
    transition: var(--transition);
}

.footer-col ul li a:hover { color: var(--primary); }

.footer-bottom {
    padding: 22px 0 26px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-locale {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-light);
    font-size: 12px;
    font-weight: 600;
}

.footer-locale i { color: var(--primary); }

.footer-legal {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;
}

.footer-legal a { color: var(--text-light); font-size: 11.5px; }
.footer-legal a:hover { color: var(--primary); }
.footer-copyright { color: var(--text-light); font-size: 11px; }

.footer-social { display: flex; gap: 10px; }

.footer-social a {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: var(--surface-2);
    color: var(--text-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    transition: var(--transition);
}

.footer-social a:hover { color: var(--primary); border-color: var(--primary); }


/* ================= RESPONSIVE ================= */

@media (max-width: 1100px) {
    .footer-columns { grid-template-columns: repeat(2, 1fr); gap: 30px 20px; }
    .stat-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 850px) {
    .content { padding: 25px 20px; }
}

@media (max-width: 700px) {
    .report-grid { grid-template-columns: 1fr; }
    .stat-grid { grid-template-columns: 1fr; }
    .chart { height: 180px; padding: 24px 16px 18px; }
    .chart.daily { gap: 2px; padding: 22px 10px 16px; }
    .footer-inner { padding: 40px 20px 0; }
    .footer-columns { grid-template-columns: 1fr; gap: 26px; }
    .footer-bottom { flex-direction: column; align-items: flex-start; }
    .footer-legal { gap: 12px 16px; }
}


/* ================= PRINT / SAVE AS PDF ================= */

@media print {
    nav, header, .navbar, .toolbar, .site-footer { display: none !important; }

    body, body.dark { background: #ffffff !important; color: #111111 !important; }

    .content { padding: 0; max-width: 100%; }

    .card, .stat-tile {
        box-shadow: none !important;
        border: 1px solid #d9d9d9 !important;
        background: #ffffff !important;
        break-inside: avoid;
    }

    .bar { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .meter i { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
}
</style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    @include('nav')


    <!-- ================= MAIN CONTENT ================= -->

    <main class="main-content">

        <section class="content">

            <!-- Heading + month picker -->
            <div class="page-top">

                <div class="page-heading">
                    <h1>Reports & Insights</h1>
                    <p>Full report for {{ $reportMonth->format('F Y') }} · 1 {{ $reportMonth->format('M') }} to {{ $reportMonth->daysInMonth }} {{ $reportMonth->format('M Y') }}</p>
                </div>

                <div class="toolbar">

                    <a class="btn" href="{{ url()->current() }}?month={{ $prevMonth }}" title="Previous month">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>

                    <form method="GET" action="{{ url()->current() }}">
                        <input
                            class="month-input"
                            type="month"
                            name="month"
                            value="{{ $reportMonth->format('Y-m') }}"
                            max="{{ now()->format('Y-m') }}"
                            onchange="this.form.submit()"
                            aria-label="Choose month"
                        >
                    </form>

                    <a class="btn {{ $hasNextMonth ? '' : 'disabled' }}" href="{{ url()->current() }}?month={{ $nextMonth }}" title="Next month">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    <a class="btn" href="{{ url()->current() }}">This month</a>

                    <button class="btn btn-primary" type="button" onclick="window.print()">
                        <i class="fa-solid fa-file-pdf"></i> Print report
                    </button>

                </div>

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
                            vs last month
                        @else
                            No income last month to compare
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
                            vs last month
                        @else
                            No expenses last month to compare
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
                    <small>Average spend ₨{{ number_format($avgDaily, 0) }} per day</small>
                </div>

            </div>


            <div class="report-grid">

                <!-- Financial summary -->
                <div class="card">
                    <div class="card-header">
                        <h2>Financial Summary</h2>
                        <small>{{ $reportMonth->format('F Y') }}</small>
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
                        <span>Highest spending day</span>
                        <strong>
                            @if($highestDay)
                                {{ $highestDay['day'] }} {{ $reportMonth->format('M') }} · ₨{{ number_format($highestDay['total'], 0) }}
                            @else
                                —
                            @endif
                        </strong>
                    </div>
                </div>

                <!-- Top categories -->
                <div class="card">
                    <div class="card-header">
                        <h2>Top Spending Categories</h2>
                        <small>Share of total expenses</small>
                    </div>

                    @forelse($topCategories as $cat)
                        <div class="cat-row">
                            <div class="cat-row-top">
                                <span>{{ $cat->category_name }}</span>
                                <div>
                                    <strong>₨{{ number_format($cat->total, 0) }}</strong>
                                    <em>{{ $cat->share }}%</em>
                                </div>
                            </div>
                            <div class="meter"><i style="width: {{ min($cat->share, 100) }}%"></i></div>
                        </div>
                    @empty
                        <p class="empty-note">
                            No expenses recorded in {{ $reportMonth->format('F Y') }}.
                        </p>
                    @endforelse
                </div>

            </div>


            <!-- Daily spending: the whole month -->
            <div class="card section-gap">
                <div class="card-header">
                    <h2>Daily Spending</h2>
                    <small>Day 1 to {{ $reportMonth->daysInMonth }}</small>
                </div>

                @if(collect($dailyChart)->sum('total') > 0)

                    <div class="chart daily">
                        @foreach($dailyChart as $d)
                            <div class="bar-wrapper" title="{{ $d['day'] }} {{ $reportMonth->format('M') }}: ₨{{ number_format($d['total'], 0) }}">
                                <div class="bar" style="height: {{ max($d['height'], 2) }}%"></div>
                                <span>{{ $d['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                @else

                    <p class="empty-note">No spending recorded in {{ $reportMonth->format('F Y') }}.</p>

                @endif
            </div>


            <!-- Budgets vs actual -->
            <div class="card section-gap">
                <div class="card-header">
                    <h2>Budget vs Actual</h2>
                    <small>{{ $reportMonth->format('F Y') }} budgets</small>
                </div>

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
                    <p class="empty-note">No budgets were set for {{ $reportMonth->format('F Y') }}.</p>
                @endforelse
            </div>


            <!-- 6 month overview -->
            <div class="card section-gap">
                <div class="card-header">
                    <h2>Monthly Spending Overview</h2>
                    <small>Last 6 months</small>
                </div>

                @if(collect($monthlyChart)->sum('total') > 0)

                    <div class="chart">
                        @foreach($monthlyChart as $m)
                            <div class="bar-wrapper" title="{{ $m['label'] }}: ₨{{ number_format($m['total'], 0) }}">
                                <div class="bar" style="height: {{ max($m['height'], 3) }}%"></div>
                                <span>{{ $m['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                @else

                    <p class="empty-note">No spending history yet to chart.</p>

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
    <script src="{{ asset('js/script.js') }}" defer></script>

</body>
</html>