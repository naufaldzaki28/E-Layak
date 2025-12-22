<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Layanan - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex">

    @include('sidebarmhs')

    <div class="flex-1 p-10 overflow-y-auto h-screen ml-[260px]">

        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-file-signature text-blue-600"></i> Ajukan Layanan Akademik
            </h1>

            <form action="{{ route('mahasiswa.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Jenis Layanan</label>
                        <select name="jenis_layanan"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 outline-none">
                            <option value="Surat Keterangan Aktif">Surat Keterangan Aktif Kuliah</option>
                            <option value="Transkrip Nilai Sementara">Transkrip Nilai Sementara</option>
                            <option value="Surat Pengantar Magang">Surat Pengantar Magang</option>
                            <option value="Cuti Akademik">Pengajuan Cuti Akademik</option>
                            <option value="Legalisir Ijazah">Legalisir Ijazah/Dokumen</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Diperlukan Tanggal</label>
                        <input type="date" name="tanggal_butuh"
                            class="w-full p-3 border border-gray-300 rounded-lg outline-none" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Keperluan / Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="3" class="w-full p-3 border border-gray-300 rounded-lg outline-none"
                        placeholder="Contoh: Untuk keperluan tunjangan gaji orang tua..." required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Dokumen Pendukung (Opsional)</label>
                    <p class="text-xs text-gray-500 mb-2">Upload KTM atau dokumen lain jika diperlukan (PDF/Gambar).</p>
                    <input type="file" name="dokumen_pendukung"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md flex justify-center items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                </button>
            </form>
        </div>
    </div>

</body>

</html>
