<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Saving Tips | CampusCoin</title>

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

@media (prefers-color-scheme: dark) {
  :root:not([data-theme="light"]) {
    --body: #0f1117;
    --surface: #181b24;
    --surface-2: #20242f;
    --navbar: #141720;
    --text: #f5f7fa;
    --text-light: #a7adba;
    --border: #303542;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
  }
}
:root[data-theme="dark"] {
  --body: #0f1117;
  --surface: #181b24;
  --surface-2: #20242f;
  --navbar: #141720;
  --text: #f5f7fa;
  --text-light: #a7adba;
  --border: #303542;
  --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html { scroll-padding-top: env(safe-area-inset-top, 0px); }

body {
  font-family: "Inter", sans-serif;
  background: var(--body);
  color: var(--text);
  min-height: 100%;
  transition: background var(--transition), color var(--transition);
}

button { cursor: pointer; font-family: inherit; border: none; background: none; color: inherit; }
a { text-decoration: none; color: inherit; }
ul { list-style: none; }
img, svg { max-width: 100%; display: block; }

/* ================= CONTENT SHELL ================= */
.content {
  padding: 34px 35px 60px;
  max-width: 1200px;
  margin: 0 auto;
}

/* ================= TIP OF THE DAY (only thing on top) ================= */
.tip-of-day {
  background: linear-gradient(160deg, var(--primary), var(--primary-dark));
  border-radius: 22px;
  box-shadow: var(--shadow);
  padding: 36px;
  color: #fff;
  position: relative;
  overflow: hidden;
  margin-bottom: 38px;
}
.tip-of-day::before {
  content: "";
  position: absolute;
  inset: -60% -10% auto auto;
  width: 420px; height: 420px;
  background: radial-gradient(circle, rgba(255,255,255,0.16), transparent 70%);
  pointer-events: none;
}
.tip-of-day .label {
  position: relative;
  font-size: 11px; font-weight: 700; opacity: 0.85;
  display: flex; align-items: center; gap: 6px; margin-bottom: 14px;
}
.tip-of-day h3 { position: relative; font-size: 26px; font-weight: 800; margin-bottom: 10px; line-height: 1.3; max-width: 26ch; }
.tip-of-day p { position: relative; font-size: 14px; opacity: 0.92; line-height: 1.7; max-width: 60ch; }

/* ================= SECTION TITLES ================= */
.section-title {
  display: flex; align-items: center; gap: 10px;
  font-size: 17px; font-weight: 800;
}
.section-title i { color: var(--primary); font-size: 15px; }
.section-title .count {
  background: var(--surface-2); color: var(--text-light);
  font-size: 11px; font-weight: 700;
  padding: 3px 9px; border-radius: 999px;
}

/* ================= ANNOUNCEMENTS ================= */
.announce-section { margin-bottom: 38px; }
.announce-section .section-title { margin-bottom: 16px; }
.announce-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
.announce-card {
  position: relative;
  display: flex; gap: 14px;
  background: var(--surface);
  border: 1px solid var(--border);
  border-left: 4px solid var(--amber);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 20px;
}
.announce-icon {
  width: 42px; height: 42px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  background: var(--amber-bg); font-size: 18px; flex-shrink: 0;
}
.announce-body h3 { font-size: 14.5px; font-weight: 800; line-height: 1.35; margin-bottom: 6px; }
.announce-body p { color: var(--text-light); font-size: 12.5px; line-height: 1.65; white-space: pre-line; }
.new-badge {
  display: inline-block; vertical-align: middle;
  background: var(--income-bg); color: var(--income);
  font-size: 10px; font-weight: 800;
  padding: 2px 8px; border-radius: 999px; margin-left: 6px;
}

/* ================= CONTROLS ================= */
.tips-controls {
  display: flex; align-items: center; justify-content: space-between;
  gap: 16px; flex-wrap: wrap; margin-bottom: 20px;
}
.controls-left { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.streak-chip {
  display: inline-flex; align-items: center; gap: 6px;
  background: var(--amber-bg); color: var(--amber);
  font-size: 11.5px; font-weight: 700;
  padding: 6px 12px; border-radius: 999px;
}

.search-box {
  position: relative;
  width: 280px;
  max-width: 100%;
}
.search-box input {
  width: 100%;
  padding: 10px 14px 10px 36px;
  border-radius: 12px;
  border: 1px solid var(--border);
  background: var(--surface);
  color: var(--text);
  font-size: 12.5px;
  font-family: inherit;
}
.search-box input:focus {
  outline: none;
  border-color: var(--primary);
}
.search-box i {
  position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
  color: var(--text-light); font-size: 12px;
}

/* ================= TIPS GRID ================= */
.tips-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}

.tip-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 22px;
  transition: border-color var(--transition), transform var(--transition);
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.tip-card:hover { border-color: var(--primary-light); }
.tip-card.hidden { display: none; }

.tip-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
.tip-icon {
  width: 42px; height: 42px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  background: var(--surface-2); font-size: 18px; flex-shrink: 0;
}
.tried-toggle {
  width: 26px; height: 26px; border-radius: 8px;
  border: 1.5px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  color: transparent; font-size: 12px;
  transition: var(--transition);
  flex-shrink: 0;
}
.tried-toggle.done {
  background: var(--income); border-color: var(--income); color: #fff;
}

.tip-card h3 { font-size: 14.5px; font-weight: 800; line-height: 1.35; }
.tip-card p.desc { color: var(--text-light); font-size: 12.5px; line-height: 1.6; }

.tip-detail {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease;
}
.tip-card.expanded .tip-detail { max-height: 200px; }
.tip-detail-inner {
  border-top: 1px solid var(--border);
  padding-top: 12px; margin-top: 2px;
}
.tip-detail-inner p { font-size: 12px; color: var(--text-light); line-height: 1.6; margin-bottom: 10px; }

.tip-card-footer {
  display: flex; align-items: center; justify-content: space-between;
  margin-top: auto;
}
.expand-btn {
  font-size: 12px; font-weight: 600; color: var(--primary);
  display: flex; align-items: center; gap: 5px;
}
.expand-btn i { font-size: 10px; transition: transform var(--transition); }
.tip-card.expanded .expand-btn i { transform: rotate(180deg); }

.empty-state {
  grid-column: 1 / -1;
  text-align: center;
  padding: 50px 20px;
  color: var(--text-light);
}
.empty-state i { font-size: 26px; margin-bottom: 10px; color: var(--border); }
.empty-state p { font-size: 13px; }

/* ================= FOOTER ================= */
.site-footer { background: var(--navbar); border-top: 1px solid var(--border); margin-top: 60px; transition: background var(--transition); }
.footer-inner { max-width: 1400px; margin: 0 auto; padding: 50px 35px 0; }
.footer-columns { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; padding-bottom: 40px; border-bottom: 1px solid var(--border); }
.footer-col h4 { font-size: 12px; font-weight: 700; margin-bottom: 18px; letter-spacing: 0.3px; }
.footer-col ul { display: flex; flex-direction: column; gap: 12px; }
.footer-col ul li a { color: var(--text-light); font-size: 12.5px; transition: var(--transition); }
.footer-col ul li a:hover { color: var(--primary); }
.footer-bottom { padding: 22px 0 26px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
.footer-locale { display: flex; align-items: center; gap: 8px; color: var(--text-light); font-size: 12px; font-weight: 600; }
.footer-locale i { color: var(--primary); }
.footer-legal { display: flex; align-items: center; flex-wrap: wrap; gap: 18px; }
.footer-legal a { color: var(--text-light); font-size: 11.5px; }
.footer-legal a:hover { color: var(--primary); }
.footer-copyright { color: var(--text-light); font-size: 11px; }
.footer-social { display: flex; gap: 10px; }
.footer-social a {
  width: 36px; height: 36px; border-radius: 10px; border: 1px solid var(--border);
  background: var(--surface-2); color: var(--text-light);
  display: flex; align-items: center; justify-content: center; font-size: 13px;
  transition: var(--transition);
}
.footer-social a:hover { color: var(--primary); border-color: var(--primary); }

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
  .tips-grid { grid-template-columns: repeat(2, 1fr); }
  .footer-columns { grid-template-columns: repeat(2, 1fr); gap: 30px 20px; }
}
@media (max-width: 850px) {
  .content { padding: 25px 20px; }
}
@media (max-width: 700px) {
  .footer-inner { padding: 40px 20px 0; }
  .footer-columns { grid-template-columns: 1fr; gap: 26px; }
  .footer-bottom { flex-direction: column; align-items: flex-start; }
  .footer-legal { gap: 12px 16px; }
  .tips-controls { flex-direction: column; align-items: stretch; }
  .search-box { width: 100%; }
  .announce-list { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
  .tips-grid { grid-template-columns: 1fr; }
  .tip-of-day { padding: 26px 20px; }
  .tip-of-day h3 { font-size: 21px; }
}
@media (prefers-reduced-motion: reduce) {
  * { transition-duration: 0.01ms !important; }
}
</style>
</head>

<body>
@include('nav')
  <main>
    <section class="content">

      <!-- TOP: only ONE tip (Tip of the Day) -->
      <div class="tip-of-day" id="tipOfDay">
        <div class="label"><i class="fa-solid fa-star"></i> TIP OF THE DAY</div>
        <h3 id="totTitle">Loading…</h3>
        <p id="totDesc"></p>
      </div>

      <!-- BELOW: announcements (hidden when there are none) -->
      <div class="announce-section" id="announceSection" style="display:none;">
        <div class="section-title">
          <i class="fa-solid fa-bullhorn"></i> Announcements
          <span class="count" id="announceCount">0</span>
        </div>
        <div class="announce-list" id="announceList"></div>
      </div>

      <!-- BELOW: all other saving tips -->
      <div class="tips-controls">
        <div class="controls-left">
          <div class="section-title"><i class="fa-solid fa-lightbulb"></i> More Saving Tips</div>
          <span class="streak-chip"><i class="fa-solid fa-fire"></i> <span id="triedCount">0</span> tips tried this month</span>
        </div>
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" id="searchInput" placeholder="Search tips…">
        </div>
      </div>

      <div class="tips-grid" id="tipsGrid"></div>

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

  <script>
  (function () {

    // ---------- Data injected from SavingTipsController ----------
    // tips:          published rows where type = 'Saving Tip'
    // announcements: published rows where type = 'Announcement'
    var tips          = @json($tips ?? []);
    var announcements = @json($announcements ?? []);

    var triedState = {};
    var searchTerm = '';

    var grid = document.getElementById('tipsGrid');
    var triedCountEl = document.getElementById('triedCount');

    // Tip of the day: one tip, rotates by date. It is shown ONLY at the top.
    var featured = tips.length > 0 ? tips[new Date().getDate() % tips.length] : null;

    // Escape admin-entered text before putting it into innerHTML
    function esc(s) {
      return String(s == null ? '' : s)
        .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }
    function newBadge(t) {
      return t.is_new ? '<span class="new-badge">NEW</span>' : '';
    }

    function updateCounts() {
      var triedTotal = Object.keys(triedState).filter(function (k) { return triedState[k]; }).length;
      triedCountEl.textContent = triedTotal;
    }

    // ---------- Announcements ----------
    function renderAnnouncements() {
      var section = document.getElementById('announceSection');
      var list = document.getElementById('announceList');

      if (announcements.length === 0) {
        section.style.display = 'none';
        return;
      }

      section.style.display = 'block';
      document.getElementById('announceCount').textContent = announcements.length;
      list.innerHTML = announcements.map(function (a) {
        return '<div class="announce-card">' +
                '<div class="announce-icon">' + a.icon + '</div>' +
                '<div class="announce-body">' +
                  '<h3>' + esc(a.title) + newBadge(a) + '</h3>' +
                  '<p>' + esc(a.detail) + '</p>' +
                '</div>' +
              '</div>';
      }).join('');
    }

    // ---------- Tips (everything except the tip of the day) ----------
    function render() {
      grid.innerHTML = '';
      var term = searchTerm.trim().toLowerCase();

      var visible = tips.filter(function (t) {
        if (featured && t.id === featured.id) return false;
        return !term || (t.title + ' ' + t.desc).toLowerCase().indexOf(term) !== -1;
      });

      if (visible.length === 0) {
        var msg = term
          ? 'No tips match your search. Try a different word.'
          : (tips.length === 0 ? 'No tips have been published yet — check back soon.' : 'More tips are coming soon.');
        grid.innerHTML = '<div class="empty-state"><i class="fa-solid fa-magnifying-glass"></i><p>' + msg + '</p></div>';
        return;
      }

      visible.forEach(function (t) {
        var id = 'tip-' + t.id;
        var card = document.createElement('div');
        card.className = 'tip-card';
        card.innerHTML =
          '<div class="tip-card-top">' +
            '<div class="tip-icon">' + t.icon + '</div>' +
            '<button class="tried-toggle" aria-label="Mark as tried"><i class="fa-solid fa-check"></i></button>' +
          '</div>' +
          '<h3>' + esc(t.title) + newBadge(t) + '</h3>' +
          '<p class="desc">' + esc(t.desc) + '</p>' +
          '<div class="tip-detail"><div class="tip-detail-inner">' +
            '<p>' + esc(t.detail) + '</p>' +
          '</div></div>' +
          '<div class="tip-card-footer">' +
            '<button class="expand-btn">Show more <i class="fa-solid fa-chevron-down"></i></button>' +
          '</div>';

        var expandBtn = card.querySelector('.expand-btn');
        expandBtn.addEventListener('click', function () {
          var expanded = card.classList.toggle('expanded');
          expandBtn.firstChild.textContent = expanded ? 'Show less ' : 'Show more ';
        });

        var triedBtn = card.querySelector('.tried-toggle');
        if (triedState[id]) triedBtn.classList.add('done');
        triedBtn.addEventListener('click', function () {
          triedState[id] = !triedState[id];
          triedBtn.classList.toggle('done', !!triedState[id]);
          updateCounts();
        });

        grid.appendChild(card);
      });
    }

    document.getElementById('searchInput').addEventListener('input', function (e) {
      searchTerm = e.target.value;
      render();
    });

    // ---------- Tip of the day (top) ----------
    if (featured) {
      document.getElementById('totTitle').textContent = featured.title;
      document.getElementById('totDesc').textContent = featured.desc;
    } else {
      document.getElementById('tipOfDay').style.display = 'none';
    }

    updateCounts();
    renderAnnouncements();
    render();

  })();
  </script>

</body>
</html>