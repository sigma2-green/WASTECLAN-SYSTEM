<nav>
    <div class="logo">♻️ Waste Management</div>
    <div class="nav-links">
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:black;font-weight:bold;cursor:pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('login.form') }}">Login</a>
            <a href="{{ route('sign-up.form') }}">Sign Up</a>
        @endauth
    </div>
</nav>

