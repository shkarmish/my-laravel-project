@extends('layouts.app')

@section('content')

<h1 class="shop-title">All Products</h1>

<!-- Search bar -->
<div class="search-wrapper">
    <input
        type="text"
        id="search-input"
        class="search-input"
        placeholder="Search products..."
        value="{{ $query ?? '' }}"
        autocomplete="off"
    >
    <!-- Clear button — shown when search has text -->
    <button class="search-clear" id="search-clear" style="display:none;">&#10005;</button>
</div>

<!-- "No results" message — hidden by default -->
<p class="no-results" id="no-results" style="display:none;">No products found for your search.</p>

<!-- Products grid — replaced by AJAX on search/page change -->
<div class="shop-grid" id="products-container">
    @include('shop.partials.products', ['products' => $products])
</div>

<!-- Pagination — replaced by AJAX -->
<div id="pagination-container">
    @include('shop.partials.pagination', ['products' => $products])
</div>

<style>
    /* Page title */
    .shop-title {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Search bar wrapper */
    .search-wrapper {
        position: relative;
        max-width: 500px;
        margin: 0 auto 28px;
    }

    /* Search input */
    .search-input {
        width: 100%;
        padding: 11px 40px 11px 16px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }

    .search-input:focus {
        border-color: #000;
    }

    /* Clear (x) button inside search input */
    .search-clear {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 16px;
        color: #888;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    .search-clear:hover {
        color: #000;
    }

    /* No results message */
    .no-results {
        text-align: center;
        color: #888;
        font-size: 15px;
        margin: 40px 0;
    }

    /* Product grid — auto responsive columns */
    .shop-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        min-height: 200px;
    }

    /* Single product card */
    .shop-card {
        border: 1px solid gray;
        padding: 15px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Product image */
    .shop-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    /* Product name */
    .shop-name {
        text-align: center;
        margin: 8px 0 4px;
        font-size: 16px;
    }

    /* Product price */
    .shop-price {
        text-align: center;
        font-weight: bold;
        margin-bottom: 6px;
    }

    /* Product description */
    .shop-description {
        text-align: left;
        font-size: 14px;
        color: #555;
        margin-bottom: 12px;
        flex: 1;
    }

    /* Add to Cart button */
    .add-to-cart-btn {
        display: block;
        margin: 0 auto;
        background: #000;
        color: #fff;
        padding: 11px 23px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        width: 100%;
    }

    .add-to-cart-btn:hover {
        background: #333;
    }

    /* Pagination wrapper */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 6px;
        margin: 30px 0 20px;
    }

    /* Individual page button */
    .page-btn {
        padding: 8px 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: white;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.2s;
    }

    .page-btn:hover {
        background: #f0f0f0;
    }

    /* Active (current) page */
    .page-btn-active {
        background: #000;
        color: white;
        border-color: #000;
    }

    .page-btn-active:hover {
        background: #333;
    }

    /* Disabled prev/next at edges */
    .page-btn-disabled {
        padding: 8px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        color: #bbb;
        font-size: 14px;
        cursor: default;
    }

    /* Subtle loading fade while AJAX fetches */
    .loading-overlay {
        opacity: 0.4;
        pointer-events: none;
        transition: opacity 0.2s;
    }

    /* Mobile */
    @media (max-width: 480px) {
        .shop-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .shop-image   { height: 130px; }
        .shop-name    { font-size: 13px; }
        .shop-price   { font-size: 13px; }
        .shop-description { font-size: 12px; }

        .add-to-cart-btn {
            padding: 8px 10px;
            font-size: 12px;
        }

        .page-btn, .page-btn-disabled {
            padding: 6px 10px;
            font-size: 13px;
        }
    }
</style>

<script>
    var searchTimer  = null; // Debounce timer for search input
    var currentQuery = '{{ $query ?? '' }}'; // Track current search term

    // Core AJAX fetch function — used by both search and pagination
    function fetchProducts(page, query) {
        var container  = document.getElementById('products-container');
        var pagination = document.getElementById('pagination-container');
        var noResults  = document.getElementById('no-results');

        container.classList.add('loading-overlay');

        $.ajax({
            url: '{{ route('shop.index') }}',
            method: 'GET',
            data: { page: page, search: query },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (response) {
                container.innerHTML  = response.html;
                pagination.innerHTML = response.pagination;
                container.classList.remove('loading-overlay');

                // Show "no results" message if grid is empty
                var hasCards = container.querySelector('.shop-card');
                noResults.style.display  = hasCards ? 'none' : 'block';
                container.style.display  = hasCards ? 'grid' : 'none';
            }
        });
    }

    // Search input — debounced so AJAX fires 400ms after user stops typing
    $('#search-input').on('input', function () {
        var query      = $(this).val().trim();
        currentQuery   = query;

        // Show/hide clear button
        document.getElementById('search-clear').style.display = query ? 'block' : 'none';

        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            fetchProducts(1, query); // Always reset to page 1 on new search
        }, 400);
    });

    // Clear button — wipes search and reloads all products
    $('#search-clear').on('click', function () {
        $('#search-input').val('');
        currentQuery = '';
        $(this).hide();
        fetchProducts(1, '');
    });

    // Pagination button clicks — keep current search term
    $(document).on('click', '.page-btn[data-page]', function () {
        var page = $(this).data('page');
        fetchProducts(page, currentQuery);
        document.getElementById('products-container')
            .scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    // Show clear button on page load if search was pre-filled
    if ($('#search-input').val()) {
        document.getElementById('search-clear').style.display = 'block';
    }
</script>

@endsection