<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | WASTECLAN</title>
    <style>
        body {
            background: url('media/logwaste.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Dark overlay for readability */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            background-color: rgba(17, 17, 17, 0.9);
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

        label { 
            display: block; 
            margin: 10px 0 5px; 
        }

        input {
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
    </style>
</head>
<body>
<div class="container">
    <h2>Create an Account</h2>
    <form method="POST" action="{{ route('sign-up.post') }}">
        @csrf
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </form>
</div>
</body>
</html>
