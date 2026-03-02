@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">Testimoni</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Perbarui pesan atau identitas pemberi testimoni.</p>
        </div>
        <a href="{{ route('admin.testimoni.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
            <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-10" x-data="{ imageUrl: '{{ $testimoni->avatar ? asset('storage/' . $testimoni->avatar) : '' }}' }">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Avatar Upload -->
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto / Avatar</label>
                <div class="relative w-32 h-32 mx-auto md:mx-0 group">
                    <div class="w-full h-full rounded-[2rem] bg-zinc-100 border-2 border-dashed border-zinc-200 flex items-center justify-center overflow-hidden group-hover:border-maroon-300 transition">
                        @if($testimoni->avatar)
                            <img :src="imageUrl" src="{{ asset('storage/' . $testimoni->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="w-full h-full object-cover">
                            </template>
                            <div x-show="!imageUrl" class="text-zinc-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                        <input type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-maroon-700 text-white rounded-xl flex items-center justify-center shadow-lg pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                </div>
                @error('avatar') <p class="text-red-600 text-[10px] font-black mt-2 pl-2">{{ $message }}</p> @enderror
            </div>

            <!-- Identity -->
            <div class="md:col-span-2 space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $testimoni->name) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Jabatan / Status (Role)</label>
                    <input type="text" name="role" value="{{ old('role', $testimoni->role) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pesan Testimoni</label>
            <textarea name="message" rows="5" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('message', $testimoni->message) }}</textarea>
            @error('message') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 p-6 bg-zinc-50 rounded-3xl border border-zinc-100">
            <input type="checkbox" name="is_published" id="is_published" {{ $testimoni->is_published ? 'checked' : '' }} class="w-6 h-6 rounded-lg border-zinc-200 text-maroon-700 focus:ring-maroon-500">
            <label for="is_published" class="text-sm font-black text-zinc-700 cursor-pointer">Publikasikan Testimoni ini ke Halaman Depan</label>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
