<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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

        <main class="flex-1 flex flex-col overflow-hidden bg-gray-50">

            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-20 relative">
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Pengaturan Akun</h2>
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

            <div class="flex-1 overflow-y-auto p-8" x-data="{ activeTab: 'profil' }">

                <div class="max-w-5xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pengaturan</h1>

                    @if (session('success'))
                        <div
                            class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                        <div class="md:col-span-1 space-y-1">
                            <button @click="activeTab = 'profil'"
                                :class="activeTab === 'profil' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left">
                                <i class="fas fa-user-circle w-5"></i> Profil Saya
                            </button>
                            <button @click="activeTab = 'keamanan'"
                                :class="activeTab === 'keamanan' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left">
                                <i class="fas fa-lock w-5"></i> Keamanan
                            </button>
                            <button @click="activeTab = 'notifikasi'"
                                :class="activeTab === 'notifikasi' ? 'bg-blue-50 text-blue-700 font-semibold' :
                                    'text-gray-600 hover:bg-gray-100'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition text-left">
                                <i class="fas fa-bell w-5"></i> Notifikasi
                            </button>
                        </div>

                        <div class="md:col-span-3">

                            <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-show="activeTab === 'profil'" class="space-y-6" style="display: none;">
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                                        <div class="mb-6 border-b border-gray-100 pb-4">
                                            <h3 class="text-lg font-bold text-gray-800">Profil Saya</h3>
                                            <p class="text-sm text-gray-500">Kelola informasi profil pribadi Anda.</p>
                                        </div>

                                        <div
                                            class="flex items-center gap-6 mb-8 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff&size=128"
                                                class="w-20 h-20 rounded-full border-4 border-white shadow-sm">
                                            <div>
                                                <h4 class="font-semibold text-gray-800 text-sm">Foto Profil</h4>
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button"
                                                        class="px-3 py-1.5 bg-white border border-gray-300 text-gray-400 text-xs font-medium rounded cursor-not-allowed">Upload</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama
                                                    Lengkap</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <input type="email" value="{{ Auth::user()->email }}" disabled
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP
                                                    (Opsional)</label>
                                                <input type="text" name="no_hp" placeholder="08..."
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none">
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="submit"
                                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Simpan
                                                Profil</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="activeTab === 'keamanan'" style="display: none;">
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                                        <div class="mb-6 border-b border-gray-100 pb-4">
                                            <h3 class="text-lg font-bold text-gray-800">Keamanan</h3>
                                            <p class="text-sm text-gray-500">Perbarui kata sandi akun Anda demi
                                                keamanan.</p>
                                        </div>

                                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Password
                                                    Baru</label>
                                                <input type="password" name="password"
                                                    placeholder="Minimal 8 karakter"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Ulangi
                                                    Password Baru</label>
                                                <input type="password" name="password_confirmation"
                                                    placeholder="Ketik ulang password"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none">
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="submit"
                                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-gray-800 font-medium">Update
                                                Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div x-show="activeTab === 'notifikasi'" style="display: none;">
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                                    <div class="mb-6 border-b border-gray-100 pb-4">
                                        <h3 class="text-lg font-bold text-gray-800">Preferensi Notifikasi</h3>
                                        <p class="text-sm text-gray-500">Atur notifikasi apa saja yang ingin Anda
                                            terima.</p>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div>
                                                <h4 class="text-sm font-semibold text-gray-800">Email Aduan Baru</h4>
                                                <p class="text-xs text-gray-500">Terima email saat ada mahasiswa
                                                    melapor.</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" checked class="sr-only peer">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div>
                                                <h4 class="text-sm font-semibold text-gray-800">Email Pelayanan</h4>
                                                <p class="text-xs text-gray-500">Terima email saat ada pengajuan
                                                    fasilitas.</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" class="sr-only peer">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-6 text-right">
                                        <span class="text-xs text-gray-400 italic">*Fitur notifikasi ini hanya tampilan
                                            (demo).</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
