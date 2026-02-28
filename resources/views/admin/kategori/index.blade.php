@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Kategori</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Atur kategori kebaikan yang tampil di halaman depan.</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="bg-maroon-800 text-white px-8 py-4 rounded-3xl font-black text-sm hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $cat)
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-zinc-100 flex items-center justify-between group hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-maroon-700 group-hover:text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat->icon_svg }}"></path></svg>
                </div>
                <div>
                    <h3 class="font-black text-zinc-900">{{ $cat->name }}</h3>
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $cat->is_featured ? 'Featured' : 'Regular' }}</p>
                </div>
            </div>
            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('admin.kategori.edit', $cat) }}" class="p-2 bg-zinc-50 text-zinc-400 hover:text-maroon-700 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                <form action="{{ route('admin.kategori.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button class="p-2 bg-zinc-50 text-zinc-400 hover:text-red-600 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
