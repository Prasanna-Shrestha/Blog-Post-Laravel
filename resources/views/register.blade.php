<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Forum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f0e0d;
            --surface: #181714;
            --border: #2a2724;
            --border-focus: #c9a96e;
            --text: #f0ebe3;
            --muted: #7a7167;
            --accent: #c9a96e;
            --accent-dark: #a8874d;
            --danger: #e05c5c;
            --success: #5cae87;
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
                radial-gradient(ellipse 60% 50% at 70% 20%, rgba(201,169,110,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(201,169,110,0.04) 0%, transparent 50%);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            width: 100%;
            max-width: 460px;
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
            color: var(--text);
            margin-bottom: 0.3rem;
            line-height: 1.1;
        }

        .subtitle {
            color: var(--muted);
            font-size: 0.88rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.45rem;
        }

        input, select {
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
            appearance: none;
        }

        input::placeholder { color: var(--muted); }

        input:focus, select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
        }

        input.error, select.error {
            border-color: var(--danger);
        }

        .select-wrap {
            position: relative;
        }

        .select-wrap::after {
            content: '';
            pointer-events: none;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid var(--muted);
        }

        select option {
            background: #1e1c1a;
        }

        .hint {
            font-size: 0.76rem;
            color: var(--muted);
            margin-top: 0.35rem;
        }

        .field-error {
            font-size: 0.76rem;
            color: var(--danger);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .field-error::before { content: '✕'; font-size: 0.7rem; }

        .alert {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.4rem;
            display: flex;
            gap: 0.6rem;
            align-items: flex-start;
        }

        .alert-error { background: rgba(224,92,92,0.1); border: 1px solid rgba(224,92,92,0.25); color: #e07a7a; }
        .alert-success { background: rgba(92,174,135,0.1); border: 1px solid rgba(92,174,135,0.25); color: #7acba8; }

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
        }

        .btn-primary {
            background: var(--accent);
            color: #0f0e0d;
            letter-spacing: 0.03em;
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

        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 0.5rem;
        }

        .strength-bar span {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: var(--border);
            transition: background 0.3s;
        }

        .strength-bar.weak span:first-child { background: var(--danger); }
        .strength-bar.fair span:nth-child(-n+2) { background: #e09a5c; }
        .strength-bar.good span:nth-child(-n+3) { background: var(--accent); }
        .strength-bar.strong span { background: var(--success); }
    </style>
</head>
<body>

<div class="card">
    <div class="brand">Forum</div>
    <h1>Create account</h1>
    <p class="subtitle">Join the community today.</p>

    {{-- Session / Validation Errors --}}
    <!-- @if ($errors->any())
        <div class="alert alert-error">
            <span>⚠</span>
            <ul style="list-style:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    @if (session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- Username --}}
        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                placeholder="e.g. john_doe"
                autocomplete="username"
                class="{{ $errors->has('username') ? 'error' : '' }}"
                required
            >
            @error('username')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                autocomplete="email"
                class="{{ $errors->has('email') ? 'error' : '' }}"
                required
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password</label>
            <div class="password-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Min. 8 chars, upper &amp; lowercase"
                    autocomplete="new-password"
                    class="{{ $errors->has('password') ? 'error' : '' }}"
                    required
                    oninput="checkStrength(this.value)"
                >
                <button type="button" class="toggle-pw" onclick="togglePw('password', this)" aria-label="Show password">
                    <svg id="eye-password" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            <div class="strength-bar" id="strength-bar">
                <span></span><span></span><span></span><span></span>
            </div>
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @else
                <div class="hint">At least 8 characters with one uppercase and one lowercase letter.</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <div class="password-wrap">
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat your password"
                    autocomplete="new-password"
                    class="{{ $errors->has('password_confirmation') ? 'error' : '' }}"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)" aria-label="Show password">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Role --}}
        <div class="form-group">
            <label for="role">Role <span style="color:var(--muted); font-size:0.72rem;">(optional)</span></label>
            <div class="select-wrap">
                <select id="role" name="role">
                    <option value="" {{ old('role') === '' ? 'selected' : '' }}>— Select a role —</option>
                    <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            @error('role')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create account</button>
    </form>

    <div class="divider"><span>Already a member?</span></div>

    <div class="link-row">
        <a href="{{ route('login') }}">Sign in to your account →</a>
    </div>
</div>

<script>
    function togglePw(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.querySelector('svg').innerHTML = isText
            ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
    }

    function checkStrength(val) {
        const bar = document.getElementById('strength-bar');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[a-z]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        bar.className = 'strength-bar';
        if (val.length === 0) return;
        const levels = ['', 'weak', 'fair', 'good', 'strong'];
        bar.classList.add(levels[score] || 'weak');
    }
</script>

</body>
</html>
