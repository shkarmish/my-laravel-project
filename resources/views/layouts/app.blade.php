<!DOCTYPE html>
<html>
<head>
    <title>Laravel E-Commerce Store</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- 🔥 HEADER NAVBAR (NEW ADD) -->
    <div style="background:black; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center;">
        
        <a href="/"><img style="max-width:150px;" src="https://i.postimg.cc/hPL7Yjft/Laravel-e-commerce-store-logo.png" alt=""></a>

        <div style="display:flex; gap:15px;">
            <a href="{{ url('/') }}" style="color:white; text-decoration:none;">Home</a>
            <a href="{{ route('shop.index') }}" style="color:white; text-decoration:none;">Products</a>
        </div>

    </div>

    <!-- 🛒 EXISTING CART ICON (UNCHANGED) -->
    <div style="position:fixed; top:98px; right:10px; background:#f0f0f0; padding:5px 10px; border-radius:5px; z-index:1000;">
        <a href="{{ route('cart.index') }}" style="font-size:20px; text-decoration:none;">
            🛒 Cart (<span id="cart-count">{{ \App\Models\Cart::sum('quantity') }}</span>)
        </a>
    </div>

    <!-- CONTENT -->
    <div class="container" style="padding:20px;">
        @yield('content')
    </div>

    <!-- FOOTER (UNCHANGED) -->
    <footer style="text-align:center; padding:20px; margin-top:20px; background:#222; color:white;">
        &copy; 2026 My Ecommerce Site
    </footer>

</body>
</html>