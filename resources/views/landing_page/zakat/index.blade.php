@extends('layouts.landing')

@section('title', 'Zakat Online - NusaFund')

@section('content')
    <!-- Hero Section Zakat -->
    <section class="relative bg-maroon-800 text-white py-20 lg:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block bg-white/10 backdrop-blur-md text-amber-400 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6">#ZakatMembersihkanHarta</span>
                    <h1 class="text-4xl md:text-6xl font-black leading-tight mb-8">
                        Tunaikan <span class="text-amber-400">Zakat</span> Jadi Lebih Mudah & Berkah
                    </h1>
                    <p class="text-lg text-maroon-50 mb-10 opacity-90 leading-relaxed max-w-xl">
                        Bersihkan harta dan raih keberkahan dengan zakat. NusaFund bekerja sama dengan lembaga amil zakat terpercaya untuk menyalurkan zakat Anda kepada mustahik yang tepat.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#kalkulator" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-8 py-4 rounded-2xl font-black transition transform hover:-translate-y-1 shadow-lg shadow-amber-900/40">
                            Hitung Zakat Saya
                        </a>
                        <a href="#jenis-zakat" class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 px-8 py-4 rounded-2xl font-bold transition">
                            Jenis Zakat
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <div class="bg-white/5 backdrop-blur-3xl rounded-[3rem] p-12 border border-white/10 shadow-2xl relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-400/20 rounded-full blur-3xl"></div>
                        <div class="relative z-10 space-y-6 text-center">
                            <div class="w-20 h-20 bg-amber-500 rounded-3xl flex items-center justify-center mx-auto shadow-xl transform rotate-12">
                                <svg class="w-10 h-10 text-maroon-950" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black">Zakat Anda Aman</h3>
                            <p class="text-maroon-100 font-medium">Setiap dana zakat diaudit secara berkala dan disalurkan melalui BAZNAS serta lembaga resmi lainnya.</p>
                            <div class="pt-6 grid grid-cols-2 gap-4">
                                <div class="text-left">
                                    <p class="text-amber-400 font-black text-2xl">100%</p>
                                    <p class="text-[10px] uppercase font-bold text-maroon-200">Transparansi</p>
                                </div>
                                <div class="text-left border-l border-white/10 pl-4">
                                    <p class="text-amber-400 font-black text-2xl">Realtime</p>
                                    <p class="text-[10px] uppercase font-bold text-maroon-200">Laporan Digital</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalkulator Zakat -->
    <section id="kalkulator" class="py-24 bg-white" x-data="{ 
        type: 'profesi',
        income: 0,
        bonus: 0,
        other: 0,
        goldPrice: 1200000,
        get totalIncome() { return parseInt(this.income || 0) + parseInt(this.bonus || 0) + parseInt(this.other || 0) },
        get nisab() { return 85 * this.goldPrice / 12 },
        get isNisab() { return this.totalIncome >= this.nisab },
        get zakatAmount() { return this.isNisab ? Math.round(this.totalIncome * 0.025) : 0 }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-zinc-900 mb-6">Kalkulator Zakat</h2>
                <p class="text-zinc-500 text-lg">Gunakan fitur ini untuk menghitung jumlah zakat yang wajib Anda tunaikan secara akurat sesuai syariat.</p>
            </div>

            <div class="bg-zinc-50 rounded-[3.5rem] border border-zinc-100 p-8 md:p-16 shadow-inner">
                <div class="grid lg:grid-cols-2 gap-16 items-start">
                    <!-- Form Input -->
                    <div class="space-y-8">
                        <div class="flex p-1 bg-white rounded-2xl border border-zinc-200 shadow-sm">
                            <button @click="type = 'profesi'" :class="type === 'profesi' ? 'bg-maroon-700 text-white shadow-lg' : 'text-zinc-500 hover:text-maroon-700'" class="flex-1 py-3 rounded-xl font-bold transition-all duration-300">Zakat Profesi</button>
                            <button @click="type = 'maal'" :class="type === 'maal' ? 'bg-maroon-700 text-white shadow-lg' : 'text-zinc-500 hover:text-maroon-700'" class="flex-1 py-3 rounded-xl font-bold transition-all duration-300">Zakat Maal</button>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-sm font-black text-zinc-400 uppercase tracking-widest pl-2">Penghasilan Per Bulan</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-zinc-400">Rp</span>
                                    <input type="number" x-model="income" class="w-full bg-white border-none rounded-2xl py-5 pl-14 pr-6 focus:ring-2 focus:ring-maroon-500 shadow-sm text-lg font-bold" placeholder="0">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-black text-zinc-400 uppercase tracking-widest pl-2">Bonus / THR / Pendapatan Lain</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-zinc-400">Rp</span>
                                    <input type="number" x-model="bonus" class="w-full bg-white border-none rounded-2xl py-5 pl-14 pr-6 focus:ring-2 focus:ring-maroon-500 shadow-sm text-lg font-bold" placeholder="0">
                                </div>
                            </div>
                            <div class="p-6 bg-amber-50 rounded-2xl border-l-4 border-amber-400">
                                <div class="flex gap-4">
                                    <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div>
                                        <p class="text-sm font-bold text-amber-900">Info Nisab</p>
                                        <p class="text-xs text-amber-800/80 leading-relaxed mt-1">Nisab Zakat Profesi setara dengan 522 kg beras atau 85 gr emas per tahun. Saat ini estimasi nisab per bulan: <span class="font-bold">Rp <span x-text="Math.round(nisab).toLocaleString('id-ID')"></span></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Perhitungan -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-zinc-100 flex flex-col justify-between h-full relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-maroon-50 rounded-full -translate-y-1/2 translate-x-1/2 transition-transform group-hover:scale-110"></div>
                        
                        <div class="relative z-10">
                            <p class="text-sm font-black text-zinc-400 uppercase tracking-widest mb-2">Jumlah Zakat Anda</p>
                            <h3 class="text-5xl font-black text-maroon-800 mb-4" x-text="'Rp ' + zakatAmount.toLocaleString('id-ID')"></h3>
                            <div class="h-1 w-20 bg-amber-400 rounded-full mb-8"></div>
                            
                            <template x-if="totalIncome > 0 && !isNisab">
                                <p class="text-sm text-zinc-500 leading-relaxed">Penghasilan Anda belum mencapai nisab. Anda belum wajib zakat, namun sangat dianjurkan untuk <span class="text-maroon-700 font-bold">berinfaq/sedekah</span>.</p>
                            </template>
                            <template x-if="isNisab">
                                <p class="text-sm text-zinc-500 leading-relaxed">Maa syaa Allah, harta Anda telah mencapai nisab. Menunaikan zakat akan mensucikan harta dan membawa keberkahan.</p>
                            </template>
                        </div>

                        <div class="relative z-10 mt-12 space-y-4">
                            <a href="#" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform active:scale-95">
                                Bayar Zakat Sekarang
                            </a>
                            <p class="text-center text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Pembayaran Aman via Bank, QRIS, & E-Wallet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jenis Zakat -->
    <section id="jenis-zakat" class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4">Kenali Jenis Zakat</h2>
                    <p class="text-zinc-500 text-lg">Pahami berbagai jenis zakat untuk memastikan kewajiban Anda tertunaikan dengan tepat.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $zakatTypes = [
                        [
                            'title' => 'Zakat Profesi',
                            'desc' => 'Zakat yang dikeluarkan dari penghasilan rutin bulanan atau pendapatan profesional lainnya.',
                            'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                        ],
                        [
                            'title' => 'Zakat Maal',
                            'desc' => 'Zakat atas harta yang dimiliki (tabungan, emas, surat berharga) yang telah mengendap satu tahun.',
                            'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        [
                            'title' => 'Zakat Fitrah',
                            'desc' => 'Zakat wajib yang dikeluarkan setahun sekali pada bulan Ramadhan menjelang Idul Fitri.',
                            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
                        ]
                    ];
                @endphp

                @foreach($zakatTypes as $zt)
                <div class="bg-white p-10 rounded-[3rem] border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-maroon-50 text-maroon-700 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-maroon-700 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $zt['icon'] }}"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-zinc-900 mb-4">{{ $zt['title'] }}</h3>
                    <p class="text-zinc-500 leading-relaxed">{{ $zt['desc'] }}</p>
                    <div class="mt-8 pt-8 border-t border-zinc-50">
                        <a href="#" class="text-maroon-700 font-bold flex items-center gap-2 hover:gap-4 transition-all">
                            Tunaikan Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Mengapa Zakat di NusaFund -->
    <section class="py-24 bg-maroon-900 text-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/20 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-10">
                    <h2 class="text-3xl md:text-5xl font-black leading-tight">Mengapa Zakat <br>melalui <span class="text-amber-400">NusaFund?</span></h2>
                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/20">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Lembaga Terverifikasi</h4>
                                <p class="text-maroon-100 opacity-80">Bekerja sama langsung dengan BAZNAS dan LAZ resmi yang memiliki izin Kemenag RI.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/20">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Laporan Penyaluran Transparan</h4>
                                <p class="text-maroon-100 opacity-80">Dapatkan notifikasi dan laporan digital lengkap mengenai siapa yang menerima manfaat zakat Anda.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/20">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Sertifikat Zakat Digital</h4>
                                <p class="text-maroon-100 opacity-80">Setiap pembayaran zakat akan mendapatkan bukti potong zakat resmi yang bisa digunakan sebagai pengurang pajak.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?q=80&w=1471&auto=format&fit=crop" class="rounded-[3rem] shadow-2xl border-8 border-white/10" alt="Zakat NusaFund">
                    <div class="absolute -bottom-10 -right-10 bg-amber-500 p-8 rounded-3xl shadow-2xl text-maroon-950 max-w-[200px] animate-bounce-slow">
                        <p class="text-4xl font-black mb-1">100%</p>
                        <p class="text-[10px] font-black uppercase tracking-widest leading-tight">Aman & Terpercaya Sesuai Syariah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
