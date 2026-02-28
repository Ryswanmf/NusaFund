@extends('layouts.landing')

@section('title', 'Cara Galang Dana - NusaFund')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-maroon-800 text-white py-20 lg:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">Cara Mulai <span class="text-amber-400">Galang Dana</span></h1>
            <p class="text-lg md:text-xl text-maroon-50 max-w-2xl mx-auto opacity-90 leading-relaxed">
                Wujudkan inisiatif kebaikan Anda dengan langkah-langkah mudah, aman, dan transparan di platform NusaFund.
            </p>
        </div>
        <!-- Decor -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    </section>

    <!-- Steps Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-start">
                <div class="space-y-12">
                    <div class="space-y-4">
                        <h2 class="text-3xl md:text-4xl font-black text-zinc-900 leading-tight">Langkah Mudah <br><span class="text-maroon-700">Mulai Perubahan</span></h2>
                        <p class="text-zinc-500 text-lg">Ikuti prosedur berikut untuk memulai penggalangan dana Anda sendiri.</p>
                    </div>

                    <div class="space-y-10">
                        @foreach($steps as $step)
                        <!-- Step {{ $step->step_number }} -->
                        <div class="flex gap-8 relative">
                            <div class="flex-shrink-0 w-16 h-16 bg-maroon-50 text-maroon-700 rounded-[1.5rem] flex items-center justify-center text-2xl font-black shadow-sm z-10">{{ $step->step_number }}</div>
                            <div class="pt-2">
                                <h4 class="text-xl font-bold text-zinc-900 mb-2">{{ $step->title }}</h4>
                                <p class="text-zinc-500 leading-relaxed">{{ $step->description }}</p>
                            </div>
                            @if(!$loop->last)
                                <div class="absolute left-8 top-16 bottom-[-40px] w-0.5 bg-zinc-100 border-dashed border-l-2"></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="sticky top-32">
                    <div class="bg-zinc-900 rounded-[3rem] p-10 md:p-16 text-white space-y-8 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                        <h3 class="text-2xl font-black leading-tight tracking-tight text-amber-400">Siap Mulai <br>Kebaikan?</h3>
                        <p class="text-zinc-400 font-medium">Pastikan Anda telah menyiapkan berkas identitas dan bukti pendukung untuk mempercepat proses verifikasi tim kami.</p>
                        <div class="pt-6">
                            <a href="{{ route('fundraising.index') }}" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-4 rounded-2xl font-black text-sm transition-all shadow-lg shadow-amber-900/40">Mulai Galang Dana Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-zinc-50 rounded-t-[4rem]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-black text-zinc-900 mb-12 tracking-tight">Pertanyaan Seputar Galang Dana</h2>
            <div class="space-y-4 text-left">
                @foreach($faqs as $faq)
                <div class="bg-white p-8 rounded-3xl border border-zinc-100 shadow-sm">
                    <h4 class="font-bold text-zinc-900 mb-2">{{ $faq->question }}</h4>
                    <p class="text-zinc-500 text-sm leading-relaxed">{{ $faq->answer }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
