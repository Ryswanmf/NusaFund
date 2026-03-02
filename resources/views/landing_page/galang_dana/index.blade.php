@extends('layouts.landing')

@section('title', 'Galang Dana - NusaFund')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-maroon-900 py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">Wujudkan Niat Baik Anda Bersama <span class="text-amber-400">NusaFund</span></h1>
            <p class="text-maroon-100 text-lg md:text-xl max-w-3xl mx-auto mb-12 font-medium opacity-90">Mulai penggalangan dana Anda hari ini untuk membantu biaya medis, pendidikan, atau aksi kemanusiaan lainnya dengan mudah dan transparan.</p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('fundraising.create') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-12 py-5 rounded-2xl font-black text-xl shadow-2xl shadow-amber-900/40 transition transform hover:-translate-y-1 active:scale-95">
                    Mulai Galang Dana
                </a>
                <a href="{{ route('fundraising.guide') }}" class="bg-white/10 backdrop-blur-md border-2 border-white/20 hover:bg-white/20 text-white px-12 py-5 rounded-2xl font-bold text-xl transition active:scale-95">
                    Pelajari Cara Kerja
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-white py-12 border-b border-zinc-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-3xl font-black text-maroon-800">1.200+</p>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mt-1">Galang Dana Aktif</p>
                </div>
                <div>
                    <p class="text-3xl font-black text-maroon-800">Rp 45M+</p>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mt-1">Dana Tersalurkan</p>
                </div>
                <div>
                    <p class="text-3xl font-black text-maroon-800">100%</p>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mt-1">Transparan</p>
                </div>
                <div>
                    <p class="text-3xl font-black text-maroon-800">24/7</p>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mt-1">Dukungan Admin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4">Mengapa Menggunakan NusaFund?</h2>
                <p class="text-zinc-500 text-lg">Platform galang dana yang dirancang untuk kenyamanan penggalang dan kepercayaan donatur.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-zinc-100 hover:shadow-xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-maroon-50 text-maroon-700 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-maroon-700 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-zinc-900 mb-4">Proses Cepat</h3>
                    <p class="text-zinc-500 leading-relaxed font-medium">Hanya butuh 5 menit untuk membuat pengajuan. Verifikasi admin dilakukan dalam waktu maksimal 24 jam.</p>
                </div>
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-zinc-100 hover:shadow-xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-zinc-900 mb-4">Aman & Terpercaya</h3>
                    <p class="text-zinc-500 leading-relaxed font-medium">Sistem verifikasi ketat (KYC) untuk memastikan semua kampanye adalah benar dan dapat dipertanggungjawabkan.</p>
                </div>
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-zinc-100 hover:shadow-xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-zinc-900 mb-4">Laporan Real-time</h3>
                    <p class="text-zinc-500 leading-relaxed font-medium">Pantau jumlah donasi yang masuk dan kelola pencairan dana dengan sistem dashboard yang user-friendly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Bottom -->
    <div class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-zinc-900 rounded-[4rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 left-0 w-64 h-64 bg-maroon-600/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight relative z-10">Siap untuk membantu sesama?</h2>
                <p class="text-zinc-400 text-lg mb-12 max-w-2xl mx-auto relative z-10 font-medium">Ribuan donatur di NusaFund siap mendukung niat baik Anda. Buat kampanye sekarang tanpa biaya pendaftaran.</p>
                <a href="{{ route('fundraising.create') }}" class="inline-block bg-white text-zinc-900 px-12 py-5 rounded-full font-black text-xl shadow-xl hover:bg-amber-500 transition relative z-10 transform active:scale-95">
                    Buat Galang Dana Sekarang
                </a>
            </div>
        </div>
    </div>
@endsection
