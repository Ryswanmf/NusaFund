@extends('layouts.landing')

@section('title', 'Pendaftaran Event - ' . $event->title)

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex items-center justify-between">
                <a href="{{ route('event.show', $event->slug) }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
                    <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Detail Event
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Form -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 p-8 md:p-12">
                        <form action="{{ route('event.submit', $event->slug) }}" method="POST" class="space-y-10">
                            @csrf
                            
                            <div class="space-y-6">
                                <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                                    <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                                    Data Peserta
                                </h2>
                                
                                @guest
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                                            <input type="text" name="name" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Nama Anda">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email Aktif</label>
                                            <input type="email" name="email" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="email@contoh.com">
                                        </div>
                                    </div>
                                @else
                                    <div class="p-6 bg-zinc-50 rounded-3xl border border-zinc-100 flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-black">
                                            {{ substr(Auth::user()->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-black text-zinc-400 uppercase tracking-widest">Mendaftar sebagai:</p>
                                            <p class="font-black text-zinc-900">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                @endguest

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nomor WhatsApp</label>
                                    <div class="relative">
                                        <span class="absolute left-6 top-1/2 -translate-y-1/2 font-black text-zinc-400 text-sm">+62</span>
                                        <input type="text" name="phone" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 pl-16 pr-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="8123456xxx">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" rows="3" class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed" placeholder="Misal: Saya membawa 1 teman..."></textarea>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-xl uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
                                Konfirmasi Pendaftaran
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Sisi Kanan: Summary -->
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-[3rem] border border-zinc-100 shadow-sm space-y-6">
                        <div class="rounded-3xl overflow-hidden aspect-video border border-zinc-50">
                            @php
                                $eventImage = $event->image;
                                if ($eventImage && !filter_var($eventImage, FILTER_VALIDATE_URL)) {
                                    $eventImage = asset('storage/' . $eventImage);
                                } else {
                                    $eventImage = $eventImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $eventImage }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-maroon-600 uppercase tracking-widest mb-1">{{ $event->category }}</p>
                            <h3 class="font-black text-zinc-900 leading-snug">{{ $event->title }}</h3>
                            <div class="mt-4 flex items-center gap-2 text-zinc-400 text-xs font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $event->event_date->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
