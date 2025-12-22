<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Laporan - E-Layak</title>

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
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Laporan & Riwayat</h2>

                <div class="flex items-center gap-4">
                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none transition">
                            <div class="text-right hidden md:block">
                                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                            </div>
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
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

                <div class="mb-6 px-2 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">Laporan yang Telah Selesai</h3>
                        <p class="text-xs md:text-sm text-gray-500">Daftar riwayat aduan dan pelayanan yang sudah
                            ditangani secara sistem.</p>
                    </div>

                    <div class="relative w-full md:w-80">
                        <input type="text" x-model="search"
                            class="block w-full pl-4 pr-10 py-2 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                            placeholder="Cari email atau judul laporan...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">

                    @forelse($laporan as $item)
                        <div x-show="!search ||
                                    '{{ strtolower($item->judul ?? $item->kebutuhan) }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($item->user->email ?? '') }}'.includes(search.toLowerCase()) ||
                                    '{{ isset($item->judul) ? 'aduan' : 'pelayanan' }}'.includes(search.toLowerCase())"
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 flex flex-col md:flex-row items-center gap-4 md:gap-6 hover:shadow-md transition relative overflow-hidden">

                            <div
                                class="absolute left-0 top-0 h-full w-1 {{ $item->status == 'selesai' || $item->status == 'disetujui' ? 'bg-green-500' : 'bg-red-500' }}">
                            </div>

                            <div
                                class="w-14 h-14 md:w-16 md:h-16 flex-shrink-0 bg-red-50 rounded-xl flex items-center justify-center border border-red-100">
                                <i class="fas fa-file-pdf text-2xl md:text-3xl text-red-500"></i>
                            </div>

                            <div class="flex-1 w-full min-w-0">
                                <div class="flex justify-between items-start gap-2">
                                    <div class="min-w-0">
                                        <h4 class="text-base md:text-lg font-bold text-gray-800 truncate"
                                            title="{{ $item->judul ?? $item->kebutuhan }}">
                                            {{ $item->judul ?? $item->kebutuhan }}
                                        </h4>
                                        <p class="text-xs md:text-sm text-gray-500 font-medium truncate">
                                            {{ $item->user->email ?? 'User Terhapus' }}
                                        </p>
                                    </div>

                                    <div class="flex-shrink-0">
                                        @if ($item->status == 'selesai' || $item->status == 'disetujui')
                                            <span
                                                class="px-2 md:px-3 py-1 rounded-full text-[10px] md:text-xs font-bold bg-green-100 text-green-700">Success</span>
                                        @else
                                            <span
                                                class="px-2 md:px-3 py-1 rounded-full text-[10px] md:text-xs font-bold bg-red-100 text-red-700">Ditolak</span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="mt-2 flex flex-wrap items-center gap-3 text-[10px] md:text-xs text-gray-400">
                                    <span><i class="far fa-calendar mr-1"></i>
                                        {{ $item->updated_at->format('d M Y') }}</span>
                                    <span><i class="fas fa-tag mr-1"></i>
                                        {{ isset($item->judul) ? 'Aduan Fasilitas' : 'Pelayanan Kampus' }}</span>
                                </div>
                            </div>

                            <div class="w-full md:w-auto mt-2 md:mt-0">
                                @if ($item->status == 'selesai' || $item->status == 'disetujui')
                                    <a href="{{ route('admin.laporan.download', $item->id) }}"
                                        class="w-full md:w-auto px-6 py-2.5 bg-blue-600 text-white text-xs md:text-sm font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 flex items-center justify-center gap-2">
                                        <i class="fas fa-file-pdf"></i>
                                        Unduh PDF
                                    </a>
                                @else
                                    <button disabled
                                        class="w-full md:w-auto px-6 py-2.5 bg-gray-100 text-gray-400 text-xs md:text-sm font-semibold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                        <i class="fas fa-ban"></i>
                                        Unduh
                                    </button>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
                            <i class="fas fa-folder-open text-5xl text-gray-200 mb-4"></i>
                            <p class="text-gray-500 font-medium">Belum ada riwayat laporan yang selesai.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </main>
    </div>
</body>

</html>
