<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body {
            background: url('{{ asset('media/logwaste.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 150vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 1;
            background-color: rgba(17, 17, 17,0.9);
            padding: 40px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 0 25px rgba(0,0,0,0.5);
        }

        h2 {
            text-align: center;
            color: #00ff00;
            margin-bottom: 25px;
        }

        /* Avatar Circle */
        .avatar-wrapper {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #00ff00;
            margin: 0 auto 20px auto;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #222;
        }

        .avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        label { display: block; margin: 10px 0 5px; }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background-color: #222;
            color: white;
        }

        input:focus { outline: 2px solid #00ff00; }

        button {
            width: 100%;
            margin-top: 20px;
            background-color: #00ff00;
            color: black;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover { background-color: #00cc00; }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #00ff00;
            text-decoration: none;
        }

        a:hover { text-decoration: underline; }

        #profile_photo {
            display: none; /* hide the file input */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Create an Account</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sign-up.post') }}" enctype="multipart/form-data">
        @csrf

        <!-- Clickable Circular Avatar -->
        <div class="avatar-wrapper" onclick="document.getElementById('profile_photo').click()">
            <img id="avatarPreview" src="{{ asset('media/default-avatar.png') }}">
        </div>

        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewAvatar(event)">

        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <label for="role">Register as:</label>
        <select name="role" id="role" required>
            <option value="resident">Resident</option>

            @if(Auth::check() && Auth::user()->role === 'admin')
                <option value="collector">Collector</option>
                <option value="admin">Admin</option>
            @endif
        </select>

        <div>
    <label class="block font-medium">Address</label>
    <input type="text" name="address" value="{{ old('address') }}"
           class="w-full border p-2 rounded" placeholder="Enter your address">
    </div>


        <button type="submit">Sign Up</button>

        <p>Already have an account?  
            <a href="{{ route('login.form') }}">Login</a>
        </p>
    </form>
</div>

<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('avatarPreview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>


