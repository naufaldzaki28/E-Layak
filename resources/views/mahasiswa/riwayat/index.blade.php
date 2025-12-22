<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 flex flex-col md:flex-row">

    @include('sidebarmhs')

    <div class="flex-1 p-4 md:p-10 overflow-y-auto h-screen lg:ml-[260px] transition-all duration-300"
        x-data="{ search: '' }">

        <div class="h-10 md:hidden"></div>

        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 md:mb-8 flex items-center gap-3">
                <i class="fas fa-history text-blue-600"></i> Riwayat Pengajuan Saya
            </h1>

            <div class="mb-6">
                <div class="relative max-w-md">
                    <input type="text" x-model="search"
                        class="w-full pl-10 pr-4 py-2 md:py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm transition-all shadow-sm"
                        placeholder="Cari judul, kategori, atau status...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-[10px] md:text-xs font-semibold">
                            <tr>
                                <th class="p-4 border-b">Tipe</th>
                                <th class="p-4 border-b">Judul / Layanan</th>
                                <th class="p-4 border-b">Tanggal</th>
                                <th class="p-4 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($dataRiwayat as $item)
                                <tr class="hover:bg-gray-50 transition"
                                    x-show="!search ||
                                            '{{ strtolower($item->judul) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($item->status) }}'.includes(search.toLowerCase()) ||
                                            '{{ strtolower($item->jenis) }}'.includes(search.toLowerCase())">
                                    <td class="p-4">
                                        @if ($item->jenis == 'Aduan')
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] md:text-xs font-bold bg-red-50 text-red-600 border border-red-100">
                                                <i class="fas fa-bullhorn"></i> Aduan
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] md:text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                                <i class="fas fa-hand-holding"></i> Layanan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <p class="text-sm md:text-base font-semibold text-gray-800 truncate max-w-[200px] md:max-w-xs"
                                            title="{{ $item->judul }}">
                                            {{ $item->judul }}
                                        </p>
                                        <p
                                            class="text-[10px] md:text-xs text-gray-500 truncate max-w-[200px] md:max-w-xs">
                                            {{ $item->jenis == 'Aduan' ? Str::limit($item->deskripsi, 50) : Str::limit($item->keterangan, 50) }}
                                        </p>
                                    </td>

                                    <td class="p-4 text-xs md:text-sm text-gray-600">
                                        <div class="whitespace-nowrap"><i class="far fa-calendar-alt mr-1"></i>
                                            {{ $item->created_at->format('d M Y') }}</div>
                                        <div class="text-[10px] text-gray-400">{{ $item->created_at->format('H:i') }}
                                            WIB</div>
                                    </td>

                                    <td class="p-4">
                                        @php
                                            $status = strtolower($item->status);
                                            $warna = match ($status) {
                                                'pending', 'diajukan', 'menunggu' => 'yellow',
                                                'diproses' => 'blue',
                                                'selesai', 'disetujui', 'success' => 'green',
                                                'ditolak' => 'red',
                                                default => 'gray',
                                            };
                                            $icon = match ($status) {
                                                'pending', 'diajukan', 'menunggu' => 'fa-clock',
                                                'diproses' => 'fa-spinner fa-spin',
                                                'selesai', 'disetujui', 'success' => 'fa-check-circle',
                                                'ditolak' => 'fa-times-circle',
                                                default => 'fa-circle',
                                            };
                                        @endphp

                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-medium capitalize bg-{{ $warna }}-100 text-{{ $warna }}-700 border border-{{ $warna }}-200 whitespace-nowrap">
                                            <i class="fas {{ $icon }}"></i> {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-10 text-center text-gray-500">
                                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png"
                                            alt="Kosong" class="w-32 mx-auto mb-4 opacity-50 text-center">
                                        <p class="text-sm md:text-base">Belum ada riwayat pengajuan apapun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="mt-4 text-center text-[10px] text-gray-400 md:hidden italic">
                <i class="fas fa-arrows-left-right mr-1"></i> Geser tabel ke samping untuk melihat detail
            </p>
        </div>
    </div>

</body>

</html>
