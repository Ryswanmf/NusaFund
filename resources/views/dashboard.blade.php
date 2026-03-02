@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Ringkasan <span class="text-maroon-700">Dashboard</span></h1>
        <p class="text-zinc-500 mt-2 font-medium">Pantau pertumbuhan donasi dan aktivitas kampanye Anda secara real-time.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
            $totalDonations = \App\Models\Donation::where('status', 'success')->sum('amount');
            $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
            $pendingGalangDana = \App\Models\Fundraising::where('status', 'pending')->count();
            $totalDonors = \App\Models\User::where('usertype', 'user')->count();
        @endphp

        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-maroon-50 flex items-center justify-center text-maroon-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Dana Terkumpul</p>
                <p class="text-2xl font-black text-zinc-900">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Campaign Aktif</p>
                <p class="text-2xl font-black text-zinc-900">{{ $activeCampaigns }} Program</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Menunggu Verifikasi</p>
                <p class="text-2xl font-black text-zinc-900">{{ $pendingGalangDana }} Pengajuan</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Donatur</p>
                <p class="text-2xl font-black text-zinc-900">{{ $totalDonors }} Orang</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 md:p-10 rounded-[3rem] border border-zinc-100 shadow-sm">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-black text-zinc-900">Tren Donasi Berhasil</h3>
                <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">7 Hari Terakhir</span>
            </div>
            <canvas id="donationChart" height="300"></canvas>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-zinc-100 shadow-sm flex flex-col">
            <h3 class="text-xl font-black text-zinc-900 mb-10">Kategori Terpopuler</h3>
            <div class="flex-1 flex items-center justify-center">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Donation Trend Chart
    const ctxDonation = document.getElementById('donationChart').getContext('2d');
    new Chart(ctxDonation, {
        type: 'line',
        data: {
            labels: {!! json_encode(collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('d M'))->values()) !!},
            datasets: [{
                label: 'Jumlah Donasi (Rp)',
                data: [0, 0, 0, 0, 0, 0, 0], // Ganti dengan data real dari backend jika sudah ada transaksi
                borderColor: '#800000',
                backgroundColor: 'rgba(128, 0, 0, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 6,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#800000',
                pointBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], drawBorder: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Category Distribution Chart
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: ['Kemanusiaan', 'Pendidikan', 'Kesehatan', 'Bencana'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: ['#800000', '#FBBF24', '#10B981', '#3B82F6'],
                borderWidth: 0,
                weight: 0.5
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 'bold', size: 11 } } }
            }
        }
    });
</script>
@endpush
@endsection
