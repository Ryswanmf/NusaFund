@extends('layouts.landing')

@section('title', 'Kebijakan Privasi - NusaFund')

@section('content')
    <section class="bg-maroon-800 text-white py-20 lg:py-32 overflow-hidden relative text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-6xl font-black mb-6">Kebijakan <span class="text-amber-400">Privasi</span></h1>
            <p class="text-lg text-maroon-50 max-w-2xl mx-auto opacity-90">Bagaimana kami menjaga dan melindungi data pribadi Anda di NusaFund.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-zinc lg:prose-xl max-w-none space-y-16">
                @forelse($policies as $p)
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-amber-50 text-maroon-700 rounded-2xl flex items-center justify-center font-black text-xl shadow-sm border border-amber-100">{{ $loop->iteration }}</div>
                        <h2 class="text-2xl md:text-3xl font-black text-zinc-900 m-0">{{ $p->title }}</h2>
                    </div>
                    <div class="text-zinc-500 leading-relaxed text-lg pl-16">
                        {!! nl2br(e($p->content)) !!}
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-zinc-50 rounded-[3rem] border border-dashed border-zinc-200">
                    <p class="text-zinc-400 font-medium">Data kebijakan privasi belum tersedia.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-24 p-12 bg-zinc-50 rounded-[4rem] border border-zinc-100">
                <h3 class="text-2xl font-black text-zinc-900 mb-6 tracking-tight text-center">Komitmen Keamanan Kami</h3>
                <div class="grid md:grid-cols-2 gap-8 mt-10">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-zinc-100 flex gap-5">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <p class="text-sm text-zinc-500 leading-relaxed font-medium">Data transaksi dienkripsi menggunakan standar keamanan SSL tertinggi.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-zinc-100 flex gap-5">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <p class="text-sm text-zinc-500 leading-relaxed font-medium">Informasi pribadi hanya digunakan untuk kepentingan laporan donasi resmi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
