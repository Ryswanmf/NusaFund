@extends('layouts.admin')

@section('content')
<div class="max-w-5xl space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Pengaturan <span class="text-maroon-700">Website</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Kelola identitas visual, kontak, dan media sosial NusaFund.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-12">
        @csrf @method('PUT')
        
        <!-- Identity & Visuals -->
        <div class="space-y-8">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                Identitas Visual
            </h2>
            <div class="grid md:grid-cols-2 gap-10">
                <!-- Site Logo -->
                <div class="space-y-4" x-data="{ logoUrl: '{{ $setting->site_logo ? asset('storage/' . $setting->site_logo) : '' }}' }">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Logo Website</label>
                    <div class="relative group h-32 w-full bg-zinc-50 rounded-2xl border-2 border-dashed border-zinc-200 flex items-center justify-center overflow-hidden transition hover:border-maroon-300">
                        <template x-if="logoUrl">
                            <img :src="logoUrl" class="h-12 object-contain">
                        </template>
                        <div x-show="!logoUrl" class="text-zinc-300 font-bold text-xs uppercase tracking-tighter">Upload Logo</div>
                        <input type="file" name="site_logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { logoUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    </div>
                    <p class="text-[10px] text-zinc-400 pl-2">Format PNG transparan sangat disarankan.</p>
                </div>

                <!-- Impact Image -->
                <div class="space-y-4" x-data="{ impactUrl: '{{ $setting->impact_image ? asset('storage/' . $setting->impact_image) : '' }}' }">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Impact Image (Samping Testimoni)</label>
                    <div class="relative group h-32 w-full bg-zinc-50 rounded-2xl border-2 border-dashed border-zinc-200 flex items-center justify-center overflow-hidden transition hover:border-maroon-300">
                        <template x-if="impactUrl">
                            <img :src="impactUrl" class="w-full h-full object-cover">
                        </template>
                        <div x-show="!impactUrl" class="text-zinc-300 font-bold text-xs uppercase tracking-tighter">Upload Image</div>
                        <input type="file" name="impact_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { impactUrl = e.target.result; }; reader.readAsDataURL(file); }">
                    </div>
                    <p class="text-[10px] text-zinc-400 pl-2">Gambar ini muncul di samping testimoni landing page.</p>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8 pt-8 border-t border-zinc-50">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                Kontak & Alamat
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email Publik</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">WhatsApp Official</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Alamat Kantor</label>
                <textarea name="address" rows="3" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('address', $setting->address) }}</textarea>
            </div>
        </div>

        <!-- Social Media -->
        <div class="space-y-8 pt-8 border-t border-zinc-50">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                Media Sosial
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach(['facebook', 'instagram', 'youtube', 'twitter'] as $social)
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">{{ ucfirst($social) }} URL</label>
                    <input type="text" name="{{ $social }}" value="{{ old($social, $setting->$social) }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="https://{{ $social }}.com/...">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <div class="space-y-8 pt-8 border-t border-zinc-50">
            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                <span class="w-2 h-8 bg-zinc-900 rounded-full"></span>
                Footer & Legal
            </h2>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Teks Copyright</label>
                <input type="text" name="copyright" value="{{ old('copyright', $setting->copyright) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Seluruh Pengaturan
        </button>
    </form>
</div>
@endsection
