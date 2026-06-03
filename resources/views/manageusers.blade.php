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
/* ── Page header ─────────────────────────────── */
.page-header-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 2rem;
    gap: 1rem;
    flex-wrap: wrap;
}
 
.page-title {
    font-family: 'DM Serif Display', serif;
    font-size: 2.2rem;
    font-weight: 400;
    line-height: 1;
}
 
.page-subtitle {
    font-size: 0.85rem;
    color: var(--muted);
    margin-top: 0.3rem;
}
 
/* ── Filter bar ──────────────────────────────── */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}
 
.filter-btn {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    padding: 0.32rem 0.9rem;
    border-radius: 100px;
    border: 1px solid var(--border);
    background: none;
    color: var(--muted);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.18s;
}
 
.filter-btn:hover          { border-color: var(--accent); color: var(--accent); }
.filter-btn.active         { border-color: var(--accent); background: var(--accent-dim); color: var(--accent); }
.filter-btn.active-status  { border-color: var(--success); background: rgba(92,174,135,0.1); color: var(--success); }
.filter-btn.inactive-status{ border-color: var(--danger);  background: rgba(224,92,92,0.1);  color: var(--danger); }
 
.search-wrap {
    position: relative;
    margin-left: auto;
}
 
.search-wrap svg {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    color: var(--muted);
    pointer-events: none;
}
 
.search-input {
    width: 220px;
    background: var(--input-bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    padding: 0.48rem 1rem 0.48rem 2.2rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
 
.search-input::placeholder { color: var(--muted); }
 
.search-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(201,169,110,0.1);
}
 
/* ── Summary chips ───────────────────────────── */
.summary-row {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.6rem;
    flex-wrap: wrap;
}
 
.summary-chip {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.6rem 1rem;
    font-size: 0.82rem;
    color: var(--muted);
}
 
.summary-chip strong {
    font-family: 'DM Serif Display', serif;
    font-size: 1.3rem;
    font-weight: 400;
    line-height: 1;
}
 
.chip-total   strong { color: var(--text); }
.chip-active  strong { color: var(--success); }
.chip-inactive strong { color: var(--danger); }
 
/* ── User table ──────────────────────────────── */
.user-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    animation: fadeUp 0.4s ease both;
}
 
.user-table {
    width: 100%;
    border-collapse: collapse;
}
 
.user-table thead tr {
    border-bottom: 1px solid var(--border);
}
 
.user-table th {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--muted);
    padding: 0.85rem 1.2rem;
    text-align: left;
    white-space: nowrap;
}
 
.user-table th.right,
.user-table td.right { text-align: right; }
 
.user-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}
 
.user-table tbody tr:last-child { border-bottom: none; }
 
.user-table tbody tr:hover { background: var(--surface-alt); }
 
.user-table td {
    padding: 1rem 1.2rem;
    font-size: 0.88rem;
    color: var(--text);
    vertical-align: middle;
}
 
/* ── User identity cell ──────────────────────── */
.user-identity {
    display: flex;
    align-items: center;
    gap: 0.85rem;
}
 
.user-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--tag-bg);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--accent);
    text-transform: uppercase;
    flex-shrink: 0;
}
 
.user-avatar.inactive-avatar {
    opacity: 0.45;
    filter: grayscale(1);
}
 
.user-name  { font-weight: 500; color: var(--text); line-height: 1.2; }
.user-email { font-size: 0.76rem; color: var(--muted); margin-top: 0.1rem; }
 
/* ── Role badges ─────────────────────────────── */
.role-pills { display: flex; flex-wrap: wrap; gap: 0.3rem; }
 
.role-pill {
    font-size: 0.66rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0.15rem 0.55rem;
    border-radius: 100px;
    border: 1px solid var(--border);
    background: var(--tag-bg);
    color: var(--muted);
}
 
.role-pill.admin { border-color: var(--accent); background: var(--accent-dim); color: var(--accent); }
 
/* ── Status badge ────────────────────────────── */
.user-status {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0.22rem 0.7rem;
    border-radius: 100px;
    white-space: nowrap;
}
 
.user-status .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
}
 
.status-active   { background: rgba(92,174,135,0.12); border: 1px solid var(--success); color: var(--success); }
.status-active   .dot { background: var(--success); }
.status-inactive { background: rgba(224,92,92,0.12);  border: 1px solid var(--danger);  color: var(--danger); }
.status-inactive .dot { background: var(--danger); }
 
/* ── Toggle form / button ────────────────────── */
.toggle-form { display: inline; }
 
.toggle-btn {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.3rem 0.85rem;
    border-radius: 6px;
    border: 1px solid var(--border);
    background: none;
    color: var(--muted);
    cursor: pointer;
    transition: all 0.18s;
    white-space: nowrap;
}
 
.toggle-btn.deactivate:hover {
    border-color: var(--danger);
    color: var(--danger);
    background: rgba(224,92,92,0.07);
}
 
.toggle-btn.activate:hover {
    border-color: var(--success);
    color: var(--success);
    background: rgba(92,174,135,0.07);
}
 
/* ── Self-row highlight (can't toggle yourself) ─ */
.self-row td { opacity: 0.55; }
.self-label {
    font-size: 0.7rem;
    color: var(--muted);
    font-style: italic;
}
 
/* ── Empty state ─────────────────────────────── */
.table-empty {
    padding: 3.5rem 1rem;
    text-align: center;
    color: var(--muted);
}
 
.table-empty svg {
    width: 40px;
    height: 40px;
    margin: 0 auto 0.9rem;
    opacity: 0.3;
    display: block;
}
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
        <h1 class="page-title">Manage User</h1>
    </div>

    
@if (session('status'))
    <div class="alert-success">{{ session('status') }}</div>
@endif   

{{-- User table --}}
<div class="user-table-wrap">
    @if ($users->isEmpty())
        <div class="table-empty">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
            <p>No users found.</p>
        </div>
    @else
        <table class="user-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Joined Date</th>
                    <th class="right">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php $isSelf = auth()->id() === $user->id; @endphp
                    <tr class="{{ $isSelf ? 'self-row' : '' }}">
                        {{-- Identity --}}
                        <td>
                            <div class="user-identity">
                                <div class="user-avatar {{ $user->is_active ? '' : 'inactive-avatar' }}">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->username }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
 
                        {{-- Roles --}}
                        <td>
                            <div class="role-pills">
                                @forelse ($user->roles as $role)
                                    <span class="role-pill {{ $role->name->value === 'admin' ? 'admin' : '' }}">
                                        {{ $role->name->value }}
                                    </span>
                                @empty
                                    <span class="role-pill">—</span>
                                @endforelse
                            </div>
                        </td>
                        {{-- Status --}}
                        <td>    
                            @if ($user->is_active)
                                <span class="user-status status-active">
                                    <span class="dot"></span> Active
                                </span>
                            @else
                                <span class="user-status status-inactive">
                                    <span class="dot"></span> Inactive
                                </span>
                        @endif
                        </td>
 
                        {{-- Joined date --}}
                        <td>
                            <span class="joined-date">{{ $user->created_at->format('M j, Y') }}</span>
                        </td>
 
                        {{-- Toggle action --}}
                        <td class="right">
                            @if ($isSelf)
                                <span class="self-label">Your Own Account</span>
                            @else
                                <form
                                    method="POST"
                                    action="{{ route('users.toogle', $user) }}"
                                    class="toggle-form"
                                    onsubmit="return confirm(
                                        '{{ $user->is_active
                                            ? 'Deactivate ' . $user->username . '? They won\'t be able to log in.'
                                            : 'Activate ' . $user->username . '? They will regain access.' }}'
                                    )"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="toggle-btn {{ $user->is_active ? 'deactivate' : 'activate' }}"
                                    >
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif
                        </td>
 
                    </tr>
                @endforeach
            </tbody>
        </table>
     @endif
</div>
</div>

@if($users->hasPages())
    <div class="pagination-wrap">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endif
</body>
</html>

