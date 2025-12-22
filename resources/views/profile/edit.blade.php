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

<body class="bg-gray-100 flex flex-col md:flex-row">

    @include('sidebarmhs')

    <div class="flex-1 p-4 md:p-10 overflow-y-auto h-screen lg:ml-[260px] transition-all duration-300">

        <div class="h-10 md:hidden"></div>

        <div class="max-w-6xl mx-auto" x-data="{ activeTab: 'profil' }">

            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 md:mb-8 flex items-center gap-3">
                <i class="fas fa-cog text-blue-600"></i> Pengaturan Akun
            </h1>

            <div class="flex flex-col md:flex-row gap-6 md:gap-8">

                <div class="w-full md:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div
                            class="hidden md:block p-4 bg-gray-50 border-b border-gray-100 font-semibold text-gray-700 text-sm">
                            Menu Pengaturan
                        </div>
                        <nav class="flex md:flex-col overflow-x-auto md:overflow-x-visible p-2 gap-1 snap-x">
                            <button @click="activeTab = 'profil'"
                                :class="activeTab === 'profil' ? 'bg-blue-50 text-blue-600 font-semibold' :
                                    'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 text-left px-4 py-3 rounded-lg transition flex items-center gap-3 text-sm snap-start whitespace-nowrap">
                                <i class="fas fa-user w-5 text-center"></i> Profil Saya
                            </button>

                            <button @click="activeTab = 'password'"
                                :class="activeTab === 'password' ? 'bg-blue-50 text-blue-600 font-semibold' :
                                    'text-gray-600 hover:bg-gray-50'"
                                class="flex-shrink-0 text-left px-4 py-3 rounded-lg transition flex items-center gap-3 text-sm snap-start whitespace-nowrap">
                                <i class="fas fa-lock w-5 text-center"></i> Keamanan
                            </button>

                            <button @click="activeTab = 'hapus'"
                                :class="activeTab === 'hapus' ? 'bg-red-50 text-red-600 font-semibold' :
                                    'text-red-500 hover:bg-red-50'"
                                class="flex-shrink-0 text-left px-4 py-3 rounded-lg transition flex items-center gap-3 text-sm snap-start whitespace-nowrap">
                                <i class="fas fa-trash-alt w-5 text-center"></i> Hapus Akun
                            </button>
                        </nav>
                    </div>
                </div>

                <div class="w-full md:w-3/4">

                    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 text-sm">
                            <i class="fas fa-check-circle"></i> Perubahan berhasil disimpan.
                        </div>
                    @endif

                    <div x-show="activeTab === 'profil'" x-transition
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Profil
                            Saya</h2>

                        <div class="flex flex-col sm:flex-row items-center gap-6 mb-8">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563EB&color=fff&size=128"
                                class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-blue-50 shadow-sm">
                            <div class="text-center sm:text-left">
                                <h3 class="font-bold text-lg text-gray-800">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3 uppercase tracking-wider">{{ $user->role }}</p>
                                <button type="button" disabled
                                    class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-xs font-medium cursor-not-allowed">
                                    <i class="fas fa-camera mr-1"></i> Upload Foto (Segera)
                                </button>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4 md:space-y-6">
                            @csrf @method('patch')
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                                @error('name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                                @error('email')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition active:scale-95 shadow-md text-sm">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="activeTab === 'password'" x-transition style="display: none;"
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">
                            Keamanan & Password</h2>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-4 md:space-y-6">
                            @csrf @method('put')
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                                @error('current_password')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Password Baru</label>
                                <input type="password" name="password" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                                @error('password')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md text-sm">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="activeTab === 'hapus'" x-transition style="display: none;"
                        class="bg-red-50 rounded-xl shadow-sm border border-red-100 p-6 md:p-8 text-center sm:text-left">
                        <h2 class="text-lg md:text-xl font-bold text-red-700 mb-4">Zona Bahaya</h2>
                        <p class="text-xs md:text-sm text-red-600 mb-6 leading-relaxed">
                            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Tindakan
                            ini tidak dapat dibatalkan.
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');">
                            @csrf @method('delete')

                            <div class="mb-4 text-left">
                                <label class="block text-red-700 text-sm font-medium mb-2">Password Konfirmasi</label>
                                <input type="password" name="password" placeholder="Konfirmasi password" required
                                    class="w-full p-3 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white text-sm">
                                @error('userDeletion', 'password')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="w-full sm:w-auto bg-red-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition shadow-md text-sm">
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
