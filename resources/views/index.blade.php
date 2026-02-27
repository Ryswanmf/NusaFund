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
<body class="bg-zinc-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-maroon-800 text-white shadow-md sticky top-0 z-50" 
         style="background-color: #800000;" 
         x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Sisi Kiri: Logo & Search -->
                <div class="flex items-center gap-8 flex-1">
                    <a href="/" class="flex-shrink-0 flex items-center gap-2">
                        <span class="text-2xl font-bold tracking-tight text-white">Nusa<span class="text-amber-400 font-extrabold">Fund</span></span>
                    </a>
                    
                    <!-- Search Bar (Hidden on mobile) -->
                    <div class="hidden md:block flex-1 max-w-md">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" 
                                   class="block w-full bg-maroon-900 border-none rounded-full py-2 pl-10 pr-3 text-sm placeholder-zinc-300 focus:ring-2 focus:ring-amber-400 transition" 
                                   placeholder="Cari campaign atau kebutuhan..."
                                   style="background-color: #660000;">
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Menu Navigasi (Desktop) -->
                <div class="hidden lg:flex items-center space-x-6 text-sm font-medium">
                    <a href="#" class="hover:text-amber-400 transition">Donasi</a>
                    <a href="#" class="hover:text-amber-400 transition">Event</a>
                    <a href="#" class="hover:text-amber-400 transition">Zakat</a>
                    <a href="#" class="hover:text-amber-400 transition">Galang Dana</a>
                    <a href="/login" class="bg-amber-500 hover:bg-amber-600 text-maroon-950 px-6 py-2 rounded-full font-bold transition shadow-sm">
                        Masuk
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-amber-400 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-collapse class="lg:hidden bg-maroon-900 border-t border-maroon-700" style="background-color: #660000;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-maroon-800 hover:text-amber-400">Donasi</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-maroon-800 hover:text-amber-400">Event</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-maroon-800 hover:text-amber-400">Zakat</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-maroon-800 hover:text-amber-400">Galang Dana</a>
                <a href="/login" class="block w-full text-center mt-4 bg-amber-500 text-maroon-950 px-4 py-2 rounded-md font-bold">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main>
        <section class="relative bg-maroon-800 text-white py-20 lg:py-32 overflow-hidden" style="background-color: #800000;">
            <!-- Background pattern/decoration -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 opacity-10">
                <svg width="400" height="400" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="50" fill="white" />
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 text-balance">
                            Bantu Sesama dengan <span class="text-amber-400">NusaFund</span>
                        </h1>
                        <p class="text-lg md:text-xl text-zinc-100 mb-8 max-w-lg">
                            Wujudkan perubahan nyata melalui donasi, zakat, dan aksi sosial. Bersama kita membangun harapan yang lebih baik.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#" class="bg-amber-500 hover:bg-amber-600 text-maroon-950 px-8 py-3 rounded-full font-bold text-lg shadow-lg transition transform hover:scale-105">
                                Mulai Berdonasi
                            </a>
                            <a href="#" class="bg-transparent border-2 border-white hover:bg-white/10 px-8 py-3 rounded-full font-bold text-lg transition">
                                Pelajari Program
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block relative">
                        <div class="rounded-2xl overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition duration-500">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470&auto=format&fit=crop" alt="Charity" class="w-full h-auto">
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg text-maroon-900 flex items-center gap-4">
                            <div class="bg-green-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-zinc-400">Donasi Terkumpul</p>
                                <p class="text-xl font-extrabold">Rp 2.5 Miliar+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-12 border-b border-zinc-100 shadow-sm relative z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <p class="text-3xl font-extrabold text-maroon-800">500+</p>
                        <p class="text-sm text-zinc-500 font-medium">Campaign Aktif</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-maroon-800">12k+</p>
                        <p class="text-sm text-zinc-500 font-medium">Donatur Setia</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-maroon-800">45+</p>
                        <p class="text-sm text-zinc-500 font-medium">Kota Terjangkau</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-maroon-800">200k+</p>
                        <p class="text-sm text-zinc-500 font-medium">Penerima Manfaat</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Pilihan -->
        <section class="py-16 bg-zinc-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-zinc-900">Kategori Pilihan</h2>
                        <p class="text-zinc-500 mt-2">Pilih kategori yang ingin Anda bantu hari ini.</p>
                    </div>
                    <a href="#" class="text-maroon-700 font-bold hover:underline hidden sm:block">Lihat Semua Kategori &rarr;</a>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <!-- Kategori Item -->
                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Pendidikan</span>
                    </a>
                    
                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Kesehatan</span>
                    </a>

                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Panti Asuhan</span>
                    </a>

                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Bencana</span>
                    </a>

                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Kemanusiaan</span>
                    </a>

                    <a href="#" class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-md hover:border-maroon-200 transition group">
                        <div class="w-12 h-12 bg-maroon-50 rounded-xl flex items-center justify-center text-maroon-600 mb-4 group-hover:bg-maroon-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path></svg>
                        </div>
                        <span class="font-bold text-zinc-800 text-sm">Zakat</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Donasi Mendesak -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-zinc-900">Donasi Mendesak</h2>
                        <p class="text-zinc-500 mt-2">Bantuan Anda sangat dibutuhkan segera untuk campaign berikut.</p>
                    </div>
                    <a href="#" class="text-maroon-700 font-bold hover:underline hidden sm:block">Lihat Semua Campaign &rarr;</a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Campaign Card 1 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl transition flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb8?q=80&w=1470&auto=format&fit=crop" alt="Campaign 1" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-maroon-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Mendesak</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-3 line-clamp-2 hover:text-maroon-700 transition">Bantu Renovasi Sekolah Dasar di Pelosok NTT</h3>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-zinc-500 font-medium">Terkumpul</span>
                                    <span class="text-maroon-700 font-bold">Rp 45.000.000</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-2.5 rounded-full mb-4 overflow-hidden">
                                    <div class="bg-maroon-600 h-full rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="flex justify-between items-center text-xs font-bold text-zinc-400 uppercase tracking-widest">
                                    <span>75% Tercapai</span>
                                    <span class="flex items-center gap-1 text-zinc-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        12 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-6 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-3 rounded-xl font-bold transition">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 2 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl transition flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1542884748-2b87b36c6b90?q=80&w=1470&auto=format&fit=crop" alt="Campaign 2" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-maroon-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Pangan</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-3 line-clamp-2 hover:text-maroon-700 transition">Sedekah Makanan untuk Lansia Terlantar</h3>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-zinc-500 font-medium">Terkumpul</span>
                                    <span class="text-maroon-700 font-bold">Rp 12.800.000</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-2.5 rounded-full mb-4 overflow-hidden">
                                    <div class="bg-maroon-600 h-full rounded-full" style="width: 32%"></div>
                                </div>
                                <div class="flex justify-between items-center text-xs font-bold text-zinc-400 uppercase tracking-widest">
                                    <span>32% Tercapai</span>
                                    <span class="flex items-center gap-1 text-zinc-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        5 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-6 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-3 rounded-xl font-bold transition">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 3 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl transition flex flex-col h-full group">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1518391846015-55a9cc003b25?q=80&w=1470&auto=format&fit=crop" alt="Campaign 3" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-maroon-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Bencana</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-xl font-bold text-zinc-900 mb-3 line-clamp-2 hover:text-maroon-700 transition">Tanggap Darurat: Bantuan Banjir Bandang Luwu</h3>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-zinc-500 font-medium">Terkumpul</span>
                                    <span class="text-maroon-700 font-bold">Rp 89.200.000</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-2.5 rounded-full mb-4 overflow-hidden">
                                    <div class="bg-maroon-600 h-full rounded-full" style="width: 90%"></div>
                                </div>
                                <div class="flex justify-between items-center text-xs font-bold text-zinc-400 uppercase tracking-widest">
                                    <span>90% Tercapai</span>
                                    <span class="flex items-center gap-1 text-zinc-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        2 Hari Lagi
                                    </span>
                                </div>
                                <a href="#" class="block w-full text-center mt-6 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-3 rounded-xl font-bold transition">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Lihat Semua (Mobile only) -->
                <div class="mt-10 sm:hidden">
                    <a href="#" class="block w-full text-center border-2 border-maroon-600 text-maroon-700 py-3 rounded-xl font-bold">
                        Lihat Semua Campaign
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-zinc-900 text-zinc-400 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 NusaFund. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>
</body>
</html>
