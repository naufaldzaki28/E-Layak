<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Aduan - E-Layak</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 flex flex-col md:flex-row min-h-screen">

    @include('sidebarmhs')

    <main class="flex-1 min-w-0 overflow-hidden bg-gray-50 lg:ml-[260px] transition-all duration-300">

        <header class="bg-white shadow-sm h-16 flex items-center px-4 md:px-6 z-20 relative">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">Buat Aduan</h2>
        </header>

        <div class="p-4 md:p-8">

            <div
                class="bg-white rounded-2xl p-6 md:p-10 mb-8 shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>

                <div class="relative z-10">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">📝 Buat Aduan Baru</h1>
                    <p class="text-gray-500 text-sm md:text-base mb-8">Sampaikan keluhan atau laporan fasilitas kampus
                        Anda di sini.</p>

                    <form action="{{ route('mahasiswa.aduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Judul
                                Laporan</label>
                            <input type="text" name="judul"
                                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition text-sm shadow-sm"
                                placeholder="Contoh: AC Rusak di Ruang Lab Informatika" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Kategori</label>
                                <select name="kategori"
                                    class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm appearance-none shadow-sm cursor-pointer">
                                    <option value="Fasilitas Kelas">Fasilitas Kelas</option>
                                    <option value="Kamar Mandi">Kamar Mandi</option>
                                    <option value="Kebersihan">Kebersihan</option>
                                    <option value="Keamanan">Keamanan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Lokasi
                                    Kejadian</label>
                                <input type="text" name="lokasi"
                                    class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm shadow-sm"
                                    placeholder="Gedung A, Lantai 2" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Deskripsi
                                Masalah</label>
                            <textarea name="deskripsi" rows="5"
                                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none text-sm resize-none transition shadow-sm"
                                placeholder="Jelaskan detail kerusakannya secara lengkap..." required></textarea>
                        </div>

                        <div class="mb-8">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Bukti
                                Foto</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-200 border-dashed rounded-2xl hover:border-blue-400 transition cursor-pointer bg-gray-50 group">
                                <div class="space-y-2 text-center">
                                    <i
                                        class="fas fa-camera-retro text-4xl text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload"
                                            class="relative cursor-pointer font-bold text-blue-600 hover:text-blue-500">
                                            <span>Klik untuk pilih gambar</span>
                                            <input id="file-upload" name="bukti_foto" type="file" class="sr-only"
                                                required onchange="updateFileName(this)">
                                        </label>
                                    </div>
                                    <p id="file-name" class="text-xs text-gray-400">JPG atau PNG (Maks 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-10">
                            <button type="submit"
                                class="w-full md:w-auto bg-[#1E1E1E] text-white font-bold px-10 py-4 rounded-xl hover:bg-gray-800 transition active:scale-95 shadow-lg shadow-gray-400/20 text-sm flex items-center justify-center gap-2">
                                <i class="fas fa-paper-plane"></i> Kirim Aduan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function updateFileName(input) {
            if (input.files && input.files.length > 0) {
                const fileName = input.files[0].name;
                document.getElementById('file-name').textContent = "File terpilih: " + fileName;
                document.getElementById('file-name').classList.remove('text-gray-400');
                document.getElementById('file-name').classList.add('text-blue-600', 'font-bold');
            }
        }
    </script>
</body>

</html>
