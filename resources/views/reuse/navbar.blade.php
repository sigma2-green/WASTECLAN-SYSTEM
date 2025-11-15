<nav style="display:flex; justify-content:space-between; align-items:center; padding:12px 25px; background-color:antiquewhite; box-shadow:0 3px 6px rgba(0,0,0,0.1); font-family:Arial, sans-serif; border-radius:0px;">

    <!-- Left: Logo / Profile -->
    <div class="logo" style="display:flex; align-items:center; gap:12px;">
        @auth
            @php
                $profilePic = auth()->user()->profile_photo
                    ? asset('storage/' . auth()->user()->profile_photo)
                    : asset('media/default-avatar.png'); // set your default image path here
            @endphp

            <a href="{{ route('profile') }}" style="display:flex; align-items:center; text-decoration:none; color:#333; gap:8px;">
                <img src="{{ $profilePic }}" alt="Profile Photo" class="profile-pic">
                <span style="font-weight:bold; font-size:1rem;">{{ auth()->user()->name }}</span>
            </a>
        @else
            <span style="font-size:1.2rem; font-weight:bold; color:#2E8B57; display:flex; align-items:center; gap:6px;">
                ♻️ Waste Management
            </span>
        @endauth
    </div>

    <!-- Right: Navigation Links -->
    <div class="nav-links" style="display:flex; gap:18px; align-items:center;">
        @auth
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('profile') }}" class="nav-link">Profile</a>
            <a href="{{ route('logout') }}" class="nav-link logout-link" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: red;">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login.form') }}" class="nav-link">Login</a>
            <a href="{{ route('sign-up.form') }}" class="nav-link sign-up-link">Sign Up</a>
        @endauth
    </div>
</nav>

<style>
    .profile-pic {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #2E8B57;
        transition: transform 0.2s;
    }
    .profile-pic:hover {
        transform: scale(1.1);
    }

    .nav-link {
        font-family: 'Times New Roman', Times, serif;
        text-decoration: none;
        color: #333;
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        text-decoration: underline;
    }

    .logout-link {
        color: #c0392b;
        font-weight: 600;
    }
    .logout-link:hover {
        text-decoration: underline;
    }

    .sign-up-link {
        background-color: #2E8B57;
        color: #fff;
        font-weight: 600;
    }
    .sign-up-link:hover {
        text-decoration: underline;
    }
</style>







