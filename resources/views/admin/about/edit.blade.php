@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Profil Organisasi</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Perbarui informasi Visi, Misi, dan profil publik NusaFund.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10">
        @csrf @method('PUT')
        
        <!-- Hero Section Content -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-zinc-900 border-b border-zinc-100 pb-4">Bagian Hero (Banner)</h3>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Utama</label>
                <input type="text" name="title" value="{{ $about->title }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi Hero</label>
                <textarea name="hero_description" rows="3" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ $about->hero_description }}</textarea>
            </div>
        </div>

        <!-- Vision & Foundation -->
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Visi Organisasi</label>
                <textarea name="vision" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ $about->vision }}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Tahun Berdiri</label>
                <input type="text" name="founded_year" value="{{ $about->founded_year }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <!-- Mission List -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-zinc-900 border-b border-zinc-100 pb-4">Misi Organisasi</h3>
            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Misi 1</label>
                    <input type="text" name="mission_1" value="{{ $about->mission_1 }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Misi 2</label>
                    <input type="text" name="mission_2" value="{{ $about->mission_2 }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Misi 3</label>
                    <input type="text" name="mission_3" value="{{ $about->mission_3 }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            Simpan Perubahan Profil
        </button>
    </form>
</div>
@endsection
