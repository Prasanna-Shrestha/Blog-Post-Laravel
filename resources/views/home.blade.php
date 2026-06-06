<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum — All Posts</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f0e0d;
            --surface: #181714;
            --surface-hover: #1e1b18;
            --border: #2a2724;
            --text: #f0ebe3;
            --muted: #7a7167;
            --accent: #c9a96e;
            --accent-dim: rgba(201,169,110,0.12);
            --tag-bg: #211f1c;
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

        .nav-user {
            font-size: 0.85rem;
            color: var(--muted);
        }

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

        .nav-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── Layout ──────────────────────────────────── */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        .page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .page-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            font-weight: 400;
            line-height: 1;
        }

        .page-count {
            font-size: 0.82rem;
            color: var(--muted);
        }

        /* ── Post card ────────────────────────────────── */
        .post-list {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .post-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.4rem 1.5rem 1.2rem;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
            margin-bottom: 0.75rem;
        }

        .post-card:hover {
            background: var(--surface-hover);
            border-color: #3a3530;
            transform: translateY(-1px);
        }

        .post-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.7rem;
        }

        .post-left { flex: 1; min-width: 0; }

        .post-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--text);
            line-height: 1.3;
            margin-bottom: 0.55rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
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

        .post-right {
            text-align: right;
            flex-shrink: 0;
        }

        .post-author {
            font-size: 0.83rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .post-time {
            font-size: 0.76rem;
            color: var(--muted);
        }

        .post-card-bottom {
            border-top: 1px solid var(--border);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .comment-count-icon {
            width: 15px;
            height: 15px;
            color: var(--muted);
            flex-shrink: 0;
        }

        .comment-count {
            font-size: 0.8rem;
            color: var(--muted);
        }

        .comment-count strong {
            color: var(--text);
            font-weight: 600;
        }

        /* ── Empty state ─────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--muted);
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 1.2rem;
            opacity: 0.35;
        }

        .empty-state p { font-size: 0.95rem; }

        /* ── Pagination ───────────────────────────────── */
        .pagination-wrap {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            list-style: none;
        }

        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 0.85rem;
            color: var(--muted);
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .pagination li a:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .pagination li.active span,
        .pagination li span[aria-current="page"] {
            background: var(--accent);
            border-color: var(--accent);
            color: #0f0e0d;
            font-weight: 700;
        }

        .pagination li span.disabled,
        .pagination li.disabled span {
            opacity: 0.3;
            cursor: not-allowed;
        }
        
    </style>
</head>
<body>

{{-- Navigation --}}
<x-navbar />

{{-- Main --}}
<div class="container">
    <div class="page-header">
        <h1 class="page-title">All Posts</h1>
        <span class="page-count">{{ $posts->total() }} {{ Str::plural('post', $posts->total()) }}</span>
    </div>
    @if ($posts->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
            <p>No posts yet. Be the first to write one.</p>
        </div>
    @else
<div class="post-list">
@if (session('status'))
    <div class="alert-success">{{ session('status') }}</div>
@endif
@foreach ($posts as $post)

@can('view', $post)
<a class="post-card" href="{{ route('posts.show', $post->slug) }}">
    <div class="post-card-top">

        {{-- Left --}}
        <div class="post-left">
            <div class="post-title">{{ $post->title }}</div>

            <div class="category-list">
                @forelse ($post->categories as $cat)
                    <span class="category-tag">{{ $cat->name }}</span>
                @empty
                    <span class="category-tag" style="color:var(--muted);">
                        Uncategorized
                    </span>
                @endforelse
            </div>
        </div>

        {{-- Right --}}
        <div class="post-right">

            <div class="post-author">
                {{ $post->user->username }}
            </div>

            <div class="post-time">
                {{ $post->created_at->diffForHumans() }}
            </div>

            {{-- Actions --}}
            @can('update', $post)
                <form action="{{ route('posts.edit', $post) }}" method="get">
                    <button type="submit">Edit</button>
                </form>
            @endcan

            @can('delete', $post)
                <form action="{{ route('posts.delete', $post->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                        Delete
                    </button>    
                </form>
            @endcan

        </div>

    </div>

    {{-- Body --}}
    <div>
        <div>{{ $post->body }}</div>
    </div>

    {{-- Comments --}}
    <div class="post-card-bottom">
        <svg class="comment-count-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>

        <span class="comment-count">
            <strong>{{ $post->comments_count }}</strong>
            {{ Str::plural('comment', $post->comments_count) }}
        </span>
        <svg class="comment-count-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>

        <span class="comment-count">
            <strong>{{ $post->views }}</strong>
            {{ Str::plural('view', $post->views) }}
        </span>

        @if(  $post->current_status->value == "draft")
            DRAFT POST
        @elseif ($post->current_status->value == "submitted")
            SUBMITTED FOR REVIEW
        @endif

    </div>
    

    {{-- Admin actions --}}
    @if (auth()->check())
        <div class="post-right">

            @can('publish', $post)
                <form action="{{ route('posts.publish', $post) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit">Publish Post</button>
                </form> 
            @endcan

            @can('reject', $post)
                <form action="{{ route('posts.reject', $post) }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit">Reject Post</button>
                </form>
            @endcan

        </div>
    @endif

</a>

@endcan

@endforeach
            {{-- Pagination --}}
            @if ($posts->hasPages())
                <div class="pagination-wrap">
                    {{ $posts->links('vendor.pagination.custom') }}
                </div>
            @endif    


    @endif
    
</div>

</body>
</html>

