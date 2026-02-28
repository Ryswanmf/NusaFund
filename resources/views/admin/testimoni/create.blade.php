@extends('layouts.admin')

@section('content')
<div class="max-w-2xl space-y-10">
    <div>
        <a href="{{ route('admin.testimoni.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Data <span class="text-maroon-700">Testimoni</span></h1>
    </div>

    <form action="{{ isset($testimoni) ? route('admin.testimoni.update', $testimoni) : route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-8">
        @csrf 
        @if(isset($testimoni)) @method('PUT') @endif
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Pemberi</label>
                    <input type="text" name="name" value="{{ $testimoni->name ?? '' }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Peran (Role)</label>
                    <input type="text" name="role" value="{{ $testimoni->role ?? '' }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Contoh: Donatur Rutin">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Profil</label>
                <div class="h-[164px] border-2 border-dashed border-zinc-200 rounded-[2rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition group">
                    <input type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <svg class="w-8 h-8 text-zinc-300 group-hover:text-maroon-600 mb-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs font-bold text-zinc-400">Pilih Foto</span>
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pesan Kesan</label>
            <textarea name="message" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ $testimoni->message ?? '' }}</textarea>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            {{ isset($testimoni) ? 'Perbarui Testimoni' : 'Simpan Testimoni' }}
        </button>
    </form>
</div>
@endsection
