@if ($paginator->hasPages())
    <ul class="pagination pagination-lg">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span style="border-radius: 0">@lang('pagination.previous')</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="border-radius: 0">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="border-radius: 0">@lang('pagination.next')</a></li>
        @else
            <li class="disabled"><span style="border-radius: 0">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif