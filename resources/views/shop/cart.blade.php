@extends('layouts.app')

@section('content')
<h2>My Cart</h2>

@php $total = 0; @endphp

@foreach($cartItems as $item)
@php 
    $subtotal = $item->product->price * $item->quantity;
    $total += $subtotal;
@endphp

<div style="border:1px solid gray; padding:10px; margin:10px; display:flex; gap:15px;">

    <!-- Image -->
    <img src="{{ asset('images/'.$item->product->image) }}">

    <!-- Info -->
    <div>
        <h3>{{ $item->product->name }}</h3>
        <p>Price: ${{ $item->product->price }}</p>

        <!-- Quantity Controls -->
        <p>
            Quantity:
            <a href="{{ route('cart.decrease', $item->product->id) }}">➖</a>
            {{ $item->quantity }}
            <a href="{{ route('cart.increase', $item->product->id) }}">➕</a>
        </p>

        <!-- Subtotal -->
        <p>Subtotal: ${{ $subtotal }}</p>

        <!-- Remove -->
        <a href="{{ route('cart.remove', $item->product->id) }}" style="color:red;">
            Remove
        </a>
    </div>
</div>

@endforeach

<!-- Total -->
<h3>Total: ${{ $total }}</h3>
<!-- Return to Shopping Button -->
    <a href="{{ url('/shop') }}" 
       style="padding:10px 20px; background:gray; color:white; text-decoration:none; border-radius:5px;">
       Return to Shopping
    </a>&nbsp;

@if($total > 0)
    <a href="{{ route('checkout.index') }}" style="padding:10px 20px; background:green; color:white; text-decoration:none; border-radius:5px;">
        Checkout
    </a>&nbsp;
@endif

<!-- Remove All Button -->
 <div style="display: flex; justify-content: end; flex-wrap: wrap; padding-right: 15px;" class="remove-all-btn">
       @if($total > 0)
        <a href="{{ route('cart.removeAll') }}" 
           style="padding:10px 20px; background:red; color:white; text-decoration:none; border-radius:5px;">
           Remove All
        </a>
    @endif
 </div>

@endsection