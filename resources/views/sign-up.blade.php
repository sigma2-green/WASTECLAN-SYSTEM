<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | WASTECLAN</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #111;
            padding: 40px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 0 15px rgba(255,255,255,0.1);
        }
        h2 {
            text-align: center;
            color: green;
            margin-bottom: 25px;
        }
        label { display: block; margin: 10px 0 5px; }
        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background-color: #222;
            color: white;
        }
        input:focus { outline: 2px solid green; }
        button {
            width: 100%;
            margin-top: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background-color: darkgreen; }
        p {
            text-align: center;
            margin-top: 20px;
        }
        a {
            color: green;
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

        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </form>
</div>
</body>
</html>
