<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusCoin | Take Control of Your Campus Finances</title>
    <meta name="description" content="CampusCoin helps students track income and expenses, set budget goals, and build better saving habits — all in one simple dashboard.">
    <meta property="og:title" content="CampusCoin | Take Control of Your Campus Finances">
    <meta property="og:description" content="Track spending, set budget goals, and build better saving habits — built for student life.">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#2563eb">
    <link rel="icon" type="image/jpeg" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Apply saved/system theme BEFORE first paint (prevents light flash) -->
    <script>
        (function () {
            var saved = null;
            try { saved = localStorage.getItem('cc-theme'); } catch (e) {}
            var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();
    </script>

    <style>
        :root {
            color-scheme: light;
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

        html.dark,
        body.dark {
            color-scheme: dark;
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

        * { box-sizing: border-box; }
        html { background: var(--bg); -webkit-text-size-adjust: 100%; scroll-behavior: smooth; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            * { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background .25s ease, color .25s ease;
            overflow-x: hidden;
            width: 100%;
        }

        img, svg { max-width: 100%; }
        a { color: inherit; }
        section { padding: clamp(48px, 8vw, 90px) clamp(16px, 4vw, 24px); }
        .section-inner { max-width: 1120px; margin: 0 auto; }
        .section-head { text-align: center; max-width: 620px; margin: 0 auto clamp(30px, 5vw, 50px); }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 12.5px;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 999px;
            margin-bottom: 18px;
            text-align: left;
        }

        .section-head h2 { font-size: clamp(22px, 4.5vw, 30px); font-weight: 800; margin: 0 0 10px; }
        .section-head p { color: var(--text-muted); font-size: 14.5px; line-height: 1.6; margin: 0; }

        /* ---------- Reveal-on-scroll ---------- */
        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .55s ease, transform .55s ease;
        }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }

        /* ---------- Theme toggle ---------- */
        .theme-toggle {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 50;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--card-bg);
            color: var(--text);
            box-shadow: 0 10px 25px var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }
        .theme-toggle:hover { transform: translateY(-3px) scale(1.05); }
        .theme-toggle:active { transform: translateY(0) scale(0.96); }
        .theme-toggle .fa-sun { display: none; color: var(--star); }
        html.dark .theme-toggle .fa-moon,
        body.dark .theme-toggle .fa-moon { display: none; }
        html.dark .theme-toggle .fa-sun,
        body.dark .theme-toggle .fa-sun { display: inline-block; }

        /* ---------- Hero ---------- */
        .hero {
            background: linear-gradient(150deg, var(--overlay-1), var(--overlay-2));
            color: #fff;
            padding: clamp(70px, 14vw, 120px) clamp(16px, 4vw, 24px) clamp(60px, 10vw, 100px);
            position: relative;
            overflow: hidden;
        }

        .hero::before, .hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            filter: blur(20px);
        }
        .hero::before { width: 380px; height: 380px; top: -120px; right: -80px; }
        .hero::after { width: 300px; height: 300px; bottom: -140px; left: -60px; }

        .hero-content {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .hero .eyebrow {
            background: rgba(255,255,255,.12);
            color: #fff;
            border: 1px solid rgba(255,255,255,.25);
        }

        .hero h1 {
            font-size: clamp(28px, 6vw, 44px);
            font-weight: 800;
            line-height: 1.2;
            margin: 22px 0 18px;
            word-wrap: break-word;
        }

        .hero h1 span {
            background: linear-gradient(90deg, #93c5fd, #c4b5fd);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero p {
            font-size: clamp(13.5px, 2.5vw, 15.5px);
            line-height: 1.7;
            color: rgba(255,255,255,.8);
            margin: 0 0 34px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
            white-space: nowrap;
            cursor: pointer;
            border: none;
        }
        .hero-btn:hover { transform: translateY(-2px); }
        .hero-btn:focus-visible { outline: 2px solid #fff; outline-offset: 3px; }

        .primary-btn { background: #fff; color: var(--overlay-2); }
        .primary-btn:hover { background: #e8effe; box-shadow: 0 10px 24px rgba(0,0,0,.2); }

        .secondary-btn {
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255,255,255,.5);
        }
        .secondary-btn:hover { background: rgba(255,255,255,.1); }

        /* ---------- How it works ---------- */
        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .step-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 28px 22px;
            text-align: center;
            position: relative;
            box-shadow: 0 12px 30px var(--shadow);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .step-card:hover { transform: translateY(-5px); box-shadow: 0 18px 36px var(--shadow); }

        .step-number {
            position: absolute;
            top: 16px;
            right: 20px;
            font-size: 12px;
            font-weight: 800;
            color: var(--text-muted);
            opacity: .5;
        }

        .step-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin: 0 auto 18px;
        }

        .step-card h3 { font-size: 15.5px; font-weight: 700; margin: 0 0 8px; }
        .step-card p { font-size: 13px; color: var(--text-muted); line-height: 1.6; margin: 0; }

        /* ---------- Features ---------- */
        .features-section { background: var(--card-bg); }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 26px;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 14px 30px var(--shadow); }

        .feature-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .feature-card h3 { font-size: 15.5px; font-weight: 700; margin: 0 0 8px; }
        .feature-card p { font-size: 13px; color: var(--text-muted); line-height: 1.6; margin: 0; }

        /* ---------- Categories ---------- */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 14px;
        }

        .category-chip {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 10px;
            text-align: center;
            box-shadow: 0 8px 20px var(--shadow);
            transition: transform .2s ease;
        }
        .category-chip:hover { transform: translateY(-4px); }

        .category-chip i {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 10px;
            display: block;
        }

        .category-chip span { font-size: 12px; font-weight: 600; color: var(--text); }

        /* ---------- FAQ ---------- */
        .faq-list { display: flex; flex-direction: column; gap: 12px; max-width: 760px; margin: 0 auto; }

        .faq-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: 18px 22px;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            cursor: pointer;
            font-family: inherit;
        }

        .faq-question i { color: var(--primary); transition: transform .2s ease; flex-shrink: 0; }
        .faq-item.open .faq-question i { transform: rotate(180deg); }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height .25s ease;
        }

        .faq-answer p {
            margin: 0;
            padding: 0 22px 18px;
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* ---------- CTA ---------- */
        .cta-wrapper { padding-left: clamp(12px, 4vw, 24px); padding-right: clamp(12px, 4vw, 24px); }

        .cta-section {
            background: linear-gradient(150deg, var(--overlay-1), var(--overlay-2));
            border-radius: 26px;
            max-width: 1120px;
            margin: 0 auto;
            padding: clamp(40px, 8vw, 64px) clamp(20px, 6vw, 40px);
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .cta-section h2 { font-size: clamp(20px, 4.5vw, 28px); font-weight: 800; margin: 0 0 12px; }
        .cta-section p { font-size: 14px; color: rgba(255,255,255,.8); margin: 0 0 28px; }

        /* ---------- Footer ---------- */
        .site-footer {
            background: var(--navbar);
            border-top: 1px solid var(--border);
        }

        .site-footer .footer-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .site-footer .footer-copy { color: var(--text-light); font-size: 12px; }

        .site-footer .footer-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
        }

        .site-footer .footer-links a {
            color: var(--text-light);
            font-size: 12px;
            text-decoration: none;
            transition: color .2s ease;
        }

        .site-footer .footer-links a:hover { color: var(--primary); }

        /* ---------- Responsive ---------- */
        @media (max-width: 1024px) {
            .steps { grid-template-columns: repeat(2, 1fr); }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .categories-grid { grid-template-columns: repeat(4, 1fr); }
        }

        @media (max-width: 700px) {
            .categories-grid { grid-template-columns: repeat(3, 1fr); }
            .site-footer .footer-inner { padding: 22px 20px; }
        }

        @media (max-width: 560px) {
            .steps, .features-grid { grid-template-columns: 1fr; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .hero-buttons { flex-direction: column; align-items: stretch; }
            .hero-btn { width: 100%; }
            .step-card, .feature-card { padding: 22px 18px; }
            .cta-section { border-radius: 18px; }
            .theme-toggle { bottom: 16px; right: 16px; width: 44px; height: 44px; }
        }

        @media (max-width: 380px) {
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            section { padding: 40px 14px; }
        }
    </style>
</head>
<body>

    @include('nav')

    <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle dark mode" aria-pressed="false">
        <i class="fa-solid fa-moon" aria-hidden="true"></i>
        <i class="fa-solid fa-sun" aria-hidden="true"></i>
    </button>

    <section class="hero">
        <div class="hero-content">
            <span class="eyebrow">
                <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                Built for Students, By Students
            </span>

            <h1>
                Take Control Of <br>
                <span>Your Campus Finances.</span>
            </h1>

            <p>
                CampusCoin helps you track income and expenses, set budget goals,
                and build better saving habits — all in one simple dashboard made
                for student life.
            </p>

            <div class="hero-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hero-btn primary-btn">
                        <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                        Go to Dashboard
                    </a>
                    <a href="{{ url('/profile') }}" class="hero-btn secondary-btn">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        Manage Profile
                    </a>
                @else
                    <a href="{{ url('/register') }}" class="hero-btn primary-btn">
                        <i class="fa-solid fa-rocket" aria-hidden="true"></i>
                        Get Started
                    </a>
                    <a href="{{ url('/login') }}" class="hero-btn secondary-btn">
                        <i class="fa-solid fa-arrow-right-to-bracket" aria-hidden="true"></i>
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="section-inner">
            <div class="section-head reveal">
                <span class="eyebrow"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> How It Works</span>
                <h2>Managing money in 4 easy steps</h2>
                <p>From your first login to your first savings goal, CampusCoin keeps it simple.</p>
            </div>

            <div class="steps">
                <div class="step-card reveal">
                    <span class="step-number">01</span>
                    <div class="step-icon"><i class="fa-solid fa-user-plus" aria-hidden="true"></i></div>
                    <h3>Create Your Account</h3>
                    <p>Sign up in seconds with your university email and set up your profile.</p>
                </div>

                <div class="step-card reveal">
                    <span class="step-number">02</span>
                    <div class="step-icon"><i class="fa-solid fa-wallet" aria-hidden="true"></i></div>
                    <h3>Add Income & Expenses</h3>
                    <p>Log your allowance, part-time income, and daily spending in one place.</p>
                </div>

                <div class="step-card reveal">
                    <span class="step-number">03</span>
                    <div class="step-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></div>
                    <h3>Set Budget Goals</h3>
                    <p>Define monthly limits per category and get alerts before you overspend.</p>
                </div>

                <div class="step-card reveal">
                    <span class="step-number">04</span>
                    <div class="step-icon"><i class="fa-solid fa-chart-pie" aria-hidden="true"></i></div>
                    <h3>Track Your Progress</h3>
                    <p>See clear reports and insights that show exactly where your money goes.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="section-inner">
            <div class="section-head reveal">
                <span class="eyebrow"><i class="fa-solid fa-star" aria-hidden="true"></i> Features</span>
                <h2>Everything you need, nothing you don't</h2>
                <p>A complete toolkit built around how students actually manage money.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-chart-line" aria-hidden="true"></i></div>
                    <h3>Smart Dashboard</h3>
                    <p>A single, clear view of your balance, spending trends, and monthly summary.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-wallet" aria-hidden="true"></i></div>
                    <h3>Income & Expense Tracking</h3>
                    <p>Log every transaction quickly and categorize it automatically.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-layer-group" aria-hidden="true"></i></div>
                    <h3>Custom Categories</h3>
                    <p>Organize spending your way — food, transport, books, and more.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></div>
                    <h3>Budget Goals</h3>
                    <p>Set monthly targets and get notified as you approach your limits.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-chart-pie" aria-hidden="true"></i></div>
                    <h3>Reports & Insights</h3>
                    <p>Visual breakdowns that make it easy to spot habits and cut waste.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fa-solid fa-lightbulb" aria-hidden="true"></i></div>
                    <h3>Saving Tips</h3>
                    <p>Personalized suggestions to help you save more, every single month.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="section-inner">
            <div class="section-head reveal">
                <span class="eyebrow"><i class="fa-solid fa-layer-group" aria-hidden="true"></i> Categories</span>
                <h2>Track spending across every part of student life</h2>
            </div>

            <div class="categories-grid">
                <div class="category-chip reveal"><i class="fa-solid fa-utensils" aria-hidden="true"></i><span>Food</span></div>
                <div class="category-chip reveal"><i class="fa-solid fa-bus" aria-hidden="true"></i><span>Transport</span></div>
                <div class="category-chip reveal"><i class="fa-solid fa-book" aria-hidden="true"></i><span>Books</span></div>
                <div class="category-chip reveal"><i class="fa-solid fa-house" aria-hidden="true"></i><span>Rent</span></div>
                <div class="category-chip reveal"><i class="fa-solid fa-film" aria-hidden="true"></i><span>Fun</span></div>
                <div class="category-chip reveal"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i><span>Savings</span></div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="section-inner">
            <div class="section-head reveal">
                <span class="eyebrow"><i class="fa-solid fa-circle-question" aria-hidden="true"></i> FAQ</span>
                <h2>Common questions</h2>
            </div>

            <div class="faq-list reveal">
                <div class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Is CampusCoin free to use?
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes — creating an account and tracking your income, expenses, and budgets is completely free for students.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Do I need a university email to sign up?
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="faq-answer">
                        <p>A university email helps us verify student status faster, but any valid email address works to get started.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Can I set separate budgets for each category?
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes. You can create custom categories and set a monthly limit for each one, with alerts as you approach the limit.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Is my financial data private?
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Your transactions and budgets are tied to your account and are never shared with other users.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-wrapper">
        <div class="cta-section reveal">
            <h2>Ready to take charge of your money?</h2>
            <p>Start budgeting smarter with CampusCoin.</p>
            @auth
                <a href="{{ url('/dashboard') }}" class="hero-btn primary-btn">
                    <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                    Go to Dashboard
                </a>
            @else
                <a href="{{ url('/register') }}" class="hero-btn primary-btn">
                    <i class="fa-solid fa-rocket" aria-hidden="true"></i>
                    Get Started Free
                </a>
            @endauth
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer">
        <div class="footer-inner">
            <span class="footer-copy">© 2026 CampusCoin. All Rights Reserved.</span>

            <div class="footer-links">
                <a href="/dashboard">Dashboard</a>
                <a href="/income-expense">Income & Expenses</a>
                <a href="/budgets-goal">Budget Goals</a>
                <a href="/report-insights">Reports</a>
                <a href="/saving-tips">Saving Tips</a>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            // ---- Theme toggle ----
            var html = document.documentElement;
            var body = document.body;
            var toggleBtn = document.getElementById('themeToggle');
            var themeMeta = document.querySelector('meta[name="theme-color"]');
            var mq = window.matchMedia('(prefers-color-scheme: dark)');

            function applyTheme(isDark) {
                html.classList.toggle('dark', isDark);
                body.classList.toggle('dark', isDark); // keeps the nav partial working if it uses body.dark
                if (toggleBtn) toggleBtn.setAttribute('aria-pressed', String(isDark));
                if (themeMeta) themeMeta.setAttribute('content', isDark ? '#0a0f1e' : '#2563eb');
            }

            // Sync with whatever the <head> script already decided
            applyTheme(html.classList.contains('dark'));

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    var nowDark = !html.classList.contains('dark');
                    applyTheme(nowDark);
                    try { localStorage.setItem('cc-theme', nowDark ? 'dark' : 'light'); } catch (e) {}
                });
            }

            // Follow system changes only if the user hasn't chosen manually
            if (mq.addEventListener) {
                mq.addEventListener('change', function (e) {
                    var saved = null;
                    try { saved = localStorage.getItem('cc-theme'); } catch (err) {}
                    if (!saved) applyTheme(e.matches);
                });
            }

            // ---- Scroll reveal ----
            var revealEls = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window && revealEls.length) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12 });
                revealEls.forEach(function (el) { observer.observe(el); });
            } else {
                revealEls.forEach(function (el) { el.classList.add('is-visible'); });
            }

            // ---- FAQ accordion ----
            document.querySelectorAll('.faq-item').forEach(function (item) {
                var question = item.querySelector('.faq-question');
                var answer = item.querySelector('.faq-answer');
                question.addEventListener('click', function () {
                    var isOpen = item.classList.contains('open');
                    document.querySelectorAll('.faq-item.open').forEach(function (openItem) {
                        if (openItem !== item) {
                            openItem.classList.remove('open');
                            openItem.querySelector('.faq-answer').style.maxHeight = null;
                            openItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                        }
                    });
                    item.classList.toggle('open', !isOpen);
                    question.setAttribute('aria-expanded', String(!isOpen));
                    answer.style.maxHeight = !isOpen ? answer.scrollHeight + 'px' : null;
                });
            });
        })();
    </script>

</body>
</html>