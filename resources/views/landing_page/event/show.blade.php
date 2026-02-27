@extends('layouts.landing')

@section('title', 'Relawan Pengajar: Cahaya di Ujung Negeri - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-8 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm font-medium text-zinc-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="/" class="hover:text-maroon-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('event.index') }}" class="hover:text-maroon-700">Event</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-zinc-800 truncate">Relawan Pengajar: Cahaya di Ujung Negeri</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Detail Konten -->
                <div class="lg:col-span-2 space-y-10">
                    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl aspect-[21/9]">
                        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1473&auto=format&fit=crop" alt="Event Hero" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 flex flex-wrap gap-4 items-center">
                            <span class="bg-amber-500 text-maroon-950 text-xs font-black px-5 py-2 rounded-full uppercase tracking-widest shadow-xl">#RelawanNusa</span>
                            <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest border border-white/30">Pendidikan</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">Relawan Pengajar: Cahaya di Ujung Negeri</h1>
                        
                        <!-- Event Info Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm flex flex-col items-center text-center">
                                <div class="w-10 h-10 bg-maroon-50 text-maroon-700 rounded-xl flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Tanggal</p>
                                <p class="text-sm font-bold text-zinc-900">15 Maret 2026</p>
                            </div>
                            <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm flex flex-col items-center text-center">
                                <div class="w-10 h-10 bg-maroon-50 text-maroon-700 rounded-xl flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                </div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Lokasi</p>
                                <p class="text-sm font-bold text-zinc-900">Kupang, NTT</p>
                            </div>
                            <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm flex flex-col items-center text-center">
                                <div class="w-10 h-10 bg-maroon-50 text-maroon-700 rounded-xl flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Waktu</p>
                                <p class="text-sm font-bold text-zinc-900">08:00 - Selesai</p>
                            </div>
                            <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm flex flex-col items-center text-center">
                                <div class="w-10 h-10 bg-maroon-50 text-maroon-700 rounded-xl flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Kuota</p>
                                <p class="text-sm font-bold text-zinc-900">12/20 Relawan</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-zinc lg:prose-xl max-w-none text-zinc-600 space-y-8">
                        <div>
                            <h2 class="text-2xl font-black text-zinc-900 mb-4 tracking-tight">Tentang Event</h2>
                            <p>Program "Cahaya di Ujung Negeri" adalah inisiatif kerelawanan untuk membantu meningkatkan kualitas pendidikan di daerah pelosok Nusa Tenggara Timur. Kami mencari para penggerak yang siap berbagi ilmu dan keceriaan bersama adik-adik di sana.</p>
                            <p>Event ini tidak hanya sekedar mengajar, tetapi juga membangun infrastruktur pendidikan dasar dan mendistribusikan alat tulis bagi siswa yang membutuhkan.</p>
                        </div>

                        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm">
                            <h3 class="text-xl font-black text-zinc-900 mb-6 tracking-tight">Apa yang akan Anda dapatkan?</h3>
                            <ul class="space-y-4 font-medium text-zinc-600">
                                <li class="flex items-start gap-4">
                                    <span class="bg-green-100 text-green-600 p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                    <span>Sertifikat Relawan Nasional NusaFund</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="bg-green-100 text-green-600 p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                    <span>Akomodasi dan Konsumsi selama kegiatan</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="bg-green-100 text-green-600 p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>
                                    <span>Pelatihan persiapan kerelawanan (Briefing)</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-black text-zinc-900 mb-6 tracking-tight">Persyaratan Relawan</h3>
                            <ul class="list-disc pl-5 space-y-3">
                                <li>Berusia minimal 18 tahun.</li>
                                <li>Memiliki semangat pengabdian dan cinta dunia pendidikan.</li>
                                <li>Sehat jasmani dan rohani untuk kegiatan di pelosok.</li>
                                <li>Siap mengikuti seluruh rangkaian acara selama 3 hari.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Widget Pendaftaran -->
                <div class="space-y-8">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-2xl space-y-8">
                            <div class="text-center">
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Pendaftaran Berakhir Dalam</p>
                                <div class="flex justify-center gap-3">
                                    <div class="text-center">
                                        <div class="bg-zinc-900 text-white w-12 h-12 rounded-xl flex items-center justify-center text-xl font-black shadow-lg">04</div>
                                        <p class="text-[8px] font-black text-zinc-400 uppercase tracking-widest mt-1">Hari</p>
                                    </div>
                                    <div class="text-center text-zinc-900 font-black text-2xl mt-2">:</div>
                                    <div class="text-center">
                                        <div class="bg-zinc-900 text-white w-12 h-12 rounded-xl flex items-center justify-center text-xl font-black shadow-lg">12</div>
                                        <p class="text-[8px] font-black text-zinc-400 uppercase tracking-widest mt-1">Jam</p>
                                    </div>
                                    <div class="text-center text-zinc-900 font-black text-2xl mt-2">:</div>
                                    <div class="text-center">
                                        <div class="bg-zinc-900 text-white w-12 h-12 rounded-xl flex items-center justify-center text-xl font-black shadow-lg">45</div>
                                        <p class="text-[8px] font-black text-zinc-400 uppercase tracking-widest mt-1">Men</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="block w-full text-center bg-maroon-700 hover:bg-maroon-800 text-white py-5 rounded-2xl font-black text-xl shadow-xl shadow-maroon-900/20 transition transform active:scale-95 group">
                                Daftar Relawan
                                <svg class="w-6 h-6 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>

                            <div class="pt-6 border-t border-zinc-100 space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-maroon-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Penyelenggara</p>
                                        <p class="text-sm font-bold text-zinc-900 leading-tight">Yayasan Nusa Kebaikan</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-maroon-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-1.173-19.257A14.954 14.954 0 002 12.07c0 1.902.353 3.726.992 5.41m9.976-12.056c.566 2.483 1.504 4.816 2.751 6.884m0 0c1.254 2.062 2.703 3.885 4.29 5.427m-4.29-5.427a11.901 11.901 0 01-2.754-5.427m2.754 5.427a11.902 11.902 0 002.754 5.427m-2.754-5.427c-1.254 2.062-2.703 3.885-4.29 5.427m4.29-5.427A11.902 11.902 0 0020 12.07c0-1.902-.353-3.726-.992-5.41m-12.733.044l1.173 19.257"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Platform</p>
                                        <p class="text-sm font-bold text-zinc-900 leading-tight underline decoration-amber-400 decoration-2">Verified by NusaFund</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-500 text-maroon-950 p-8 rounded-[2.5rem] shadow-xl space-y-4">
                            <h4 class="font-black uppercase tracking-widest text-xs">Butuh Bantuan?</h4>
                            <p class="text-xs font-bold leading-relaxed">Hubungi Customer Service kami jika Anda mengalami kesulitan saat melakukan pendaftaran relawan.</p>
                            <a href="#" class="inline-flex items-center gap-2 font-black text-xs uppercase tracking-widest underline decoration-2">Tanya Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
