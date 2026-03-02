@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">Kabar Terbaru</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Perbarui informasi perkembangan kampanye Anda.</p>
        </div>
        <a href="{{ route('admin.updates.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
            <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.updates.update', $update) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-10" x-data="{ imageUrl: '{{ $update->image ? asset('storage/' . $update->image) : '' }}' }">
        @csrf
        @method('PUT')
        
        <div class="space-y-8">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pilih Campaign</label>
                <select name="campaign_id" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900 appearance-none">
                    @foreach($campaigns as $camp)
                        <option value="{{ $camp->id }}" {{ old('campaign_id', $update->campaign_id) == $camp->id ? 'selected' : '' }}>{{ $camp->title }}</option>
                    @endforeach
                </select>
                @error('campaign_id') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Kabar</label>
                <input type="text" name="title" value="{{ old('title', $update->title) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                @error('title') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Perkembangan</label>
                <div class="relative group">
                    <div class="h-[250px] border-2 border-dashed border-zinc-200 rounded-[2.5rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition overflow-hidden group-hover:border-maroon-300">
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover">
                        </template>
                        <div x-show="!imageUrl" class="flex flex-col items-center justify-center space-y-3">
                            <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Ganti Foto</p>
                        </div>
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    </div>
                    <div x-show="imageUrl" class="absolute bottom-6 right-6 bg-black/50 backdrop-blur-md text-white text-[10px] font-black px-6 py-2.5 rounded-full pointer-events-none uppercase tracking-widest border border-white/20">Ganti Foto</div>
                </div>
                @error('image') <p class="text-red-600 text-[10px] font-black mt-2 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Isi Kabar / Cerita Perkembangan</label>
                <textarea name="content" rows="8" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('content', $update->content) }}</textarea>
                @error('content') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
