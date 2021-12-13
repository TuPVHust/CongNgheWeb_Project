<div class="product__pagination">
    @if ($paginator->hasPages())
    <div class="product__pagination">
        @if (!$paginator->onFirstPage())
        <a href="javascript:void(0)" wire:click="previousPage"><i class="fa fa-long-arrow-left"></i></a>
        @endif
        {{-- end previous buttom --}}

        @foreach ($elements as $element)
        <!-- Array Of Links -->
        @if (is_array($element))
        @foreach ($element as $page => $url)
        <!--  Use three dots when current page is greater than 3.  -->
        @if ($paginator->currentPage() > 3 && $page === 2)
        <div class="text-blue-800 mx-1 d-inline">
            <span class="font-bold">.</span>
            <span class="font-bold">.</span>
            <span class="font-bold">.</span>
        </div>
        @endif

        <!--  Show active page two pages before and after it.  -->
        @if ($page == $paginator->currentPage())
        <a href="javascript:void(0)" class="active cursor-pointer" wire:click="gotoPage({{$page}})">{{$page }}</a>
        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page ===
        $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
        <a href="javascript:void(0)" class="cursor-pointer" wire:click="gotoPage({{$page}})">{{ $page }}</a>
        @endif

        <!--  Use three dots when current page is away from end.  -->
        @if ($paginator->currentPage() < $paginator->lastPage() - 2 && $page === $paginator->lastPage() - 1)
            <div class="text-blue-800 mx-1 d-inline">
                <span class="font-bold">.</span>
                <span class="font-bold">.</span>
                <span class="font-bold">.</span>
            </div>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a> --}}

            {{-- begin next buttom --}}
            @if ($paginator->hasMorePages())
            <a href="javascript:void(0)" wire:click="nextPage"><i class="fa fa-long-arrow-right"></i></a>
            @endif
    </div>
    @endif
</div>