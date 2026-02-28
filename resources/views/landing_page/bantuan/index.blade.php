@extends('layouts.landing')

@section('title', 'Pusat Bantuan - NusaFund')

@section('content')
    <!-- Hero Section -->
    <section class="bg-maroon-800 text-white py-24 lg:py-36 overflow-hidden relative">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="10" cy="10" r="30" fill="white" />
                <circle cx="90" cy="90" r="40" fill="white" />
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-block bg-white/10 backdrop-blur-md text-amber-400 px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest mb-6 border border-white/10">Help Center</span>
            <h1 class="text-4xl md:text-7xl font-black mb-8 leading-tight">Ada yang bisa <br> kami <span class="text-amber-400">bantu?</span></h1>
            
            <!-- Search Bar FAQ (Placeholder UI) -->
            <div class="max-w-2xl mx-auto relative group">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none text-zinc-400 group-focus-within:text-amber-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" 
                       placeholder="Cari topik bantuan..." 
                       class="w-full bg-white text-zinc-900 border-none rounded-[2rem] py-6 pl-16 pr-8 text-lg shadow-2xl focus:ring-4 focus:ring-amber-500/20 transition-all font-medium">
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-24 bg-white" x-data="{ 
        activeCategory: '{{ $faqs->keys()->first() }}', 
        activeFaq: null
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-12 lg:gap-20">
                
                <!-- Navigasi Kategori -->
                <div class="space-y-3">
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-8 pl-4">Topik Bantuan</p>
                    @foreach($faqs as $category => $items)
                    <button @click="activeCategory = '{{ $category }}'; activeFaq = null" 
                            :class="activeCategory === '{{ $category }}' ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20 translate-x-2' : 'text-zinc-500 hover:bg-zinc-50'"
                            class="w-full text-left px-6 py-4 rounded-2xl font-black transition-all duration-300 flex items-center justify-between group">
                        <span>{{ $category }}</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    @endforeach
                </div>

                <!-- FAQ List -->
                <div class="lg:col-span-3 space-y-8">
                    @foreach($faqs as $category => $items)
                    <div x-show="activeCategory === '{{ $category }}'" 
                         x-transition:enter="transition ease-out duration-500" 
                         x-transition:enter-start="opacity-0 translate-y-10"
                         class="space-y-8">
                        
                        <h2 class="text-3xl font-black text-zinc-900 mb-8 pl-2">Seputar <span class="text-maroon-700">{{ $category }}</span></h2>

                        <div class="grid gap-4">
                            @foreach($items as $item)
                            <div class="bg-zinc-50 rounded-[2.5rem] overflow-hidden border border-zinc-100 transition-all duration-500 hover:border-maroon-200"
                                 :class="activeFaq === {{ $item->id }} ? 'bg-white ring-1 ring-zinc-200 shadow-2xl' : ''">
                                <button @click="activeFaq === {{ $item->id }} ? activeFaq = null : activeFaq = {{ $item->id }}" 
                                        class="w-full flex justify-between items-center p-8 text-left focus:outline-none group">
                                    <span class="font-bold text-zinc-800 text-lg md:text-xl group-hover:text-maroon-700 transition-colors">{{ $item->question }}</span>
                                    <span class="ml-4 flex-shrink-0 w-10 h-10 rounded-2xl bg-white flex items-center justify-center transition-all duration-500 transform border border-zinc-100 shadow-sm"
                                          :class="activeFaq === {{ $item->id }} ? 'rotate-180 bg-maroon-800 text-white' : ''">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                    </span>
                                </button>
                                <div x-show="activeFaq === {{ $item->id }}" x-transition class="px-8 pb-10">
                                    <div class="prose prose-zinc max-w-none text-zinc-500 text-lg border-t border-zinc-100 pt-8">
                                        {!! nl2br(e($item->answer)) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
