@extends('layouts.landing')

@section('title', 'Zakat Diterima - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-[4rem] shadow-2xl border border-zinc-100 overflow-hidden relative">
                <div class="bg-maroon-800 p-8 md:p-10 text-white relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="w-20 h-20 bg-amber-500 rounded-3xl flex items-center justify-center text-maroon-900 mx-auto mb-4 shadow-xl relative z-10">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-black relative z-10 leading-tight">Zakat Berhasil Ditunaikan!</h1>
                    <p class="text-maroon-200 mt-1 text-xs font-medium relative z-10 italic">ID: {{ $payment->transaction_id }}</p>
                </div>

                <div class="p-8 md:p-12 space-y-6">
                    <div class="space-y-3">
                        <p class="text-zinc-500 text-base font-medium">
                            Terima kasih <span class="text-zinc-900 font-black">{{ $payment->payer_name }}</span>, zakat Anda melalui program:
                        </p>
                        <h2 class="text-xl font-black text-maroon-800 leading-tight">"{{ $payment->zakat->title }}"</h2>
                        <p class="text-zinc-500 text-sm">Telah kami terima untuk disalurkan melalu <span class="font-bold text-zinc-900">{{ $payment->zakat->institution }}</span>.</p>
                    </div>

                    <div class="bg-zinc-50 rounded-3xl p-6 flex flex-col md:flex-row justify-between items-center gap-4 border border-zinc-100">
                        <div class="text-left">
                            <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest mb-0.5">Nominal Zakat</p>
                            <p class="text-xl font-black text-maroon-700">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-0.5 bg-green-50 text-green-600 text-[10px] font-black rounded-full border border-green-100">VERIFIED</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                        <a href="{{ route('zakat.index') }}" class="bg-maroon-800 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-maroon-700 transition transform active:scale-95 shadow-xl shadow-maroon-900/20">
                            Zakat Lainnya
                        </a>
                        <a href="{{ route('home') }}" class="bg-white text-zinc-900 px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest border border-zinc-200 hover:bg-zinc-50 transition">
                            Ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            <p class="mt-12 text-zinc-400 text-sm font-medium italic">"Semoga Allah memberkati harta yang Anda simpan dan menyucikan harta yang Anda keluarkan."</p>
        </div>
    </div>
@endsection
