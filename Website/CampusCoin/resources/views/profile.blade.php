<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | CampusCoin</title>

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

body.dark .stat-card,
body.dark .card,
body.dark .empty-state,
body.dark .toast {
    background: var(--surface);
    border-color: var(--border);
}

body.dark .btn-secondary {
    background: var(--surface-2);
    color: var(--text);
    border-color: var(--border);
}

body.dark .form-group input,
body.dark .form-group select {
    background: var(--surface-2);
    border-color: var(--border);
    color: var(--text);
}


/* ================= RESET ================= */

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

    transition:
        background var(--transition),
        color var(--transition);
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


/* ================= MAIN ================= */

.main-content {

}


/* ================= CONTENT ================= */

.content {

    padding: 30px 35px 10px;

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


/* ================= TOAST / BANNERS ================= */

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

.alert-success {
    background: var(--income-bg);
    color: var(--income);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.alert-error {
    background: var(--expense-bg);
    color: var(--expense);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.field-error {
    color: var(--expense);
    font-size: 11px;
    font-weight: 600;
    margin-top: -2px;
}


/* ================= BUTTONS ================= */

.btn {

    border: 0;

    padding: 12px 18px;

    border-radius: 11px;

    font-size: 12px;

    font-weight: 700;

    transition: var(--transition);
}


.btn-primary {

    background:
        linear-gradient(
            135deg,
            var(--primary),
            var(--primary-light)
        );

    color: white;
}


.btn-primary:hover {

    transform: translateY(-2px);
}


.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}


/* ================= CARD ================= */

.card {

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: var(--radius);

    box-shadow: var(--shadow);

    overflow: hidden;
}


/* ================= PROFILE CARD ================= */

.profile-card {

    padding: 30px;
}


.profile-header {

    display: flex;

    align-items: center;

    gap: 18px;

    padding-bottom: 26px;

    margin-bottom: 26px;

    border-bottom: 1px solid var(--border);
}


.profile-avatar {

    width: 39px;
    height: 39px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            var(--primary),
            var(--primary-light)
        );

    color: white;

    font-weight: 700;

    overflow: hidden;
}


.profile-header .profile-avatar {

    width: 66px;
    height: 66px;

    font-size: 24px;
}


.profile-header h2 {

    font-size: 17px;

    font-weight: 800;

    margin-bottom: 3px;
}


.profile-header p {

    color: var(--text-light);

    font-size: 12px;
}


.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 6px;
    padding: 4px 10px;
    border-radius: 999px;
    background: var(--surface-2);
    border: 1px solid var(--border);
    font-size: 11px;
    font-weight: 700;
    color: var(--primary);
}


.form-grid {

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 20px;
}


.form-group {

    display: flex;

    flex-direction: column;

    gap: 8px;
}


.form-group label {

    font-size: 11.5px;

    font-weight: 700;

    color: var(--text-light);
}


.form-hint {
    font-size: 10.5px;
    color: var(--text-light);
    font-weight: 500;
}


.form-group input,
.form-group select {

    padding: 12px 14px;

    border-radius: 11px;

    border: 1px solid var(--border);

    background: var(--surface-2);

    color: var(--text);

    font-size: 13px;

    transition: var(--transition);
}


.form-group input.has-error,
.form-group select.has-error {
    border-color: var(--expense);
}


.form-group input:focus,
.form-group select:focus {

    outline: none;

    border-color: var(--primary);

    background: var(--surface);
}


.form-actions {

    margin-top: 18px;

    display: flex;

    justify-content: flex-end;
}


/* ================= FOOTER (Nike-inspired) ================= */

.site-footer {

    background: var(--navbar);

    border-top: 1px solid var(--border);

    margin-top: 20px;

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


.footer-legal a {

    color: var(--text-light);

    font-size: 11.5px;
}


.footer-legal a:hover {

    color: var(--primary);
}


.footer-copyright {

    color: var(--text-light);

    font-size: 11px;
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

    .footer-columns {

        grid-template-columns: repeat(2, 1fr);

        gap: 30px 20px;
    }
}


@media (max-width: 700px) {

    .footer-inner {

        padding: 40px 20px 0;
    }

    .footer-columns {

        grid-template-columns: 1fr;

        gap: 26px;
    }

    .footer-bottom {

        flex-direction: column;

        align-items: flex-start;
    }

    .footer-legal {

        gap: 12px 16px;
    }
}


/* ================= RESPONSIVE ================= */

@media (max-width: 850px) {

    .content {

        padding: 25px 20px;
    }
}


@media (max-width: 700px) {

    .form-grid {

        grid-template-columns: 1fr;
    }
}


@media (max-width: 600px) {

    .btn {

        width: 100%;

        text-align: center;
    }

    .form-actions .btn {

        width: 100%;
    }
}
</style>
</head>

<body>
@include('nav')

@php
    $user = auth()->user();
@endphp

    <!-- ================= MAIN CONTENT ================= -->

    <main class="main-content">

        <section class="content">

            <div class="page-heading">
                <h1>My Profile</h1>
                <p>Manage your CampusCoin account information.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                    Please fix the highlighted fields below and try again.
                </div>
            @endif

            <div class="card profile-card">

                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <h2>{{ $user->name ?? 'Guest User' }}</h2>
                        <p>{{ $user->email ?? '' }}</p>
                        <span class="role-badge">
                            <i class="fa-solid fa-user-shield" aria-hidden="true"></i>
                            {{ ucfirst($user->role ?? 'student') }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name"
                                   class="{{ $errors->has('name') ? 'has-error' : '' }}"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email"
                                   class="{{ $errors->has('email') ? 'has-error' : '' }}"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="academic_year">Academic Year</label>
                            @php $academicYear = old('academic_year', $user->academic_year ?: 'School'); @endphp
                            <select id="academic_year" name="academic_year"
                                    class="{{ $errors->has('academic_year') ? 'has-error' : '' }}">
                                <option value="School" @selected($academicYear === 'School')>School</option>
                                <option value="First Year" @selected($academicYear === 'First Year')>First Year</option>
                                <option value="Second Year" @selected($academicYear === 'Second Year')>Second Year</option>
                                <option value="University" @selected($academicYear === 'University')>University</option>
                                <option value="Graduate" @selected($academicYear === 'Graduate')>Graduate</option>
                            </select>
                            @error('academic_year')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="monthly_allowance_baseline">Monthly Allowance (₨)</label>
                            <input type="number" id="monthly_allowance_baseline" name="monthly_allowance_baseline"
                                   class="{{ $errors->has('monthly_allowance_baseline') ? 'has-error' : '' }}"
                                   value="{{ old('monthly_allowance_baseline', $user->monthly_allowance_baseline ?? '') }}"
                                   min="0" step="0.01" placeholder="e.g. 15000">
                            <span class="form-hint">Used as your baseline for budget comparisons.</span>
                            @error('monthly_allowance_baseline')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="monthly_savings_goal">Monthly Savings Goal (₨)</label>
                            <input type="number" id="monthly_savings_goal" name="monthly_savings_goal"
                                   class="{{ $errors->has('monthly_savings_goal') ? 'has-error' : '' }}"
                                   value="{{ old('monthly_savings_goal', $user->monthly_savings_goal ?? '') }}"
                                   min="0" step="0.01" placeholder="e.g. 3000">
                            @error('monthly_savings_goal')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                </form>

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