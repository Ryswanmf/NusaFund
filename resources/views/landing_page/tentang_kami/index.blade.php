@extends('layouts.landing')

@section('title', 'Tentang Kami - NusaFund')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-maroon-800 text-white py-24 lg:py-40 overflow-hidden">
        <!-- Dekorasi Latar Belakang -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-maroon-700/50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block bg-white/10 backdrop-blur-md text-amber-400 px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest mb-8 border border-white/10">
                Mengenal Lebih Dekat
            </span>
            <h1 class="text-4xl md:text-7xl font-black mb-8 leading-[1.1] tracking-tight">
                Mendekatkan <span class="text-amber-400">Kebaikan</span> <br class="hidden md:block"> ke Seluruh Nusantara
            </h1>
            <p class="text-lg md:text-xl text-maroon-50 max-w-3xl mx-auto opacity-90 leading-relaxed font-medium">
                NusaFund hadir sebagai jembatan kepercayaan antara para dermawan dengan mereka yang membutuhkan melalui teknologi transparan, aman, dan amanah.
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
                    <!-- Badge Pengalaman -->
                    <div class="absolute -bottom-10 -right-6 md:-right-10 bg-maroon-800 p-8 rounded-[2.5rem] shadow-2xl text-white max-w-[260px] animate-bounce-slow">
                        <p class="text-5xl font-black text-amber-400 mb-2">2024</p>
                        <p class="text-sm font-bold uppercase tracking-widest leading-relaxed opacity-90">Tahun Berdiri & Mengabdi untuk Indonesia.</p>
                    </div>
                </div>
                
                <div class="space-y-10">
                    <div class="space-y-6">
                        <h2 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">Misi Kami Adalah <br> <span class="text-maroon-700 underline decoration-amber-400 decoration-4 underline-offset-8">Memberdayakan Sesama</span></h2>
                        <p class="text-zinc-500 text-lg leading-relaxed">
                            Berawal dari kegelisahan akan sulitnya akses bantuan yang merata dan transparansi penyaluran, NusaFund dibangun oleh sekelompok pemuda yang percaya bahwa teknologi bisa menjadi alat pemersatu kebaikan.
                        </p>
                    </div>

                    <div class="grid gap-8">
                        @php
                            $missions = [
                                ['num' => '01', 'title' => 'Transparansi Tanpa Batas', 'desc' => 'Setiap rupiah terlacak dari donatur hingga tangan penerima melalui laporan digital realtime.'],
                                ['num' => '02', 'title' => 'Pemberdayaan Berkelanjutan', 'desc' => 'Fokus pada program jangka panjang seperti beasiswa pendidikan dan modal usaha UMKM.'],
                                ['num' => '03', 'title' => 'Teknologi Inklusif', 'desc' => 'Mempermudah siapa saja untuk berbagi hanya dengan beberapa klik melalui perangkat apa pun.']
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

    <!-- Nilai Utama (Core Values) -->
    <section class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-zinc-900 mb-6 tracking-tight">Nilai Utama Kami</h2>
                <p class="text-zinc-500 text-lg leading-relaxed">Prinsip yang kami pegang teguh dalam menjalankan setiap amanah yang Anda berikan.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $values = [
                        [
                            'title' => 'Amanah',
                            'desc' => 'Menjaga setiap kepercayaan sebagai bentuk ibadah dan tanggung jawab moral tertinggi.',
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                        ],
                        [
                            'title' => 'Inovatif',
                            'desc' => 'Terus berkembang dengan teknologi terbaru untuk efisiensi penyaluran bantuan.',
                            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                        ],
                        [
                            'title' => 'Kolaboratif',
                            'desc' => 'Percaya bahwa dampak besar hanya bisa diraih dengan bekerja bersama-sama.',
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                        ]
                    ];
                @endphp

                @foreach($values as $v)
                <div class="bg-white p-12 rounded-[3.5rem] shadow-sm border border-zinc-100 hover:shadow-2xl transition-all duration-500 group text-center">
                    <div class="w-20 h-20 bg-maroon-50 text-maroon-700 rounded-3xl flex items-center justify-center mx-auto mb-10 group-hover:bg-maroon-700 group-hover:text-white transition-colors duration-500 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-zinc-900 mb-4 group-hover:text-maroon-700 transition-colors">{{ $v['title'] }}</h3>
                    <p class="text-zinc-500 leading-relaxed font-medium">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Legality & Stats -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-zinc-900 rounded-[4rem] p-10 md:p-24 text-white relative overflow-hidden shadow-2xl">
                <!-- Dekorasi -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-maroon-600/10 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
                
                <div class="relative z-10 grid lg:grid-cols-2 gap-20 items-center">
                    <div class="space-y-10">
                        <div>
                            <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight">Legalitas & <br><span class="text-amber-400">Kredibilitas Resmi</span></h2>
                            <p class="text-zinc-400 text-lg leading-relaxed mb-8">
                                Kami beroperasi di bawah payung hukum Republik Indonesia, memastikan setiap aktivitas penggalangan dana berjalan sesuai regulasi yang berlaku.
                            </p>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-5 p-6 bg-white/5 border border-white/10 rounded-[2rem] hover:bg-white/10 transition">
                                <div class="w-12 h-12 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-zinc-300 font-bold">Izin Pengepulan Uang dan Barang (PUB) Kemensos RI</p>
                            </div>
                            <div class="flex items-center gap-5 p-6 bg-white/5 border border-white/10 rounded-[2rem] hover:bg-white/10 transition">
                                <div class="w-12 h-12 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-zinc-300 font-bold">Audit Laporan Keuangan Independen Berkala</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 md:gap-8">
                        @php
                            $stats = [
                                ['label' => 'Donatur Aktif', 'value' => '12k+', 'color' => 'text-amber-400'],
                                ['label' => 'Campaign Sukses', 'value' => '500+', 'color' => 'text-amber-400'],
                                ['label' => 'Kota Terjangkau', 'value' => '45+', 'color' => 'text-amber-400'],
                                ['label' => 'Dana Tersalurkan', 'value' => 'Rp 2.5M', 'color' => 'text-amber-400']
                            ];
                        @endphp

                        @foreach($stats as $s)
                        <div class="bg-white/5 backdrop-blur-md p-10 rounded-[3rem] border border-white/10 text-center hover:scale-105 transition-transform duration-500">
                            <p class="text-3xl md:text-4xl font-black {{ $s['color'] }} mb-3">{{ $s['value'] }}</p>
                            <p class="text-[10px] font-black uppercase tracking-widest text-zinc-500">{{ $s['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join CTA -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-3xl mx-auto space-y-10">
                <h2 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">Mari Menjadi Bagian dari <br> <span class="text-maroon-700">Perubahan Nyata</span></h2>
                <p class="text-zinc-500 text-lg leading-relaxed">Sekecil apa pun kebaikan yang Anda berikan, bagi mereka itu adalah harapan besar untuk masa depan.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-5">
                    <a href="{{ route('donasi.index') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-12 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform hover:-translate-y-1 active:scale-95">
                        Donasi Sekarang
                    </a>
                    <a href="{{ route('event.index') }}" class="bg-zinc-100 hover:bg-zinc-200 text-zinc-900 px-12 py-5 rounded-2xl font-black text-xl transition active:scale-95">
                        Ikuti Aksi Relawan
                    </a>
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
