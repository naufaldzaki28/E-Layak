<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}"type="application/manifest+json">
    <meta name="theme-color" content="#2563EB">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Kelola Aduan - Admin E-Layak</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        @include('sidebar')

        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50 lg:ml-[260px] transition-all duration-300"
            x-data="{ search: '' }">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-6 z-20 relative">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Kelola Aduan Fasilitas
                </h2>

                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 md:gap-3 focus:outline-none transition">
                            <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</div>
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

                <div class="max-w-5xl mx-auto mb-6 md:mb-8">
                    <div class="relative">
                        <input type="text" x-model="search"
                            class="block w-full pl-4 pr-10 py-2 md:py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                            placeholder="Cari aduan berdasarkan judul, lokasi, atau nama...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="max-w-5xl mx-auto space-y-4">

                    @forelse($aduan as $item)
                        <div x-show="!search ||
                                    '{{ strtolower($item->judul) }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($item->lokasi) }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($item->user->name ?? '') }}'.includes(search.toLowerCase())"
                            class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-5 flex flex-col md:flex-row gap-4 md:gap-6 items-start hover:shadow-md transition">

                            <div
                                class="w-full md:w-48 h-40 md:h-32 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 relative group">
                                @if ($item->bukti_foto)
                                    <img src="{{ asset('storage/' . $item->bukti_foto) }}"
                                        class="w-full h-full object-cover" alt="Bukti">
                                    <a href="{{ asset('storage/' . $item->bukti_foto) }}" target="_blank"
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition">
                                        <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100"></i>
                                    </a>
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0 w-full">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <h3 class="text-base md:text-lg font-bold text-gray-900 truncate">
                                        {{ $item->judul }}</h3>

                                    <div class="flex-shrink-0">
                                        @if ($item->status == 'pending')
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <i class="fas fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @elseif($item->status == 'diproses')
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                <i class="fas fa-tools mr-1"></i> Diproses
                                            </span>
                                        @elseif($item->status == 'selesai')
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                <i class="fas fa-check-circle mr-1"></i> Selesai
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span
                                                class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 mb-3">
                                    <span class="flex items-center gap-1"><i class="fas fa-user"></i>
                                        {{ $item->user->name ?? 'Mahasiswa' }}</span>
                                    <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt"></i>
                                        {{ $item->lokasi }}</span>
                                    <span class="flex items-center gap-1"><i class="far fa-calendar-alt"></i>
                                        {{ $item->created_at->format('d M Y') }}</span>
                                </div>

                                <p
                                    class="text-gray-600 text-xs md:text-sm bg-gray-50 p-3 rounded-lg border border-gray-100 line-clamp-3 md:line-clamp-none">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>

                            <div class="flex flex-row md:flex-col gap-2 w-full md:w-auto min-w-[140px] mt-2 md:mt-0">
                                @if ($item->status == 'pending')
                                    <form action="{{ route('admin.aduan.update', $item->id) }}" method="POST"
                                        class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="diproses">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                            <i class="fas fa-hammer"></i> <span>Proses</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.aduan.update', $item->id) }}" method="POST"
                                        class="flex-1" onsubmit="return confirm('Yakin ingin menolak laporan ini?')">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-white text-red-600 border border-red-200 text-xs font-semibold rounded-lg hover:bg-red-50 transition flex items-center justify-center gap-2">
                                            <i class="fas fa-ban"></i> <span>Tolak</span>
                                        </button>
                                    </form>
                                @elseif($item->status == 'diproses')
                                    <form action="{{ route('admin.aduan.update', $item->id) }}" method="POST"
                                        class="w-full"
                                        onsubmit="return confirm('Tandai laporan ini sebagai selesai?')">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-green-600 text-white text-xs font-semibold rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2">
                                            <i class="fas fa-check"></i> Selesai
                                        </button>
                                    </form>
                                @else
                                    <button
                                        class="w-full px-4 py-2 bg-gray-100 text-gray-400 border border-gray-200 text-xs font-semibold rounded-lg cursor-not-allowed flex items-center justify-center gap-2"
                                        disabled>
                                        <i class="fas fa-lock"></i> Terkunci
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">Belum ada aduan fasilitas yang masuk.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

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
