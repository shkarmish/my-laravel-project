<!DOCTYPE html>
<html>
<head>
    <title>My Ecommerce Site</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Top Cart Icon -->
    <div style="position:fixed; top:10px; right:10px; background:#f0f0f0; padding:5px 10px; border-radius:5px; z-index:1000;">
        <a href="{{ route('cart.index') }}" style="font-size:20px; text-decoration:none;">
            🛒 Cart (<span id="cart-count">{{ \App\Models\Cart::sum('quantity') }}</span>)
        </a>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <footer style="text-align:center; padding:20px; margin-top:20px;">
        &copy; 2026 My Ecommerce Site
    </footer>
</body>
</html>