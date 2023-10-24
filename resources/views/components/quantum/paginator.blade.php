@if($paginator->hasPages())
    <div class="pagination">
        @if($paginator->onFirstPage())
            <button class="pagination__button-previous" disabled aria-label="@lang('pagination.previous')">
                <span class="pagination__button-text">Previous</span>
            </button>
        @else
            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    aria-label="@lang('pagination.previous')"
                    rel="prev" class="pagination__button-previous" href="{{ $paginator->previousPageUrl() }}"
                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}">
                <span class="pagination__button-text">Previous</span>
            </button>
        @endif
        <ul class="pagination__list"
            data-mobile-text="Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}">
            @foreach($elements as $element)
                @if(is_string($element))
                    <li class="pagination__ellipsis">{{ $element }}</li>
                @endif

                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page === $paginator->currentPage())
                            <li wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                class="pagination__item active">{{ $page }}</li>
                        @else
                            <li wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                class="pagination__item">
                                <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
        @if($paginator->onLastPage())
            <button class="pagination__button-next" disabled aria-label="@lang('pagination.next')">
                <span class="pagination__button-text">Next</span>
            </button>
        @else
            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    rel="next" class="pagination__button-next" aria-label="@lang('pagination.next')"
                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}">
                <span class="pagination__button-text">Next</span>
            </button>
        @endif
    </div>
@endif
