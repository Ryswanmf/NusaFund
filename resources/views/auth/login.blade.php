<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - NusaFund</title>
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-50 font-sans text-zinc-900 antialiased">
    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-sm w-full space-y-8">
            <div class="text-center">
                <a href="/" class="inline-block mb-4 transition transform hover:scale-105">
                    @php $settings = \App\Models\Setting::first(); @endphp
                    @if($settings && $settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-8 w-auto mx-auto">
                    @else
                        <span class="text-2xl font-black text-maroon-800 tracking-tighter">Nusa<span class="text-amber-500">Fund</span></span>
                    @endif
                </a>
                <h2 class="text-2xl font-black text-zinc-900 tracking-tight">Masuk Akun</h2>
                <p class="mt-1.5 text-zinc-500 text-sm font-medium">Lanjutkan aksi kebaikan Anda.</p>
            </div>

            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl border border-zinc-100">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-zinc-50 border-none rounded-xl py-3 px-5 focus:ring-2 focus:ring-maroon-500 font-bold text-sm text-zinc-900 placeholder-zinc-300" placeholder="email@contoh.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center px-2">
                            <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest">Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[9px] font-black text-maroon-700 uppercase tracking-widest hover:text-maroon-900">Lupa?</a>
                            @endif
                        </div>
                        <input type="password" name="password" required class="w-full bg-zinc-50 border-none rounded-xl py-3 px-5 focus:ring-2 focus:ring-maroon-500 font-bold text-sm text-zinc-900 placeholder-zinc-300" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center gap-2.5 px-2">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-zinc-200 text-maroon-700 focus:ring-maroon-500">
                        <label for="remember_me" class="text-[11px] font-bold text-zinc-500 cursor-pointer">Ingat saya</label>
                    </div>

                    <button type="submit" class="w-full bg-maroon-800 text-white py-4 rounded-full font-black text-base shadow-lg shadow-maroon-900/20 hover:bg-maroon-700 transition transform active:scale-95">
                        Masuk
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-zinc-50 pt-6">
                    <p class="text-xs text-zinc-500 font-medium">Belum punya akun? <a href="{{ route('register') }}" class="text-maroon-700 font-black hover:underline">Daftar Sekarang</a></p>
                </div>
            </div>
            
            <div class="text-center">
                <a href="/" class="text-zinc-400 text-[10px] font-black uppercase tracking-widest hover:text-zinc-600 transition">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
