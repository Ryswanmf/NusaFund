@extends('layouts.landing')

@section('title', 'Terima Kasih, Orang Baik! - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Card -->
            <div class="bg-white rounded-[4rem] shadow-2xl border border-zinc-100 overflow-hidden mb-16 relative">
                <!-- Top Decor -->
                <div class="bg-maroon-800 p-8 md:p-10 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="w-20 h-24 bg-amber-500 rounded-[2.5rem] flex items-center justify-center text-maroon-900 mx-auto mb-4 shadow-xl animate-bounce-slow relative z-10 border-8 border-maroon-900/30">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-black text-white relative z-10 leading-tight">Donasi Berhasil!<br><span class="text-amber-400 text-lg md:text-xl">Terima Kasih, Orang Baik</span></h1>
                </div>

                <div class="p-6 md:p-12 text-center space-y-8">
                    <div class="max-w-xl mx-auto">
                        <p class="text-zinc-500 text-base font-medium leading-relaxed">
                            Alhamdulillah, donasi Anda untuk kampanye <span class="font-black text-zinc-900">"{{ $donation->campaign->title }}"</span> telah kami terima.
                        </p>
                    </div>

                    <!-- Summary Info -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 py-6 border-y border-zinc-50">
                        <div>
                            <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest mb-1">Nominal</p>
                            <p class="text-lg font-black text-maroon-700">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest mb-1">ID Transaksi</p>
                            <p class="text-lg font-black text-zinc-900">{{ substr($donation->transaction_id, 0, 8) }}</p>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest mb-1">Status</p>
                            <span class="inline-block px-3 py-0.5 bg-green-50 text-green-600 text-[10px] font-black rounded-full border border-green-100 uppercase">Verified</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('donation.certificate', $donation->transaction_id) }}" target="_blank" class="bg-zinc-900 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-maroon-800 transition transform active:scale-95 shadow-xl shadow-zinc-900/20">
                            Unduh Sertifikat
                        </a>
                        
                        @php
                            $shareText = "Saya baru saja berdonasi untuk campaign " . $donation->campaign->title . " di NusaFund. Yuk, ikut ambil bagian dalam kebaikan ini melalui link berikut: " . route('donasi.show', $donation->campaign->slug);
                            $waShareUrl = "https://wa.me/?text=" . urlencode($shareText);
                        @endphp
                        <a href="{{ $waShareUrl }}" target="_blank" class="bg-[#25D366] text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#1ebd5b] transition transform active:scale-95 shadow-xl shadow-green-900/20 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Ajak Teman
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recommendations Section -->
            <div class="space-y-10">
                <div class="text-center">
                    <h2 class="text-2xl font-black text-zinc-900">Bantu Campaign Lainnya?</h2>
                    <p class="text-zinc-500 font-medium">Ulurkan tangan kembali untuk mereka yang sangat membutuhkan.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($recommendations as $camp)
                    <div class="bg-white rounded-3xl overflow-hidden border border-zinc-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col group">
                        <div class="relative overflow-hidden aspect-video">
                            @php
                                $campImage = $camp->image;
                                if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                    $campImage = asset('storage/' . $campImage);
                                } else {
                                    $campImage = $campImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $campImage }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                        <div class="p-6 space-y-4">
                            <h3 class="font-bold text-zinc-900 line-clamp-2 leading-snug h-12 text-sm">{{ $camp->title }}</h3>
                            <div class="w-full bg-zinc-100 h-1.5 rounded-full overflow-hidden">
                                @php $percent = ($camp->collected_amount / $camp->target_amount) * 100; @endphp
                                <div class="bg-maroon-600 h-full rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                            </div>
                            <a href="{{ route('donasi.show', $camp->slug) }}" class="block w-full text-center bg-zinc-50 text-maroon-700 py-3 rounded-xl text-xs font-black hover:bg-maroon-700 hover:text-white transition">Bantu Sekarang</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center pt-8">
                    <a href="{{ route('home') }}" class="text-zinc-400 font-black text-xs uppercase tracking-[0.2em] hover:text-maroon-700 transition">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .animate-bounce-slow { animation: bounce 3s infinite; }
        @keyframes bounce { 0%, 100% { transform: translateY(-10%); } 50% { transform: translateY(0); } }
    </style>
@endpush
