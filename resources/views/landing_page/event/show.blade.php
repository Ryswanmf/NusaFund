@extends('layouts.landing')

@section('title', $event->title . ' - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-8 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm font-medium text-zinc-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="/" class="hover:text-maroon-700 transition">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('event.index') }}" class="hover:text-maroon-700 transition">Event</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-zinc-800 truncate max-w-[200px] md:max-w-none">{{ $event->title }}</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Konten Utama -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Hero Image & Badge -->
                    <div class="space-y-8">
                        <div class="relative rounded-[3rem] overflow-hidden shadow-2xl aspect-video border-8 border-white">
                            @php
                                $eventImage = $event->image;
                                if ($eventImage && !filter_var($eventImage, FILTER_VALIDATE_URL)) {
                                    $eventImage = asset('storage/' . $eventImage);
                                } else {
                                    $eventImage = $eventImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $eventImage }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                            
                            <div class="absolute top-6 left-6">
                                <span class="bg-maroon-600/90 backdrop-blur-md text-white text-xs font-black px-6 py-2.5 rounded-full uppercase tracking-widest shadow-lg">{{ $event->category }}</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight tracking-tight">{{ $event->title }}</h1>
                            <div class="flex flex-wrap gap-6 items-center text-zinc-500 font-bold text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-maroon-50 flex items-center justify-center text-maroon-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    Oleh: {{ $event->organizer }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    {{ $event->location }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white p-10 md:p-12 rounded-[3rem] border border-zinc-100 shadow-sm space-y-8">
                        <h2 class="text-2xl font-black text-zinc-900 flex items-center gap-3">
                            <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                            Tentang Event
                        </h2>
                        <div class="prose prose-zinc lg:prose-xl max-w-none text-zinc-600 leading-relaxed whitespace-pre-line font-medium">
                            {{ $event->description }}
                        </div>
                    </div>

                    @if($event->campaign)
                    <!-- Related Campaign Section -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-zinc-400 uppercase tracking-[0.3em] pl-2">Event ini merupakan bagian dari:</h3>
                        
                        <div class="bg-white rounded-[3rem] border border-zinc-100 shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 aspect-video md:aspect-square overflow-hidden">
                                    @php
                                        $campImage = $event->campaign->image;
                                        if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                            $campImage = asset('storage/' . $campImage);
                                        } else {
                                            $campImage = $campImage ?: asset('images/nusafac.png');
                                        }
                                    @endphp
                                    <img src="{{ $campImage }}" alt="{{ $event->campaign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                                </div>
                                <div class="md:w-2/3 p-8 flex flex-col justify-center space-y-6">
                                    <div>
                                        <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-3 inline-block">Campaign Terkait</span>
                                        <h4 class="text-xl font-black text-zinc-900 group-hover:text-maroon-700 transition leading-tight">{{ $event->campaign->title }}</h4>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <div class="flex justify-between items-end mb-2">
                                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Terkumpul</p>
                                                <p class="text-maroon-700 font-black text-sm">Rp {{ number_format($event->campaign->collected_amount, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="w-full bg-zinc-100 h-2 rounded-full overflow-hidden">
                                                @php $percent = ($event->campaign->collected_amount / $event->campaign->target_amount) * 100; @endphp
                                                <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                            </div>
                                            <div class="flex justify-between items-center mt-2 text-[9px] font-black text-zinc-400 uppercase tracking-widest">
                                                <span>Target: {{ $event->campaign->target_amount > 0 ? 'Rp ' . number_format($event->campaign->target_amount, 0, ',', '.') : '∞ Tidak Terbatas' }}</span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    {{ ceil(now()->diffInDays($event->campaign->end_date)) }} Hari Lagi
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <a href="{{ route('donasi.show', $event->campaign->slug) }}" class="inline-flex items-center gap-2 text-maroon-700 font-black text-xs uppercase tracking-widest hover:gap-4 transition-all">
                                            Donasi untuk Campaign Ini
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sisi Rapat: Sidebar Info -->
                <div class="space-y-8">
                    <div class="sticky top-24 space-y-6">
                        <!-- Date & Registration Card -->
                        <div class="bg-white p-10 rounded-[3rem] border border-zinc-100 shadow-2xl space-y-8">
                            <div class="flex items-center gap-6">
                                <div class="bg-maroon-50 rounded-3xl p-4 text-center min-w-[80px]">
                                    <p class="text-3xl font-black text-maroon-700 leading-none">{{ $event->event_date->format('d') }}</p>
                                    <p class="text-[10px] font-black text-maroon-400 uppercase tracking-widest mt-1">{{ $event->event_date->format('M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Waktu Pelaksanaan</p>
                                    <p class="text-lg font-black text-zinc-900">Mulai 09:00 WIB</p>
                                </div>
                            </div>

                            <div class="space-y-4 pt-6 border-t border-zinc-50">
                                <div class="flex justify-between text-sm">
                                    <span class="font-bold text-zinc-400 uppercase tracking-widest text-[10px]">Status</span>
                                    <span class="font-black text-green-600 uppercase tracking-widest text-[10px]">Pendaftaran Dibuka</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-bold text-zinc-400 uppercase tracking-widest text-[10px]">Kuota Peserta</span>
                                    <span class="font-black text-zinc-900 uppercase tracking-widest text-[10px]">{{ $event->quota ?: 'Terbuka Umum' }}</span>
                                </div>
                            </div>

                            <a href="#" class="block w-full text-center bg-zinc-900 text-white hover:bg-maroon-700 py-5 rounded-3xl font-black text-lg shadow-xl shadow-zinc-900/20 transition transform active:scale-95 group">
                                Daftar Sekarang
                                <svg class="w-6 h-6 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>

                        <!-- Info Tambahan -->
                        <div class="bg-maroon-900 text-white p-10 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-16 -translate-y-16"></div>
                            <div class="flex items-center gap-3 text-amber-400 font-black uppercase tracking-[0.2em] text-[10px] relative z-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Informasi
                            </div>
                            <p class="text-xs text-maroon-100 leading-relaxed relative z-10 font-medium">Pastikan Anda hadir 15 menit sebelum acara dimulai untuk proses registrasi ulang di lokasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
