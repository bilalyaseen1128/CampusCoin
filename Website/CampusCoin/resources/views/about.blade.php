    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>About | CampusCoin</title>

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

        --amber: #f59e0b;
        --amber-bg: rgba(245, 158, 11, 0.12);

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
    body.dark .feature-card,
    body.dark .stat-pill,
    body.dark .value-card {
        background: var(--surface);
        border-color: var(--border);
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
    input {
        font-family: inherit;
    }


    button {
        cursor: pointer;
    }


    a {
        text-decoration: none;
        color: inherit;
    }


    ul {
        list-style: none;
    }


    /* ================= MAIN ================= */

    .main-content {

        min-height: 100vh;
    }


    .content {

        padding: 34px 35px 10px;

        max-width: 1200px;

        margin: 0 auto;
    }


    /* ================= HERO ================= */

    .about-hero {

        position: relative;

        text-align: center;

        max-width: 720px;

        margin: 20px auto 50px;

        overflow: hidden;
    }


    .about-hero .eyebrow {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        background: rgba(124, 92, 255, 0.12);

        color: var(--primary);

        font-size: 11.5px;

        font-weight: 700;

        padding: 7px 14px;

        border-radius: 999px;

        margin-bottom: 18px;
    }


    .about-hero h1 {

        font-size: 34px;

        font-weight: 800;

        line-height: 1.3;

        margin-bottom: 16px;
    }


    .about-hero h1 span {
        color: var(--primary);
    }


    .about-hero p.lead {

        color: var(--text-light);

        font-size: 14.5px;

        line-height: 1.75;

        max-width: 56ch;

        margin: 0 auto;
    }


    /* ================= STATS ================= */

    .stats-strip {

        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 16px;

        margin-bottom: 55px;
    }


    .stat-pill {

        background: var(--surface);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        box-shadow: var(--shadow);

        padding: 22px;

        text-align: center;

        transition: var(--transition);
    }


    .stat-pill:hover {

        transform: translateY(-3px);
    }


    .stat-pill strong {

        display: block;

        font-size: 24px;

        font-weight: 800;

        color: var(--primary);

        margin-bottom: 4px;
    }


    .stat-pill span {

        color: var(--text-light);

        font-size: 11.5px;
    }


    /* ================= SECTION HEADING ================= */

    .section-heading {

        text-align: center;

        max-width: 560px;

        margin: 0 auto 30px;
    }


    .section-heading h2 {

        font-size: 22px;

        font-weight: 800;

        margin-bottom: 8px;
    }


    .section-heading p {

        color: var(--text-light);

        font-size: 13px;

        line-height: 1.6;
    }


    /* ================= MISSION ================= */

    .mission-block {

        display: grid;

        grid-template-columns: 0.9fr 1.1fr;

        gap: 40px;

        align-items: center;

        background: var(--surface);

        border: 1px solid var(--border);

        border-radius: 22px;

        box-shadow: var(--shadow);

        padding: 40px;

        margin-bottom: 60px;
    }


    .mission-icon-wrap {

        width: 100%;

        aspect-ratio: 1;

        max-width: 220px;

        margin: 0 auto;

        border-radius: 26px;

        background: linear-gradient(160deg, var(--primary), var(--primary-dark));

        display: flex;

        align-items: center;
        justify-content: center;

        color: white;

        font-size: 60px;
    }


    .mission-text .eyebrow {

        display: inline-block;

        color: var(--primary);

        font-size: 11.5px;

        font-weight: 700;

        letter-spacing: 0.4px;

        text-transform: uppercase;

        margin-bottom: 10px;
    }


    .mission-text h2 {

        font-size: 21px;

        font-weight: 800;

        margin-bottom: 14px;

        line-height: 1.4;
    }


    .mission-text p {

        color: var(--text-light);

        font-size: 13.5px;

        line-height: 1.75;

        margin-bottom: 14px;
    }


    .mission-text p:last-child {
        margin-bottom: 0;
    }


    /* ================= FEATURES ================= */

    .feature-grid {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 18px;

        margin-bottom: 60px;
    }


    .feature-card {

        background: var(--surface);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        box-shadow: var(--shadow);

        padding: 24px;

        transition: var(--transition);
    }


    .feature-card:hover {

        transform: translateY(-3px);

        border-color: var(--primary-light);
    }


    .feature-icon {

        width: 46px;
        height: 46px;

        border-radius: 13px;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 19px;

        margin-bottom: 16px;
    }


    .feature-card h3 {

        font-size: 14.5px;

        font-weight: 800;

        margin-bottom: 8px;
    }


    .feature-card p {

        color: var(--text-light);

        font-size: 12.5px;

        line-height: 1.65;
    }


    /* ================= VALUES ================= */

    .values-grid {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 18px;

        margin-bottom: 60px;
    }


    .value-card {

        background: var(--surface);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        padding: 26px 22px;

        text-align: center;
    }


    .value-card i {

        font-size: 22px;

        color: var(--primary);

        margin-bottom: 14px;
    }


    .value-card h3 {

        font-size: 13.5px;

        font-weight: 800;

        margin-bottom: 8px;
    }


    .value-card p {

        color: var(--text-light);

        font-size: 12px;

        line-height: 1.6;
    }


    /* ================= CTA ================= */

    .about-cta {

        position: relative;

        background: linear-gradient(150deg, var(--primary), var(--primary-dark));

        border-radius: 22px;

        padding: 50px 40px;

        text-align: center;

        color: white;

        overflow: hidden;

        margin-bottom: 60px;
    }


    .about-cta::before {

        content: "";

        position: absolute;

        inset: -40% auto auto -10%;

        width: 320px; height: 320px;

        background: radial-gradient(circle, rgba(255,255,255,0.12), transparent 70%);
    }


    .about-cta h2 {

        font-size: 24px;

        font-weight: 800;

        margin-bottom: 10px;

        position: relative;
    }


    .about-cta p {

        font-size: 13.5px;

        opacity: 0.9;

        max-width: 46ch;

        margin: 0 auto 26px;

        line-height: 1.7;

        position: relative;
    }


    .cta-btn {

        display: inline-flex;

        align-items: center;

        gap: 9px;

        background: white;

        color: var(--primary-dark);

        font-size: 13px;

        font-weight: 700;

        padding: 13px 26px;

        border-radius: 12px;

        position: relative;

        transition: var(--transition);
    }


    .cta-btn:hover {

        transform: translateY(-2px);
    }


    /* ================= RESPONSIVE ================= */

    @media (max-width: 1050px) {

        .mission-block {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .mission-icon-wrap {
            margin-bottom: 10px;
        }
    }


    @media (max-width: 900px) {

        .stats-strip {
            grid-template-columns: repeat(2, 1fr);
        }

        .feature-grid,
        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }


    @media (max-width: 700px) {

        .content {
            padding: 25px 20px 5px;
        }

        .about-hero h1 {
            font-size: 26px;
        }

        .mission-block {
            padding: 28px 22px;
        }

        .about-cta {
            padding: 36px 22px;
        }
    }


    @media (max-width: 560px) {

        .stats-strip,
        .feature-grid,
        .values-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
    </head>

    <body>

        @include('nav')

        <main class="main-content">

            <section class="content">

                <!-- HERO -->
                <div class="about-hero">
                    <span class="eyebrow"><i class="fa-solid fa-coins"></i> About CampusCoin</span>
                    <h1>Built for students, by people who <span>ran out of money</span> mid-semester too.</h1>
                    <p class="lead">CampusCoin is a simple finance tracker made for student life — irregular allowances, part-time shifts, hostel rent, and the constant juggling act in between. No spreadsheets, no jargon, just a clear picture of where your money goes.</p>
                </div>

                <!-- STATS -->
                <div class="stats-strip">

                    <div class="stat-pill">
                        <strong>12</strong>
                        <span>Built-in saving tips</span>
                    </div>

                    <div class="stat-pill">
                        <strong>4</strong>
                        <span>Core tools</span>
                    </div>

                    <div class="stat-pill">
                        <strong>Rs. 500+</strong>
                        <span>Avg. monthly saved by users</span>
                    </div>

                    <div class="stat-pill">
                        <strong>100%</strong>
                        <span>Free for students</span>
                    </div>

                </div>

                <!-- MISSION -->
                <div class="mission-block">

                    <div class="mission-icon-wrap">
                        <i class="fa-solid fa-piggy-bank"></i>
                    </div>

                    <div class="mission-text">
                        <span class="eyebrow">Our Mission</span>
                        <h2>Make student money management feel doable, not overwhelming.</h2>
                        <p>Most budgeting apps are built for salaried adults with predictable paychecks. Student finances don't look like that — money comes in bursts (allowance, a scholarship installment, a part-time paycheck) and goes out just as unevenly.</p>
                        <p>CampusCoin was built around that reality: quick logging, categories that actually match student life, and budget goals that flex with an irregular income — so you spend less time managing money and more time understanding it.</p>
                    </div>

                </div>

                <!-- FEATURES -->
                <div class="section-heading">
                    <h2>Everything in one place</h2>
                    <p>The core tools students actually use, without the clutter of a full accounting app.</p>
                </div>

                <div class="feature-grid">

                    <div class="feature-card">
                        <div class="feature-icon" style="background:rgba(124,92,255,0.12); color:var(--primary);">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <h3>Income & Expenses</h3>
                        <p>Log every rupee in and out in seconds, and see your balance update in real time.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon" style="background:rgba(59,130,246,0.12); color:#3b82f6;">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h3>Custom Categories</h3>
                        <p>Start with student-life categories like Hostel, Academics and Subscriptions, or add your own.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon" style="background:var(--amber-bg); color:var(--amber);">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h3>Budget Goals</h3>
                        <p>Set a target for the month — or for a laptop, a trip, anything — and track progress visually.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon" style="background:var(--income-bg); color:var(--income);">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <h3>Reports & Insights</h3>
                        <p>Weekly and monthly breakdowns that actually explain where your money went, not just numbers.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon" style="background:var(--expense-bg); color:var(--expense);">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h3>Saving Tips</h3>
                        <p>Practical, student-specific tips pulled from how CampusCoin users actually save money.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon" style="background:rgba(124,92,255,0.12); color:var(--primary);">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h3>One Dashboard</h3>
                        <p>Your balance, recent activity and goals at a glance the moment you open the app.</p>
                    </div>

                </div>

                <!-- VALUES -->
                <div class="section-heading">
                    <h2>What we care about</h2>
                    <p>A few principles that shape every feature we build.</p>
                </div>

                <div class="values-grid">

                    <div class="value-card">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <h3>Made for student budgets</h3>
                        <p>No premium tier gatekeeping the features that actually help you save.</p>
                    </div>

                    <div class="value-card">
                        <i class="fa-solid fa-shield-halved"></i>
                        <h3>Your data stays yours</h3>
                        <p>Your finances are personal — we keep it that way, with no selling of your data.</p>
                    </div>

                    <div class="value-card">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <h3>Simple over feature-heavy</h3>
                        <p>Every feature has to earn its place. If it adds friction instead of clarity, it doesn't ship.</p>
                    </div>

                </div>

                <!-- CTA -->
                <div class="about-cta">
                    <h2>Ready to see where your money's actually going?</h2>
                    <p>Set up your first category and log your first transaction in under two minutes.</p>
                    <a href="{{ route('dashboard') }}">
                        <span class="cta-btn">
                            <i class="fa-solid fa-arrow-right"></i>
                            Go to Dashboard
                        </span>
                    </a>
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

    </body>

    </html>