@extends('layouts.admin')

@section('content')
    <div class="space-y-10">
        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-zinc-900 tracking-tight">Selamat Datang, <span class="text-maroon-700">Admin!</span></h1>
                <p class="text-zinc-500 mt-2 font-medium">Berikut adalah ringkasan performa kebaikan NusaFund hari ini.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-zinc-200 px-6 py-3 rounded-2xl font-bold text-sm text-zinc-600 hover:bg-zinc-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Unduh Laporan
                </button>
                <button class="bg-maroon-800 text-white px-6 py-3 rounded-2xl font-black text-sm hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Campaign Baru
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $stats = [
                    ['label' => 'Total Donasi', 'value' => 'Rp 2.58M', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'trend' => '+15.2%', 'color' => 'amber'],
                    ['label' => 'Campaign Aktif', 'value' => '124', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'trend' => 'Normal', 'color' => 'maroon'],
                    ['label' => 'Donatur Baru', 'value' => '856', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'trend' => '+4.1%', 'color' => 'blue'],
                    ['label' => 'Zakat Terkumpul', 'value' => 'Rp 450jt', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'trend' => '+2.5%', 'color' => 'green']
                ];
            @endphp

            @foreach($stats as $s)
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-zinc-100 flex flex-col justify-between hover:shadow-xl transition-all duration-300 group overflow-hidden relative">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-zinc-50 rounded-full group-hover:scale-110 transition-transform duration-500 opacity-50"></div>
                
                <div class="relative z-10 flex items-center justify-between mb-6">
                    <div class="p-4 bg-zinc-50 text-maroon-800 rounded-[1.5rem] group-hover:bg-maroon-800 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"></path></svg>
                    </div>
                    <span class="text-xs font-black {{ $s['trend'] == 'Normal' ? 'text-zinc-400' : 'text-green-500' }} bg-zinc-50 px-3 py-1 rounded-full border border-zinc-100">{{ $s['trend'] }}</span>
                </div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-1">{{ $s['label'] }}</p>
                    <p class="text-3xl font-black text-zinc-900 tracking-tight">{{ $s['value'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Secondary Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Table Section -->
            <div class="lg:col-span-2 bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-zinc-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-zinc-900">Transaksi <span class="text-maroon-700">Terbaru</span></h3>
                        <p class="text-xs text-zinc-400 font-bold mt-1 uppercase tracking-widest">10 Menit Terakhir</p>
                    </div>
                    <button class="p-3 bg-zinc-50 text-zinc-400 hover:text-maroon-700 rounded-2xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-50">
                        <thead class="bg-zinc-50/30">
                            <tr>
                                <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Donatur</th>
                                <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Program</th>
                                <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Nominal</th>
                                <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @foreach([
                                ['name' => 'Ahmad Syarif', 'camp' => 'Renovasi NTT', 'amount' => 'Rp 1.000.000', 'status' => 'Berhasil'],
                                ['name' => 'Siti Aminah', 'camp' => 'Zakat Profesi', 'amount' => 'Rp 450.000', 'status' => 'Berhasil'],
                                ['name' => 'Donatur Anonim', 'camp' => 'Bencana Luwu', 'amount' => 'Rp 5.000.000', 'status' => 'Pending'],
                                ['name' => 'Budi Santoso', 'camp' => 'Sedekah Pangan', 'amount' => 'Rp 100.000', 'status' => 'Berhasil'],
                                ['name' => 'Rina Wijaya', 'camp' => 'Beasiswa Yatim', 'amount' => 'Rp 2.500.000', 'status' => 'Berhasil']
                            ] as $t)
                            <tr class="hover:bg-zinc-50/50 transition">
                                <td class="px-10 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-maroon-50 text-maroon-700 flex items-center justify-center text-xs font-black">{{ substr($t['name'], 0, 1) }}</div>
                                        <span class="text-sm font-bold text-zinc-900">{{ $t['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 whitespace-nowrap text-sm text-zinc-500 font-medium">{{ $t['camp'] }}</td>
                                <td class="px-10 py-6 whitespace-nowrap text-sm font-black text-zinc-900">{{ $t['amount'] }}</td>
                                <td class="px-10 py-6 whitespace-nowrap">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full {{ $t['status'] == 'Berhasil' ? 'text-green-600 bg-green-50' : 'text-amber-600 bg-amber-50' }}">
                                        {{ $t['status'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Campaign Alert Section -->
            <div class="bg-maroon-900 rounded-[3.5rem] p-10 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10 space-y-8">
                    <h3 class="text-2xl font-black leading-tight">Perlu Tindakan <br><span class="text-amber-400">Segera</span></h3>
                    
                    <div class="space-y-4">
                        <div class="p-5 bg-white/10 rounded-3xl border border-white/10 backdrop-blur-md">
                            <p class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-1">Pencairan Dana</p>
                            <p class="text-sm font-bold truncate">Bantu Renovasi NTT - Rp 15jt</p>
                        </div>
                        <div class="p-5 bg-white/10 rounded-3xl border border-white/10 backdrop-blur-md">
                            <p class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-1">Verifikasi User</p>
                            <p class="text-sm font-bold truncate">Yayasan Generasi Madani</p>
                        </div>
                        <div class="p-5 bg-white/10 rounded-3xl border border-white/10 backdrop-blur-md">
                            <p class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-1">Laporan Baru</p>
                            <p class="text-sm font-bold truncate">Update Penyaluran Luwu</p>
                        </div>
                    </div>

                    <a href="#" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-4 rounded-2xl font-black text-sm transition shadow-lg shadow-amber-950/40">
                        Buka Semua Notifikasi
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
