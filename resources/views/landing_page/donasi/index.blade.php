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
                <form action="{{ route('donasi.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari donasi..." class="bg-white border border-zinc-200 rounded-2xl py-4 pl-14 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-full md:w-80 shadow-sm font-bold">
                    <svg class="w-6 h-6 text-zinc-400 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within:text-maroon-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('donasi.index') }}" class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ !request('category') || request('category') == 'Semua' ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('donasi.index', ['category' => $cat->name, 'search' => request('search')]) }}" 
                       class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ request('category') == $cat->name ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300 hover:text-maroon-700' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Donation Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($campaigns as $camp)
                <div class="bg-white rounded-[3rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @php
                            $campImage = $camp->image;
                            if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                $campImage = asset('storage/' . $campImage);
                            } else {
                                $campImage = $campImage ?: asset('images/nusafac.png');
                            }
                        @endphp
                        <img src="{{ $campImage }}" alt="{{ $camp->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <div class="absolute top-6 left-6 flex flex-wrap gap-2">
                            @if($camp->is_urgent)
                                <span class="bg-red-600 text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg">Mendesak</span>
                            @endif
                            <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg">{{ $camp->category }}</span>
                        </div>
                    </div>
                    <div class="p-10 flex flex-col flex-1">
                        <a href="{{ route('donasi.show', $camp->slug) }}" class="group/title">
                            <h3 class="text-xl font-bold text-zinc-900 mb-6 line-clamp-2 group-hover/title:text-maroon-700 transition leading-snug">{{ $camp->title }}</h3>
                        </a>
                        
                        <div class="mt-auto space-y-6">
                            <div>
                                <div class="flex justify-between items-end mb-3">
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Terkumpul</p>
                                        <p class="text-maroon-800 font-black text-lg">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }}</p>
                                    </div>
                                    @php $percent = ($camp->collected_amount / $camp->target_amount) * 100; @endphp
                                    <p class="text-maroon-700 font-black text-sm">{{ round($percent) }}%</p>
                                </div>
                                <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden p-0.5 border border-zinc-50 shadow-inner">
                                    <div class="bg-gradient-to-r from-maroon-700 to-maroon-500 h-full rounded-full transition-all duration-1000 shadow-sm" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center py-4 border-y border-zinc-50">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-maroon-50 flex items-center justify-center text-maroon-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">{{ $camp->end_date ? ceil(now()->diffInDays($camp->end_date)) . ' Hari Lagi' : 'Tak Terbatas' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">0 Donatur</span>
                                </div>
                            </div>
                            <a href="{{ route('donasi.show', $camp->slug) }}" class="block w-full text-center bg-maroon-50 text-maroon-800 hover:bg-maroon-800 hover:text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all duration-300 transform active:scale-95">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-zinc-200">
                    <div class="w-24 h-24 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Campaign Tidak Ditemukan</h3>
                    <p class="text-zinc-500 font-medium">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
