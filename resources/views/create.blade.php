<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post — Forum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #0f0e0d;
            --surface:    #181714;
            --surface-alt:#1a1815;
            --border:     #2a2724;
            --text:       #f0ebe3;
            --muted:      #7a7167;
            --accent:     #c9a96e;
            --tag-bg:     #211f1c;
            --input-bg:   #111010;
            --danger:     #e05c5c;
            --success:    #5cae87;
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
        .btn-outline-accent {
            background: none;
            border: 1px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline-accent:hover {
            background: rgba(201,169,110,0.08);
            transform: translateY(-1px);
        }

        .btn-outline-accent:active { transform: translateY(0); }

        /* ── Layout ──────────────────────────────────── */
        .container {
            max-width: 780px;
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

        /* ── Page header ─────────────────────────────── */
        .page-header { margin-bottom: 2rem; }

        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 0.3rem;
        }

        .page-header p {
            font-size: 0.88rem;
            color: var(--muted);
        }

        /* ── Form card ───────────────────────────────── */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 2rem 2rem 1.8rem;
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Form groups ─────────────────────────────── */
        .form-group { margin-bottom: 1.4rem; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
            margin-bottom: 1.4rem;
        }

        @media (max-width: 560px) {
            .form-row { grid-template-columns: 1fr; }
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

        label .optional {
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0;
            text-transform: none;
            color: var(--muted);
            opacity: 0.7;
            margin-left: 0.3rem;
        }

        input[type="text"],
        textarea,
        select {
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

        input[type="text"]::placeholder,
        textarea::placeholder { color: var(--muted); }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.1);
        }

        input.error, textarea.error, select.error {
            border-color: var(--danger);
        }

        textarea {
            resize: vertical;
            min-height: 220px;
            line-height: 1.65;
        }

        /* ── Category tag-input ──────────────────────── */

        /* The combined box that holds selected tags + the text input */
        .tag-input-box {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.45rem;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.55rem 0.8rem;
            cursor: text;
            transition: border-color 0.2s, box-shadow 0.2s;
            min-height: 46px;
        }

        .tag-input-box:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201,169,110,0.1);
        }

        .tag-input-box.error { border-color: var(--danger); }

        /* A selected tag chip inside the box */
        .tag-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.22rem 0.55rem 0.22rem 0.75rem;
            border-radius: 100px;
            background: rgba(201,169,110,0.13);
            border: 1px solid var(--accent);
            color: var(--accent);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
            animation: chipIn 0.15s ease both;
        }

        @keyframes chipIn {
            from { opacity: 0; transform: scale(0.85); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* NEW tag chip (typed, not from db) — slightly different shade */
        .tag-chip.is-new {
            background: rgba(92,174,135,0.1);
            border-color: #5cae87;
            color: #7acba8;
        }

        .tag-chip-remove {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: inherit;
            opacity: 0.6;
            display: flex;
            align-items: center;
            transition: opacity 0.15s;
            font-size: 0.85rem;
            line-height: 1;
        }

        .tag-chip-remove:hover { opacity: 1; }

        /* The invisible text input inside the box */
        .tag-text-input {
            flex: 1;
            min-width: 120px;
            background: none;
            border: none;
            outline: none;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            padding: 0.1rem 0.2rem;
        }

        .tag-text-input::placeholder { color: var(--muted); }

        /* Dropdown suggestions */
        .tag-suggestions {
            position: relative;
        }

        .tag-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: #1e1b18;
            border: 1px solid var(--border);
            border-radius: 8px;
            z-index: 50;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            max-height: 200px;
            overflow-y: auto;
        }

        .tag-dropdown.open { display: block; }

        .tag-dropdown-item {
            padding: 0.6rem 1rem;
            font-size: 0.88rem;
            color: var(--muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: background 0.15s, color 0.15s;
        }

        .tag-dropdown-item:hover,
        .tag-dropdown-item.highlighted {
            background: rgba(201,169,110,0.08);
            color: var(--text);
        }

        .tag-dropdown-item .badge {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.1rem 0.45rem;
            border-radius: 100px;
        }

        .badge-existing {
            background: var(--tag-bg);
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .badge-new {
            background: rgba(92,174,135,0.12);
            border: 1px solid #5cae87;
            color: #7acba8;
        }

        .tag-dropdown-empty {
            padding: 0.7rem 1rem;
            font-size: 0.82rem;
            color: var(--muted);
            font-style: italic;
        }

        /* Existing category pills (click to quick-add) */
        .existing-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.7rem;
        }

        .existing-pill-btn {
            background: var(--tag-bg);
            border: 1px solid var(--border);
            border-radius: 100px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.22rem 0.75rem;
            cursor: pointer;
            transition: all 0.18s;
        }

        .existing-pill-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(201,169,110,0.07);
        }

        .existing-pill-btn.selected {
            border-color: var(--accent);
            background: rgba(201,169,110,0.12);
            color: var(--accent);
            opacity: 0.5;
            cursor: default;
        }

        /* ── Char counter ────────────────────────────── */
        .field-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.4rem;
            min-height: 1.4rem;
        }

        .field-error {
            font-size: 0.76rem;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .field-error::before { content: '✕'; font-size: 0.7rem; }

        .char-count {
            font-size: 0.75rem;
            color: var(--muted);
            margin-left: auto;
        }

        .char-count.near  { color: #e09a5c; }
        .char-count.over  { color: var(--danger); }

        .hint {
            font-size: 0.76rem;
            color: var(--muted);
            margin-top: 0.35rem;
        }

        /* ── Divider ─────────────────────────────────── */
        .section-divider {
            height: 1px;
            background: var(--border);
            margin: 1.8rem 0;
        }

        /* ── Action bar ──────────────────────────────── */
        .action-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.8rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.72rem 1.6rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            letter-spacing: 0.02em;
        }

        .btn-ghost {
            background: none;
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-primary {
            background: var(--accent);
            color: #0f0e0d;
        }

        .btn-primary:hover {
            background: #d9b97e;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(201,169,110,0.22);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-primary:disabled {
            opacity: 0.45;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* ── Alert ───────────────────────────────────── */
        .alert-error {
            background: rgba(224,92,92,0.1);
            border: 1px solid rgba(224,92,92,0.25);
            color: #e07a7a;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.6rem;
            display: flex;
            gap: 0.6rem;
        }

        /* ── Preview panel ───────────────────────────── */
        .preview-panel {
            display: none;
            background: var(--surface-alt);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.4rem 1.5rem;
            margin-top: 0.6rem;
        }

        .preview-panel.visible { display: block; }

        .preview-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--text);
            margin-bottom: 0.8rem;
            line-height: 1.3;
        }

        .preview-body {
            font-size: 0.95rem;
            line-height: 1.75;
            color: #c8c0b4;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .preview-empty {
            font-size: 0.85rem;
            color: var(--muted);
            font-style: italic;
        }

        .toggle-preview-btn {
            background: none;
            border: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--accent);
            cursor: pointer;
            padding: 0;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: color 0.2s;
            margin-top: 0.5rem;
        }

        .toggle-preview-btn:hover { color: #d9b97e; }
        .toggle-preview-btn svg { width: 13px; height: 13px; }
    </style>
</head>
<body>

@php
    $isEdit = isset($post);
@endphp

{{-- ── Navigation ───────────────────────────────────────── --}}
<x-navbar />
@if (session('status'))
    <div class="alert-success"> {{session('status')}}</div>
@endif
{{-- ── Main ─────────────────────────────────────────────── --}}
<div class="container">

    <a href="{{ route('home') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        All posts
    </a>
    <div class="page-header">
        <h1>{{ $isEdit ? 'Edit post' : 'New post' }}</h1>
        <p>Share your thoughts with the community.</p>
    </div>

    <div class="form-card">
        <form
            action="{{ $isEdit ? route('posts.update', $post->slug) : route('posts.store') }}"
            method = "POST" 
            novalidate
            id="post-form"
        >
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            {{-- ── Title ──────────────────────────────────── --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title ?? '') }}"
                    placeholder="Give your post a clear, descriptive title"
                    class="{{ $errors->has('title') ? 'error' : '' }}"
                    required
                    autofocus
                >
                @error('title')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- ── Categories ──────────────────────────────── --}}
            <div class="form-group">
                <label>
                    Categories
                    <span class="optional">
                        @isset($post)
                            (edit existing categories, comma separated)
                        @else
                            (select existing or type to create new)
                        @endisset
                    </span>
                </label>

                <div class="tag-suggestions">

                @isset($post)
                    {{-- EDIT: single editable text field pre-filled with post's categories --}}
                    <input
                        type="text"
                        name="categories"
                        class="tag-text-input"
                        value="{{ $post->categories->pluck('name')->implode(', ') }}"
                        placeholder="Edit categories (comma separated)…"
                    >

                @else
                    {{-- CREATE: select existing + text for new ones --}}
                    @if ($categories->isNotEmpty())
                        <select name="categories[]" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @error('categories')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <input
                        type="text"
                        name="new_categories"
                        class="tag-text-input"
                        placeholder="{{ $categories->isNotEmpty() ? 'Or type new categories (comma separated)…' : 'Type categories (comma separated)…' }}"
                    >
                    @error('new_categories')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                @endisset

                </div>
            </div>
            <div class="section-divider"></div>

            {{-- ── Body ───────────────────────────────────── --}}
            <div class="form-group">
                <label for="body">Content</label>
                <textarea
                    id="body"
                    name="body"
                    placeholder="Write your post here…"
                    maxlength="20000"
                    class="{{ $errors->has('body') ? 'error' : '' }}"
                    required
                >{{ old('body', $post->body ?? '') }}</textarea>
                @error('body')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>



            {{-- ── Action bar ──────────────────────────────── --}}
            {{-- Hidden field — JS sets this to 'draft' or 'submitted' --}}
        <input type="hidden" name="action" id="form-action" value="draft">

            <div class="action-bar">
            <a href="{{ route('home') }}" class="btn btn-ghost">Cancel</a>
            
            @if(!$isEdit)
            <button
                type="submit"
                name = "draft"
                class="btn btn-outline-accent"
                id="btn-draft"
                onclick="setAction('draft')"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Save as draft
            </button>
            @endif

            <button
                type="submit"
                name="submitted"
                class="btn btn-primary"
                id="btn-submit"
                onclick="setAction('submitted')"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                {{ $isEdit ? 'Edit' : 'Submit for review' }}
            </button>
            </div>

        </form>
    </div>
</div>
</body>
<script>
    function setAction(value) {
        document.getElementById('form-action').value = value;
        setTimeout(() => {
            document.getElementById('btn-draft').disabled  = true;
            document.getElementById('btn-submit').disabled = true;
            document.getElementById('btn-draft').textContent  = value === 'draft' ? 'Saving…' : 'Save as draft';
            document.getElementById('btn-submit').textContent = value === 'submitted' ? 'Submitting…' : 'Submit for review';
        }, 0);
    }

    document.getElementById('post-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn'); 
    });
</script>
</html>