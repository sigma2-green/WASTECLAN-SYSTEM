@extends('layout.app')

@section('title', 'My Profile')

@section('styles')
<style>
    .profile-page {
        max-width: 900px;
        margin: 50px auto;
        font-family: 'Inter', sans-serif;
        color: #333;
    }

    /* Profile Header */
    .profile-header {
        position: relative;
        background: linear-gradient(135deg, #2E8B57, #4682B4);
        border-radius: 15px;
        padding: 40px 30px 30px 30px;
        display: flex;
        align-items: center;
        gap: 30px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        cursor: pointer; /* clickable */
        transition: transform 0.3s;
    }

    .profile-header img:hover {
        transform: scale(1.05);
    }

    .profile-header .profile-info h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
    }

    .profile-header .profile-info p {
        margin: 6px 0 0;
        font-size: 16px;
        opacity: 0.85;
    }

    /* Stats Section */
    .profile-stats {
        display: flex;
        justify-content: space-around;
        margin-top: -40px;
        background: #fff;
        padding: 20px 0;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .profile-stats .stat {
        text-align: center;
    }

    .profile-stats .stat h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: #2E8B57;
    }

    .profile-stats .stat p {
        margin: 4px 0 0;
        color: #555;
        font-size: 14px;
    }

    /* Action Buttons */
    .profile-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .profile-actions a {
        display: block;
        padding: 16px;
        border-radius: 12px;
        text-align: center;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .profile-actions a:hover {
        transform: translateY(-5px);
        opacity: 0.95;
    }

    .btn-edit { background: #4682B4; }
    .btn-incentives { background: #DAA520; }
    .btn-collect { background: #2E8B57; }
    .btn-issue { background: #B22222; }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background: rgba(0,0,0,0.7);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        max-width: 500px;
        width: 90%;
        border-radius: 12px;
        overflow: hidden;
        animation: zoomIn 0.3s;
    }

    .modal-content img {
        width: 100%;
        display: block;
        border-radius: 12px;
    }

    @keyframes zoomIn {
        from {transform: scale(0.5); opacity: 0;}
        to {transform: scale(1); opacity: 1;}
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 32px;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
    }

</style>
@endsection

@section('content')
<div class="profile-page">

    @php
        if ($user->profile_photo) {
            $avatarPath = asset('storage/' . $user->profile_photo);
        } elseif ($user->avatar) {
            $avatarPath = asset('storage/' . $user->avatar);
        } else {
            $avatarPath = "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=2E8B57&color=fff&size=128";
        }
    @endphp

    {{-- Profile Header --}}
    <div class="profile-header">
        <img id="profilePic" src="{{ $avatarPath }}" alt="Profile Picture">
        <div class="profile-info">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="profile-stats">
        <div class="stat">
            <h3>12</h3>
            <p>Collections</p>
        </div>
        <div class="stat">
            <h3>5</h3>
            <p>Incentives</p>
        </div>
        <div class="stat">
            <h3>2</h3>
            <p>Reported Issues</p>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="profile-actions">
        <a href="{{ route('profile.edit') }}" class="btn-edit">Edit Profile</a>
        <a href="{{ route('incentives.index') }}" class="btn-incentives">My Incentives</a>
        <a href="{{ route('collect') }}" class="btn-collect">Request Collection</a>
        <a href="{{ route('issues') }}" class="btn-issue">Report Issue</a>
    </div>

    {{-- Settings Button --}}
<div class="profile-actions mt-6">
    <a href="{{ route('settings') }}"
       class="bg-gray-700 text-white flex-1 py-3 rounded-xl text-center font-semibold hover:bg-gray-800 transition">
       Account Settings
    </a>
</div>


</div>

{{-- Modal for Enlarged Image --}}
<div id="modal" class="modal">
    <span class="close-modal">&times;</span>
    <div class="modal-content">
        <img src="{{ $avatarPath }}" alt="Profile Picture Large">
    </div>
</div>

@endsection

@section('scripts')
<script>
    const modal = document.getElementById("modal");
    const img = document.getElementById("profilePic");
    const closeBtn = document.querySelector(".close-modal");

    img.onclick = function() {
        modal.style.display = "flex";
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(e) {
        if(e.target == modal){
            modal.style.display = "none";
        }
    }
</script>
@endsection





