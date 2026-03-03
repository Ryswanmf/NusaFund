@extends('layouts.landing')

@section('title', 'Tunaikan Kebaikan - ' . $campaign->title)

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex items-center justify-between">
                <a href="{{ route('donasi.show', $campaign->slug) }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
                    <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Form -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 p-8 md:p-12">
                        <form id="donation-form" class="space-y-10">
                            @csrf
                            
                            <!-- Nominal Section -->
                            <div class="space-y-6">
                                <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                                    <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                                    Masukkan Nominal Donasi
                                </h2>
                                <div class="relative">
                                    <span class="absolute left-8 top-1/2 -translate-y-1/2 text-2xl font-black text-zinc-400">Rp</span>
                                    <input type="number" name="amount" id="amount" required min="10000" step="1000" class="w-full bg-zinc-50 border-none rounded-[2rem] py-8 pl-20 pr-8 text-3xl font-black text-maroon-800 focus:ring-4 focus:ring-maroon-500/10 transition-all" placeholder="0">
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach([50000, 100000, 200000, 500000] as $preset)
                                        <button type="button" onclick="document.getElementById('amount').value = {{ $preset }}" class="py-3 px-4 rounded-xl border border-zinc-100 bg-zinc-50 text-xs font-black text-zinc-500 hover:bg-maroon-800 hover:text-white transition-all active:scale-95">
                                            Rp {{ number_format($preset, 0, ',', '.') }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Donor Info -->
                            <div class="space-y-6 pt-10 border-t border-zinc-50">
                                <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                                    <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                                    Informasi Donatur
                                </h2>
                                
                                @guest
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                                            <input type="text" name="donor_name" id="donor_name" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="Nama Anda">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email Aktif</label>
                                            <input type="email" name="email" id="email" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="email@contoh.com">
                                        </div>
                                    </div>
                                @else
                                    <div class="p-6 bg-zinc-50 rounded-3xl border border-zinc-100 flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-black">
                                            {{ substr(Auth::user()->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-black text-zinc-400 uppercase tracking-widest">Donasi sebagai:</p>
                                            <p class="font-black text-zinc-900">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                @endguest

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Dukungan & Doa (Opsional)</label>
                                    <textarea name="notes" id="notes" rows="3" class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed" placeholder="Tuliskan doa atau kata-kata penyemangat..."></textarea>
                                </div>

                                <div class="flex items-center gap-4 p-6 bg-zinc-50 rounded-3xl border border-zinc-100">
                                    <input type="checkbox" name="is_anonymous" id="is_anonymous" class="w-6 h-6 rounded-lg border-zinc-200 text-maroon-700 focus:ring-maroon-500">
                                    <label for="is_anonymous" class="text-sm font-black text-zinc-700 cursor-pointer">Sembunyikan nama saya (Hamba Allah)</label>
                                </div>
                            </div>

                            <button type="button" id="pay-button" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-xl uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
                                Lanjutkan Pembayaran
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Sisi Kanan: Summary -->
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-[3rem] border border-zinc-100 shadow-sm space-y-6">
                        <div class="rounded-3xl overflow-hidden aspect-video border border-zinc-50">
                            @php
                                $campImage = $campaign->image;
                                if ($campImage && !filter_var($campImage, FILTER_VALIDATE_URL)) {
                                    $campImage = asset('storage/' . $campImage);
                                } else {
                                    $campImage = $campImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $campImage }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-maroon-600 uppercase tracking-widest mb-1">{{ $campaign->category }}</p>
                            <h3 class="font-black text-zinc-900 leading-snug">{{ $campaign->title }}</h3>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-8 rounded-[3rem] border border-blue-100">
                        <div class="flex items-center gap-3 text-blue-700 font-black uppercase tracking-[0.2em] text-[10px] mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Metode Pembayaran
                        </div>
                        <p class="text-xs text-blue-800/80 leading-relaxed font-medium">Pembayaran akan diproses secara otomatis melalui Virtual Account Bank Syariah Indonesia (BSI).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function (e) {
            e.preventDefault();
            payButton.disabled = true;
            payButton.innerHTML = 'Memproses...';

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('amount', document.getElementById('amount').value);
            if (document.getElementById('donor_name')) {
                formData.append('donor_name', document.getElementById('donor_name').value);
                formData.append('email', document.getElementById('email').value);
            }
            formData.append('notes', document.getElementById('notes').value);
            if (document.getElementById('is_anonymous').checked) {
                formData.append('is_anonymous', 'on');
            }

            fetch('{{ route('donasi.submit', $campaign->slug) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            window.location.href = '/donasi/berhasil/' + data.transaction_id;
                        },
                        onPending: function (result) {
                            window.location.href = '/donasi/berhasil/' + data.transaction_id;
                        },
                        onError: function (result) {
                            alert('Pembayaran gagal!');
                            payButton.disabled = false;
                            payButton.innerHTML = 'Lanjutkan Pembayaran';
                        },
                        onClose: function () {
                            alert('Anda menutup jendela pembayaran sebelum selesai.');
                            payButton.disabled = false;
                            payButton.innerHTML = 'Lanjutkan Pembayaran';
                        }
                    });
                } else {
                    alert('Terjadi kesalahan: ' + (data.error || 'Gagal mendapatkan token pembayaran.'));
                    payButton.disabled = false;
                    payButton.innerHTML = 'Lanjutkan Pembayaran';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem.');
                payButton.disabled = false;
                payButton.innerHTML = 'Lanjutkan Pembayaran';
            });
        });
    </script>
@endpush
