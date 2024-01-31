
<div class="widget-pagination">
    @if ($paginator->hasPages())
            <ul class="pagination justify-center align-items-baseline">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item  disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a href="#" aria-hidden="true">&lsaquo;</a>
                    </li>
                @else
                    <li class="page-item ">
                        <a href="#" type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item  disabled" aria-disabled="true" style="width: 0"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item  active" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page"><a href="#" class="px-3" style="background-color: transparent;
    border-color: transparent;">{{ $page }}</a></li>
                            @else
                                <li class="page-item " wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"><a href="#" type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item ">
                        <a href="#" type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item  disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a href="#" class="page-link" aria-hidden="true">&rsaquo;</a>
                    </li>
                @endif
            </ul>
    @endif
</div>
