<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Aduan - E-Layak</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="flex">

    @include('sidebarmhs')

    <div class="flex-1 p-10 ml-[260px]">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">📝 Buat Aduan Baru</h1>

            <form action="{{ route('mahasiswa.aduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul Laporan</label>
                    <input type="text" name="judul"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Contoh: AC Rusak di Lab 1" required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="kategori"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 outline-none">
                            <option value="Fasilitas Kelas">Fasilitas Kelas</option>
                            <option value="Kamar Mandi">Kamar Mandi</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Lokasi Kejadian</label>
                        <input type="text" name="lokasi"
                            class="w-full p-3 border border-gray-300 rounded-lg outline-none"
                            placeholder="Gedung A, Lantai 2" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi Masalah</label>
                    <textarea name="deskripsi" rows="4" class="w-full p-3 border border-gray-300 rounded-lg outline-none"
                        placeholder="Jelaskan detail kerusakannya..." required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Bukti Foto</label>
                    <input type="file" name="bukti_foto"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Kirim Aduan
                </button>
            </form>
        </div>
    </div>

</body>

</html>
