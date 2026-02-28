@extends('layouts.admin')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Manajemen <span class="text-maroon-700">Donatur & User</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Pantau dan kelola hak akses seluruh pengguna NusaFund.</p>
        </div>
        
        <form action="{{ route('admin.donatur.index') }}" method="GET" class="relative group w-full md:w-80">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-zinc-400 group-focus-within:text-maroon-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." 
                   class="w-full bg-white border border-zinc-200 rounded-2xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-maroon-500 focus:border-transparent transition-all shadow-sm">
        </form>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-50 border border-red-100 text-red-600 px-6 py-4 rounded-2xl font-bold">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-50">
                <thead class="bg-zinc-50/50">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Profil User</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Tipe Akun</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Bergabung</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-zinc-50/50 transition">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-maroon-50 text-maroon-700 flex items-center justify-center font-black text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-black text-zinc-900 truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-zinc-400 font-medium truncate">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full 
                                {{ $user->usertype == 'admin' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-zinc-100 text-zinc-500' }}">
                                {{ $user->usertype }}
                            </span>
                        </td>
                        <td class="px-10 py-6 text-sm text-zinc-500 font-medium">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-10 py-6 text-right space-x-2">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.donatur.edit', $user) }}" class="p-3 bg-zinc-50 text-zinc-400 hover:text-maroon-700 rounded-2xl transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.donatur.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini selamanya?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-zinc-50 text-zinc-400 hover:text-red-600 rounded-2xl transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-10 py-20 text-center text-zinc-400">User tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-6 bg-zinc-50/30">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
