<h2>{{ $product->name }}</h2>

<p>{{ $product->description }}</p>
<p>Price: {{ $product->price }}</p>

<a href="/add-to-cart/{{ $product->id }}">Add to Cart</a>