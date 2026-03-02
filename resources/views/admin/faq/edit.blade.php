@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 tracking-tight">Edit <span class="text-maroon-700">FAQ</span></h1>
            <p class="text-zinc-500 mt-2 font-medium">Perbarui tanya jawab untuk memberikan informasi terbaru.</p>
        </div>
        <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center gap-2 text-zinc-400 hover:text-maroon-700 font-bold transition group">
            <svg class="w-5 h-5 transition group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.faq.update', $faq) }}" method="POST" class="bg-white rounded-[3.5rem] shadow-sm border border-zinc-100 p-8 md:p-16 space-y-10">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Pertanyaan</label>
                <input type="text" name="question" value="{{ old('question', $faq->question) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                @error('question') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Jawaban</label>
                <textarea name="answer" rows="6" required class="w-full bg-zinc-50 border-none rounded-[2rem] py-6 px-8 focus:ring-2 focus:ring-maroon-500 font-medium text-zinc-600 leading-relaxed">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer') <p class="text-red-600 text-[10px] font-black mt-1 pl-2">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest pl-2">Urutan Tampil</label>
                    <input type="number" name="order" value="{{ old('order', $faq->order) }}" required class="w-full bg-zinc-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-maroon-500 font-bold text-zinc-900">
                </div>
                <div class="flex items-center gap-4 h-full pt-6">
                    <input type="checkbox" name="is_published" id="is_published" {{ $faq->is_published ? 'checked' : '' }} class="w-6 h-6 rounded-lg border-zinc-200 text-maroon-700 focus:ring-maroon-500">
                    <label for="is_published" class="text-sm font-black text-zinc-700 cursor-pointer">Publikasikan FAQ ini</label>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-maroon-800 text-white py-6 rounded-full font-black text-lg uppercase tracking-widest hover:bg-maroon-700 transition shadow-2xl shadow-maroon-900/40 transform active:scale-[0.98]">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
