<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard Mahasiswa - E-Layak</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <?= view('sidebarmhs') ?>


        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-20 relative">
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Dashboard Mahasiswa</h2>

                <div class="flex items-center gap-4">
                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none transition">
                            <div class="text-right hidden md:block">
                                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                            </div>
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white shadow-sm overflow-hidden ring-2 ring-transparent hover:ring-blue-200 transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff"
                                    class="w-full h-full object-cover">
                            </div>
                        </button>
                        <div x-show="open" @click.outside="open = false" style="display: none;"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">

                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 shadow-sm rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700 font-medium">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div
                    class="bg-white rounded-2xl p-8 mb-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                    <div class="relative z-10 mb-6 md:mb-0 md:mr-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-gray-500 text-lg mb-6">Selamat datang di E-Layak. Apa yang ingin Anda lakukan
                            hari ini?</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ url('/mahasiswa/aduan') }}"
                                class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                                <i class="fas fa-plus-circle"></i> Buat Aduan Baru
                            </a>
                            <a href="{{ url('/mahasiswa/layanan') }}"
                                class="bg-white text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition border border-gray-200 shadow-sm flex items-center gap-2">
                                <i class="fas fa-hand-holding-heart"></i> Ajukan Layanan
                            </a>
                        </div>
                    </div>
                    <img src="{{ asset('img/gambar.png') }}" alt="Ilustrasi Mahasiswa"
                        style="width: 200px; height: auto;">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="p-3 bg-red-100 text-red-600 rounded-full">
                            <i class="fas fa-bullhorn text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Aduan Saya</p>
                            <h4 class="text-3xl font-bold text-gray-900">{{ $totalAduan }}</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                            <i class="fas fa-hand-holding text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Layanan Saya</p>
                            <h4 class="text-3xl font-bold text-gray-900">{{ $totalLayanan }}</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                            <i class="fas fa-spinner text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Sedang Diproses</p>
                            <h4 class="text-3xl font-bold text-gray-900">{{ $totalProses }}</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="p-3 bg-green-100 text-green-600 rounded-full">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Selesai / Disetujui</p>
                            <h4 class="text-3xl font-bold text-gray-900">{{ $totalSelesai }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Aktivitas Terkini Saya</h3>
                        <a href="#" class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($riwayatTerkini as $item)
                            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="p-2 rounded-lg {{ $item->type == 'Aduan' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                        <i
                                            class="fas {{ $item->type == 'Aduan' ? 'fa-bullhorn' : 'fa-hand-holding' }}"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 line-clamp-1">{{ $item->judul }}</h4>
                                        <p class="text-xs text-gray-500">
                                            {{ $item->type }} • {{ $item->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $status = $item->status;
                                        $color = 'gray';
                                        if (in_array($status, ['menunggu', 'diajukan'])) {
                                            $color = 'yellow';
                                        } elseif (in_array($status, ['diproses'])) {
                                            $color = 'blue';
                                        } elseif (in_array($status, ['selesai', 'disetujui'])) {
                                            $color = 'green';
                                        } elseif (in_array($status, ['ditolak'])) {
                                            $color = 'red';
                                        }
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium capitalize bg-{{ $color }}-100 text-{{ $color }}-800">
                                        {{ $status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                Belum ada aktivitas terkini.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
