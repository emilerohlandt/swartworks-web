@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between text-xs">
        <!-- Results Counter -->
        <div>
            <p class="text-zinc-400">
                Showing
                <span class="font-semibold text-zinc-200">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-semibold text-zinc-200">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-semibold text-zinc-200">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <!-- Buttons -->
        <div class="inline-flex rounded-lg shadow-sm -space-x-px">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-zinc-600 bg-zinc-900/50 border border-zinc-700/80 rounded-l-lg cursor-not-allowed">
                    &lsaquo;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-zinc-300 bg-zinc-900 border border-zinc-700/80 rounded-l-lg hover:bg-zinc-800 hover:text-white transition-colors">
                    &lsaquo;
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="px-3 py-2 text-white bg-indigo-600 border border-indigo-500 font-semibold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 text-zinc-300 bg-zinc-900 border border-zinc-700/80 hover:bg-zinc-800 hover:text-white transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-zinc-300 bg-zinc-900 border border-zinc-700/80 rounded-r-lg hover:bg-zinc-800 hover:text-white transition-colors">
                    &rsaquo;
                </a>
            @else
                <span class="px-3 py-2 text-zinc-600 bg-zinc-900/50 border border-zinc-700/80 rounded-r-lg cursor-not-allowed">
                    &rsaquo;
                </span>
            @endif
        </div>
    </nav>
@endif
