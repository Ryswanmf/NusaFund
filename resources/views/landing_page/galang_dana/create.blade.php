@extends('layouts.landing')

@section('title', 'Buat Galang Dana - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-3xl md:text-5xl font-black text-zinc-900 mb-4 tracking-tight">Ajukan <span class="text-maroon-700">Galang Dana</span></h1>
                <p class="text-zinc-500 text-lg font-medium">Lengkapi formulir di bawah ini dengan data yang jujur dan akurat.</p>
            </div>

            <form action="{{ route('fundraising.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-12" x-data="{ imageUrl: '' }">
                @csrf
                
                <!-- Section 1: Basic Info -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-maroon-700 text-white flex items-center justify-center font-black">1</div>
                        <h2 class="text-xl font-black text-zinc-900 uppercase tracking-widest text-sm">Informasi Dasar</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Galang Dana</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Contoh: Bantuan Medis untuk Ibu Siti">
                            @error('title') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kategori</label>
                            <select name="category" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900 appearance-none">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}" {{ old('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Target Dana (Min. Rp 1.000.000)</label>
                            <div class="relative">
                                <span class="absolute left-8 top-1/2 -translate-y-1/2 font-black text-zinc-400">Rp</span>
                                <input type="number" name="target_amount" value="{{ old('target_amount') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 pl-16 pr-8 focus:ring-2 focus:ring-maroon-500 font-black text-zinc-900" placeholder="0">
                            </div>
                            @error('target_amount') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Batas Waktu</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 px-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                            @error('end_date') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Story & Media -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-maroon-700 text-white flex items-center justify-center font-black">2</div>
                        <h2 class="text-xl font-black text-zinc-900 uppercase tracking-widest text-sm">Cerita & Media</h2>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Foto Utama (Banner)</label>
                        <div class="relative group">
                            <div class="h-[250px] border-2 border-dashed border-zinc-200 rounded-[2.5rem] flex flex-col items-center justify-center relative hover:bg-zinc-50 transition overflow-hidden group-hover:border-maroon-300">
                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover">
                                </template>
                                <div x-show="!imageUrl" class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Unggah Foto Kampanye</p>
                                </div>
                                <input type="file" name="image" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                            </div>
                        </div>
                        @error('image') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Cerita Lengkap (Min. 100 karakter)</label>
                        <textarea name="description" rows="10" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed" placeholder="Ceritakan siapa yang dibantu, untuk apa dananya, dan mengapa ini mendesak..."></textarea>
                        @error('description') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Section 3: Contact -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-maroon-700 text-white flex items-center justify-center font-black">3</div>
                        <h2 class="text-xl font-black text-zinc-900 uppercase tracking-widest text-sm">Kontak Penggalang</h2>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nomor WhatsApp Aktif</label>
                        <div class="relative">
                            <span class="absolute left-8 top-1/2 -translate-y-1/2 font-black text-zinc-400">+62</span>
                            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-5 pl-20 pr-8 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="">
                        </div>
                        <p class="text-[10px] text-zinc-400 mt-1 pl-2">Kami akan menghubungi Anda melalui nomor ini untuk proses verifikasi.</p>
                        @error('phone') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-8 border-t border-zinc-100">
                    <p class="text-xs text-zinc-400 text-center mb-8 font-medium">Dengan menekan tombol di bawah, Anda menyetujui <a href="{{ route('terms.index') }}" class="text-maroon-700 font-bold underline">Syarat & Ketentuan</a> NusaFund.</p>
                    <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
                        Kirim Pengajuan Galang Dana
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
