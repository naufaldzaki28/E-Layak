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
            /* Padding lebih kecil di mobile agar teks tidak terlalu 'tercekik' */
            padding: 80px 20px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('img/logonavbar.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #EBEAEA;
        }

        /* Responsive Font Size untuk Judul */
        .hero-section h1 {
            font-size: 2rem;
            /* Ukuran HP */
            font-weight: 700;
            color: #EBEAEA;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            line-height: 1.2;
        }

        /* Ukuran judul untuk Laptop */
        @media (min-width: 768px) {
            .hero-section h1 {
                font-size: 3.5rem;
            }
        }

        .hero-section p.subtitle {
            color: #f3f4f6;
            font-size: 1rem;
            margin-bottom: 35px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
            max-width: 600px;
        }

        /* Container Tombol */
        .btn-group {
            display: flex;
            flex-direction: column;
            /* Default HP: Tombol menumpuk */
            gap: 15px;
            width: 100%;
            max-width: 300px;
        }

        /* Tombol sejajar di Laptop */
        @media (min-width: 640px) {
            .btn-group {
                flex-direction: row;
                max-width: none;
                justify-content: center;
            }
        }

        .btn {
            padding: 14px 35px;
            border-radius: 12px;
            /* Lebih bulat agar modern */
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            text-align: center;
        }

        .btn-masuk {
            background-color: #EBEAEA;
            color: #1f2937;
            border: 1px solid #d1d5db;
        }

        .btn-masuk:hover {
            background-color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-daftar {
            background-color: #111827;
            color: #EBEAEA;
            border: 1px solid #111827;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-daftar:hover {
            background-color: #374151;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="hero-section">
        <h1>Selamat Datang!</h1>
        <p class="subtitle">Sistem Elektronik Layanan dan Aduan Fasilitas Kampus (E-Layak)</p>

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-masuk">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </a>
            <a href="{{ route('register') }}" class="btn btn-daftar">
                <i class="fas fa-user-plus mr-2"></i> Daftar
            </a>
        </div>
    </div>

    <?= view('footer') ?>

</body>

</html>
