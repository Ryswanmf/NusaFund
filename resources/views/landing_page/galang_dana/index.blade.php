@extends('layouts.landing')

@section('title', 'Galang Dana - NusaFund')

@section('content')
    <!-- Hero Galang Dana -->
    <section class="relative bg-maroon-800 text-white py-24 overflow-hidden shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-black mb-8 leading-tight">Siapapun Bisa Menjadi <span class="text-amber-400">Pahlawan Kebaikan</span></h1>
                    <p class="text-lg text-maroon-50 mb-10 opacity-90 leading-relaxed max-w-xl">
                        Punya ide aksi sosial atau butuh bantuan untuk biaya pengobatan dan pendidikan? Mulai penggalangan dana Anda sendiri dengan aman dan transparan di NusaFund.
                    </p>
                    <a href="#" class="inline-block bg-amber-500 hover:bg-amber-400 text-maroon-950 px-10 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/40 transition transform hover:-translate-y-1">
                        Buat Galang Dana Sekarang
                    </a>
                </div>
                <div class="hidden lg:block relative">
                    <img src="https://images.unsplash.com/photo-1559027615-cd2671c15b82?q=80&w=1470&auto=format&fit=crop" class="rounded-[3rem] shadow-2xl border-8 border-white/10 rotate-2" alt="Raising Funds">
                </div>
            </div>
        </div>
    </section>

    <!-- Approved Campaigns -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <h2 class="text-3xl font-black text-zinc-900 mb-4">Galang Dana <span class="text-maroon-700">Masyarakat</span></h2>
                <p class="text-zinc-500 text-lg">Dukung inisiatif kebaikan yang dimulai oleh individu dan komunitas terpercaya.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($fundraisings as $fund)
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-zinc-100 shadow-sm hover:shadow-2xl transition-all duration-500 group flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        @if($fund->image)
                            <img src="{{ asset('storage/' . $fund->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold">NusaFund</div>
                        @endif
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $fund->organization_name }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-zinc-900 mb-6 line-clamp-2 group-hover:text-maroon-700 transition">{{ $fund->title }}</h3>
                        
                        <div class="mt-auto space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2 font-semibold">
                                    <span class="text-zinc-400 uppercase tracking-wider text-[10px]">Terkumpul</span>
                                    <span class="text-maroon-700 font-black">Rp {{ number_format($fund->collected_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-3 rounded-full overflow-hidden">
                                    @php $percent = ($fund->collected_amount / $fund->target_amount) * 100; @endphp
                                    <div class="bg-maroon-600 h-full rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                            <a href="#" class="block w-full text-center bg-maroon-50 text-maroon-700 hover:bg-maroon-700 hover:text-white py-4 rounded-2xl font-black transition-all duration-300">Donasi</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-zinc-50 rounded-[3rem] border border-dashed border-zinc-200">
                    <p class="text-zinc-400 font-medium">Belum ada campaign galang dana publik yang aktif.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
