<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
            {{ __('Daftar Akun Baru') }}
        </h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ __('Silakan lengkapi data di bawah untuk mendaftar') }}
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-gray-700" />
            <x-text-input id="name"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Nama Lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="nim" :value="__('NIM')" class="font-semibold text-gray-700" />
            <x-text-input id="nim"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                type="text" name="nim" :value="old('nim')" required autocomplete="nim"
                placeholder="Nomor Induk Mahasiswa" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                type="email" name="email" :value="old('email')" required autocomplete="email"
                placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button
                class="w-full justify-center py-3 bg-[#1E1E1E] hover:bg-gray-800 rounded-xl text-base font-bold transition active:scale-[0.98] shadow-lg shadow-gray-200">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                {{ __('Sudah punya akun?') }}
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                    {{ __('Masuk di sini') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
