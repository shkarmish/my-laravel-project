@extends('layouts.app')

@section('content')
<h2>Checkout</h2>

@php $total = 0; @endphp

@foreach($cartItems as $item)
    @php 
        $subtotal = $item->product->price * $item->quantity;
        $total += $subtotal;
    @endphp

    <div style="border:1px solid gray; padding:10px; margin:10px; display:flex; align-items:center; gap:15px;">

        <!-- ✅ Image -->
        <img src="{{ asset('images/'.$item->product->image) }}" width="80">

        <!-- Product Info -->
        <div>
            <h3>{{ $item->product->name }}</h3>

            <!-- Price -->
            <p>Price: ${{ $item->product->price }}</p>

            <!-- Quantity -->
            <p>Quantity: {{ $item->quantity }}</p>

            <!-- Subtotal -->
            <p>Subtotal: ${{ $subtotal }}</p>
        </div>
    </div>
@endforeach

<!-- Total -->
<h3>Total Amount: ${{ $total }}</h3>

<!-- Stripe Payment -->
<form action="{{ route('checkout.charge') }}" method="POST" id="payment-form">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ $total * 100 }}"
        data-name="Laravel Ecommerce"
        data-description="Test Payment"
        data-currency="usd">
    </script>
</form>

@endsection