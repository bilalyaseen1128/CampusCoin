<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Income & Expenses | CampusCoin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
            --income-bg: #eaf6ef;
            --expense-bg: #fdecec;
        }

        body.dark {
            --income-bg: #10261c;
            --expense-bg: #2a1414;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            background: var(--body);
            color: var(--text);
            min-height: 100vh;
            transition: background var(--transition), color var(--transition);
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .main-content {
            min-height: 100vh;
        }

        .content {
            padding: 30px 35px 50px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-heading {
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

        /* ================= ALERTS ================= */

        .alert {
            padding: 13px 16px;
            border-radius: 11px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 18px;
            border: 1px solid var(--border);
        }

        .alert ul {
            padding-left: 18px;
        }

        .alert-success {
            background: var(--income-bg);
            color: var(--income);
            border-color: var(--income);
        }

        .alert-error {
            background: var(--expense-bg);
            color: var(--expense);
            border-color: var(--expense);
        }

        .alert-info {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .alert-info a {
            text-decoration: underline;
        }

        /* ================= STATS ================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: 0 12px 30px var(--shadow);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-3px);
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
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 700;
        }

        .stat-change {
            font-size: 10px;
            font-weight: 700;
            padding: 4px 9px;
            border-radius: 20px;
        }

        .stat-change.income {
            background: var(--income-bg);
            color: var(--income);
        }

        .stat-change.expense {
            background: var(--expense-bg);
            color: var(--expense);
        }

        .stat-card h3 {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .stat-card h3.negative {
            color: var(--expense);
        }

        .stat-card p {
            color: var(--text-light);
            font-size: 11px;
        }

        /* ================= BUTTONS ================= */

        .page-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            border: 0;
            padding: 12px 18px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 700;
            transition: var(--transition);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-danger {
            background: var(--expense-bg);
            color: var(--expense);
            padding: 8px 13px;
            font-size: 11px;
        }

        .btn-danger:hover {
            background: var(--expense);
            color: white;
        }

        .btn-edit {
            background: var(--primary-soft);
            color: var(--primary);
            padding: 8px 13px;
            font-size: 11px;
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
        }

        .btn-sm {
            padding: 8px 13px;
            font-size: 11px;
            display: inline-block;
        }

        /* ================= CARD + TABLE ================= */

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 12px 30px var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 {
            font-size: 15px;
            font-weight: 800;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .data-table thead {
            background: var(--surface-2);
        }

        .data-table th {
            text-align: left;
            padding: 13px 22px;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .data-table td {
            padding: 15px 22px;
            font-size: 12.5px;
            border-top: 1px solid var(--border);
        }

        .data-table tbody tr {
            transition: var(--transition);
        }

        .data-table tbody tr:hover {
            background: var(--surface-2);
        }

        .badge {
            font-size: 10px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 20px;
        }

        .badge-income {
            background: var(--income-bg);
            color: var(--income);
        }

        .badge-expense {
            background: var(--expense-bg);
            color: var(--expense);
        }

        .data-table td.income {
            color: var(--income);
            font-weight: 700;
        }

        .data-table td.expense {
            color: var(--expense);
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .pagination-wrap {
            padding: 16px 22px;
            border-top: 1px solid var(--border);
        }

        /* ================= MODALS ================= */

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 23, 0.55);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .modal-overlay.show {
            display: flex;
        }

        .transaction-modal {
            width: 100%;
            max-width: 560px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 28px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 800;
        }

        .modal-close {
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text-light);
            border-radius: 10px;
            font-size: 18px;
        }

        .modal-close:hover {
            color: var(--expense);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: var(--surface-2);
            color: var(--text);
            outline: none;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        .form-group select {
            display: block;
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: var(--surface-2);
            color: var(--text);
            outline: none;
            font-size: 13px;
        }

        .form-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
        }

        .type-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .type-option {
            position: relative;
        }

        .type-option input {
            position: absolute;
            opacity: 0;
        }

        .type-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 11px;
            cursor: pointer;
            color: var(--text-light);
            font-weight: 700;
        }

        .type-option.income input:checked + label {
            background: var(--income-bg);
            color: var(--income);
            border-color: var(--income);
        }

        .type-option.expense input:checked + label {
            background: var(--expense-bg);
            color: var(--expense);
            border-color: var(--expense);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .badge-repeat {
            background: var(--primary-soft);
            color: var(--primary);
            margin-left: 6px;
            white-space: nowrap;
        }

        .badge-paused {
            background: var(--surface-2);
            color: var(--text-light);
            border: 1px solid var(--border);
        }

        .card-sub {
            margin-top: 3px;
            font-size: 11.5px;
            color: var(--text-light);
        }

        .form-hint {
            display: block;
            margin-top: 6px;
            font-size: 11px;
            color: var(--text-light);
        }

        .card-spaced {
            margin-top: 25px;
        }

        .inline-form {
            display: inline;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .site-footer {
            background: var(--navbar);
            border-top: 1px solid var(--border);
            margin-top: 60px;
        }

        @media (max-width: 1100px) {
            .content {
                padding: 28px 25px 45px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 850px) {
            .content {
                padding: 25px 20px 40px;
            }

            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 600px) {
            .content {
                padding: 22px 15px 35px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .page-actions {
                flex-direction: column;
            }

            .page-actions .btn {
                width: 100%;
            }

            .type-options,
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .modal-actions {
                flex-direction: column;
            }

            .modal-actions .btn {
                width: 100%;
            }

            .transaction-modal {
                max-height: calc(100vh - 24px);
                padding: 20px;
            }

            .data-table {
                min-width: 700px;
            }
        }

    </style>
</head>

<body>

    @include('nav')

    <main class="main-content">

        <section class="content">

            <div class="page-heading">
                <h1>Income & Expenses</h1>
                <p>Manage and keep track of your money.</p>
            </div>


            <!-- ================= MESSAGES ================= -->

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(request()->hasAny(['type', 'category_id', 'date_from', 'date_to']))
                <div class="alert alert-info">
                    Filter active hai.
                    <a href="{{ route('income.expense') }}"><strong>Clear filter</strong></a>
                </div>
            @endif


            <!-- ================= STATS ================= -->

            @php($periodLabel = $periodLabel ?? 'All time')

            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fa-solid fa-arrow-up"></i></span>
                        <span class="stat-change income">Income</span>
                    </div>
                    <h3>₨{{ number_format($income, 0) }}</h3>
                    <p>{{ $periodLabel }}</p>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon"><i class="fa-solid fa-arrow-down"></i></span>
                        <span class="stat-change expense">Expenses</span>
                    </div>
                    <h3>₨{{ number_format($expense, 0) }}</h3>
                    <p>{{ $periodLabel }}</p>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">₨</span>
                    </div>
                    <h3 class="{{ $balance < 0 ? 'negative' : '' }}">
                        {{ $balance < 0 ? '-' : '' }}₨{{ number_format(abs($balance), 0) }}
                    </h3>
                    <p>Net Balance</p>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">%</span>
                    </div>
                    <h3>{{ number_format($expenseRatio, 1) }}%</h3>
                    <p>Expense Ratio</p>
                </div>

            </div>


            <!-- ================= PAGE ACTIONS ================= -->

            <div class="page-actions">

                <button type="button" class="btn btn-secondary" id="openFilter">
                    <i class="fa-solid fa-filter"></i>
                    Filter
                </button>

                <button type="button" class="btn btn-primary" id="openTransactionModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Transaction
                </button>

            </div>


            <!-- ================= TRANSACTION TABLE ================= -->

            <div class="card">

                <div class="card-header">
                    <h2>Transaction History</h2>
                </div>

                <div class="table-wrapper">

                    <table class="data-table">

                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($transactions as $transaction)

                                <tr>

                                    <td>
                                        {{ $transaction->description }}
                                        @if($transaction->recurring_id)
                                            <span class="badge badge-repeat" title="Created by a recurring rule">
                                                <i class="fa-solid fa-rotate"></i> Repeat
                                            </span>
                                        @endif
                                    </td>

                                    <td>{{ $transaction->category->name ?? 'No Category' }}</td>

                                    <td>{{ $transaction->transaction_date->format('d M Y') }}</td>

                                    <td>
                                        @if($transaction->type === 'income')
                                            <span class="badge badge-income">Income</span>
                                        @else
                                            <span class="badge badge-expense">Expense</span>
                                        @endif
                                    </td>

                                    <td class="{{ $transaction->type }}">
                                        @if($transaction->type === 'income')
                                            +₨{{ number_format($transaction->amount, 0) }}
                                        @else
                                            -₨{{ number_format($transaction->amount, 0) }}
                                        @endif
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-edit"
                                                data-edit
                                                data-url="{{ route('transactions.update', $transaction->id) }}"
                                                data-description="{{ $transaction->description }}"
                                                data-category="{{ $transaction->category_id }}"
                                                data-type="{{ $transaction->type }}"
                                                data-amount="{{ $transaction->amount }}"
                                                data-date="{{ $transaction->transaction_date->format('Y-m-d') }}">
                                                Edit
                                            </button>

                                            <form
                                                action="{{ route('transactions.destroy', $transaction->id) }}"
                                                method="POST"
                                                style="display:inline;">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" style="text-align:center; padding:30px; color:var(--text-light);">
                                        No transactions found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if($transactions instanceof \Illuminate\Pagination\AbstractPaginator && $transactions->hasPages())
                    <div class="pagination-wrap">
                        {{ $transactions->withQueryString()->links() }}
                    </div>
                @endif

            </div>


            <!-- ================= RECURRING TRANSACTIONS ================= -->

            <div class="card card-spaced" id="recurringCard">

                <div class="card-header">
                    <h2>Recurring Transactions</h2>
                    <p class="card-sub">These are added automatically when their date arrives. Create one with "Repeat" in Add Transaction.</p>
                </div>

                <div class="table-wrapper">

                    <table class="data-table">

                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Repeats</th>
                                <th>Next date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse(($recurringRules ?? collect()) as $rule)

                                <tr>
                                    <td>{{ $rule->description }}</td>

                                    <td>{{ $rule->category->name ?? 'No Category' }}</td>

                                    <td>{{ ucfirst($rule->frequency) }}</td>

                                    <td>
                                        @if($rule->is_active)
                                            {{ $rule->next_run_date->format('d M Y') }}
                                        @else
                                            &mdash;
                                        @endif
                                    </td>

                                    <td class="{{ $rule->type }}">
                                        {{ $rule->type === 'income' ? '+' : '-' }}₨{{ number_format($rule->amount, 0) }}
                                    </td>

                                    <td>
                                        @if($rule->is_active)
                                            <span class="badge badge-income">Active</span>
                                        @elseif($rule->hasEnded())
                                            <span class="badge badge-paused">Ended</span>
                                        @else
                                            <span class="badge badge-paused">Paused</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            @unless($rule->hasEnded())
                                                <form action="{{ route('recurring.toggle', $rule->id) }}" method="POST" class="inline-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-edit">
                                                        {{ $rule->is_active ? 'Pause' : 'Resume' }}
                                                    </button>
                                                </form>
                                            @endunless

                                            <form action="{{ route('recurring.destroy', $rule->id) }}" method="POST" class="inline-form">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Delete this recurring transaction? Entries already created will be kept.')">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" style="text-align:center; padding:30px; color:var(--text-light);">
                                        No recurring transactions yet.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </main>


    <!-- ================= ADD TRANSACTION MODAL ================= -->

    <div class="modal-overlay" id="transactionModal">

        <div class="transaction-modal">

            <div class="modal-header">
                <h2>Add New Transaction</h2>
                <button type="button" class="modal-close" id="closeTransactionModal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('transactions.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label for="description">Description</label>
                    <input
                        type="text"
                        id="description"
                        name="description"
                        class="form-control"
                        value="{{ old('description') }}"
                        placeholder="e.g. Monthly Allowance"
                        required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                data-type="{{ $category->type }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Transaction Type</label>

                    <div class="type-options">

                        <div class="type-option income">
                            <input
                                type="radio"
                                id="incomeType"
                                name="type"
                                value="income"
                                {{ old('type') === 'income' ? 'checked' : '' }}
                                required>
                            <label for="incomeType">
                                <i class="fa-solid fa-arrow-up"></i>
                                &nbsp;Income
                            </label>
                        </div>

                        <div class="type-option expense">
                            <input
                                type="radio"
                                id="expenseType"
                                name="type"
                                value="expense"
                                {{ old('type') === 'expense' ? 'checked' : '' }}>
                            <label for="expenseType">
                                <i class="fa-solid fa-arrow-down"></i>
                                &nbsp;Expense
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        class="form-control"
                        value="{{ old('amount') }}"
                        placeholder="e.g. 10000"
                        min="0.01"
                        max="99999999.99"
                        step="0.01"
                        required>
                </div>

                <div class="form-group">
                    <label for="transaction_date">Date</label>
                    <input
                        type="date"
                        id="transaction_date"
                        name="transaction_date"
                        class="form-control"
                        value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="repeat">Repeat</label>
                    <select id="repeat" name="repeat" class="form-control">
                        <option value="none" {{ old('repeat', 'none') === 'none' ? 'selected' : '' }}>Does not repeat</option>
                        <option value="weekly" {{ old('repeat') === 'weekly' ? 'selected' : '' }}>Every week</option>
                        <option value="monthly" {{ old('repeat') === 'monthly' ? 'selected' : '' }}>Every month</option>
                        <option value="yearly" {{ old('repeat') === 'yearly' ? 'selected' : '' }}>Every year</option>
                    </select>
                    <small class="form-hint">For things like a monthly allowance or a subscription.</small>
                </div>

                <div class="form-group" id="repeatEndWrap" hidden>
                    <label for="end_date">Stop repeating on (optional)</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        class="form-control"
                        value="{{ old('end_date') }}">
                    <small class="form-hint">Leave empty to repeat until you pause or delete it.</small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" id="cancelTransaction">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Add Transaction
                    </button>
                </div>

            </form>

        </div>

    </div>


    <!-- ================= EDIT TRANSACTION MODAL ================= -->

    <div class="modal-overlay" id="editModal">

        <div class="transaction-modal">

            <div class="modal-header">
                <h2>Edit Transaction</h2>
                <button type="button" class="modal-close" data-close>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form method="POST" id="editForm">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_description">Description</label>
                    <input type="text" id="edit_description" name="description" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit_category">Category</label>
                    <select id="edit_category" name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" data-type="{{ $category->type }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_type">Type</label>
                    <select id="edit_type" name="type" class="form-control" required>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_amount">Amount</label>
                    <input type="number" id="edit_amount" name="amount" class="form-control" min="0.01" max="99999999.99" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="edit_date">Date</label>
                    <input type="date" id="edit_date" name="transaction_date" class="form-control" required>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" data-close>Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>

    </div>


    <!-- ================= FILTER MODAL ================= -->

    <div class="modal-overlay" id="filterModal">

        <div class="transaction-modal">

            <div class="modal-header">
                <h2>Filter Transactions</h2>
                <button type="button" class="modal-close" id="closeFilter">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('income.expense') }}" method="GET">

                <div class="form-group">
                    <label for="filter_type">Transaction Type</label>
                    <select name="type" id="filter_type" class="form-control">
                        <option value="">All Transactions</option>
                        <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="filter_category">Category</label>
                    <select name="category_id" id="filter_category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-grid">

                    <div class="form-group">
                        <label for="date_from">Date From</label>
                        <input
                            type="date"
                            id="date_from"
                            name="date_from"
                            class="form-control"
                            value="{{ request('date_from') }}">
                    </div>

                    <div class="form-group">
                        <label for="date_to">Date To</label>
                        <input
                            type="date"
                            id="date_to"
                            name="date_to"
                            class="form-control"
                            value="{{ request('date_to') }}">
                    </div>

                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" id="cancelFilter">Cancel</button>
                    <a href="{{ route('income.expense') }}" class="btn btn-secondary">Clear</a>
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>

            </form>

        </div>

    </div>


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


    <!-- ================= MODAL JAVASCRIPT ================= -->

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const openModal  = m => m.classList.add("show");
            const closeModal = m => m.classList.remove("show");

            const addModal    = document.getElementById("transactionModal");
            const filterModal = document.getElementById("filterModal");
            const editModal   = document.getElementById("editModal");
            const allModals   = [addModal, filterModal, editModal];

            document.getElementById("openTransactionModal")
                .addEventListener("click", () => openModal(addModal));

            document.getElementById("openFilter")
                .addEventListener("click", () => openModal(filterModal));

            // Close: X button, Cancel button, outside click
            allModals.forEach(modal => {

                modal.addEventListener("click", e => {
                    if (e.target === modal) closeModal(modal);
                });

                modal.querySelectorAll("[data-close], .modal-close, #cancelTransaction, #cancelFilter")
                    .forEach(btn => btn.addEventListener("click", () => closeModal(modal)));

            });

            // Close: Escape key
            document.addEventListener("keydown", e => {
                if (e.key === "Escape") allModals.forEach(closeModal);
            });

            // Edit button: modal ko row ke data se bharo
            document.querySelectorAll("[data-edit]").forEach(btn => {
                btn.addEventListener("click", () => {
                    document.getElementById("editForm").action = btn.dataset.url;
                    document.getElementById("edit_description").value = btn.dataset.description;
                    document.getElementById("edit_type").value = btn.dataset.type;
                    filterCategories(document.getElementById("edit_category"), btn.dataset.type);
                    document.getElementById("edit_category").value = btn.dataset.category;
                    document.getElementById("edit_amount").value = btn.dataset.amount;
                    document.getElementById("edit_date").value = btn.dataset.date;
                    openModal(editModal);
                });
            });

            // ---- Category list sirf selected type ki dikhao (income / expense) ----
            function filterCategories(select, type) {
                let stillValid = false;

                select.querySelectorAll("option[data-type]").forEach(opt => {
                    const ok = !type || opt.dataset.type === type;
                    opt.hidden = !ok;
                    opt.disabled = !ok;
                    if (ok && opt.value === select.value) stillValid = true;
                });

                if (!stillValid) select.value = "";
            }

            // Add modal: type radio badalne par categories filter karo
            const addCategory = document.getElementById("category_id");
            document.querySelectorAll('#transactionModal input[name="type"]').forEach(radio => {
                radio.addEventListener("change", () => filterCategories(addCategory, radio.value));
            });
            const checkedType = document.querySelector('#transactionModal input[name="type"]:checked');
            filterCategories(addCategory, checkedType ? checkedType.value : "");

            // Edit modal: type badalne par categories filter karo
            const editType = document.getElementById("edit_type");
            editType.addEventListener("change", () =>
                filterCategories(document.getElementById("edit_category"), editType.value));

            // ---- Repeat: "stop date" sirf tab dikhao jab repeat select ho ----
            const repeatSelect  = document.getElementById("repeat");
            const repeatEndWrap = document.getElementById("repeatEndWrap");
            const syncRepeat = () => { repeatEndWrap.hidden = repeatSelect.value === "none"; };
            repeatSelect.addEventListener("change", syncRepeat);
            syncRepeat();

            // Add form validation fail hua to modal wapas khol do
            @if($errors->any() && old('_method') !== 'PUT')
                openModal(addModal);
            @endif

        });

    </script>


    <!-- script.js sirf EK BAAR -->
    <script src="{{ asset('js/script.js') }}" defer></script>

</body>

</html>