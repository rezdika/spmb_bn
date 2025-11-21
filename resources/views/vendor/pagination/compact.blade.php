@if ($paginator->hasPages())
    <nav style="display: inline-flex; align-items: center; gap: 8px; font-size: 14px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="color: #ccc; cursor: not-allowed; padding: 4px 8px;">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="color: #666; text-decoration: none; padding: 4px 8px; border-radius: 3px;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="color: #666; padding: 4px 8px;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="background-color: #007bff; color: white; padding: 4px 8px; border-radius: 3px; min-width: 28px; text-align: center; display: inline-block;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="color: #666; text-decoration: none; padding: 4px 8px; border-radius: 3px; min-width: 28px; text-align: center; display: inline-block;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="color: #666; text-decoration: none; padding: 4px 8px; border-radius: 3px;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">&rsaquo;</a>
        @else
            <span style="color: #ccc; cursor: not-allowed; padding: 4px 8px;">&rsaquo;</span>
        @endif
    </nav>
@endif