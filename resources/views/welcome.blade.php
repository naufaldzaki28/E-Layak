<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Layak Kampus</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .hero-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('img/logonavbar.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #EBEAEA;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #EBEAEA;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            /* Bayangan lebih kuat */
        }

        .hero-section p.subtitle {
            color: #f3f4f6;
            font-size: 1.1rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }


        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        p.subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-bottom: 40px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-masuk {
            background-color: #EBEAEA;
            color: #1f2937;
            border: 1px solid #d1d5db;
        }

        .btn-masuk:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-daftar {
            background-color: #111827;
            color: #EBEAEA;
            border: 1px solid #111827;
        }

        .btn-daftar:hover {
            background-color: #374151;
        }
    </style>
</head>

<body>


    <div class="hero-section">

        <h1>Selamat Datang!</h1>
        <p class="subtitle">Sistem Elektronik Layanan dan Aduan Fasilitas Kampus</p>

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-masuk">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-daftar">Daftar</a>
        </div>

    </div>

    <?= view('footer') ?>

</body>

</html>
