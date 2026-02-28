<x-app-layout>
    <div class="flex h-screen bg-zinc-50 overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar (Desktop) -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-zinc-200 bg-white shadow-sm">
                <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-6 mb-8">
                        <span class="text-2xl font-black text-maroon-800">Admin<span class="text-amber-500">Panel</span></span>
                    </div>
                    <nav class="flex-1 px-4 space-y-2">
                        <a href="#" class="bg-maroon-50 text-maroon-700 group flex items-center px-4 py-3 text-sm font-black rounded-2xl transition">
                            <svg class="mr-3 h-5 w-5 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                        <a href="#" class="text-zinc-500 hover:bg-zinc-50 hover:text-maroon-700 group flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition">
                            <svg class="mr-3 h-5 w-5 text-zinc-400 group-hover:text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Campaigns
                        </a>
                        <a href="#" class="text-zinc-500 hover:bg-zinc-50 hover:text-maroon-700 group flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition">
                            <svg class="mr-3 h-5 w-5 text-zinc-400 group-hover:text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Donatur
                        </a>
                        <a href="#" class="text-zinc-500 hover:bg-zinc-50 hover:text-maroon-700 group flex items-center px-4 py-3 text-sm font-bold rounded-2xl transition">
                            <svg class="mr-3 h-5 w-5 text-zinc-400 group-hover:text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Transaksi
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative overflow-y-auto focus:outline-none py-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <h1 class="text-3xl font-black text-zinc-900 mb-8">Dashboard <span class="text-maroon-700">Ringkasan</span></h1>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-zinc-100 flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                <span class="text-xs font-black text-green-500 bg-green-50 px-3 py-1 rounded-full">+12%</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Donasi</p>
                                <p class="text-2xl font-black text-zinc-900">Rp 2.5 Miliar</p>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-zinc-100 flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-maroon-50 text-maroon-600 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg></div>
                                <span class="text-xs font-black text-amber-500 bg-amber-50 px-3 py-1 rounded-full">Active</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Campaign Aktif</p>
                                <p class="text-2xl font-black text-zinc-900">542 Program</p>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-zinc-100 flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                                <span class="text-xs font-black text-blue-500 bg-blue-50 px-3 py-1 rounded-full">Verified</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Total Donatur</p>
                                <p class="text-2xl font-black text-zinc-900">12,450 User</p>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-zinc-100 flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-green-50 text-green-600 rounded-2xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
                                <span class="text-xs font-black text-zinc-400 bg-zinc-50 px-3 py-1 rounded-full">Trust</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-1">Penyaluran</p>
                                <p class="text-2xl font-black text-zinc-900">98.5% Efektif</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Table -->
                    <div class="bg-white rounded-[3rem] shadow-sm border border-zinc-100 overflow-hidden">
                        <div class="px-10 py-8 border-b border-zinc-50 flex items-center justify-between">
                            <h3 class="text-xl font-black text-zinc-900">Transaksi <span class="text-maroon-700">Terbaru</span></h3>
                            <button class="text-sm font-bold text-maroon-700 hover:text-maroon-800 transition">Lihat Semua</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-zinc-50">
                                <thead class="bg-zinc-50/50">
                                    <tr>
                                        <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Donatur</th>
                                        <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Campaign</th>
                                        <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Jumlah</th>
                                        <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Status</th>
                                        <th class="px-10 py-5 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-50">
                                    @foreach([1,2,3,4,5] as $i)
                                    <tr class="hover:bg-zinc-50/50 transition">
                                        <td class="px-10 py-6 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-2xl bg-zinc-100 flex items-center justify-center text-zinc-400 font-bold">D</div>
                                                <span class="text-sm font-bold text-zinc-900">Donatur Anonim</span>
                                            </div>
                                        </td>
                                        <td class="px-10 py-6 whitespace-nowrap text-sm text-zinc-500 font-medium">Bantu Renovasi Sekolah...</td>
                                        <td class="px-10 py-6 whitespace-nowrap text-sm font-black text-maroon-700">Rp 500.000</td>
                                        <td class="px-10 py-6 whitespace-nowrap">
                                            <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest text-green-600 bg-green-50 rounded-full">Berhasil</span>
                                        </td>
                                        <td class="px-10 py-6 whitespace-nowrap text-sm text-zinc-400 font-medium">28 Feb 2026</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
