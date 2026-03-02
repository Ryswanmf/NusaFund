@extends('layouts.landing')

@section('title', 'Event Kemanusiaan - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Agenda <span class="text-maroon-700">Kebaikan</span></h1>
                    <p class="text-zinc-500 text-lg leading-relaxed">Ikuti berbagai kegiatan sosial, seminar, dan aksi nyata untuk menebar manfaat lebih luas.</p>
                </div>
                
                <!-- Filter/Search Bar Desktop -->
                <form action="{{ route('event.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..." class="bg-white border border-zinc-200 rounded-2xl py-4 pl-14 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-full md:w-80 shadow-sm font-bold">
                    <svg class="w-6 h-6 text-zinc-400 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within:text-maroon-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('event.index') }}" class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ !request('category') || request('category') == 'Semua' ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('event.index', ['category' => $cat->name, 'search' => request('search')]) }}" 
                       class="px-8 py-3 rounded-full font-black text-xs uppercase tracking-widest transition transform active:scale-95 {{ request('category') == $cat->name ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'bg-white border border-zinc-200 text-zinc-500 hover:border-maroon-300 hover:text-maroon-700' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Event Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($events as $item)
                <div class="bg-white rounded-[3rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[4/5]">
                        @php
                            $eventImage = $item->image;
                            if ($eventImage && !filter_var($eventImage, FILTER_VALIDATE_URL)) {
                                $eventImage = asset('storage/' . $eventImage);
                            } else {
                                $eventImage = $eventImage ?: asset('images/nusafac.png');
                            }
                        @endphp
                        <img src="{{ $eventImage }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                        
                        <!-- Overlay Info -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8 translate-y-4 group-hover:translate-y-0 transition duration-500">
                            <div class="space-y-3">
                                <div class="flex items-center gap-2 text-white/80 text-[10px] font-black uppercase tracking-widest">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $item->location }}
                                </div>
                                <h3 class="text-2xl font-black text-white leading-tight line-clamp-2">{{ $item->title }}</h3>
                            </div>
                        </div>

                        <!-- Date Badge -->
                        <div class="absolute top-6 left-6 bg-white rounded-2xl p-3 text-center shadow-xl min-w-[60px]">
                            <p class="text-xl font-black text-maroon-700 leading-none">{{ $item->event_date->format('d') }}</p>
                            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">{{ $item->event_date->format('M') }}</p>
                        </div>

                        <div class="absolute top-6 right-6">
                            <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg">{{ $item->category }}</span>
                        </div>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="flex items-center justify-between text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                {{ $item->status == 'active' ? 'Pendaftaran Dibuka' : $item->status }}
                            </div>
                            <div>{{ $item->quota ? $item->quota . ' Kuota' : 'Kuota Tak Terbatas' }}</div>
                        </div>
                        
                        <a href="{{ route('event.show', $item->slug) }}" class="block w-full text-center bg-zinc-900 text-white hover:bg-maroon-700 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all duration-300 transform active:scale-95">
                            Lihat Detail Event
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-zinc-200">
                    <div class="w-24 h-24 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Event Tidak Ditemukan</h3>
                    <p class="text-zinc-500 font-medium">Belum ada agenda kegiatan untuk kategori ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
