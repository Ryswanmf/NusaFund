@extends('layouts.landing')

@section('title', 'Syarat & Ketentuan - NusaFund')

@section('content')
    <section class="bg-maroon-800 text-white py-20 lg:py-32 overflow-hidden relative text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-4xl md:text-6xl font-black mb-6">Syarat & <span class="text-amber-400">Ketentuan</span></h1>
            <p class="text-lg text-maroon-50 max-w-2xl mx-auto opacity-90">Aturan penggunaan platform untuk menjamin keamanan dan kenyamanan bersama.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-zinc lg:prose-xl max-w-none space-y-16">
                @forelse($terms as $term)
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center font-black text-xl shadow-sm">{{ $loop->iteration }}</div>
                        <h2 class="text-2xl md:text-3xl font-black text-zinc-900 m-0">{{ $term->title }}</h2>
                    </div>
                    <div class="text-zinc-500 leading-relaxed text-lg pl-16">
                        {!! nl2br(e($term->content)) !!}
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-zinc-50 rounded-[3rem] border border-dashed border-zinc-200">
                    <p class="text-zinc-400 font-medium">Data syarat & ketentuan belum tersedia.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-24 p-10 bg-zinc-900 rounded-[3rem] text-center text-white relative overflow-hidden">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full translate-x-1/2 translate-y-1/2"></div>
                <h3 class="text-xl font-bold mb-4">Butuh Pertanyaan Lebih Lanjut?</h3>
                <p class="text-zinc-400 mb-8 max-w-md mx-auto">Jika Anda memiliki pertanyaan mengenai aturan di atas, silakan hubungi tim dukungan kami.</p>
                <a href="{{ route('support.index') }}" class="inline-block bg-amber-500 text-maroon-950 px-8 py-4 rounded-2xl font-black transition hover:bg-amber-400">Pusat Bantuan</a>
            </div>
        </div>
    </section>
@endsection
