<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CampusCoin - Admin Control Panel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<style>
:root{
  --navy-950:#0b1330;
  --navy-900:#10193a;
  --navy-800:#1d4ed8;

  --mint-600:#2563eb;
  --mint-500:#2563eb;
  --mint-400:#3b82f6;
  --mint-100:#e8effe;

  --bg:#eef2fb;
  --surface:#ffffff;
  --surface2:#e3ebf9;
  --text:#101828;
  --muted:#667085;

  --primary:var(--mint-600);
  --primary-dark:var(--navy-800);
  --border:#e6eaf3;
  --shadow:0 14px 34px rgba(16,24,40,.07);

  --income:#16a34a;
  --income-bg:#e7f6ec;
  --danger:#dc2626;
  --danger-bg:#fdeceb;
  --warning:#d97706;
  --warning-bg:#fef3e2;
}
*{box-sizing:border-box}
body{margin:0;font-family:"Inter",ui-sans-serif,system-ui,sans-serif;background:var(--bg);color:var(--text)}
button,input,select,textarea{font:inherit}
button{cursor:pointer;border:0}
.app{display:flex;min-height:100vh}
.sidebar{width:255px;background:var(--navy-950);color:#fff;padding:25px 16px;display:flex;flex-direction:column;position:fixed;inset:0 auto 0 0}
.brand{display:flex;gap:12px;align-items:center;padding:4px 10px 32px}
.brand-icon{width:42px;height:42px;border-radius:13px;background:var(--mint-400);color:#0b1330;display:grid;place-items:center;font-size:22px;font-weight:800}
.brand h2{font-family:"Inter";font-weight:800;font-size:19px;margin:0}.brand span{font-size:11px;color:#8a96b3}
nav{display:grid;gap:7px}.nav-link{background:transparent;color:#a7adba;text-align:left;padding:13px 14px;border-radius:11px;display:flex;gap:12px;align-items:center;font-weight:500}
.nav-link:hover,.nav-link.active{background:var(--navy-900);color:#fff}.nav-link.active{box-shadow:inset 3px 0 var(--mint-400)}
.sidebar-bottom{margin-top:auto}.admin-card{display:flex;gap:10px;align-items:center;padding:13px 8px;border-top:1px solid #202c49}.avatar,.top-avatar{display:grid;place-items:center;border-radius:50%;background:var(--mint-100);color:var(--navy-800);font-weight:800}
.avatar{width:38px;height:38px}.admin-card strong,.admin-card small{display:block}.admin-card small{font-size:11px;color:#8a96b3;margin-top:2px}.logout{background:transparent;color:#a7adba;padding:11px 8px;font-weight:600}
.main{margin-left:255px;width:calc(100% - 255px);padding:28px 36px}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px}.eyebrow{color:var(--muted);font-size:12px;margin:0 0 5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase}.topbar h1{font-family:"Inter";font-weight:800;margin:0;font-size:29px;letter-spacing:-.02em}.top-actions{display:flex;gap:12px;align-items:center}.icon-btn{width:42px;height:42px;border-radius:12px;background:var(--surface);border:1px solid var(--border);color:var(--text)}.top-avatar{width:42px;height:42px}
.page-section{display:none}.page-section.active{display:block}
.welcome{background:linear-gradient(135deg,var(--navy-950),var(--navy-800));border:1px solid var(--border);border-radius:20px;padding:28px;display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;color:#fff}
.welcome h2{font-family:"Inter";font-weight:800;margin:8px 0 5px;font-size:25px;letter-spacing:-.02em;color:#fff}.welcome p{color:#cbd9e0;margin:0}
.section-head h2{font-family:"Inter";font-weight:800;margin:8px 0 5px;font-size:25px;letter-spacing:-.02em}.section-head p{color:var(--muted);margin:0}
.badge{display:inline-block;background:rgba(255,255,255,.14);color:#dbe6ff;font-size:10px;font-weight:800;letter-spacing:1px;padding:6px 9px;border-radius:20px}
.section-head .badge{background:var(--mint-100);color:var(--navy-800)}
.primary,.secondary{padding:11px 16px;border-radius:9px;font-weight:800}.primary{background:var(--primary);color:#fff;border:1px solid var(--primary)}.primary:hover{background:var(--primary-dark)}.secondary{background:var(--surface);border:1px solid var(--border);color:var(--text)}.secondary:hover{border-color:var(--primary)}
.welcome .primary{background:var(--mint-500);border-color:var(--mint-500)}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:17px;margin-bottom:22px}.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:15px;padding:19px;display:flex;gap:14px;align-items:center;box-shadow:var(--shadow)}.stat-card span,.stat-card small{display:block;color:var(--muted);font-size:12px}.stat-card strong{font-family:"Inter";font-weight:800;display:block;font-size:26px;margin:3px 0}.stat-icon{width:42px;height:42px;border-radius:10px;display:grid;place-items:center;font-size:18px}
.green{background:var(--mint-100);color:var(--navy-800)}.blue{background:#dbeafe;color:#1d4ed8}.orange{background:var(--warning-bg);color:var(--warning)}.purple{background:#e5e0fb;color:#5b3fc4}
.two-col{display:grid;grid-template-columns:1.25fr 1fr;gap:20px}.panel{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:20px;box-shadow:var(--shadow)}.panel-head{display:flex;justify-content:space-between;margin-bottom:17px}.panel h3{margin:0;font-family:"Inter";font-weight:800}.panel-head p{color:var(--muted);font-size:12px;margin:4px 0}
.section-head{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:22px}.filter-row{display:flex;gap:10px;margin-bottom:15px}.search,select,textarea{border:1px solid var(--border);background:var(--surface);color:var(--text);padding:11px 13px;border-radius:9px;outline:none}.search:focus,select:focus,textarea:focus,input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.14)}.search{width:280px}select{min-width:150px}
table{width:100%;border-collapse:collapse}th{text-align:left;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;padding:13px;border-bottom:1px solid var(--border);font-weight:700}td{padding:14px 13px;border-bottom:1px solid var(--border);font-size:13px}tr:last-child td{border-bottom:0}.table-panel{overflow:auto}
.type,.status{display:inline-flex;padding:5px 8px;border-radius:20px;font-size:10px;font-weight:800}
.type.income{background:var(--mint-100);color:var(--navy-800)}.type.expense{background:var(--danger-bg);color:var(--danger)}
.status.active{background:var(--mint-100);color:var(--navy-800)}.status.disabled{background:var(--surface2);color:var(--muted)}
.amount{font-weight:800;white-space:nowrap}.amount.income{color:var(--income)}.amount.expense{color:var(--danger)}
.flag{display:inline-flex;padding:4px 8px;border-radius:20px;font-size:10px;font-weight:800;background:var(--warning-bg);color:var(--warning);margin-left:6px}
.empty-row{text-align:center;color:var(--muted);padding:28px 13px}
.action-btn{padding:7px 9px;border-radius:8px;background:var(--surface2);font-size:11px;margin-right:4px;font-weight:700;color:var(--text)}.action-btn:hover{border:1px solid var(--primary)}.action-btn.danger{color:var(--danger)}.action-btn.warning{color:var(--warning)}
.content-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.content-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:19px;box-shadow:var(--shadow)}.content-card .content-type{font-size:10px;color:var(--primary);font-weight:800;text-transform:uppercase}.content-card h3{margin:8px 0;font-family:"Inter";font-weight:800}.content-card p{color:var(--muted);line-height:1.6;font-size:13px}.content-actions{border-top:1px solid var(--border);padding-top:13px;margin-top:15px}
.category-bars{display:grid;gap:15px}.bar-row{display:grid;grid-template-columns:110px 1fr 40px;align-items:center;gap:10px;font-size:12px}.bar-track{height:8px;background:var(--surface2);border-radius:999px;overflow:hidden}.bar-fill{height:100%;background:var(--primary);border-radius:999px}
.activity-item{display:flex;gap:10px;padding:11px 0;border-bottom:1px solid var(--border);font-size:12px}.activity-item:last-child{border:0}.activity-dot{width:8px;height:8px;background:var(--primary);border-radius:50%;margin-top:5px}.activity-item small{display:block;color:var(--muted);margin-top:3px}
.large-stat{display:block}.large-stat strong{font-size:38px;margin:8px 0}.large-stat{min-height:130px}
.donut-wrap{display:flex;align-items:center;gap:30px;min-height:220px}.donut{width:160px;height:160px;border-radius:50%;background:conic-gradient(var(--income) 0 34%,var(--danger) 34% 100%);display:grid;place-items:center}.donut>div{width:108px;height:108px;border-radius:50%;background:var(--surface);display:grid;place-items:center;align-content:center}.donut strong{font-size:23px;font-family:"Inter";font-weight:800}.donut span{font-size:11px;color:var(--muted)}.legend p{font-size:12px}.dot{display:inline-block;width:9px;height:9px;border-radius:50%;margin-right:6px}.dot.income{background:var(--income)}.dot.expense{background:var(--danger)}.legend b{margin-left:18px}
.toast{position:fixed;right:28px;top:24px;background:var(--navy-950);color:#fff;padding:12px 17px;border-radius:10px;opacity:0;transform:translateY(-10px);transition:.25s;z-index:10}.toast.show{opacity:1;transform:none}
.modal{position:fixed;inset:0;background:rgba(11,19,48,.55);display:none;place-items:center;z-index:20;padding:20px}.modal.show{display:grid}.modal-box{width:min(500px,100%);background:var(--surface);border-radius:17px;padding:25px;position:relative;box-shadow:0 25px 70px rgba(0,0,0,.25)}.modal-box h3{font-family:"Inter";font-weight:800;font-size:22px;margin:0 0 20px}.close{position:absolute;right:17px;top:14px;background:transparent;font-size:25px;color:var(--muted)}.form-group{margin-bottom:15px}.form-group label{display:block;font-size:12px;font-weight:800;margin-bottom:6px}.form-group input,.form-group select,.form-group textarea{width:100%}.form-actions{display:flex;justify-content:flex-end;gap:9px;margin-top:20px}
.dark{--bg:#0a0f1e;--surface:#111a2e;--surface2:#0d1526;--text:#eef1f8;--muted:#8a96b3;--border:#202c49;--shadow:0 18px 42px rgba(0,0,0,.24);--mint-100:#16233f;--income-bg:#123322;--danger-bg:#3a1717;--warning-bg:#3a2b0c}
.dark .welcome{background:linear-gradient(135deg,#0a0f1e,#152551);border-color:#202c49}
.dark td,.dark .activity-item,.dark th{border-color:#202c49}
.dark .donut>div{background:var(--surface)}
.dark .blue{background:#16233f;color:#60a5fa}.dark .purple{background:#241b3f;color:#a78bfa}.dark .orange{background:var(--warning-bg);color:#fbbf24}
@media(max-width:1050px){.stats-grid{grid-template-columns:repeat(2,1fr)}.two-col{grid-template-columns:1fr}.content-grid{grid-template-columns:1fr}}
@media(max-width:760px){.sidebar{width:72px;padding:18px 10px}.brand{justify-content:center;padding-bottom:25px}.brand div:not(.brand-icon),.nav-link span,.admin-card div:not(.avatar),.logout{display:none}.nav-link{justify-content:center}.main{margin-left:72px;width:calc(100% - 72px);padding:20px}.section-head,.welcome{align-items:flex-start;flex-direction:column;gap:16px}.stats-grid{grid-template-columns:1fr}.search{width:100%}.filter-row{flex-direction:column}}
</style>
<body>
  <div class="app">
    <aside class="sidebar">
      <div class="brand">
        <div class="brand-icon">₿</div>
        <div>
          <h2>CampusCoin</h2>
          <span>Admin Panel</span>
        </div>
      </div>

      <nav>
        <button class="nav-link active" data-section="overview">⌂ <span>Overview</span></button>
        <button class="nav-link" data-section="categories">▦ <span>Categories</span></button>
        <button class="nav-link" data-section="transactions">↕ <span>Transactions</span></button>
        <button class="nav-link" data-section="content">✦ <span>Tips & Announcements</span></button>
        <button class="nav-link" data-section="users">♙ <span>User Accounts</span></button>
        <button class="nav-link" data-section="statistics">◔ <span>Statistics</span></button>
      </nav>

      <div class="sidebar-bottom">
        <div class="admin-card">
          <div class="avatar">{{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}</div>
          <div>
            <strong>{{ $admin->name }}</strong>
            <small>Admin</small>
          </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to logout?')">
          @csrf
          <button type="submit" id="logoutBtn" class="logout">↪ Logout</button>
        </form>
      </div>
    </aside>

    <main class="main">
      <header class="topbar">
        <div>
          <p class="eyebrow">CampusCoin / Administration</p>
          <h1 id="pageTitle">Overview</h1>
        </div>
        <div class="top-actions">
          <button class="icon-btn" id="themeBtn" title="Toggle theme">☾</button>
          <div class="top-avatar">{{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}</div>
        </div>
      </header>

      <div id="toast" class="toast"></div>

      <section id="overview" class="page-section active">
        <div class="welcome">
          <div>
            <span class="badge">CONTROL PANEL</span>
            <h2>Manage CampusCoin from one place.</h2>
            <p>Control categories, system content, student accounts and usage statistics.</p>
          </div>
          <button class="primary" data-go="statistics">View Statistics →</button>
        </div>

        <div class="stats-grid">
          <article class="stat-card">
            <div class="stat-icon green">♙</div>
            <div><span>Active Users</span><strong id="activeUsers">0</strong><small>Currently active</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon blue">↕</div>
            <div><span>Total Transactions</span><strong id="totalTransactions">0</strong><small>Income + expenses</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon orange">▦</div>
            <div><span>Default Categories</span><strong id="categoryCount">0</strong><small>Available to students</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon purple">✦</div>
            <div><span>Published Content</span><strong id="contentCount">0</strong><small>Tips & announcements</small></div>
          </article>
        </div>

        <div class="two-col">
          <article class="panel">
            <div class="panel-head"><div><h3>Most Used Categories</h3><p>Based on real transaction usage</p></div></div>
            <div id="topCategories" class="category-bars"></div>
          </article>

          <article class="panel">
            <div class="panel-head"><div><h3>Recent Activity</h3><p>Latest admin actions</p></div></div>
            <div id="activityList" class="activity-list"></div>
          </article>
        </div>
      </section>

      <section id="categories" class="page-section">
        <div class="section-head">
          <div><span class="badge">DEFAULT CATEGORIES</span><h2>Income & Expense Categories</h2><p>These categories are available to all students.</p></div>
          <button class="primary" id="addCategoryBtn">+ Add Category</button>
        </div>
        <div class="filter-row">
          <input id="categorySearch" class="search" placeholder="Search categories...">
          <select id="categoryTypeFilter">
            <option value="all">All Types</option><option value="income">Income</option><option value="expense">Expense</option>
          </select>
        </div>
        <div class="panel table-panel">
          <table>
            <thead><tr><th>Category</th><th>Type</th><th>Status</th><th>Usage</th><th>Actions</th></tr></thead>
            <tbody id="categoryTable"></tbody>
          </table>
        </div>
      </section>

      <section id="transactions" class="page-section">
        <div class="section-head">
          <div><span class="badge">ALL TRANSACTIONS</span><h2>Student Transactions</h2><p>View income and expenses recorded by students (latest 500, read-only).</p></div>
        </div>

        <div class="stats-grid">
          <article class="stat-card">
            <div class="stat-icon blue">↕</div>
            <div><span>Transactions Shown</span><strong id="txShown">0</strong><small>Matching your filters</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon green">↑</div>
            <div><span>Total Income</span><strong id="txIncome">0.00</strong><small>Shown transactions</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon orange">↓</div>
            <div><span>Total Expenses</span><strong id="txExpense">0.00</strong><small>Shown transactions</small></div>
          </article>
          <article class="stat-card">
            <div class="stat-icon purple">＝</div>
            <div><span>Net Balance</span><strong id="txNet">0.00</strong><small>Income − expenses</small></div>
          </article>
        </div>

        <div class="filter-row">
          <input id="txSearch" class="search" placeholder="Search student, category or description...">
          <select id="txTypeFilter">
            <option value="all">All Types</option><option value="income">Income</option><option value="expense">Expense</option>
          </select>
        </div>

        <div class="panel table-panel">
          <table>
            <thead><tr><th>Date</th><th>Student</th><th>Category</th><th>Description</th><th>Type</th><th>Amount</th></tr></thead>
            <tbody id="transactionTable"></tbody>
          </table>
        </div>
      </section>

      <section id="content" class="page-section">
        <div class="section-head">
          <div><span class="badge">SYSTEM CONTENT</span><h2>Tips & Announcements</h2><p>Create reusable system-wide content for students.</p></div>
          <button class="primary" id="addContentBtn">+ Add Template</button>
        </div>
        <div id="contentCards" class="content-grid"></div>
      </section>

      <section id="users" class="page-section">
        <div class="section-head">
          <div><span class="badge">USER ACCOUNTS</span><h2>Student Accounts</h2><p>View or delete student accounts.</p></div>
        </div>
        <div class="filter-row">
          <input id="userSearch" class="search" placeholder="Search by name or email...">
          <select id="userStatusFilter">
            <option value="all">All Statuses</option><option value="active">Active</option><option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="panel table-panel">
          <table>
            <thead><tr><th>Student</th><th>Email</th><th>Transactions</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody id="userTable"></tbody>
          </table>
        </div>
      </section>

      <section id="statistics" class="page-section">
        <div class="section-head">
          <div><span class="badge">USAGE STATISTICS</span><h2>System Statistics</h2><p>Monitor active users, transactions and popular categories.</p></div>
          <button class="secondary" id="refreshStats">↻ Refresh Data</button>
        </div>
        <div class="stats-grid">
          <article class="stat-card large-stat"><span>Active Users</span><strong id="statUsers">0</strong><small>Student accounts currently active</small></article>
          <article class="stat-card large-stat"><span>Total Transactions</span><strong id="statTransactions">0</strong><small>Transactions logged in the system</small></article>
        </div>
        <div class="two-col">
          <article class="panel">
            <div class="panel-head"><div><h3>Most Used Categories</h3><p>Category usage across student transactions</p></div></div>
            <div id="statsBars" class="category-bars"></div>
          </article>
          <article class="panel">
            <div class="panel-head"><div><h3>Transaction Overview</h3><p>Live system distribution</p></div></div>
            <div class="donut-wrap">
              <div class="donut" id="donutChart"><div><strong id="donutTotal">0</strong><span>Total</span></div></div>
              <div class="legend"><p><i class="dot income"></i> Income <b id="legendIncomePct">0%</b></p><p><i class="dot expense"></i> Expenses <b id="legendExpensePct">0%</b></p></div>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>

  <div id="modal" class="modal">
    <div class="modal-box">
      <button class="close" id="closeModal">×</button>
      <h3 id="modalTitle">Add Category</h3>
      <form id="modalForm"></form>
    </div>
  </div>

  <script>
    // Real data, injected by AdminController@index — no more mock arrays.
    const state = {
      categories: @json($categories),
      contents: @json($contents),
      users: @json($users),
      activities: @json($activities),
      stats: @json($stats),
      transactions: @json($transactions),
    };

    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    const ADMIN_BASE = "{{ url('/admin') }}";

    async function api(path, method = 'GET', body = null) {
      const res = await fetch(ADMIN_BASE + path, {
        method,
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN,
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: body ? JSON.stringify(body) : undefined,
      });
      let data = {};
      try { data = await res.json(); } catch (e) { /* no body */ }
      if (!res.ok) throw new Error(data.message || 'Something went wrong.');
      return data;
    }

const $ = s => document.querySelector(s);
const $$ = s => [...document.querySelectorAll(s)];

// Escape user-entered text (descriptions, names) before putting it in innerHTML.
const esc = s => String(s ?? "").replace(/[&<>"']/g, ch => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[ch]));
const money = n => Number(n).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});

function toast(message){
  const el=$("#toast"); el.textContent=message; el.classList.add("show");
  setTimeout(()=>el.classList.remove("show"),2200);
}
function renderStats(){
  $("#activeUsers").textContent=state.stats.activeUsers;
  $("#statUsers").textContent=state.stats.activeUsers;
  $("#totalTransactions").textContent=state.stats.totalTransactions.toLocaleString();
  $("#statTransactions").textContent=state.stats.totalTransactions.toLocaleString();
  $("#categoryCount").textContent=state.stats.categoryCount;
  $("#contentCount").textContent=state.contents.filter(c=>c.status==="Published").length;
  renderBars("#topCategories"); renderBars("#statsBars");
  renderDonut();
}
function renderDonut(){
  const total=state.stats.totalTransactions;
  const incomePct = total>0 ? Math.round((state.stats.incomeCount/total)*100) : 0;
  const expensePct = total>0 ? 100-incomePct : 0;
  $("#donutTotal").textContent=total.toLocaleString();
  $("#legendIncomePct").textContent=incomePct+"%";
  $("#legendExpensePct").textContent=expensePct+"%";
  const donut=$("#donutChart");
  if(donut) donut.style.background = total>0
    ? `conic-gradient(#16a34a 0 ${incomePct}%, #dc2626 ${incomePct}% 100%)`
    : `conic-gradient(#e9eee9 0 100%)`;
}
function renderBars(selector){
  const el=$(selector); if(!el)return;
  const top=[...state.categories].sort((a,b)=>b.usage-a.usage).slice(0,6);
  const max=top[0]?.usage||1;
  el.innerHTML=top.length ? top.map(c=>`<div class="bar-row"><span>${esc(c.name)}</span><div class="bar-track"><div class="bar-fill" style="width:${(c.usage/max)*100}%"></div></div><b>${c.usage}</b></div>`).join("") : `<p style="color:var(--muted);font-size:12px">No category usage yet.</p>`;
}
function renderCategories(){
  const q=$("#categorySearch").value.toLowerCase(), type=$("#categoryTypeFilter").value;
  const list=state.categories.filter(c=>(c.name.toLowerCase().includes(q))&&(type==="all"||c.type===type));
  $("#categoryTable").innerHTML=list.map(c=>`
    <tr><td><strong>${esc(c.name)}</strong></td><td><span class="type ${c.type}">${c.type}</span></td>
    <td><span class="status ${c.is_default?"active":"disabled"}">${c.is_default?"Default":"Custom"}</span></td><td>${c.usage}</td>
    <td><button class="action-btn" onclick="editCategory(${c.id})">Edit</button><button class="action-btn danger" onclick="deleteCategory(${c.id})">Remove</button></td></tr>`).join("");
}
function renderTransactions(){
  const q=$("#txSearch").value.toLowerCase(), type=$("#txTypeFilter").value;
  const list=state.transactions.filter(t=>
    (`${t.user} ${t.email} ${t.category} ${t.description}`.toLowerCase().includes(q)) &&
    (type==="all"||t.type===type));

  const income=list.filter(t=>t.type==="income").reduce((s,t)=>s+t.amount,0);
  const expense=list.filter(t=>t.type==="expense").reduce((s,t)=>s+t.amount,0);

  $("#txShown").textContent=list.length.toLocaleString();
  $("#txIncome").textContent=money(income);
  $("#txExpense").textContent=money(expense);
  $("#txNet").textContent=money(income-expense);

  $("#transactionTable").innerHTML=list.length ? list.map(t=>`
    <tr><td>${esc(t.date)}</td>
    <td><strong>${esc(t.user)}</strong><br><small style="color:var(--muted)">${esc(t.email)}</small></td>
    <td>${esc(t.category)}</td>
    <td>${esc(t.description)}${t.flagged?'<span class="flag">Flagged</span>':''}</td>
    <td><span class="type ${t.type}">${t.type}</span></td>
    <td class="amount ${t.type}">${t.type==="income"?"+":"−"}${money(t.amount)}</td></tr>`).join("")
    : `<tr><td colspan="6" class="empty-row">No transactions found.</td></tr>`;
}
function renderContents(){
  $("#contentCards").innerHTML=state.contents.map(c=>`
    <article class="content-card"><span class="content-type">${esc(c.type)}</span><h3>${esc(c.title)}</h3><p>${esc(c.text)}</p>
    <div><span class="status ${c.status==="Published"?"active":"disabled"}">${c.status}</span></div>
    <div class="content-actions"><button class="action-btn" onclick="editContent(${c.id})">Edit</button>
    <button class="action-btn warning" onclick="togglePublish(${c.id})">${c.status==="Published"?"Unpublish":"Publish"}</button>
    <button class="action-btn danger" onclick="deleteContent(${c.id})">Remove</button></div></article>`).join("");
}
function renderUsers(){
  const q=$("#userSearch").value.toLowerCase(), status=$("#userStatusFilter").value;
  const list=state.users.filter(u=>(u.name.toLowerCase().includes(q)||u.email.toLowerCase().includes(q))&&(status==="all"||u.status===status));
  $("#userTable").innerHTML=list.map(u=>`
    <tr><td><strong>${esc(u.name)}</strong></td><td>${esc(u.email)}</td><td>${u.transactions}</td><td>${u.joined}</td>
    <td><span class="status ${u.status}">${u.status}</span></td><td>
    <button class="action-btn danger" onclick="deleteUser(${u.id})">Delete</button></td></tr>`).join("");
}
function renderActivity(){
  $("#activityList").innerHTML=state.activities.map(a=>`<div class="activity-item"><i class="activity-dot"></i><div><strong>${a[0]}</strong><small>${a[1]} · ${a[2]}</small></div></div>`).join("");
}
function openModal(title, html, submit){
  $("#modalTitle").textContent=title;
  $("#modalForm").innerHTML=html+`<div class="form-actions"><button type="button" class="secondary" id="cancelModal">Cancel</button><button class="primary" type="submit">Save</button></div>`;
  $("#modal").classList.add("show");
  $("#cancelModal").onclick=closeModal;
  $("#modalForm").onsubmit=e=>{e.preventDefault();submit(new FormData(e.target));closeModal();}
}
function closeModal(){$("#modal").classList.remove("show")}
function editCategory(id){
  const c=state.categories.find(x=>x.id===id);
  openModal("Edit Category",`<div class="form-group"><label>Category Name</label><input name="name" value="${esc(c.name)}" required></div>
  <div class="form-group"><label>Category Type</label><select name="type"><option value="income" ${c.type==="income"?"selected":""}>Income</option><option value="expense" ${c.type==="expense"?"selected":""}>Expense</option></select></div>`,
  async f=>{
    const name=f.get("name"), type=f.get("type");
    try{
      await api(`/categories/${id}`,"PUT",{name,type});
      c.name=name;c.type=type;renderAll();toast("Category updated.");
    }catch(e){toast(e.message);}
  });
}
function addCategory(){
  openModal("Add Default Category",`<div class="form-group"><label>Category Name</label><input name="name" placeholder="e.g. Books" required></div>
  <div class="form-group"><label>Category Type</label><select name="type"><option value="income">Income</option><option value="expense">Expense</option></select></div>`,
  async f=>{
    const name=f.get("name"), type=f.get("type");
    try{
      const res=await api("/categories","POST",{name,type});
      state.categories.push(res.category);renderAll();toast("Category added.");
    }catch(e){toast(e.message);}
  });
}
async function deleteCategory(id){
  if(!confirm("Remove this default category?"))return;
  try{
    await api(`/categories/${id}`,"DELETE");
    state.categories=state.categories.filter(c=>c.id!==id);renderAll();toast("Category removed.");
  }catch(e){toast(e.message);}
}
function editContent(id){
  const c=state.contents.find(x=>x.id===id);
  openModal("Edit Content Template",`<div class="form-group"><label>Content Type</label><select name="type"><option ${c.type==="Saving Tip"?"selected":""}>Saving Tip</option><option ${c.type==="Announcement"?"selected":""}>Announcement</option></select></div>
  <div class="form-group"><label>Title</label><input name="title" value="${esc(c.title)}" required></div>
  <div class="form-group"><label>Message</label><textarea name="text" rows="4" required>${esc(c.text)}</textarea></div>`,
  async f=>{
    const type=f.get("type"), title=f.get("title"), text=f.get("text");
    try{
      await api(`/content/${id}`,"PUT",{type,title,text});
      c.type=type;c.title=title;c.text=text;renderContents();renderStats();toast("Template updated.");
    }catch(e){toast(e.message);}
  });
}
function addContent(){
  openModal("Add Content Template",`<div class="form-group"><label>Content Type</label><select name="type"><option>Saving Tip</option><option>Announcement</option></select></div>
  <div class="form-group"><label>Title</label><input name="title" placeholder="Template title" required></div>
  <div class="form-group"><label>Message</label><textarea name="text" rows="4" placeholder="Write the student-facing message..." required></textarea></div>`,
  async f=>{
    const type=f.get("type"), title=f.get("title"), text=f.get("text");
    try{
      const res=await api("/content","POST",{type,title,text});
      state.contents.push(res.content);renderAll();toast("Template created as draft.");
    }catch(e){toast(e.message);}
  });
}
async function togglePublish(id){
  const c=state.contents.find(x=>x.id===id);
  try{
    const res=await api(`/content/${id}/publish`,"PATCH");
    c.status=res.status;renderAll();toast(`Content ${res.status.toLowerCase()}.`);
  }catch(e){toast(e.message);}
}
async function deleteContent(id){
  if(!confirm("Remove this content template?"))return;
  try{
    await api(`/content/${id}`,"DELETE");
    state.contents=state.contents.filter(c=>c.id!==id);renderAll();toast("Template removed.");
  }catch(e){toast(e.message);}
}
async function deleteUser(id){
  const u=state.users.find(x=>x.id===id);
  if(!confirm(`Delete ${u.name}'s account permanently? This cannot be undone.`))return;
  try{
    await api(`/users/${id}`,"DELETE");
    state.users=state.users.filter(x=>x.id!==id);
    renderAll();
    toast("User account deleted.");
  }catch(e){toast(e.message);}
}
function renderAll(){renderStats();renderCategories();renderTransactions();renderContents();renderUsers();renderActivity();}
function navigate(section){
  $$(".page-section").forEach(s=>s.classList.toggle("active",s.id===section));
  $$(".nav-link").forEach(b=>b.classList.toggle("active",b.dataset.section===section));
  const titles={overview:"Overview",categories:"Categories",transactions:"Transactions","content":"Tips & Announcements",users:"User Accounts",statistics:"Statistics"};
  $("#pageTitle").textContent=titles[section]||"Overview";
}
$$(".nav-link").forEach(btn=>btn.onclick=()=>navigate(btn.dataset.section));
$$("[data-go]").forEach(btn=>btn.onclick=()=>navigate(btn.dataset.go));
$("#addCategoryBtn").onclick=addCategory; $("#addContentBtn").onclick=addContent; $("#closeModal").onclick=closeModal;
$("#categorySearch").oninput=renderCategories; $("#categoryTypeFilter").onchange=renderCategories;
$("#txSearch").oninput=renderTransactions; $("#txTypeFilter").onchange=renderTransactions;
$("#userSearch").oninput=renderUsers; $("#userStatusFilter").onchange=renderUsers;
$("#refreshStats").onclick=()=>{renderStats();toast("Statistics refreshed.");};
$("#themeBtn").onclick=()=>document.body.classList.toggle("dark");
$("#modal").onclick=e=>{if(e.target.id==="modal")closeModal()};
renderAll();
  </script>
</body>
</html>