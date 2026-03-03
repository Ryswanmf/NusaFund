@extends('layouts.admin')

@section('content')
<div class="space-y-10 pb-20">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Ringkasan <span class="text-maroon-700">Dashboard</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Selamat datang kembali, Admin! Berikut adalah ikhtisar aktivitas NusaFund.</p>
        </div>
        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl border border-zinc-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-maroon-50 flex items-center justify-center text-maroon-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="pr-4">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest leading-none">Hari Ini</p>
                <p class="text-sm font-black text-zinc-900">{{ now()->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $totalDonations = \App\Models\Donation::where('status', 'success')->sum('amount');
            $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
            $pendingGalangDana = \App\Models\Fundraising::where('status', 'pending')->count();
            $totalDonors = \App\Models\User::where('usertype', 'user')->count();

            // Data 7 hari terakhir
            $labels = [];
            $dataDonasi = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format('d M');
                $dataDonasi[] = \App\Models\Donation::where('status', 'success')
                    ->whereDate('created_at', $date->toDateString())
                    ->sum('amount');
            }

            // Data kategori
            $catStats = \App\Models\Donation::where('donations.status', 'success')
                ->join('campaigns', 'donations.campaign_id', '=', 'campaigns.id')
                ->selectRaw('SUM(donations.amount) as total, campaigns.category')
                ->groupBy('campaigns.category')
                ->get();
            
            // Aktivitas Terbaru
            $recentDonations = \App\Models\Donation::with('campaign')->latest()->take(5)->get();
        @endphp

        <!-- Card 1 -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-maroon-50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100"></div>
            <div class="w-12 h-12 rounded-2xl bg-maroon-50 flex items-center justify-center text-maroon-700 mb-6 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Dana Terkumpul</p>
                <p class="text-2xl font-black text-zinc-900">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100"></div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 mb-6 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Campaign Aktif</p>
                <p class="text-2xl font-black text-zinc-900">{{ $activeCampaigns }} Program</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100"></div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 mb-6 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Menunggu Verifikasi</p>
                <p class="text-2xl font-black text-zinc-900">{{ $pendingGalangDana }} Pengajuan</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100"></div>
            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 mb-6 relative z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Donatur</p>
                <p class="text-2xl font-black text-zinc-900">{{ $totalDonors }} Orang</p>
            </div>
        </div>
    </div>

    <!-- Charts & Activity Row -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Chart -->
        <div class="lg:col-span-2 bg-white p-8 md:p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h3 class="text-xl font-black text-zinc-900">Performa Donasi</h3>
                    <p class="text-xs text-zinc-400 font-bold mt-1 uppercase tracking-widest">7 Hari Terakhir</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-maroon-700"></span>
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Dana Sukses</span>
                </div>
            </div>
            <div class="h-[350px]">
                <canvas id="donationChart"></canvas>
            </div>
        </div>

        <!-- Category Chart -->
        <div class="bg-white p-8 md:p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm flex flex-col">
            <h3 class="text-xl font-black text-zinc-900 mb-2 text-center">Sebaran Kategori</h3>
            <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest text-center mb-10">Distribusi Dana</p>
            <div class="flex-1 flex items-center justify-center min-h-[250px]">
                @if($catStats->count() > 0)
                    <canvas id="categoryChart"></canvas>
                @else
                    <div class="text-center">
                        <p class="text-xs text-zinc-300 font-bold uppercase">Belum ada data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bottom Row: Recent Activity & Quick Links -->
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Recent Donations -->
        <div class="bg-white rounded-[3.5rem] border border-zinc-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-zinc-50 flex items-center justify-between">
                <h3 class="text-xl font-black text-zinc-900">Donasi Terbaru</h3>
                <a href="{{ route('admin.transactions.index') }}" class="text-[10px] font-black text-maroon-700 uppercase tracking-widest hover:text-maroon-900 transition">Lihat Semua</a>
            </div>
            <div class="p-4">
                <div class="space-y-2">
                    @forelse($recentDonations as $don)
                    <div class="flex items-center justify-between p-4 rounded-[2rem] hover:bg-zinc-50 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-zinc-100 flex items-center justify-center text-zinc-400 group-hover:bg-maroon-100 group-hover:text-maroon-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-zinc-900">{{ $don->is_anonymous ? 'Hamba Allah' : ($don->donor_name ?? 'Anonim') }}</p>
                                <p class="text-[10px] text-zinc-400 font-bold truncate max-w-[200px]">{{ $don->campaign->title }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-maroon-700">Rp {{ number_format($don->amount, 0, ',', '.') }}</p>
                            <p class="text-[9px] text-zinc-300 font-black uppercase">{{ $don->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="py-10 text-center text-zinc-300 text-xs font-bold uppercase tracking-widest">Belum ada donasi</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Management Links -->
        <div class="grid grid-cols-2 gap-6">
            <a href="{{ route('admin.donasi.create') }}" class="bg-maroon-800 p-8 rounded-[3.5rem] shadow-xl shadow-maroon-900/20 text-white flex flex-col justify-between hover:scale-[1.02] active:scale-95 transition-all group relative overflow-hidden">
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-8 translate-y-8 group-hover:scale-110 transition duration-500"></div>
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20 mb-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-maroon-200 uppercase tracking-widest mb-1">Aksi Cepat</p>
                    <p class="text-xl font-black leading-tight">Buat Campaign Baru</p>
                </div>
            </a>
            <a href="{{ route('admin.updates.create') }}" class="bg-white p-8 rounded-[3.5rem] border border-zinc-100 shadow-sm flex flex-col justify-between hover:border-maroon-200 hover:shadow-xl transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-maroon-700 border border-zinc-100 mb-10 group-hover:bg-maroon-50 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Berikan Laporan</p>
                    <p class="text-xl font-black text-zinc-900 leading-tight">Kirim Kabar Terbaru</p>
                </div>
            </a>
            <div class="col-span-2 bg-zinc-900 p-8 rounded-[3.5rem] text-white flex items-center justify-between relative overflow-hidden group shadow-2xl">
                <div class="absolute left-0 top-0 w-full h-full bg-gradient-to-r from-maroon-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-1">Status Keamanan</p>
                    <p class="text-xl font-black">Sistem Terproteksi</p>
                </div>
                <div class="relative z-10 w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center text-green-500 border border-green-500/20">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-ping"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Donation Trend Chart
    const ctxDonation = document.getElementById('donationChart').getContext('2d');
    new Chart(ctxDonation, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Dana (Rp)',
                data: {!! json_encode($dataDonasi) !!},
                borderColor: '#800000',
                backgroundColor: 'rgba(128, 0, 0, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#800000',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        font: { size: 10, weight: 'bold' }
                    }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' } }
                }
            }
        }
    });

    // 2. Category Distribution Chart
    @if($catStats->count() > 0)
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($catStats->pluck('category')) !!},
            datasets: [{
                data: {!! json_encode($catStats->pluck('total')) !!},
                backgroundColor: ['#800000', '#FBBF24', '#10B981', '#3B82F6', '#6366F1', '#EC4899'],
                borderWidth: 0,
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            cutout: '80%',
            plugins: {
                legend: { 
                    position: 'bottom', 
                    labels: { usePointStyle: true, padding: 25, font: { weight: 'bold', size: 10 } } 
                }
            }
        }
    });
    @endif
</script>
@endpush
@endsection
