@extends('layouts.landing')

@section('title', 'Tentang Kami - NusaFund')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-maroon-800 text-white py-24 lg:py-40 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-maroon-700/50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block bg-white/10 backdrop-blur-md text-amber-400 px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest mb-8 border border-white/10">
                Mengenal Lebih Dekat
            </span>
            <h1 class="text-4xl md:text-7xl font-black mb-8 leading-[1.1] tracking-tight">
                {{ $about->title }}
            </h1>
            <p class="text-lg md:text-xl text-maroon-50 max-w-3xl mx-auto opacity-90 leading-relaxed font-medium">
                {{ $about->hero_description }}
            </p>
        </div>
    </section>

    <!-- Cerita Kami / Intro -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="rounded-[3.5rem] overflow-hidden shadow-2xl border-8 border-zinc-50 transform -rotate-2 hover:rotate-0 transition duration-700">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1471&auto=format&fit=crop" alt="Team NusaFund" class="w-full h-auto">
                    </div>
                    <div class="absolute -bottom-10 -right-6 md:-right-10 bg-maroon-800 p-8 rounded-[2.5rem] shadow-2xl text-white max-w-[260px] animate-bounce-slow">
                        <p class="text-5xl font-black text-amber-400 mb-2">{{ $about->founded_year }}</p>
                        <p class="text-sm font-bold uppercase tracking-widest leading-relaxed opacity-90">Tahun Berdiri & Mengabdi untuk Indonesia.</p>
                    </div>
                </div>
                
                <div class="space-y-10">
                    <div class="space-y-6">
                        <h2 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">Misi Kami Adalah <br> <span class="text-maroon-700 underline decoration-amber-400 decoration-4 underline-offset-8">Memberdayakan Sesama</span></h2>
                        <p class="text-zinc-500 text-lg leading-relaxed font-medium italic">"{{ $about->vision }}"</p>
                    </div>

                    <div class="grid gap-8">
                        @php
                            $missions = [
                                ['num' => '01', 'title' => 'Transparansi Tanpa Batas', 'desc' => $about->mission_1],
                                ['num' => '02', 'title' => 'Pemberdayaan Berkelanjutan', 'desc' => $about->mission_2],
                                ['num' => '03', 'title' => 'Teknologi Inklusif', 'desc' => $about->mission_3]
                            ];
                        @endphp

                        @foreach($missions as $m)
                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 w-14 h-14 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center font-black text-xl group-hover:bg-maroon-700 group-hover:text-white transition-all duration-300 shadow-sm">
                                {{ $m['num'] }}
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-zinc-900 mb-2">{{ $m['title'] }}</h4>
                                <p class="text-zinc-500 leading-relaxed">{{ $m['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Legality & Stats (Tetap Statis / Ambil dari DB Settings jika diperlukan nanti) -->
    <section class="py-24 bg-zinc-900 text-white overflow-hidden relative shadow-2xl rounded-t-[4rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-8">
                    <h2 class="text-3xl md:text-5xl font-black leading-tight tracking-tight">Kebaikan yang <br><span class="text-amber-400">Terus Tumbuh</span></h2>
                    <p class="text-zinc-400 text-lg leading-relaxed">Bersama ribuan Orang Baik, kita terus melangkah membangun masa depan Indonesia yang lebih inklusif dan penuh kepedulian.</p>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/5 backdrop-blur-md p-10 rounded-[3rem] border border-white/10 text-center">
                        <p class="text-4xl font-black text-amber-400 mb-2">12k+</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-zinc-500">Donatur Aktif</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-md p-10 rounded-[3rem] border border-white/10 text-center">
                        <p class="text-4xl font-black text-amber-400 mb-2">500+</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-zinc-500">Campaign Sukses</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .animate-bounce-slow { animation: bounce 3s infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
    </style>
@endpush
