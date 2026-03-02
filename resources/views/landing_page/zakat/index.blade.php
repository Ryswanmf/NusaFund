@extends('layouts.landing')

@section('title', 'Program Zakat - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Tunaikan <span class="text-maroon-700">Zakat</span></h1>
                    <p class="text-zinc-500 text-lg leading-relaxed">Sucikan harta dan bantu saudara kita yang membutuhkan melalui program zakat yang amanah dan transparan.</p>
                </div>
                
                <!-- Filter/Search Bar Desktop -->
                <form action="{{ route('zakat.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program zakat..." class="bg-white border border-zinc-200 rounded-2xl py-4 pl-14 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-full md:w-80 shadow-sm font-bold">
                    <svg class="w-6 h-6 text-zinc-400 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within:text-maroon-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
            </div>

            <!-- Categories Chips (Asnaf) -->
            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('zakat.index') }}" class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ !request('category') || request('category') == 'Semua' ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300' }}">
                    Semua
                </a>
                @foreach(['Fakir', 'Miskin', 'Muallaf', 'Fi Sabilillah', 'Umum'] as $cat)
                    <a href="{{ route('zakat.index', ['category' => $cat, 'search' => request('search')]) }}" 
                       class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ request('category') == $cat ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300 hover:text-maroon-700' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Zakat Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($zakats as $item)
                <div class="bg-white rounded-[3rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @php
                            $zakatImage = $item->image;
                            if ($zakatImage && !filter_var($zakatImage, FILTER_VALIDATE_URL)) {
                                $zakatImage = asset('storage/' . $zakatImage);
                            } else {
                                $zakatImage = $zakatImage ?: asset('images/nusafac.png');
                            }
                        @endphp
                        <img src="{{ $zakatImage }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                        
                        <div class="absolute top-6 left-6">
                            <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg border border-white">{{ $item->asnaf_category }}</span>
                        </div>
                    </div>
                    <div class="p-10 flex flex-col flex-1 space-y-6">
                        <div class="space-y-2">
                            <p class="text-[10px] font-black text-maroon-600 uppercase tracking-widest">{{ $item->institution }}</p>
                            <h3 class="text-2xl font-black text-zinc-900 leading-tight line-clamp-2">{{ $item->title }}</h3>
                        </div>
                        
                        <p class="text-zinc-500 text-sm line-clamp-3 leading-relaxed font-medium">
                            {{ $item->description }}
                        </p>

                        <div class="pt-6 border-t border-zinc-50 mt-auto">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Terkumpul</p>
                                    <p class="text-xl font-black text-zinc-900">Rp {{ number_format($item->collected_amount ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-maroon-50 flex items-center justify-center text-maroon-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                            </div>
                            
                            <a href="#" class="block w-full text-center bg-maroon-800 text-white hover:bg-zinc-900 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all duration-300 transform active:scale-95 shadow-xl shadow-maroon-900/20">
                                Bayar Zakat
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-zinc-200">
                    <div class="w-24 h-24 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Program Tidak Ditemukan</h3>
                    <p class="text-zinc-500 font-medium">Belum ada program zakat untuk kategori asnaf ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
