@if ($paginator->hasPages())
    <ul class="pagination-list">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pagination-item pagination-item-prev">
                <a class="disabled">Назад</a>
            </li>
        @else
            <li class="pagination-item pagination-item-prev">
                <a href="{{ $paginator->previousPageUrl() }}">Назад</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination-item pagination-item-active">
                            <a>{{ $page }}</a>
                        </li>
                    @else
                        <li class="pagination-item">
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-item pagination-item-next">
                <a href="{{ $paginator->nextPageUrl() }}">Вперед</a>
            </li>
        @else
            <li class="pagination-item pagination-item-next">
                <a class="disabled">Вперед</a>
            </li>
        @endif
    </ul>
@endif
