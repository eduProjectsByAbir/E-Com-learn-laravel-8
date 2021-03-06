@if ($paginator->hasPages())
<div class="pagination-container">
        <ul class="list-inline list-unstyled">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="prev disabled"><i class="fa fa-angle-left"></i></li>
            @else
                <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                @else
                <li class="next disabled"><i class="fa fa-angle-right"></i></li>
            @endif
        </ul>
</div>
@endif
