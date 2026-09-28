<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categories | CampusCoin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS -->
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

        /* Dark mode specific elements */
        body.dark .navbar { background: var(--navbar); }
        body.dark .navbar-dropdown { background: var(--navbar); }

        body.dark .stat-card,
        body.dark .category-card,
        body.dark .category-tools,
        body.dark .empty-state,
        body.dark .modal,
        body.dark .toast {
            background: var(--surface);
            border-color: var(--border);
        }

        body.dark .search-box input,
        body.dark .input-wrapper input,
        body.dark .theme-btn,
        body.dark .filter-btn,
        body.dark .cancel-btn,
        body.dark .close-modal,
        body.dark .menu-btn {
            background: var(--surface-2);
            color: var(--text);
            border-color: var(--border);
        }

        body.dark .nav-item:hover { background: var(--surface-2); }
        body.dark .nav-item.active { background: rgba(124, 92, 255, 0.18); }

        body.dark .category-card:hover,
        body.dark .stat-card:hover {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
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

        button {
            cursor: pointer;
            padding: 6px 10px;
            color: white;
            border-radius: 11px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        a { text-decoration: none; color: inherit; }

        /* ================= NAVBAR ================= */
        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            height: 76px;
            background: var(--navbar);
            border-bottom: 1px solid var(--border);
            z-index: 1000;
            transition: background var(--transition);
        }

        .navbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
            padding: 0 30px;
            display: flex;
            align-items: center;
            gap: 24px;
        }

        /* LOGO */
        .logo-area { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            font-size: 18px;
        }

        .logo-text h2 { font-size: 18px; font-weight: 800; }
        .logo-text h2 span { color: var(--primary); }
        .logo-text p { color: var(--text-light); font-size: 10px; margin-top: 2px; }

        /* NAV LINKS (horizontal) */
        .navbar-nav { display: flex; align-items: center; gap: 4px; margin-left: 10px; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 14px;
            border-radius: 10px;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            transition: var(--transition);
        }

        .nav-item i { width: 16px; text-align: center; font-size: 13px; }
        .nav-item:hover { background: var(--surface-2); color: var(--primary); }
        .nav-item.active { background: rgba(124, 92, 255, 0.12); color: var(--primary); font-weight: 700; }

        /* Right side actions */
        .navbar-actions { display: flex; align-items: center; gap: 18px; margin-left: auto; flex-shrink: 0; }
        .navbar-divider { width: 1px; height: 28px; background: var(--border); }

        /* THEME */
        .theme-btn {
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 11px;
            transition: var(--transition);
        }

        .theme-btn:hover { color: var(--primary); border-color: var(--primary); }

        /* PROFILE */
        .profile-mini { display: flex; align-items: center; gap: 9px; }

        .profile-avatar {
            width: 39px;
            height: 39px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            font-weight: 700;
        }

        .profile-info { display: flex; flex-direction: column; gap: 2px; }
        .profile-info strong { font-size: 12px; }
        .profile-info span { color: var(--text-light); font-size: 10px; }

        .logout { color: var(--text-light); }
        .logout:hover { color: var(--expense); }

        /* MOBILE MENU BUTTON */
        .menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 10px;
        }

        /* MOBILE DROPDOWN PANEL */
        .navbar-dropdown {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: var(--navbar);
            border-bottom: 1px solid var(--border);
            padding: 12px 20px 16px;
        }

        .navbar-dropdown.open { display: flex; }
        .navbar-dropdown .nav-item { padding: 12px 14px; }
        .navbar-dropdown-divider { border-top: 1px solid var(--border); margin: 8px 0; }

        /* ================= MAIN ================= */
        .main-content { min-height: 100vh; }

        /* ================= CONTENT ================= */
        .content { padding: 30px 35px 50px; max-width: 1400px; margin: 0 auto; }

        /* ================= STATS ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .stat-card:hover { transform: translateY(-3px); }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon.total { background: rgba(124, 92, 255, 0.12); color: var(--primary); }
        .stat-icon.income { background: var(--income-bg); color: var(--income); }
        .stat-icon.expense { background: var(--expense-bg); color: var(--expense); }
        .stat-icon.custom { background: rgba(59, 130, 246, 0.12); color: #3b82f6; }

        .stat-card span { display: block; color: var(--text-light); font-size: 11px; margin-bottom: 5px; }
        .stat-card h3 { font-size: 23px; font-weight: 800; }

        /* ================= SECTION ================= */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-header h2 { font-size: 18px; font-weight: 800; }
        .section-header p { color: var(--text-light); font-size: 12px; margin-top: 4px; }

        /* ADD CATEGORY */
        .add-category-btn {
            border: 0;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 12px 18px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .add-category-btn:hover { transform: translateY(-2px); }

        /* ================= SEARCH ================= */
        .category-tools {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .search-box { position: relative; width: 330px; }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-box input {
            width: 100%;
            height: 42px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 10px;
            padding: 0 15px 0 38px;
            outline: none;
        }

        .search-box input:focus { border-color: var(--primary); }

        /* FILTER */
        .filter-buttons { display: flex; gap: 7px; }

        .filter-btn {
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text-light);
            padding: 9px 13px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 600;
        }

        .filter-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* ================= CATEGORY GRID ================= */
        .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }

        .category-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 95px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .category-card.hidden { display: none; }
        .category-card:hover { transform: translateY(-3px); }

        .category-icon {
            width: 47px;
            height: 47px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .income-card .category-icon { background: var(--income-bg); color: var(--income); }
        .expense-card .category-icon { background: var(--expense-bg); color: var(--expense); }

        .category-details h3 { font-size: 13px; margin-bottom: 5px; }
        .category-details span { color: var(--text-light); font-size: 10px; }
        .income-card .category-details span { color: var(--income); }
        .expense-card .category-details span { color: var(--expense); }

        .category-menu { margin-left: auto; }

        /* DEFAULT BADGE (shown instead of Manage for shared default categories) */
        .default-badge {
            font-size: 10px;
            font-weight: 600;
            color: var(--text-light);
        }

        /* MANAGE BUTTON */
        .manage-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--surface-2);
            color: var(--text-light);
            border: 1px solid var(--border);
            font-size: 11px;
            font-weight: 700;
            padding: 8px 12px;
            border-radius: 9px;
        }

        .manage-btn:hover { color: var(--primary); border-color: var(--primary); }

        /* MANAGE POPUP ACTIONS */
        .manage-actions { display: flex; flex-direction: column; gap: 12px; margin-top: 6px; }

        .manage-edit-form,
        .manage-delete-form { width: 100%; }

        .manage-edit-btn,
        .manage-delete-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 700;
        }

        .manage-edit-btn { background: rgba(124, 92, 255, 0.12); color: var(--primary); }
        .manage-delete-btn { background: var(--expense-bg); color: var(--expense); }

        /* ================= EMPTY ================= */
        .empty-state {
            display: none;
            text-align: center;
            padding: 70px 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }

        .empty-state.show { display: block; }

        .empty-icon {
            width: 60px;
            height: 60px;
            margin: auto auto 15px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(124, 92, 255, 0.1);
            color: var(--primary);
            font-size: 22px;
        }

        .empty-state h3 { font-size: 15px; margin-bottom: 7px; }
        .empty-state p { color: var(--text-light); font-size: 12px; }

        /* ================= MODAL ================= */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10, 10, 20, 0.65);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 2000;
        }

        .modal-overlay.show { opacity: 1; visibility: visible; }

        .modal {
            position: relative;
            width: 100%;
            max-width: 450px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
        }

        .close-modal {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 34px;
            height: 34px;
            border: 0;
            background: var(--surface-2);
            color: var(--text-light);
            border-radius: 9px;
        }

        .modal-icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(124, 92, 255, 0.12);
            color: var(--primary);
            margin-bottom: 18px;
        }

        .modal h2 { font-size: 20px; margin-bottom: 7px; }
        .modal>p { color: var(--text-light); font-size: 12px; margin-bottom: 25px; }

        /* FORM */
        .form-group { margin-bottom: 22px; }
        .form-group label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 8px; }

        .input-wrapper { position: relative; }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .input-wrapper input {
            width: 100%;
            height: 45px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 10px;
            padding: 0 14px 0 38px;
            outline: none;
        }

        .type-options { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .type-option input { display: none; }

        .type-option span {
            height: 48px;
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .income-option input:checked+span {
            border-color: var(--income);
            background: var(--income-bg);
            color: var(--income);
        }

        .expense-option input:checked+span {
            border-color: var(--expense);
            background: var(--expense-bg);
            color: var(--expense);
        }

        /* MODAL BUTTONS */
        .modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 28px; }

        .cancel-btn,
        .save-btn {
            padding: 11px 17px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
        }

        .cancel-btn { border: 1px solid var(--border); background: var(--surface-2); color: var(--text-light); }
        .save-btn { border: 0; background: var(--primary); color: white; }

        /* ================= TOAST ================= */
        .toast {
            position: fixed;
            right: 25px;
            bottom: 25px;
            min-width: 280px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.18);
            border-radius: 13px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(130%);
            transition: 0.4s ease;
            z-index: 3000;
        }

        .toast.show { transform: translateX(0); }

        .toast-icon {
            width: 35px;
            height: 35px;
            border-radius: 9px;
            background: var(--income-bg);
            color: var(--income);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast strong { display: block; font-size: 12px; margin-bottom: 3px; }
        .toast p { color: var(--text-light); font-size: 10px; }

        /* ================= FOOTER ================= */
        .site-footer {
            background: var(--navbar);
            border-top: 1px solid var(--border);
            margin-top: 60px;
            transition: background var(--transition);
        }

        .footer-inner { max-width: 1400px; margin: 0 auto; padding: 50px 35px 0; }

        .footer-columns {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            padding-bottom: 40px;
            border-bottom: 1px solid var(--border);
        }

        .footer-col h4 { font-size: 12px; font-weight: 700; margin-bottom: 18px; letter-spacing: 0.3px; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .footer-col ul li a { color: var(--text-light); font-size: 12.5px; transition: var(--transition); }
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

        .footer-legal { display: flex; align-items: center; flex-wrap: wrap; gap: 18px; }
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

        @media (max-width: 1100px) {
            .footer-columns { grid-template-columns: repeat(2, 1fr); gap: 30px 20px; }
        }

        @media (max-width: 700px) {
            .footer-inner { padding: 40px 20px 0; }
            .footer-columns { grid-template-columns: 1fr; gap: 26px; }
            .footer-bottom { flex-direction: column; align-items: flex-start; }
            .footer-legal { gap: 12px 16px; }
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1150px) {
            .navbar-nav { display: none; }
            .menu-btn { display: block; }
        }

        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .category-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 850px) {
            .navbar-inner { padding: 0 20px; }
            .logo-text p { display: none; }
            .content { padding: 25px 20px; }
        }

        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr; }
            .category-grid { grid-template-columns: 1fr; }
            .category-tools { flex-direction: column; align-items: stretch; }
            .search-box { width: 100%; }
            .filter-buttons { width: 100%; }
            .filter-btn { flex: 1; }
            .section-header { flex-direction: column; align-items: stretch; }
            .add-category-btn { justify-content: center; }
            .profile-info { display: none; }
            .type-options { grid-template-columns: 1fr; }
        }

        @media (max-width: 420px) {
            .navbar-divider { display: none; }
        }
    </style>
</head>

<body>

    @include('nav')


    <!-- ================= MAIN CONTENT ================= -->

    <main class="main-content">

        <section class="content">


            <!-- PAGE HEADING -->

            <div class="section-header" style="margin-bottom:25px;">
                <div>
                    <h2 style="font-size:22px;">Category Management</h2>
                    <p>Organize your income and expenses with personal categories.</p>
                </div>
            </div>


            <!-- STATISTICS -->

            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <span>Total Categories</span>
                        <h3 id="totalCategories">{{ $totalCategories }}</h3>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon income">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <div>
                        <span>Income Categories</span>
                        <h3 id="incomeCount">{{ $incomeCount }}</h3>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon expense">
                        <i class="fa-solid fa-arrow-trend-down"></i>
                    </div>
                    <div>
                        <span>Expense Categories</span>
                        <h3 id="expenseCount">{{ $expenseCount }}</h3>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon custom">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <span>My Categories</span>
                        <h3 id="customCount">{{ $customCount }}</h3>
                    </div>
                </div>

            </div>


            <!-- SECTION HEADER -->

            <div class="section-header">

                <div>
                    <h2>My Categories</h2>
                    <p>Manage your income and expense categories.</p>
                </div>

                <button class="add-category-btn" id="openModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Category
                </button>

            </div>


            <!-- SEARCH AND FILTER -->

            <div class="category-tools">

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search categories...">
                </div>

                <div class="filter-buttons" id="filterButtons">

                    <button class="filter-btn active" data-filter="all">
                        All
                    </button>

                    <button class="filter-btn" data-filter="income">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        Income
                    </button>

                    <button class="filter-btn" data-filter="expense">
                        <i class="fa-solid fa-arrow-trend-down"></i>
                        Expense
                    </button>

                </div>

            </div>


            <!-- CATEGORY CARDS -->

            <div class="category-grid" id="categoryGrid">

                @foreach($categories as $category)

                @php
                $icons = [
                    'Allowance' => 'fa-hand-holding-dollar',
                    'Part-time Job' => 'fa-briefcase',
                    'Scholarship' => 'fa-graduation-cap',
                    'Gift' => 'fa-gift',
                    'Other Income' => 'fa-money-bill-wave',
                    'Food' => 'fa-utensils',
                    'Transport' => 'fa-bus',
                    'Hostel / Rent' => 'fa-house',
                    'Academics' => 'fa-graduation-cap',
                    'Subscriptions' => 'fa-mobile-screen',
                    'Entertainment' => 'fa-film',
                    'Miscellaneous' => 'fa-box',
                ];

                $icon = $icons[$category->name] ?? 'fa-layer-group';

                $cardClass = $category->type === 'income'
                    ? 'income-card'
                    : 'expense-card';
                @endphp

                <div class="category-card {{ $cardClass }}"
                    data-type="{{ $category->type }}"
                    data-name="{{ strtolower($category->name) }}">

                    <div class="category-icon">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>

                    <div class="category-details">
                        <h3>{{ $category->name }}</h3>
                        <span>{{ ucfirst($category->type) }}</span>
                    </div>

                    <div class="category-menu">

                        @if(!$category->is_default)

                            <button type="button"
                                class="manage-btn"
                                data-modal-target="manageModal-{{ $category->id }}">
                                <i class="fa-solid fa-ellipsis"></i>
                                Manage
                            </button>

                        @else

                            <span class="default-badge">Default</span>

                        @endif

                    </div>

                </div>


                @if(!$category->is_default)

                <!-- MANAGE POPUP (separate Edit form + separate Delete form) -->

                <div class="modal-overlay manage-overlay" id="manageModal-{{ $category->id }}">

                    <div class="modal">

                        <button class="close-modal manage-close" type="button">
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <div class="modal-icon">
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>

                        <h2>Manage "{{ $category->name }}"</h2>

                        <p>
                            Edit this category's details, or remove it. These are two separate actions.
                        </p>

                        <div class="manage-actions">

                            <!-- SEPARATE EDIT FORM -->
                            <form class="manage-edit-form"
                                action="{{ route('categories.edit', $category->id) }}"
                                method="GET">

                                <button type="submit" class="manage-edit-btn">
                                    <i class="fa-solid fa-pen"></i>
                                    Edit Category
                                </button>

                            </form>

                            <!-- SEPARATE DELETE FORM -->
                            <form class="manage-delete-form"
                                action="{{ route('categories.destroy', $category->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="manage-delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete Category
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                @endif

                @endforeach

            </div>


            <!-- EMPTY STATE -->

            <div class="empty-state @if($categories->isEmpty()) show @endif" id="emptyState">

                <div class="empty-icon">
                    <i class="fa-solid fa-folder-open"></i>
                </div>

                <h3>No categories found</h3>

                <p>
                    Try another search or create a new category.
                </p>

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


    <!-- ================= ADD CATEGORY MODAL ================= -->

    <div class="modal-overlay" id="modalOverlay">

        <div class="modal">

            <button class="close-modal" id="closeModal">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="modal-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <h2>Add New Category</h2>

            <p>
                Create a personal income or expense category.
            </p>

            <form id="categoryForm"
                action="{{ route('categories.store') }}"
                method="POST">

                @csrf

                <div class="form-group">

                    <label for="categoryName">
                        Category Name
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-tag"></i>

                        <input
                            type="text"
                            id="categoryName"
                            name="name"
                            placeholder="e.g. Freelancing"
                            required>

                    </div>

                </div>


                <div class="form-group">

                    <label>Category Type</label>

                    <div class="type-options">

                        <label class="type-option income-option">
                            <input type="radio" name="type" value="income" checked>
                            <span>
                                <i class="fa-solid fa-arrow-trend-up"></i>
                                Income
                            </span>
                        </label>

                        <label class="type-option expense-option">
                            <input type="radio" name="type" value="expense">
                            <span>
                                <i class="fa-solid fa-arrow-trend-down"></i>
                                Expense
                            </span>
                        </label>

                    </div>

                </div>


                <div class="modal-actions">

                    <button type="button" class="cancel-btn" id="cancelModal">
                        Cancel
                    </button>

                    <button type="submit" class="save-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Category
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- ================= TOAST ================= -->

    <div class="toast" id="toast">

        <div class="toast-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <div>
            <strong>Success</strong>
            <p id="toastMessage">
                Category added successfully.
            </p>
        </div>

    </div>


    <!-- Modal + filter/search + manage popup -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const openModal = document.getElementById("openModal");
            const modalOverlay = document.getElementById("modalOverlay");
            const closeModal = document.getElementById("closeModal");
            const cancelModal = document.getElementById("cancelModal");

            if (openModal) {
                openModal.onclick = function () {
                    modalOverlay.classList.add("show");
                };
            }

            if (closeModal) {
                closeModal.onclick = function () {
                    modalOverlay.classList.remove("show");
                };
            }

            if (cancelModal) {
                cancelModal.onclick = function () {
                    modalOverlay.classList.remove("show");
                };
            }

            if (modalOverlay) {
                modalOverlay.onclick = function (event) {
                    if (event.target === modalOverlay) {
                        modalOverlay.classList.remove("show");
                    }
                };
            }


            // ---------- Filter (All / Income / Expense) + Search ----------

            const searchInput = document.getElementById("searchInput");
            const filterButtons = document.getElementById("filterButtons");
            const categoryGrid = document.getElementById("categoryGrid");
            const emptyState = document.getElementById("emptyState");

            let activeFilter = "all";

            function applyFilters() {

                const term = searchInput ? searchInput.value.trim().toLowerCase() : "";
                const cards = categoryGrid ? categoryGrid.querySelectorAll(".category-card") : [];
                let visibleCount = 0;

                cards.forEach(function (card) {

                    const type = card.getAttribute("data-type");
                    const name = card.getAttribute("data-name") || "";

                    const matchesFilter = activeFilter === "all" || type === activeFilter;
                    const matchesSearch = !term || name.indexOf(term) !== -1;

                    const isVisible = matchesFilter && matchesSearch;

                    card.classList.toggle("hidden", !isVisible);

                    if (isVisible) visibleCount++;
                });

                if (emptyState) {
                    emptyState.classList.toggle("show", visibleCount === 0);
                }
            }

            if (filterButtons) {
                filterButtons.addEventListener("click", function (e) {

                    const btn = e.target.closest(".filter-btn");
                    if (!btn) return;

                    filterButtons.querySelectorAll(".filter-btn").forEach(function (b) {
                        b.classList.remove("active");
                    });
                    btn.classList.add("active");

                    activeFilter = btn.getAttribute("data-filter");
                    applyFilters();
                });
            }

            if (searchInput) {
                searchInput.addEventListener("input", applyFilters);
            }


            // ---------- Manage popup (per category: separate Edit form + separate Delete form) ----------

            document.addEventListener("click", function (e) {

                const openBtn = e.target.closest(".manage-btn");
                if (openBtn) {
                    const targetId = openBtn.getAttribute("data-modal-target");
                    const overlay = document.getElementById(targetId);
                    if (overlay) overlay.classList.add("show");
                    return;
                }

                const closeBtn = e.target.closest(".manage-close");
                if (closeBtn) {
                    const overlay = closeBtn.closest(".manage-overlay");
                    if (overlay) overlay.classList.remove("show");
                    return;
                }
            });

            document.querySelectorAll(".manage-overlay").forEach(function (overlay) {
                overlay.addEventListener("click", function (e) {
                    if (e.target === overlay) {
                        overlay.classList.remove("show");
                    }
                });
            });

        });
    </script>

    <!-- JavaScript -->
    <script src="{{ asset('js/category-management.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

</body>

</html>