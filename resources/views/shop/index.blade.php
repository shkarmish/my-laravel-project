@extends('layouts.app')

@section('content')

<h1 class="shop-title">All Products</h1>

{{-- Products grid — this div is replaced by AJAX on page change --}}
<div class="shop-grid" id="products-container">
    @include('shop.partials.products', ['products' => $products])
</div>

{{-- Pagination buttons — this div is also replaced by AJAX --}}
<div id="pagination-container">
    @include('shop.partials.pagination', ['products' => $products])
</div>

<style>
    /* Page title */
    .shop-title {
        text-align: center;
        margin-bottom: 24px;
    }

    /* Product grid — auto responsive columns */
    .shop-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        min-height: 400px; /* Prevents layout jump while loading */
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

    /* ── Pagination ── */
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

    /* Loading overlay shown while AJAX is fetching */
    .loading-overlay {
        opacity: 0.4;
        pointer-events: none;
        transition: opacity 0.2s;
    }

    /* Mobile — 2 columns */
    @media (max-width: 480px) {
        .shop-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .shop-image {
            height: 130px;
        }

        .shop-name {
            font-size: 13px;
        }

        .shop-price {
            font-size: 13px;
        }

        .shop-description {
            font-size: 12px;
        }

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
    // Fetch a specific page via AJAX and update the DOM without reload
    function loadPage(page) {
        const container  = document.getElementById('products-container');
        const pagination = document.getElementById('pagination-container');

        // Show subtle loading state
        container.classList.add('loading-overlay');

        $.ajax({
            url: '{{ route('shop.index') }}',
            method: 'GET',
            data: { page: page },
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Tells Laravel this is an AJAX request
            },
            success: function (response) {
                // Replace products grid and pagination with fresh HTML
                container.innerHTML  = response.html;
                pagination.innerHTML = response.pagination;

                // Remove loading state
                container.classList.remove('loading-overlay');

                // Scroll to top of products smoothly
                container.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    // Listen for pagination button clicks — use event delegation
    // so it works even after AJAX replaces the pagination HTML
    $(document).on('click', '.page-btn[data-page]', function () {
        const page = $(this).data('page');
        loadPage(page);
    });
</script>

@endsection