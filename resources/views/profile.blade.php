<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->username }} — Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #0f0e0d;
            --surface:     #181714;
            --surface-alt: #1a1815;
            --border:      #2a2724;
            --text:        #f0ebe3;
            --muted:       #7a7167;
            --accent:      #c9a96e;
            --accent-dim:  rgba(201,169,110,0.1);
            --tag-bg:      #211f1c;
            --danger:      #e05c5c;
            --success:     #5cae87;
            --warning:     #e09a5c;
            --info:        #6ea8c9;

            /* status colours */
            --c-draft:     #7a7167;
            --c-submitted: #6ea8c9;
            --c-accepted:  #5cae87;
            --c-rejected:  #e05c5c;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 70% 30% at 50% 0%, rgba(201,169,110,0.05) 0%, transparent 60%);
        }

        /* ── Nav ──────────────────────────────────────── */
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

        .nav-btn-accent {
            border-color: var(--accent);
            color: var(--accent);
        }

        .nav-btn-accent:hover {
            background: var(--accent);
            color: #0f0e0d;
        }

        /* ── Layout ──────────────────────────────────── */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 5rem;
        }

        /* ── Profile header card ─────────────────────── */
        .profile-header {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 2rem 2rem 1.6rem;
            display: flex;
            align-items: flex-start;
            gap: 1.8rem;
            margin-bottom: 2.5rem;
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--tag-bg);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            color: var(--accent);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .profile-info { flex: 1; min-width: 0; }

        .profile-username {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 0.3rem;
        }

        .profile-email {
            font-size: 0.88rem;
            color: var(--muted);
            margin-bottom: 0.8rem;
        }

        .profile-roles {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .role-badge {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.18rem 0.6rem;
            border-radius: 100px;
            border: 1px solid var(--border);
            background: var(--tag-bg);
            color: var(--muted);
        }

        .role-badge.admin {
            border-color: var(--accent);
            background: var(--accent-dim);
            color: var(--accent);
        }

        .profile-meta {
            margin-left: auto;
            text-align: right;
            font-size: 0.8rem;
            color: var(--muted);
            flex-shrink: 0;
        }

        .profile-meta span { display: block; margin-bottom: 0.2rem; }

        /* ── Stats row ───────────────────────────────── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 600px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .profile-header { flex-direction: column; }
            .profile-meta { text-align: left; margin-left: 0; }
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            text-align: center;
            transition: border-color 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .stat-card:hover { border-color: #3a3530; }

        .stat-card.active-tab {
            border-color: var(--accent);
            background: var(--accent-dim);
        }

        .stat-number {
            font-family: 'DM Serif Display', serif;
            font-size: 1.9rem;
            font-weight: 400;
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .stat-card.draft   .stat-number,
        .stat-card.draft   .stat-label { color: var(--c-draft); }
        .stat-card.pending .stat-number,
        .stat-card.pending .stat-label { color: var(--c-submitted); }
        .stat-card.accepted .stat-number,
        .stat-card.accepted .stat-label { color: var(--c-accepted); }
        .stat-card.rejected .stat-number,
        .stat-card.rejected .stat-label { color: var(--c-rejected); }

        /* ── Section tabs ────────────────────────────── */
        .section {
            display: none;
            animation: fadeUp 0.3s ease both;
        }

        .section.active { display: block; }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .section-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            font-weight: 400;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .section-badge {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.15rem 0.6rem;
            border-radius: 100px;
        }

        .badge-draft    { background: rgba(122,113,103,0.15); border: 1px solid var(--c-draft);     color: var(--c-draft); }
        .badge-pending  { background: rgba(110,168,201,0.12); border: 1px solid var(--c-submitted); color: var(--c-submitted); }
        .badge-accepted { background: rgba(92,174,135,0.12);  border: 1px solid var(--c-accepted);  color: var(--c-accepted); }
        .badge-rejected { background: rgba(224,92,92,0.12);   border: 1px solid var(--c-rejected);  color: var(--c-rejected); }

        /* ── Post list rows ──────────────────────────── */
        .post-list { display: flex; flex-direction: column; gap: 0.6rem; }

        .post-row {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.1rem 1.3rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: background 0.2s, border-color 0.15s;
            text-decoration: none;
            color: inherit;
        }

        .post-row:hover {
            background: var(--surface-alt);
            border-color: #3a3530;
        }

        .post-row-left { flex: 1; min-width: 0; }

        .post-row-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            font-weight: 400;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.35rem;
        }

        .post-row-meta {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .post-row-time { font-size: 0.76rem; color: var(--muted); }

        .post-row-cats {
            display: flex;
            gap: 0.3rem;
            flex-wrap: wrap;
        }

        .cat-tag {
            font-size: 0.66rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.14rem 0.5rem;
            border-radius: 100px;
            background: var(--tag-bg);
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .post-row-right {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }

        /* Status pill on each row */
        .status-pill {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 0.2rem 0.65rem;
            border-radius: 100px;
        }

        .status-draft    { background: rgba(122,113,103,0.15); border: 1px solid var(--c-draft);     color: var(--c-draft); }
        .status-submitted{ background: rgba(110,168,201,0.12); border: 1px solid var(--c-submitted); color: var(--c-submitted); }
        .status-accepted { background: rgba(92,174,135,0.12);  border: 1px solid var(--c-accepted);  color: var(--c-accepted); }
        .status-rejected { background: rgba(224,92,92,0.12);   border: 1px solid var(--c-rejected);  color: var(--c-rejected); }

        /* Action buttons on draft rows */
        .row-actions { display: flex; gap: 0.4rem; }

        .row-btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.73rem;
            font-weight: 500;
            padding: 0.28rem 0.7rem;
            border-radius: 5px;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .row-btn:hover { border-color: var(--accent); color: var(--accent); }

        .row-btn-danger:hover { border-color: var(--danger); color: var(--danger); }

        .row-btn-submit {
            border-color: var(--c-submitted);
            color: var(--c-submitted);
        }

        .row-btn-submit:hover {
            background: rgba(110,168,201,0.1);
        }

        /* ── Rejected reason ─────────────────────────── */
        .rejection-note {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: var(--c-rejected);
            background: rgba(224,92,92,0.07);
            border: 1px solid rgba(224,92,92,0.2);
            border-radius: 6px;
            padding: 0.45rem 0.7rem;
            line-height: 1.4;
        }

        .rejection-note strong { display: block; font-size: 0.7rem; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.2rem; opacity: 0.7; }

        /* ── Empty state ─────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: 10px;
        }

        .empty-state svg { width: 40px; height: 40px; margin: 0 auto 0.9rem; opacity: 0.3; display: block; }
        .empty-state p   { font-size: 0.88rem; }
        .empty-state a   { color: var(--accent); text-decoration: none; }
        .empty-state a:hover { text-decoration: underline; }

        /* ── Alert ───────────────────────────────────── */
        .alert-success {
            background: rgba(92,174,135,0.1);
            border: 1px solid rgba(92,174,135,0.25);
            color: #7acba8;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

{{-- ── Navigation ──────────────────────────────────────── --}}
<nav>
    <a href="{{ route('home') }}" class="nav-brand">Forum</a>
    <div class="nav-right">
        @can('admin')
            <a href="{{ route('admin.posts.index') }}" class="nav-btn">Admin queue</a>
        @endcan
        <a href="{{ route('create') }}" class="nav-btn nav-btn-accent">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            New post
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-btn">Sign out</button>
        </form>
    </div>
</nav>

<div class="container">

    @if (session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    {{-- ── Profile header ──────────────────────────────── --}}
    <div class="profile-header">
        <div class="avatar">{{ strtoupper(substr($user->username, 0, 1)) }}</div>

        <div class="profile-info">
            <div class="profile-username">{{ $user->username }}</div>
            <div class="profile-email">{{ $user->email }}</div>
            <div class="profile-roles">
                @foreach ($user->roles as $role)
                    <span class="role-badge {{ $role->name->value === 'admin' ? 'admin' : '' }}">
                        {{ $role->name->value }}
                    </span>
                @endforeach
            </div>
        </div>

        <div class="profile-meta">
            <span>Member since {{ $user->created_at->format('D M Y') }}</span>
            <span>{{ $posts->total() }} {{ Str::plural('post', $posts->total()) }} total</span>
        </div>
    </div>

    {{-- ── Stats / tab selectors ───────────────────────── --}}
    <div class="stats-row">
        <a class="stat-card draft {{ request('tab', 'draft') === 'draft' ? 'active-tab' : '' }}"
            href="{{ route('profile', ['tab' => 'draft']) }}">
            <div class="stat-number">{{ $counts['draft'] }}</div>
            <div class="stat-label">Drafts</div>
        </a>
        <a class="stat-card pending {{ request('tab', 'draft') === 'pending' ? 'active-tab' : '' }}"
            href="{{ route('profile', ['tab' => 'pending']) }}">
            <div class="stat-number">{{ $counts['submitted'] }}</div>
            <div class="stat-label">Pending</div>
        </a>
        <a class="stat-card accepted {{ request('tab', 'draft') === 'accepted' ? 'active-tab' : '' }}"
            href="{{ route('profile', ['tab' => 'accepted']) }}">
            <div class="stat-number">{{ $counts['accepted'] }}</div>
            <div class="stat-label">Published</div>
        </a>
        <a class="stat-card rejected {{ request('tab', 'draft') === 'rejected' ? 'active-tab' : '' }}"
            href="{{ route('profile', ['tab' => 'rejected']) }}">
            <div class="stat-number">{{ $counts['rejected'] }}</div>
            <div class="stat-label">Rejected</div>
        </a>
    </div>

    {{-- ── Post sections (one visible at a time via ?tab=) ─ --}}

    @php $activeTab = request('tab', 'draft'); @endphp

    {{-- DRAFTS --}}
    <div class="section {{ $activeTab === 'draft' ? 'active' : '' }}" id="tab-draft">
        <div class="section-header">
            <h2 class="section-title">
                Drafts
                <span class="section-badge badge-draft">only you can see these</span>
            </h2>
        </div>

        @if ($posts->isEmpty() && $activeTab === 'draft')
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                </svg>
                <p>No drafts yet. <a href="{{ route('create') }}">Start writing →</a></p>
            </div>
        @else
            <div class="post-list">
                @foreach ($posts as $post)
                    <div class="post-row">
                        <div class="post-row-left">
                            <div class="post-row-title">{{ $post->title }}</div>
                            <div class="post-row-meta">
                                <span class="post-row-time">{{ $post->created_at->diffForHumans() }}</span>
                                <div class="post-row-cats">
                                    @foreach ($post->categories as $cat)
                                        <span class="cat-tag">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="post-row-right">
                            <span class="status-pill status-draft">Draft</span>
                            <div class="row-actions">
                                <a href="{{ route('edit', $post) }}" class="row-btn">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                {{-- Submit draft for review --}}
                                <form method="POST" action="{{ route('submit', $post) }}" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="submitted">
                                    <button type="submit" class="row-btn row-btn-submit"
                                        onclick="return confirm('Submit this post for review?')">
                                        Submit
                                    </button>
                                </form>
                                {{-- Delete draft --}}
                                <form method="POST" action="{{ route('delete', $post->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="row-btn row-btn-danger"
                                        onclick="return confirm('Delete this draft permanently?')">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->appends(['tab' => 'draft'])->links('vendor.pagination.custom') }}
        @endif
    </div>

    {{-- PENDING --}}
    <div class="section {{ $activeTab === 'pending' ? 'active' : '' }}" id="tab-pending">
        <div class="section-header">
            <h2 class="section-title">
                Pending review
                <span class="section-badge badge-pending">awaiting admin decision</span>
            </h2>
        </div>

        @if ($posts->isEmpty() && $activeTab === 'pending')
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <p>No posts waiting for review.</p>
            </div>
        @else   
            <div class="post-list">
                @foreach ($posts as $post)
                    <div class="post-row">
                        <div class="post-row-left">
                            <div class="post-row-title">{{ $post->title }}</div>
                            <div class="post-row-meta">
                                <span class="post-row-time">Submitted {{ $post->updated_at->diffForHumans() }}</span>
                                <div class="post-row-cats">
                                    @foreach ($post->categories as $cat)
                                        <span class="cat-tag">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="post-row-right">
                            <span class="status-pill status-submitted">Under review</span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->appends(['tab' => 'pending'])->links('vendor.pagination.custom') }}
        @endif
    </div>

    {{-- PUBLISHED / ACCEPTED --}}
    <div class="section {{ $activeTab === 'accepted' ? 'active' : '' }}" id="tab-accepted">
        <div class="section-header">
            <h2 class="section-title">
                Published posts
                <span class="section-badge badge-accepted">live on the forum</span>
            </h2>
        </div>

        @if ($posts->isEmpty() && $activeTab === 'accepted')
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <p>None of your posts have been published yet.</p>
            </div>
        @else
            <div class="post-list">
                @foreach ($posts as $post)
                    <a href="{{ route('show', $post->id) }}" class="post-row">
                        <div class="post-row-left">
                            <div class="post-row-title">{{ $post->title }}</div>
                            <div class="post-row-meta">
                                <span class="post-row-time">{{ $post->updated_at->diffForHumans() }}</span>
                                <div class="post-row-cats">
                                    @foreach ($post->categories as $cat)
                                        <span class="cat-tag">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="post-row-right">
                            <span class="status-pill status-accepted">Published</span>
                            <span class="post-row-time">
                                {{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $posts->appends(['tab' => 'accepted'])->links('vendor.pagination.custom') }}
        @endif
    </div>

    {{-- REJECTED --}}
    <div class="section {{ $activeTab === 'rejected' ? 'active' : '' }}" id="tab-rejected">
        <div class="section-header">
            <h2 class="section-title">
                Rejected posts
                <span class="section-badge badge-rejected">not published</span>
            </h2>
        </div>

        @if ($posts->isEmpty() && $activeTab === 'rejected')
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
                <p>No rejected posts.</p>
            </div>
        @else
            <div class="post-list">
                @foreach ($posts as $post)
                    <div class="post-row">
                        <div class="post-row-left">
                            <div class="post-row-title">{{ $post->title }}</div>
                            <div class="post-row-meta">
                                <span class="post-row-time">{{ $post->created_at->diffForHumans() }}</span>
                                <div class="post-row-cats">
                                    @foreach ($post->categories as $cat)
                                        <span class="cat-tag">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Show the rejection reason from the statuses table --}}
                            @php
                                $rejection = $post->statuses()
                                    ->where('status', \App\PostStatus::rejected->value)
                                    ->latest()
                                    ->first();
                            @endphp

                            @if ($rejection)
                                <div class="rejection-note">
                                    <strong>Rejection reason</strong>
                                    {{-- The 'body' column stores the admin's note if you add it, --}}
                                    {{-- otherwise show who rejected it and when. --}}
                                    Reviewed by admin · {{ $rejection->created_at->format('M j, Y') }}
                                </div>
                            @endif
                        </div>
                        <div class="post-row-right">
                            <span class="status-pill status-rejected">Rejected</span>
                            <div class="row-actions">
                                {{-- Author can edit and re-submit --}}
                                <a href="{{ route('edit', $post) }}" class="row-btn">Edit &amp; resubmit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->appends(['tab' => 'rejected'])->links('vendor.pagination.custom') }}
        @endif
    </div>

</div>
</body>
</html>