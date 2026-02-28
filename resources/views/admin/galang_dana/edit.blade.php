@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div>
        <a href="{{ route('admin.galang_dana.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Verifikasi <span class="text-maroon-700">Galang Dana</span></h1>
    </div>

    <form action="{{ route('admin.galang_dana.update', $fundraising) }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-10">
        @csrf @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-10">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Status Persetujuan</label>
                <select name="status" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    <option value="pending" {{ $fundraising->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $fundraising->status == 'active' ? 'selected' : '' }}>Setujui (Aktif)</option>
                    <option value="rejected" {{ $fundraising->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Target Dana Disetujui (Rp)</label>
                <input type="number" name="target_amount" value="{{ (int)$fundraising->target_amount }}" class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>
        </div>

        <div class="p-8 bg-zinc-50 rounded-3xl space-y-4">
            <p class="text-xs font-black text-zinc-400 uppercase tracking-widest">Detail Pengajuan</p>
            <h3 class="text-xl font-bold text-zinc-900">{{ $fundraising->title }}</h3>
            <p class="text-sm text-zinc-600 leading-relaxed">{{ $fundraising->description }}</p>
            <div class="pt-4 border-t border-zinc-200">
                <p class="text-xs text-zinc-400">Pengaju: <span class="font-bold text-zinc-900">{{ $fundraising->organization_name }}</span></p>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
