@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Riwayat <span class="text-maroon-700">Zakat Masuk</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Pantau dan verifikasi pembayaran zakat dari para muzakki.</p>
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
        <form action="{{ route('admin.zakat_transactions.index') }}" method="GET" class="relative group w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID atau Nama..." class="w-full bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-6 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all shadow-sm font-bold">
            <svg class="w-5 h-5 text-zinc-400 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-maroon-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
    </div>

    <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-50">
                <thead class="bg-zinc-50/50">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Muzakki</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Program Zakat</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Nominal</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($transactions as $item)
                    <tr class="hover:bg-zinc-50/50 transition">
                        <td class="px-10 py-6">
                            <div class="min-w-0">
                                <p class="text-sm font-black text-zinc-900 truncate max-w-[150px]">{{ $item->payer_name }}</p>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $item->transaction_id }}</p>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <p class="text-xs font-bold text-zinc-900 truncate max-w-[200px]">{{ $item->zakat->title }}</p>
                            <p class="text-[9px] font-bold text-maroon-600 uppercase tracking-widest">{{ $item->zakat->asnaf_category }}</p>
                        </td>
                        <td class="px-10 py-6">
                            <p class="text-xs font-black text-maroon-700">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-10 py-6">
                            @if($item->status == 'success')
                                <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">Success</span>
                            @elseif($item->status == 'pending')
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-100">Pending</span>
                            @else
                                <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-100">Failed</span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-right space-x-2">
                            @if($item->status == 'pending')
                            <form action="{{ route('admin.zakat_transactions.confirm', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Konfirmasi zakat ini sebagai BERHASIL?')">
                                @csrf
                                <button class="p-2.5 bg-green-50 text-green-600 hover:bg-green-600 hover:text-white rounded-xl transition shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.zakat_transactions.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data transaksi zakat ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2.5 bg-zinc-50 text-zinc-400 hover:text-red-600 rounded-xl transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center text-zinc-400 font-medium">Belum ada transaksi zakat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-6 bg-zinc-50/30">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
