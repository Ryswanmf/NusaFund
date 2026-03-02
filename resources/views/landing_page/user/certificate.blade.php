<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Donasi - {{ $donation->transaction_id }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .cert-container { box-shadow: none; border: none; }
        }
        .cert-border {
            border: 20px solid #800000;
            border-image: linear-gradient(45deg, #800000, #b30000, #ffcc00) 1;
        }
    </style>
</head>
<body class="bg-zinc-100 flex items-center justify-center min-h-screen p-4 md:p-10">

    <div class="no-print fixed top-6 right-6 flex gap-4">
        <button onclick="window.print()" class="bg-maroon-800 text-white px-8 py-3 rounded-full font-black shadow-xl hover:bg-maroon-700 transition">
            Cetak Sertifikat (PDF)
        </button>
        <a href="{{ route('dashboard') }}" class="bg-white text-zinc-900 px-8 py-3 rounded-full font-black shadow-xl border border-zinc-200 hover:bg-zinc-50 transition">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="cert-container relative bg-white w-full max-w-4xl aspect-[1.414/1] shadow-2xl overflow-hidden p-12 text-center flex flex-col justify-between border-8 border-zinc-50">
        
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-maroon-50 rounded-full -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-50 rounded-full translate-x-1/3 translate-y-1/3 opacity-50"></div>

        <div class="relative z-10 border-4 border-double border-maroon-800 h-full p-10 flex flex-col justify-between">
            
            <!-- Header -->
            <div class="space-y-4">
                <h1 class="text-2xl font-black text-maroon-800 tracking-[0.3em] uppercase">Sertifikat Penghargaan</h1>
                <div class="w-24 h-1 bg-amber-500 mx-auto"></div>
                <p class="text-zinc-400 font-bold uppercase tracking-widest text-[10px]">Diberikan sebagai bentuk apresiasi kepada:</p>
            </div>

            <!-- Recipient -->
            <div class="space-y-2">
                <h2 class="text-5xl font-black text-zinc-900 tracking-tight">{{ $donation->user->name }}</h2>
                <p class="text-zinc-500 text-lg font-medium">Atas kontribusi nyata dalam menebar kebaikan melalui program:</p>
                <p class="text-2xl font-black text-maroon-700 mt-4">"{{ $donation->campaign->title }}"</p>
            </div>

            <!-- Details -->
            <div class="grid grid-cols-3 gap-8 text-center border-y border-zinc-100 py-8 mx-10">
                <div>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Jumlah Donasi</p>
                    <p class="text-xl font-black text-zinc-900">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Tanggal</p>
                    <p class="text-xl font-black text-zinc-900">{{ $donation->created_at->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">ID Transaksi</p>
                    <p class="text-xl font-black text-zinc-900">{{ substr($donation->transaction_id, 0, 8) }}</p>
                </div>
            </div>

            <!-- Footer Cert -->
            <div class="flex justify-between items-end px-10">
                <div class="text-left">
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-8">Tertanda,</p>
                    <p class="text-lg font-black text-zinc-900">Admin NusaFund</p>
                    <p class="text-[9px] font-bold text-zinc-400 uppercase tracking-widest">Platform Filantropi Indonesia</p>
                </div>
                <div class="text-right">
                    <!-- Placeholder QR Code Style -->
                    <div class="w-24 h-24 bg-zinc-50 border border-zinc-100 rounded-2xl flex items-center justify-center p-2 mx-auto mb-2">
                        <svg class="w-full h-full text-zinc-200" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v2h-3v-2zm-3 0h2v3h-2v-3zm3 3h3v2h-3v-2zm-3 0h2v3h-2v-3zm6-6h3v2h-3v-2zm0 3h3v2h-3v-2zm0 3h3v2h-3v-2z"/></svg>
                    </div>
                    <p class="text-[8px] font-bold text-zinc-300 uppercase tracking-widest">Sertifikat Digital Sah</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
