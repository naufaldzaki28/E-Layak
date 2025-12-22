<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Bantuan - E-Layak</title>

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
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Pusat Bantuan</h2>

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

            <div class="flex-1 overflow-y-auto p-8">

                <div class="max-w-5xl mx-auto mb-8 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="p-3 bg-blue-50 rounded-full">
                            <i class="fas fa-headset text-4xl text-blue-600"></i>
                        </div>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900">Butuh Bantuan?</h1>
                    <p class="text-gray-500 mt-2">Hubungi tim support kami atau laporkan kendala teknis.</p>
                </div>

                <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2">

                        <div class="bg-gray-50 p-8 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500">
                            </div>

                            <img src="https://images.unsplash.com/photo-1534536281715-e28d76689b4d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="Contact Support"
                                class="rounded-xl shadow-lg transform hover:scale-105 transition duration-500 object-cover w-3/4 h-auto">
                        </div>

                        <div class="p-8 md:p-10">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Hubungi Kami</h3>

                            @if (session('success'))
                                <div
                                    class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('bantuan.kirim') }}" method="POST">
                                @csrf <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                                        <input type="text" name="nama_depan" required placeholder="John"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Belakang</label>
                                        <input type="text" name="nama_belakang" placeholder="Doe"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600"
                                        readonly>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan Anda</label>
                                    <textarea name="pesan" required rows="4" placeholder="Jelaskan kendala atau pertanyaan Anda..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition resize-none"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-[#1E1E1E] text-white font-bold py-3 rounded-xl hover:bg-gray-800 transition transform hover:-translate-y-0.5 shadow-lg shadow-gray-300">
                                    Kirim Pesan
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="max-w-5xl mx-auto mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <i class="fas fa-envelope text-blue-500 mb-2 text-xl"></i>
                        <h4 class="font-bold text-gray-800">Email</h4>
                        <p class="text-sm text-gray-500">support@elayak.com</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <i class="fas fa-phone text-green-500 mb-2 text-xl"></i>
                        <h4 class="font-bold text-gray-800">Telepon</h4>
                        <p class="text-sm text-gray-500">+62 812 3456 7890</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <i class="fas fa-map-marker-alt text-red-500 mb-2 text-xl"></i>
                        <h4 class="font-bold text-gray-800">Lokasi</h4>
                        <p class="text-sm text-gray-500">Gedung Rektorat Lt. 2</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
