@extends('layouts.landing')

@section('title', 'Pusat Bantuan (FAQ) - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Pusat <span class="text-maroon-700">Bantuan</span></h1>
                <p class="text-zinc-500 text-lg font-medium">Temukan jawaban untuk pertanyaan yang paling sering ditanyakan.</p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                @forelse($faqs as $item)
                <div class="bg-white rounded-[2rem] border border-zinc-100 shadow-sm overflow-hidden transition-all duration-300" :class="active === {{ $item->id }} ? 'ring-2 ring-maroon-500 shadow-xl' : ''">
                    <button @click="active = (active === {{ $item->id }} ? null : {{ $item->id }})" class="w-full px-8 py-6 text-left flex items-center justify-between group">
                        <span class="text-lg font-bold text-zinc-900 group-hover:text-maroon-700 transition">{{ $item->question }}</span>
                        <svg class="w-6 h-6 text-zinc-400 transition-transform duration-300" :class="active === {{ $item->id }} ? 'rotate-180 text-maroon-600' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="active === {{ $item->id }}" x-collapse x-cloak>
                        <div class="px-8 pb-8 text-zinc-500 leading-relaxed font-medium whitespace-pre-line border-t border-zinc-50 pt-6">
                            {{ $item->answer }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-zinc-200">
                    <p class="text-zinc-400 font-bold">Belum ada informasi bantuan saat ini.</p>
                </div>
                @endforelse
            </div>

            <!-- Still need help? -->
            <div class="mt-20 p-10 bg-maroon-900 rounded-[3rem] text-center relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-16 -translate-y-16"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-white mb-4">Masih punya pertanyaan lain?</h3>
                    <p class="text-maroon-100 mb-8 opacity-80">Tim dukungan kami siap membantu Anda 24/7 melalui WhatsApp.</p>
                    <a href="https://wa.me/{{ \App\Models\Setting::first()->whatsapp ?? '' }}" class="inline-flex items-center gap-3 bg-amber-500 hover:bg-amber-400 text-maroon-950 px-10 py-4 rounded-2xl font-black transition transform active:scale-95 shadow-xl shadow-amber-900/40">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Hubungi WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
