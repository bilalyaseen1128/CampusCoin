<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Campus Coin - Budget Goals & Alerts</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --navy-950: #5b3fd6;
            --navy-900: #6546e8;
            --navy-800: #7c5cff;
            --navy-700: #9b83ff;

            --mint-600: #7c5cff;
            --mint-500: #7c5cff;
            --mint-400: #9b83ff;
            --mint-100: rgba(124, 92, 255, 0.12);

            --page: #f5f6fa;
            --page-alt: #f8f9fc;
            --card: #ffffff;

            --text: #171923;
            --muted: #737887;
            --border: #e5e7eb;

            --warning: #f59e0b;
            --warning-bg: rgba(245, 158, 11, 0.12);

            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.12);

            --shadow: 0 10px 30px rgba(20, 20, 40, 0.07);
            --shadow-soft: 0 6px 18px rgba(20, 20, 40, 0.05);

            --navbar: var(--card);
            --primary: var(--mint-600);
            --primary-light: var(--mint-400);
            --surface-2: var(--page-alt);
            --text-light: var(--muted);
            --expense: var(--danger);

            --transition: 0.25s ease;
        }

        body.dark {
            --page: #0f1117;
            --page-alt: #20242f;
            --card: #181b24;

            --text: #f5f7fa;
            --muted: #a7adba;
            --border: #303542;

            --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            --shadow-soft: 0 8px 22px rgba(0, 0, 0, 0.24);

            --navbar: var(--card);
            --primary: var(--mint-600);
            --primary-light: var(--mint-400);
            --surface-2: var(--page-alt);
            --text-light: var(--muted);
            --expense: var(--danger);
        }

        body.dark {
            --page: #0a0f1e;
            --page-alt: #0d1526;
            --card: #111a2e;
            --text: #eef1f8;
            --muted: #8a96b3;
            --border: #202c49;

            --mint-100: #16233f;
            --mint-400: #60a5fa;
            --mint-600: #3b82f6;
            --mint-500: #3b82f6;

            --warning: #fbbf24;
            --warning-bg: #3a2b0c;

            --danger: #f87171;
            --danger-bg: #3a1717;

            --shadow: 0 18px 42px rgba(0, 0, 0, 0.24);
            --shadow-soft: 0 8px 22px rgba(0, 0, 0, 0.2);

            --navbar: var(--card);
            --primary: var(--mint-600);
            --primary-light: var(--mint-400);
            --surface-2: var(--page-alt);
            --text-light: var(--muted);
            --expense: var(--danger);
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: env(safe-area-inset-top, 0px);
        }

        body {
            margin: 0;
            background: var(--page);
            color: var(--text);
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.5;
            overflow-x: hidden;
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
            transition: background .25s ease, color .25s ease;
        }

        button, input, select { font: inherit; }
        button { cursor: pointer; }
        a { color: inherit; text-decoration: none; }

        .container {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
        }

        /* Hero */

        .hero {
            background: linear-gradient(135deg, var(--navy-950), var(--navy-800));
            color: #ffffff;
            padding: 76px 0 72px;
        }

        .hero-inner {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-copy { max-width: 720px; }

        .eyebrow {
            margin: 0 0 7px;
            color: var(--mint-600);
            font-size: 0.73rem;
            font-weight: 850;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .hero .eyebrow { color: var(--mint-400); }

        h1, h2, h3, p { margin-top: 0; }

        h1 {
            margin-bottom: 14px;
            font-size: clamp(2.35rem, 5vw, 4rem);
            line-height: 1.02;
            letter-spacing: -0.045em;
        }

        h2 {
            margin-bottom: 0;
            font-size: clamp(1.45rem, 2.5vw, 1.9rem);
            line-height: 1.2;
            letter-spacing: -0.03em;
        }

        h3 { margin-bottom: 6px; }

        .hero-copy > p:last-child {
            max-width: 650px;
            margin-bottom: 0;
            color: #cbd9e0;
        }

        /* Buttons */

        .primary-btn,
        .secondary-btn {
            min-height: 45px;
            border-radius: 9px;
            padding: 10px 17px;
            font-weight: 800;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }

        .primary-btn {
            border: 1px solid var(--mint-500);
            background: var(--mint-500);
            color: #ffffff;
        }

        .primary-btn:hover {
            background: var(--navy-800);
            transform: translateY(-1px);
        }

        .secondary-btn {
            border: 1px solid var(--border);
            background: var(--card);
            color: var(--text);
        }

        .secondary-btn:hover {
            border-color: var(--mint-500);
            transform: translateY(-1px);
        }

        .hero-btn { min-width: 160px; }

        /* Sections */

        .summary-section,
        .setup-section,
        .budgets-section,
        .alerts-section {
            padding: 60px 0;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 25px;
        }

        .section-note,
        .section-description {
            color: var(--muted);
            font-size: 0.88rem;
        }

        .section-note { margin: 0; }

        .section-description {
            margin: 8px 0 0;
            max-width: 680px;
        }

        /* Summary */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .summary-card {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: var(--card);
            box-shadow: var(--shadow-soft);
        }

        .summary-icon {
            width: 39px;
            height: 39px;
            flex: 0 0 39px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: var(--mint-100);
            color: var(--navy-800);
            font-size: 15px;
        }

        body.dark .summary-icon { color: var(--mint-400); }

        .summary-card span,
        .summary-card small { display: block; }

        .summary-card span {
            color: var(--muted);
            font-size: 0.77rem;
            font-weight: 700;
        }

        .summary-card strong {
            display: block;
            margin: 3px 0 2px;
            color: var(--text);
            font-size: 1.5rem;
        }

        .summary-card small {
            color: var(--muted);
            font-size: 0.7rem;
        }

        /* Overview */

        .overview-panel {
            display: grid;
            grid-template-columns: 1fr 310px;
            gap: 30px;
            margin-top: 18px;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
            box-shadow: var(--shadow-soft);
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            margin-bottom: 18px;
        }

        .panel-heading h3 { margin: 0; }

        .panel-heading > strong {
            color: var(--mint-600);
            font-size: 1.25rem;
        }

        .progress-track {
            width: 100%;
            height: 9px;
            overflow: hidden;
            border-radius: 999px;
            background: color-mix(in srgb, var(--border) 80%, transparent);
        }

        .progress-track.large { height: 11px; }

        .progress-fill {
            width: 0;
            height: 100%;
            border-radius: inherit;
            background: var(--mint-500);
            transition: width 0.3s ease;
        }

        .progress-fill.warning { background: var(--warning); }
        .progress-fill.exceeded { background: var(--danger); }

        .overview-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .overview-details div {
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .overview-details span {
            display: block;
            color: var(--muted);
            font-size: 0.72rem;
        }

        .overview-details strong {
            display: block;
            margin-top: 4px;
            font-size: 0.98rem;
        }

        /* Setup */

        .setup-section {
            background: var(--page-alt);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .budget-form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            align-items: end;
            gap: 18px;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
            box-shadow: var(--shadow);
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field label {
            color: var(--text);
            font-size: 0.84rem;
            font-weight: 800;
        }

        .field input,
        .field select {
            width: 100%;
            min-height: 46px;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 10px 12px;
            outline: none;
            background: var(--card);
            color: var(--text);
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--mint-500);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
        }

        .money-input {
            display: flex;
            align-items: center;
            min-height: 46px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--card);
        }

        .money-input span {
            padding: 0 11px;
            color: var(--muted);
            font-weight: 800;
        }

        .money-input input {
            min-height: 44px;
            border: 0;
            border-left: 1px solid var(--border);
            border-radius: 0;
        }

        .money-input input:focus { box-shadow: none; }

        .form-message {
            min-height: 20px;
            margin: 10px 0 0;
            color: var(--danger);
            font-size: 0.83rem;
            font-weight: 700;
        }

        .form-message.success { color: var(--mint-600); }

        /* Budget Cards */

        .budgets-section { background: var(--page); }

        .budget-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .budget-card {
            padding: 24px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
            box-shadow: var(--shadow);
        }

        .budget-card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 15px;
        }

        .category-name {
            margin-bottom: 3px;
            font-size: 1.22rem;
        }

        .budget-limit {
            color: var(--muted);
            font-size: 0.81rem;
        }

        .status-badge {
            border-radius: 999px;
            padding: 5px 10px;
            background: var(--mint-100);
            color: var(--navy-800);
            font-size: 0.7rem;
            font-weight: 850;
            white-space: nowrap;
        }

        body.dark .status-badge { color: var(--mint-400); }

        .status-badge.warning {
            background: var(--warning-bg);
            color: #8b5c0b;
        }

        body.dark .status-badge.warning { color: #f4c96b; }

        .status-badge.exceeded {
            background: var(--danger-bg);
            color: #a52e43;
        }

        body.dark .status-badge.exceeded { color: #ff91a3; }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 22px 0 19px;
        }

        .stat {
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: color-mix(in srgb, var(--page) 35%, var(--card));
        }

        .stat span {
            display: block;
            color: var(--muted);
            font-size: 0.73rem;
            margin-bottom: 4px;
        }

        .stat strong { font-size: 1.03rem; }

        .progress-label {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 750;
        }

        .spending-form {
            display: flex;
            gap: 9px;
            margin-top: 20px;
        }

        .spending-form input {
            min-width: 0;
            flex: 1;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 10px;
            outline: none;
            background: var(--card);
            color: var(--text);
        }

        .spending-form input:focus { border-color: var(--mint-500); }

        .small-btn {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 12px;
            background: var(--card);
            color: var(--text);
            font-weight: 750;
        }

        .small-btn:hover { border-color: var(--mint-500); }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .card-actions .small-btn { flex: 1; }

        .delete-btn:hover {
            color: var(--danger);
            border-color: var(--danger);
        }

        .count-label {
            color: var(--muted);
            font-size: 0.84rem;
            font-weight: 750;
        }

        /* Empty States */

        .empty-state,
        .empty-alerts {
            padding: 44px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
            box-shadow: var(--shadow-soft);
            text-align: center;
        }

        .empty-icon,
        .check-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            margin: 0 auto 13px;
            border-radius: 13px;
            background: var(--mint-100);
            color: var(--mint-600);
            font-size: 1.2rem;
        }

        .empty-state p,
        .empty-alerts p { color: var(--muted); }

        /* Alerts */

        .alerts-section {
            background: var(--page-alt);
            border-top: 1px solid var(--border);
        }

        .alert-info-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 16px;
            padding: 15px 17px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
        }

        .alert-info-strip strong,
        .alert-info-strip span { display: block; }

        .alert-info-strip span {
            color: var(--muted);
            font-size: 0.79rem;
        }

        .alert-status {
            padding: 5px 9px;
            border-radius: 999px;
            background: var(--mint-100);
            color: var(--mint-600) !important;
            font-weight: 800;
            white-space: nowrap;
        }

        .alert-list {
            display: grid;
            gap: 12px;
        }

        .alert-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 17px 18px;
            border: 1px solid var(--border);
            border-left: 4px solid var(--mint-500);
            border-radius: 13px;
            background: var(--card);
            box-shadow: var(--shadow-soft);
        }

        .alert-item.warning { border-left-color: var(--warning); }
        .alert-item.exceeded { border-left-color: var(--danger); }

        .alert-copy strong {
            display: block;
            margin-bottom: 2px;
        }

        .alert-copy span {
            color: var(--muted);
            font-size: 0.84rem;
        }

        .dismiss-btn {
            border: 0;
            background: transparent;
            color: var(--muted);
            font-weight: 750;
            white-space: nowrap;
        }

        .dismiss-btn:hover { color: var(--text); }

        .danger-outline { color: var(--danger); }

        /* Footer */

        .site-footer {
            padding: 31px 0 18px;
            background: var(--navy-950);
            color: #ffffff;
            padding-bottom: calc(18px + env(safe-area-inset-bottom, 0px));
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
        }

        .footer-brand {
            color: var(--mint-400);
            font-size: 1.1rem;
        }

        .site-footer p {
            margin: 3px 0 0;
            color: #9fb1bc;
            font-size: 0.82rem;
        }

        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 19px;
        }

        .footer-links a {
            color: #c6d5dc;
            font-size: 0.83rem;
            font-weight: 700;
        }

        .footer-links a:hover { color: var(--mint-400); }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 22px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #8297a4;
            font-size: 0.73rem;
        }

        /* Modal */

        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(3, 14, 24, 0.72);
        }

        .modal-backdrop.open { display: flex; }

        .modal {
            width: min(500px, 100%);
            max-height: calc(100vh - 40px);
            overflow: auto;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 17px;
            background: var(--card);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
        }

        .modal-header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .modal-header h2 { margin-bottom: 5px; }

        .modal-header p:last-child {
            margin: 0;
            color: var(--muted);
            font-size: 0.82rem;
        }

        .close-btn {
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--card);
            color: var(--text);
            font-size: 1rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn:hover {
            border-color: var(--mint-500);
            color: var(--mint-600);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 7px;
        }

        body:not(.dark) .summary-card,
        body:not(.dark) .overview-panel,
        body:not(.dark) .budget-form,
        body:not(.dark) .budget-card,
        body:not(.dark) .alert-item,
        body:not(.dark) .empty-state,
        body:not(.dark) .empty-alerts {
            border-color: rgba(37, 99, 235, 0.18);
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.06), 0 10px 30px rgba(16, 24, 40, 0.08);
            backdrop-filter: blur(8px);
        }

        .hidden { display: none !important; }

        @media (max-width: 950px) {
            .summary-grid { grid-template-columns: repeat(2, 1fr); }
            .overview-panel { grid-template-columns: 1fr; }
            .budget-form { grid-template-columns: 1fr 1fr; }
            .form-btn { grid-column: 1 / -1; }
        }

        @media (max-width: 760px) {
            .container { width: min(100% - 28px, 1120px); }
            .hero { padding: 55px 0 48px; }

            .hero-inner,
            .section-heading,
            .footer-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero-btn { width: 100%; }

            .summary-section,
            .setup-section,
            .budgets-section,
            .alerts-section {
                padding: 44px 0;
            }

            .summary-grid,
            .budget-grid,
            .budget-form {
                grid-template-columns: 1fr;
            }

            .form-btn { grid-column: auto; }
            .budget-form { padding: 20px; }
            .overview-details { grid-template-columns: 1fr; }

            .alert-info-strip,
            .footer-bottom {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .stats-row { grid-template-columns: 1fr; }

            .spending-form,
            .card-actions {
                flex-direction: column;
            }

            .alert-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .modal-actions { flex-direction: column-reverse; }
            .modal-actions button { width: 100%; }

            .empty-state,
            .empty-alerts { padding: 32px 20px; }
        }
    </style>
</head>

<body>

    @include('nav')

    @php
        // Default categories (no owner) + the user's own custom categories
        $defaultCategories = $categories->whereNull('user_id');
        $customCategories  = $categories->whereNotNull('user_id');
    @endphp

    <main id="top">

        <!-- HERO -->
        <section class="hero">
            <div class="container hero-inner">

                <div class="hero-copy">
                    <p class="eyebrow">Monthly Financial Planner</p>
                    <h1>Budget Goals & Alerts</h1>
                    <p>Plan your monthly spending, monitor every category, and stay aware of your budget limits.</p>
                </div>

                <button class="primary-btn hero-btn" id="openBudgetModal" type="button">
                    Add New Budget
                </button>

            </div>
        </section>


        <!-- SUMMARY -->
        <section class="summary-section" id="overview">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">At a Glance</p>
                        <h2>Monthly overview</h2>
                    </div>
                    <p class="section-note">Your budget data is saved in your Campus Coin database.</p>
                </div>

                <div class="summary-grid">

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-wallet"></i></div>
                        <div>
                            <span>Total Monthly Budget</span>
                            <strong id="totalBudget">₨0.00</strong>
                            <small>Across all categories</small>
                        </div>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                        <div>
                            <span>Amount Spent</span>
                            <strong id="totalSpent">₨0.00</strong>
                            <small>Recorded spending</small>
                        </div>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-piggy-bank"></i></div>
                        <div>
                            <span>Total Remaining</span>
                            <strong id="totalRemaining">₨0.00</strong>
                            <small>Available to spend</small>
                        </div>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        <div>
                            <span>Budget Usage</span>
                            <strong id="totalUsage">0%</strong>
                            <small>Overall monthly usage</small>
                        </div>
                    </article>

                </div>

                <div class="overview-panel">

                    <div>
                        <div class="panel-heading">
                            <div>
                                <p class="eyebrow">Spending Health</p>
                                <h3>Overall budget progress</h3>
                            </div>
                            <strong id="overviewUsageLabel">0%</strong>
                        </div>

                        <div class="progress-track large">
                            <div class="progress-fill" id="overviewProgress"></div>
                        </div>
                    </div>

                    <div class="overview-details">
                        <div>
                            <span>Budgeted</span>
                            <strong id="overviewBudget">₨0.00</strong>
                        </div>
                        <div>
                            <span>Spent</span>
                            <strong id="overviewSpent">₨0.00</strong>
                        </div>
                        <div>
                            <span>Remaining</span>
                            <strong id="overviewRemaining">₨0.00</strong>
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- SETUP -->
        <section class="setup-section" id="setup">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Monthly Budget Setup</p>
                        <h2>Set a category budget</h2>
                        <p class="section-description">
                            Create a spending limit for each part of your monthly budget.
                        </p>
                    </div>

                    <button class="secondary-btn" id="openBudgetModalAlt" type="button">
                        Open Budget Setup
                    </button>
                </div>

                <form class="budget-form" id="budgetForm" method="POST" action="{{ route('budgets.store') }}">

                    @csrf

                    <div class="field">
                        <label for="category">Select Category</label>

                        <select id="category" name="category_id" required>
                            <option value="">Choose category</option>

                            @if ($defaultCategories->isNotEmpty())
                                <optgroup label="Default categories">
                                    @foreach ($defaultCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endif

                            @if ($customCategories->isNotEmpty())
                                <optgroup label="My categories">
                                    @foreach ($customCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                    </div>

                    <div class="field">
                        <label for="budgetAmount">Enter Budget Amount</label>

                        <div class="money-input">
                            <span>₨</span>
                            <input id="budgetAmount" name="limit_amount" type="number" min="0.01" step="0.01" placeholder="3000.00" required>
                        </div>
                    </div>

                    <button class="primary-btn form-btn" type="submit">Save Budget</button>

                </form>

                <p class="form-message" id="formMessage"></p>

            </div>
        </section>


        <!-- BUDGETS -->
        <section class="budgets-section" id="budgets">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Budget Overview</p>
                        <h2>Your monthly categories</h2>
                        <p class="section-description">
                            Track what you planned, what you spent, and what is still available.
                        </p>
                    </div>

                    <span class="count-label" id="budgetCount">
                        {{ $budgets->count() }}
                        {{ $budgets->count() === 1 ? 'category' : 'categories' }}
                    </span>
                </div>

                <div class="budget-grid" id="budgetList">

                    @forelse($budgets as $budget)

                        @php
                            $limit = (float) $budget->limit_amount;
                            $manualSpent = (float) ($budget->amount_spent ?? 0);
                            $txSpent = (float) ($budget->tx_spent ?? 0);
                            $spent = $manualSpent + $txSpent;
                            $remaining = $limit - $spent;

                            $usage = $limit > 0 ? round(($spent / $limit) * 100) : 0;

                            if ($usage >= 100) {
                                $status = 'exceeded';
                                $statusLabel = 'Exceeded';
                            } elseif ($usage >= 80) {
                                $status = 'warning';
                                $statusLabel = 'Near limit';
                            } else {
                                $status = 'ok';
                                $statusLabel = 'On track';
                            }
                        @endphp

                        <article
                            class="budget-card"
                            data-id="{{ $budget->id }}"
                            data-category="{{ $budget->category->name }}"
                            data-category-id="{{ $budget->category_id }}"
                            data-limit="{{ $limit }}"
                            data-spent="{{ $spent }}"
                        >

                            <div class="budget-card-header">
                                <div>
                                    <h3 class="category-name">{{ $budget->category->name }}</h3>
                                    <p class="budget-limit">Monthly limit ₨{{ number_format($limit, 2) }}</p>
                                </div>

                                <span class="status-badge {{ $status === 'ok' ? '' : $status }}">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <div class="stats-row">
                                <div class="stat">
                                    <span>Spent</span>
                                    <strong>₨{{ number_format($spent, 2) }}</strong>
                                    @if ($txSpent > 0)
                                        <small style="display:block;margin-top:3px;color:var(--muted);font-size:.68rem;">
                                            ₨{{ number_format($txSpent, 2) }} from transactions
                                        </small>
                                    @endif
                                </div>

                                <div class="stat">
                                    <span>Remaining</span>
                                    <strong>₨{{ number_format($remaining, 2) }}</strong>
                                </div>
                            </div>

                            <div class="progress-label">
                                <span>Progress</span>
                                <span>{{ $usage }}%</span>
                            </div>

                            <div class="progress-track">
                                <div class="progress-fill {{ $status === 'ok' ? '' : $status }}" style="width: {{ min($usage, 100) }}%"></div>
                            </div>

                            <form class="spending-form" data-action="add-spending">
                                <input type="number" min="0.01" step="0.01" placeholder="Log cash spending, e.g. 150" required>
                                <button class="small-btn" type="submit">Add</button>
                            </form>

                            <div class="card-actions">
                                <button class="small-btn" type="button" data-action="edit">Edit</button>
                                <button class="small-btn delete-btn" type="button" data-action="delete">Delete</button>
                            </div>

                        </article>

                    @empty

                        <div class="empty-state" id="emptyState" style="display: block; grid-column: 1 / -1;">

                            <div class="empty-icon"><i class="fa-solid fa-plus"></i></div>

                            <h3>No budgets yet</h3>

                            <p>Add a category budget to start tracking your monthly spending.</p>

                            <button class="secondary-btn" id="emptyAddBtn" type="button">Create Budget</button>

                        </div>

                    @endforelse

                </div>

            </div>
        </section>


        <!-- ALERTS -->
        <section class="alerts-section" id="alerts">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Budget Alerts</p>
                        <h2>Stay within your limits</h2>
                        <p class="section-description">
                            Campus Coin automatically checks your spending and highlights categories that need attention.
                        </p>
                    </div>

                    <button class="secondary-btn danger-outline" id="clearAlerts" type="button">
                        Clear Alerts
                    </button>
                </div>

                <div class="alert-info-strip">
                    <div>
                        <strong>Alert thresholds</strong>
                        <span>Near Budget Limit at 80% · Exceeded Budget at 100%</span>
                    </div>

                    <span class="alert-status">Automatic</span>
                </div>

                <div class="alert-list" id="alertList"></div>

                <div class="empty-alerts" id="emptyAlerts">
                    <div class="check-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <h3>Everything looks clear</h3>
                    <p>No active budget alerts right now.</p>
                </div>

            </div>
        </section>

    </main>


    <!-- FOOTER -->
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

    <!-- MODAL -->
    <div class="modal-backdrop" id="budgetModal" aria-hidden="true">

        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">

            <div class="modal-header">

                <div>
                    <p class="eyebrow">Budget Setup</p>
                    <h2 id="modalTitle">Add New Budget</h2>
                    <p>Create or update a monthly spending limit.</p>
                </div>

                <button class="close-btn" id="closeModal" type="button" aria-label="Close modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

            <form id="modalBudgetForm">

                @csrf

                <input type="hidden" id="editingId">

                <div class="field">
                    <label for="modalCategory">Select Category</label>

                    <select id="modalCategory" required>
                        <option value="">Choose category</option>

                        @if ($defaultCategories->isNotEmpty())
                            <optgroup label="Default categories">
                                @foreach ($defaultCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif

                        @if ($customCategories->isNotEmpty())
                            <optgroup label="My categories">
                                @foreach ($customCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                </div>

                <div class="field" style="margin-top: 18px;">
                    <label for="modalAmount">Budget Amount</label>

                    <div class="money-input">
                        <span>₨</span>
                        <input id="modalAmount" type="number" min="0.01" step="0.01" placeholder="3000.00" required>
                    </div>
                </div>

                <p class="form-message" id="modalMessage"></p>

                <div class="modal-actions">
                    <button class="secondary-btn" id="cancelModal" type="button">Cancel</button>
                    <button class="primary-btn" type="submit" id="modalSubmit">Save Budget</button>
                </div>

            </form>

        </div>

    </div>


    @php
        $budgetsForJs = $budgets->map(function ($b) {
            return [
                'id' => $b->id,
                'category_id' => $b->category_id,
                'category' => $b->category->name,
                'limit_amount' => $b->limit_amount,
                'amount_spent' => $b->amount_spent,
                'tx_spent' => $b->tx_spent ?? 0,
            ];
        })->values();
    @endphp

    <script>
        (function () {

            "use strict";

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            const budgets = @json($budgetsForJs);

            const WARNING_THRESHOLD = 80;

            const money = function (value) {
                const number = Number(value) || 0;

                return "₨" + number.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            };

            const getUsage = function (spent, limit) {
                if (limit <= 0) {
                    return 0;
                }

                return Math.round((spent / limit) * 100);
            };

            const getStatus = function (spent, limit) {
                const usage = getUsage(spent, limit);

                if (usage >= 100) {
                    return "exceeded";
                }

                if (usage >= WARNING_THRESHOLD) {
                    return "warning";
                }

                return "ok";
            };

            const getStatusLabel = function (status) {
                if (status === "exceeded") {
                    return "Exceeded";
                }

                if (status === "warning") {
                    return "Near limit";
                }

                return "On track";
            };

            const setMessage = function (element, message, error) {
                element.textContent = message || "";
                element.classList.toggle("success", !error && !!message);
            };

            // Total spent = manually logged spending + expense transactions of this month
            const spentOf = function (budget) {
                return (Number(budget.amount_spent) || 0) + (Number(budget.tx_spent) || 0);
            };

            const findBudget = function (id) {
                return budgets.find(function (item) {
                    return Number(item.id) === Number(id);
                });
            };

            const readError = async function (response, fallback) {
                const data = await response.json().catch(function () {
                    return {};
                });

                let message = fallback;

                if (data.message) {
                    message = data.message;
                }

                if (data.errors) {
                    const firstError = Object.values(data.errors)[0];

                    if (firstError && firstError[0]) {
                        message = firstError[0];
                    }
                }

                return new Error(message);
            };


            /* =========================
               SUMMARY
            ========================= */

            function renderSummary() {

                let totalBudget = 0;
                let totalSpent = 0;

                budgets.forEach(function (budget) {
                    totalBudget += Number(budget.limit_amount) || 0;
                    totalSpent += spentOf(budget);
                });

                const remaining = totalBudget - totalSpent;
                const usage = getUsage(totalSpent, totalBudget);

                document.getElementById("totalBudget").textContent = money(totalBudget);
                document.getElementById("totalSpent").textContent = money(totalSpent);
                document.getElementById("totalRemaining").textContent = money(remaining);
                document.getElementById("totalUsage").textContent = usage + "%";

                document.getElementById("overviewUsageLabel").textContent = usage + "%";
                document.getElementById("overviewBudget").textContent = money(totalBudget);
                document.getElementById("overviewSpent").textContent = money(totalSpent);
                document.getElementById("overviewRemaining").textContent = money(remaining);

                const progress = document.getElementById("overviewProgress");

                progress.style.width = Math.min(usage, 100) + "%";
                progress.classList.remove("warning", "exceeded");

                const status = getStatus(totalSpent, totalBudget);

                if (status === "warning") {
                    progress.classList.add("warning");
                }

                if (status === "exceeded") {
                    progress.classList.add("exceeded");
                }

            }


            /* =========================
               HTML ESCAPE
            ========================= */

            function escapeHtml(value) {
                const div = document.createElement("div");
                div.textContent = String(value);
                return div.innerHTML;
            }


            /* =========================
               ALERTS
            ========================= */

            function renderAlerts() {

                const list = document.getElementById("alertList");
                const empty = document.getElementById("emptyAlerts");

                list.innerHTML = "";

                let activeAlerts = 0;

                budgets.forEach(function (budget) {

                    const limit = Number(budget.limit_amount) || 0;
                    const spent = spentOf(budget);
                    const status = getStatus(spent, limit);

                    if (status !== "warning" && status !== "exceeded") {
                        return;
                    }

                    activeAlerts++;

                    const usage = getUsage(spent, limit);
                    const item = document.createElement("div");

                    item.className = "alert-item " + status;

                    let message;

                    if (status === "exceeded") {
                        message = "You have exceeded this budget by " + money(spent - limit) + ".";
                    } else {
                        message = "You have used " + usage + "% of this budget.";
                    }

                    item.innerHTML =
                        '<div class="alert-copy">' +
                            '<strong>' + escapeHtml(budget.category) + ' — ' + getStatusLabel(status) + '</strong>' +
                            '<span>' + message + ' (' + money(spent) + ' of ' + money(limit) + ')</span>' +
                        '</div>';

                    list.appendChild(item);

                });

                empty.style.display = activeAlerts === 0 ? "block" : "none";

            }


            /* =========================
               MODAL
            ========================= */

            function openModal() {

                const modal = document.getElementById("budgetModal");

                document.getElementById("modalBudgetForm").reset();
                document.getElementById("editingId").value = "";
                document.getElementById("modalTitle").textContent = "Add New Budget";
                document.getElementById("modalSubmit").textContent = "Save Budget";

                setMessage(document.getElementById("modalMessage"), "", false);

                modal.classList.add("open");
                modal.setAttribute("aria-hidden", "false");

                document.getElementById("modalCategory").focus();

            }

            function openEditModal(id) {

                const budget = findBudget(id);

                if (!budget) {
                    return;
                }

                document.getElementById("editingId").value = budget.id;
                document.getElementById("modalCategory").value = budget.category_id;
                document.getElementById("modalAmount").value = budget.limit_amount;
                document.getElementById("modalTitle").textContent = "Edit Budget";
                document.getElementById("modalSubmit").textContent = "Update Budget";

                setMessage(document.getElementById("modalMessage"), "", false);

                const modal = document.getElementById("budgetModal");

                modal.classList.add("open");
                modal.setAttribute("aria-hidden", "false");

            }

            function closeModal() {

                const modal = document.getElementById("budgetModal");

                modal.classList.remove("open");
                modal.setAttribute("aria-hidden", "true");

            }


            /* =========================
               ADD BUDGET
            ========================= */

            async function addBudget(categoryId, amount) {

                const response = await fetch("{{ route('budgets.store') }}", {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },

                    body: JSON.stringify({
                        category_id: Number(categoryId),
                        limit_amount: Number(amount),
                        amount_spent: 0
                    })
                });

                if (!response.ok) {
                    throw await readError(response, "Unable to save budget.");
                }

                window.location.reload();

            }


            /* =========================
               UPDATE BUDGET
            ========================= */

            async function updateBudget(id, categoryId, amount, spent) {

                const url = "{{ url('/budgets') }}/" + id;

                const response = await fetch(url, {
                    method: "PUT",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },

                    body: JSON.stringify({
                        category_id: Number(categoryId),
                        limit_amount: Number(amount),
                        amount_spent: Number(spent) || 0
                    })
                });

                if (!response.ok) {
                    throw await readError(response, "Unable to update budget.");
                }

                window.location.reload();

            }


            /* =========================
               DELETE BUDGET
            ========================= */

            async function deleteBudget(id) {

                const url = "{{ url('/budgets') }}/" + id;

                const response = await fetch(url, {
                    method: "DELETE",

                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    }
                });

                if (!response.ok) {
                    throw new Error("Unable to delete budget.");
                }

                window.location.reload();

            }


            /* =========================
               MAIN FORM
            ========================= */

            document.getElementById("budgetForm").addEventListener("submit", async function (event) {

                event.preventDefault();

                const categoryId = document.getElementById("category").value;
                const amount = document.getElementById("budgetAmount").value;
                const message = document.getElementById("formMessage");

                if (!categoryId) {
                    setMessage(message, "Please choose a category.", true);
                    return;
                }

                if (!amount || Number(amount) <= 0) {
                    setMessage(message, "Please enter a valid budget amount.", true);
                    return;
                }

                try {
                    setMessage(message, "Saving budget...", false);
                    await addBudget(categoryId, amount);
                } catch (error) {
                    setMessage(message, error.message, true);
                }

            });


            /* =========================
               MODAL FORM
            ========================= */

            document.getElementById("modalBudgetForm").addEventListener("submit", async function (event) {

                event.preventDefault();

                const categoryId = document.getElementById("modalCategory").value;
                const amount = document.getElementById("modalAmount").value;
                const editingId = document.getElementById("editingId").value;
                const message = document.getElementById("modalMessage");

                if (!categoryId) {
                    setMessage(message, "Please choose a category.", true);
                    return;
                }

                if (!amount || Number(amount) <= 0) {
                    setMessage(message, "Please enter a valid budget amount.", true);
                    return;
                }

                try {

                    setMessage(message, editingId ? "Updating budget..." : "Saving budget...", false);

                    if (editingId) {

                        const budget = findBudget(editingId);

                        await updateBudget(
                            editingId,
                            categoryId,
                            amount,
                            budget ? budget.amount_spent : 0
                        );

                    } else {

                        await addBudget(categoryId, amount);

                    }

                } catch (error) {
                    setMessage(message, error.message, true);
                }

            });


            /* =========================
               SPENDING
            ========================= */

            document.getElementById("budgetList").addEventListener("submit", async function (event) {

                const form = event.target.closest('[data-action="add-spending"]');

                if (!form) {
                    return;
                }

                event.preventDefault();

                const card = form.closest(".budget-card");
                const id = card.getAttribute("data-id");
                const input = form.querySelector("input");
                const amount = Number(input.value);

                if (!amount || amount <= 0) {
                    return;
                }

                const budget = findBudget(id);

                if (!budget) {
                    return;
                }

                const currentSpent = Number(budget.amount_spent) || 0;
                const newSpent = currentSpent + amount;

                try {

                    form.querySelector("button").disabled = true;

                    await updateBudget(id, budget.category_id, budget.limit_amount, newSpent);

                } catch (error) {

                    alert(error.message);
                    form.querySelector("button").disabled = false;

                }

            });


            /* =========================
               EDIT / DELETE
            ========================= */

            document.getElementById("budgetList").addEventListener("click", async function (event) {

                const editButton = event.target.closest('[data-action="edit"]');
                const deleteButton = event.target.closest('[data-action="delete"]');

                if (editButton) {

                    const card = editButton.closest(".budget-card");
                    openEditModal(card.getAttribute("data-id"));

                    return;
                }

                if (deleteButton) {

                    const card = deleteButton.closest(".budget-card");
                    const id = card.getAttribute("data-id");

                    const confirmed = window.confirm("Are you sure you want to delete this budget?");

                    if (!confirmed) {
                        return;
                    }

                    try {

                        deleteButton.disabled = true;
                        await deleteBudget(id);

                    } catch (error) {

                        alert(error.message);
                        deleteButton.disabled = false;

                    }

                }

            });


            /* =========================
               CLEAR ALERTS
            ========================= */

            document.getElementById("clearAlerts").addEventListener("click", function () {

                document.querySelectorAll(".alert-item").forEach(function (item) {
                    item.remove();
                });

                document.getElementById("emptyAlerts").style.display = "block";

            });


            /* =========================
               MODAL BUTTONS
            ========================= */

            document.getElementById("openBudgetModal").addEventListener("click", openModal);
            document.getElementById("openBudgetModalAlt").addEventListener("click", openModal);

            const emptyAddButton = document.getElementById("emptyAddBtn");

            if (emptyAddButton) {
                emptyAddButton.addEventListener("click", openModal);
            }

            document.getElementById("closeModal").addEventListener("click", closeModal);
            document.getElementById("cancelModal").addEventListener("click", closeModal);

            document.getElementById("budgetModal").addEventListener("click", function (event) {
                if (event.target === document.getElementById("budgetModal")) {
                    closeModal();
                }
            });

            document.addEventListener("keydown", function (event) {
                if (event.key === "Escape") {
                    closeModal();
                }
            });


            /* =========================
               INITIALIZE
            ========================= */

            renderSummary();
            renderAlerts();

        })();
    </script>

</body>

</html>