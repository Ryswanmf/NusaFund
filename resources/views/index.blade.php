<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NusaFund - Kebaikan untuk Semua</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-maroon-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" 
                                   class="block w-full bg-maroon-900/50 border border-maroon-700/50 rounded-full py-2 pl-10 pr-3 text-sm placeholder-maroon-300 text-white focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition" 
                                   placeholder="Cari campaign kebaikan...">
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Menu Navigasi (Desktop) -->
                <div class="hidden lg:flex items-center space-x-6 text-sm font-semibold">
                    <a href="{{ route('donasi.index') }}" class="text-maroon-100 hover:text-amber-400 transition">Donasi</a>
                    <a href="#" class="text-maroon-100 hover:text-amber-400 transition">Event</a>
                    <a href="#" class="text-maroon-100 hover:text-amber-400 transition">Zakat</a>
                    <a href="#" class="text-maroon-100 hover:text-amber-400 transition">Galang Dana</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-6 py-2.5 rounded-full font-bold transition shadow-lg shadow-amber-900/20 active:scale-95">
                            Dashboard
                        </a>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-white hover:text-amber-400 transition">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-6 py-2.5 rounded-full font-bold transition shadow-lg shadow-amber-900/20 active:scale-95">
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
                <a href="{{ route('donasi.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium">Donasi</a>
                <a href="#" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium">Event</a>
                <a href="#" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium">Zakat</a>
                <a href="#" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium">Galang Dana</a>
                <div class="pt-4 space-y-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full text-center bg-amber-500 text-maroon-950 py-4 rounded-xl font-bold shadow-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center border border-amber-500/50 text-amber-500 py-4 rounded-xl font-bold">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center bg-amber-500 text-maroon-950 py-4 rounded-xl font-bold shadow-lg">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section class="relative bg-maroon-800 text-white py-24 lg:py-36 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-24 -mr-24 opacity-10">
                <svg width="600" height="600" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="50" fill="white" />
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="text-center lg:text-left">
                        <span class="inline-block bg-white/10 backdrop-blur-md text-amber-400 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6">#IndonesiaBerbagi</span>
                        <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold leading-[1.1] mb-8 text-balance">
                            Wujudkan <span class="text-amber-400">Perubahan</span> Lewat Kebaikan Anda
                        </h1>
                        <p class="text-lg md:text-xl text-maroon-50 mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed opacity-90">
                            Gabung bersama 12.000+ donatur lainnya untuk membantu sesama melalui donasi, zakat, dan aksi sosial yang transparan.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-10 py-4 rounded-full font-black text-lg shadow-xl shadow-amber-900/40 transition transform hover:-translate-y-1">
                                Mulai Berdonasi
                            </a>
                            <a href="#" class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 px-10 py-4 rounded-full font-bold text-lg transition">
                                Pelajari Program
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block relative">
                        <div class="rounded-[2.5rem] overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition duration-700 ease-out border-8 border-white/10">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470&auto=format&fit=crop" alt="Charity" class="w-full h-auto">
                        </div>
                        <div class="absolute -bottom-10 -left-10 bg-white p-6 rounded-3xl shadow-2xl text-maroon-950 flex items-center gap-5 animate-bounce-slow">
                            <div class="bg-green-100 p-3 rounded-2xl">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 mb-1">Total Tersalurkan</p>
                                <p class="text-2xl font-black">Rp 2.5 Miliar+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-16 border-b border-zinc-100 relative z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                    <div class="space-y-1">
                        <p class="text-4xl font-black text-maroon-800">500+</p>
                        <p class="text-sm text-zinc-500 font-semibold tracking-wide uppercase">Campaign Aktif</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-4xl font-black text-maroon-800">12k+</p>
                        <p class="text-sm text-zinc-500 font-semibold tracking-wide uppercase">Donatur Setia</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-4xl font-black text-maroon-800">45+</p>
                        <p class="text-sm text-zinc-500 font-semibold tracking-wide uppercase">Kota Terjangkau</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-4xl font-black text-maroon-800">200k+</p>
                        <p class="text-sm text-zinc-500 font-semibold tracking-wide uppercase">Penerima Manfaat</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Pilihan -->
        <section class="py-24 bg-zinc-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div class="max-w-xl">
                        <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4">Pilih Kategori Kebaikan</h2>
                        <p class="text-zinc-500 text-lg">Salurkan bantuan Anda ke sektor yang paling membutuhkan perhatian Anda saat ini.</p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-maroon-700 font-bold hover:gap-4 transition-all group">
                        Lihat Semua Kategori 
                        <svg class="w-5 h-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    <!-- Kategori Item -->
                    @php
                        $categories = [
                            ['name' => 'Pendidikan', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                            ['name' => 'Kesehatan', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                            ['name' => 'Panti Asuhan', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['name' => 'Bencana', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['name' => 'Kemanusiaan', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                            ['name' => 'Zakat', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z'],
                        ];
                    @endphp

                    @foreach($categories as $cat)
                    <a href="#" class="bg-white p-8 rounded-[2rem] shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-xl hover:border-maroon-200 transition-all duration-300 group hover:-translate-y-2">
                        <div class="w-16 h-16 bg-maroon-50 rounded-2xl flex items-center justify-center text-maroon-600 mb-5 group-hover:bg-maroon-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800">{{ $cat['name'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Donasi Mendesak -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div class="max-w-xl">
                        <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4">Donasi Mendesak</h2>
                        <p class="text-zinc-500 text-lg">Waktu sangat berharga bagi mereka. Ulurkan tangan Anda sekarang untuk campaign di bawah ini.</p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-maroon-700 font-bold hover:gap-4 transition-all group">
                        Lihat Semua Campaign 
                        <svg class="w-5 h-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <!-- Campaign Card 1 -->
                    <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb8?q=80&w=1470&auto=format&fit=crop" alt="Campaign 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute top-5 left-5">
                                <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Mendesak</span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover:text-maroon-700 transition">Bantu Renovasi Sekolah Dasar di Pelosok NTT</h3>
                            
                            <div class="mt-auto space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm mb-2 font-semibold">
                                        <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                        <span class="text-maroon-700 font-black">Rp 45.000.000</span>
                                    </div>
                                    <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                        <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                    <span class="text-maroon-600">75% Tercapai</span>
                                    <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        12 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 2 -->
                    <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="https://images.unsplash.com/photo-1542884748-2b87b36c6b90?q=80&w=1470&auto=format&fit=crop" alt="Campaign 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute top-5 left-5">
                                <span class="bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Pangan</span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover:text-maroon-700 transition">Sedekah Makanan untuk Lansia Terlantar</h3>
                            
                            <div class="mt-auto space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm mb-2 font-semibold">
                                        <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                        <span class="text-maroon-700 font-black">Rp 12.800.000</span>
                                    </div>
                                    <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                        <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: 32%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                    <span class="text-maroon-600">32% Tercapai</span>
                                    <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        5 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 3 -->
                    <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="https://images.unsplash.com/photo-1518391846015-55a9cc003b25?q=80&w=1470&auto=format&fit=crop" alt="Campaign 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute top-5 left-5">
                                <span class="bg-orange-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Bencana</span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover:text-maroon-700 transition">Tanggap Darurat: Bantuan Banjir Bandang Luwu</h3>
                            
                            <div class="mt-auto space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm mb-2 font-semibold">
                                        <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                        <span class="text-maroon-700 font-black">Rp 89.200.000</span>
                                    </div>
                                    <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                        <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: 90%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                    <span class="text-maroon-600">90% Tercapai</span>
                                    <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        2 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cara Berdonasi -->
        <section class="py-24 bg-maroon-900 text-white overflow-hidden relative shadow-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-5xl font-black mb-6">3 Langkah Mudah Berbagi</h2>
                    <p class="text-maroon-100 max-w-2xl mx-auto text-lg opacity-80">Proses yang aman, cepat, dan transparan untuk memastikan bantuan Anda tersalurkan dengan tepat.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-16 relative">
                    <div class="hidden lg:block absolute top-12 left-1/4 right-1/4 h-0.5 border-t-2 border-dashed border-maroon-400/30"></div>
                    
                    @php
                        $steps = [
                            ['num' => '1', 'title' => 'Pilih Campaign', 'desc' => 'Temukan program bantuan yang sesuai dengan hati Anda dari ribuan pilihan.'],
                            ['num' => '2', 'title' => 'Donasi Cepat', 'desc' => 'Pilih nominal dan metode pembayaran (E-Wallet, Transfer, atau QRIS) favorit Anda.'],
                            ['num' => '3', 'title' => 'Terima Laporan', 'desc' => 'Dapatkan laporan penyaluran dana secara berkala langsung melalui notifikasi.'],
                        ];
                    @endphp

                    @foreach($steps as $step)
                    <div class="relative text-center group">
                        <div class="w-24 h-24 bg-amber-500 text-maroon-950 rounded-full flex items-center justify-center text-4xl font-black mx-auto mb-8 shadow-2xl shadow-amber-900/40 group-hover:scale-110 transition duration-500 border-8 border-maroon-800/50">
                            {{ $step['num'] }}
                        </div>
                        <h3 class="text-2xl font-bold mb-4">{{ $step['title'] }}</h3>
                        <p class="text-maroon-100 leading-relaxed opacity-80">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Testimoni & Dampak -->
        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <div>
                        <span class="text-maroon-600 font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">Kisah Kebaikan</span>
                        <h2 class="text-3xl md:text-5xl font-black text-zinc-900 mb-8 leading-tight">Suara dari Hati yang Bersyukur</h2>
                        
                        <div class="space-y-8">
                            <!-- Testi Item 1 -->
                            <div class="bg-zinc-50 p-8 rounded-[2rem] border border-zinc-100 flex flex-col md:flex-row gap-6 hover:shadow-xl transition-all duration-500">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-600 shadow-inner">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H20.017C21.1216 4 22.017 4.89543 22.017 6V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM2.01697 21L2.01697 18C2.01697 16.8954 2.9124 16 4.01697 16H7.01697C7.56925 16 8.01697 15.5523 8.01697 15V9C8.01697 8.44772 7.56925 8 7.01697 8H3.01697C2.46468 8 2.01697 7.55228 2.01697 7V5C2.01697 4.44772 2.46468 4 3.01697 4H8.01697C9.12154 4 10.017 4.89543 10.017 6V15C10.017 18.3137 7.33068 21 4.01697 21H2.01697Z"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-zinc-600 text-lg leading-relaxed mb-6 font-medium italic">"NusaFund memberikan harapan baru bagi sekolah kami. Transparansinya luar biasa."</p>
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-maroon-200"></div>
                                        <div>
                                            <p class="font-bold text-zinc-900">Budi Santoso</p>
                                            <p class="text-xs text-zinc-400 font-bold uppercase tracking-wider">Donatur Rutin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testi Item 2 -->
                            <div class="bg-zinc-50 p-8 rounded-[2rem] border border-zinc-100 flex flex-col md:flex-row gap-6 hover:shadow-xl transition-all duration-500">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-600 shadow-inner">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H20.017C21.1216 4 22.017 4.89543 22.017 6V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM2.01697 21L2.01697 18C2.01697 16.8954 2.9124 16 4.01697 16H7.01697C7.56925 16 8.01697 15.5523 8.01697 15V9C8.01697 8.44772 7.56925 8 7.01697 8H3.01697C2.46468 8 2.01697 7.55228 2.01697 7V5C2.01697 4.44772 2.46468 4 3.01697 4H8.01697C9.12154 4 10.017 4.89543 10.017 6V15C10.017 18.3137 7.33068 21 4.01697 21H2.01697Z"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-zinc-600 text-lg leading-relaxed mb-6 font-medium italic">"Terima kasih donatur NusaFund, bantuan kalian menyelamatkan nyawa anak saya."</p>
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-amber-200"></div>
                                        <div>
                                            <p class="font-bold text-zinc-900">Siti Rahma</p>
                                            <p class="text-xs text-zinc-400 font-bold uppercase tracking-wider">Penerima Manfaat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-zinc-50 transform -rotate-3 hover:rotate-0 transition duration-700">
                            <img src="https://images.unsplash.com/photo-1509059852496-f3822ae057bf?q=80&w=1481&auto=format&fit=crop" alt="Impact Image" class="w-full h-auto aspect-[4/5] object-cover">
                        </div>
                        <div class="absolute -top-10 -right-10 bg-amber-500 p-8 rounded-3xl shadow-2xl text-maroon-950 max-w-[220px] animate-pulse-slow">
                            <p class="text-5xl font-black mb-2">100%</p>
                            <p class="text-xs font-black uppercase tracking-widest leading-relaxed opacity-90">Donasi Tersalurkan ke Penerima</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mulai Galang Dana (CTA) -->
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-maroon-800 rounded-[3.5rem] p-10 md:p-24 text-white text-center relative overflow-hidden shadow-2xl">
                    <!-- Decor -->
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-amber-400/5 rounded-full translate-x-1/4 translate-y-1/4"></div>
                    
                    <div class="relative z-10 max-w-3xl mx-auto">
                        <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight">Mulai Kebaikan Anda Sendiri Hari Ini</h2>
                        <p class="text-maroon-100 text-xl mb-12 opacity-90 leading-relaxed">Punya program kemanusiaan atau butuh bantuan darurat? Kami siap mendampingi langkah Anda.</p>
                        
                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                            <a href="#" class="bg-amber-500 hover:bg-amber-400 text-maroon-900 px-12 py-5 rounded-full font-black text-xl shadow-2xl shadow-amber-950/40 transition transform hover:-translate-y-1 active:scale-95">
                                Mulai Galang Dana
                            </a>
                            <a href="#" class="bg-white/10 backdrop-blur-md border-2 border-white/20 hover:bg-white/20 px-12 py-5 rounded-full font-bold text-xl transition">
                                Pelajari Caranya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-24 bg-zinc-50" x-data="{ activeFaq: null }">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-6 tracking-tight">Butuh Informasi Lebih?</h2>
                    <p class="text-zinc-500 text-lg">Jawaban cepat untuk pertanyaan yang paling sering muncul.</p>
                </div>

                <div class="space-y-4">
                    @php
                        $faqs = [
                            ['id' => 1, 'q' => 'Bagaimana NusaFund memastikan donasi aman?', 'a' => 'Setiap penggalang dana wajib melalui verifikasi identitas (KYC) yang ketat dan laporan penyaluran dana wajib diunggah secara berkala.'],
                            ['id' => 2, 'q' => 'Apakah ada potongan biaya administrasi?', 'a' => 'Program bencana alam 0% potongan. Untuk program reguler, dikenakan biaya operasional platform rata-rata 5% guna verifikasi lapangan.'],
                            ['id' => 3, 'q' => 'Metode pembayaran apa saja yang tersedia?', 'a' => 'Mendukung Transfer Bank (BCA, BNI, Mandiri), E-Wallet (Gopay, OVO, Dana), hingga QRIS untuk kemudahan Anda.'],
                        ];
                    @endphp

                    @foreach($faqs as $faq)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        <button @click="activeFaq === {{ $faq['id'] }} ? activeFaq = null : activeFaq = {{ $faq['id'] }}" 
                                class="w-full flex justify-between items-center p-8 text-left focus:outline-none transition group">
                            <span class="font-bold text-zinc-800 text-lg group-hover:text-maroon-700 transition">{{ $faq['q'] }}</span>
                            <span class="ml-4 flex-shrink-0 w-8 h-8 rounded-full bg-zinc-50 flex items-center justify-center transition transform" :class="activeFaq === {{ $faq['id'] }} ? 'rotate-180 bg-maroon-50 text-maroon-600' : ''">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div x-show="activeFaq === {{ $faq['id'] }}" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2">
                            <div class="px-8 pb-8 text-zinc-500 text-lg leading-relaxed border-t border-zinc-50 pt-4">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Mitra Kebaikan -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-[10px] font-black uppercase tracking-[0.4em] text-zinc-400 mb-12">Kredibilitas Platform Kami</p>
                <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20 opacity-30 grayscale hover:grayscale-0 transition-all duration-700">
                    <span class="text-2xl font-black text-zinc-900 tracking-tighter">BANK BNI</span>
                    <span class="text-2xl font-black text-zinc-900 tracking-tighter">BANK BCA</span>
                    <span class="text-2xl font-black text-zinc-900 tracking-tighter">MANDIRI</span>
                    <span class="text-2xl font-black text-zinc-900 tracking-tighter">KEMENSOS</span>
                    <span class="text-2xl font-black text-zinc-900 tracking-tighter">BAZNAS</span>
                </div>
            </div>
        </section>
    </main>

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
                        @foreach(['fb', 'ig', 'yt'] as $social)
                        <a href="#" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            @if($social == 'fb') <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            @elseif($social == 'ig') <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            @else <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z"/></svg>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Kolom 2: Program -->
                <div class="space-y-8 lg:pl-10">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Program</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Donasi Pilihan</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Bayar Zakat</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Galang Dana</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Campaign Urgent</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Dukungan -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Dukungan</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Hubungi -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Hubungi</h4>
                    <ul class="space-y-5 text-sm font-medium leading-relaxed">
                        <li class="flex items-start gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg></span>
                            <span>Tebet, Jakarta Selatan, 12810</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span>
                            <span>kontak@nusafund.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-900 pt-12 flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600">
                <p>&copy; 2026 NusaFund Indonesia. Terdaftar Kemensos RI.</p>
                <div class="flex items-center gap-6">
                    <span class="text-zinc-500">Transparansi Keuangan 100%</span>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .animate-bounce-slow { animation: bounce 3s infinite; }
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
    </style>
</body>
</html>
