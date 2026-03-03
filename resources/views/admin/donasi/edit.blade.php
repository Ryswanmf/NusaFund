@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">Kampanye</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Perbarui informasi kampanye penggalangan dana Anda.</p>
        </div>
        <a href="{{ route('admin.donasi.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
            <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.donasi.update', ['donasi' => $campaign->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10" x-data="{ imageUrl: '{{ $campaign->image ? (filter_var($campaign->image, FILTER_VALIDATE_URL) ? $campaign->image : asset('storage/' . $campaign->image)) : '' }}' }">
        @csrf
        @method('PUT')
        
        <div class="space-y-8">
            <!-- Image Upload Section -->
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Utama Kampanye</label>
                <div class="relative group">
                    <div class="h-[300px] border-2 border-dashed border-zinc-200 rounded-[3rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition overflow-hidden group-hover:border-maroon-300">
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover">
                        </template>
                        <div x-show="!imageUrl" class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-maroon-50 rounded-2xl flex items-center justify-center text-maroon-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-xs font-bold text-zinc-400">Klik untuk ganti foto</p>
                        </div>
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    </div>
                    <div x-show="imageUrl" class="absolute bottom-6 right-6 bg-black/50 backdrop-blur-md text-white text-[10px] font-black px-6 py-2.5 rounded-full pointer-events-none uppercase tracking-widest border border-white/20">Ganti Foto</div>
                </div>
                @error('image') <p class="text-red-600 text-[10px] font-black mt-2 pl-2">{{ $message }}</p> @enderror
            </div>

            <!-- Basic Info Section -->
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Kampanye</label>
                    <input type="text" name="title" value="{{ old('title', $campaign->title) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    @error('title') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kategori</label>
                    <select name="category" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900 appearance-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}" {{ old('category', $campaign->category) == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi Lengkap / Cerita</label>
                <textarea name="description" rows="8" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('description', $campaign->description) }}</textarea>
                @error('description') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Target Dana (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-8 top-1/2 -translate-y-1/2 font-black text-zinc-400">Rp</span>
                        <input type="number" name="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 pl-16 pr-8 focus:ring-2 focus:ring-maroon-500 font-black text-zinc-900">
                    </div>
                    @error('target_amount') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Batas Waktu</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    @error('end_date') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Status</label>
                    <select name="status" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900 appearance-none">
                        <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $campaign->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="suspended" {{ old('status', $campaign->status) == 'suspended' ? 'selected' : '' }}>Ditangguhkan (Suspended)</option>
                    </select>
                    @error('status') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 p-8 bg-maroon-50 rounded-3xl border border-maroon-100">
                <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out bg-zinc-200 rounded-full">
                    <input type="checkbox" name="is_urgent" id="is_urgent" {{ $campaign->is_urgent ? 'checked' : '' }} class="absolute w-6 h-6 bg-white border-2 border-zinc-200 rounded-full appearance-none cursor-pointer checked:right-0 checked:bg-maroon-600 checked:border-maroon-600 transition-all duration-200">
                </div>
                <div>
                    <label for="is_urgent" class="text-sm font-black text-maroon-900 cursor-pointer">Tandai sebagai Mendesak</label>
                    <p class="text-[10px] text-maroon-600 font-medium">Kampanye akan diprioritaskan di halaman depan.</p>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
