@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Kelola <span class="text-maroon-700">Pusat Bantuan</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Atur dokumentasi FAQ dan panduan bantuan untuk donatur.</p>
        </div>
        <a href="{{ route('admin.bantuan.create') }}" class="bg-maroon-800 text-white px-8 py-4 rounded-3xl font-black text-sm hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Tambah FAQ Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-12">
        @php
            $groupedSupports = $supports->groupBy('category');
        @endphp

        @forelse($groupedSupports as $category => $items)
        <div class="space-y-6">
            <div class="flex items-center gap-4 pl-4">
                <div class="w-2 h-8 bg-amber-500 rounded-full"></div>
                <h3 class="text-xl font-black text-zinc-900 uppercase tracking-wider">{{ $category }}</h3>
                <span class="bg-zinc-100 text-zinc-400 text-[10px] font-black px-2 py-1 rounded-md">{{ $items->count() }} Item</span>
            </div>

            <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-50">
                        <thead class="bg-zinc-50/50">
                            <tr>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] w-1/2">Pertanyaan</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Urutan</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @foreach($items as $s)
                            <tr class="hover:bg-zinc-50/50 transition group">
                                <td class="px-10 py-6">
                                    <p class="text-sm font-bold text-zinc-900 leading-relaxed">{{ $s->question }}</p>
                                    <p class="text-xs text-zinc-400 mt-1 line-clamp-1 italic">{{ Str::limit($s->answer, 100) }}</p>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="w-8 h-8 rounded-lg bg-zinc-50 border border-zinc-100 flex items-center justify-center text-xs font-black text-zinc-400">{{ $s->order }}</span>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full {{ $s->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                        {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right space-x-2">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.bantuan.edit', $s) }}" class="p-3 bg-zinc-50 text-zinc-400 hover:text-maroon-700 hover:bg-maroon-50 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.bantuan.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus bantuan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="p-3 bg-zinc-50 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-20 rounded-[3.5rem] border border-dashed border-zinc-200 text-center">
            <p class="text-zinc-400 font-medium italic">Belum ada data bantuan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
