@extends('layouts.admin')

@section('content')
<div class="max-w-2xl space-y-10">
    <div>
        <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Set Kategori</h1>
    </div>

    <form action="{{ isset($kategori) ? route('admin.kategori.update', $kategori) : route('admin.kategori.store') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-8">
        @csrf 
        @if(isset($kategori)) @method('PUT') @endif
        
        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Kategori</label>
            <input type="text" name="name" value="{{ $kategori->name ?? '' }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Ikon SVG Path (Heroicons)</label>
            <textarea name="icon_svg" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600" placeholder="Salin isi atribut d='...' dari SVG Heroicons">{{ $kategori->icon_svg ?? '' }}</textarea>
        </div>

        <div class="flex items-center gap-4 p-6 bg-zinc-50 rounded-3xl border border-zinc-100">
            <input type="checkbox" name="is_featured" id="is_featured" {{ (isset($kategori) && $kategori->is_featured) ? 'checked' : '' }} class="w-6 h-6 rounded-lg text-maroon-700 focus:ring-maroon-500 border-zinc-200">
            <label for="is_featured" class="font-bold text-zinc-900">Tampilkan di Halaman Depan</label>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            {{ isset($kategori) ? 'Perbarui Kategori' : 'Simpan Kategori' }}
        </button>
    </form>
</div>
@endsection
