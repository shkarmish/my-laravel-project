{{-- resources/views/shop/partials/products.blade.php --}}
{{-- This partial is rendered by both the full page load and AJAX pagination requests --}}

@foreach($products as $product)
<div class="shop-card">

    @if($product->image)
        <img src="{{ asset('images/'.$product->image) }}" class="shop-image">
    @endif

    <h3 class="shop-name">{{ $product->name }}</h3>
    <p class="shop-price">Price: ${{ $product->price }}</p>
    <p class="shop-description">{{ $product->description }}</p>

    {{-- add-to-cart-form class is picked up by AJAX in app.blade.php --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
        @csrf
        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
    </form>

</div>
@endforeach
