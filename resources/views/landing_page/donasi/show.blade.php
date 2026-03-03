@extends('layouts.landing')

@section('title', $campaign->title . ' - NusaFund')

@section('content')
    <div class="bg-zinc-50 py-8 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 md:pb-0">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm font-medium text-zinc-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="/" class="hover:text-maroon-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('donasi.index') }}" class="hover:text-maroon-700">Donasi</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-zinc-800 truncate max-w-[200px] md:max-w-none">{{ $campaign->title }}</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Konten Utama -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Hero Image & Title -->
                    <div class="space-y-6">
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-video">
                            @php
                                $campImage = $campaign->image;
                                if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                    $campImage = asset('storage/' . $campImage);
                                } else {
                                    $campImage = $campImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $campImage }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6 flex gap-3">
                                @if($campaign->status === 'completed')
                                    <span class="bg-green-600/90 backdrop-blur-md text-white text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">Selesai</span>
                                @elseif($campaign->is_urgent)
                                    <span class="bg-maroon-600/90 backdrop-blur-md text-white text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">Mendesak</span>
                                @endif
                                <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">{{ $campaign->category }}</span>
                            </div>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">{{ $campaign->title }}</h1>
                        
                        <!-- Fundraiser Info -->
                        <div class="flex items-center gap-4 p-4 bg-white rounded-3xl border border-zinc-100 shadow-sm">
                            <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-bold">NF</div>
                            <div>
                                <div class="flex items-center gap-1">
                                    <p class="font-bold text-zinc-900">Admin NusaFund</p>
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                                <p class="text-xs text-zinc-400 font-medium">Terverifikasi NusaFund</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs & Content -->
                    <div x-data="{ tab: 'cerita' }" class="space-y-8">
                        <div class="flex border-b border-zinc-200 overflow-x-auto">
                            <button @click="tab = 'cerita'" :class="tab === 'cerita' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-sm md:text-lg border-b-4 transition-all whitespace-nowrap">Cerita</button>
                            <button @click="tab = 'kabar'" :class="tab === 'kabar' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-sm md:text-lg border-b-4 transition-all whitespace-nowrap flex items-center gap-2">
                                Kabar Terbaru
                                @if($campaign->updates->count() > 0)
                                    <span class="bg-maroon-100 text-maroon-700 text-[10px] px-2 py-0.5 rounded-full">{{ $campaign->updates->count() }}</span>
                                @endif
                            </button>
                            <button @click="tab = 'donatur'" :class="tab === 'donatur' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-sm md:text-lg border-b-4 transition-all whitespace-nowrap">Donatur ({{ $campaign->donations->where('status', 'success')->count() }})</button>
                            <button @click="tab = 'doa'" :class="tab === 'doa' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-sm md:text-lg border-b-4 transition-all whitespace-nowrap">Doa & Dukungan</button>
                        </div>

                        <!-- Tab: Cerita -->
                        <div x-show="tab === 'cerita'" class="prose prose-zinc lg:prose-xl max-w-none text-zinc-600 leading-relaxed whitespace-pre-line">
                            {{ $campaign->description }}
                        </div>

                        <!-- Tab: Kabar Terbaru -->
                        <div x-show="tab === 'kabar'" class="space-y-10">
                            @forelse($campaign->updates as $upd)
                            <div class="relative pl-8 md:pl-12">
                                <div class="absolute left-0 top-0 bottom-0 w-px bg-zinc-200"></div>
                                <div class="absolute left-[-4px] top-0 w-2 h-2 rounded-full bg-maroon-700 ring-4 ring-maroon-50"></div>
                                
                                <div class="space-y-4">
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">{{ $upd->created_at->format('d M Y') }}</p>
                                    <h4 class="text-xl font-black text-zinc-900">{{ $upd->title }}</h4>
                                    @if($upd->image)
                                        <div class="rounded-3xl overflow-hidden border border-zinc-100 shadow-sm max-w-lg">
                                            <img src="{{ asset('storage/' . $upd->image) }}" class="w-full h-auto">
                                        </div>
                                    @endif
                                    <p class="text-zinc-600 leading-relaxed whitespace-pre-line font-medium">{{ $upd->content }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="py-10 text-center text-zinc-400 font-medium">Belum ada kabar terbaru untuk kampanye ini.</div>
                            @endforelse
                        </div>

                        <!-- Tab: Donatur -->
                        <div x-show="tab === 'donatur'" class="space-y-6">
                            @forelse($campaign->donations->where('status', 'success') as $don)
                            <div class="flex items-center gap-4 p-6 bg-white rounded-3xl border border-zinc-100">
                                <div class="w-12 h-12 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-black uppercase">
                                    {{ substr($don->is_anonymous ? 'HA' : ($don->donor_name ?? 'NF'), 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-zinc-900">{{ $don->is_anonymous ? 'Hamba Allah' : ($don->donor_name ?? 'Anonim') }}</p>
                                    <p class="text-xs text-zinc-400">Berdonasi sebesar <span class="font-black text-maroon-700">Rp {{ number_format($don->amount, 0, ',', '.') }}</span></p>
                                </div>
                            </div>
                            @empty
                            <div class="py-10 text-center text-zinc-400 font-medium">Belum ada donatur untuk saat ini. Jadi yang pertama membantu!</div>
                            @endforelse
                        </div>

                        <!-- Tab: Doa & Dukungan -->
                        <div x-show="tab === 'doa'" class="space-y-6">
                            @php
                                $prayers = $campaign->donations()->where('status', 'success')->whereNotNull('notes')->where('notes', '!=', '')->latest()->get();
                            @endphp
                            @forelse($prayers as $prayer)
                            <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-sm space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-zinc-900">{{ $prayer->is_anonymous ? 'Hamba Allah' : ($prayer->donor_name ?? 'Orang Baik') }}</p>
                                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $prayer->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-zinc-600 leading-relaxed font-medium italic">"{{ $prayer->notes }}"</p>
                            </div>
                            @empty
                            <div class="py-10 text-center text-zinc-400 font-medium">Belum ada doa yang terunggah. Amin untuk setiap niat baik Anda.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Widget Donasi (Sticky Desktop) -->
                <div class="space-y-8">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-2xl space-y-8 relative overflow-hidden">
                            @php $percent = ($campaign->collected_amount / $campaign->target_amount) * 100; @endphp
                            
                            @if($percent >= 100 || $campaign->status === 'completed')
                                <div class="absolute top-0 left-0 right-0 bg-green-500 text-white text-[10px] font-black uppercase tracking-[0.3em] py-2 text-center">
                                    {{ $campaign->status === 'completed' ? 'Kampanye Telah Selesai' : 'Target Alhamdulillah Tercapai' }}
                                </div>
                            @endif

                            <div>
                                <p class="text-4xl font-black text-maroon-800 mb-2">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                <div class="flex justify-between items-center text-sm font-bold text-zinc-400 mb-4 uppercase tracking-widest">
                                    <span>Terkumpul dari <span class="text-zinc-900">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span></span>
                                    <span class="{{ ($percent >= 100 || $campaign->status === 'completed') ? 'text-green-600' : 'text-maroon-700' }}">{{ round($percent) }}%</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-4 rounded-full overflow-hidden mb-6 p-1 shadow-inner">
                                    <div class="{{ ($percent >= 100 || $campaign->status === 'completed') ? 'bg-green-500' : 'bg-maroon-600' }} h-full rounded-full transition-all duration-1000 shadow-lg" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        <p class="text-2xl font-black text-zinc-900">{{ $campaign->donations->where('status', 'success')->count() }}</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Donatur</p>
                                    </div>
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        @php 
                                            $daysLeft = ceil(now()->diffInDays($campaign->end_date, false));
                                        @endphp
                                        <p class="text-2xl font-black text-zinc-900">{{ ($campaign->status === 'completed' || $daysLeft <= 0) ? '0' : $daysLeft }}</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Hari Lagi</p>
                                    </div>
                                </div>
                            </div>

                            @if($percent >= 100 || $campaign->status === 'completed')
                                <div class="space-y-4">
                                    <div class="w-full text-center bg-zinc-100 text-zinc-400 py-5 rounded-3xl font-black text-lg cursor-not-allowed">
                                        {{ $campaign->status === 'completed' ? 'Kampanye Selesai' : 'Target Tercapai' }}
                                    </div>
                                    <p class="text-[10px] text-center text-zinc-400 font-medium italic leading-relaxed px-4">Donasi untuk kampanye ini telah ditutup. Terima kasih atas kedermawanan Anda!</p>
                                </div>
                            @else
                                <a href="{{ route('donasi.pay', $campaign->slug) }}" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform active:scale-95 group">
                                    Donasi Sekarang
                                    <svg class="w-6 h-6 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>

                                <!-- WhatsApp Confirmation -->
                                <a href="https://wa.me/{{ str_replace([' ', '-', '+'], '', \App\Models\Setting::first()->whatsapp) }}?text=Halo%20Admin%20NusaFund,%20saya%20ingin%20konfirmasi%20donasi%20untuk%20kampanye:%20{{ urlencode($campaign->title) }}" 
                                   target="_blank"
                                   class="block w-full text-center bg-white border-2 border-[#25D366] text-[#25D366] hover:bg-[#25D366] hover:text-white py-4 rounded-3xl font-bold text-sm transition-all duration-300 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    Konfirmasi Transfer
                                </a>
                            @endif
                        </div>

                        <!-- Info Keamanan -->
                        <div class="bg-zinc-900 text-white p-8 rounded-[2.5rem] shadow-xl space-y-4">
                            <div class="flex items-center gap-3 text-amber-400 font-black uppercase tracking-[0.2em] text-[10px]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Jaminan Aman
                            </div>
                            <p class="text-xs text-zinc-400 leading-relaxed">Dana disalurkan 100% setelah dipotong biaya operasional platform (kecuali kategori bencana).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Mobile Button -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 p-4 bg-white/80 backdrop-blur-xl border-t border-zinc-100 z-50 transition-all duration-500 shadow-[0_-10px_40px_rgba(0,0,0,0.1)]">
        @if($percent >= 100 || $campaign->status === 'completed')
            <div class="w-full text-center bg-zinc-100 text-zinc-400 py-4 rounded-2xl font-black text-sm uppercase tracking-widest cursor-not-allowed">
                Kampanye Selesai
            </div>
        @else
            <a href="{{ route('donasi.pay', $campaign->slug) }}" class="block w-full text-center bg-amber-500 text-maroon-950 py-4 rounded-2xl font-black text-lg shadow-xl shadow-amber-900/20 active:scale-95 transition-all">
                Donasi Sekarang
            </a>
        @endif
    </div>
@endsection
