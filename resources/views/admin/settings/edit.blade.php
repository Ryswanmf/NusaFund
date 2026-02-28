@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Pengaturan <span class="text-maroon-700">Website</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Kelola informasi kontak, media sosial, dan teks footer.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-12">
        @csrf @method('PUT')
        
        <!-- Social Media -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-zinc-900 border-b border-zinc-100 pb-4">Media Sosial (URL)</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Facebook</label>
                    <input type="text" name="facebook" value="{{ $setting->facebook }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Instagram</label>
                    <input type="text" name="instagram" value="{{ $setting->instagram }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">YouTube</label>
                    <input type="text" name="youtube" value="{{ $setting->youtube }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Twitter/X</label>
                    <input type="text" name="twitter" value="{{ $setting->twitter }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-zinc-900 border-b border-zinc-100 pb-4">Kontak & Alamat</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email Publik</label>
                    <input type="email" name="email" value="{{ $setting->email }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ $setting->whatsapp }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Alamat Kantor</label>
                <textarea name="address" rows="2" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ $setting->address }}</textarea>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-zinc-900 border-b border-zinc-100 pb-4">Footer & Legal</h3>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Teks Copyright</label>
                <input type="text" name="copyright" value="{{ $setting->copyright }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            Perbarui Pengaturan
        </button>
    </form>
</div>
@endsection
