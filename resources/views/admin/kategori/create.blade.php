@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Tambah <span class="text-maroon-700">Kategori</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Buat kategori baru untuk mengelompokkan kampanye donasi.</p>
        </div>
        <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
            <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.kategori.store') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-10" x-data="{ iconCode: '' }">
        @csrf
        
        <div class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Contoh: Pendidikan">
                @error('name') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kode Ikon (SVG Path)</label>
                    <textarea name="icon_svg" rows="5" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-mono text-xs text-zinc-600 leading-relaxed" placeholder='Contoh: M12 6.253v13m0-13C10.832...' x-model="iconCode"></textarea>
                    <p class="text-[10px] text-zinc-400 mt-2 pl-2">Gunakan path SVG dari Heroicons atau Lucide (hanya bagian d="..." atau seluruh tag &lt;svg&gt;).</p>
                    @error('icon_svg') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                </div>
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pratinjau Ikon</label>
                    <div class="h-[135px] bg-zinc-50 rounded-[2rem] border-2 border-dashed border-zinc-200 flex items-center justify-center text-maroon-600">
                        <template x-if="iconCode">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center">
                                    <template x-if="iconCode.includes('<svg')">
                                        <div class="w-6 h-6 flex items-center justify-center" x-html="iconCode.replace('<svg', '<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'')"></div>
                                    </template>
                                    <template x-if="!iconCode.includes('<svg')">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <template x-if="!iconCode.includes('<path')">
                                                <path :d="iconCode"></path>
                                            </template>
                                            <template x-if="iconCode.includes('<path')">
                                                <g x-html="iconCode"></g>
                                            </template>
                                        </svg>
                                    </template>
                                </div>
                                <span class="text-[9px] font-black uppercase text-zinc-400">Tampilan Ikon</span>
                            </div>
                        </template>
                        <div x-show="!iconCode" class="text-zinc-300 font-bold text-[10px] uppercase">Masukkan kode SVG</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 p-6 bg-zinc-50 rounded-3xl border border-zinc-100">
                <input type="checkbox" name="is_featured" id="is_featured" checked class="w-6 h-6 rounded-lg border-zinc-200 text-maroon-700 focus:ring-maroon-500">
                <label for="is_featured" class="text-sm font-black text-zinc-700 cursor-pointer">Tampilkan di Halaman Depan (Featured)</label>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Kategori
        </button>
    </form>
</div>
@endsection
