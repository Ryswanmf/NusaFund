@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-zinc-100 text-zinc-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-600 hover:bg-maroon-800 hover:text-white hover:border-maroon-800 transition-all shadow-sm active:scale-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden md:flex items-center gap-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-12 h-12 flex items-center justify-center text-zinc-400 font-bold">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-maroon-800 text-white font-black text-sm shadow-xl shadow-maroon-900/20">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-600 font-bold text-sm hover:bg-maroon-50 hover:text-maroon-700 hover:border-maroon-200 transition-all shadow-sm active:scale-90">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Mobile Current Page Indicator --}}
        <div class="md:hidden flex items-center px-4 font-black text-sm text-zinc-900">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-zinc-200 text-zinc-600 hover:bg-maroon-800 hover:text-white hover:border-maroon-800 transition-all shadow-sm active:scale-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </a>
        @else
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-zinc-100 text-zinc-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </span>
        @endif
    </nav>
@endif
