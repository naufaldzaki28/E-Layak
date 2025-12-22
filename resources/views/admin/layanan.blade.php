<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Kelola Layanan Kampus - Admin</title>

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
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Kelola Pelayanan Kampus
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
                            placeholder="Cari berdasarkan nama mahasiswa atau jenis layanan...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="max-w-5xl mx-auto space-y-4">

                    @forelse($layanan as $item)
                        <div x-show="!search ||
                                    '{{ strtolower($item->jenis_layanan) }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($item->user->name ?? '') }}'.includes(search.toLowerCase()) ||
                                    '{{ strtolower($item->user->email ?? '') }}'.includes(search.toLowerCase())"
                            class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-5 flex flex-col md:flex-row gap-4 md:gap-6 items-start hover:shadow-md transition">

                            <div
                                class="w-full md:w-40 h-32 flex-shrink-0 bg-blue-50 rounded-lg overflow-hidden border border-blue-100 flex items-center justify-center text-blue-300">
                                @if (Str::contains($item->jenis_layanan, 'Surat'))
                                    <i class="fas fa-envelope-open-text text-4xl md:text-5xl"></i>
                                @elseif (Str::contains($item->jenis_layanan, 'Cuti'))
                                    <i class="fas fa-user-clock text-4xl md:text-5xl"></i>
                                @elseif (Str::contains($item->jenis_layanan, 'Transkrip') || Str::contains($item->jenis_layanan, 'Nilai'))
                                    <i class="fas fa-graduation-cap text-4xl md:text-5xl"></i>
                                @else
                                    <i class="fas fa-file-signature text-4xl md:text-5xl"></i>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0 w-full">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <h3 class="text-base md:text-lg font-bold text-gray-900 truncate">
                                        {{ $item->jenis_layanan }}</h3>

                                    @if ($item->status == 'diajukan')
                                        <span
                                            class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">Menunggu</span>
                                    @elseif($item->status == 'disetujui')
                                        <span
                                            class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-green-100 text-green-800 border border-green-200">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                        <span
                                            class="px-2 py-0.5 rounded text-[10px] md:text-xs font-bold bg-red-100 text-red-800 border border-red-200">Ditolak</span>
                                    @endif
                                </div>

                                <p class="text-xs md:text-sm text-gray-600 font-medium mb-1 truncate">
                                    <i class="fas fa-user mr-1"></i> {{ $item->user->name ?? 'Mahasiswa' }}
                                    <span
                                        class="text-gray-400 hidden sm:inline">({{ $item->user->email ?? '-' }})</span>
                                </p>

                                @if ($item->tanggal_butuh)
                                    <p class="text-xs md:text-sm text-red-500 font-medium mb-2">
                                        <i class="far fa-calendar-check mr-1"></i> Dibutuhkan:
                                        {{ \Carbon\Carbon::parse($item->tanggal_butuh)->format('d M Y') }}
                                    </p>
                                @endif

                                <div
                                    class="text-xs md:text-sm text-gray-500 bg-gray-50 p-3 rounded-lg border border-gray-100 italic mb-3 line-clamp-3 md:line-clamp-none">
                                    "{{ $item->keterangan }}"
                                </div>

                                <div class="flex flex-wrap items-center gap-4">
                                    @if ($item->dokumen_pendukung)
                                        <a href="{{ asset('storage/' . $item->dokumen_pendukung) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-xs text-blue-600 hover:underline">
                                            <i class="fas fa-paperclip"></i> Dokumen Pendukung
                                        </a>
                                    @endif
                                    <p class="text-[10px] md:text-xs text-gray-400">Diajukan:
                                        {{ $item->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex flex-row md:flex-col gap-2 w-full md:w-auto min-w-[120px] mt-2 md:mt-0">
                                @if ($item->status == 'diajukan')
                                    <form action="{{ route('layanan.update', $item->id) }}" method="POST"
                                        class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-green-600 text-white text-xs font-semibold rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2"
                                            onclick="return confirm('Setujui pengajuan ini?')">
                                            <i class="fas fa-check"></i> <span>Setujui</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('layanan.update', $item->id) }}" method="POST"
                                        class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-white text-red-600 border border-red-200 text-xs font-semibold rounded-lg hover:bg-red-50 transition flex items-center justify-center gap-2"
                                            onclick="return confirm('Tolak pengajuan ini?')">
                                            <i class="fas fa-times"></i> <span>Tolak</span>
                                        </button>
                                    </form>
                                @else
                                    <button
                                        class="w-full px-4 py-2 bg-gray-100 text-gray-400 border border-gray-200 text-xs font-semibold rounded-lg cursor-not-allowed flex items-center justify-center gap-2"
                                        disabled>
                                        <i class="fas fa-lock"></i> Selesai
                                    </button>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">Belum ada pengajuan layanan masuk.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </main>
    </div>
</body>

</html>
