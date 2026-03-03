<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piagam Penghargaan - {{ $donation->transaction_id }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:700,900|instrument-sans:400,500,600,700|dancing-script:700" rel="stylesheet" />
    @vite(['resources/css/app.css'])
    <style>
        body { font-family: 'Instrument Sans', sans-serif; background-color: #f8f9fa; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-signature { font-family: 'Dancing Script', cursive; }
        
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .cert-outer { box-shadow: none !important; border: none !important; margin: 0 !important; width: 100vw !important; height: 100vh !important; padding: 0 !important; }
            .cert-main { border: 12px solid #800000 !important; }
        }

        .cert-outer {
            background: #fff;
            padding: 30px;
            position: relative;
            box-shadow: 0 30px 70px rgba(0,0,0,0.08);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23800000' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .cert-main {
            border: 8px solid #800000;
            height: 100%;
            width: 100%;
            padding: 30px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.98);
        }

        .corner-ornament {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 3px solid #f59e0b;
            z-index: 20;
        }
        .top-left { top: -4px; left: -4px; border-right: none; border-bottom: none; }
        .top-right { top: -4px; right: -4px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: -4px; left: -4px; border-right: none; border-top: none; }
        .bottom-right { bottom: -4px; right: -4px; border-left: none; border-top: none; }

        .animate-spin-slow {
            animation: spin 15s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-2 md:p-6">

    <!-- Navbar Actions -->
    <div class="no-print fixed top-4 flex gap-2 z-[100]">
        <button onclick="window.print()" class="bg-maroon-800 text-white px-6 py-2.5 rounded-full font-black shadow-lg hover:bg-maroon-700 transition-all text-xs flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak (A4)
        </button>
        <a href="{{ route('dashboard') }}" class="bg-white text-zinc-900 px-6 py-2.5 rounded-full font-black shadow-md border border-zinc-200 hover:bg-zinc-50 transition-all text-xs flex items-center gap-2">
            Dashboard
        </a>
    </div>

    <!-- Main Certificate Content -->
    <div class="cert-outer w-full max-w-4xl aspect-[1.414/1] print:aspect-auto">
        <div class="cert-main">
            <!-- Decorative Corners -->
            <div class="corner-ornament top-left"></div>
            <div class="corner-ornament top-right"></div>
            <div class="corner-ornament bottom-left"></div>
            <div class="corner-ornament bottom-right"></div>

            <!-- Header -->
            <div class="text-center space-y-3 pt-2">
                <div class="flex items-center justify-center gap-1.5 mb-1">
                    <span class="text-xl font-black text-maroon-800 tracking-tighter">Nusa<span class="text-amber-500">Fund</span></span>
                </div>
                <h1 class="text-2xl md:text-4xl font-serif font-black text-maroon-950 tracking-[0.1em] uppercase">Piagam Penghargaan</h1>
                <div class="flex items-center justify-center gap-4">
                    <div class="h-px w-12 bg-amber-500/40"></div>
                    <p class="text-[9px] font-black text-amber-600 uppercase tracking-[0.4em]">Kebaikan Anda Menginspirasi Dunia</p>
                    <div class="h-px w-12 bg-amber-500/40"></div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="text-center space-y-6">
                <div class="space-y-1">
                    <p class="text-zinc-400 font-bold uppercase tracking-[0.2em] text-[8px]">Diberikan Dengan Rasa Hormat Kepada:</p>
                    <div class="py-2">
                        <h2 class="text-3xl md:text-5xl font-serif font-bold text-zinc-900 tracking-tight px-8 inline-block border-b border-amber-500/20 italic">{{ $donorName }}</h2>
                    </div>
                </div>
                
                <div class="max-w-xl mx-auto space-y-3">
                    <p class="text-zinc-500 text-xs md:text-sm font-medium leading-relaxed">
                        Atas sumbangsih dan kontribusi yang luar biasa dalam mendukung kemanusiaan melalui program penggalangan dana:
                    </p>
                    <p class="text-lg md:text-xl font-black text-maroon-800 tracking-tight px-5 py-1.5 bg-maroon-50/50 rounded-xl border border-maroon-100/50 inline-block">
                        "{{ $donation->campaign->title }}"
                    </p>
                </div>
            </div>

            <!-- Stats & Seal -->
            <div class="w-full max-w-3xl mx-auto flex items-center justify-between px-6 gap-6">
                <div class="flex-1 text-center py-4 border-y border-zinc-100">
                    <p class="text-[8px] font-black text-zinc-400 uppercase tracking-widest mb-0.5">Nominal Donasi</p>
                    <p class="text-base md:text-lg font-serif font-black text-zinc-900">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                </div>

                <!-- Seal -->
                <div class="relative flex-shrink-0 w-24 h-24 md:w-28 md:h-28 flex items-center justify-center">
                    <svg class="absolute inset-0 w-full h-full text-amber-500/10 animate-spin-slow" viewBox="0 0 100 100">
                        <path id="circlePath" fill="transparent" d="M 50, 50 m -40, 0 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0" />
                        <text class="text-[7.5px] font-black uppercase tracking-[0.3em] fill-amber-600/60">
                            <textPath xlink:href="#circlePath">★ NUSAFUND INDONESIA ★ PAHLAWAN KEBAIKAN ★ </textPath>
                        </text>
                    </svg>
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-amber-500 rounded-full flex items-center justify-center shadow-xl border-4 border-white relative z-10">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                </div>

                <div class="flex-1 text-center py-4 border-y border-zinc-100">
                    <p class="text-[8px] font-black text-zinc-400 uppercase tracking-widest mb-0.5">Tanggal Terbit</p>
                    <p class="text-base md:text-lg font-serif font-black text-zinc-900">{{ $donation->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="w-full flex justify-between items-end px-6 pb-2">
                <div class="space-y-4">
                    <div class="space-y-0">
                        <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest">Tertanda,</p>
                        <p class="text-2xl font-signature text-maroon-900 pt-1">NusaFund Admin</p>
                        <div class="h-px w-32 bg-zinc-200"></div>
                        <p class="text-[8px] font-black text-zinc-400 uppercase tracking-[0.2em] pt-1.5">Official Digital Document</p>
                    </div>
                </div>
                
                <div class="flex flex-col items-center">
                    <p class="text-[7px] font-black text-zinc-300 uppercase tracking-widest mb-2">No: {{ strtoupper(substr($donation->transaction_id, 3, 10)) }}</p>
                    <div class="w-16 h-16 bg-zinc-50 border border-zinc-100 rounded-2xl p-2 flex items-center justify-center shadow-inner">
                        <svg class="w-full h-full text-zinc-200" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v2h-3v-2zm-3 0h2v3h-2v-3zm6-6h3v2h-3v-2zm0 3h3v2h-3v-2zm0 3h3v2h-3v-2z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
