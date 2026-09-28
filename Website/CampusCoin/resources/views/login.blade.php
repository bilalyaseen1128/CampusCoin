<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusCoin | Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<style>
    .login-side-logo-wrap {
        width: 72px;
        height: 72px;
        background: #fff;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        box-shadow: 0 8px 20px rgba(0,0,0,.25);
        padding: 10px;
    }

    .login-side-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .field-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .forgot-link {
        font-size: 0.9rem;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }
</style>
<body>

    {{-- Your existing navbar include goes here, e.g. @include('partials.navbar') --}}

    <div class="login-container">

        <div class="login-card">

            {{-- LEFT PANEL: brand / illustration --}}
            <div class="login-side">
                <div class="login-side-inner">
                    <div class="login-side-logo-wrap">
                        <img class="login-side-logo" src="{{ asset('img/Logo.png') }}" alt="CampusCoin Logo">
                    </div>
                    <h1>Take control of your money,<br>one semester at a time.</h1>
                    <p>CampusCoin helps students track spending, hit savings goals, and see exactly where their money goes.</p>

                    <div class="tag-chip">
                        <span class="tag-hole"></span>
                        Track &bull; Budget &bull; Save
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: form --}}
            <div class="login-main">
                <form action="/login" method="POST" class="login-form" novalidate>
                    @csrf

                    <h2>Welcome back</h2>
                    <p class="subtitle">Log in to manage your budget.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Session status (e.g. password reset link sent) --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="field">
                        <label for="email">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@university.edu"
                            autocomplete="email"
                            required
                            autofocus
                        >
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >
                        </div>
                    </div>

                    <div class="field-row">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">Login</button>

                    <div class="register-link">
                        Don't have an account?
                    </div>
                </form>
            </div>

        </div>

    </div>

    {{-- Your existing footer include goes here, e.g. @include('partials.footer') --}}

    <script>
        // Theme toggle: guard against the button not existing on this page
        const toggle = document.getElementById('themeToggle');
        if (toggle) {
            toggle.addEventListener('click', () => {
                document.body.classList.toggle('dark');
                toggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
            });
        }
    </script>
</body>
</html>