<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Waste Management System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        nav {
            background-color: rgba(250, 235, 215, 0.85);
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
            transition: 0.3s ease;
        }

        .nav-links a:hover {
            color: darkgreen;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #ccc;
            text-align: center;
            padding: 30px 10px;
            margin-top: 100px;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
            margin: 0 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('reuse.navbar')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('reuse.footer')

</body>
</html>
