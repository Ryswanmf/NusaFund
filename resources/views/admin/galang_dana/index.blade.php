@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Galang Dana</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Verifikasi dan pantau pengajuan penggalangan dana dari user/mitra.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-50">
                <thead class="bg-zinc-50/50">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Pengaju</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Judul Campaign</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($fundraisings as $fund)
                    <tr class="hover:bg-zinc-50/50 transition">
                        <td class="px-10 py-6">
                            <p class="text-sm font-black text-zinc-900">{{ $fund->organization_name }}</p>
                        </td>
                        <td class="px-10 py-6">
                            <p class="text-sm text-zinc-500 font-medium truncate max-w-xs">{{ $fund->title }}</p>
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full 
                                {{ $fund->status == 'active' ? 'bg-green-50 text-green-600' : ($fund->status == 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }}">
                                {{ $fund->status }}
                            </span>
                        </td>
                        <td class="px-10 py-6 text-right space-x-2">
                            <a href="{{ route('admin.galang_dana.edit', $fund) }}" class="inline-flex p-2.5 bg-zinc-50 text-zinc-400 hover:text-maroon-700 rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-20 text-center text-zinc-400 font-medium">Belum ada pengajuan galang dana.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
