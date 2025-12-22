<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - E-Layak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 flex">

    @include('sidebarmhs')

    <div class="flex-1 p-10 overflow-y-auto h-screen ml-[260px]">

        <div class="max-w-6xl mx-auto" x-data="{ activeTab: 'profil' }">

            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                <i class="fas fa-cog text-blue-600"></i> Pengaturan Akun
            </h1>

            <div class="flex flex-col md:flex-row gap-8">

                <div class="w-full md:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b border-gray-100 font-semibold text-gray-700">
                            Menu Pengaturan
                        </div>
                        <nav class="flex flex-col p-2">
                            <button @click="activeTab = 'profil'"
                                :class="activeTab === 'profil' ? 'bg-blue-50 text-blue-600 font-semibold' :
                                    'text-gray-600 hover:bg-gray-50'"
                                class="text-left px-4 py-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-user w-5 text-center"></i> Profil Saya
                            </button>

                            <button @click="activeTab = 'password'"
                                :class="activeTab === 'password' ? 'bg-blue-50 text-blue-600 font-semibold' :
                                    'text-gray-600 hover:bg-gray-50'"
                                class="text-left px-4 py-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-lock w-5 text-center"></i> Keamanan & Password
                            </button>

                            <button @click="activeTab = 'hapus'"
                                :class="activeTab === 'hapus' ? 'bg-red-50 text-red-600 font-semibold' :
                                    'text-red-500 hover:bg-red-50'"
                                class="text-left px-4 py-3 rounded-lg transition flex items-center gap-3">
                                <i class="fas fa-trash-alt w-5 text-center"></i> Hapus Akun
                            </button>
                        </nav>
                    </div>
                </div>

                <div class="w-full md:w-3/4">

                    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center gap-2">
                            <i class="fas fa-check-circle"></i> Perubahan berhasil disimpan.
                        </div>
                    @endif

                    <div x-show="activeTab === 'profil'"
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Profil Saya</h2>

                        <div class="flex items-center gap-6 mb-8">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563EB&color=fff&size=128"
                                class="w-24 h-24 rounded-full border-4 border-blue-50">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $user->role }}</p>
                                <button type="button"
                                    class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed"
                                    disabled>
                                    <i class="fas fa-camera mr-1"></i> Upload Foto (Segera)
                                </button>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="activeTab === 'password'" style="display: none;"
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Keamanan &
                            Password</h2>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                @error('current_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Password Baru</label>
                                <input type="password" name="password" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="activeTab === 'hapus'" style="display: none;"
                        class="bg-red-50 rounded-xl shadow-sm border border-red-100 p-8">
                        <h2 class="text-xl font-bold text-red-700 mb-4">Zona Bahaya</h2>
                        <p class="text-red-600 mb-6">
                            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.
                            Tindakan ini tidak dapat dibatalkan.
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');">
                            @csrf
                            @method('delete')

                            <div class="mb-4">
                                <label class="block text-red-700 font-medium mb-2">Password Anda (Konfirmasi)</label>
                                <input type="password" name="password" placeholder="Masukkan password untuk konfirmasi"
                                    required
                                    class="w-full p-3 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white">
                                @error('userDeletion', 'password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition shadow-md">
                                    Hapus Akun Permanen
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
