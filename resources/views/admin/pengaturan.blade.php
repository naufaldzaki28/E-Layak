<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}"type="application/manifest+json">
    <meta name="theme-color" content="#2563EB">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Pengaturan - E-Layak</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        @include('sidebar')

        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50 lg:ml-[260px] transition-all duration-300">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-6 z-20 relative">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight truncate">Pengaturan Akun</h2>
                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none transition">
                            <div class="text-right hidden md:block">
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

            <div class="flex-1 overflow-y-auto p-4 md:p-8" x-data="{ activeTab: 'profil' }">

                <div class="max-w-5xl mx-auto">

                    @if (session('success'))
                        <div
                            class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative text-sm">
                            <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                        <div
                            class="md:col-span-1 flex md:flex-col overflow-x-auto md:overflow-x-visible pb-2 md:pb-0 gap-1 md:gap-1 snap-x">
                            <button @click="activeTab = 'profil'"
                                :class="activeTab === 'profil' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="flex-shrink-0 md:w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left text-sm snap-start">
                                <i class="fas fa-user-circle w-5"></i> Profil
                            </button>
                            <button @click="activeTab = 'keamanan'"
                                :class="activeTab === 'keamanan' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="flex-shrink-0 md:w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left text-sm snap-start">
                                <i class="fas fa-lock w-5"></i> Keamanan
                            </button>
                            <button @click="activeTab = 'notifikasi'"
                                :class="activeTab === 'notifikasi' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="flex-shrink-0 md:w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left text-sm snap-start">
                                <i class="fas fa-bell w-5"></i> Notifikasi
                            </button>
                        </div>

                        <div class="md:col-span-3">
                            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-show="activeTab === 'profil'" x-transition class="space-y-6">
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 md:p-8">
                                        <div class="mb-6 border-b border-gray-100 pb-4">
                                            <h3 class="text-base md:text-lg font-bold text-gray-800">Profil Saya</h3>
                                            <p class="text-xs text-gray-500">Kelola informasi profil pribadi Anda.</p>
                                        </div>

                                        <div
                                            class="flex flex-col sm:flex-row items-center gap-6 mb-8 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff&size=128"
                                                class="w-16 h-16 md:w-20 md:h-20 rounded-full border-4 border-white shadow-sm">
                                            <div class="text-center sm:text-left">
                                                <h4 class="font-semibold text-gray-800 text-sm">Foto Profil</h4>
                                                <p class="text-[10px] text-gray-400 mb-2">Avatar otomatis berdasarkan
                                                    nama</p>
                                                <button type="button" disabled
                                                    class="px-3 py-1.5 bg-gray-200 text-gray-400 text-xs font-medium rounded cursor-not-allowed">Ganti
                                                    Foto</button>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 md:gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama
                                                    Lengkap</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none text-sm">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <input type="email" value="{{ Auth::user()->email }}" disabled
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP
                                                    (Opsional)</label>
                                                <input type="text" name="no_hp" placeholder="08..."
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none text-sm">
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-sm transition">
                                                Simpan Profil
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="activeTab === 'keamanan'" x-transition style="display: none;">
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 md:p-8">
                                        <div class="mb-6 border-b border-gray-100 pb-4">
                                            <h3 class="text-base md:text-lg font-bold text-gray-800">Keamanan</h3>
                                            <p class="text-xs text-gray-500">Perbarui kata sandi secara berkala.</p>
                                        </div>

                                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Password
                                                    Baru</label>
                                                <input type="password" name="password"
                                                    placeholder="Minimal 8 karakter"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Ulangi
                                                    Password</label>
                                                <input type="password" name="password_confirmation"
                                                    placeholder="Konfirmasi password"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none text-sm">
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-sm transition">
                                                Update Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div x-show="activeTab === 'notifikasi'" x-transition style="display: none;">
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 md:p-8">
                                    <div class="mb-6 border-b border-gray-100 pb-4">
                                        <h3 class="text-base md:text-lg font-bold text-gray-800">Preferensi Notifikasi
                                        </h3>
                                        <p class="text-xs text-gray-500">Atur notifikasi yang masuk ke email Anda.</p>
                                    </div>
                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                                            <div>
                                                <h4 class="text-xs md:text-sm font-semibold text-gray-800">Email Aduan
                                                    Baru</h4>
                                                <p class="text-[10px] text-gray-500">Notifikasi saat ada aduan masuk.
                                                </p>
                                            </div>
                                            <label
                                                class="relative inline-flex items-center cursor-pointer scale-90 md:scale-100">
                                                <input type="checkbox" checked class="sr-only peer">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                                                </div>
                                            </label>
                                        </div>
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                                            <div>
                                                <h4 class="text-xs md:text-sm font-semibold text-gray-800">Email
                                                    Pelayanan</h4>
                                                <p class="text-[10px] text-gray-500">Notifikasi saat ada pengajuan
                                                    baru.</p>
                                            </div>
                                            <label
                                                class="relative inline-flex items-center cursor-pointer scale-90 md:scale-100">
                                                <input type="checkbox" class="sr-only peer">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
