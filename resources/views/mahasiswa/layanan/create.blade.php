<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}"type="application/manifest+json">
    <meta name="theme-color" content="#2563EB">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Layanan - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col md:flex-row">

    @include('sidebarmhs')

    <div class="flex-1 p-4 md:p-10 overflow-y-auto h-screen lg:ml-[260px] transition-all duration-300">

        <div class="h-10 md:hidden"></div>

        <div class="max-w-4xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-file-signature text-blue-600"></i> Ajukan Layanan Akademik
            </h1>

            <form action="{{ route('mahasiswa.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                        <select name="jenis_layanan"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-white">
                            <option value="Surat Keterangan Aktif">Surat Keterangan Aktif Kuliah</option>
                            <option value="Transkrip Nilai Sementara">Transkrip Nilai Sementara</option>
                            <option value="Surat Pengantar Magang">Surat Pengantar Magang</option>
                            <option value="Cuti Akademik">Pengajuan Cuti Akademik</option>
                            <option value="Legalisir Ijazah">Legalisir Ijazah/Dokumen</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Diperlukan Tanggal</label>
                        <input type="date" name="tanggal_butuh"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keperluan / Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm resize-none"
                        placeholder="Contoh: Untuk keperluan tunjangan gaji orang tua..." required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Pendukung (Opsional)</label>
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mb-2">
                        <p class="text-xs text-blue-700">
                            <i class="fas fa-info-circle mr-1"></i> Upload KTM atau dokumen lain jika diperlukan
                            (PDF/Gambar).
                        </p>
                    </div>
                    <input type="file" name="dokumen_pendukung"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-colors cursor-pointer">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-3 md:py-4 rounded-xl hover:bg-blue-700 transition active:scale-95 shadow-lg shadow-blue-200 flex justify-center items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                </button>
            </form>
        </div>

        <div class="max-w-4xl mx-auto mt-6 px-2">
            <p class="text-center text-xs text-gray-400">
                Pastikan data yang Anda isi sudah benar sebelum menekan tombol kirim.
            </p>
        </div>
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
