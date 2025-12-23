<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}"type="application/manifest+json">
    <meta name="theme-color" content="#2563EB">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 flex flex-col md:flex-row">

    @include('sidebarmhs')

    <div class="flex-1 p-4 md:p-10 overflow-y-auto h-screen lg:ml-[260px] transition-all duration-300">

        <div class="h-10 md:hidden"></div>

        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2 flex items-center gap-3">
                <i class="fas fa-life-ring text-blue-600"></i> Pusat Bantuan
            </h1>
            <p class="text-sm md:text-base text-gray-500 mb-8">Temukan jawaban atas masalahmu atau hubungi
                administrator.</p>

            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 md:p-8 text-white shadow-lg mb-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="text-center lg:text-left">
                    <h2 class="text-xl md:text-2xl font-bold mb-2">Masih Butuh Bantuan?</h2>
                    <p class="text-blue-100 text-sm md:text-base">
                        Jika kamu mengalami kendala teknis atau bingung cara menggunakan sistem,
                        silakan hubungi Admin Utama melalui email.
                    </p>
                </div>
                <div class="flex flex-col items-center gap-3 w-full lg:w-auto">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=dnaufal283@gmail.com" target="_blank"
                        class="w-full lg:w-auto bg-white text-blue-700 font-bold py-3 px-6 rounded-xl md:rounded-full shadow-md hover:bg-gray-50 transition transform active:scale-95 flex items-center justify-center gap-2">
                        <i class="fas fa-envelope"></i> Hubungi via Gmail
                    </a>
                    <span class="text-[10px] md:text-xs text-blue-200 opacity-80">Klik untuk membuka Gmail</span>
                </div>
            </div>

            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">Pertanyaan Sering Diajukan (FAQ)</h3>

            <div class="space-y-3">

                <div x-data="{ open: false }"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button @click="open = !open"
                        class="w-full text-left p-4 md:p-5 flex justify-between items-center bg-white hover:bg-gray-50 transition">
                        <span class="text-sm md:text-base font-semibold text-gray-700">Bagaimana cara melihat status
                            aduan saya?</span>
                        <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas text-gray-400 text-xs"></i>
                    </button>
                    <div x-show="open" x-transition
                        class="p-4 md:p-5 border-t border-gray-100 text-xs md:text-sm text-gray-600 bg-gray-50">
                        Kamu bisa melihat status terkini di menu <b>Riwayat Pengajuan</b> atau langsung di Dashboard
                        utama pada bagian aktivitas terkini.
                    </div>
                </div>

                <div x-data="{ open: false }"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button @click="open = !open"
                        class="w-full text-left p-4 md:p-5 flex justify-between items-center bg-white hover:bg-gray-50 transition">
                        <span class="text-sm md:text-base font-semibold text-gray-700">Berapa lama proses persetujuan
                            layanan?</span>
                        <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas text-gray-400 text-xs"></i>
                    </button>
                    <div x-show="open" x-transition
                        class="p-4 md:p-5 border-t border-gray-100 text-xs md:text-sm text-gray-600 bg-gray-50">
                        Biasanya memakan waktu 1-3 hari kerja. Pastikan dokumen pendukung yang kamu upload sudah jelas
                        agar tidak ditolak.
                    </div>
                </div>

                <div x-data="{ open: false }"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <button @click="open = !open"
                        class="w-full text-left p-4 md:p-5 flex justify-between items-center bg-white hover:bg-gray-50 transition">
                        <span class="text-sm md:text-base font-semibold text-gray-700">Apakah saya bisa membatalkan
                            aduan?</span>
                        <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas text-gray-400 text-xs"></i>
                    </button>
                    <div x-show="open" x-transition
                        class="p-4 md:p-5 border-t border-gray-100 text-xs md:text-sm text-gray-600 bg-gray-50">
                        Saat ini fitur pembatalan belum tersedia. Jika ada kesalahan data, silakan hubungi admin melalui
                        kontak di atas secepatnya.
                    </div>
                </div>

            </div>
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
