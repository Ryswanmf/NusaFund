@extends('layouts.landing')

@section('title', 'Pendaftaran Berhasil - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <div class="bg-white rounded-[4rem] shadow-2xl border border-zinc-100 overflow-hidden relative">
                <div class="bg-zinc-900 p-12 text-white relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="w-20 h-20 bg-green-500 rounded-3xl flex items-center justify-center text-white mx-auto mb-6 shadow-xl relative z-10">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h1 class="text-3xl font-black relative z-10 leading-tight">Pendaftaran Berhasil!</h1>
                    <p class="text-zinc-400 mt-2 font-medium relative z-10 italic">ID Registrasi: {{ $registration->registration_id }}</p>
                </div>

                <div class="p-10 md:p-16 space-y-8">
                    <div class="space-y-4">
                        <p class="text-zinc-500 text-lg font-medium">
                            Terima kasih <span class="text-zinc-900 font-black">{{ $registration->name }}</span>, Anda telah resmi terdaftar sebagai peserta dalam event:
                        </p>
                        <h2 class="text-2xl font-black text-maroon-800 leading-tight">"{{ $registration->event->title }}"</h2>
                    </div>

                    <div class="bg-zinc-50 rounded-3xl p-8 grid md:grid-cols-2 gap-6 text-left border border-zinc-100">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Waktu</p>
                            <p class="font-bold text-zinc-900">{{ $registration->event->event_date->format('d M Y') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Lokasi</p>
                            <p class="font-bold text-zinc-900 line-clamp-1">{{ $registration->event->location }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                        <a href="{{ route('event.index') }}" class="bg-maroon-800 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-maroon-700 transition transform active:scale-95 shadow-xl shadow-maroon-900/20">
                            Lihat Event Lain
                        </a>
                        <a href="{{ route('home') }}" class="bg-white text-zinc-900 px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest border border-zinc-200 hover:bg-zinc-50 transition">
                            Ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <p class="mt-12 text-zinc-400 text-sm font-medium">Instruksi lebih lanjut akan dikirimkan ke nomor WhatsApp Anda.</p>
        </div>
    </div>
@endsection
