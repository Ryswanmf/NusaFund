@extends('layouts.admin')

@section('content')
<div class="max-w-2xl space-y-10">
    <div>
        <a href="{{ route('admin.kebijakan-privasi.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Set <span class="text-maroon-700">Kebijakan Privasi</span></h1>
    </div>

    <form action="{{ isset($policy) ? route('admin.kebijakan-privasi.update', $policy) : route('admin.kebijakan-privasi.store') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-8">
        @csrf 
        @if(isset($policy)) @method('PUT') @endif
        
        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Judul Kebijakan</label>
            <input type="text" name="title" value="{{ $policy->title ?? '' }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Contoh: Keamanan Data Pengguna">
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Isi Kebijakan</label>
            <textarea name="content" rows="6" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ $policy->content ?? '' }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Urutan</label>
                <input type="number" name="order" value="{{ $policy->order ?? 0 }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
            <div class="flex items-center gap-4 px-6 bg-zinc-50 rounded-2xl border border-zinc-100 mt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ (!isset($policy) || $policy->is_active) ? 'checked' : '' }} class="w-6 h-6 rounded-lg text-maroon-700 focus:ring-maroon-500 border-zinc-200">
                <label for="is_active" class="text-sm font-bold text-zinc-900">Aktif</label>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            {{ isset($policy) ? 'Perbarui Kebijakan' : 'Simpan Kebijakan' }}
        </button>
    </form>
</div>
@endsection
