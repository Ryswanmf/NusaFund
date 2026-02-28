@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <a href="{{ route('admin.donasi.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Buat <span class="text-maroon-700">Kampanye Baru</span></h1>
    </div>

    <form action="{{ route('admin.donasi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10">
        @csrf
        
        <!-- Judul & Foto -->
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Kampanye</label>
                    <input type="text" name="title" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Contoh: Bantu Bangun Masjid Desa">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kategori</label>
                    <select name="category" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Bencana">Bencana</option>
                        <option value="Kemanusiaan">Kemanusiaan</option>
                        <option value="Zakat">Zakat</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Cover</label>
                <div class="h-[164px] border-2 border-dashed border-zinc-200 rounded-[2rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition group">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <svg class="w-8 h-8 text-zinc-300 group-hover:text-maroon-600 mb-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs font-bold text-zinc-400">Pilih atau Seret Foto</span>
                </div>
            </div>
        </div>

        <!-- Detail Dana -->
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Target Dana (Rp)</label>
                <input type="number" name="target_amount" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="0">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Batas Waktu</label>
                <input type="date" name="end_date" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Deskripsi Lengkap</label>
            <textarea name="description" rows="6" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed" placeholder="Ceritakan detail kampanye ini..."></textarea>
        </div>

        <!-- Urgent Switch -->
        <div class="flex items-center gap-4 p-6 bg-maroon-50 rounded-3xl border border-maroon-100">
            <input type="checkbox" name="is_urgent" id="is_urgent" class="w-6 h-6 rounded-lg text-maroon-700 focus:ring-maroon-500 border-maroon-200">
            <label for="is_urgent" class="font-bold text-maroon-900">Tandai sebagai Kampanye Mendesak</label>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 active:scale-[0.98]">
            Simpan Kampanye
        </button>
    </form>
</div>
@endsection
