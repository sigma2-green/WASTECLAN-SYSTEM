@extends('layout.app')

@section('title', 'Edit Profile')

@section('styles')
<style>
    body {
        background: black;
        font-family: 'Inter', sans-serif;
    }

    .edit-profile-page {
        max-width: 700px;
        margin: 50px auto;
        font-family: 'Inter', sans-serif;
        color: #333;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px 30px;
        text-align: center;
    }

    .edit-profile-page h2 {
        font-size: 28px;
        color: #2E8B57;
        margin-bottom: 30px;
        font-weight: 700;
    }

    /* Profile Picture Circle (clickable) */
    .profile-pic-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto 25px;
        cursor: pointer;
    }

    .profile-pic-wrapper img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 3px solid #2E8B57;
        object-fit: cover;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .profile-pic-wrapper:hover img {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(46,139,87,0.4);
    }

    .profile-pic-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .form-group label {
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"] {
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
        border-color: #2E8B57;
        box-shadow: 0 0 6px rgba(46,139,87,0.3);
        outline: none;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 14px;
        background-color: #2E8B57;
        color: #fff;
        font-weight: 700;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-submit:hover {
        background-color: #276644;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .edit-profile-page {
            padding: 30px 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="edit-profile-page">
    <h2>Edit Profile</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        @php
            $avatarPath = $user->profile_photo 
                ? asset('storage/' . $user->profile_photo) 
                : "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=2E8B57&color=fff&size=128";
        @endphp

        {{-- Clickable Profile Picture --}}
        <div class="profile-pic-wrapper">
            <img id="profilePreview" src="{{ $avatarPath }}" alt="Profile Picture">
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
        </div>

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- Phone --}}
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <button type="submit" class="btn-submit">Update Profile</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const profileInput = document.getElementById('profile_photo');
    const profilePreview = document.getElementById('profilePreview');

    profileInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(event){
                profilePreview.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
