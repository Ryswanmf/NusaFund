@extends('layouts.admin')

@section('content')
<div class="max-w-2xl space-y-10">
    <div>
        <a href="{{ route('admin.donatur.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-400 hover:text-maroon-700 transition gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">Profil User</span></h1>
    </div>

    <form action="{{ route('admin.donatur.update', $donatur) }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-10 md:p-16 space-y-8">
        @csrf @method('PUT')
        
        <div class="space-y-6">
            <div class="flex items-center gap-6 p-6 bg-zinc-50 rounded-3xl border border-zinc-100 mb-8">
                <div class="w-16 h-16 rounded-2xl bg-maroon-800 text-white flex items-center justify-center text-xl font-black">{{ strtoupper(substr($donatur->name, 0, 2)) }}</div>
                <div>
                    <p class="text-lg font-black text-zinc-900">{{ $donatur->name }}</p>
                    <p class="text-sm text-zinc-400 font-medium">{{ $donatur->email }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $donatur->name }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Tipe Akun (Role)</label>
                <select name="usertype" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                    <option value="user" {{ $donatur->usertype == 'user' ? 'selected' : '' }}>User (Donatur)</option>
                    <option value="admin" {{ $donatur->usertype == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                <p class="text-[10px] text-zinc-400 pl-2 mt-2">Hati-hati: Memberikan akses Admin memungkinkan user mengelola seluruh data platform.</p>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-maroon-700 transition shadow-xl shadow-maroon-900/20">
            Simpan Perubahan User
        </button>
    </form>
</div>
@endsection
