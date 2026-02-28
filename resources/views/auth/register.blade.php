<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-black text-zinc-900 dark:text-white mb-1">Mulai Langkah Kebaikan</h2>
        <p class="text-zinc-500 dark:text-zinc-400 text-xs">Daftar sekarang dan jadilah bagian dari perubahan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-zinc-700 dark:text-zinc-300 mb-1 text-xs uppercase tracking-widest" />
            <x-text-input id="name" class="block mt-1 w-full text-sm py-2.5" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-zinc-700 dark:text-zinc-300 mb-1 text-xs uppercase tracking-widest" />
            <x-text-input id="email" class="block mt-1 w-full text-sm py-2.5" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="font-bold text-zinc-700 dark:text-zinc-300 mb-1 text-xs uppercase tracking-widest" />
            <x-text-input id="password" class="block mt-1 w-full text-sm py-2.5"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-bold text-zinc-700 dark:text-zinc-300 mb-1 text-xs uppercase tracking-widest" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-sm py-2.5"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password Anda" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800 text-center">
        <p class="text-xs text-zinc-500 dark:text-zinc-400">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-maroon-700 dark:text-amber-500 hover:underline">
                Masuk di sini
            </a>
        </p>
    </div>
</x-guest-layout>
