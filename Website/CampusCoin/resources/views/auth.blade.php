<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusCoin | Sign In / Register</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #eef2fb;
            --card-bg: #ffffff;
            --text: #101828;
            --text-muted: #667085;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #e8effe;
            --input-bg: #f5f7fb;
            --input-border: #e3e8f2;
            --border: #e6eaf3;
            --overlay-1: #1d4ed8;
            --overlay-2: #0b1330;
            --shadow: rgba(20, 35, 80, .14);
            --danger-bg: #fdecec;
            --danger-border: #f6c6c6;
            --danger-text: #b3261e;
            --success-bg: #eaf6ef;
            --success-border: #bfe6cd;
            --success-text: #1c7a4d;

            /* Variables used by navbar.css */
            --navbar: var(--card-bg);
            --surface-2: #f3f5fa;
            --text-light: var(--text-muted);
            --primary-light: #60a5fa;
            --expense: #ef4444;
            --star: #fbbf24;
            --success: #16a34a;
            --transition: 0.25s ease;
        }

        html[data-theme="dark"] {
            --bg: #0a0f1e;
            --card-bg: #111a2e;
            --text: #eef1f8;
            --text-muted: #8a96b3;
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-soft: #16233f;
            --input-bg: #182238;
            --input-border: #263354;
            --border: #202c49;
            --overlay-1: #16327a;
            --overlay-2: #05070f;
            --shadow: rgba(0, 0, 0, .55);
            --danger-bg: #2a1414;
            --danger-border: #4a1f1f;
            --danger-text: #f5a3a3;
            --success-bg: #10261c;
            --success-border: #1e4a34;
            --success-text: #7fd6a5;

            /* Variables used by navbar.css */
            --navbar: var(--card-bg);
            --surface-2: #1a2540;
            --text-light: var(--text-muted);
            --primary-light: #60a5fa;
            --expense: #f87171;
            --success: #22c55e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background .25s ease, color .25s ease;
            position: relative;
            overflow-x: hidden;
        }

        body::before, body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }

        body::before {
            width: 460px;
            height: 460px;
            top: -140px;
            left: -120px;
            background: radial-gradient(circle, var(--primary-soft), transparent 70%);
        }

        body::after {
            width: 420px;
            height: 420px;
            bottom: -160px;
            right: -140px;
            background: radial-gradient(circle, var(--primary-soft), transparent 70%);
        }

        /* Centers the card in the space below the navbar */
        .auth-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            z-index: 1;
        }

        .container {
            background: var(--card-bg);
            border-radius: 22px;
            box-shadow: 0 30px 70px var(--shadow);
            position: relative;
            z-index: 1;
            overflow: hidden;
            width: 900px;
            max-width: 100%;
            min-height: 560px;
            transition: background .25s ease;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s cubic-bezier(.65,0,.35,1);
        }

        .sign-in-container { left: 0; width: 50%; z-index: 2; }
        .sign-up-container { left: 0; width: 50%; z-index: 1; opacity: 0; }

        .container.right-panel-active .sign-in-container { transform: translateX(100%); }
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }

        form {
            background: var(--card-bg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding: 0 56px;
            overflow-y: auto;
        }

        form h1 {
            margin: 0 0 6px;
            font-size: 25px;
            font-weight: 800;
            color: var(--text);
        }

        form .subtitle {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0 0 22px;
        }

        .alert-danger, .status-msg {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 12.5px;
            text-align: left;
        }

        .alert-danger { background: var(--danger-bg); border: 1px solid var(--danger-border); color: var(--danger-text); }
        .status-msg { background: var(--success-bg); border: 1px solid var(--success-border); color: var(--success-text); }
        .alert-danger p { margin: 3px 0; }

        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            margin: 10px 0 5px;
            text-align: left;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--text);
            border-radius: 10px;
            padding: 12px 14px;
            width: 100%;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color .15s, background .15s;
        }

        form input::placeholder { color: var(--text-muted); }

        form input:focus {
            border-color: var(--primary);
            background: var(--card-bg);
        }

        .password-field {
            position: relative;
        }

        .password-field input { padding-right: 42px; }

        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 14px;
            padding: 4px;
        }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 12px 0 4px;
            font-size: 12.5px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--text-muted);
        }

        .remember-check input { accent-color: var(--primary); }

        .row-between a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .row-between a:hover {
            text-decoration: underline;
        }

        form button[type="submit"] {
            border-radius: 10px;
            border: none;
            background: var(--primary);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            padding: 13px 20px;
            margin-top: 20px;
            cursor: pointer;
            transition: background .15s, transform .15s;
        }

        form button[type="submit"]:hover { background: var(--primary-dark); }
        form button[type="submit"]:active { transform: scale(0.98); }

        .switch-hint {
            margin-top: 20px;
            font-size: 12.5px;
            color: var(--text-muted);
            display: none;
            text-align: center;
        }

        .switch-hint button {
            background: none;
            border: none;
            color: var(--primary);
            font-weight: 700;
            cursor: pointer;
            padding: 0;
            font-size: 12.5px;
        }

        /* ---------- Hero / overlay ---------- */
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s cubic-bezier(.65,0,.35,1);
            z-index: 100;
        }

        .container.right-panel-active .overlay-container { transform: translateX(-100%); }

        .overlay {
            background: linear-gradient(150deg, var(--overlay-1), var(--overlay-2));
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s cubic-bezier(.65,0,.35,1);
            overflow: hidden;
        }

        .overlay::before, .overlay::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            filter: blur(10px);
        }

        .overlay::before { width: 260px; height: 260px; top: -80px; left: 10%; }
        .overlay::after { width: 220px; height: 220px; bottom: -60px; right: 8%; }

        .container.right-panel-active .overlay { transform: translateX(50%); }

        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            padding: 0 46px;
            transition: transform 0.6s cubic-bezier(.65,0,.35,1);
        }

        .overlay-left { transform: translateX(-20%); }
        .container.right-panel-active .overlay-left { transform: translateX(0); }

        .overlay-right { right: 0; transform: translateX(0); }
        .container.right-panel-active .overlay-right { transform: translateX(20%); }

        .overlay-panel .coin-badge {
            width: 58px;
            height: 58px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 18px;
        }

        .overlay-panel h1 {
            margin: 0 0 12px;
            font-size: 24px;
            font-weight: 800;
        }

        .overlay-panel p {
            line-height: 1.6;
            font-size: 13.5px;
            color: rgba(255,255,255,.78);
            margin: 0 0 22px;
        }

        .quote-line {
            font-size: 13px;
            font-style: italic;
            color: rgba(255,255,255,.7);
            border-left: 2px solid rgba(255,255,255,.35);
            padding-left: 14px;
            margin: 0 0 26px;
            line-height: 1.6;
        }

        .ghost-btn {
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,.6);
            background: transparent;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            padding: 12px 38px;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .ghost-btn:hover { background: #fff; color: var(--overlay-2); }

        /* ---------- Responsive ---------- */
        @media (max-width: 760px) {
            .auth-wrapper { padding: 0; align-items: stretch; }

            .container {
                width: 100%;
                min-height: auto;
                border-radius: 0;
                display: flex;
                flex-direction: column;
            }

            .overlay-container {
                position: relative;
                top: auto; left: auto;
                width: 100%;
                height: 200px;
                transform: none !important;
                overflow: hidden;
            }

            .overlay {
                position: relative;
                left: 0; width: 100%; height: 100%;
                transform: none !important;
            }

            .overlay-panel {
                position: absolute;
                width: 100%;
                padding: 40px 28px 20px;
                transform: none !important;
                opacity: 0;
                pointer-events: none;
                transition: opacity .35s ease;
            }

            .overlay-panel .coin-badge { width: 42px; height: 42px; font-size: 19px; margin-bottom: 8px; }
            .overlay-panel h1 { font-size: 18px; margin-bottom: 4px; }
            .overlay-panel p { font-size: 12px; margin-bottom: 10px; }
            .quote-line { display: none; }
            .ghost-btn { display: none; }

            .overlay-left { opacity: 1; pointer-events: auto; }
            .container.right-panel-active .overlay-left { opacity: 0; pointer-events: none; }
            .container.right-panel-active .overlay-right { opacity: 1; pointer-events: auto; }

            .form-container {
                position: relative;
                width: 100%;
                height: auto;
                opacity: 1;
                flex: 1;
            }

            .sign-in-container { display: flex; }
            .sign-up-container { display: none; opacity: 1; animation: none; }

            .container.right-panel-active .sign-in-container { display: none; transform: none; }
            .container.right-panel-active .sign-up-container { display: flex; transform: none; z-index: auto; }

            form { padding: 32px 26px 40px; justify-content: flex-start; }
            .switch-hint { display: block; }
        }
    </style>
</head>
<body>

    @include('nav')

    <div class="auth-wrapper">
        <div class="container {{ $activePanel === 'register' ? 'right-panel-active' : '' }}" id="container">

            {{-- SIGN UP FORM --}}
            <div class="form-container sign-up-container">
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <h1>Create account</h1>
                    <p class="subtitle">Join CampusCoin and start earning today.</p>

                    @if ($errors->any() && $activePanel === 'register')
                        <div class="alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <label class="field-label" for="reg-name">Full name</label>
                    <input id="reg-name" type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus>

                    <label class="field-label" for="reg-email">Email</label>
                    <input id="reg-email" type="email" name="email" placeholder="you@university.edu" value="{{ $activePanel === 'register' ? old('email') : '' }}" required>

                    <label class="field-label" for="reg-password">Password</label>
                    <div class="password-field">
                        <input id="reg-password" type="password" name="password" placeholder="Create a password" required>
                        <button type="button" class="toggle-pass" data-target="reg-password">👁</button>
                    </div>

                    <label class="field-label" for="reg-password-confirm">Confirm password</label>
                    <div class="password-field">
                        <input id="reg-password-confirm" type="password" name="password_confirmation" placeholder="Re-enter your password" required>
                        <button type="button" class="toggle-pass" data-target="reg-password-confirm">👁</button>
                    </div>

                    <button type="submit">Sign Up</button>

                    <div class="switch-hint">
                        Already have an account?
                        <button type="button" id="hintToSignIn">Sign in</button>
                    </div>
                </form>
            </div>

            {{-- SIGN IN FORM --}}
            <div class="form-container sign-in-container">
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <h1>Welcome back</h1>
                    <p class="subtitle">Sign in to your CampusCoin account.</p>

                    @if (session('status'))
                        <div class="status-msg">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any() && $activePanel === 'login')
                        <div class="alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <label class="field-label" for="login-email">Email</label>
                    <input id="login-email" type="email" name="email" placeholder="you@university.edu" value="{{ $activePanel === 'login' ? old('email') : '' }}" required autofocus>

                    <label class="field-label" for="login-password">Password</label>
                    <div class="password-field">
                        <input id="login-password" type="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-pass" data-target="login-password">👁</button>
                    </div>

                    <div class="row-between">
                        <label class="remember-check">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit">Sign In</button>

                    <div class="switch-hint">
                        New to CampusCoin?
                        <button type="button" id="hintToSignUp">Create an account</button>
                    </div>
                </form>
            </div>

            {{-- OVERLAY / HERO --}}
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <div class="coin-badge">🪙</div>
                        <h1>Welcome back!</h1>
                        <p>Sign in to check your balance, track your budget, and keep your savings goal on target.</p>
                        <p class="quote-line">"A budget is telling your money where to go, instead of wondering where it went."</p>
                        <button class="ghost-btn" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <div class="coin-badge">🎓</div>
                        <h1>Hello, friend!</h1>
                        <p>Create your CampusCoin account and start earning rewards for the things you already do on campus.</p>
                        <p class="quote-line">"Small daily savings today build the freedom you'll thank yourself for tomorrow."</p>
                        <button class="ghost-btn" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Theme toggle is handled by nav.blade.php (window.ccTheme)

        // ---- Panel switching ----
        const container = document.getElementById('container');
        const activate = () => container.classList.add('right-panel-active');
        const deactivate = () => container.classList.remove('right-panel-active');

        document.getElementById('signUp').addEventListener('click', activate);
        document.getElementById('signIn').addEventListener('click', deactivate);
        document.getElementById('hintToSignUp').addEventListener('click', activate);
        document.getElementById('hintToSignIn').addEventListener('click', deactivate);

        // ---- Password visibility toggles ----
        document.querySelectorAll('.toggle-pass').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                btn.textContent = isHidden ? '🙈' : '👁';
            });
        });
    </script>
</body>
</html>