<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Campus Coin - Bookmarks & Notes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <style>
        :root {
            --navy-950: #0b1330;
            --navy-900: #10193a;
            --navy-800: #1d4ed8;
            --navy-700: #2563eb;

            --mint-600: #2563eb;
            --mint-500: #2563eb;
            --mint-400: #3b82f6;
            --mint-100: #e8effe;

            --page: #eef2fb;
            --page-alt: #e3ebf9;
            --card: #ffffff;

            --text: #101828;
            --muted: #667085;
            --border: #e6eaf3;

            --warning: #d97706;
            --warning-bg: #fef3e2;

            --danger: #dc2626;
            --danger-bg: #fdeceb;

            --shadow: 0 14px 34px rgba(16, 24, 40, 0.07);
            --shadow-soft: 0 7px 20px rgba(16, 24, 40, 0.05);

            --navbar: var(--card);
            --primary: var(--mint-600);
            --primary-light: var(--mint-400);
            --surface-2: var(--page-alt);
            --text-light: var(--muted);
            --expense: var(--danger);

            --transition: 0.25s ease;
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
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.5;
            overflow-x: hidden;
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
            transition: background .25s ease, color .25s ease;
        }

        button, input, textarea, select { font: inherit; }
        button { cursor: pointer; }
        a { color: inherit; text-decoration: none; }

        .container { width: min(1120px, calc(100% - 40px)); margin: 0 auto; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--navy-950), var(--navy-800));
            color: #ffffff;
            padding: 76px 0 72px;
        }
        .hero-inner { display: flex; align-items: end; justify-content: space-between; gap: 40px; }
        .hero-copy { max-width: 720px; }
        .eyebrow {
            margin: 0 0 7px; color: var(--mint-600); font-size: 0.73rem; font-weight: 850;
            letter-spacing: 0.14em; text-transform: uppercase;
        }
        .hero .eyebrow { color: var(--mint-400); }
        h1, h2, h3, p { margin-top: 0; }
        h1 { margin-bottom: 14px; font-size: clamp(2.35rem, 5vw, 4rem); line-height: 1.02; letter-spacing: -0.045em; }
        h2 { margin-bottom: 0; font-size: clamp(1.45rem, 2.5vw, 1.9rem); line-height: 1.2; letter-spacing: -0.03em; }
        h3 { margin-bottom: 6px; }
        .hero-copy > p:last-child { max-width: 650px; margin-bottom: 0; color: #cbd9e0; }

        /* Buttons */
        .primary-btn {
            min-height: 45px; border-radius: 9px; padding: 10px 17px; font-weight: 800; border: none;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }
        .primary-btn { border: 1px solid var(--mint-500); background: var(--mint-500); color: #ffffff; }
        .primary-btn:hover { background: var(--navy-800); transform: translateY(-1px); }
        .primary-btn:disabled { opacity: .6; cursor: not-allowed; transform: none; }
        .hero-btn { min-width: 160px; }

        /* Sections */
        .summary-section, .bookmarks-section, .notes-section { padding: 60px 0; }
        .section-heading {
            display: flex; align-items: end; justify-content: space-between; gap: 25px; margin-bottom: 25px;
        }
        .section-note { margin: 0; color: var(--muted); font-size: 0.88rem; }
        .subsection { margin-bottom: 40px; }
        .subsection:last-child { margin-bottom: 0; }
        .subsection-title { margin-bottom: 18px; }
        .subsection-title h3 { font-size: 1.15rem; }
        .subsection-title p { color: var(--muted); font-size: 0.85rem; }

        /* Summary */
        .summary-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .summary-card {
            display: flex; gap: 13px; align-items: flex-start; padding: 20px;
            border: 1px solid var(--border); border-radius: 15px; background: var(--card); box-shadow: var(--shadow-soft);
        }
        .summary-icon {
            width: 39px; height: 39px; flex: 0 0 39px; display: grid; place-items: center;
            border-radius: 10px; background: var(--mint-100); color: var(--navy-800); font-size: 15px;
        }
        body.dark .summary-icon { color: var(--mint-400); }
        .summary-card span, .summary-card small { display: block; }
        .summary-card span { color: var(--muted); font-size: 0.77rem; font-weight: 700; }
        .summary-card strong { display: block; margin: 3px 0 2px; color: var(--text); font-size: 1.5rem; }
        .summary-card small { color: var(--muted); font-size: 0.7rem; }

        /* Bookmarks */
        .bookmarks-section { background: var(--page); }
        .card-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .insight-card {
            padding: 24px; border: 1px solid var(--border); border-radius: 16px; background: var(--card);
            box-shadow: var(--shadow); display: flex; flex-direction: column; justify-content: space-between;
            gap: 20px; min-height: 230px;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .insight-card:hover { transform: translateY(-3px); border-color: rgba(37, 99, 235, 0.35); }
        .card-label {
            display: inline-block; color: var(--mint-600); font-size: 0.7rem; font-weight: 850;
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;
        }
        .insight-card h4 { font-size: 1.05rem; margin-bottom: 8px; }
        .insight-card p { color: var(--muted); font-size: 0.87rem; }
        .bookmark-btn {
            align-self: flex-start; border: 1px solid var(--border); border-radius: 8px; padding: 9px 15px;
            background: transparent; color: var(--text); font-size: 0.82rem; font-weight: 750;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }
        .bookmark-btn:hover { border-color: var(--mint-600); color: var(--mint-600); }
        .bookmark-btn.active { background: var(--mint-100); border-color: var(--mint-600); color: var(--mint-600); }
        .bookmark-btn:disabled { opacity: .6; cursor: not-allowed; }

        /* Notes */
        .notes-section { background: var(--page-alt); border-top: 1px solid var(--border); }
        .notes-layout { display: grid; grid-template-columns: 0.85fr 1.15fr; gap: 25px; }
        .panel { padding: 25px; border: 1px solid var(--border); border-radius: 16px; background: var(--card); box-shadow: var(--shadow); }
        .panel h3 { font-size: 1.2rem; margin-bottom: 5px; }
        .panel-description { color: var(--muted); font-size: 0.85rem; margin-bottom: 20px; }
        .panel-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 15px; }
        .field { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        .field label { color: var(--text); font-size: 0.84rem; font-weight: 800; }
        .field input, .field textarea {
            width: 100%; border: 1px solid var(--border); border-radius: 9px; padding: 10px 12px;
            outline: none; background: var(--card); color: var(--text); resize: vertical;
        }
        .field input:focus, .field textarea:focus {
            border-color: var(--mint-500); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
        }
        .form-message { min-height: 20px; margin: 8px 0 0; color: var(--danger); font-size: 0.83rem; font-weight: 700; }
        .form-message.success { color: var(--mint-600); }
        .count-label {
            display: inline-flex; align-items: center; justify-content: center; padding: 6px 12px;
            border-radius: 999px; background: var(--mint-100); color: var(--navy-800);
            font-size: 0.78rem; font-weight: 800; white-space: nowrap;
        }
        body.dark .count-label { color: var(--mint-400); }

        .notes-list { display: flex; flex-direction: column; gap: 12px; max-height: 440px; overflow-y: auto; }
        .note-item { padding: 15px; border: 1px solid var(--border); border-radius: 12px; background: var(--page); }
        .note-item h4 { font-size: 0.98rem; margin-bottom: 6px; }
        .note-item p { color: var(--muted); font-size: 0.86rem; white-space: pre-wrap; }
        .note-footer { margin-top: 12px; display: flex; justify-content: space-between; align-items: center; gap: 10px; }
        .note-date { color: var(--muted); font-size: 0.7rem; }
        .delete-note {
            border: none; background: var(--danger-bg); color: var(--danger); padding: 6px 10px;
            border-radius: 7px; font-size: 0.75rem; font-weight: 750;
        }

        /* Empty States */
        .empty-state {
            padding: 44px; border: 1px solid var(--border); border-radius: 16px; background: var(--card);
            box-shadow: var(--shadow-soft); text-align: center;
        }
        .empty-icon {
            width: 48px; height: 48px; display: grid; place-items: center; margin: 0 auto 13px;
            border-radius: 13px; background: var(--mint-100); color: var(--mint-600); font-size: 1.2rem;
        }
        .empty-state p { color: var(--muted); }

        /* Footer */
        .site-footer {
            padding: 31px 0 18px; background: var(--navy-950); color: #ffffff;
            padding-bottom: calc(18px + env(safe-area-inset-bottom, 0px));
        }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 25px; }
        .site-footer p { margin: 3px 0 0; color: #9fb1bc; font-size: 0.82rem; }
        .footer-links { display: flex; flex-wrap: wrap; gap: 19px; }
        .footer-links a { color: #c6d5dc; font-size: 0.83rem; font-weight: 700; }
        .footer-links a:hover { color: var(--mint-400); }

        /* Toast */
        .toast {
            position: fixed; right: 25px; bottom: 25px; z-index: 300; padding: 12px 18px;
            background: var(--navy-900); color: #ffffff; border-radius: 9px; box-shadow: var(--shadow);
            opacity: 0; visibility: hidden; transform: translateY(15px);
            transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
        }
        .toast.show { opacity: 1; visibility: visible; transform: translateY(0); }

        body:not(.dark) .summary-card,
        body:not(.dark) .insight-card,
        body:not(.dark) .panel,
        body:not(.dark) .empty-state {
            border-color: rgba(37, 99, 235, 0.18);
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.06), 0 10px 30px rgba(16, 24, 40, 0.08);
            backdrop-filter: blur(8px);
        }

        @media (max-width: 950px) {
            .card-grid { grid-template-columns: repeat(2, 1fr); }
            .notes-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 760px) {
            .container { width: min(100% - 28px, 1120px); }
            .hero { padding: 55px 0 48px; }
            .hero-inner, .section-heading, .footer-inner { align-items: flex-start; flex-direction: column; }
            .hero-btn { width: 100%; }
            .summary-section, .bookmarks-section, .notes-section { padding: 44px 0; }
            .summary-grid, .card-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .panel, .insight-card { padding: 20px; }
        }

        @media print {
            body { background: #ffffff; color: #000000; }
            .site-header, .site-footer, .bookmark-btn, .toast { display: none !important; }
            .hero { background: none; color: #000000; padding: 20px 0; }
            .hero .eyebrow { color: #000000; }
            .summary-section, .bookmarks-section, .notes-section { padding: 20px 0; }
        }
    </style>
</head>

<body>

    @include('nav')

    <main id="top">

        <!-- HERO -->
        <section class="hero">
            <div class="container hero-inner">

                <div class="hero-copy">
                    <p class="eyebrow">Personal Finance</p>
                    <h1>Bookmarks & Notes</h1>
                    <p>
                        Save useful financial insights and keep personal notes
                        in one place.
                    </p>
                </div>

                <button class="primary-btn hero-btn" id="jumpToNotes" type="button">
                    Add a Note
                </button>

            </div>
        </section>

        <!-- SUMMARY -->
        <section class="summary-section" id="overview">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">At a Glance</p>
                        <h2>Your saved items</h2>
                    </div>
                    <p class="section-note">
                        Bookmarks and notes are saved to your Campus Coin account.
                    </p>
                </div>

                <div class="summary-grid">

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-bookmark"></i></div>
                        <div>
                            <span>Total Bookmarks</span>
                            <strong id="summaryBookmarkCount">0</strong>
                            <small>Saved insights</small>
                        </div>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon"><i class="fa-solid fa-note-sticky"></i></div>
                        <div>
                            <span>Saved Notes</span>
                            <strong id="summaryNotesCount">0</strong>
                            <small>Saved to your account</small>
                        </div>
                    </article>

                </div>

            </div>
        </section>

        <!-- BOOKMARKS -->
        <section class="bookmarks-section" id="bookmarks">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Saved Insights</p>
                        <h2>Your Bookmarks</h2>
                    </div>
                    <span class="count-label" id="bookmarkCount">0 Saved</span>
                </div>

                <div class="subsection">
                    <div class="subsection-title">
                        <h3>Bookmarked Saving Tips</h3>
                        <p>Useful tips you have saved for later.</p>
                    </div>

                    <div class="card-grid">
                        @foreach ([
                            'daily-spending' => ['Track Your Daily Spending', 'Keeping track of small daily expenses can help you understand where your money is going.'],
                            'monthly-saving' => ['Set a Monthly Saving Goal', 'Choose a realistic monthly target and keep your savings goal visible.'],
                            'subscriptions' => ['Review Subscriptions', 'Regularly check your subscriptions and remove services you no longer use.'],
                        ] as $key => $tip)
                            <article class="insight-card">
                                <div>
                                    <span class="card-label">Saving Tip</span>
                                    <h4>{{ $tip[0] }}</h4>
                                    <p>{{ $tip[1] }}</p>
                                </div>
                                <button class="bookmark-btn" type="button" data-bookmark="{{ $key }}">Bookmark</button>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="subsection">
                    <div class="subsection-title">
                        <h3>Bookmarked Monthly Insights</h3>
                        <p>Monthly information you want to keep for reference.</p>
                    </div>

                    <div class="card-grid">
                        @foreach ([
                            'expense-review' => ['Monthly Expense Review', 'Review your expenses at the end of each month to identify useful spending patterns.'],
                            'savings-progress' => ['Savings Progress', 'Compare your current savings with your monthly and yearly financial targets.'],
                            'budget-performance' => ['Budget Performance', 'Check whether your actual spending stayed within your planned monthly budget.'],
                        ] as $key => $tip)
                            <article class="insight-card">
                                <div>
                                    <span class="card-label">Monthly Insight</span>
                                    <h4>{{ $tip[0] }}</h4>
                                    <p>{{ $tip[1] }}</p>
                                </div>
                                <button class="bookmark-btn" type="button" data-bookmark="{{ $key }}">Bookmark</button>
                            </article>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

        <!-- NOTES -->
        <section class="notes-section" id="notes">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Personal Notes</p>
                        <h2>Notes</h2>
                    </div>
                </div>

                <div class="notes-layout">

                    <div class="panel">
                        <h3>Add Note</h3>
                        <p class="panel-description">Create a personal note and save it to your account.</p>

                        <form id="noteForm">
                            <div class="field">
                                <label for="noteTitle">Note Title</label>
                                <input type="text" id="noteTitle" placeholder="Enter note title" required>
                            </div>
                            <div class="field">
                                <label for="noteContent">Note Content</label>
                                <textarea id="noteContent" rows="7" placeholder="Write your note here..." required></textarea>
                            </div>
                            <button class="primary-btn" type="submit">Save Note</button>
                            <p class="form-message" id="noteMessage"></p>
                        </form>
                    </div>

                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h3>Saved Notes</h3>
                                <p class="panel-description">Your saved notes appear here.</p>
                            </div>
                            <span class="count-label" id="notesCount">0 Notes</span>
                        </div>

                        <div id="notesList" class="notes-list">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-note-sticky"></i></div>
                                <h4>No notes yet</h4>
                                <p>Add your first note using the form.</p>
                            </div>
                        </div>
                    </div>

                </div>
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

    <div id="toast" class="toast">Action completed.</div>

    <script>
        (function () {
            "use strict";

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            /* ---------- Toast ---------- */
            const toast = document.getElementById("toast");
            let toastTimer;
            function showToast(message) {
                toast.textContent = message;
                toast.classList.add("show");
                clearTimeout(toastTimer);
                toastTimer = setTimeout(() => toast.classList.remove("show"), 2500);
            }

            /* ---------- Bookmarks (backed by /api/bookmarks) ---------- */
            const bookmarkButtons = document.querySelectorAll(".bookmark-btn");
            const bookmarkCount = document.getElementById("bookmarkCount");
            const summaryBookmarkCount = document.getElementById("summaryBookmarkCount");

            function setButtonState(button, isActive) {
                button.classList.toggle("active", isActive);
                button.textContent = isActive ? "Bookmarked" : "Bookmark";
            }

            function updateBookmarkCounts() {
                const count = Array.from(bookmarkButtons).filter(b => b.classList.contains("active")).length;
                bookmarkCount.textContent = count + " Saved";
                summaryBookmarkCount.textContent = count;
            }

            async function loadBookmarks() {
                try {
                    const res = await fetch('/api/bookmarks', { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('Failed to load bookmarks');
                    const data = await res.json();
                    const saved = new Set(data.bookmarks || []);
                    bookmarkButtons.forEach(btn => setButtonState(btn, saved.has(btn.dataset.bookmark)));
                    updateBookmarkCounts();
                } catch (err) {
                    console.error(err);
                    showToast("Could not load bookmarks.");
                }
            }

            async function toggleBookmark(button) {
                const key = button.dataset.bookmark;
                const isActive = button.classList.contains("active");
                button.disabled = true;

                try {
                    if (isActive) {
                        const res = await fetch(`/api/bookmarks/${key}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        });
                        if (!res.ok) throw new Error('Failed to remove bookmark');
                        setButtonState(button, false);
                        showToast("Bookmark removed.");
                    } else {
                        const res = await fetch('/api/bookmarks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ bookmark: key }),
                        });
                        if (!res.ok) throw new Error('Failed to add bookmark');
                        setButtonState(button, true);
                        showToast("Bookmark saved.");
                    }
                    updateBookmarkCounts();
                } catch (err) {
                    console.error(err);
                    showToast("Something went wrong. Please try again.");
                } finally {
                    button.disabled = false;
                }
            }

            bookmarkButtons.forEach(button => button.addEventListener("click", () => toggleBookmark(button)));
            loadBookmarks();

            /* ---------- Notes (backed by /api/notes) ---------- */
            const noteForm = document.getElementById("noteForm");
            const noteTitle = document.getElementById("noteTitle");
            const noteContent = document.getElementById("noteContent");
            const noteMessage = document.getElementById("noteMessage");
            const notesList = document.getElementById("notesList");
            const notesCount = document.getElementById("notesCount");
            const summaryNotesCount = document.getElementById("summaryNotesCount");

            function escapeHtml(text) {
                const div = document.createElement("div");
                div.textContent = text;
                return div.innerHTML;
            }

            function renderNotes(notes) {
                notesCount.textContent = notes.length + " Notes";
                summaryNotesCount.textContent = notes.length;

                if (notes.length === 0) {
                    notesList.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-note-sticky"></i></div>
                            <h4>No notes yet</h4>
                            <p>Add your first note using the form.</p>
                        </div>
                    `;
                    return;
                }

                notesList.innerHTML = "";
                notes.forEach(note => {
                    const el = document.createElement("article");
                    el.className = "note-item";
                    el.innerHTML = `
                        <h4>${escapeHtml(note.title)}</h4>
                        <p>${escapeHtml(note.content)}</p>
                        <div class="note-footer">
                            <span class="note-date">${escapeHtml(note.date)}</span>
                            <button class="delete-note" type="button" data-id="${note.id}">Delete</button>
                        </div>
                    `;
                    notesList.appendChild(el);
                });

                document.querySelectorAll(".delete-note").forEach(btn => {
                    btn.addEventListener("click", () => deleteNote(Number(btn.dataset.id)));
                });
            }

            async function loadNotes() {
                try {
                    const res = await fetch('/api/notes', { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('Failed to load notes');
                    const data = await res.json();
                    renderNotes(data.notes || []);
                } catch (err) {
                    console.error(err);
                    showToast("Could not load notes.");
                }
            }

            noteForm.addEventListener("submit", async (event) => {
                event.preventDefault();
                const title = noteTitle.value.trim();
                const content = noteContent.value.trim();

                if (!title || !content) {
                    noteMessage.textContent = "Please fill in both fields.";
                    noteMessage.classList.remove("success");
                    return;
                }

                const submitBtn = noteForm.querySelector('button[type="submit"]');
                submitBtn.disabled = true;

                try {
                    const res = await fetch('/api/notes', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ title, content }),
                    });
                    if (!res.ok) throw new Error('Failed to save note');

                    noteForm.reset();
                    await loadNotes();
                    noteMessage.textContent = "Note saved successfully.";
                    noteMessage.classList.add("success");
                    showToast("Note saved.");
                } catch (err) {
                    console.error(err);
                    noteMessage.textContent = "Could not save note. Please try again.";
                    noteMessage.classList.remove("success");
                } finally {
                    submitBtn.disabled = false;
                }
            });

            async function deleteNote(noteId) {
                try {
                    const res = await fetch(`/api/notes/${noteId}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    });
                    if (!res.ok) throw new Error('Failed to delete note');
                    await loadNotes();
                    showToast("Note deleted.");
                } catch (err) {
                    console.error(err);
                    showToast("Could not delete note.");
                }
            }

            loadNotes();

            document.getElementById("jumpToNotes").addEventListener("click", () => {
                document.getElementById("notes").scrollIntoView({ behavior: "smooth" });
                noteTitle.focus();
            });
        })();
    </script>

</body>

</html>