<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Forum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f0e0d;
            --surface: #181714;
            --border: #2a2724;
            --text: #f0ebe3;
            --muted: #7a7167;
            --accent: #c9a96e;
            --danger: #e05c5c;
            --input-bg: #111010;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background-image:
                radial-gradient(ellipse 55% 45% at 30% 30%, rgba(201,169,110,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 40% 55% at 80% 75%, rgba(201,169,110,0.04) 0%, transparent 55%);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2.5rem 2rem;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .brand {
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem;
            color: var(--accent);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }

        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            font-weight: 400;
            margin-bottom: 0.3rem;
            line-height: 1.1;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.88rem;
            margin-bottom: 2rem;
        }

        .form-group { margin-bottom: 1.1rem; }

        label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.45rem;
        }

        input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            padding: 0.72rem 1rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder { color: var(--muted); }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
        }

        input.error { border-color: var(--danger); }

        .field-error {
            font-size: 0.76rem;
            color: var(--danger);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .field-error::before { content: '✕'; font-size: 0.7rem; }

        .alert-error {
            background: rgba(224,92,92,0.1);
            border: 1px solid rgba(224,92,92,0.25);
            color: #e07a7a;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.4rem;
            display: flex;
            gap: 0.5rem;
        }

        .alert-success {
            background: rgba(92,174,135,0.1);
            border: 1px solid rgba(92,174,135,0.25);
            color: #7acba8;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.4rem;
        }

        .password-wrap { position: relative; }

        .toggle-pw {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 0.2rem;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .toggle-pw:hover { color: var(--accent); }
        .toggle-pw svg { width: 18px; height: 18px; }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.45rem;
        }

        .row-between label { margin-bottom: 0; }

        .forgot-link {
            font-size: 0.78rem;
            color: var(--accent);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover { color: #d9b97e; text-decoration: underline; }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-top: 0.5rem;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
            padding: 0;
        }

        .remember-row label {
            font-size: 0.85rem;
            text-transform: none;
            letter-spacing: 0;
            color: var(--muted);
            cursor: pointer;
            margin-bottom: 0;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.82rem 1rem;
            border-radius: 8px;
            border: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 1.6rem;
            letter-spacing: 0.03em;
        }

        .btn-primary {
            background: var(--accent);
            color: #0f0e0d;
        }

        .btn-primary:hover {
            background: #d9b97e;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(201,169,110,0.25);
        }

        .btn-primary:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.4rem 0 1rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span { font-size: 0.75rem; color: var(--muted); }

        .link-row {
            text-align: center;
            font-size: 0.88rem;
            color: var(--muted);
        }

        .link-row a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .link-row a:hover { color: #d9b97e; text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">
    <div class="brand">Forum</div>
    <h1>Welcome back</h1>
    <p class="subtitle">Sign in to continue your conversations.</p>

    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif
    @if (session('error-alert'))
        <div class="alert-error">{{ session('error-alert') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Login identifier: username or email --}}
        <div class="form-group">
            <label for="login">Username or Email</label>
            <input
                type="text"
                id="login"
                name="login"
                value="{{ old('login') }}"
                placeholder="Enter your username or email"
                autocomplete="username"
                class="{{ $errors->has('login') ? 'error' : '' }}"
                required
                autofocus
            >
            @error('login')
                <div class="field-error">{{ $message }}</div>
            @enderror
            @error('invalid_cred')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <div class="row-between">
                <label for="password">Password</label>
                <a href="{{ route('forgotpw') }}" class="forgot-link">Forgot password?</a>
            </div>
            <div class="password-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Your password"
                    autocomplete="current-password"
                    class="{{ $errors->has('password') ? 'error' : '' }}"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePw(this)" aria-label="Show password">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
            
            @error('invalid_cred')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="remember-row">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember me for 30 days</label>
        </div>

        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>

    <div class="divider"><span>New here?</span></div>

    <div class="link-row">
        <a href="{{ route('register') }}">Create a free account →</a>
    </div>
</div>

<script>
    function togglePw(btn) {
        const input = document.getElementById('password');
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.querySelector('svg').innerHTML = isText
            ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
    }
</script>

</body>
</html>
