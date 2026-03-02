@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Hero Section</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Perbarui konten utama yang tampil di bagian paling atas beranda.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10" x-data="{ imageUrl: '{{ filter_var($hero->image, FILTER_VALIDATE_URL) ? $hero->image : asset('storage/' . $hero->image) }}' }">
        @csrf 
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Tag Label</label>
                    <input type="text" name="tag" value="{{ old('tag', $hero->tag) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="#NusaFund">
                    @error('tag') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Hero (Mendukung HTML)</label>
                    <input type="text" name="title" value="{{ old('title', $hero->title) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    @error('title') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Gambar Hero</label>
                <div class="h-[210px] border-2 border-dashed border-zinc-200 rounded-[2rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition group overflow-hidden">
                    <template x-if="imageUrl">
                        <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover">
                    </template>
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-4 py-2 rounded-full pointer-events-none uppercase tracking-widest">Ganti Foto</div>
                </div>
                @error('image') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi</label>
            <textarea name="description" rows="4" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ old('description', $hero->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Teks Tombol</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $hero->cta_text) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                @error('cta_text') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Link Tujuan</label>
                <input type="text" name="cta_link" value="{{ old('cta_link', $hero->cta_link) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                @error('cta_link') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            Simpan Perubahan Hero
        </button>
    </form>
</div>
@endsection
