@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ( ! $paginator->onFirstPage())
            {{-- First Page Link --}}
            <li>
                <a class="pagination__link" wire:click="gotoPage(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-chevrons-right w-4 h-4">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                </a>

            </li>

            @if($paginator->currentPage() > 2)
                {{-- Previous Page Link --}}
                <li>
                    <a class="pagination__link" wire:click="previousPage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>

            @endif
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 3.  -->
                    @if ($paginator->currentPage() > 3 && $page === 2)
                        <li>
                            <a class="pagination__link">...</a>
                        </li>
                    @endif

                <!--  Show active page two pages before and after it.  -->
                    @if ($page == $paginator->currentPage())
                        <li><a class="pagination__link pagination__link--active" href="#">{{ $page }}</a></li>
                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                        <li><a class="pagination__link"
                               wire:click="gotoPage({{$page}})">{{ $page }}</a></li>

                    @endif

                <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                        <li>
                            <a class="pagination__link">...</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if($paginator->lastPage() - $paginator->currentPage() >= 2)
                <li>
                    <a class="pagination__link"
                       wire:click="nextPage"
                       rel="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif
            <li>
                <a class="pagination__link" wire:click="gotoPage({{ $paginator->lastPage() }})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevrons-left w-4 h-4">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </a>
            </li>

        @endif
    </ul>

@endif
