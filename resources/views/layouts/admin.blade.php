<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - NusaFund</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-zinc-900 antialiased bg-zinc-50">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-zinc-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <div class="flex flex-col h-full">
                <!-- Logo Area -->
                <div class="p-8">
                    <a href="/" class="flex items-center gap-2 group transition">
                        @php $settings = \App\Models\Setting::first(); @endphp
                        @if($settings && $settings->site_logo)
                            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-8 w-auto">
                        @else
                            <span class="text-2xl font-black text-maroon-800 tracking-tighter">Nusa<span class="text-amber-500">Fund</span></span>
                        @endif
                        <span class="bg-maroon-50 text-maroon-700 text-[10px] font-black px-2 py-0.5 rounded-md uppercase ml-2">Admin</span>
                    </a>
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 px-6 space-y-2 overflow-y-auto pb-10">
                    <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-4 px-2">Menu Utama</div>
                    
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.dashboard') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-bold text-sm">Dashboard</span>
                    </a>

                    <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-4 px-2">Transaksi</div>

                    <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.transactions.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">Donasi Masuk</span>
                    </a>

                    <a href="{{ route('admin.zakat_transactions.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.zakat_transactions.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <span class="font-bold text-sm">Zakat Masuk</span>
                    </a>

                    <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-4 px-2">Pengelolaan</div>

                    <a href="{{ route('admin.donasi.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.donasi.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="font-bold text-sm">Kelola Campaign</span>
                    </a>

                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.kategori.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <span class="font-bold text-sm">Kelola Kategori</span>
                    </a>

                    <a href="{{ route('admin.updates.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.updates.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span class="font-bold text-sm">Kabar Terbaru</span>
                    </a>

                    <a href="{{ route('admin.donatur.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.donatur.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-bold text-sm">Kelola Donatur</span>
                    </a>

                    <a href="{{ route('admin.event.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.event.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-bold text-sm">Kelola Event</span>
                    </a>

                    <a href="{{ route('admin.event_registrations.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.event_registrations.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-bold text-sm">Peserta Event</span>
                    </a>

                    <a href="{{ route('admin.zakat.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.zakat.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">Kelola Zakat</span>
                    </a>

                    <a href="{{ route('admin.galang_dana.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.galang_dana.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span class="font-bold text-sm">Kelola Galang Dana</span>
                    </a>

                    <a href="{{ route('admin.about.edit') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.about.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">Kelola Tentang Kami</span>
                    </a>

                    <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-4 px-2">Pengaturan</div>

                    <a href="{{ route('admin.hero.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.hero.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                        <span class="font-bold text-sm">Kelola Banner</span>
                    </a>

                    <a href="{{ route('admin.testimoni.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.testimoni.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        <span class="font-bold text-sm">Kelola Testimoni</span>
                    </a>

                    <a href="{{ route('admin.bantuan.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.bantuan.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="font-bold text-sm">Kelola Bantuan</span>
                    </a>

                    <a href="{{ route('admin.syarat-ketentuan.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.syarat-ketentuan.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="font-bold text-sm">Kelola Syarat & Ketentuan</span>
                    </a>

                    <a href="{{ route('admin.kebijakan-privasi.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.kebijakan-privasi.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="font-bold text-sm">Kelola Kebijakan Privasi</span>
                    </a>

                    <a href="{{ route('admin.faq.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.faq.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">Kelola FAQ</span>
                    </a>

                    <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.settings.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-bold text-sm">Pengaturan Website</span>
                    </a>
                </nav>

                <!-- Footer Sidebar (Profile & Logout) -->
                <div class="p-6 mt-auto border-t border-zinc-100 bg-zinc-50/50">
                    <div class="flex items-center gap-4 mb-6 px-2">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center text-maroon-950 font-black">AD</div>
                        <div class="min-w-0">
                            <p class="text-sm font-black text-zinc-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest truncate">Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white border border-zinc-200 text-zinc-600 font-bold text-sm hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar Panel
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Mobile Header -->
            <header class="lg:hidden flex items-center justify-between p-6 bg-white border-b border-zinc-200">
                <span class="text-xl font-black text-maroon-800">Admin<span class="text-amber-500">Panel</span></span>
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-zinc-500 hover:bg-zinc-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </header>

            <main class="flex-1 relative overflow-y-auto focus:outline-none bg-zinc-50">
                <div class="py-10">
                    <div class="max-w-[1600px] mx-auto px-6 md:px-10 lg:px-12">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    <x-toast />
</body>
</html>
