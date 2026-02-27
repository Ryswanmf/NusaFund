@extends('layouts.landing')

@section('title', 'Daftar Donasi - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Campaign <span class="text-maroon-700">Kebaikan</span></h1>
                    <p class="text-zinc-500 text-lg leading-relaxed">Pilih dan salurkan donasi Anda untuk membantu sesama melalui berbagai program yang transparan dan tepat sasaran.</p>
                </div>
                
                <!-- Filter/Search Bar Desktop -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Cari donasi..." class="bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-64 shadow-sm">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button class="bg-white border border-zinc-200 p-3 rounded-2xl hover:bg-zinc-50 transition shadow-sm">
                        <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap gap-3 mb-12">
                <button class="px-6 py-2.5 bg-maroon-700 text-white rounded-full font-bold text-sm shadow-lg shadow-maroon-900/20 transition transform active:scale-95">Semua</button>
                <button class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-full font-bold text-sm hover:border-maroon-300 hover:text-maroon-700 transition transform active:scale-95">Pendidikan</button>
                <button class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-full font-bold text-sm hover:border-maroon-300 hover:text-maroon-700 transition transform active:scale-95">Kesehatan</button>
                <button class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-full font-bold text-sm hover:border-maroon-300 hover:text-maroon-700 transition transform active:scale-95">Bencana</button>
                <button class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-full font-bold text-sm hover:border-maroon-300 hover:text-maroon-700 transition transform active:scale-95">Kemanusiaan</button>
                <button class="px-6 py-2.5 bg-white border border-zinc-200 text-zinc-600 rounded-full font-bold text-sm hover:border-maroon-300 hover:text-maroon-700 transition transform active:scale-95">Zakat</button>
            </div>

            <!-- Donation Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $campaigns = [
                        [
                            'title' => 'Bantu Renovasi Sekolah Dasar di Pelosok NTT',
                            'image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb8?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '45.000.000',
                            'target' => '60.000.000',
                            'percentage' => 75,
                            'days_left' => 12,
                            'category' => 'Mendesak'
                        ],
                        [
                            'title' => 'Sedekah Makanan untuk Lansia Terlantar',
                            'image' => 'https://images.unsplash.com/photo-1542884748-2b87b36c6b90?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '12.800.000',
                            'target' => '40.000.000',
                            'percentage' => 32,
                            'days_left' => 5,
                            'category' => 'Pangan'
                        ],
                        [
                            'title' => 'Tanggap Darurat: Bantuan Banjir Bandang Luwu',
                            'image' => 'https://images.unsplash.com/photo-1518391846015-55a9cc003b25?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '89.200.000',
                            'target' => '100.000.000',
                            'percentage' => 90,
                            'days_left' => 2,
                            'category' => 'Bencana'
                        ],
                        [
                            'title' => 'Operasi Jantung Dek Aira, Mari Bantu Sembuh',
                            'image' => 'https://images.unsplash.com/photo-1505751172107-573225a9212c?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '150.000.000',
                            'target' => '250.000.000',
                            'percentage' => 60,
                            'days_left' => 20,
                            'category' => 'Kesehatan'
                        ],
                        [
                            'title' => 'Beasiswa Pendidikan untuk Yatim Piatu',
                            'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '30.500.000',
                            'target' => '50.000.000',
                            'percentage' => 61,
                            'days_left' => 15,
                            'category' => 'Pendidikan'
                        ],
                        [
                            'title' => 'Bangun Sumur Bersih untuk Desa Kekeringan',
                            'image' => 'https://images.unsplash.com/photo-1527333323140-798b3b9a219e?q=80&w=1470&auto=format&fit=crop',
                            'collected' => '15.000.000',
                            'target' => '30.000.000',
                            'percentage' => 50,
                            'days_left' => 30,
                            'category' => 'Kemanusiaan'
                        ]
                    ];
                @endphp

                @foreach($campaigns as $camp)
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <img src="{{ $camp['image'] }}" alt="{{ $camp['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute top-5 left-5">
                            <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $camp['category'] }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <a href="{{ route('donasi.show', 1) }}" class="group/title">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover/title:text-maroon-700 transition">{{ $camp['title'] }}</h3>
                        </a>
                        
                        <div class="mt-auto space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2 font-semibold">
                                    <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                    <span class="text-maroon-700 font-black">Rp {{ $camp['collected'] }}</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                    <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: {{ $camp['percentage'] }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                <span class="text-maroon-600">{{ $camp['percentage'] }}% Tercapai</span>
                                <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                    <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $camp['days_left'] }} Hari Lagi
                                </span>
                            </div>
                            <a href="{{ route('donasi.show', 1) }}" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center items-center gap-2">
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-400 hover:text-maroon-700 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-maroon-700 text-white font-bold shadow-lg shadow-maroon-900/20 transition">1</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-600 font-bold hover:text-maroon-700 transition">2</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-600 font-bold hover:text-maroon-700 transition">3</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-400 hover:text-maroon-700 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div>
    </div>
@endsection
