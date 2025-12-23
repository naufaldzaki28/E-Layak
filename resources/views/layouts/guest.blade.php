<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}"type="application/manifest+json">
    <meta name="theme-color" content="#2563EB">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            color: #EBEAEA;
            font-family: 'Inter', sans-serif;
        }

        #divKonten {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('img/logonavbar.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

        }

        .navbar {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            padding: 20px 40px;
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            z-index: 10;
            box-sizing: border-box;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        }

        .nav-link {
            text-decoration: none;
            color: #EBEAEA;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #1f2937;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased relative">

    <div class="navbar">
        <a href="{{ route('login') }}" class="nav-link">Masuk</a>
        <a href="{{ route('register') }}" class="nav-link">Daftar</a>
    </div>

    <div id="divKonten" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/80 backdrop-blur-sm shadow-md overflow-hidden sm:rounded-lg border border-gray-200 relative z-20">
            {{ $slot }}
        </div>
    </div>

    <?= view('footer') ?>
    <script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function() {
                navigator.serviceWorker
                    .register("{{ asset('sw.js') }}")
                    .then(function(registration) {
                        console.log("ServiceWorker registration successful");
                    })
                    .catch(function(err) {
                        console.log("ServiceWorker registration failed: ", err);
                    });
            });
        }
    </script>

</body>

</html>
