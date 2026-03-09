@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Donasi</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Daftar semua kampanye penggalangan dana yang aktif.</p>
        </div>
        <a href="{{ route('admin.donasi.create') }}" class="bg-maroon-800 text-white px-8 py-4 rounded-3xl font-black text-sm hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Buat Kampanye Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-50">
                <thead class="bg-zinc-50/50">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Kampanye</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Target / Terkumpul</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($campaigns as $campaign)
                    <tr class="hover:bg-zinc-50/50 transition">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-12 rounded-2xl bg-zinc-100 overflow-hidden flex-shrink-0 border border-zinc-200">
                                    @php
                                        $campImage = $campaign->image;
                                        if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                            $campImage = asset('storage/' . $campImage);
                                        } else {
                                            $campImage = $campImage ?: asset('images/nusafac.png');
                                        }
                                    @endphp
                                    <img src="{{ $campImage }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-black text-zinc-900 truncate max-w-[200px]">{{ $campaign->title }}</p>
                                    <p class="text-[10px] font-bold text-maroon-600 uppercase tracking-widest">{{ $campaign->category }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-zinc-900">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                <div class="w-32 bg-zinc-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-amber-500 h-full rounded-full" style="width: {{ min(($campaign->collected_amount / $campaign->target_amount) * 100, 100) }}%"></div>
                                </div>
                                <p class="text-[10px] text-zinc-400 font-medium">Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full {{ $campaign->status == 'active' ? 'bg-green-50 text-green-600' : 'bg-zinc-100 text-zinc-400' }}">
                                {{ $campaign->status }}
                            </span>
                        </td>
                        <td class="px-10 py-6 text-right space-x-2">
                            <a href="{{ route('admin.donasi.edit', $campaign) }}" class="inline-flex p-2.5 bg-zinc-50 text-zinc-400 hover:text-maroon-700 rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.donasi.destroy', $campaign) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2.5 bg-zinc-50 text-zinc-400 hover:text-red-600 rounded-xl transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-20 text-center text-zinc-400 font-medium">Belum ada kampanye donasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-6 bg-zinc-50/30">
            {{ $campaigns->links('vendor.pagination.premium') }}
        </div>
    </div>
</div>
@endsection
