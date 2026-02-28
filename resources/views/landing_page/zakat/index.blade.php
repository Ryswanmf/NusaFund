@extends('layouts.landing')

@section('title', 'Zakat Online - NusaFund')

@section('content')
    <!-- Hero Section Zakat (Tetap) -->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalkulator Zakat (Tetap) -->
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
                                <label class="text-xs font-black text-zinc-400 uppercase tracking-widest pl-2">Penghasilan Per Bulan</label>
                                <input type="number" x-model="income" class="w-full bg-white border-none rounded-2xl py-5 px-6 focus:ring-2 focus:ring-maroon-500 shadow-sm text-lg font-bold" placeholder="0">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-zinc-400 uppercase tracking-widest pl-2">Bonus / Pendapatan Lain</label>
                                <input type="number" x-model="bonus" class="w-full bg-white border-none rounded-2xl py-5 px-6 focus:ring-2 focus:ring-maroon-500 shadow-sm text-lg font-bold" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <!-- Hasil -->
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-zinc-100 flex flex-col justify-between h-full relative overflow-hidden">
                        <div>
                            <p class="text-sm font-black text-zinc-400 uppercase tracking-widest mb-2">Jumlah Zakat Anda</p>
                            <h3 class="text-5xl font-black text-maroon-800 mb-4" x-text="'Rp ' + zakatAmount.toLocaleString('id-ID')"></h3>
                            <div class="h-1 w-20 bg-amber-400 rounded-full mb-8"></div>
                            <p class="text-sm text-zinc-500 leading-relaxed" x-text="isNisab ? 'Maa syaa Allah, harta Anda telah mencapai nisab.' : 'Penghasilan Anda belum mencapai nisab.'"></p>
                        </div>
                        <div class="mt-12">
                            <a href="#" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform active:scale-95">Bayar Zakat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Zakat Unggulan (Dinamis dari Database) -->
    <section class="py-24 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4">Program <span class="text-maroon-700">Zakat Unggulan</span></h2>
                    <p class="text-zinc-500 text-lg">Pilih program penyaluran zakat yang paling sesuai dengan keinginan Anda untuk membantu sesama.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($zakats as $z)
                <div class="bg-white rounded-[3rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 group flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @if($z->image)
                            <img src="{{ asset('storage/' . $z->image) }}" alt="{{ $z->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-maroon-50 flex items-center justify-center text-maroon-200 font-black text-3xl">ZAKAT</div>
                        @endif
                        <div class="absolute top-5 left-5">
                            <span class="bg-amber-500/90 backdrop-blur-md text-maroon-950 text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $z->asnaf_category }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-zinc-900 mb-4 line-clamp-2 group-hover:text-maroon-700 transition">{{ $z->title }}</h3>
                        <p class="text-zinc-500 text-sm line-clamp-3 mb-6">{{ $z->description }}</p>
                        
                        <div class="mt-auto pt-6 border-t border-zinc-50 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Lembaga Penyalur</span>
                                <span class="text-sm font-bold text-zinc-900">{{ $z->institution }}</span>
                            </div>
                            <a href="#" class="block w-full text-center bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300">Tunaikan Zakat</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-zinc-400 font-medium">Belum ada program zakat aktif saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
