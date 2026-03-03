@extends('layouts.landing')

@section('title', 'Tunaikan Zakat - ' . $zakat->title)

@section('content')
    <div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <a href="{{ route('zakat.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
                    <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Zakat
                </a>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 p-8 md:p-12">
                        <form id="zakat-form" class="space-y-10">
                            @csrf
                            <div class="space-y-6">
                                <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                                    <span class="w-2 h-8 bg-maroon-700 rounded-full"></span>
                                    Nominal Zakat
                                </h2>
                                <div class="relative">
                                    <span class="absolute left-8 top-1/2 -translate-y-1/2 text-2xl font-black text-zinc-400">Rp</span>
                                    <input type="number" name="amount" id="amount" required min="10000" class="w-full bg-zinc-50 border-none rounded-[2rem] py-8 pl-20 pr-8 text-3xl font-black text-maroon-800 focus:ring-4 focus:ring-maroon-500/10 transition-all" placeholder="0">
                                </div>
                            </div>

                            <div class="space-y-6 pt-10 border-t border-zinc-50">
                                <h2 class="text-xl font-black text-zinc-900 flex items-center gap-3">
                                    <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                                    Data Muzakki (Pembayar)
                                </h2>
                                @guest
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                                            <input type="text" name="name" id="name" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Email Aktif</label>
                                            <input type="email" name="email" id="email" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                                        </div>
                                    </div>
                                @else
                                    <div class="p-6 bg-zinc-50 rounded-3xl border border-zinc-100 flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-black">
                                            {{ substr(Auth::user()->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-black text-zinc-400 uppercase tracking-widest">Muzakki:</p>
                                            <p class="font-black text-zinc-900">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                @endguest
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nomor WhatsApp</label>
                                    <input type="text" name="phone" id="phone" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900" placeholder="0812xxxx">
                                </div>
                            </div>

                            <button type="button" id="pay-button" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-xl uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
                                Tunaikan Zakat
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-[3rem] border border-zinc-100 shadow-sm space-y-6">
                        <div class="rounded-3xl overflow-hidden aspect-video border border-zinc-50">
                            @php
                                $zakatImage = $zakat->image;
                                if ($zakatImage && !filter_var($zakatImage, FILTER_VALIDATE_URL)) {
                                    $zakatImage = asset('storage/' . $zakatImage);
                                } else {
                                    $zakatImage = $zakatImage ?: asset('images/nusafac.png');
                                }
                            @endphp
                            <img src="{{ $zakatImage }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-maroon-600 uppercase tracking-widest mb-1">{{ $zakat->asnaf_category }}</p>
                            <h3 class="font-black text-zinc-900 leading-snug">{{ $zakat->title }}</h3>
                            <p class="text-xs text-zinc-400 mt-2 font-medium">Lembaga: {{ $zakat->institution }}</p>
                        </div>
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
            if (document.getElementById('name')) {
                formData.append('name', document.getElementById('name').value);
                formData.append('email', document.getElementById('email').value);
            }
            formData.append('phone', document.getElementById('phone').value);

            fetch('{{ route('zakat.pay', $zakat->slug) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            window.location.href = '/zakat/berhasil/' + data.transaction_id;
                        },
                        onPending: function (result) {
                            window.location.href = '/zakat/berhasil/' + data.transaction_id;
                        },
                        onError: function (result) {
                            alert('Pembayaran gagal!');
                            payButton.disabled = false;
                            payButton.innerHTML = 'Tunaikan Zakat';
                        }
                    });
                } else {
                    alert('Error: ' + data.error);
                    payButton.disabled = false;
                }
            });
        });
    </script>
@endpush
