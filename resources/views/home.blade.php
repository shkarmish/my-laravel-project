@extends('layouts.app')

@section('content')

<h2 style="margin-bottom:20px;">Featured Products</h2>

<div style="display:flex; flex-wrap:wrap; gap:20px;">

@foreach($products as $product)
<div style="border:1px solid #ddd; padding:10px; width:220px; border-radius:10px; text-align:center;">

    <img src="{{ asset('images/'.$product->image) }}" width="200" style="margin-bottom:10px;">
    <h4>{{ $product->name }}</h4>
    <p style="font-weight:bold;">${{ $product->price }}</p>

    <a href="{{ route('shop.index') }}" 
       style="display:inline-block; padding:8px 15px; background:#000; color:white; text-decoration:none; border-radius:5px; margin-top:5px;">
        View Products
    </a>

</div>
@endforeach

</div>

@endsection