<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Donasi - NusaFund</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-50 font-sans text-zinc-900 antialiased">
    <!-- Navbar -->
    <nav class="bg-maroon-800 text-white shadow-sm sticky top-0 z-50 border-b border-maroon-700/50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-8 flex-1">
                    <a href="/" class="flex-shrink-0 flex items-center gap-2 group transition">
                        <span class="text-2xl font-bold tracking-tight text-white group-hover:text-amber-400 transition">Nusa<span class="text-amber-400 font-extrabold group-hover:text-white transition">Fund</span></span>
                    </a>
                </div>
                <div class="hidden lg:flex items-center space-x-6 text-sm font-semibold">
                    <a href="/" class="text-maroon-100 hover:text-amber-400 transition">Beranda</a>
                    <a href="{{ route('donasi.index') }}" class="text-maroon-100 hover:text-amber-400 transition">Donasi</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-6 py-2.5 rounded-full font-bold transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-6 py-2.5 rounded-full font-bold transition">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm font-medium text-zinc-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="/" class="hover:text-maroon-700">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('donasi.index') }}" class="hover:text-maroon-700">Donasi</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-zinc-800 truncate max-w-[200px] md:max-w-none">Bantu Renovasi Sekolah Dasar di Pelosok NTT</li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sisi Kiri: Konten Utama -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Hero Image & Title -->
                    <div class="space-y-6">
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-video">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb8?q=80&w=1470&auto=format&fit=crop" alt="Campaign Hero" class="w-full h-full object-cover">
                            <div class="absolute top-6 left-6 flex gap-3">
                                <span class="bg-maroon-600/90 backdrop-blur-md text-white text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">Mendesak</span>
                                <span class="bg-white/90 backdrop-blur-md text-zinc-900 text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest shadow-lg">Pendidikan</span>
                            </div>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black text-zinc-900 leading-tight">Bantu Renovasi Sekolah Dasar di Pelosok NTT</h1>
                        
                        <!-- Fundraiser Info -->
                        <div class="flex items-center gap-4 p-4 bg-white rounded-3xl border border-zinc-100 shadow-sm">
                            <div class="w-12 h-12 rounded-full bg-maroon-100 flex items-center justify-center text-maroon-700 font-bold">NF</div>
                            <div>
                                <div class="flex items-center gap-1">
                                    <p class="font-bold text-zinc-900">Yayasan Nusa Kebaikan</p>
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                                <p class="text-xs text-zinc-400 font-medium">Terverifikasi sebagai Lembaga Resmi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs & Content -->
                    <div x-data="{ tab: 'cerita' }" class="space-y-8">
                        <div class="flex border-b border-zinc-200">
                            <button @click="tab = 'cerita'" :class="tab === 'cerita' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-lg border-b-4 transition-all">Cerita</button>
                            <button @click="tab = 'updates'" :class="tab === 'updates' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-lg border-b-4 transition-all">Update (2)</button>
                            <button @click="tab = 'donatur'" :class="tab === 'donatur' ? 'border-maroon-700 text-maroon-700' : 'border-transparent text-zinc-400 hover:text-zinc-600'" class="px-8 py-4 font-bold text-lg border-b-4 transition-all">Donatur (124)</button>
                        </div>

                        <div x-show="tab === 'cerita'" class="prose prose-zinc lg:prose-xl max-w-none text-zinc-600 leading-relaxed space-y-6">
                            <p class="text-xl font-medium text-zinc-900 leading-snug">"Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." - Nelson Mandela</p>
                            <p>Halo Orang Baik, perkenalkan kami dari Yayasan Nusa Kebaikan. Saat ini kami sedang berupaya menggalang dana untuk renovasi Sekolah Dasar Inpres di pelosok NTT yang kondisinya sangat memprihatinkan.</p>
                            <p>Sudah lebih dari 10 tahun sekolah ini belum mendapatkan renovasi. Atap yang bocor saat hujan, lantai tanah yang berdebu saat kemarau, dan bangku-bangku yang mulai lapuk menjadi teman belajar sehari-hari bagi 150 siswa di sini.</p>
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1470&auto=format&fit=crop" class="rounded-3xl shadow-lg w-full" alt="Kondisi Sekolah">
                            <p>Meskipun dengan keterbatasan yang ada, semangat belajar mereka tidak pernah luntur. Mereka rela berjalan kaki berjam-jam melewati bukit hanya untuk mengejar cita-cita mereka.</p>
                            <div class="bg-amber-50 p-8 rounded-[2rem] border-l-8 border-amber-400">
                                <p class="font-bold text-amber-900 mb-2 italic">Rencana Penggunaan Dana:</p>
                                <ul class="list-disc pl-5 text-amber-900 space-y-2 font-medium">
                                    <li>Perbaikan Atap dan Plafon (Rp 25.000.000)</li>
                                    <li>Pengecoran Lantai dan Pemasangan Keramik (Rp 15.000.000)</li>
                                    <li>Pembelian Bangku dan Meja Baru (Rp 10.000.000)</li>
                                    <li>Pengecatan dan Perbaikan Pintu/Jendela (Rp 10.000.000)</li>
                                </ul>
                            </div>
                        </div>

                        <div x-show="tab === 'updates'" class="space-y-8">
                            <div class="relative pl-10 before:absolute before:left-3 before:top-2 before:bottom-0 before:w-0.5 before:bg-zinc-200">
                                <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-maroon-600 border-4 border-zinc-50 shadow-sm"></div>
                                <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm space-y-3">
                                    <p class="text-xs font-black text-maroon-600 uppercase tracking-widest">24 Februari 2026</p>
                                    <p class="font-bold text-zinc-900 text-lg">Survey Lokasi dan Penyerahan Tahap 1</p>
                                    <p class="text-zinc-600">Alhamdulillah, berkat dukungan teman-teman, kami sudah melakukan survey mendalam dan menyerahkan material tahap awal berupa semen dan kayu.</p>
                                </div>
                            </div>
                        </div>

                        <div x-show="tab === 'donatur'" class="space-y-4">
                            @foreach([1,2,3] as $i)
                            <div class="bg-white p-6 rounded-3xl border border-zinc-100 shadow-sm flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg></div>
                                <div class="flex-1">
                                    <p class="font-bold text-zinc-900">Donatur Anonim</p>
                                    <p class="text-xs text-zinc-400 font-medium">Berdonasi sebesar <span class="text-maroon-700 font-bold uppercase tracking-wider">Rp 500.000</span></p>
                                </div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">2 Jam Lalu</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: Widget Donasi (Sticky) -->
                <div class="space-y-8">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-zinc-100 shadow-2xl space-y-8">
                            <div>
                                <p class="text-4xl font-black text-maroon-800 mb-2">Rp 45.000.000</p>
                                <div class="flex justify-between items-center text-sm font-bold text-zinc-400 mb-4 uppercase tracking-widest">
                                    <span>Terkumpul dari <span class="text-zinc-900">Rp 60.000.000</span></span>
                                    <span class="text-maroon-700">75%</span>
                                </div>
                                <div class="w-full bg-zinc-100 h-4 rounded-full overflow-hidden mb-6">
                                    <div class="bg-maroon-600 h-full rounded-full transition-all duration-1000 shadow-lg" style="width: 75%"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        <p class="text-2xl font-black text-zinc-900">124</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Donatur</p>
                                    </div>
                                    <div class="bg-zinc-50 p-4 rounded-2xl text-center">
                                        <p class="text-2xl font-black text-zinc-900">12</p>
                                        <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Hari Lagi</p>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="block w-full text-center bg-amber-500 hover:bg-amber-400 text-maroon-950 py-5 rounded-2xl font-black text-xl shadow-xl shadow-amber-900/20 transition transform active:scale-95 group">
                                Donasi Sekarang
                                <svg class="w-6 h-6 inline-block ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>

                            <div class="pt-6 border-t border-zinc-100">
                                <p class="text-center text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Bagikan Campaign Ini</p>
                                <div class="flex justify-center gap-4">
                                    <button class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-zinc-600 hover:bg-maroon-600 hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                                    <button class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-zinc-600 hover:bg-blue-400 hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></button>
                                    <button class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center text-zinc-600 hover:bg-green-500 hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></button>
                                </div>
                            </div>
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
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-950 text-zinc-400 pt-16 pb-12 border-t border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600">
                <p>&copy; 2026 NusaFund Indonesia. Terdaftar Kemensos RI.</p>
                <div class="flex items-center gap-6">
                    <a href="/" class="text-white font-bold tracking-tight">Nusa<span class="text-amber-400">Fund</span></a>
                    <span class="text-zinc-500">Transparansi Keuangan 100%</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
