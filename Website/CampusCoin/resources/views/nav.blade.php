<!-- ================= NAVBAR ================= -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<header class="navbar" id="navbar">

    <div class="navbar-inner">

        <div class="logo-area">
            <div class="logo-icon">
                <i class="fa-solid fa-coins"></i>
            </div>
            <div class="logo-text">
                <h2>Campus<span>Coin</span></h2>
                <p>Student Finance</p>
            </div>
        </div>

        <nav class="navbar-nav">
            <a href="/" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>

            <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="/about" class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-info"></i>
                <span>About</span>
            </a>

            <a href="/income-expense" class="nav-item {{ request()->is('income-expense') ? 'active' : '' }}">
                <i class="fa-solid fa-wallet"></i>
                <span>Income & Expenses</span>
            </a>

            <a href="/categories" class="nav-item {{ request()->is('categories') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>Categories</span>
            </a>

            <a href="/budgets-goal" class="nav-item {{ request()->is('budgets-goal') ? 'active' : '' }}">
                <i class="fa-solid fa-bullseye"></i>
                <span>Budget Goals</span>
            </a>

            <a href="/report-insights" class="nav-item {{ request()->is('report-insights') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Reports & Insights</span>
            </a>

            <a href="/saving-tips" class="nav-item {{ request()->is('saving-tips') ? 'active' : '' }}">
                <i class="fa-solid fa-lightbulb"></i>
                <span>Saving Tips</span>
            </a>

            <a href="{{ route('bookMarking') }}" class="nav-item {{ request()->is('bookMarking') || request()->is('bookmarks') ? 'active' : '' }}">
                <i class="fa-solid fa-bookmark"></i>
                <span>Bookmarks</span>
            </a>
        </nav>

        <div class="navbar-actions">
            <button class="theme-btn" id="themeToggle" title="Change Theme" type="button">
                <i class="fa-solid fa-moon"></i>
            </button>

            <div class="navbar-divider"></div>

            @auth
                <a href="/profile" class="profile-mini">
                    <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}</div>
                    <div class="profile-info">
                        <strong>{{ auth()->user()->name ?? 'Student' }}</strong>
                        <span>{{ ucfirst(auth()->user()->role ?? 'student') }}</span>
                    </div>
                </a>

                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to logout?')" class="logout-form-desktop">
                    @csrf
                    <button type="submit" class="nav-auth-btn logout-btn" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <a href="/login" class="nav-auth-btn login-btn">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span>Sign In</span>
                </a>
                <a href="/register" class="nav-auth-btn get-started-btn">
                    <i class="fa-solid fa-rocket"></i>
                    <span>Get Started</span>
                </a>
            @endauth

            <button class="menu-btn" id="menuBtn" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

    </div>

    <!-- MOBILE DROPDOWN -->
    <div class="navbar-dropdown" id="navbarDropdown">

        <a href="/" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="/about" class="nav-item {{ request()->is('about') ? 'active' : '' }}">
            <i class="fa-solid fa-circle-info"></i>
            <span>About</span>
        </a>

        <a href="/income-expense" class="nav-item {{ request()->is('income-expense') ? 'active' : '' }}">
            <i class="fa-solid fa-wallet"></i>
            <span>Income & Expenses</span>
        </a>

        <a href="/categories" class="nav-item {{ request()->is('categories') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>Categories</span>
        </a>

        <a href="/budgets-goal" class="nav-item {{ request()->is('budgets-goal') ? 'active' : '' }}">
            <i class="fa-solid fa-bullseye"></i>
            <span>Budget Goals</span>
        </a>

        <a href="/report-insights" class="nav-item {{ request()->is('report-insights') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Reports & Insights</span>
        </a>

        <a href="/saving-tips" class="nav-item {{ request()->is('saving-tips') ? 'active' : '' }}">
            <i class="fa-solid fa-lightbulb"></i>
            <span>Saving Tips</span>
        </a>

        <a href="{{ route('bookMarking') }}" class="nav-item {{ request()->is('bookMarking') || request()->is('bookmarks') ? 'active' : '' }}">
            <i class="fa-solid fa-bookmark"></i>
            <span>Bookmarks</span>
        </a>

        <div class="navbar-dropdown-divider"></div>

        @auth
            <a href="/profile" class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>Profile</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?')" class="logout-form-mobile">
                @csrf
                <button type="submit" class="nav-item logout-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        @else
            <a href="/login" class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>Sign In</span>
            </a>

            <a href="/register" class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                <i class="fa-solid fa-rocket"></i>
                <span>Get Started</span>
            </a>
        @endauth

    </div>

</header>

<script>
(function () {
    "use strict";

    var menuBtn = document.getElementById('menuBtn');
    var dropdown = document.getElementById('navbarDropdown');
    if (menuBtn && dropdown) {
        menuBtn.addEventListener('click', function () {
            dropdown.classList.toggle('open');
        });
    }

    function getPreferred() {
        var saved = localStorage.getItem('cc-theme');
        if (saved) return saved;
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function apply(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        document.body.classList.toggle('dark', theme === 'dark');

        document.querySelectorAll('.theme-btn i, .theme-toggle i, #themeButton i, #themeToggle i, #themeBtn i')
            .forEach(function (icon) {
                icon.classList.toggle('fa-moon', theme !== 'dark');
                icon.classList.toggle('fa-sun', theme === 'dark');
            });
    }

    window.ccTheme = {
        get: getPreferred,
        set: function (theme) {
            localStorage.setItem('cc-theme', theme);
            apply(theme);
        },
        toggle: function () {
            window.ccTheme.set(getPreferred() === 'dark' ? 'light' : 'dark');
        }
    };

    apply(getPreferred());

    var themeBtn = document.getElementById('themeToggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', window.ccTheme.toggle);
    }

})();
</script>

@auth
<script>
    // Back/Forward button se aaye to page dobara server se mangwao.
    // Logout ho chuka ho to auth middleware login par bhej dega.
    window.addEventListener("pageshow", function (e) {
        var nav = performance.getEntriesByType("navigation")[0];

        if (e.persisted || (nav && nav.type === "back_forward")) {
            window.location.reload();
        }
    });
</script>
@endauth