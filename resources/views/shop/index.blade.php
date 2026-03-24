@extends('layouts.app')

@section('content')

<h1 class="shop-title">All Products</h1>

<div class="shop-grid">

@foreach($products as $product)
<div class="shop-card">

    @if($product->image)
        <img src="{{ asset('images/'.$product->image) }}" class="shop-image">
    @endif

    <h3 class="shop-name">{{ $product->name }}</h3>
    <p class="shop-price">Price: ${{ $product->price }}</p>
    <p class="shop-description">{{ $product->description }}</p>

    {{-- method="POST" added — was missing before (caused undefined in AJAX URL) --}}
    {{-- class="add-to-cart-form" is picked up by AJAX in app.blade.php --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
        @csrf
        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
    </form>

</div>
@endforeach

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

    /* Mobile — 2 columns on small screens */
    @media (max-width: 480px) {
        .shop-grid {
            grid-template-columns: repeat(1, 1fr);
            gap: 12px;
        }

        .shop-image {
            height: auto;
            width: 50%;
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
    }
</style>

@endsection