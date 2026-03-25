{{-- resources/views/shop/partials/pagination.blade.php --}}
{{-- Renders page number buttons — highlighted current page, disabled prev/next at edges --}}

<div class="pagination-wrapper">

    {{-- Previous page button --}}
    @if($products->onFirstPage())
        <span class="page-btn page-btn-disabled">&laquo;</span>
    @else
        <button class="page-btn" data-page="{{ $products->currentPage() - 1 }}">&laquo;</button>
    @endif

    {{-- Page number buttons --}}
    @for($i = 1; $i <= $products->lastPage(); $i++)
        <button class="page-btn {{ $i == $products->currentPage() ? 'page-btn-active' : '' }}"
                data-page="{{ $i }}">
            {{ $i }}
        </button>
    @endfor

    {{-- Next page button --}}
    @if($products->hasMorePages())
        <button class="page-btn" data-page="{{ $products->currentPage() + 1 }}">&raquo;</button>
    @else
        <span class="page-btn page-btn-disabled">&raquo;</span>
    @endif

</div>
