<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CampusCoin - Admin Control Panel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
  --shadow:0 1px 2px rgba(16,24,40,.04), 0 12px 28px rgba(16,24,40,.06);
  --shadow-hover:0 2px 4px rgba(16,24,40,.05), 0 16px 36px rgba(16,24,40,.10);

  --income:#16a34a;
  --income-bg:#e7f6ec;
  --danger:#dc2626;
  --danger-bg:#fdeceb;
  --warning:#d97706;
  --warning-bg:#fef3e2;

  --radius:16px;
  --sidebar-w:255px;
}
*{box-sizing:border-box}
html{-webkit-text-size-adjust:100%}
body{margin:0;font-family:"Inter",ui-sans-serif,system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.5;-webkit-font-smoothing:antialiased;transition:background .25s,color .25s}
button,input,select,textarea{font:inherit}
button{cursor:pointer;border:0;transition:background .18s,border-color .18s,color .18s,box-shadow .18s,transform .12s}
button:active{transform:scale(.98)}
:focus-visible{outline:2px solid var(--mint-400);outline-offset:2px}
::selection{background:var(--mint-100);color:var(--navy-800)}

.app{display:flex;min-height:100vh;min-height:100dvh}

/* ---------- Sidebar ---------- */
.sidebar{width:var(--sidebar-w);background:linear-gradient(180deg,var(--navy-950),#0d1738);color:#fff;padding:25px 16px;display:flex;flex-direction:column;position:fixed;inset:0 auto 0 0;overflow-y:auto;scrollbar-width:none;-ms-overflow-style:none;z-index:40;transition:transform .28s ease}
.sidebar::-webkit-scrollbar{display:none}
.brand{display:flex;gap:12px;align-items:center;padding:4px 10px 32px}
.brand-icon{width:42px;height:42px;flex:none;border-radius:13px;background:linear-gradient(135deg,var(--mint-400),#60a5fa);color:#0b1330;display:grid;place-items:center;font-size:22px;font-weight:800;box-shadow:0 6px 16px rgba(59,130,246,.35)}
.brand h2{font-weight:800;font-size:19px;margin:0;letter-spacing:-.01em}
.brand span{font-size:11px;color:#8a96b3}
nav{display:grid;gap:6px}
.nav-link{background:transparent;color:#a7adba;text-align:left;padding:12px 14px;border-radius:11px;display:flex;gap:12px;align-items:center;font-weight:500;font-size:14px;line-height:1.3;width:100%}
.ico{flex:none;width:22px;text-align:center;font-style:normal;font-size:16px;line-height:1}
.nav-link span,.logout span{min-width:0}
.nav-link:hover{background:rgba(255,255,255,.06);color:#fff}
.nav-link.active{background:var(--navy-900);color:#fff;box-shadow:inset 3px 0 var(--mint-400)}
.sidebar-bottom{margin-top:auto;padding-top:16px}
.admin-card{display:flex;gap:10px;align-items:center;padding:13px 8px;border-top:1px solid #202c49;min-width:0}
.avatar,.top-avatar{display:grid;place-items:center;border-radius:50%;background:var(--mint-100);color:var(--navy-800);font-weight:800;flex:none}
.avatar{width:38px;height:38px}
.admin-card div:last-child{min-width:0}
.admin-card strong,.admin-card small{display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.admin-card small{font-size:11px;color:#8a96b3;margin-top:2px}
.logout{background:transparent;color:#a7adba;padding:11px 14px;font-weight:600;font-size:14px;border-radius:9px;display:flex;align-items:center;gap:12px}
.logout:hover{color:#fff;background:rgba(255,255,255,.06)}
.backdrop{position:fixed;inset:0;background:rgba(11,19,48,.55);backdrop-filter:blur(2px);opacity:0;pointer-events:none;transition:opacity .25s;z-index:30}
.backdrop.show{opacity:1;pointer-events:auto}

/* ---------- Main / topbar ---------- */
.main{margin-left:var(--sidebar-w);width:calc(100% - var(--sidebar-w));min-width:0;padding:28px 36px 40px}
.topbar{display:flex;justify-content:space-between;align-items:center;gap:14px;margin-bottom:28px}
.topbar-left{display:flex;align-items:center;gap:12px;min-width:0}
.eyebrow{color:var(--muted);font-size:12px;margin:0 0 5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase}
.topbar h1{font-weight:800;margin:0;font-size:29px;letter-spacing:-.02em;line-height:1.15}
.top-actions{display:flex;gap:12px;align-items:center}
.icon-btn{width:42px;height:42px;border-radius:12px;background:var(--surface);border:1px solid var(--border);color:var(--text);display:grid;place-items:center;font-size:17px;flex:none}
.icon-btn:hover{border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.10)}
.menu-btn{display:none}
.top-avatar{width:42px;height:42px}

/* ---------- Sections ---------- */
.page-section{display:none}
.page-section.active{display:block;animation:fadeIn .25s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}

.welcome{background:linear-gradient(135deg,var(--navy-950),var(--navy-800));border:1px solid var(--border);border-radius:20px;padding:28px;display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:24px;color:#fff;box-shadow:0 18px 40px rgba(29,78,216,.18)}
.welcome h2{font-weight:800;margin:8px 0 5px;font-size:25px;letter-spacing:-.02em;color:#fff}
.welcome p{color:#cbd9e0;margin:0}
.section-head h2{font-weight:800;margin:8px 0 5px;font-size:25px;letter-spacing:-.02em}
.section-head p{color:var(--muted);margin:0}
.badge{display:inline-block;background:rgba(255,255,255,.14);color:#dbe6ff;font-size:10px;font-weight:800;letter-spacing:1px;padding:6px 9px;border-radius:20px}
.section-head .badge{background:var(--mint-100);color:var(--navy-800)}

.primary,.secondary{padding:11px 16px;border-radius:9px;font-weight:800;white-space:nowrap}
.primary{background:var(--primary);color:#fff;border:1px solid var(--primary);box-shadow:0 4px 12px rgba(37,99,235,.25)}
.primary:hover{background:var(--primary-dark);border-color:var(--primary-dark)}
.secondary{background:var(--surface);border:1px solid var(--border);color:var(--text)}
.secondary:hover{border-color:var(--primary)}
.welcome .primary{background:var(--mint-500);border-color:var(--mint-500)}
.welcome .primary:hover{background:#fff;color:var(--navy-800);border-color:#fff}

/* ---------- Cards / grids ---------- */
.stats-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:17px;margin-bottom:22px}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:15px;padding:19px;display:flex;gap:14px;align-items:center;box-shadow:var(--shadow);min-width:0;transition:box-shadow .2s,transform .2s}
.stat-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-2px)}
.stat-card span,.stat-card small{display:block;color:var(--muted);font-size:12px}
.stat-card strong{font-weight:800;display:block;font-size:26px;margin:3px 0;overflow-wrap:anywhere;line-height:1.15}
.stat-icon{width:42px;height:42px;flex:none;border-radius:10px;display:grid;place-items:center;font-size:18px}
.green{background:var(--mint-100);color:var(--navy-800)}
.blue{background:#dbeafe;color:#1d4ed8}
.orange{background:var(--warning-bg);color:var(--warning)}
.purple{background:#e5e0fb;color:#5b3fc4}

.two-col{display:grid;grid-template-columns:1.25fr 1fr;gap:20px}
.two-col>*{min-width:0}
.panel{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow)}
.panel-head{display:flex;justify-content:space-between;margin-bottom:17px}
.panel h3{margin:0;font-weight:800}
.panel-head p{color:var(--muted);font-size:12px;margin:4px 0}

.section-head{display:flex;justify-content:space-between;align-items:flex-end;gap:16px;margin-bottom:22px}
.filter-row{display:flex;gap:10px;margin-bottom:15px;flex-wrap:wrap}
.search,select,textarea,.form-group input{border:1px solid var(--border);background:var(--surface);color:var(--text);padding:11px 13px;border-radius:9px;outline:none;transition:border-color .18s,box-shadow .18s}
.search:focus,select:focus,textarea:focus,input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.14)}
.search{width:280px;max-width:100%}
select{min-width:150px}

/* ---------- Tables ---------- */
.table-panel{overflow-x:auto;-webkit-overflow-scrolling:touch;padding:8px 12px}
table{width:100%;border-collapse:collapse;min-width:640px}
th{text-align:left;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;padding:13px;border-bottom:1px solid var(--border);font-weight:700;white-space:nowrap;position:sticky;top:0;background:var(--surface)}
td{padding:14px 13px;border-bottom:1px solid var(--border);font-size:13px;vertical-align:middle}
tbody tr{transition:background .15s}
tbody tr:hover{background:rgba(37,99,235,.04)}
tr:last-child td{border-bottom:0}
.type,.status{display:inline-flex;padding:5px 9px;border-radius:20px;font-size:10px;font-weight:800;text-transform:capitalize}
.type.income{background:var(--mint-100);color:var(--navy-800)}
.type.expense{background:var(--danger-bg);color:var(--danger)}
.status.active{background:var(--mint-100);color:var(--navy-800)}
.status.disabled{background:var(--surface2);color:var(--muted)}
.amount{font-weight:800;white-space:nowrap}
.amount.income{color:var(--income)}
.amount.expense{color:var(--danger)}
.flag{display:inline-flex;padding:4px 8px;border-radius:20px;font-size:10px;font-weight:800;background:var(--warning-bg);color:var(--warning);margin-left:6px}
.empty-row{text-align:center;color:var(--muted);padding:28px 13px}
.action-btn{padding:7px 10px;border-radius:8px;background:var(--surface2);font-size:11px;margin:2px 4px 2px 0;font-weight:700;color:var(--text);border:1px solid transparent}
.action-btn:hover{border-color:var(--primary)}
.action-btn.danger{color:var(--danger)}
.action-btn.danger:hover{border-color:var(--danger);background:var(--danger-bg)}
.action-btn.warning{color:var(--warning)}

/* ---------- Content cards ---------- */
.content-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.content-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:19px;box-shadow:var(--shadow);transition:box-shadow .2s,transform .2s}
.content-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-2px)}
.content-card .content-type{font-size:10px;color:var(--primary);font-weight:800;text-transform:uppercase}
.content-card h3{margin:8px 0;font-weight:800;overflow-wrap:anywhere}
.content-card p{color:var(--muted);line-height:1.6;font-size:13px;overflow-wrap:anywhere}
.content-actions{border-top:1px solid var(--border);padding-top:13px;margin-top:15px;display:flex;flex-wrap:wrap;gap:4px}

/* ---------- Bars / activity / donut ---------- */
.category-bars{display:grid;gap:15px}
.bar-row{display:grid;grid-template-columns:minmax(80px,110px) 1fr 40px;align-items:center;gap:10px;font-size:12px}
.bar-row span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.bar-row b{text-align:right}
.bar-track{height:8px;background:var(--surface2);border-radius:999px;overflow:hidden}
.bar-fill{height:100%;background:linear-gradient(90deg,var(--mint-400),var(--primary));border-radius:999px;transition:width .5s ease}
.activity-item{display:flex;gap:10px;padding:11px 0;border-bottom:1px solid var(--border);font-size:12px}
.activity-item:last-child{border:0}
.activity-dot{width:8px;height:8px;flex:none;background:var(--primary);border-radius:50%;margin-top:5px}
.activity-item small{display:block;color:var(--muted);margin-top:3px}
.large-stat{display:block;min-height:130px}
.large-stat strong{font-size:38px;margin:8px 0}
.donut-wrap{display:flex;align-items:center;gap:30px;min-height:220px;flex-wrap:wrap}
.donut{width:160px;height:160px;flex:none;border-radius:50%;background:conic-gradient(var(--income) 0 34%,var(--danger) 34% 100%);display:grid;place-items:center}
.donut>div{width:108px;height:108px;border-radius:50%;background:var(--surface);display:grid;place-items:center;align-content:center}
.donut strong{font-size:23px;font-weight:800}
.donut span{font-size:11px;color:var(--muted)}
.legend p{font-size:12px}
.dot{display:inline-block;width:9px;height:9px;border-radius:50%;margin-right:6px}
.dot.income{background:var(--income)}
.dot.expense{background:var(--danger)}
.legend b{margin-left:18px}

/* ---------- Toast / modal ---------- */
.toast{position:fixed;right:28px;top:24px;max-width:calc(100% - 56px);background:var(--navy-950);color:#fff;padding:12px 17px;border-radius:10px;opacity:0;transform:translateY(-10px);transition:.25s;z-index:60;box-shadow:0 12px 30px rgba(0,0,0,.25);pointer-events:none}
.toast.show{opacity:1;transform:none}
.modal{position:fixed;inset:0;background:rgba(11,19,48,.55);backdrop-filter:blur(3px);display:none;place-items:center;z-index:50;padding:20px;overflow-y:auto}
.modal.show{display:grid}
.modal-box{width:min(500px,100%);max-height:calc(100dvh - 40px);overflow-y:auto;background:var(--surface);border-radius:17px;padding:25px;position:relative;box-shadow:0 25px 70px rgba(0,0,0,.25);animation:pop .2s ease}
@keyframes pop{from{opacity:0;transform:scale(.97) translateY(8px)}to{opacity:1;transform:none}}
.modal-box h3{font-weight:800;font-size:22px;margin:0 0 20px;padding-right:30px}
.close{position:absolute;right:14px;top:12px;width:34px;height:34px;border-radius:8px;background:transparent;font-size:25px;line-height:1;color:var(--muted)}
.close:hover{background:var(--surface2);color:var(--text)}
.form-group{margin-bottom:15px}
.form-group label{display:block;font-size:12px;font-weight:800;margin-bottom:6px}
.form-group input,.form-group select,.form-group textarea{width:100%}
.form-actions{display:flex;justify-content:flex-end;gap:9px;margin-top:20px}

/* ---------- Dark mode ---------- */
.dark{--bg:#0a0f1e;--surface:#111a2e;--surface2:#0d1526;--text:#eef1f8;--muted:#8a96b3;--border:#202c49;--shadow:0 18px 42px rgba(0,0,0,.24);--shadow-hover:0 20px 46px rgba(0,0,0,.34);--mint-100:#16233f;--income-bg:#123322;--danger-bg:#3a1717;--warning-bg:#3a2b0c}
.dark .welcome{background:linear-gradient(135deg,#0a0f1e,#152551);border-color:#202c49}
.dark td,.dark .activity-item,.dark th{border-color:#202c49}
.dark .donut>div{background:var(--surface)}
.dark .blue{background:#16233f;color:#60a5fa}
.dark .purple{background:#241b3f;color:#a78bfa}
.dark .orange{background:var(--warning-bg);color:#fbbf24}
.dark .section-head .badge,.dark .status.active,.dark .type.income{color:#93c5fd}
.dark .green{color:#93c5fd}
.dark .avatar,.dark .top-avatar{color:#93c5fd}
.dark tbody tr:hover{background:rgba(96,165,250,.06)}

/* ---------- Responsive ---------- */
.main{--pad:clamp(14px,3vw,36px);padding:clamp(16px,2.6vw,28px) var(--pad) 40px}
.topbar h1{font-size:clamp(21px,2.4vw,29px)}
.welcome h2,.section-head h2{font-size:clamp(20px,2.2vw,25px)}
.welcome{padding:clamp(20px,3vw,28px)}
.donut{width:clamp(130px,14vw,160px);height:clamp(130px,14vw,160px)}
.donut>div{width:68%;height:68%}

@media(max-width:1200px){
  .stats-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media(max-width:1050px){
  .two-col,.content-grid{grid-template-columns:1fr}
}

/* Tablet landscape: icon-only rail */
@media(min-width:901px) and (max-width:1100px){
  :root{--sidebar-w:76px}
  .sidebar{padding:20px 10px;align-items:center}
  .brand{padding:4px 0 24px}
  .brand>div:not(.brand-icon){display:none}
  .nav-link{justify-content:center;padding:13px}
  .nav-link span{display:none}
  .admin-card{justify-content:center;padding:13px 0}
  .admin-card>div:last-child{display:none}
  .logout span{display:none}
  .logout{justify-content:center;padding:13px}
}

/* Tablet portrait & phones: slide-in drawer + sticky topbar */
@media(max-width:900px){
  .sidebar{transform:translateX(-100%);width:min(290px,84vw);padding-top:calc(25px + env(safe-area-inset-top));padding-bottom:calc(16px + env(safe-area-inset-bottom))}
  .sidebar.open{transform:none;box-shadow:12px 0 40px rgba(0,0,0,.35)}
  .main{margin-left:0;width:100%;padding-top:0;padding-bottom:calc(32px + env(safe-area-inset-bottom))}
  .menu-btn{display:grid}
  .topbar{position:sticky;top:0;z-index:20;margin:0 calc(var(--pad)*-1) 20px;padding:12px var(--pad);padding-top:calc(12px + env(safe-area-inset-top));background:color-mix(in srgb,var(--bg) 88%,transparent);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);border-bottom:1px solid var(--border)}
  .eyebrow{display:none}
  .toast{top:calc(14px + env(safe-area-inset-top))}
  .search,select,textarea,input{font-size:16px} /* stops iOS zoom-on-focus */
  .nav-link{padding:14px}
}

/* Phones: tables become stacked cards */
@media(max-width:720px){
  .top-avatar{display:none}
  .welcome{flex-direction:column;align-items:flex-start;gap:16px}
  .section-head{flex-direction:column;align-items:stretch;gap:14px}
  .section-head .primary,.section-head .secondary,.welcome .primary{width:100%}
  .stats-grid{grid-template-columns:1fr;gap:12px}
  .stat-card{padding:16px}
  .large-stat{min-height:0}
  .large-stat strong{font-size:32px}
  .filter-row{flex-direction:column}
  .search,select{width:100%}
  .panel{padding:16px}
  .donut-wrap{justify-content:center;gap:20px;min-height:0}
  .bar-row{grid-template-columns:80px 1fr 32px}
  .toast{left:14px;right:14px;max-width:none}

  .table-panel{padding:0;background:transparent;border:0;box-shadow:none;overflow:visible}
  table,thead,tbody,tr,td{display:block;width:100%;min-width:0}
  thead{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
  tbody tr{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:4px 14px;margin-bottom:12px;box-shadow:var(--shadow)}
  tbody tr:hover{background:var(--surface)}
  td{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:11px 0;text-align:right;border-bottom:1px dashed var(--border);overflow-wrap:anywhere}
  td::before{content:attr(data-label);flex:none;font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;text-align:left}
  td:last-child{border-bottom:0}
  td[data-label="Actions"]{justify-content:flex-end;flex-wrap:wrap}
  td[data-label="Actions"]::before{margin-right:auto}
  td.empty-row{display:block;text-align:center;padding:24px 0}
  td.empty-row::before{content:none}
  .action-btn{padding:9px 13px;font-size:12px}

  .modal{padding:0;align-items:end}
  .modal-box{width:100%;padding:20px 20px calc(20px + env(safe-area-inset-bottom));border-radius:18px 18px 0 0;max-height:92dvh}
  .form-actions .primary,.form-actions .secondary{flex:1}
  .content-actions .action-btn{flex:1}
}

@media(max-width:380px){
  .stat-icon{width:38px;height:38px;font-size:16px}
  .stat-card strong{font-size:22px}
  .badge{font-size:9px}
}
@media(pointer:coarse){
  .icon-btn{width:44px;height:44px}
  .logout{padding:13px 8px}
}
@media(prefers-reduced-motion:reduce){
  *,*::before,*::after{animation:none!important;transition:none!important}
}
</style>
</head>
<body>
  <div class="app">
    <div class="backdrop" id="backdrop"></div>

    <aside class="sidebar" id="sidebar">
      <div class="brand">
        <div class="brand-icon">C</div>
        <div>
          <h2>CampusCoin</h2>
          <span>Admin Panel</span>
        </div>
      </div>

      <nav>
        <button class="nav-link active" data-section="overview"><i class="ico">⌂</i><span>Overview</span></button>
        <button class="nav-link" data-section="categories"><i class="ico">▦</i><span>Categories</span></button>
        <button class="nav-link" data-section="transactions"><i class="ico">↕</i><span>Transactions</span></button>
        <button class="nav-link" data-section="content"><i class="ico">✦</i><span>Tips & Announcements</span></button>
        <button class="nav-link" data-section="users"><i class="ico">♙</i><span>User Accounts</span></button>
        <button class="nav-link" data-section="statistics"><i class="ico">◔</i><span>Statistics</span></button>
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
          <button type="submit" id="logoutBtn" class="logout"><i class="ico">↪</i><span>Logout</span></button>
        </form>
      </div>
    </aside>

    <main class="main">
      <header class="topbar">
        <div class="topbar-left">
          <button class="icon-btn menu-btn" id="menuBtn" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">☰</button>
          <div>
            <p class="eyebrow">CampusCoin / Administration</p>
            <h1 id="pageTitle">Overview</h1>
          </div>
        </div>
        <div class="top-actions">
          <button class="icon-btn" id="themeBtn" title="Toggle theme" aria-label="Toggle theme">☾</button>
          <div class="top-avatar">{{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}</div>
        </div>
      </header>

      <div id="toast" class="toast" role="status" aria-live="polite"></div>

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
      <button class="close" id="closeModal" aria-label="Close">×</button>
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
    const ADMIN_LOGIN_URL = "{{ route('admin.login') }}";

    // Sab requests yahan se jati hain.
    // Session khatam ho (redirect / 401 / 419) to login par bhej do,
    // warna redirect ke baad PATCH /admin/login wala confusing error aata hai.
    async function api(path, method = 'GET', body = null) {
      const res = await fetch(ADMIN_BASE + path, {
        method,
        redirect: 'manual',
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN,
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: body ? JSON.stringify(body) : undefined,
      });

      if (res.type === 'opaqueredirect' || res.status === 401 || res.status === 419) {
        toast('Session expired. Please login again.');
        setTimeout(() => { window.location.href = ADMIN_LOGIN_URL; }, 1200);
        throw new Error('Session expired.');
      }

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
    <tr><td data-label="Category"><strong>${esc(c.name)}</strong></td><td data-label="Type"><span class="type ${c.type}">${c.type}</span></td>
    <td data-label="Status"><span class="status ${c.is_default?"active":"disabled"}">${c.is_default?"Default":"Custom"}</span></td><td data-label="Usage">${c.usage}</td>
    <td data-label="Actions"><button class="action-btn" onclick="editCategory(${c.id})">Edit</button><button class="action-btn danger" onclick="deleteCategory(${c.id})">Remove</button></td></tr>`).join("");
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
    <tr><td data-label="Date">${esc(t.date)}</td>
    <td data-label="Student"><strong>${esc(t.user)}</strong><br><small style="color:var(--muted)">${esc(t.email)}</small></td>
    <td data-label="Category">${esc(t.category)}</td>
    <td data-label="Description">${esc(t.description)}${t.flagged?'<span class="flag">Flagged</span>':''}</td>
    <td data-label="Type"><span class="type ${t.type}">${t.type}</span></td>
    <td data-label="Amount" class="amount ${t.type}">${t.type==="income"?"+":"−"}${money(t.amount)}</td></tr>`).join("")
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
    <tr><td data-label="Student"><strong>${esc(u.name)}</strong></td><td data-label="Email">${esc(u.email)}</td><td data-label="Transactions">${u.transactions}</td><td data-label="Joined">${u.joined}</td>
    <td data-label="Status"><span class="status ${u.status}">${u.status}</span></td><td data-label="Actions">
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

// ----- Mobile drawer -----
function setMenu(open){
  $("#sidebar").classList.toggle("open",open);
  $("#backdrop").classList.toggle("show",open);
  $("#menuBtn").setAttribute("aria-expanded",open);
}
$("#menuBtn").onclick=()=>setMenu(!$("#sidebar").classList.contains("open"));
$("#backdrop").onclick=()=>setMenu(false);
window.addEventListener("resize",()=>{ if(window.innerWidth>900) setMenu(false); });
document.addEventListener("keydown",e=>{ if(e.key==="Escape"){ setMenu(false); closeModal(); } });

function navigate(section){
  $$(".page-section").forEach(s=>s.classList.toggle("active",s.id===section));
  $$(".nav-link").forEach(b=>b.classList.toggle("active",b.dataset.section===section));
  const titles={overview:"Overview",categories:"Categories",transactions:"Transactions","content":"Tips & Announcements",users:"User Accounts",statistics:"Statistics"};
  $("#pageTitle").textContent=titles[section]||"Overview";
  setMenu(false);
  window.scrollTo({top:0});
}
$$(".nav-link").forEach(btn=>{btn.title=btn.querySelector("span").textContent.trim();btn.onclick=()=>navigate(btn.dataset.section);});
$$("[data-go]").forEach(btn=>btn.onclick=()=>navigate(btn.dataset.go));
$("#addCategoryBtn").onclick=addCategory; $("#addContentBtn").onclick=addContent; $("#closeModal").onclick=closeModal;
$("#categorySearch").oninput=renderCategories; $("#categoryTypeFilter").onchange=renderCategories;
$("#txSearch").oninput=renderTransactions; $("#txTypeFilter").onchange=renderTransactions;
$("#userSearch").oninput=renderUsers; $("#userStatusFilter").onchange=renderUsers;
$("#refreshStats").onclick=()=>{renderStats();toast("Statistics refreshed.");};
$("#themeBtn").onclick=()=>{
  const dark=document.body.classList.toggle("dark");
  $("#themeBtn").textContent=dark?"☀":"☾";
};
$("#modal").onclick=e=>{if(e.target.id==="modal")closeModal()};
renderAll();

// Back/Forward se purani cached copy aaye to server se dobara mangwao
window.addEventListener("pageshow", function (e) {
  var nav = performance.getEntriesByType("navigation")[0];
  if (e.persisted || (nav && nav.type === "back_forward")) {
    window.location.reload();
  }
});
  </script>
</body>
</html>