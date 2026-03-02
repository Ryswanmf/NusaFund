@extends('layouts.landing')

@section('title', $campaign->title . ' - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-8 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm font-medium text-zinc-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="/" class="hover:text-maroon-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('donasi.index') }}" class="hover:text-maroon-700">Donasi</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-zinc-800 truncate max-w-[200px] md:max-w-none">{{ $campaign->title }}</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Konten Utama -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Hero Image & Title -->
                    <div class="space-y-6">
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-video">
                            @php
                                $campImage = $campaign->image;
                                if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                    $campImage = asset('storage/' . $campImage);
                                } else {
                                    $campImage = $campImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $campImage }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6 flex gap-3">
                                @if($campaign->is_urgent)
                                    <span class="bg-maroon-600/90 backdrop-blur-md text-white text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">Mendesak</span>
                                @endif
                                <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">{{ $campaign->category }}</span>
                            </div>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">{{ $campaign->title }}</h1>
                        
                        <!-- Fundraiser Info (Statis sementara) -->
                        <div class="flex items-center gap-4 p-4 bg-white rounded-3xl border border-zinc-100 shadow-sm">
                            <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-bold">NF</div>
                            <div>
                                <div class="flex items-center gap-1">
                                    <p class="font-bold text-zinc-900">Admin NusaFund</p>
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                                <p class="text-xs text-zinc-400 font-medium">Terverifikasi NusaFund</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs & Content -->
                    <div x-data="{ tab: 'cerita' }" class="space-y-8">
                        <div class="flex border-b border-zinc-200">
                            <button @click="tab = 'cerita'" :class="tab === 'cerita' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-lg border-b-4 transition-all">Cerita</button>
                            <button @click="tab = 'donatur'" :class="tab === 'donatur' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-lg border-b-4 transition-all">Donatur (0)</button>
                        </div>

                        <div x-show="tab === 'cerita'" class="prose prose-zinc lg:prose-xl max-w-none text-zinc-600 leading-relaxed whitespace-pre-line">
                            {{ $campaign->description }}
                        </div>

                        <div x-show="tab === 'donatur'" class="space-y-4">
                            <div class="py-10 text-center text-zinc-400 font-medium">Belum ada donatur untuk saat ini. Jadi yang pertama membantu!</div>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Widget Donasi (Sticky) -->
                <div class="space-y-8">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-2xl space-y-8">
                            <div>
                                <p class="text-4xl font-black text-maroon-800 mb-2">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                <div class="flex justify-between items-center text-sm font-bold text-zinc-400 mb-4 uppercase tracking-widest">
                                    <span>Terkumpul dari <span class="text-zinc-900">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span></span>
                                    @php $percent = ($campaign->collected_amount / $campaign->target_amount) * 100; @endphp
                                    <span class="text-maroon-700">{{ round($percent) }}%</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-4 rounded-full overflow-hidden mb-6">
                                    <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000 shadow-lg" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        <p class="text-2xl font-black text-zinc-900">0</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Donatur</p>
                                    </div>
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        <p class="text-2xl font-black text-zinc-900">{{ ceil(now()->diffInDays($campaign->end_date)) }}</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Hari Lagi</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform active:scale-95 group">
                                Donasi Sekarang
                                <svg class="w-6 h-6 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>

                        <!-- Info Keamanan -->
                        <div class="bg-zinc-900 text-white p-8 rounded-[2.5rem] shadow-xl space-y-4">
                            <div class="flex items-center gap-3 text-amber-400 font-black uppercase tracking-[0.2em] text-[10px]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Jaminan Aman
                            </div>
                            <p class="text-xs text-zinc-400 leading-relaxed">Dana disalurkan 100% setelah dipotong biaya operasional platform (kecuali kategori bencana).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
