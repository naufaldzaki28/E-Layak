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

        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-20 relative">
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Laporan & Riwayat</h2>

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

                <div class="max-w-4xl mx-auto mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Laporan yang Telah Selesai</h3>
                    <p class="text-sm text-gray-500">Daftar riwayat aduan dan pelayanan yang sudah ditangani.</p>
                </div>

                <div class="max-w-4xl mx-auto space-y-4">

                    @forelse($laporan as $item)
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex flex-col md:flex-row items-center gap-5 hover:shadow-md transition">

                            <div
                                class="w-16 h-16 flex-shrink-0 bg-red-50 rounded-xl flex items-center justify-center border border-red-100">
                                <i class="fas fa-file-pdf text-3xl text-red-500"></i>
                            </div>

                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-800">
                                            {{ $item->judul ?? $item->kebutuhan }}
                                        </h4>
                                        <p class="text-sm text-gray-500 font-medium">
                                            {{ $item->user->email ?? 'User Terhapus' }}</p>
                                    </div>

                                    <div>
                                        @if ($item->status == 'selesai' || $item->status == 'disetujui')
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                Success
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                                Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2 flex items-center gap-4 text-xs text-gray-400">
                                    <span>
                                        <i class="far fa-calendar mr-1"></i>
                                        Diselesaikan: {{ $item->updated_at->format('d M Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ isset($item->judul) ? 'Aduan Fasilitas' : 'Pelayanan Kampus' }}
                                    </span>
                                </div>
                            </div>

                            <div class="w-full md:w-auto">
                                <button onclick="window.print()"
                                    class="w-full md:w-auto px-6 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition shadow-lg shadow-gray-200 flex items-center justify-center gap-2">
                                    <i class="fas fa-download"></i>
                                    Unduh
                                </button>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                            <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">Belum ada riwayat laporan yang selesai.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </main>
    </div>
</body>

</html>
