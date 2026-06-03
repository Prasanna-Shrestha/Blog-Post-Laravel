<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} — Forum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f0e0d;
            --surface: #181714;
            --surface-alt: #1a1815;
            --border: #2a2724;
            --text: #f0ebe3;
            --muted: #7a7167;
            --accent: #c9a96e;
            --tag-bg: #211f1c;
            --input-bg: #111010;
            --danger: #e05c5c;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 70% 30% at 50% 0%, rgba(201,169,110,0.05) 0%, transparent 60%);
        }

        /* ── Nav ─────────────────────────────────────── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15,14,13,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: var(--accent);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-user { font-size: 0.85rem; color: var(--muted); }
        .nav-user strong { color: var(--text); }

        .nav-btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 0.42rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s;
        }

        .nav-btn:hover { border-color: var(--accent); color: var(--accent); }

        /* ── Layout ──────────────────────────────────── */
        .container {
            max-width: 760px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 5rem;
        }

        /* ── Back link ───────────────────────────────── */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.82rem;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: 2rem;
            transition: color 0.2s;
        }

        .back-link:hover { color: var(--accent); }

        .back-link svg { width: 14px; height: 14px; }

        /* ── Post header ─────────────────────────────── */
        .post-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 1.4rem;
        }

        .post-header-left { flex: 1; min-width: 0; }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 0.9rem;
        }

        .category-tag {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.22rem 0.65rem;
            border-radius: 100px;
            background: var(--tag-bg);
            border: 1px solid var(--border);
            color: var(--accent);
        }

        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            font-weight: 400;
            line-height: 1.2;
            color: var(--text);
        }

        .post-header-right {
            text-align: right;
            flex-shrink: 0;
            padding-top: 0.2rem;
        }

        .post-author {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .post-time { font-size: 0.78rem; color: var(--muted); }

        /* ── Divider ─────────────────────────────────── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 1.6rem 0;
        }

        /* ── Post body ───────────────────────────────── */
        .post-body {
            font-size: 1rem;
            line-height: 1.75;
            color: #d4cec5;
        }

        .post-body p { margin-bottom: 1.2em; }

        /* ── Comments section ────────────────────────── */
        .comments-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
        }

        .comments-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            font-weight: 400;
        }

        .comments-count-badge {
            font-size: 0.78rem;
            color: var(--muted);
            background: var(--tag-bg);
            border: 1px solid var(--border);
            padding: 0.2rem 0.7rem;
            border-radius: 100px;
        }

        /* ── Comment card ─────────────────────────────── */
        .comment-list {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            margin-bottom: 2rem;
        }

        .comment-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            display: flex;
            gap: 1rem;
            animation: fadeUp 0.3s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .commenter-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--tag-bg);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--accent);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .comment-body { flex: 1; min-width: 0; }

        .comment-meta {
            display: flex;
            align-items: baseline;
            gap: 0.6rem;
            margin-bottom: 0.35rem;
        }

        .commenter-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
        }

        .comment-time {
            font-size: 0.75rem;
            color: var(--muted);
        }

        .comment-text {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #c8c0b4;
            word-break: break-word;
        }

        /* ── No comments ─────────────────────────────── */
        .no-comments {
            text-align: center;
            padding: 2.5rem;
            color: var(--muted);
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: 10px;
            font-size: 0.88rem;
            margin-bottom: 2rem;
        }

        /* ── Add comment form ─────────────────────────── */
        .add-comment {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.4rem 1.5rem;
        }

        .add-comment-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem;
            font-weight: 400;
            margin-bottom: 1rem;
        }

        textarea {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.93rem;
            padding: 0.8rem 1rem;
            outline: none;
            resize: vertical;
            min-height: 90px;
            transition: border-color 0.2s, box-shadow 0.2s;
            line-height: 1.5;
        }

        textarea::placeholder { color: var(--muted); }

        textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.1);
        }

        textarea.error { border-color: var(--danger); }

        .field-error {
            font-size: 0.76rem;
            color: var(--danger);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .field-error::before { content: '✕'; font-size: 0.7rem; }

        .comment-form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.8rem;
            margin-top: 0.9rem;
        }

        .char-count {
            font-size: 0.76rem;
            color: var(--muted);
        }

        .btn-submit {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            border: none;
            background: var(--accent);
            color: #0f0e0d;
            cursor: pointer;
            transition: all 0.2s;
            letter-spacing: 0.02em;
        }

        .btn-submit:hover {
            background: #d9b97e;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(201,169,110,0.2);
        }

        .btn-submit:active { transform: translateY(0); }

        .login-prompt {
            font-size: 0.88rem;
            color: var(--muted);
            text-align: center;
            padding: 1rem;
        }

        .login-prompt a { color: var(--accent); text-decoration: none; }
        .login-prompt a:hover { text-decoration: underline; }
    </style>
</head>
<body>

{{-- Navigation --}}
<x-navbar />

@if (session('status'))
    <div class="alert-success"> {{session('status')}}</div>
@endif
{{-- Main --}}
<div class="container">

    {{-- Back --}}
    <a href="{{ route('home') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        All posts
    </a>

    {{-- Post header: categories (top-left) + author/time (top-right) --}}
    <div class="post-header">
        <div class="post-header-left">
            <div class="category-list">
                @forelse ($post->categories as $cat)
                    <span class="category-tag">{{ $cat->name }}</span>
                @empty
                    <span class="category-tag" style="color:var(--muted);">Uncategorized</span>
                @endforelse
            </div>
            <h1>{{ $post->title }}</h1>
        </div>

        <div class="post-header-right">
            <div class="post-author">{{ $post->user->username }}</div>
            <div class="post-time">{{ $post->created_at->format('M j, Y · g:i a') }}</div>
        </div>
    </div>

    {{-- Post body --}}
    <div class="post-body">
        {!! nl2br(e($post->body)) !!}
    </div>

    <div class="divider"></div>

    <div class="comments-header">
        <h2 class="comments-title">Views</h2>
        <span class="comments-count-badge">{{ $post->views }}</span>
    </div>

    <div class="divider"></div>

    {{-- Comments --}}
    <div class="comments-header">
        <h2 class="comments-title">Comments</h2>
        <span class="comments-count-badge">{{ $post->comments->count() }}</span>
    </div>

    @if ($post->comments->isEmpty())
        <div class="no-comments">No comments yet — be the first to share your thoughts.</div>
    @else
        <div class="comment-list">
            @foreach ($post->comments as $comment)
                <div class="comment-card" style="animation-delay: {{ $loop->index * 0.04 }}s;">
                    <div class="commenter-avatar">
                        {{ strtoupper(substr($comment->user->username, 0, 1)) }}
                    </div>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <span class="commenter-name">{{ $comment->user->username }}</span>
                            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="comment-text">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Add comment --}}
    <div class="add-comment">
        @auth
            <h3 class="add-comment-title">Leave a comment</h3>

            @if (session('comment_success'))
                <div style="background:rgba(92,174,135,0.1);border:1px solid rgba(92,174,135,0.25);color:#7acba8;border-radius:8px;padding:0.65rem 1rem;font-size:0.84rem;margin-bottom:1rem;">
                    ✓ {{ session('comment_success') }}
                </div>
            @endif

            <form action = " {{ route('posts.comment', $post->id) }} " method="POST" novalidate>
                @csrf
                <textarea
                    name="body"
                    id="comment-body"
                    placeholder="Write your comment…"
                    maxlength="1000"
                    class="{{ $errors->has('body') ? 'error' : '' }}"
                    oninput="updateCount(this)"
                    required
                >{{ old('body') }}</textarea>

                @error('body')
                    <div class="field-error">{{ $message }}</div>
                @enderror

                <div class="comment-form-footer">
                    <span class="char-count" id="char-count">0 / 1000</span>
                    <button type="submit" class="btn-submit">Post comment</button>
                </div>
            </form>
        @else
            <p class="login-prompt">
                <a href="{{ route('login') }}">Sign in</a> to join the conversation.
            </p>
        @endauth
    </div>

</div>

<script>
    function updateCount(el) {
        document.getElementById('char-count').textContent = el.value.length + ' / 1000';
    }

    // Initialize if old() value exists
    const ta = document.getElementById('comment-body');
    if (ta) updateCount(ta);
</script>

</body>
</html>
