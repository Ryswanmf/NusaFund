@extends('layouts.landing')

@section('title', 'Galang Dana Saya - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Welcome -->
            <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-zinc-900 tracking-tight">Galang Dana <span class="text-maroon-700">Saya</span></h1>
                    <p class="text-zinc-500 font-medium mt-1">Pantau status pengajuan dan perkembangan kampanye kebaikan Anda.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('fundraising.create') }}" class="inline-flex items-center gap-2 bg-maroon-800 text-white px-6 py-3 rounded-2xl font-black text-sm hover:bg-maroon-700 transition shadow-lg shadow-maroon-900/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Galang Dana Baru
                    </a>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="flex items-center gap-2 mb-8 bg-zinc-100 p-1.5 rounded-2xl w-fit">
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold text-zinc-500 hover:text-zinc-700 transition">Riwayat Donasi</a>
                <a href="{{ route('dashboard.fundraising') }}" class="px-6 py-2.5 rounded-xl text-sm font-black bg-white text-maroon-700 shadow-sm transition">Galang Dana Saya</a>
            </div>

            <!-- History Table -->
            <div class="bg-white rounded-[3rem] border border-zinc-100 shadow-sm overflow-hidden">
                <div class="px-10 py-8 border-b border-zinc-50 flex items-center justify-between">
                    <h2 class="text-xl font-black text-zinc-900">Daftar Pengajuan</h2>
                    <span class="bg-zinc-100 text-zinc-500 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">Urutan Terbaru</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-50">
                        <thead class="bg-zinc-50/50">
                            <tr>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Judul Campaign</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Target</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Terkumpul</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Tanggal</th>
                                <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            @forelse($fundraisings as $item)
                            <tr class="hover:bg-zinc-50/50 transition duration-300">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-zinc-100 flex-shrink-0">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-zinc-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-zinc-900 truncate max-w-[200px]">{{ $item->title }}</p>
                                            <p class="text-[10px] font-bold text-maroon-600 uppercase tracking-widest mt-1">{{ $item->category }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-sm font-black text-zinc-900">Rp {{ number_format($item->target_amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-sm font-black text-maroon-700">Rp {{ number_format($item->collected_amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="text-xs font-bold text-zinc-500">{{ $item->created_at->format('d M Y') }}</p>
                                </td>
                                <td class="px-10 py-6">
                                    @if($item->status == 'active')
                                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">Aktif</span>
                                    @elseif($item->status == 'pending')
                                        <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-100">Menunggu Review</span>
                                    @elseif($item->status == 'rejected')
                                        <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-red-100">Ditolak</span>
                                    @else
                                        <span class="px-3 py-1 bg-zinc-50 text-zinc-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-zinc-100">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <a href="{{ route('fundraising.show', $item->slug) }}" class="text-maroon-700 font-black text-[10px] uppercase tracking-widest hover:underline transition">
                                        {{ $item->status == 'active' ? 'Lihat Halaman' : 'Pratinjau' }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-10 py-20 text-center text-zinc-400 font-medium">Anda belum pernah mengajukan galang dana.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-10 py-6 bg-zinc-50/30">
                    {{ $fundraisings->links() }}
                </div>
            </div>

            <!-- Tips Section -->
            <div class="mt-12 grid md:grid-cols-2 gap-8">
                <div class="bg-maroon-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-16 -translate-y-16"></div>
                    <h3 class="text-xl font-black mb-4 relative z-10">Kenapa Menunggu Review?</h3>
                    <p class="text-maroon-100 text-sm leading-relaxed opacity-80 mb-6">Tim NusaFund melakukan verifikasi manual untuk memastikan setiap kampanye amanah dan terpercaya bagi para donatur.</p>
                    <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-12 0 9 9 0 0112 0z"></path></svg>
                        Proses: 1x24 Jam Kerja
                    </div>
                </div>
                <div class="bg-amber-500 rounded-[2.5rem] p-10 text-maroon-950">
                    <h3 class="text-xl font-black mb-4">Tips Galang Dana Sukses</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm font-bold">
                            <span class="w-5 h-5 bg-maroon-950/10 rounded-full flex items-center justify-center text-[10px]">1</span>
                            Gunakan foto asli dan berkualitas tinggi.
                        </li>
                        <li class="flex items-start gap-3 text-sm font-bold">
                            <span class="w-5 h-5 bg-maroon-950/10 rounded-full flex items-center justify-center text-[10px]">2</span>
                            Ceritakan urgensi bantuan dengan detail.
                        </li>
                        <li class="flex items-start gap-3 text-sm font-bold">
                            <span class="w-5 h-5 bg-maroon-950/10 rounded-full flex items-center justify-center text-[10px]">3</span>
                            Bagikan link galang dana ke media sosial Anda.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
