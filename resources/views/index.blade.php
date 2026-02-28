@extends('layouts.landing')

@section('title', 'NusaFund - Kebaikan untuk Semua')

@section('content')
    <!-- Hero Section Slider -->
    <section class="relative bg-maroon-800 text-white overflow-hidden" 
             x-data="{ 
                activeSlide: 1,
                timer: null,
                slides: [
                    {
                        id: 1,
                        tag: '#IndonesiaBerbagi',
                        title: 'Wujudkan <span class=\'text-amber-400\'>Perubahan</span> Lewat Kebaikan Anda',
                        desc: 'Gabung bersama 12.000+ donatur lainnya untuk membantu sesama melalui donasi, zakat, dan aksi sosial yang transparan.',
                        image: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470&auto=format&fit=crop',
                        cta: 'Mulai Berdonasi',
                        link: '{{ route('donasi.index') }}'
                    },
                    {
                        id: 2,
                        tag: '#PendidikanUntukSemua',
                        title: 'Bantu <span class=\'text-amber-400\'>Anak Bangsa</span> Meraih Cita-Cita',
                        desc: 'Ribuan anak di pelosok negeri menanti uluran tangan Anda untuk mendapatkan fasilitas pendidikan yang layak.',
                        image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1470&auto=format&fit=crop',
                        cta: 'Lihat Program',
                        link: '{{ route('donasi.index') }}'
                    },
                    {
                        id: 3,
                        tag: '#RelawanNusantara',
                        title: 'Jadilah <span class=\'text-amber-400\'>Relawan</span> Aksi Sosial Nyata',
                        desc: 'Jangan hanya berdonasi, terjun langsung ke lapangan dan rasakan kebahagiaan saat membantu sesama.',
                        image: 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1473&auto=format&fit=crop',
                        cta: 'Ikuti Event',
                        link: '{{ route('event.index') }}'
                    }
                ],
                next() { 
                    this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 
                },
                prev() { 
                    this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 
                },
                startTimer() {
                    this.timer = setInterval(() => {
                        this.next();
                    }, 6000);
                },
                stopTimer() {
                    clearInterval(this.timer);
                }
             }" 
             x-init="startTimer()"
             @mouseenter="stopTimer()" 
             @mouseleave="startTimer()">
        
        <!-- Slider Content -->
        <div class="relative min-h-[650px] lg:min-h-[750px] flex items-center">
            <template x-for="slide in slides" :key="slide.id">
                <div x-show="activeSlide === slide.id" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-700"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                     class="absolute inset-0 w-full h-full flex items-center">
                    
                    <!-- Background Decorative Overlay -->
                    <div class="absolute inset-0 bg-maroon-800">
                        <div class="absolute inset-0 opacity-20 pointer-events-none">
                            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <circle cx="100" cy="0" r="40" fill="white" />
                                <circle cx="0" cy="100" r="30" fill="#FBBF24" />
                            </svg>
                        </div>
                    </div>

                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                            <!-- Text Content -->
                            <div class="text-center lg:text-left order-2 lg:order-1">
                                <span class="inline-block bg-amber-500/20 text-amber-400 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8 border border-amber-500/30" x-text="slide.tag"></span>
                                <h1 class="text-4xl md:text-5xl lg:text-7xl font-black mb-8 leading-[1.1] tracking-tight" x-html="slide.title"></h1>
                                <p class="text-lg md:text-xl text-maroon-50 mb-12 max-w-xl mx-auto lg:mx-0 leading-relaxed opacity-80 font-medium" x-text="slide.desc"></p>
                                <div class="flex flex-col sm:flex-row gap-5 justify-center lg:justify-start">
                                    <a :href="slide.link" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-12 py-5 rounded-2xl font-black text-xl shadow-2xl shadow-amber-900/40 transition transform hover:-translate-y-1 active:scale-95">
                                        <span x-text="slide.cta"></span>
                                    </a>
                                    <a href="{{ route('about') }}" class="bg-white/10 backdrop-blur-md border-2 border-white/20 hover:bg-white/20 px-12 py-5 rounded-2xl font-bold text-xl transition active:scale-95">
                                        Tentang Kami
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Image Content -->
                            <div class="hidden lg:block order-1 lg:order-2 relative group">
                                <div class="relative z-10 rounded-[4rem] overflow-hidden shadow-[0_35px_60px_-15px_rgba(0,0,0,0.5)] border-[12px] border-white/10 aspect-[4/3] transform transition duration-1000 group-hover:rotate-0 rotate-2">
                                    <img :src="slide.image" :alt="slide.tag" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-maroon-900/40 via-transparent to-transparent"></div>
                                </div>
                                <!-- Floating Card -->
                                <div class="absolute -bottom-10 -left-10 z-20 bg-white p-8 rounded-[2.5rem] shadow-2xl text-maroon-950 flex items-center gap-6 animate-bounce-slow border border-zinc-100">
                                    <div class="bg-green-100 w-16 h-16 rounded-3xl flex items-center justify-center shadow-inner">
                                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400 mb-1">Status Keamanan</p>
                                        <p class="text-2xl font-black tracking-tight">Verified <span class="text-maroon-700">Amanah</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Slider Controls & Indicators -->
        <div class="absolute bottom-12 left-0 right-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Indicators -->
                <div class="flex gap-3 order-2 md:order-1">
                    <template x-for="slide in slides" :key="slide.id">
                        <button @click="activeSlide = slide.id" 
                                :class="activeSlide === slide.id ? 'w-16 bg-amber-500' : 'w-3 bg-white/20 hover:bg-white/40'" 
                                class="h-3 rounded-full transition-all duration-700 shadow-lg"></button>
                    </template>
                </div>

                <!-- Arrow Navigation -->
                <div class="flex gap-4 order-1 md:order-2">
                    <button @click="prev()" class="w-14 h-14 rounded-2xl bg-white/10 hover:bg-amber-500 hover:text-maroon-950 border border-white/20 flex items-center justify-center transition-all duration-300 backdrop-blur-md group">
                        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="next()" class="w-14 h-14 rounded-2xl bg-white/10 hover:bg-amber-500 hover:text-maroon-950 border border-white/20 flex items-center justify-center transition-all duration-300 backdrop-blur-md group">
                        <svg class="w-6 h-6 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </button>
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
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4 tracking-tight">Pilih Kategori Kebaikan</h2>
                    <p class="text-zinc-500 text-lg">Salurkan bantuan Anda ke sektor yang paling membutuhkan perhatian Anda saat ini.</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-maroon-700 font-bold hover:gap-4 transition-all group">
                    Lihat Semua Kategori 
                    <svg class="w-5 h-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
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
                    <div class="w-16 h-16 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center text-maroon-600 mb-5 group-hover:bg-maroon-600 group-hover:text-white transition-colors duration-300">
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
                                    {{ now()->diffInDays($camp->end_date) }} Hari Lagi
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
@endsection

@push('styles')
    <style>
        .animate-bounce-slow { animation: bounce 3s infinite; }
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
    </style>
@endpush
