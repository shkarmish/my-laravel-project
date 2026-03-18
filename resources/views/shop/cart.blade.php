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

@endsection