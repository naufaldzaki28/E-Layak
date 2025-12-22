<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard Admin - E-Layak</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        @include('sidebar')

        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50 lg:ml-[260px] transition-all duration-300">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-6 z-20 relative">
                <div class="flex items-center gap-4">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Dashboard Admin</h2>
                </div>

                <div class="flex items-center gap-2 md:gap-4">
                    <button class="text-gray-400 hover:text-gray-600 transition relative p-2">
                        <span class="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </button>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none transition">
                            <div class="text-right hidden sm:block">
                                <div class="text-xs font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                            </div>
                            <div
                                class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white shadow-sm overflow-hidden ring-2 ring-transparent hover:ring-blue-200 transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff"
                                    alt="Admin" class="w-full h-full object-cover">
                            </div>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50"
                            style="display: none;">
                            <a href="{{ url('/admin/pengaturan') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Pengaturan
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">

                <div
                    class="bg-white rounded-2xl p-6 md:p-10 mb-8 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                    <div class="relative z-10 max-w-2xl">
                        <div class="flex justify-center mb-4 md:mb-6">
                            <div class="p-3 md:p-4 bg-blue-50 rounded-full">
                                <svg class="w-12 h-12 md:w-16 md:h-16 text-blue-600" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <h1 class="text-xl md:text-3xl font-extrabold text-gray-900 mb-2 truncate">Selamat Datang,
                            {{ Auth::user()->name }}!</h1>
                        <p class="text-sm md:text-lg text-gray-500 mb-6 md:mb-8">Sistem Elektronik Layanan dan Aduan
                            Kampus siap digunakan.</p>
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <a href="{{ url('/admin/aduan') }}"
                                class="w-full sm:w-auto bg-gray-100 text-gray-700 px-6 md:px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 transition border border-gray-200">Lihat
                                Aduan</a>
                            <a href="{{ url('/admin/layanan') }}"
                                class="w-full sm:w-auto bg-[#1E1E1E] text-white px-6 md:px-8 py-3 rounded-xl font-semibold hover:bg-gray-800 transition">Lihat
                                Fasilitas</a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6 px-1">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800">Permintaan Fasilitas Terbaru</h3>
                    <a href="{{ url('/admin/layanan') }}"
                        class="text-blue-600 text-xs md:text-sm font-medium hover:underline">Lihat Semua</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm"
                        role="alert">
                        <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    @forelse($permintaan_terbaru as $item)
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                            <div class="h-40 md:h-48 overflow-hidden bg-gray-200">
                                <img src="{{ asset('img/surat.png') }}" alt="Fasilitas"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>

                            <div class="p-4 md:p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-base md:text-lg text-gray-800 line-clamp-1 flex-1 mr-2"
                                        title="{{ $item->kebutuhan }}">
                                        {{ $item->kebutuhan }}
                                    </h4>
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-[10px] md:text-xs px-2 py-1 rounded-full font-medium capitalize flex-shrink-0">
                                        {{ $item->status }}
                                    </span>
                                </div>

                                <p class="text-[10px] md:text-xs text-gray-500 mb-2 flex items-center gap-1 truncate">
                                    <i class="fas fa-user-circle"></i> {{ $item->user->email ?? 'User Terhapus' }}
                                </p>

                                <p class="text-[10px] md:text-xs text-gray-400 mb-4">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </p>

                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <form action="{{ route('layanan.update', $item->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="w-full border border-red-500 text-red-500 py-2 rounded-lg text-xs font-medium hover:bg-red-50"
                                            onclick="return confirm('Tolak permintaan?')">Tolak</button>
                                    </form>

                                    <form action="{{ route('layanan.update', $item->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit"
                                            class="w-full bg-green-600 text-white py-2 rounded-lg text-xs font-medium hover:bg-green-700 shadow-sm"
                                            onclick="return confirm('Setujui permintaan?')">Terima</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <h3 class="text-sm font-medium text-gray-900">Belum ada permintaan</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>
