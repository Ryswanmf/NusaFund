@extends('layouts.landing')

@section('title', 'Event Kebaikan - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-2xl">
                    <span class="inline-block bg-maroon-50 text-maroon-700 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">#AksiNyata</span>
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Event & <span class="text-maroon-700">Aksi Sosial</span></h1>
                    <p class="text-zinc-500 text-lg leading-relaxed">Bergabunglah dalam berbagai kegiatan sosial, kerelawanan, dan webinar inspiratif untuk memberikan dampak langsung bagi masyarakat.</p>
                </div>
                
                <form action="{{ route('event.index') }}" method="GET" class="hidden md:flex items-center gap-3">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari event..." class="bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-64 shadow-sm">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('event.index') }}" class="px-6 py-2.5 rounded-full font-bold text-sm transition transform active:scale-95 {{ !request('category') ? 'bg-maroon-700 text-white shadow-lg' : 'bg-white border border-zinc-200 text-zinc-600' }}">Semua Event</a>
                @foreach(['Relawan', 'Webinar', 'Lingkungan', 'Workshop', 'Penyaluran'] as $cat)
                    <a href="{{ route('event.index', ['category' => $cat]) }}" 
                       class="px-6 py-2.5 rounded-full font-bold text-sm transition transform active:scale-95 {{ request('category') == $cat ? 'bg-maroon-700 text-white shadow-lg' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-maroon-300' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Event Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($events as $event)
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[4/3]">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold">NusaFund</div>
                        @endif
                        <div class="absolute top-5 left-5">
                            <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $event->category }}</span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5">
                            <div class="bg-white/90 backdrop-blur-md p-4 rounded-2xl flex items-center gap-4 shadow-xl">
                                <div class="bg-maroon-50 text-maroon-700 w-12 h-12 rounded-xl flex flex-col items-center justify-center">
                                    <span class="text-lg font-black leading-none">{{ $event->event_date->format('d') }}</span>
                                    <span class="text-[8px] font-black uppercase">{{ $event->event_date->format('M') }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest truncate">{{ $event->location }}</p>
                                    <p class="text-xs font-bold text-zinc-900 truncate">{{ $event->organizer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <a href="{{ route('event.show', $event->slug) }}" class="group/title">
                            <h3 class="text-xl font-bold text-zinc-900 mb-6 line-clamp-2 group-hover/title:text-maroon-700 transition">{{ $event->title }}</h3>
                        </a>
                        
                        <div class="mt-auto pt-6 border-t border-zinc-50 flex items-center justify-between">
                            <div class="flex -space-x-3 overflow-hidden">
                                @foreach([1,2,3] as $i)
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u={{ $event->id + $i }}" alt="">
                                @endforeach
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-zinc-100 ring-2 ring-white text-[10px] font-bold text-zinc-500">+{{ $event->quota ?? rand(10, 50) }}</div>
                            </div>
                            <a href="{{ route('event.show', $event->slug) }}" class="bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all active:scale-95">Ikuti Event</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-zinc-400 font-medium">Belum ada event aktif di kategori ini.</p>
                </div>
                @endforelse
            </div>

            <!-- Join as Organizer -->
            <div class="mt-24 bg-zinc-900 rounded-[3rem] p-10 md:p-20 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-maroon-600/10 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10 max-w-2xl">
                    <h2 class="text-3xl md:text-4xl font-black mb-6 leading-tight">Punya Ide Aksi Sosial? <br>Ayo Kolaborasi!</h2>
                    <p class="text-zinc-400 text-lg mb-10 leading-relaxed">Daftarkan komunitas atau organisasi Anda sebagai mitra penyelenggara event di NusaFund dan temukan ribuan relawan yang siap membantu.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-8 py-4 rounded-2xl font-black transition text-center shadow-lg shadow-amber-900/20">Buat Event Sekarang</a>
                        <a href="#" class="bg-white/10 hover:bg-white/20 px-8 py-4 rounded-2xl font-bold transition text-center border border-white/20">Panduan Penyelenggara</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
