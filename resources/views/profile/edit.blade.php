@extends('layouts.landing')

@section('title', 'Pengaturan Profil - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-zinc-900 tracking-tight">Pengaturan <span class="text-maroon-700">Profil</span></h1>
                    <p class="text-zinc-500 font-medium mt-1">Kelola informasi diri Anda untuk pengalaman donasi yang lebih baik.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-white border border-zinc-200 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-zinc-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-3xl font-bold mb-8 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    Profil Anda telah berhasil diperbarui.
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-12" x-data="{ imageUrl: '{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}' }">
                @csrf
                @method('patch')
                
                <!-- Avatar Section -->
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="relative group">
                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-[2.5rem] bg-zinc-100 border-2 border-dashed border-zinc-200 flex items-center justify-center overflow-hidden transition group-hover:border-maroon-300 relative">
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="w-full h-full object-cover">
                            </template>
                            <div x-show="!imageUrl" class="text-zinc-300 text-center">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-[8px] font-black uppercase tracking-widest">Upload Foto</span>
                            </div>
                            <input type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-maroon-700 text-white rounded-2xl flex items-center justify-center shadow-xl border-4 border-white pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-xl font-black text-zinc-900">Foto Profil</h3>
                        <p class="text-zinc-400 text-sm mt-1 font-medium leading-relaxed">Gunakan foto asli untuk mempermudah koordinasi saat penyerahan bantuan atau verifikasi kampanye.</p>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="space-y-8 pt-8 border-t border-zinc-50">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                            @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nomor WhatsApp</label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 font-black text-zinc-400 text-sm">+62</span>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 pl-16 pr-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="8123456xxx">
                            </div>
                            @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Jenis Kelamin</label>
                            <select name="gender" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900 appearance-none">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Tanggal Lahir</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                            @error('birth_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Alamat Domisili</label>
                        <textarea name="address" rows="3" class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('address', $user->address) }}</textarea>
                        @error('address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-8 border-t border-zinc-50">
                    <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>

            <!-- Password Section Link (Optional Suggestion) -->
            <div class="mt-12 bg-zinc-900 rounded-[3rem] p-10 text-white flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-black">Keamanan Akun</h3>
                    <p class="text-zinc-400 text-sm mt-1 font-medium">Anda juga dapat memperbarui kata sandi secara berkala.</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="bg-white/10 hover:bg-white/20 border-2 border-white/20 px-8 py-3 rounded-2xl font-bold text-sm transition">
                    Ubah Kata Sandi
                </a>
            </div>
        </div>
    </div>
@endsection
