@extends('layouts.landing')

@section('title', $fundraising->title . ' - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($fundraising->status == 'pending')
            <div class="mb-8 bg-amber-50 border border-amber-200 rounded-3xl p-6 flex items-center gap-4 text-amber-800">
                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-12 0 9 9 0 0112 0z"></path></svg>
                </div>
                <div>
                    <p class="font-black uppercase tracking-widest text-[10px] mb-1">Pratinjau Pengajuan</p>
                    <p class="text-sm font-medium">Halaman ini hanya bisa dilihat oleh Anda. Tim kami sedang memverifikasi pengajuan ini.</p>
                </div>
            </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Left: Content -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white aspect-[16/10]">
                        @if($fundraising->image)
                            <img src="{{ asset('storage/' . $fundraising->image) }}" alt="{{ $fundraising->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-zinc-200 flex items-center justify-center text-zinc-400 font-bold text-3xl">NusaFund</div>
                        @endif
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <span class="bg-maroon-100 text-maroon-700 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em]">{{ $fundraising->category }}</span>
                            <span class="text-zinc-400">•</span>
                            <span class="text-zinc-500 text-xs font-bold">{{ $fundraising->created_at->format('d M Y') }}</span>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">{{ $fundraising->title }}</h1>
                        
                        <div class="flex items-center gap-4 p-6 bg-white rounded-[2rem] border border-zinc-100 w-fit">
                            <div class="w-12 h-12 rounded-2xl bg-zinc-100 flex items-center justify-center text-zinc-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Organisasi Penggalang</p>
                                <p class="font-bold text-zinc-900">{{ $fundraising->organization_name }}</p>
                            </div>
                        </div>

                        <div class="prose prose-zinc max-w-none prose-p:text-zinc-600 prose-p:leading-relaxed prose-p:text-lg">
                            {!! nl2br(e($fundraising->description)) !!}
                        </div>
                    </div>
                </div>

                <!-- Right: Sidebar Info -->
                <div class="space-y-8">
                    <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-zinc-100 shadow-xl sticky top-32">
                        <div class="space-y-6">
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Target Donasi</p>
                                <p class="text-4xl font-black text-maroon-800">Rp {{ number_format($fundraising->target_amount, 0, ',', '.') }}</p>
                            </div>

                            <div class="pt-6 border-t border-zinc-50 space-y-4">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-zinc-500 font-bold">Batas Waktu</span>
                                    <span class="text-zinc-900 font-black">{{ \Carbon\Carbon::parse($fundraising->end_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-zinc-500 font-bold">Status</span>
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">{{ $fundraising->status }}</span>
                                </div>
                            </div>

                            @if($fundraising->status == 'active')
                            <button class="w-full bg-maroon-800 text-white py-5 rounded-2xl font-black text-lg shadow-2xl shadow-maroon-900/30 transform active:scale-95 transition">
                                Donasi Sekarang
                            </button>
                            @else
                            <div class="w-full bg-zinc-100 text-zinc-400 py-5 rounded-2xl font-black text-center text-sm uppercase tracking-widest">
                                Menunggu Verifikasi
                            </div>
                            @endif

                            <div class="pt-6">
                                <p class="text-[10px] font-black text-zinc-300 text-center uppercase tracking-[0.2em]">Bagikan Pratinjau</p>
                                <div class="flex justify-center gap-4 mt-4 opacity-30 pointer-events-none">
                                    <div class="w-10 h-10 rounded-full bg-zinc-100"></div>
                                    <div class="w-10 h-10 rounded-full bg-zinc-100"></div>
                                    <div class="w-10 h-10 rounded-full bg-zinc-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
