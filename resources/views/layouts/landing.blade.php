<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NusaFund - Kebaikan untuk Semua')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-zinc-900 antialiased">
    <!-- Navbar -->
    <nav class="bg-maroon-800 text-white shadow-sm sticky top-0 z-50 border-b border-maroon-700/50" 
         x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Sisi Kiri: Logo & Search -->
                <div class="flex items-center gap-8 flex-1">
                    <a href="/" class="flex-shrink-0 flex items-center gap-2 group transition">
                        <span class="text-2xl font-bold tracking-tight text-white group-hover:text-amber-400 transition">Nusa<span class="text-amber-400 font-extrabold group-hover:text-white transition">Fund</span></span>
                    </a>
                    
                    <!-- Search Bar (Hidden on mobile) -->
                    <div class="hidden md:block flex-1 max-w-md">
                        <form action="{{ route('donasi.index') }}" method="GET" class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-maroon-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="block w-full bg-maroon-900/50 border border-maroon-700/50 rounded-full py-2 pl-10 pr-3 text-sm placeholder-maroon-300 text-white focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition" 
                                   placeholder="Cari campaign kebaikan...">
                        </form>
                    </div>
                </div>

                <!-- Sisi Kanan: Menu Navigasi (Desktop) -->
                <div class="hidden lg:flex items-center space-x-6 text-sm font-semibold">
                    <a href="/" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('/') ? 'text-amber-400' : '' }}">Beranda</a>
                    <a href="{{ route('donasi.index') }}" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('donasi*') ? 'text-amber-400' : '' }}">Donasi</a>
                    <a href="{{ route('event.index') }}" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('event*') ? 'text-amber-400' : '' }}">Event</a>
                    <a href="{{ route('zakat.index') }}" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('zakat*') ? 'text-amber-400' : '' }}">Zakat</a>
                    <a href="{{ route('fundraising.index') }}" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('galang-dana*') ? 'text-amber-400' : '' }}">Galang Dana</a>
                    <a href="{{ route('about') }}" class="text-maroon-100 hover:text-amber-400 transition {{ Request::is('tentang-kami') ? 'text-amber-400' : '' }}">Tentang Kami</a>
                    @auth
                        <div class="flex items-center gap-3">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white hover:text-amber-400 transition px-3 py-2 text-sm font-bold border border-white/20 rounded-full hover:border-amber-400">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-white hover:text-amber-400 transition px-3 py-2 text-sm font-bold">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-5 py-2 rounded-full font-bold transition shadow-lg shadow-amber-900/20 active:scale-95 text-sm">
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white p-2 hover:bg-maroon-700 rounded-lg transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-maroon-900 border-t border-maroon-700 overflow-hidden shadow-2xl">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="/" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('/') ? 'text-amber-400 bg-maroon-800' : '' }}">Beranda</a>
                <a href="{{ route('donasi.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('donasi*') ? 'text-amber-400 bg-maroon-800' : '' }}">Donasi</a>
                <a href="{{ route('event.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('event*') ? 'text-amber-400 bg-maroon-800' : '' }}">Event</a>
                <a href="{{ route('zakat.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('zakat*') ? 'text-amber-400 bg-maroon-800' : '' }}">Zakat</a>
                <a href="{{ route('fundraising.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('galang-dana*') ? 'text-amber-400 bg-maroon-800' : '' }}">Galang Dana</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('tentang-kami') ? 'text-amber-400 bg-maroon-800' : '' }}">Tentang Kami</a>
                <div class="pt-4 space-y-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-center border border-white/20 text-white py-3 rounded-xl font-bold text-sm">
                                Keluar Akun
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center border border-amber-500/50 text-amber-500 py-3 rounded-xl font-bold text-sm">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center bg-amber-500 text-maroon-950 py-3 rounded-xl font-bold shadow-lg text-sm">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ str_replace([' ', '-', '+'], '', $settings->whatsapp) }}" 
       target="_blank" 
       class="fixed bottom-8 right-8 z-[60] group flex items-center">
        <!-- Tooltip Label -->
        <span class="absolute right-full mr-4 bg-white text-zinc-900 px-4 py-2 rounded-2xl text-xs font-black shadow-2xl border border-zinc-100 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none translate-x-4 group-hover:translate-x-0 whitespace-nowrap">
            Butuh Bantuan? Chat Kami
        </span>
        <!-- Button -->
        <div class="w-16 h-16 bg-[#25D366] text-white rounded-[2rem] shadow-[0_20px_50px_rgba(37,211,102,0.4)] flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </div>
    </a>

    <!-- Footer -->
    <footer class="bg-zinc-950 text-zinc-400 pt-24 pb-12 border-t border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
                <!-- Brand & About -->
                <div class="space-y-8">
                    <a href="/" class="inline-block">
                        <span class="text-3xl font-bold tracking-tight text-white">Nusa<span class="text-amber-400 font-extrabold">Fund</span></span>
                    </a>
                    <p class="text-sm leading-relaxed opacity-80">
                        Platform penggalangan dana paling transparan dan terpercaya di Indonesia. Membantu menghubungkan kebaikan Anda kepada mereka yang paling membutuhkan.
                    </p>
                    <div class="flex items-center gap-5">
                        @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Kolom 2: Program -->
                <div class="space-y-8 lg:pl-10">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Program</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="{{ route('donasi.index') }}" class="hover:text-amber-400 transition-colors">Donasi Pilihan</a></li>
                        <li><a href="{{ route('zakat.index') }}" class="hover:text-amber-400 transition-colors">Bayar Zakat</a></li>
                        <li><a href="{{ route('fundraising.index') }}" class="hover:text-amber-400 transition-colors">Galang Dana</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Campaign Utama</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Dukungan -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Dukungan</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="{{ route('support.index') }}" class="hover:text-amber-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('terms.index') }}" class="hover:text-amber-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy.index') }}" class="hover:text-amber-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('faq.index') }}" class="hover:text-amber-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Hubungi -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Hubungi</h4>
                    <ul class="space-y-5 text-sm font-medium leading-relaxed">
                        <li class="flex items-start gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg></span>
                            <span>{{ $settings->address }}</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span>
                            <span>{{ $settings->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-900 pt-12 flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600">
                <p>&copy; {{ $settings->copyright }}</p>
                <div class="flex items-center gap-6">
                    <span class="text-zinc-500">Transparansi Keuangan 100%</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
