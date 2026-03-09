@extends('layouts.landing')

@section('title', 'Dashboard Donatur - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Welcome -->
            <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-zinc-900 tracking-tight">Halo, <span class="text-maroon-700">{{ Auth::user()->name }}</span>!</h1>
                    <p class="text-zinc-500 font-medium mt-1">Terima kasih atas seluruh kebaikan yang telah Anda tebarkan.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-white border border-zinc-200 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-zinc-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Pengaturan Profil
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-12">
                <div class="bg-white p-6 lg:p-8 rounded-[2rem] lg:rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-maroon-50 flex items-center justify-center text-maroon-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Donasi Anda</p>
                        <p class="text-2xl lg:text-3xl font-black text-zinc-900">Rp {{ number_format($totalDonation, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 lg:p-8 rounded-[2rem] lg:rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Campaign Dibantu</p>
                        <p class="text-2xl lg:text-3xl font-black text-zinc-900">{{ $campaignCount }} Campaign</p>
                    </div>
                </div>
                <div class="bg-maroon-800 p-6 lg:p-8 rounded-[2rem] lg:rounded-[2.5rem] shadow-xl space-y-4 text-white relative overflow-hidden group sm:col-span-2 lg:col-span-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-16 -translate-y-16 group-hover:scale-110 transition duration-500"></div>
                    <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-white border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-maroon-200 uppercase tracking-widest mb-1">Status Keanggotaan</p>
                        <p class="text-xl lg:text-2xl font-black">Donatur Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid lg:grid-cols-3 gap-8 mb-12">
                <div class="lg:col-span-2 bg-white p-6 md:p-10 rounded-[2.5rem] lg:rounded-[3rem] border border-zinc-100 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                        <h3 class="text-xl font-black text-zinc-900">Tren Kebaikan Anda</h3>
                        <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest bg-zinc-50 px-3 py-1.5 rounded-full border border-zinc-100 self-start sm:self-auto">Aktivitas Donasi</span>
                    </div>
                    <div class="h-[300px]">
                        <canvas id="myKindnessChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-10 rounded-[2.5rem] lg:rounded-[3rem] border border-zinc-100 shadow-sm flex flex-col">
                    <h3 class="text-xl font-black text-zinc-900 mb-10">Sebaran Dampak</h3>
                    <div class="flex-1 flex items-center justify-center min-h-[250px]">
                        @if($categoryStats->count() > 0)
                            <canvas id="myCategoryChart"></canvas>
                        @else
                            <div class="text-center space-y-2">
                                <svg class="w-12 h-12 text-zinc-100 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                <p class="text-[10px] text-zinc-300 font-black uppercase tracking-widest">Belum Ada Data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- History Table -->
            <div class="bg-white rounded-[2.5rem] lg:rounded-[3rem] border border-zinc-100 shadow-sm overflow-hidden">
                <div class="px-6 lg:px-10 py-8 border-b border-zinc-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-xl font-black text-zinc-900">Riwayat Donasi</h2>
                    <span class="bg-zinc-100 text-zinc-500 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest self-start sm:self-auto">Urutan Terbaru</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-50">
                        <thead class="bg-zinc-50/50">
                            <tr>
                                <th class="px-6 lg:px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Campaign</th>
                                <th class="px-6 lg:px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Jumlah</th>
                                <th class="px-6 lg:px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Tanggal</th>
                                <th class="px-6 lg:px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-6 lg:px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @forelse($donations as $item)
                            <tr class="hover:bg-zinc-50/50 transition duration-300">
                                <td class="px-6 lg:px-10 py-6">
                                    <p class="text-sm font-black text-zinc-900 truncate max-w-[150px] lg:max-w-[250px]">{{ $item->campaign->title }}</p>
                                    <p class="text-[10px] font-bold text-maroon-600 uppercase tracking-widest mt-1">{{ $item->campaign->category }}</p>
                                </td>
                                <td class="px-6 lg:px-10 py-6">
                                    <p class="text-sm font-black text-zinc-900 whitespace-nowrap">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-6 lg:px-10 py-6">
                                    <p class="text-xs font-bold text-zinc-500 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</p>
                                    <p class="text-[10px] text-zinc-400">{{ $item->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 lg:px-10 py-6">
                                    @if($item->status == 'success')
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">Success</span>
                                    @elseif($item->status == 'pending')
                                        <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-100">Pending</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-100">Failed</span>
                                    @endif
                                </td>
                                <td class="px-6 lg:px-10 py-6 text-right">
                                    @if($item->status == 'success')
                                        <a href="{{ route('donation.certificate', $item->transaction_id) }}" target="_blank" class="inline-flex items-center gap-2 text-maroon-700 font-black text-[10px] uppercase tracking-widest hover:text-maroon-900 transition whitespace-nowrap">
                                            Unduh
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        </a>
                                    @else
                                        <span class="text-[10px] font-black text-zinc-300 uppercase tracking-widest whitespace-nowrap">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 lg:px-10 py-20 text-center text-zinc-400 font-medium">Anda belum pernah melakukan donasi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 lg:px-10 py-6 bg-zinc-50/30">
                    {{ $donations->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Kindness Trend Chart (Line Chart)
    const ctxKindness = document.getElementById('myKindnessChart').getContext('2d');
    new Chart(ctxKindness, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyStats->pluck('month')) !!},
            datasets: [{
                label: 'Donasi (Rp)',
                data: {!! json_encode($monthlyStats->pluck('total')) !!},
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

    // 2. Category Distribution Chart (Doughnut)
    @if($categoryStats->count() > 0)
    const ctxCategory = document.getElementById('myCategoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryStats->pluck('category')) !!},
            datasets: [{
                data: {!! json_encode($categoryStats->pluck('count')) !!},
                backgroundColor: ['#800000', '#FBBF24', '#10B981', '#3B82F6', '#6366F1', '#EC4899'],
                borderWidth: 0,
                weight: 0.5
            }]
        },
        options: {
            responsive: true,
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 'bold', size: 10 } } }
            }
        }
    });
    @endif
</script>
@endpush
