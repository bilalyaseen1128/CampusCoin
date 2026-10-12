<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profile | CampusCoin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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

        @media (prefers-reduced-motion: reduce) {
            * { transition-duration: 0.01ms !important; animation-duration: 0.01ms !important; }
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

        :focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }

        /* ================= CONTENT ================= */
        .content {
            padding: 30px 35px 10px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-heading { margin-bottom: 25px; }
        .page-heading h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
        .page-heading p { color: var(--text-light); font-size: 12px; }

        /* Two-column layout: sidebar + forms (fills the whole width) */
        .profile-layout {
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        .profile-main {
            display: flex;
            flex-direction: column;
            gap: 24px;
            min-width: 0;
        }

        /* ================= ALERTS ================= */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .alert-success { background: var(--income-bg); color: var(--income); border: 1px solid var(--income); }
        .alert-error { background: var(--expense-bg); color: var(--expense); border: 1px solid var(--expense); }

        .field-error { color: var(--expense); font-size: 11px; font-weight: 600; }
        .field-hint { color: var(--text-light); font-size: 11px; }

        /* ================= BUTTONS ================= */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-primary:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }

        .btn-secondary {
            background: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { border-color: var(--primary); color: var(--primary); }

        .btn-danger { background: var(--expense); color: #fff; }
        .btn-danger:hover { transform: translateY(-2px); }
        .btn-danger:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }

        .btn-danger-soft {
            background: var(--expense-bg);
            color: var(--expense);
            border: 1px solid var(--expense);
        }
        .btn-danger-soft:hover { background: var(--expense); color: #fff; }

        /* ================= CARDS ================= */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 12px 30px var(--shadow);
            overflow: hidden;
        }

        .card-head {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px 28px;
            border-bottom: 1px solid var(--border);
        }

        .card-head-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 16px;
        }

        .card-head h2 { font-size: 15px; font-weight: 800; margin-bottom: 2px; }
        .card-head p { font-size: 12px; color: var(--text-light); }

        .card-body { padding: 28px; }

        /* ================= SIDEBAR ================= */
        .profile-side {
            position: sticky;
            top: 90px;
        }

        .side-banner {
            height: 96px;
            background: linear-gradient(150deg, var(--overlay-1), var(--overlay-2));
        }

        .side-body {
            padding: 0 24px 24px;
            text-align: center;
        }

        .profile-side .pf-avatar {
            width: 84px;
            height: 84px;
            margin: -42px auto 14px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            font-size: 32px;
            font-weight: 800;
            border: 4px solid var(--surface);
        }

        .side-body h2 { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
        .side-body .email { color: var(--text-light); font-size: 12.5px; overflow-wrap: anywhere; }

        .member-since {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            padding: 5px 12px;
            border-radius: 20px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
        }

        .side-links {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 4px;
            text-align: left;
        }

        .side-links a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-light);
            transition: var(--transition);
        }

        .side-links a i { width: 18px; text-align: center; color: var(--primary); }
        .side-links a:hover { background: var(--surface-2); color: var(--text); }

        .side-logout { margin-top: 16px; }
        .side-logout .btn { width: 100%; }

        /* ================= FORM ================= */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-grid .full { grid-column: 1 / -1; }

        .form-group { display: flex; flex-direction: column; gap: 8px; }

        .form-group label { font-size: 12px; font-weight: 700; color: var(--text-light); }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 14px;
            border-radius: 11px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            font-size: 13px;
            transition: var(--transition);
        }

        .form-group input.has-error,
        .form-group select.has-error { border-color: var(--expense); }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .14);
        }

        .password-wrap { position: relative; }
        .password-wrap input { padding-right: 44px; }

        .toggle-pass {
            position: absolute;
            top: 50%;
            right: 6px;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border: 0;
            background: transparent;
            color: var(--text-light);
            border-radius: 8px;
        }
        .toggle-pass:hover { color: var(--primary); }

        .form-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* ================= DANGER ZONE ================= */
        .danger-card { border-color: var(--expense); }
        .danger-card .card-head { border-bottom-color: var(--expense); }
        .danger-card .card-head-icon { background: var(--expense-bg); color: var(--expense); }

        .danger-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .danger-row p { font-size: 12.5px; color: var(--text-light); line-height: 1.6; max-width: 520px; }

        /* ================= MODAL ================= */
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
        .modal-overlay.show { display: flex; }

        .modal-box {
            width: 100%;
            max-width: 460px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            padding: 28px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-box h2 { font-size: 18px; font-weight: 800; margin-bottom: 8px; }
        .modal-box > p { font-size: 12.5px; color: var(--text-light); line-height: 1.6; margin-bottom: 20px; }

        /* ================= FOOTER ================= */
        .site-footer {
            background: var(--navbar);
            border-top: 1px solid var(--border);
            margin-top: 60px;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1000px) {
            .profile-layout { grid-template-columns: 1fr; }
            .profile-side { position: static; }
        }

        @media (max-width: 850px) {
            .content { padding: 25px 20px; }
        }

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
            .danger-row { flex-direction: column; align-items: stretch; }
        }

        @media (max-width: 600px) {
            .card-head { padding: 18px; }
            .card-body { padding: 20px 18px; }
            .btn, .form-actions .btn { width: 100%; }
            .form-actions { flex-direction: column-reverse; }
        }
    </style>
</head>

<body>
@include('nav')

@php
    $user = auth()->user();
@endphp

    <main class="main-content">
        <section class="content">

            <div class="page-heading">
                <h1>My profile</h1>
                <p>Manage your account details, password and privacy.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="status" id="statusAlert">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any() || $errors->updatePassword->any())
                <div class="alert alert-error" role="alert">
                    <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                    Some fields need your attention. Check the messages below and try again.
                </div>
            @endif

            <div class="profile-layout">

                {{-- ============ LEFT: SUMMARY SIDEBAR ============ --}}
                <aside class="card profile-side">
                    <div class="side-banner"></div>

                    <div class="side-body">
                        <div class="pf-avatar" aria-hidden="true">
                            {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                        </div>

                        <h2>{{ $user->name ?? 'Guest User' }}</h2>
                        <p class="email">{{ $user->email ?? '' }}</p>

                        @if ($user?->created_at)
                            <span class="member-since">
                                <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                                Member since {{ $user->created_at->format('M Y') }}
                            </span>
                        @endif

                        <nav class="side-links" aria-label="Quick links">
                            <a href="{{ url('/dashboard') }}">
                                <i class="fa-solid fa-chart-line" aria-hidden="true"></i> Dashboard
                            </a>
                            <a href="{{ url('/income-expense') }}">
                                <i class="fa-solid fa-wallet" aria-hidden="true"></i> Income &amp; Expenses
                            </a>
                            <a href="{{ url('/budgets-goal') }}">
                                <i class="fa-solid fa-bullseye" aria-hidden="true"></i> Budget Goals
                            </a>
                            <a href="{{ url('/saving-tips') }}">
                                <i class="fa-solid fa-lightbulb" aria-hidden="true"></i> Saving Tips
                            </a>
                        </nav>

                        @if (Route::has('logout'))
                            <form action="{{ route('logout') }}" method="POST" class="side-logout">
                                @csrf
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                                    Log out
                                </button>
                            </form>
                        @endif
                    </div>
                </aside>

                {{-- ============ RIGHT: FORMS ============ --}}
                <div class="profile-main">

                    {{-- PERSONAL INFO --}}
                    <div class="card">
                        <div class="card-head">
                            <div class="card-head-icon"><i class="fa-solid fa-user" aria-hidden="true"></i></div>
                            <div>
                                <h2>Personal information</h2>
                                <p>Update your name, email and student details.</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" id="profileForm" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-grid">

                                    <div class="form-group">
                                        <label for="name">Full name</label>
                                        <input type="text" id="name" name="name"
                                               class="{{ $errors->has('name') ? 'has-error' : '' }}"
                                               value="{{ old('name', $user->name) }}"
                                               autocomplete="name" maxlength="255" required
                                               @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                                        @error('name')
                                            <span class="field-error" id="name-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email"
                                               class="{{ $errors->has('email') ? 'has-error' : '' }}"
                                               value="{{ old('email', $user->email) }}"
                                               autocomplete="email" maxlength="255" required
                                               @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                                        @error('email')
                                            <span class="field-error" id="email-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="academic_year">Academic year</label>
                                        @php
                                            $years = ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Postgraduate', 'Other'];
                                            $currentYear = old('academic_year', $user->academic_year);
                                        @endphp
                                        <select id="academic_year" name="academic_year"
                                                class="{{ $errors->has('academic_year') ? 'has-error' : '' }}"
                                                @error('academic_year') aria-invalid="true" aria-describedby="year-error" @enderror>
                                            <option value="">Not set</option>
                                            @if ($currentYear && ! in_array($currentYear, $years))
                                                <option value="{{ $currentYear }}" selected>{{ $currentYear }}</option>
                                            @endif
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" @selected($currentYear === $year)>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                        @error('academic_year')
                                            <span class="field-error" id="year-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="monthly_allowance_baseline">Monthly allowance baseline (₨)</label>
                                        <input type="number" id="monthly_allowance_baseline" name="monthly_allowance_baseline"
                                               class="{{ $errors->has('monthly_allowance_baseline') ? 'has-error' : '' }}"
                                               value="{{ old('monthly_allowance_baseline', number_format((float) $user->monthly_allowance_baseline, 2, '.', '')) }}"
                                               min="0" max="99999999.99" step="0.01" inputmode="decimal"
                                               @error('monthly_allowance_baseline') aria-invalid="true" aria-describedby="allowance-error" @enderror>
                                        @error('monthly_allowance_baseline')
                                            <span class="field-error" id="allowance-error">{{ $message }}</span>
                                        @else
                                            <span class="field-hint">What you usually receive each month.</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="monthly_savings_goal">Monthly savings goal (₨)</label>
                                        <input type="number" id="monthly_savings_goal" name="monthly_savings_goal"
                                               class="{{ $errors->has('monthly_savings_goal') ? 'has-error' : '' }}"
                                               value="{{ old('monthly_savings_goal', number_format((float) $user->monthly_savings_goal, 2, '.', '')) }}"
                                               min="0" max="99999999.99" step="0.01" inputmode="decimal"
                                               @error('monthly_savings_goal') aria-invalid="true" aria-describedby="goal-error" @enderror>
                                        @error('monthly_savings_goal')
                                            <span class="field-error" id="goal-error">{{ $message }}</span>
                                        @else
                                            <span class="field-hint">Used in Reports to track your savings progress.</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" id="saveProfileBtn" disabled>
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- CHANGE PASSWORD --}}
                    @if (Route::has('profile.password'))
                    <div class="card">
                        <div class="card-head">
                            <div class="card-head-icon"><i class="fa-solid fa-lock" aria-hidden="true"></i></div>
                            <div>
                                <h2>Change password</h2>
                                <p>Use a long, unique password to keep your financial data safe.</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('profile.password') }}" method="POST" id="passwordForm" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="form-grid">

                                    <div class="form-group full">
                                        <label for="current_password">Current password</label>
                                        <div class="password-wrap">
                                            <input type="password" id="current_password" name="current_password"
                                                   class="{{ $errors->updatePassword->has('current_password') ? 'has-error' : '' }}"
                                                   autocomplete="current-password" required>
                                            <button type="button" class="toggle-pass" data-target="current_password"
                                                    aria-label="Show password">
                                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @if ($errors->updatePassword->has('current_password'))
                                            <span class="field-error">{{ $errors->updatePassword->first('current_password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New password</label>
                                        <div class="password-wrap">
                                            <input type="password" id="password" name="password"
                                                   class="{{ $errors->updatePassword->has('password') ? 'has-error' : '' }}"
                                                   autocomplete="new-password" minlength="8" required>
                                            <button type="button" class="toggle-pass" data-target="password"
                                                    aria-label="Show password">
                                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @if ($errors->updatePassword->has('password'))
                                            <span class="field-error">{{ $errors->updatePassword->first('password') }}</span>
                                        @else
                                            <span class="field-hint">At least 8 characters.</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm new password</label>
                                        <div class="password-wrap">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   autocomplete="new-password" minlength="8" required>
                                            <button type="button" class="toggle-pass" data-target="password_confirmation"
                                                    aria-label="Show password">
                                                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <span class="field-error" id="matchError" hidden>Passwords do not match.</span>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" id="savePasswordBtn">
                                        Update password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    {{-- DELETE ACCOUNT --}}
                    @if (Route::has('profile.destroy'))
                    <div class="card danger-card">
                        <div class="card-head">
                            <div class="card-head-icon"><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i></div>
                            <div>
                                <h2>Delete account</h2>
                                <p>This action cannot be undone.</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="danger-row">
                                <p>
                                    Deleting your account permanently removes your transactions,
                                    categories and budgets. Make sure you really want this.
                                </p>

                                <button type="button" class="btn btn-danger-soft" id="openDeleteModal">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    Delete my account
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </section>
    </main>

    {{-- ============ DELETE MODAL ============ --}}
    @if (Route::has('profile.destroy'))
    <div class="modal-overlay {{ $errors->userDeletion->isNotEmpty() ? 'show' : '' }}"
         id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="deleteTitle">
        <div class="modal-box">
            <h2 id="deleteTitle">Delete your account?</h2>
            <p>Enter your password to confirm. All your data will be erased permanently.</p>

            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <label for="delete_password">Password</label>
                    <input type="password" id="delete_password" name="password"
                           class="{{ $errors->userDeletion->has('password') ? 'has-error' : '' }}"
                           autocomplete="current-password" required>
                    @if ($errors->userDeletion->has('password'))
                        <span class="field-error">{{ $errors->userDeletion->first('password') }}</span>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancelDelete">Keep my account</button>
                    <button type="submit" class="btn btn-danger">Delete account</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- ============ FOOTER ============ --}}
    <footer class="site-footer">
        <div style="max-width:1400px; margin:0 auto; padding:24px 35px; display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;">

            <span style="color:var(--text-light); font-size:12px;">© {{ date('Y') }} CampusCoin. All rights reserved.</span>

            <div style="display:flex; align-items:center; flex-wrap:wrap; gap:18px;">
                <a href="{{ url('/dashboard') }}" style="color:var(--text-light); font-size:12px;">Dashboard</a>
                <a href="{{ url('/income-expense') }}" style="color:var(--text-light); font-size:12px;">Income &amp; Expenses</a>
                <a href="{{ url('/budgets-goal') }}" style="color:var(--text-light); font-size:12px;">Budget Goals</a>
                <a href="{{ url('/report-insights') }}" style="color:var(--text-light); font-size:12px;">Reports</a>
                <a href="{{ url('/saving-tips') }}" style="color:var(--text-light); font-size:12px;">Saving Tips</a>
            </div>

        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ---- Save button enabled only when something changed ---- */
            var profileFields = ['name', 'email', 'academic_year',
                                 'monthly_allowance_baseline', 'monthly_savings_goal']
                .map(function (id) { return document.getElementById(id); })
                .filter(Boolean);
            var saveBtn = document.getElementById('saveProfileBtn');
            var initial = {};
            profileFields.forEach(function (el) { initial[el.id] = el.value.trim(); });

            function checkDirty() {
                var changed = profileFields.some(function (el) {
                    return el.value.trim() !== initial[el.id];
                });
                saveBtn.disabled = !changed;
            }

            profileFields.forEach(function (el) {
                el.addEventListener('input', checkDirty);
                el.addEventListener('change', checkDirty);
            });
            checkDirty();

            /* ---- Stop double submit ---- */
            document.querySelectorAll('.profile-main form, #deleteModal form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    var btn = form.querySelector('button[type="submit"]');
                    if (btn) {
                        btn.disabled = true;
                        btn.textContent = 'Please wait...';
                    }
                });
            });

            /* ---- Show / hide password ---- */
            document.querySelectorAll('.toggle-pass').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var input = document.getElementById(btn.dataset.target);
                    var icon = btn.querySelector('i');
                    var show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    icon.className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
                    btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
                });
            });

            /* ---- Password match check ---- */
            var pass = document.getElementById('password');
            var confirmPass = document.getElementById('password_confirmation');
            var matchError = document.getElementById('matchError');
            var passwordForm = document.getElementById('passwordForm');

            if (pass && confirmPass && passwordForm) {
                function checkMatch() {
                    var mismatch = confirmPass.value.length > 0 && pass.value !== confirmPass.value;
                    matchError.hidden = !mismatch;
                    confirmPass.classList.toggle('has-error', mismatch);
                    return !mismatch;
                }
                confirmPass.addEventListener('input', checkMatch);
                pass.addEventListener('input', checkMatch);

                passwordForm.addEventListener('submit', function (e) {
                    if (!checkMatch()) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        confirmPass.focus();
                    }
                }, true);
            }

            /* ---- Delete modal ---- */
            var modal = document.getElementById('deleteModal');
            if (modal) {
                var openBtn = document.getElementById('openDeleteModal');
                var cancelBtn = document.getElementById('cancelDelete');

                function openModal() {
                    modal.classList.add('show');
                    document.getElementById('delete_password').focus();
                }
                function closeModal() {
                    modal.classList.remove('show');
                    if (openBtn) openBtn.focus();
                }

                openBtn.addEventListener('click', openModal);
                cancelBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && modal.classList.contains('show')) closeModal();
                });
            }

            /* ---- Auto-hide success message ---- */
            var statusAlert = document.getElementById('statusAlert');
            if (statusAlert) {
                setTimeout(function () {
                    statusAlert.style.transition = 'opacity .4s ease';
                    statusAlert.style.opacity = '0';
                    setTimeout(function () { statusAlert.remove(); }, 400);
                }, 5000);
            }
        });
    </script>

    <script src="{{ asset('js/script.js') }}" defer></script>

</body>
</html>