<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusCoin | Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    :root {
        --bg: #eef2fb;
        --sidebar-bg: #ffffff;
        --card-bg: #ffffff;
        --text: #101828;
        --text-muted: #667085;
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-soft: #e8effe;
        --border: #e6eaf3;
        --shadow: rgba(20, 35, 80, .08);
        --income: #16a34a;
        --income-soft: #e8f8ee;
        --expense: #dc2626;
        --expense-soft: #fdeceb;
        --warning: #d97706;
        --warning-soft: #fef3e2;
    }

    html[data-theme="dark"] {
        --bg: #0a0f1e;
        --sidebar-bg: #0f1729;
        --card-bg: #111a2e;
        --text: #eef1f8;
        --text-muted: #8a96b3;
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --primary-soft: #16233f;
        --border: #202c49;
        --shadow: rgba(0, 0, 0, .45);
        --income: #34d399;
        --income-soft: #103527;
        --expense: #f87171;
        --expense-soft: #3a1717;
        --warning: #fbbf24;
        --warning-soft: #3a2b0c;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: 'Inter', system-ui, sans-serif;
        background: var(--bg);
        color: var(--text);
        transition: background .25s ease, color .25s ease;
    }

    a { text-decoration: none; color: inherit; }

    .app {
        display: flex;
        min-height: 100vh;
    }

    /* ---------- Sidebar ---------- */
    .sidebar {
        width: 264px;
        flex-shrink: 0;
        background: var(--sidebar-bg);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        padding: 22px 16px;
        position: sticky;
        top: 0;
        height: 100vh;
        transition: transform .25s ease, background .25s ease;
        z-index: 300;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 4px 10px 24px;
    }

    .logo-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .logo-text h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
    }

    .logo-text span {
        font-size: 11.5px;
        color: var(--text-muted);
    }

    .nav-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
        color: var(--text-muted);
        padding: 6px 12px 10px;
    }

    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--text-muted);
        transition: background .15s, color .15s;
    }

    .nav-link:hover {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .nav-link.active {
        background: var(--primary-soft);
        color: var(--primary);
        font-weight: 700;
    }

    .nav-icon {
        width: 20px;
        text-align: center;
        font-size: 14px;
    }

    .sidebar-bottom {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }

    button.nav-link {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font: inherit;
        cursor: pointer;
    }

    button.nav-link:hover {
        color: var(--expense);
        background: var(--expense-soft);
    }

    form.logout-form { margin: 0; }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 15, 30, .5);
        z-index: 250;
    }

    /* ---------- Main ---------- */
    .main {
        flex: 1;
        min-width: 0;
    }

    .topbar {
        position: sticky;
        top: 0;
        z-index: 150;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 28px;
        background: var(--card-bg);
        border-bottom: 1px solid var(--border);
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .menu-btn {
        display: none;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        color: var(--text);
        font-size: 15px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 9px 14px;
        width: 320px;
        max-width: 40vw;
        color: var(--text-muted);
        font-size: 13px;
    }

    .search-box input {
        border: none;
        background: none;
        outline: none;
        color: var(--text);
        font-size: 13px;
        width: 100%;
        font-family: inherit;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .add-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        white-space: nowrap;
        transition: background .15s, transform .15s;
    }

    .add-btn:hover { background: var(--primary-dark); transform: translateY(-1px); }

    .icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        color: var(--text);
        font-size: 14px;
        cursor: pointer;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s;
        flex-shrink: 0;
    }

    .icon-btn:hover { background: var(--primary-soft); color: var(--primary); }

    .icon-btn .dot {
        position: absolute;
        top: 7px;
        right: 8px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--expense);
        border: 1.5px solid var(--card-bg);
    }

    .user-mini {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 12px 5px 5px;
        border-radius: 999px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        flex-shrink: 0;
    }

    .avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .user-mini span {
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .content {
        padding: 26px 28px 40px;
        max-width: 1280px;
    }

    .page-heading h1 {
        margin: 0 0 4px;
        font-size: 23px;
        font-weight: 800;
    }

    .page-heading p {
        margin: 0 0 26px;
        color: var(--text-muted);
        font-size: 13.5px;
    }

    /* ---------- Stat cards ---------- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 14px var(--shadow);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .stat-icon.income { background: var(--income-soft); color: var(--income); }
    .stat-icon.expense { background: var(--expense-soft); color: var(--expense); }
    .stat-icon.balance { background: var(--primary-soft); color: var(--primary); }
    .stat-icon.warning { background: var(--warning-soft); color: var(--warning); }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
    }

    .stat-change.income { background: var(--income-soft); color: var(--income); }
    .stat-change.expense { background: var(--expense-soft); color: var(--expense); }
    .stat-change.warning { background: var(--warning-soft); color: var(--warning); }

    .stat-card h3 {
        margin: 0 0 4px;
        font-size: 24px;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    .stat-card p {
        margin: 0;
        font-size: 12.5px;
        color: var(--text-muted);
    }

    /* ---------- Dashboard grid ---------- */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 18px;
    }

    .card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 14px var(--shadow);
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .card-header a {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--primary);
    }

    /* ---------- Pure CSS bar chart (no JS library needed) ---------- */
    .chart-wrap {
        min-height: 260px;
        position: relative;
    }

    .chart-legend {
        display: flex;
        gap: 18px;
        margin-bottom: 16px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
    }

    .chart-legend span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .chart-legend .dot {
        width: 9px;
        height: 9px;
        border-radius: 3px;
        display: inline-block;
    }

    .chart-legend .dot.income { background: var(--income); }
    .chart-legend .dot.expense { background: var(--expense); }

    .bar-chart {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 10px;
        height: 190px;
        padding: 0 4px;
        border-bottom: 1px solid var(--border);
    }

    .bar-month {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: flex-end;
        min-width: 0;
    }

    .bar-pair {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 100%;
        width: 100%;
        justify-content: center;
    }

    .bar {
        width: 14px;
        border-radius: 4px 4px 0 0;
        min-height: 3px;
        position: relative;
        transition: opacity .15s;
    }

    .bar:hover { opacity: 0.8; }

    .bar.income { background: var(--income); }
    .bar.expense { background: var(--expense); }

    .bar-month-label {
        margin-top: 8px;
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        white-space: nowrap;
    }

    .chart-empty {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--text-muted);
        font-size: 13px;
        padding: 60px 20px;
    }

    /* ---------- Transactions ---------- */
    .transaction-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .transaction {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 6px;
        border-radius: 10px;
        transition: background .15s;
    }

    .transaction:hover { background: var(--bg); }

    .transaction-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .transaction-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .transaction-icon.expense { background: var(--expense-soft); color: var(--expense); }
    .transaction-icon.income { background: var(--income-soft); color: var(--income); }

    .transaction-name {
        font-size: 13.5px;
        font-weight: 600;
    }

    .transaction-date {
        font-size: 11.5px;
        color: var(--text-muted);
    }

    .amount { font-size: 13.5px; font-weight: 700; font-variant-numeric: tabular-nums; white-space: nowrap; }
    .amount.income { color: var(--income); }
    .amount.expense { color: var(--expense); }

    /* ---------- Budget progress ---------- */
    .budget-block { margin-top: 20px; }

    .budget-row {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
        margin-bottom: 6px;
        color: var(--text-muted);
    }

    .budget-row strong { color: var(--text); font-variant-numeric: tabular-nums; }

    .progress-track {
        height: 8px;
        border-radius: 999px;
        background: var(--bg);
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    }

    /* ---------- Quick add ---------- */
    .quick-add {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .quick-add-label {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--text-muted);
        margin-right: 4px;
    }

    .quick-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 14px;
        border-radius: 999px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        color: var(--text);
        font-size: 12.5px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
    }

    .quick-btn:hover { background: var(--primary-soft); color: var(--primary); border-color: var(--primary); }
    .quick-btn.income i { color: var(--income); }
    .quick-btn.expense i { color: var(--expense); }

    .quick-sep { width: 1px; height: 22px; background: var(--border); }

    /* ---------- Insights row (top categories + tips) ---------- */
    .insights-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 18px;
    }

    .top-cat { margin-bottom: 16px; }
    .top-cat:last-child { margin-bottom: 0; }

    .top-cat-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .top-cat-row strong { font-weight: 700; }
    .top-cat-row span { color: var(--text-muted); font-variant-numeric: tabular-nums; }

    .top-cat.first .progress-fill { background: linear-gradient(90deg, var(--expense), #f87171); }

    .tip {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 10px;
        font-size: 13px;
        line-height: 1.5;
    }

    .tip:last-child { margin-bottom: 0; }
    .tip i { margin-top: 3px; }
    .tip.warning { background: var(--warning-soft); color: var(--warning); }
    .tip.success { background: var(--income-soft); color: var(--income); }
    .tip.info { background: var(--primary-soft); color: var(--primary); }
    .tip span { color: var(--text); }

    /* ---------- Quick add modal ---------- */
    .qa-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 15, 30, .55);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        z-index: 500;
        padding: 20px;
    }

    .qa-overlay.show { display: flex; }

    .qa-modal {
        width: 100%;
        max-width: 460px;
        max-height: 90vh;
        overflow-y: auto;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
    }

    .qa-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .qa-head h2 { margin: 0; font-size: 18px; font-weight: 800; }

    .qa-close {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: 1px solid var(--border);
        background: var(--bg);
        color: var(--text-muted);
        cursor: pointer;
    }

    .qa-field { margin-bottom: 14px; }

    .qa-field label {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
        font-weight: 700;
    }

    .qa-field input,
    .qa-field select {
        width: 100%;
        height: 42px;
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--bg);
        color: var(--text);
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }

    .qa-field input:focus,
    .qa-field select:focus { border-color: var(--primary); }

    .qa-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 18px;
    }

    .qa-cancel {
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--bg);
        color: var(--text);
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 980px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .insights-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 760px) {
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            transform: translateX(-100%);
            box-shadow: 0 0 40px var(--shadow);
        }
        .sidebar.open { transform: translateX(0); }
        .sidebar-overlay.show { display: block; }
        .menu-btn { display: flex; }
        .search-box { display: none; }
        .content { padding: 20px 16px 32px; }
        .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .user-mini span { display: none; }
        .user-mini { padding: 5px; }
        .add-btn span { display: none; }
        .add-btn { padding: 10px; }
        .bar { width: 9px; }
    }

    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
        .topbar { padding: 14px 16px; }
    }
</style>
</head>

<body>

<div class="app">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <div class="logo-icon"><i class="fa-solid fa-coins"></i></div>
            <div class="logo-text">
                <h2>CampusCoin</h2>
                <span>Student Finance</span>
            </div>
        </div>

        <div class="nav-title">Main Menu</div>

        <nav class="nav-menu">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span> Dashboard
            </a>
            <a href="/income-expense" class="nav-link {{ request()->is('income-expense') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-wallet"></i></span> Income & Expenses
            </a>
            <a href="/categories" class="nav-link {{ request()->is('categories') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-layer-group"></i></span> Categories
            </a>
            <a href="/budgets-goal" class="nav-link {{ request()->is('budgets-goal') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-bullseye"></i></span> Budget Goals
            </a>
            <a href="/report-insights" class="nav-link {{ request()->is('report-insights') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-chart-pie"></i></span> Reports & Insights
            </a>
            <a href="/saving-tips" class="nav-link {{ request()->is('saving-tips') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-lightbulb"></i></span> Saving Tips
            </a>
        </nav>

        <div class="sidebar-bottom">
            <nav class="nav-menu">
                <a href="/profile" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa-solid fa-user"></i></span> Profile
                </a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form" onsubmit="return confirm('Are you sure you want to logout?')">
                    @csrf
                    <button type="submit" class="nav-link">
                        <span class="nav-icon"><i class="fa-solid fa-right-from-bracket"></i></span> Logout
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <main class="main">

        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-btn" id="menuButton" aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search transactions, categories...">
                </div>
            </div>

            <div class="topbar-right">
                <a href="/income-expense" class="add-btn">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Transaction</span>
                </a>
                <button class="icon-btn" id="themeButton" aria-label="Toggle dark mode"><i class="fa-solid fa-moon"></i></button>

                <a href="/profile" class="user-mini">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}</div>
                    <span>{{ auth()->user()->name ?? 'Student' }}</span>
                </a>
            </div>
        </header>

        <section class="content">

            <div class="page-heading">
                <h1>Welcome back, {{ auth()->user()->name ?? 'Student' }} 👋</h1>
                <p>Here's an overview of your student finances.</p>
            </div>

            {{-- ======================= STAT CARDS (DYNAMIC) ======================= --}}
            <div class="stats-grid">

                {{-- Total Income --}}
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon income"><i class="fa-solid fa-arrow-down"></i></span>
                        <span class="stat-change {{ $incomeChange >= 0 ? 'income' : 'expense' }}">
                            <i class="fa-solid {{ $incomeChange >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                            {{ abs($incomeChange) }}%
                        </span>
                    </div>
                    <h3>₨{{ number_format($totalIncome, 0) }}</h3>
                    <p>Total Income</p>
                </div>

                {{-- Total Expenses --}}
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon expense"><i class="fa-solid fa-arrow-up"></i></span>
                        <span class="stat-change {{ $expenseChange <= 0 ? 'income' : 'expense' }}">
                            <i class="fa-solid {{ $expenseChange >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                            {{ abs($expenseChange) }}%
                        </span>
                    </div>
                    <h3>₨{{ number_format($totalExpense, 0) }}</h3>
                    <p>Total Expenses</p>
                </div>

                {{-- Current Balance --}}
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon balance"><i class="fa-solid fa-wallet"></i></span>
                        <span class="stat-change {{ $currentBalance >= 0 ? 'income' : 'expense' }}">
                            <i class="fa-solid {{ $currentBalance >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                            {{ $currentBalance >= 0 ? 'Positive' : 'Negative' }}
                        </span>
                    </div>
                    <h3>₨{{ number_format($currentBalance, 0) }}</h3>
                    <p>Current Balance</p>
                </div>

                {{-- Budget Remaining --}}
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon warning"><i class="fa-solid fa-bullseye"></i></span>
                        <span class="stat-change warning">{{ $budgetPercentUsed }}% used</span>
                    </div>
                    <h3>₨{{ number_format($budgetRemaining, 0) }}</h3>
                    <p>Budget Remaining</p>
                </div>
            </div>

            {{-- ======================= QUICK ADD ======================= --}}
            <div class="quick-add">
                <span class="quick-add-label">Quick add:</span>

                <button type="button" class="quick-btn expense" data-quick data-type="expense">
                    <i class="fa-solid fa-arrow-up"></i> Expense
                </button>
                <button type="button" class="quick-btn income" data-quick data-type="income">
                    <i class="fa-solid fa-arrow-down"></i> Income
                </button>

                @if($quickCategories->isNotEmpty())
                    <span class="quick-sep"></span>
                @endif

                @foreach($quickCategories as $qc)
                    <button type="button" class="quick-btn {{ $qc->type }}"
                            data-quick data-type="{{ $qc->type }}" data-category="{{ $qc->id }}">
                        <i class="fa-solid fa-plus"></i> {{ $qc->name }}
                    </button>
                @endforeach
            </div>

            <div class="dashboard-grid">

                {{-- ======================= INCOME vs EXPENSE CHART (PURE CSS — NO JS LIBRARY) ======================= --}}
                <div class="card">
                    <div class="card-header">
                        <h2>Monthly Income vs Expenses</h2>
                        <a href="/report-insights">View Reports <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    <div class="chart-wrap">
                        @php
                            $maxAmount = collect($monthlyIncome)->pluck('amount')
                                ->merge(collect($monthlyExpenses)->pluck('amount'))
                                ->max();
                        @endphp

                        @if(!$maxAmount || $maxAmount == 0)
                            <div class="chart-empty">
                                No transactions recorded in the last 6 months yet.
                            </div>
                        @else
                            <div class="chart-legend">
                                <span><i class="dot income"></i> Income</span>
                                <span><i class="dot expense"></i> Expenses</span>
                            </div>

                            <div class="bar-chart">
                                @foreach($monthlyIncome as $i => $monthData)
                                    @php
                                        $incomeAmount  = $monthData['amount'];
                                        $expenseAmount = $monthlyExpenses[$i]['amount'] ?? 0;
                                        $incomeHeight  = $maxAmount > 0 ? max(($incomeAmount / $maxAmount) * 100, ($incomeAmount > 0 ? 4 : 0)) : 0;
                                        $expenseHeight = $maxAmount > 0 ? max(($expenseAmount / $maxAmount) * 100, ($expenseAmount > 0 ? 4 : 0)) : 0;
                                    @endphp
                                    <div class="bar-month">
                                        <div class="bar-pair">
                                            <div class="bar income"
                                                 style="height: {{ $incomeHeight }}%"
                                                 title="Income: ₨{{ number_format($incomeAmount, 0) }}"></div>
                                            <div class="bar expense"
                                                 style="height: {{ $expenseHeight }}%"
                                                 title="Expenses: ₨{{ number_format($expenseAmount, 0) }}"></div>
                                        </div>
                                        <div class="bar-month-label">{{ $monthData['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ======================= RECENT TRANSACTIONS (DYNAMIC) ======================= --}}
                <div class="card">
                    <div class="card-header">
                        <h2>Recent Transactions</h2>
                        <a href="/income-expense">View All <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    <div class="transaction-list">
                        @forelse($recentTransactions as $tx)
                            @php
                                $catName = strtolower($tx->category->name ?? '');

                                $icon = match(true) {
                                    str_contains($catName, 'food') => 'fa-utensils',
                                    str_contains($catName, 'book') => 'fa-book',
                                    str_contains($catName, 'transport') => 'fa-bus',
                                    str_contains($catName, 'rent'), str_contains($catName, 'hostel') => 'fa-house',
                                    str_contains($catName, 'subscription') => 'fa-rotate',
                                    str_contains($catName, 'allowance') => 'fa-sack-dollar',
                                    str_contains($catName, 'job') => 'fa-briefcase',
                                    str_contains($catName, 'scholarship') => 'fa-graduation-cap',
                                    str_contains($catName, 'gift') => 'fa-gift',
                                    str_contains($catName, 'academic') => 'fa-book-open',
                                    str_contains($catName, 'entertainment') => 'fa-film',
                                    default => $tx->type === 'income' ? 'fa-sack-dollar' : 'fa-receipt',
                                };

                                $date = $tx->transaction_date;
                                $dateLabel = $date->isToday()
                                    ? 'Today'
                                    : ($date->isYesterday() ? 'Yesterday' : $date->format('d M'));
                            @endphp

                            <div class="transaction">
                                <div class="transaction-info">
                                    <div class="transaction-icon {{ $tx->type }}"><i class="fa-solid {{ $icon }}"></i></div>
                                    <div>
                                        <div class="transaction-name">{{ $tx->category->name ?? 'Uncategorized' }}</div>
                                        <div class="transaction-date">{{ $dateLabel }}</div>
                                    </div>
                                </div>
                                <div class="amount {{ $tx->type }}">
                                    {{ $tx->type === 'income' ? '+' : '-' }}₨{{ number_format($tx->amount, 0) }}
                                </div>
                            </div>
                        @empty
                            <p style="color:var(--text-muted); font-size:13px; padding: 10px 6px;">
                                No transactions yet. <a href="/income-expense" style="color:var(--primary); font-weight:600;">Add your first one</a>.
                            </p>
                        @endforelse
                    </div>

                    {{-- ======================= BUDGET PROGRESS (DYNAMIC) ======================= --}}
                    <div class="budget-block">
                        <div class="budget-row">
                            <span>Monthly budget used</span>
                            <strong>₨{{ number_format($budgetSpent, 0) }} / ₨{{ number_format($budgetLimit, 0) }}</strong>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: {{ min($budgetPercentUsed, 100) }}%"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="insights-grid">

                {{-- ======================= TOP CATEGORIES ======================= --}}
                <div class="card">
                    <div class="card-header">
                        <h2>Top Spending Categories</h2>
                        <a href="/report-insights">Details <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    @forelse($topCategories as $cat)
                        <div class="top-cat {{ $loop->first ? 'first' : '' }}">
                            <div class="top-cat-row">
                                <strong>{{ $loop->first ? '🔥 ' : '' }}{{ $cat['name'] }}</strong>
                                <span>₨{{ number_format($cat['total'], 0) }} · {{ $cat['percent'] }}%</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: {{ $cat['percent'] }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p style="color:var(--text-muted); font-size:13px; margin:0;">
                            No expenses recorded this month yet.
                        </p>
                    @endforelse
                </div>

                {{-- ======================= SMART TIPS ======================= --}}
                <div class="card">
                    <div class="card-header">
                        <h2>Smart Tips</h2>
                        <a href="/saving-tips">More tips <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    @foreach($tips as $tip)
                        <div class="tip {{ $tip['type'] }}">
                            <i class="fa-solid {{ $tip['icon'] }}"></i>
                            <span>{{ $tip['text'] }}</span>
                        </div>
                    @endforeach
                </div>

            </div>

        </section>
    </main>

</div>

<!-- ======================= QUICK ADD MODAL ======================= -->
<div class="qa-overlay" id="quickModal">
    <div class="qa-modal">

        <div class="qa-head">
            <h2>Quick Add</h2>
            <button type="button" class="qa-close" id="quickClose" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="qa-field">
                <label for="qa_type">Type</label>
                <select id="qa_type" name="type" required>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>
            </div>

            <div class="qa-field">
                <label for="qa_category">Category</label>
                <select id="qa_category" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="qa-field">
                <label for="qa_amount">Amount (₨)</label>
                <input type="number" id="qa_amount" name="amount" min="0.01" max="99999999.99" step="0.01" placeholder="e.g. 500" required>
            </div>

            <div class="qa-field">
                <label for="qa_description">Description</label>
                <input type="text" id="qa_description" name="description" maxlength="255" placeholder="e.g. Lunch" required>
            </div>

            <div class="qa-field">
                <label for="qa_date">Date</label>
                <input type="date" id="qa_date" name="transaction_date" value="{{ now()->format('Y-m-d') }}" required>
            </div>

            <div class="qa-actions">
                <button type="button" class="qa-cancel" id="quickCancel">Cancel</button>
                <button type="submit" class="add-btn"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
        </form>

    </div>
</div>

<script>
    // ---- Theme ----
    const root = document.documentElement;
    const themeBtn = document.getElementById('themeButton');
    const themeIcon = themeBtn.querySelector('i');
    const savedTheme = localStorage.getItem('cc-theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    function applyTheme(theme) {
        root.setAttribute('data-theme', theme);
        themeIcon.classList.toggle('fa-moon', theme !== 'dark');
        themeIcon.classList.toggle('fa-sun', theme === 'dark');
    }

    applyTheme(savedTheme || (prefersDark ? 'dark' : 'light'));

    themeBtn.addEventListener('click', () => {
        const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        applyTheme(next);
        localStorage.setItem('cc-theme', next);
    });

    // ---- Mobile sidebar ----
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    document.getElementById('menuButton').addEventListener('click', () => {
        sidebar.classList.add('open');
        overlay.classList.add('show');
    });
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });

    // ---- Quick add modal ----
    const qModal   = document.getElementById('quickModal');
    const qType    = document.getElementById('qa_type');
    const qCat     = document.getElementById('qa_category');
    const qAmount  = document.getElementById('qa_amount');

    function qFilterCategories() {
        let valid = false;
        qCat.querySelectorAll('option[data-type]').forEach(opt => {
            const ok = opt.dataset.type === qType.value;
            opt.hidden = !ok;
            opt.disabled = !ok;
            if (ok && opt.value === qCat.value) valid = true;
        });
        if (!valid) qCat.value = '';
    }

    function qOpen(type, category) {
        qType.value = type || 'expense';
        qFilterCategories();
        qCat.value = category || '';
        qModal.classList.add('show');
        qAmount.focus();
    }

    function qClose() { qModal.classList.remove('show'); }

    document.querySelectorAll('[data-quick]').forEach(btn => {
        btn.addEventListener('click', () => qOpen(btn.dataset.type, btn.dataset.category));
    });

    qType.addEventListener('change', qFilterCategories);
    document.getElementById('quickClose').addEventListener('click', qClose);
    document.getElementById('quickCancel').addEventListener('click', qClose);
    qModal.addEventListener('click', e => { if (e.target === qModal) qClose(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') qClose(); });
</script>

</body>
</html>