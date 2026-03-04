@extends('layouts.admin')

@section('content')
<div class="space-y-10 pb-20">
    @php
        // 1. LOGIKA DATA UTAMA
        $todayDonations = \App\Models\Donation::where('status', 'success')->whereDate('created_at', now())->sum('amount');
        $yesterdayDonations = \App\Models\Donation::where('status', 'success')->whereDate('created_at', now()->subDay())->sum('amount');
        $totalDonations = \App\Models\Donation::where('status', 'success')->sum('amount');
        
        $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
        $pendingFundraising = \App\Models\Fundraising::where('status', 'pending')->count();
        $totalUsers = \App\Models\User::where('usertype', 'user')->count();

        // Hitung tren
        $donationTrend = ($yesterdayDonations > 0) ? (($todayDonations - $yesterdayDonations) / $yesterdayDonations) * 100 : 0;

        // 2. DATA GRAFIK DONASI (7 Hari)
        $labels = [];
        $dataDonasi = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d M');
            $dataDonasi[] = \App\Models\Donation::where('status', 'success')->whereDate('created_at', $date->toDateString())->sum('amount');
        }

        // 3. DATA GRAFIK USER (7 Hari)
        $userStats = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $userStats[] = \App\Models\User::where('usertype', 'user')->whereDate('created_at', $date->toDateString())->count();
        }

        // 4. DATA KATEGORI
        $catStats = \App\Models\Donation::where('donations.status', 'success')
            ->join('campaigns', 'donations.campaign_id', '=', 'campaigns.id')
            ->selectRaw('SUM(donations.amount) as total, campaigns.category')
            ->groupBy('campaigns.category')
            ->get();
        
        $recentDonations = \App\Models\Donation::with('campaign')->latest()->take(5)->get();
    @endphp

    <!-- Dashboard Top Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 bg-white p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm">
        <div>
            <h1 class="text-4xl font-black text-zinc-900 tracking-tighter">NusaFund <span class="text-maroon-700">Analytics</span></h1>
            <p class="text-zinc-400 mt-2 font-bold uppercase tracking-[0.2em] text-[10px]">Pusat Informasi Strategis & Pemantauan Real-time</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden md:block">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">{{ now()->format('l') }}</p>
                <p class="text-sm font-black text-zinc-900">{{ now()->format('d F Y') }}</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-zinc-50 flex items-center justify-center text-maroon-700 border border-zinc-100 shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm group">
            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-6">Total Pendapatan</p>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-2xl font-black text-zinc-900 tracking-tight">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
                    <p class="text-[10px] font-bold {{ $donationTrend >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $donationTrend >= 0 ? 'M5 10l7-7 7 7' : 'M19 14l-7 7-7-7' }}"></path></svg>
                        {{ abs(round($donationTrend, 1)) }}% dari kemarin
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-maroon-50 flex items-center justify-center text-maroon-700 group-hover:bg-maroon-700 group-hover:text-white transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
        </div>

        <!-- Active Programs -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm group">
            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-6">Campaign Aktif</p>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-2xl font-black text-zinc-900 tracking-tight">{{ $activeCampaigns }} Program</p>
                    <p class="text-[10px] font-bold text-zinc-400 mt-1 uppercase">Sedang Berjalan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>

        <!-- Pending Request -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm group relative">
            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-6">Pengajuan Baru</p>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-2xl font-black text-zinc-900 tracking-tight">{{ $pendingFundraising }} Draf</p>
                    <p class="text-[10px] font-bold text-blue-600 mt-1 uppercase">Butuh Verifikasi</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
            @if($pendingFundraising > 0)
                <div class="absolute top-4 right-8 w-2 h-2 rounded-full bg-red-500 animate-ping"></div>
            @endif
        </div>

        <!-- Total Donors -->
        <div class="bg-zinc-900 p-8 rounded-[2.5rem] shadow-xl group">
            <p class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.2em] mb-6">Total Donatur</p>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-2xl font-black text-white tracking-tight">{{ $totalUsers }} Orang</p>
                    <p class="text-[10px] font-bold text-zinc-600 mt-1 uppercase">Terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-110 transition-all duration-500 shadow-2xl shadow-black/50 border border-white/5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Charts Section -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Revenue Line Chart -->
        <div class="lg:col-span-2 bg-white p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h3 class="text-xl font-black text-zinc-900 tracking-tight">Aliran Donasi</h3>
                    <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest mt-1">Nominal Donasi 7 Hari Terakhir</p>
                </div>
                <div class="bg-zinc-50 px-4 py-2 rounded-xl border border-zinc-100 text-[10px] font-black text-maroon-700 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-maroon-700 animate-pulse"></span>
                    Live Data
                </div>
            </div>
            <div class="h-[350px]">
                <canvas id="donationChart"></canvas>
            </div>
        </div>

        <!-- Category Doughnut Chart -->
        <div class="bg-white p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm flex flex-col">
            <div class="text-center mb-12">
                <h3 class="text-xl font-black text-zinc-900 tracking-tight">Sebaran Dana</h3>
                <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest mt-1">Berdasarkan Kategori Program</p>
            </div>
            <div class="flex-1 flex items-center justify-center relative min-h-[300px]">
                @if($catStats->count() > 0)
                    <canvas id="categoryChart"></canvas>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center pointer-events-none mt-[-10px]">
                        <p class="text-[8px] font-black text-zinc-300 uppercase tracking-widest">Kontribusi</p>
                        <p class="text-lg font-black text-zinc-900">100%</p>
                    </div>
                @else
                    <p class="text-zinc-300 text-xs font-black uppercase">Data Belum Tersedia</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Second Row: User Growth & Recent Activity -->
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- User Growth Bar Chart -->
        <div class="bg-white p-10 rounded-[3.5rem] border border-zinc-100 shadow-sm">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h3 class="text-xl font-black text-zinc-900 tracking-tight">Pertumbuhan Donatur</h3>
                    <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest mt-1">Jumlah Donatur Baru Per Hari</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-zinc-50 flex items-center justify-center text-zinc-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="h-[300px]">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-white rounded-[3.5rem] border border-zinc-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-10 border-b border-zinc-50 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-black text-zinc-900 tracking-tight">Donasi Terbaru</h3>
                    <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest mt-1">Aksi Kebaikan Terkini</p>
                </div>
                <a href="{{ route('admin.transactions.index') }}" class="text-[10px] font-black text-maroon-700 uppercase tracking-[0.2em] hover:text-maroon-900 transition">Selengkapnya &rarr;</a>
            </div>
            <div class="flex-1 p-6 overflow-y-auto max-h-[350px] scrollbar-hide">
                <div class="space-y-3">
                    @forelse($recentDonations as $don)
                    <div class="flex items-center justify-between p-5 rounded-3xl bg-zinc-50/50 hover:bg-white hover:shadow-xl hover:border-zinc-100 border border-transparent transition-all duration-500 group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-maroon-700 group-hover:scale-110 transition-transform">
                                <span class="font-black text-sm uppercase">{{ substr($don->donor_name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-black text-zinc-900 truncate">{{ $don->is_anonymous ? 'Hamba Allah' : ($don->donor_name ?? 'Anonim') }}</p>
                                <p class="text-[9px] text-zinc-400 font-bold uppercase truncate max-w-[150px]">{{ $don->campaign->title }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-maroon-700">Rp {{ number_format($don->amount, 0, ',', '.') }}</p>
                            <p class="text-[8px] text-zinc-300 font-black uppercase">{{ $don->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="py-20 text-center text-zinc-300 text-xs font-black uppercase tracking-widest">Belum Ada Transaksi</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    Chart.defaults.font.family = "'Instrument Sans', sans-serif";
    Chart.defaults.color = '#71717a';

    // 1. DONATION LINE CHART
    const ctxDonation = document.getElementById('donationChart').getContext('2d');
    const gradDonation = ctxDonation.createLinearGradient(0, 0, 0, 400);
    gradDonation.addColorStop(0, 'rgba(128, 0, 0, 0.1)');
    gradDonation.addColorStop(1, 'rgba(128, 0, 0, 0)');

    new Chart(ctxDonation, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                data: {!! json_encode($dataDonasi) !!},
                borderColor: '#800000',
                backgroundColor: gradDonation,
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 0,
                pointHoverRadius: 8,
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
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false }, ticks: { font: { size: 9, weight: '800' } } },
                x: { grid: { display: false }, ticks: { font: { size: 9, weight: '800' } } }
            }
        }
    });

    // 2. CATEGORY DOUGHNUT CHART
    @if($catStats->count() > 0)
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($catStats->pluck('category')) !!},
            datasets: [{
                data: {!! json_encode($catStats->pluck('total')) !!},
                backgroundColor: ['#800000', '#FBBF24', '#10B981', '#3B82F6', '#6366F1'],
                borderWidth: 0,
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            cutout: '85%',
            plugins: { 
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 'bold', size: 9 } } } 
            }
        }
    });
    @endif

    // 3. USER GROWTH BAR CHART
    const ctxUser = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctxUser, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Donatur Baru',
                data: {!! json_encode($userStats) !!},
                backgroundColor: '#fbbf24',
                borderRadius: 8,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false }, ticks: { stepSize: 1, font: { size: 9, weight: '800' } } },
                x: { grid: { display: false }, ticks: { font: { size: 9, weight: '800' } } }
            }
        }
    });
</script>
@endpush
@endsection
