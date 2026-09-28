<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusCoin | Reset Password</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
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
        --shadow: rgba(20, 35, 80, .14);
        --danger-bg: #fdecec;
        --danger-border: #f6c6c6;
        --danger-text: #b3261e;
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
        --shadow: rgba(0, 0, 0, .55);
        --danger-bg: #2a1414;
        --danger-border: #4a1f1f;
        --danger-text: #f5a3a3;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', system-ui, sans-serif;
        background: var(--bg);
        color: var(--text);
        padding: 24px;
        transition: background .25s ease, color .25s ease;
    }

    .top-brand {
        position: fixed;
        top: 24px;
        left: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 200;
    }

    .top-brand .logo-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 15px;
    }

    .top-brand span {
        font-weight: 800;
        font-size: 15px;
        color: var(--text);
    }

    .theme-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 1px solid var(--border);
        background: var(--card-bg);
        color: var(--text);
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 6px 16px var(--shadow);
        z-index: 200;
        transition: transform .15s ease;
    }

    .theme-toggle:hover { transform: translateY(-2px); }

    .container {
        background: var(--card-bg);
        border-radius: 22px;
        box-shadow: 0 30px 70px var(--shadow);
        width: 440px;
        max-width: 100%;
        padding: 48px 44px;
        transition: background .25s ease;
    }

    .coin-badge {
        width: 52px;
        height: 52px;
        background: var(--primary-soft);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 18px;
    }

    h1 {
        margin: 0 0 6px;
        font-size: 23px;
        font-weight: 800;
        color: var(--text);
    }

    .subtitle {
        color: var(--text-muted);
        font-size: 13.5px;
        line-height: 1.6;
        margin: 0 0 22px;
    }

    .alert-danger {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 12.5px;
        text-align: left;
        background: var(--danger-bg);
        border: 1px solid var(--danger-border);
        color: var(--danger-text);
    }
    .alert-danger p { margin: 3px 0; }

    .field-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        margin: 10px 0 5px;
        text-align: left;
        display: block;
    }

    input[type="email"],
    input[type="password"] {
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

    input::placeholder { color: var(--text-muted); }

    input:focus {
        border-color: var(--primary);
        background: var(--card-bg);
    }

    .password-field { position: relative; }
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

    button[type="submit"] {
        width: 100%;
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

    button[type="submit"]:hover { background: var(--primary-dark); }
    button[type="submit"]:active { transform: scale(0.98); }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-size: 12.5px;
        color: var(--text-muted);
        text-decoration: none;
    }

    .back-link:hover { color: var(--primary); text-decoration: underline; }
</style>
<body>

    <div class="top-brand">
        <div class="logo-icon">C</div>
        <span>CampusCoin</span>
    </div>

    <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle dark mode">🌙</button>

    <div class="container">
        <div class="coin-badge">🔒</div>
        <h1>Reset your password</h1>
        <p class="subtitle">Choose a new password for your account below.</p>

        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label class="field-label" for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="you@university.edu" value="{{ old('email', $request->email) }}" required autofocus>

            <label class="field-label" for="password">New password</label>
            <div class="password-field">
                <input id="password" type="password" name="password" placeholder="Enter a new password" required>
                <button type="button" class="toggle-pass" data-target="password">👁</button>
            </div>

            <label class="field-label" for="password_confirmation">Confirm new password</label>
            <div class="password-field">
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter your new password" required>
                <button type="button" class="toggle-pass" data-target="password_confirmation">👁</button>
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <a class="back-link" href="{{ route('login') }}">← Back to sign in</a>
    </div>

    <script>
        const root = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('cc-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        function applyTheme(theme) {
            root.setAttribute('data-theme', theme);
            toggleBtn.textContent = theme === 'dark' ? '☀️' : '🌙';
        }

        applyTheme(savedTheme || (prefersDark ? 'dark' : 'light'));

        toggleBtn.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            localStorage.setItem('cc-theme', next);
        });

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