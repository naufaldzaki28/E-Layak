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

<body class="font-sans antialiased bg-gray-100 flex flex-col md:flex-row">

    @include('sidebarmhs')

    <main class="flex-1 flex flex-col overflow-hidden bg-gray-50 lg:ml-[260px] transition-all duration-300">

        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-6 z-20 relative">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Dashboard Mahasiswa</h2>

            <div class="flex items-center gap-4">
                <div class="relative ml-4" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 md:gap-3 focus:outline-none transition">
                        <div class="text-right hidden sm:block">
                            <div class="text-xs font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                        </div>
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
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

        <div class="flex-1 overflow-y-auto p-4 md:p-8">

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 shadow-sm rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0"><i class="fas fa-check-circle text-green-500"></i></div>
                        <div class="ml-3">
                            <p class="text-xs md:text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div
                class="bg-white rounded-2xl p-6 md:p-8 mb-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                <div class="relative z-10 mb-6 md:mb-0 text-center md:text-left">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">Halo, {{ Auth::user()->name }}!
                        👋</h1>
                    <p class="text-sm md:text-lg text-gray-500 mb-6">Apa yang ingin Anda lakukan hari ini?</p>
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-3">
                        <a href="{{ url('/mahasiswa/aduan') }}"
                            class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-md flex items-center justify-center gap-2 text-sm">
                            <i class="fas fa-plus-circle"></i> Buat Aduan Baru
                        </a>
                        <a href="{{ url('/mahasiswa/layanan') }}"
                            class="bg-white text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition border border-gray-200 shadow-sm flex items-center justify-center gap-2 text-sm">
                            <i class="fas fa-hand-holding-heart"></i> Ajukan Layanan
                        </a>
                    </div>
                </div>
                <img src="{{ asset('img/gambar.png') }}" alt="Ilustrasi"
                    class="w-32 md:w-48 lg:w-56 h-auto opacity-90 md:opacity-100">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div
                    class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 transition hover:shadow-md">
                    <div class="p-3 bg-red-100 text-red-600 rounded-full"><i
                            class="fas fa-bullhorn text-xl md:text-2xl"></i></div>
                    <div>
                        <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase">Total Aduan</p>
                        <h4 class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalAduan }}</h4>
                    </div>
                </div>
                <div
                    class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 transition hover:shadow-md">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-full"><i
                            class="fas fa-hand-holding text-xl md:text-2xl"></i></div>
                    <div>
                        <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase">Total Layanan</p>
                        <h4 class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalLayanan }}</h4>
                    </div>
                </div>
                <div
                    class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 transition hover:shadow-md">
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full"><i
                            class="fas fa-spinner text-xl md:text-2xl"></i></div>
                    <div>
                        <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase">Diproses</p>
                        <h4 class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalProses }}</h4>
                    </div>
                </div>
                <div
                    class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 transition hover:shadow-md">
                    <div class="p-3 bg-green-100 text-green-600 rounded-full"><i
                            class="fas fa-check-circle text-xl md:text-2xl"></i></div>
                    <div>
                        <p class="text-[10px] md:text-xs text-gray-500 font-medium uppercase">Selesai</p>
                        <h4 class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalSelesai }}</h4>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 md:p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-base md:text-lg font-bold text-gray-800">Aktivitas Terkini</h3>
                    <a href="{{ url('/mahasiswa/riwayat') }}"
                        class="text-blue-600 text-xs md:text-sm font-medium hover:underline">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($riwayatTerkini as $item)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition gap-3">
                            <div class="flex items-center gap-3 md:gap-4 min-w-0">
                                <div
                                    class="p-2 md:p-3 rounded-lg flex-shrink-0 {{ $item->type == 'Aduan' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }}">
                                    <i
                                        class="fas {{ $item->type == 'Aduan' ? 'fa-bullhorn' : 'fa-hand-holding' }} text-sm md:text-base"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 truncate"
                                        title="{{ $item->judul }}">{{ $item->judul }}</h4>
                                    <p class="text-[10px] md:text-xs text-gray-500 truncate">{{ $item->type }} •
                                        {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                @php
                                    $status = strtolower($item->status);
                                    $color = match ($status) {
                                        'menunggu', 'diajukan' => 'yellow',
                                        'diproses' => 'blue',
                                        'selesai', 'disetujui' => 'green',
                                        'ditolak' => 'red',
                                        default => 'gray',
                                    };
                                @endphp
                                <span
                                    class="px-2 md:px-3 py-1 rounded-full text-[10px] font-bold capitalize bg-{{ $color }}-100 text-{{ $color }}-700 border border-{{ $color }}-200">
                                    {{ $status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500 text-sm italic">Belum ada aktivitas terkini.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>
</body>

</html>
