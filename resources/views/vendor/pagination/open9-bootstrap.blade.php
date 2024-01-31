@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-center widget-pagination">
        <div class="d-none justify-content-between flex-fill d-sm-flex">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="">@lang('pagination.previous')</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="">@lang('pagination.next')</a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <li class="page-item">
                            <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><a class="">{{ $element }}</a></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><a class="">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
