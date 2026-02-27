<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-zinc-900 dark:text-white mb-2">Selamat Datang Kembali</h2>
        <p class="text-zinc-500 dark:text-zinc-400 text-sm">Silakan masuk untuk melanjutkan aksi kebaikan Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-zinc-700 dark:text-zinc-300 mb-1" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <x-input-label for="password" :value="__('Password')" class="font-bold text-zinc-700 dark:text-zinc-300" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-maroon-600 dark:text-amber-500 hover:underline" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded-md border-zinc-300 text-maroon-600 shadow-sm focus:ring-maroon-500 dark:bg-zinc-900 dark:border-zinc-700 dark:focus:ring-amber-500" name="remember">
            <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400 font-medium">{{ __('Ingat saya') }}</span>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-4">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-zinc-100 dark:border-zinc-800 text-center">
        <p class="text-sm text-zinc-500 dark:text-zinc-400">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-maroon-700 dark:text-amber-500 hover:underline">
                Daftar Gratis
            </a>
        </p>
    </div>
</x-guest-layout>
