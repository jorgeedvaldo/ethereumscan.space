@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Botão Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a>
        @endif

        {{-- Links de páginas --}}
        @foreach ($elements as $element)
            {{-- Reticências (...) --}}
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            {{-- Links de página --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botão Próximo --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a>
        @else
            <span class="disabled">Next →</span>
        @endif
    </div>
@endif
