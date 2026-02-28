@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Hero Slider</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Atur urutan dan konten banner utama di halaman beranda.</p>
        </div>
        <a href="{{ route('admin.hero.create') }}" class="bg-maroon-800 text-white px-8 py-4 rounded-3xl font-black text-sm hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Tambah Slide Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif

    <div class="grid gap-6">
        @foreach($banners as $b)
        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-zinc-100 flex flex-col md:flex-row items-center gap-10 group hover:shadow-xl transition-all duration-500">
            <div class="w-full md:w-64 h-40 rounded-[2rem] overflow-hidden bg-zinc-100 border border-zinc-200 flex-shrink-0">
                @if(filter_var($b->image, FILTER_VALIDATE_URL))
                    <img src="{{ $b->image }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $b->image) }}" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex items-center gap-3">
                    <span class="bg-amber-50 text-amber-600 text-[10px] font-black px-2 py-1 rounded-md uppercase tracking-widest">{{ $b->tag }}</span>
                    <span class="text-zinc-300">/</span>
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Urutan: {{ $b->order }}</span>
                </div>
                <h3 class="text-xl font-black text-zinc-900 line-clamp-1">{!! $b->title !!}</h3>
                <p class="text-sm text-zinc-500 font-medium line-clamp-2">{{ $b->description }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.hero.edit', $b) }}" class="p-4 bg-zinc-50 text-zinc-400 hover:text-maroon-700 hover:bg-maroon-50 rounded-2xl transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <form action="{{ route('admin.hero.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')">
                    @csrf @method('DELETE')
                    <button class="p-4 bg-zinc-50 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
