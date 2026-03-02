@extends('layouts.admin')

@section('content')
<div class="max-w-5xl space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Profil Organisasi</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Informasi ini akan ditampilkan di halaman "Tentang Kami" untuk publik.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-12" x-data="{ imageUrl: '{{ $about->image ? (filter_var($about->image, FILTER_VALIDATE_URL) ? $about->image : asset('storage/' . $about->image)) : '' }}' }">
        @csrf 
        @method('PUT')
        
        <!-- Hero Section Config -->
        <div class="space-y-8">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                Bagian Hero & Banner
            </h2>
            
            <div class="grid lg:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Utama</label>
                        <input type="text" name="title" value="{{ old('title', $about->title) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi Hero</label>
                        <textarea name="hero_description" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('hero_description', $about->hero_description) }}</textarea>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto / Banner Tentang Kami</label>
                    <div class="relative group">
                        <div class="h-[240px] border-2 border-dashed border-zinc-200 rounded-[2.5rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition overflow-hidden group-hover:border-maroon-300">
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover">
                            </template>
                            <div x-show="!imageUrl" class="flex flex-col items-center justify-center space-y-3">
                                <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Unggah Foto Banner</p>
                            </div>
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                        </div>
                        <div x-show="imageUrl" class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-md text-white text-[10px] font-black px-4 py-2 rounded-full pointer-events-none uppercase tracking-widest border border-white/10">Ganti Foto</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="space-y-8 pt-8 border-t border-zinc-50">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                Visi & Misi
            </h2>
            <div class="grid lg:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Visi Organisasi</label>
                    <textarea name="vision" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('vision', $about->vision) }}</textarea>
                </div>
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Misi Utama (3 Poin)</label>
                    <input type="text" name="mission_1" value="{{ old('mission_1', $about->mission_1) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Misi 1">
                    <input type="text" name="mission_2" value="{{ old('mission_2', $about->mission_2) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Misi 2">
                    <input type="text" name="mission_3" value="{{ old('mission_3', $about->mission_3) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Misi 3">
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="space-y-8 pt-8 border-t border-zinc-50">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                Bagian CTA (Bawah Halaman)
            </h2>
            <div class="grid lg:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul CTA</label>
                    <input type="text" name="cta_title" value="{{ old('cta_title', $about->cta_title) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Teks Tombol Utama</label>
                    <input type="text" name="cta_primary_button" value="{{ old('cta_primary_button', $about->cta_primary_button) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi CTA</label>
                <textarea name="cta_description" rows="3" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('cta_description', $about->cta_description) }}</textarea>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Perubahan Profil
        </button>
    </form>
</div>
@endsection
