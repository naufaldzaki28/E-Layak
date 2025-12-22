<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex">

    @include('sidebarmhs')

    <div class="flex-1 p-10 overflow-y-auto h-screen ml-[260px]">

        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                <i class="fas fa-history text-blue-600"></i> Riwayat Pengajuan Saya
            </h1>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-sm font-semibold">
                        <tr>
                            <th class="p-4 border-b">Tipe</th>
                            <th class="p-4 border-b">Judul / Layanan</th>
                            <th class="p-4 border-b">Tanggal</th>
                            <th class="p-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($dataRiwayat as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    @if ($item->jenis == 'Aduan')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-100">
                                            <i class="fas fa-bullhorn"></i> Aduan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                            <i class="fas fa-hand-holding"></i> Layanan
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    <p class="font-semibold text-gray-800">{{ $item->judul }}</p>
                                    <p class="text-xs text-gray-500 truncate max-w-xs">
                                        {{ $item->jenis == 'Aduan' ? Str::limit($item->deskripsi, 50) : Str::limit($item->keterangan, 50) }}
                                    </p>
                                </td>

                                <td class="p-4 text-sm text-gray-600">
                                    <div><i class="far fa-calendar-alt mr-1"></i>
                                        {{ $item->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</div>
                                </td>

                                <td class="p-4">
                                    @php
                                        $status = $item->status;
                                        $warna = 'gray'; // Default
                                        $icon = 'fa-circle';

                                        if (in_array($status, ['pending', 'diajukan'])) {
                                            $warna = 'yellow';
                                            $icon = 'fa-clock';
                                        } elseif ($status == 'diproses') {
                                            $warna = 'blue';
                                            $icon = 'fa-spinner fa-spin';
                                        } elseif (in_array($status, ['selesai', 'disetujui'])) {
                                            $warna = 'green';
                                            $icon = 'fa-check-circle';
                                        } elseif ($status == 'ditolak') {
                                            $warna = 'red';
                                            $icon = 'fa-times-circle';
                                        }
                                    @endphp

                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium capitalize bg-{{ $warna }}-100 text-{{ $warna }}-700 border border-{{ $warna }}-200">
                                        <i class="fas {{ $icon }}"></i> {{ $status }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-500">
                                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png"
                                        alt="Kosong" class="w-32 mx-auto mb-4 opacity-50">
                                    <p>Belum ada riwayat pengajuan apapun.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
