@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Daftar <span class="text-maroon-700">Peserta Event</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Pantau siapa saja yang mendaftar pada kegiatan sosial NusaFund.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Search Section -->
    <div class="flex justify-end">
        <form action="{{ route('admin.event_registrations.index') }}" method="GET" class="relative group w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID, Nama, atau Email..." class="w-full bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all shadow-sm font-bold">
            <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-maroon-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
    </div>

    <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-50">
                <thead class="bg-zinc-50/50">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">ID Peserta</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Nama & Email</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">WhatsApp</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Event Terdaftar</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($registrations as $item)
                    <tr class="hover:bg-zinc-50/50 transition">
                        <td class="px-10 py-6">
                            <span class="text-xs font-black text-maroon-700 bg-maroon-50 px-3 py-1 rounded-lg border border-maroon-100">{{ $item->registration_id }}</span>
                        </td>
                        <td class="px-10 py-6">
                            <div class="min-w-0">
                                <p class="text-sm font-black text-zinc-900 truncate max-w-[200px]">{{ $item->name }}</p>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $item->email }}</p>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <p class="text-xs font-bold text-zinc-900">{{ $item->phone }}</p>
                        </td>
                        <td class="px-10 py-6">
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-zinc-900 truncate max-w-[250px]">{{ $item->event->title }}</p>
                                <p class="text-[9px] font-black text-amber-600 uppercase tracking-widest mt-1">{{ $item->event->event_date->format('d M Y') }}</p>
                            </div>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <form action="{{ route('admin.event_registrations.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data pendaftaran peserta ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2.5 bg-zinc-50 text-zinc-400 hover:text-red-600 rounded-xl transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center text-zinc-400 font-medium">Belum ada peserta yang mendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-6 bg-zinc-50/30">
            {{ $registrations->links() }}
        </div>
    </div>
</div>
@endsection
