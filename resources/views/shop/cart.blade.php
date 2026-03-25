@extends('layouts.app')

@section('content')

<h2 class="cart-title">My Cart</h2>

@php $total = 0; @endphp

@foreach($cartItems as $item)
@php
    $subtotal = $item->product->price * $item->quantity;
    $total += $subtotal;
@endphp

<div class="cart-item">

    <!-- Product image -->
    <img src="{{ asset('images/'.$item->product->image) }}" class="cart-item-image">

    <!-- Product info -->
    <div class="cart-item-info">
        <h3 class="cart-item-name">{{ $item->product->name }}</h3>
        <p class="cart-item-description">{{ $item->product->description }}</p>
        <p class="cart-item-price">Price: ${{ $item->product->price }}</p>
        

        <!-- Quantity controls -->
        <p class="cart-item-qty">
            Quantity:
            <a href="{{ route('cart.decrease', $item->product->id) }}">➖</a>
            {{ $item->quantity }}
            <a href="{{ route('cart.increase', $item->product->id) }}">➕</a>
        </p>

        <!-- Subtotal -->
        <p class="cart-item-subtotal">Subtotal: ${{ $subtotal }}</p>

        <!-- Remove single item -->
        <a href="{{ route('cart.remove', $item->product->id) }}" class="cart-remove-link">
            Remove
        </a>
    </div>

</div>

@endforeach

<!-- Order total -->
<h3 class="cart-total">Total: ${{ $total }}</h3>

<!-- Action buttons -->
<div class="cart-actions">

    <!-- Return to shopping — always visible -->
    <a href="{{ url('/shop') }}" class="cart-btn cart-btn-gray">
        Return to Shopping
    </a>

    <!-- Checkout — only when cart has items -->
    @if($total > 0)
        <a href="{{ route('checkout.index') }}" class="cart-btn cart-btn-green">
            Checkout
        </a>
    @endif

    <!-- Remove all — only when cart has items -->
    @if($total > 0)
        <a href="{{ route('cart.removeAll') }}" class="cart-btn cart-btn-red cart-btn-right">
            Remove All
        </a>
    @endif

</div>

<style>
    /* Page title */
    .cart-title {
        margin-bottom: 16px;
    }

    /* Single cart item row */
    .cart-item {
        border: 1px solid gray;
        padding: 10px;
        margin-bottom: 12px;
        display: flex;
        gap: 15px;
        border-radius: 8px;
        align-items: flex-start;
    }

    /* Product image */
    .cart-item-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        flex-shrink: 0;
    }

    /* Info section fills remaining space */
    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        margin: 0 0 6px;
        font-size: 16px;
    }

    .cart-item-price,
    .cart-item-qty,
    .cart-item-subtotal {
        margin: 4px 0;
        font-size: 14px;
    }

    /* Remove link */
    .cart-remove-link {
        color: red;
        font-size: 14px;
        text-decoration: none;
    }

    .cart-remove-link:hover {
        text-decoration: underline;
    }

    /* Order total */
    .cart-total {
        margin: 16px 0;
    }

    /* Bottom action buttons row */
    .cart-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        padding-bottom: 20px;
    }

    /* Base button style */
    .cart-btn {
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        white-space: nowrap;
    }

    .cart-btn-gray  { background: gray; }
    .cart-btn-green { background: green; }
    .cart-btn-red   { background: red; }

    /* Push Remove All to the right on desktop */
    .cart-btn-right {
        margin-left: auto;
    }

    /* Mobile — stack image and info vertically */
    @media (max-width: 480px) {
        .cart-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .cart-item-image {
            width: 50%;
            height: auto;
        }

        /* Stack buttons and stretch them full width */
        .cart-actions {
            flex-direction: column;
        }

        .cart-btn {
            width: 85%;
            text-align: center;
        }

        /* Remove All stays at bottom, no right push on mobile */
        .cart-btn-right {
            margin-left: 0;
        }
    }
</style>

@endsection