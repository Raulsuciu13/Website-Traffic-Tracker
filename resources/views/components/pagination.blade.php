
@if ($paginator->hasPages())
    <div class="py-3 flex items-center justify-between border-t border-gray-200">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"></div>
        <div class="flex w-full justify-center sm:justify-end max-h-64 overflow-auto">
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                    @if (!$paginator->onFirstPage())
                        <a href="#" wire:click="previousPage" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <!-- Heroicon name: solid/chevron-left -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <!--  Use three dots when current page is greater than 3.  -->
                                @if ($paginator->currentPage() > 3 && $page === 2)
                                    <span class="relative inline-flex items-center px-2 sm:px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"> ... </span>
                                @endif

                                <!--  Show active page else show the first and last two pages from current page.  -->
                                @if ($page == $paginator->currentPage())
                                    <a href="#" wire:click="gotoPage({{ $page }})" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-2 sm:px-4 py-2 border text-sm font-medium"> {{ $page }} </a>
                                @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() - 1 || $page === $paginator->lastPage() || $page === 1)
                                    <a href="#" wire:click="gotoPage({{ $page }})" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 sm:px-4 py-2 border text-sm font-medium"> {{ $page }} </a>
                                @endif

                                <!--  Use three dots when current page is away from end.  -->
                                @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
                                    <span class="relative inline-flex items-center px-2 sm:px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"> ... </span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <a href="#" wire:click="nextPage" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <!-- Heroicon name: solid/chevron-right -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif
