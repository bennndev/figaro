@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4 space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md opacity-50 cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md hover:bg-gray-200">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-white text-[#2A2A2A] font-bold border border-[#2A2A2A] rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md hover:bg-gray-200">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md hover:bg-gray-200">&raquo;</a>
        @else
            <span class="px-3 py-1 bg-white text-[#2A2A2A] rounded-md opacity-50 cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
@endif
