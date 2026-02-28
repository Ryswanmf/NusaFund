@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <a href="{{ route('admin.donasi.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">Kampanye</span></h1>
    </div>

    <form action="{{ route('admin.donasi.update', $campaign) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10">
        @csrf
        @method('PUT')
        
        <!-- Judul & Foto -->
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Kampanye</label>
                    <input type="text" name="title" value="{{ $campaign->title }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kategori</label>
                    <select name="category" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                        @foreach(['Pendidikan', 'Kesehatan', 'Bencana', 'Kemanusiaan', 'Zakat'] as $cat)
                            <option value="{{ $cat }}" {{ $campaign->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Cover</label>
                <div class="relative group h-[164px]">
                    <div class="h-full border-2 border-dashed border-zinc-200 rounded-[2rem] flex flex-col items-center justify-center overflow-hidden relative bg-zinc-50">
                        @if($campaign->image)
                            <img src="{{ asset('storage/' . $campaign->image) }}" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-20 transition">
                        @endif
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="relative z-0 text-center">
                            <svg class="w-8 h-8 text-zinc-300 group-hover:text-maroon-600 mx-auto mb-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs font-bold text-zinc-400">Klik untuk Ganti Foto</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Dana -->
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Target Dana (Rp)</label>
                <input type="number" name="target_amount" value="{{ (int)$campaign->target_amount }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Batas Waktu</label>
                <input type="date" name="end_date" value="{{ $campaign->end_date->format('Y-m-d') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi Lengkap</label>
            <textarea name="description" rows="6" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ $campaign->description }}</textarea>
        </div>

        <!-- Status & Urgent -->
        <div class="grid md:grid-cols-2 gap-6">
            <div class="flex items-center gap-4 p-6 bg-maroon-50 rounded-3xl border border-maroon-100">
                <input type="checkbox" name="is_urgent" id="is_urgent" {{ $campaign->is_urgent ? 'checked' : '' }} class="w-6 h-6 rounded-lg text-maroon-700 focus:ring-maroon-500 border-maroon-200">
                <label for="is_urgent" class="font-bold text-maroon-900">Kampanye Mendesak</label>
            </div>
            <div class="space-y-2">
                <select name="status" class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    <option value="active" {{ $campaign->status == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="completed" {{ $campaign->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="suspended" {{ $campaign->status == 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                </select>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 active:scale-[0.98]">
            Perbarui Kampanye
        </button>
    </form>
</div>
@endsection
