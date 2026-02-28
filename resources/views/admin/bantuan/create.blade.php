@extends('layouts.admin')

@section('content')
<div class="max-w-2xl space-y-10">
    <div>
        <a href="{{ route('admin.bantuan.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Set <span class="text-maroon-700">Bantuan</span></h1>
    </div>

    <form action="{{ isset($dukungan) ? route('admin.bantuan.update', $dukungan) : route('admin.bantuan.store') }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-8">
        @csrf 
        @if(isset($dukungan)) @method('PUT') @endif
        
        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Kategori Bantuan</label>
            <select name="category" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                @foreach(['Donasi', 'Zakat', 'Event', 'Akun', 'Lainnya'] as $cat)
                    <option value="{{ $cat }}" {{ (isset($dukungan) && $dukungan->category == $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pertanyaan</label>
            <input type="text" name="question" value="{{ $dukungan->question ?? '' }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Jawaban</label>
            <textarea name="answer" rows="5" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600">{{ $dukungan->answer ?? '' }}</textarea>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Urutan Tampil (Order)</label>
            <input type="number" name="order" value="{{ $dukungan->order ?? 0 }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
        </div>

        <div class="flex items-center gap-4 p-6 bg-zinc-50 rounded-3xl border border-zinc-100">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ (!isset($dukungan) || $dukungan->is_active) ? 'checked' : '' }} class="w-6 h-6 rounded-lg text-maroon-700 focus:ring-maroon-500 border-zinc-200">
            <label for="is_active" class="font-bold text-zinc-900">Tampilkan Bantuan Ini</label>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            {{ isset($dukungan) ? 'Perbarui Bantuan' : 'Simpan Bantuan' }}
        </button>
    </form>
</div>
@endsection
