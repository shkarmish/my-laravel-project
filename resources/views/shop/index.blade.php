@extends('layouts.app')

@section('content')
<center><h1>All Products</h1></center>

@foreach($products as $product)
<div style="border:1px solid gray; padding:10px; margin:10px; width:250px; display:inline-block; vertical-align:top;">
   <div class="product-card">
     @if($product->image)
    <img style="display: block;margin: 0px auto;" src="{{ asset('images/'.$product->image) }}" width="150">
@endif
    <h3 style="text-align: center;">{{ $product->name }}</h3>
    <p style="text-align: center;">Price: ${{ $product->price }}</p>
   <p>{{ $product->description }}</p>


    <form class="add-to-cart-form" data-id="{{ $product->id }}">
        @csrf
        <button style="display: block; margin: 0px auto; background: #000; color: #fff; padding: 11px 23px; border-radius: 5px; border: none; cursor: pointer;" type="submit">Add to Cart</button>
    </form>
   </div>
</div>
@endforeach

<script>
$(document).ready(function(){
    $('.add-to-cart-form').submit(function(e){
        e.preventDefault();

        var productId = $(this).data('id');
        var token = $(this).find('input[name=_token]').val();

        $.ajax({
            url: '/cart/add/' + productId,
            type: 'POST',
            data: {_token: token},
            success: function(response){
                // Update top cart icon count
                $('#cart-count').text(response.total);

                alert('Product added to cart!');
            },
            error: function(){
                alert('Something went wrong. Check console.');
            }
        });
    });
});
</script>
@endsection