@extends('layouts.landing')

@section('title', 'Daftar Donasi - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Campaign <span class="text-maroon-700">Kebaikan</span></h1>
                    <p class="text-zinc-500 text-lg leading-relaxed">Pilih dan salurkan donasi Anda untuk membantu sesama melalui berbagai program yang transparan dan tepat sasaran.</p>
                </div>
                
                <!-- Filter/Search Bar Desktop -->
                <form action="{{ route('donasi.index') }}" method="GET" class="hidden md:flex items-center gap-3">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari donasi..." class="bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all w-64 shadow-sm">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <!-- Categories Chips -->
            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('donasi.index') }}" class="px-6 py-2.5 rounded-full font-bold text-sm transition transform active:scale-95 {{ !request('category') ? 'bg-maroon-700 text-white shadow-lg' : 'bg-white border border-zinc-200 text-zinc-600' }}">Semua</a>
                @foreach(['Pendidikan', 'Kesehatan', 'Bencana', 'Kemanusiaan', 'Zakat'] as $cat)
                    <a href="{{ route('donasi.index', ['category' => $cat]) }}" 
                       class="px-6 py-2.5 rounded-full font-bold text-sm transition transform active:scale-95 {{ request('category') == $cat ? 'bg-maroon-700 text-white shadow-lg' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-maroon-300' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Donation Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($campaigns as $camp)
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @if($camp->image)
                            <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold">NusaFund</div>
                        @endif
                        <div class="absolute top-5 left-5">
                            <span class="bg-maroon-600/90 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $camp->category }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <a href="{{ route('donasi.show', $camp->slug) }}" class="group/title">
                            <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover/title:text-maroon-700 transition">{{ $camp->title }}</h3>
                        </a>
                        
                        <div class="mt-auto space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2 font-semibold">
                                    <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                    <span class="text-maroon-700 font-black">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                    @php $percent = ($camp->collected_amount / $camp->target_amount) * 100; @endphp
                                    <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                <span class="text-maroon-600">{{ round($percent) }}% Tercapai</span>
                                <span class="flex items-center gap-1.5 bg-zinc-50 px-3 py-1 rounded-full">
                                    <svg class="w-3 h-3 text-maroon-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ now()->diffInDays($camp->end_date) }} Hari Lagi
                                </span>
                            </div>
                            <a href="{{ route('donasi.show', $camp->slug) }}" class="block w-full text-center mt-4 bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300 transform active:scale-95">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-zinc-400 font-medium">Belum ada kampanye aktif di kategori ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
