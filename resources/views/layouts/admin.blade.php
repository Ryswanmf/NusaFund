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
                        <span class="text-2xl font-black text-maroon-800 tracking-tighter">Nusa<span class="text-amber-500">Fund</span></span>
                        <span class="bg-maroon-50 text-maroon-700 text-[10px] font-black px-2 py-0.5 rounded-md uppercase">Admin</span>
                    </a>
                </div>

                <!-- Nav Links -->
                <nav class="flex-1 px-6 space-y-2 overflow-y-auto">
                    <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-4 px-2">Menu Utama</div>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('dashboard') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-bold text-sm">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.donasi.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.donasi.*') ? 'bg-maroon-800 text-white shadow-xl shadow-maroon-900/20' : 'text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="font-bold text-sm">Kelola Campaign</span>
                    </a>

                    <a href="#" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-bold text-sm">Donatur</span>
                    </a>

                    <a href="#" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-zinc-500 hover:bg-maroon-50 hover:text-maroon-700 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">Laporan Keuangan</span>
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
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
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
</body>
</html>
