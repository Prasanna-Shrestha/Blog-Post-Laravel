<nav>
    <div>
        <a href="{{ route('home') }}" class="nav-brand">Forum</a>
    </div>
        <div class="nav-right">
        @auth
            <a href="{{ route('admin.users.index') }}" class="nav-btn">
                Manage User Permissions
            </a>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="/manageusers" class="nav-brand">Manage Users</a>
            @endcan
            <a href="{{ route('posts.create') }}" class="nav-btn">
                Create
            </a>
            <span class="nav-user">Signed in as <strong>{{ auth()->user()->username }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sign out
                </button>
            </form>
            <a href="{{ route('profile.show') }}" class="nav-user">
                {{ auth()->user()->username }} Profile</a>
        @else
            <a href="{{ route('login') }}" class="nav-btn">Sign in</a>
        @endauth
    </div>
</nav>