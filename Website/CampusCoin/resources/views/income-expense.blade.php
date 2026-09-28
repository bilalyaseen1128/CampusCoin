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
                --primary: #7c5cff;
                --primary-dark: #6546e8;
                --primary-light: #9b83ff;

                --income: #22c55e;
                --income-bg: rgba(34, 197, 94, 0.12);

                --expense: #ef4444;
                --expense-bg: rgba(239, 68, 68, 0.12);

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

            body.dark .stat-card,
            body.dark .card,
            body.dark .toast {
                background: var(--surface);
                border-color: var(--border);
            }

            body.dark .btn-secondary {
                background: var(--surface-2);
                color: var(--text);
                border-color: var(--border);
            }

            body.dark .data-table thead {
                background: var(--surface-2);
            }

            body.dark .data-table tbody tr:hover {
                background: var(--surface-2);
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
                box-shadow: var(--shadow);
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
                background: rgba(124, 92, 255, 0.12);
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

            .stat-card p {
                color: var(--text-light);
                font-size: 11px;
            }

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
                background: linear-gradient(
                    135deg,
                    var(--primary),
                    var(--primary-light)
                );
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
                background: rgba(124, 92, 255, 0.12);
                color: var(--primary);
                padding: 8px 13px;
                font-size: 11px;
            }

            .btn-edit:hover {
                background: var(--primary);
                color: white;
            }

            .card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                box-shadow: var(--shadow);
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
                box-shadow: 0 0 0 3px rgba(124, 92, 255, 0.12);
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

            .footer-col ul li a:hover {
                color: var(--primary);
            }

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

            .footer-locale i {
                color: var(--primary);
            }

            .footer-legal {
                display: flex;
                align-items: center;
                flex-wrap: wrap;
                gap: 18px;
            }

            .footer-legal a,
            .footer-copyright {
                color: var(--text-light);
                font-size: 11.5px;
            }

            .footer-social {
                display: flex;
                gap: 10px;
            }

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

            .footer-social a:hover {
                color: var(--primary);
                border-color: var(--primary);
            }

            @media (max-width: 1100px) {
                .content {
                    padding: 28px 25px 45px;
                }

                .stats-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .footer-columns {
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

                .footer-columns {
                    grid-template-columns: 1fr;
                }

                .footer-bottom {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .footer-inner {
                    padding: 35px 18px 0;
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

                <!-- ================= STATS ================= -->

                <div class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-top">

                            <span class="stat-icon">
                                <i class="fa-solid fa-arrow-up"></i>
                            </span>

                            <span class="stat-change income">
                                Income
                            </span>

                        </div>

                        <h3>
                            ₨{{ number_format($income, 0) }}
                        </h3>

                        <p>This Month</p>
                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-icon">
                                <i class="fa-solid fa-arrow-down"></i>
                            </span>

                            <span class="stat-change expense">
                                Expenses
                            </span>

                        </div>

                        <h3>
                            ₨{{ number_format($expense, 0) }}
                        </h3>

                        <p>This Month</p>

                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-icon">
                                ₨
                            </span>

                        </div>

                        <h3>
                            ₨{{ number_format($balance, 0) }}
                        </h3>

                        <p>Net Balance</p>

                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-icon">
                                %
                            </span>

                        </div>

                        <h3>
                            {{ number_format($expenseRatio, 1) }}%
                        </h3>

                        <p>Expense Ratio</p>

                    </div>

                </div>


                <!-- ================= PAGE ACTIONS ================= -->

                <div class="page-actions">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        id="openFilter">

                        <i class="fa-solid fa-filter"></i>
                        Filter

                    </button>


                    <button
                        type="button"
                        class="btn btn-primary"
                        id="openTransactionModal">

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
                                        </td>


                                        <td>
                                            {{ $transaction->category->name ?? 'No Category' }}
                                        </td>


                                        <td>
                                            {{ $transaction->transaction_date->format('d M Y') }}
                                        </td>


                                        <td>

                                            @if($transaction->type === 'income')

                                                <span class="badge badge-income">
                                                    Income
                                                </span>

                                            @else

                                                <span class="badge badge-expense">
                                                    Expense
                                                </span>

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

                                                <a
        href="{{ route('transactions.edit', $transaction->id) }}"
        class="btn btn-sm btn-primary"
    >
        Edit
    </a>


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

                                        <td
                                            colspan="6"
                                            style="text-align:center; padding:30px; color:var(--text-light);">

                                            No transactions found.

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

        <div
            class="modal-overlay"
            id="transactionModal">

            <div class="transaction-modal">

                <div class="modal-header">

                    <h2>Add New Transaction</h2>

                    <button
                        type="button"
                        class="modal-close"
                        id="closeTransactionModal">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                <form
                    action="{{ route('transactions.store') }}"
                    method="POST">

                    @csrf


                    <!-- Description -->

                    <div class="form-group">

                        <label for="description">
                            Description
                        </label>

                        <input
                            type="text"
                            id="description"
                            name="description"
                            class="form-control"
                            value="{{ old('description') }}"
                            placeholder="e.g. Monthly Allowance"
                            required>

                    </div>


                    <!-- Category -->

                    <div class="form-group">

                        <label for="category_id">
                            Category
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="form-control"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Type -->

                    <div class="form-group">

                        <label>
                            Transaction Type
                        </label>


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
                                    &nbsp;
                                    Income

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
                                    &nbsp;
                                    Expense

                                </label>

                            </div>

                        </div>

                    </div>


                    <!-- Amount -->

                    <div class="form-group">

                        <label for="amount">
                            Amount
                        </label>

                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            class="form-control"
                            value="{{ old('amount') }}"
                            placeholder="e.g. 10000"
                            min="1"
                            step="0.01"
                            required>

                    </div>


                    <!-- Date -->

                    <div class="form-group">

                        <label for="transaction_date">
                            Date
                        </label>

                        <input
                            type="date"
                            id="transaction_date"
                            name="transaction_date"
                            class="form-control"
                            value="{{ old('transaction_date') }}"
                            required>

                    </div>


                    <div class="modal-actions">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            id="cancelTransaction">

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fa-solid fa-plus"></i>
                            Add Transaction

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- ================= FILTER MODAL ================= -->

        <div
            class="modal-overlay"
            id="filterModal">

            <div class="transaction-modal">

                <div class="modal-header">

                    <h2>Filter Transactions</h2>

                    <button
                        type="button"
                        class="modal-close"
                        id="closeFilter">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                <form
                    action="{{ route('income.expense') }}"
                    method="GET">


                    <!-- Type -->

                    <div class="form-group">

                        <label for="filter_type">
                            Transaction Type
                        </label>

                        <select
                            name="type"
                            id="filter_type"
                            class="form-control">

                            <option value="">
                                All Transactions
                            </option>

                            <option
                                value="income"
                                {{ request('type') == 'income' ? 'selected' : '' }}>

                                Income

                            </option>

                            <option
                                value="expense"
                                {{ request('type') == 'expense' ? 'selected' : '' }}>

                                Expense

                            </option>

                        </select>

                    </div>


                    <!-- Category -->

                    <div class="form-group">

                        <label for="filter_category">
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="filter_category"
                            class="form-control">

                            <option value="">
                                All Categories
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Dates -->

                    <div class="filter-grid">

                        <div class="form-group">

                            <label for="date_from">
                                Date From
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                class="form-control"
                                value="{{ request('date_from') }}">

                        </div>


                        <div class="form-group">

                            <label for="date_to">
                                Date To
                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                class="form-control"
                                value="{{ request('date_to') }}">

                        </div>

                    </div>


                    <div class="modal-actions">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            id="cancelFilter">

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            Apply Filter

                        </button>

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

                /* ================= TRANSACTION MODAL ================= */

                const transactionModal =
                    document.getElementById("transactionModal");

                const openTransactionModal =
                    document.getElementById("openTransactionModal");

                const closeTransactionModal =
                    document.getElementById("closeTransactionModal");

                const cancelTransaction =
                    document.getElementById("cancelTransaction");


                openTransactionModal.addEventListener("click", function () {

                    transactionModal.classList.add("show");

                });


                closeTransactionModal.addEventListener("click", function () {

                    transactionModal.classList.remove("show");

                });


                cancelTransaction.addEventListener("click", function () {

                    transactionModal.classList.remove("show");

                });


                transactionModal.addEventListener("click", function (event) {

                    if (event.target === transactionModal) {

                        transactionModal.classList.remove("show");

                    }

                });


                /* ================= FILTER MODAL ================= */

                const filterModal =
                    document.getElementById("filterModal");

                const openFilter =
                    document.getElementById("openFilter");

                const closeFilter =
                    document.getElementById("closeFilter");

                const cancelFilter =
                    document.getElementById("cancelFilter");


                openFilter.addEventListener("click", function () {

                    filterModal.classList.add("show");

                });


                closeFilter.addEventListener("click", function () {

                    filterModal.classList.remove("show");

                });


                cancelFilter.addEventListener("click", function () {

                    filterModal.classList.remove("show");

                });


                filterModal.addEventListener("click", function (event) {

                    if (event.target === filterModal) {

                        filterModal.classList.remove("show");

                    }

                });

            });

        </script>


        <!-- script.js sirf EK BAAR -->
        <script src="{{ asset('js/script.js') }}" defer></script>

    </body>

    </html>