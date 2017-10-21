@if ($paginator->hasPages())
    <ul class="pager pagination-lg">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span style="border-radius: 0">&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="border-radius: 0">&laquo;</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="border-radius: 0">&raquo;</a></li>
        @else
            <li class="disabled"><span style="border-radius: 0">&raquo;</span></li>
        @endif
    </ul>
@endif