<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
            {{ __('Masuk ke E-Layak') }}
        </h1>
        <p class="text-gray-500 text-sm mt-2">
            {{ __('Silakan masuk untuk mengakses layanan kampus') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 hover:underline font-medium" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password"
                class="block mt-1 w-full p-3 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded-md border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingatkan saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full justify-center py-3 bg-[#1E1E1E] hover:bg-gray-800 rounded-xl text-base font-bold transition active:scale-[0.98] shadow-lg shadow-gray-200">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>
