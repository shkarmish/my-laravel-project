@extends('layouts.app')

@section('content')

<h2 class="section-title">Featured Products</h2>

<div class="products-grid">

@foreach($products as $product)
<div class="product-card">

    <img src="{{ asset('images/'.$product->image) }}" class="product-image">
    <h4 class="product-name">{{ $product->name }}</h4>
    <p class="product-price">${{ $product->price }}</p>

    <a href="{{ route('shop.index') }}" class="view-btn">
        View Products
    </a>

</div>
@endforeach

</div>

<style>
    /* Page title */
    .section-title {
        margin-bottom: 20px;
    }

    /* Product grid — responsive columns */
    .products-grid {
        display: grid;
        /* Auto-fill columns: each card minimum 200px, maximum equal share */
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    /* Single product card */
    .product-card {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
    }

    /* Product image — full width so it scales with card */
    .product-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    /* Product name */
    .product-name {
        margin: 8px 0 4px;
        font-size: 15px;
    }

    /* Product price */
    .product-price {
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* View Products button */
    .view-btn {
        display: inline-block;
        padding: 8px 15px;
        background: #000;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 5px;
        font-size: 14px;
    }

    .view-btn:hover {
        background: #333;
    }

    /* Mobile — 2 columns on small screens */
    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .product-image {
            height: 130px;
        }

        .product-name {
            font-size: 13px;
        }

        .product-price {
            font-size: 13px;
        }

        .view-btn {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
</style>

@endsection