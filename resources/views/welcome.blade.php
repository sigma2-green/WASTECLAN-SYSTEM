<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WASTECLAN | Waste Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: white;
            overflow-x: hidden;
        }

        /* Video background */
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Overlay to darken video for better text visibility */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        nav {
            background-color: rgba(250, 235, 215, 0.85); /* antiquewhite with transparency */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
        }

        .logo {
            font-weight: bold;
            font-size: 35px;
            color: black;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            background-color: black;
            padding: 12px 25px;
            margin: 10px;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            color: darkgreen;
        }

        .hero {
            text-align: center;
            margin-top: 100px;
        }

        .hero h1 {
            font-size: 40px;
            color: white;
            margin-bottom: 10px;
        }

        .hero p {
            color: #ccc;
            font-size: 18px;
        }

        .auth-buttons {
            margin-top: 40px;
        }

        .auth-buttons a {
            text-decoration: none;
            color: black;
            background-color: white;
            padding: 20px 35px;
            margin: 10px;
            border-radius: 10px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #ccc;
            text-align: center;
            padding: 30px 10px;
            margin-top: 100px;
            position: relative;
        }

        footer .footer-links {
            margin-bottom: 15px;
        }

        footer .footer-links a {
            color: #ccc;
            text-decoration: none;
            margin: 0 10px;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        footer .footer-links a:hover {
            text-decoration: underline;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Video Background -->
    <video autoplay muted loop class="video-bg">
        <source src="media/waste.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Dark overlay -->
    <div class="overlay"></div>

    <nav>
        <div class="logo">♻️ </div>
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="#">Profile</a>
        </div>
    </nav>

    <div class="hero">
        <h1>Welcome</h1>

        <div class="auth-buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('sign-up.form') }}">Sign Up</a>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <a href="#">About</a> |
            <a href="#">Contact</a> |
            <a href="#">Privacy Policy</a> |
            <a href="#">Terms of Service</a>
        </div>
        <p>© 2025 WASTECLAN. All Rights Reserved. |  ♻️ for a greener tomorrow.</p>
    </footer>

</body>
</html>


