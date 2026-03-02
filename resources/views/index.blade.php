@extends('layouts.landing')

@section('title', 'NusaFund - Kebaikan untuk Semua')

@section('content')
    @if($hero)
    <!-- Static Hero Section -->
    <section class="relative bg-maroon-800 text-white overflow-hidden">
        <!-- Background Decorative Overlay -->
        <div class="absolute inset-0 bg-maroon-800">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <circle cx="100" cy="0" r="40" fill="white" />
                    <circle cx="0" cy="100" r="30" fill="#FBBF24" />
                </svg>
            </div>
        </div>

        <div class="relative min-h-[550px] lg:min-h-[700px] flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 py-12 lg:py-0">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <!-- Text Content -->
                    <div class="text-center lg:text-left order-2 lg:order-1">
                        <span class="inline-block bg-amber-500/20 text-amber-400 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-[0.2em] mb-6 lg:mb-8 border border-amber-500/30">
                            {{ $hero->tag }}
                        </span>
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-6 lg:mb-8 leading-[1.1] tracking-tight">
                            {!! $hero->title !!}
                        </h1>
                        <p class="text-lg md:text-xl text-maroon-50 mb-10 lg:mb-12 max-w-xl mx-auto lg:mx-0 leading-relaxed opacity-80 font-medium">
                            {{ $hero->description }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-5 justify-center lg:justify-start">
                            <a href="{{ $hero->cta_link }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-10 lg:px-12 py-4 lg:py-5 rounded-2xl font-black text-lg lg:text-xl shadow-2xl shadow-amber-900/40 transition transform hover:-translate-y-1 active:scale-95">
                                {{ $hero->cta_text }}
                            </a>
                            <a href="{{ route('about') }}" class="bg-white/10 backdrop-blur-md border-2 border-white/20 hover:bg-white/20 px-10 lg:px-12 py-4 lg:py-5 rounded-2xl font-bold text-lg lg:text-xl transition active:scale-95">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                    
                    <!-- Image Content -->
                    <div class="order-1 lg:order-2 relative group px-4 lg:px-0">
                        <div class="relative z-10 rounded-[3rem] lg:rounded-[4rem] overflow-hidden shadow-[0_35px_60px_-15px_rgba(0,0,0,0.5)] border-8 lg:border-[12px] border-white/10 aspect-[4/3] transform transition duration-1000 rotate-2">
                            @php
                                $heroImage = $hero->image;
                                if (!filter_var($heroImage, FILTER_VALIDATE_URL)) {
                                    $heroImage = $heroImage ? asset('storage/' . $heroImage) : asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $heroImage }}" alt="{{ $hero->tag }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-maroon-900/40 via-transparent to-transparent"></div>
                        </div>
                        <!-- Floating Card -->
                        <div class="absolute -bottom-6 lg:-bottom-10 -left-2 lg:-left-10 z-20 bg-white p-5 lg:p-8 rounded-[2rem] lg:rounded-[2.5rem] shadow-2xl text-maroon-950 flex items-center gap-4 lg:gap-6 animate-bounce-slow border border-zinc-100">
                            <div class="bg-green-100 w-12 h-12 lg:w-16 lg:h-16 rounded-2xl lg:rounded-3xl flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[8px] lg:text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400 mb-0.5 lg:mb-1">Status Keamanan</p>
                                <p class="text-xl lg:text-2xl font-black tracking-tight">Verified <span class="text-maroon-700">Amanah</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

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
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4 tracking-tight">Pilih Kategori Kebaikan</h2>
                    <p class="text-zinc-500 text-lg">Salurkan bantuan Anda ke sektor yang paling membutuhkan perhatian Anda saat ini.</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-maroon-700 font-bold hover:gap-4 transition-all group">
                    Lihat Semua Kategori 
                    <svg class="w-5 h-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $cat)
                <a href="{{ route('donasi.index', ['category' => $cat->name]) }}" class="bg-white p-8 rounded-[2rem] shadow-sm border border-zinc-100 flex flex-col items-center text-center hover:shadow-xl hover:border-maroon-200 transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center text-maroon-600 mb-5 group-hover:bg-maroon-600 group-hover:text-white transition-colors duration-300">
                        @if($cat->icon_svg)
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                @if(str_contains($cat->icon_svg, '<path') || str_contains($cat->icon_svg, '<svg'))
                                    {!! $cat->icon_svg !!}
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{!! $cat->icon_svg !!}"></path>
                                @endif
                            </svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        @endif
                    </div>
                    <span class="font-bold text-zinc-800">{{ $cat->name }}</span>
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
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4 tracking-tight">Donasi <span class="text-maroon-700">Mendesak</span></h2>
                    <p class="text-zinc-500 text-lg">Waktu sangat berharga bagi mereka. Ulurkan tangan Anda sekarang untuk campaign di bawah ini.</p>
                </div>
                <a href="{{ route('donasi.index') }}" class="inline-flex items-center gap-2 text-maroon-700 font-bold hover:gap-4 transition-all group">
                    Lihat Semua Campaign 
                    <svg class="w-5 h-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($urgentCampaigns as $camp)
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @if($camp->image)
                            <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold tracking-tighter text-2xl">NusaFund</div>
                        @endif
                        <div class="absolute top-5 left-5">
                            <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $camp->is_urgent ? 'Mendesak' : $camp->category }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <a href="{{ route('donasi.show', $camp->slug) }}" class="group/title">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover/title:text-maroon-700 transition">{{ $camp->title }}</h3>
                        </a>
                        
                        <div class="mt-auto space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2 font-semibold">
                                    <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                    <span class="text-maroon-700 font-black">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                    @php $percent = ($camp->collected_amount / $camp->target_amount) * 100; @endphp
                                    <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                <span class="text-maroon-600">{{ round($percent) }}% Tercapai</span>
                                <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                    <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ ceil(now()->diffInDays($camp->end_date)) }} Hari Lagi
                                </span>
                            </div>
                            <a href="{{ route('donasi.show', $camp->slug) }}" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-zinc-400 font-medium">Belum ada kampanye aktif saat ini.</p>
                </div>
                @endforelse
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
                        @forelse($testimonials as $t)
                        <!-- Testi Item -->
                        <div class="bg-zinc-50 p-8 rounded-[2rem] border border-zinc-100 flex flex-col md:flex-row gap-6 hover:shadow-xl transition-all duration-500 group">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-2xl bg-maroon-100 flex items-center justify-center text-maroon-600 shadow-inner overflow-hidden">
                                    @if($t->avatar)
                                        <img src="{{ asset('storage/' . $t->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H20.017C21.1216 4 22.017 4.89543 22.017 6V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM2.01697 21L2.01697 18C2.01697 16.8954 2.9124 16 4.01697 16H7.01697C7.56925 16 8.01697 15.5523 8.01697 15V9C8.01697 8.44772 7.56925 8 7.01697 8H3.01697C2.46468 8 2.01697 7.55228 2.01697 7V5C2.01697 4.44772 2.46468 4 3.01697 4H8.01697C9.12154 4 10.017 4.89543 10.017 6V15C10.017 18.3137 7.33068 21 4.01697 21H2.01697Z"></path></svg>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-zinc-600 text-lg leading-relaxed mb-6 font-medium italic">"{{ $t->message }}"</p>
                                <div class="flex items-center gap-4">
                                    <div>
                                        <p class="font-bold text-zinc-900 group-hover:text-maroon-700 transition-colors">{{ $t->name }}</p>
                                        <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider">{{ $t->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-zinc-400 font-medium">Belum ada kisah kebaikan.</p>
                        @endforelse
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-zinc-50 transform -rotate-3 hover:rotate-0 transition duration-700">
                        @php
                            $setting = \App\Models\Setting::first();
                            $impactImage = ($setting && $setting->impact_image) ? asset('storage/' . $setting->impact_image) : 'https://images.unsplash.com/photo-1509059852496-f3822ae057bf?q=80&w=1481&auto=format&fit=crop';
                        @endphp
                        <img src="{{ $impactImage }}" alt="Impact Image" class="w-full h-auto aspect-[4/5] object-cover">
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
                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight">{{ $about->cta_title }}</h2>
                    <p class="text-maroon-100 text-xl mb-12 opacity-90 leading-relaxed">{{ $about->cta_description }}</p>
                    
                    <div class="flex flex-col sm:flex-row gap-5 justify-center">
                        <a href="{{ route('fundraising.index') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-900 px-12 py-5 rounded-full font-black text-xl shadow-2xl shadow-amber-950/40 transition transform hover:-translate-y-1 active:scale-95">
                            {{ $about->cta_primary_button }}
                        </a>
                        <a href="{{ route('about') }}" class="bg-white/10 backdrop-blur-md border-2 border-white/20 hover:bg-white/20 px-12 py-5 rounded-full font-bold text-xl transition">
                            {{ $about->cta_secondary_button }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .animate-bounce-slow { animation: bounce 3s infinite; }
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
    </style>
@endpush
