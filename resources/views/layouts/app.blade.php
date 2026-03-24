<!DOCTYPE html>
<html>
<head>
    <title>Laravel E-Commerce Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Apply box-sizing only to navbar, not the whole page (prevents spacing issues) */
        .navbar, .navbar *, .mobile-menu, .mobile-menu * {
            box-sizing: border-box;
        }

        /* Makes footer stick to the bottom even on short pages */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-content {
            flex: 1;
        }

        /* ── Desktop navbar ── */
        .navbar {
            background: black;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo img {
            max-width: 150px;
            display: block;
        }

        /* Desktop links */
        .navbar-links {
            display: flex;
            gap: 20px;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            font-size: 15px;
        }

        .navbar-links a:hover {
            text-decoration: underline;
        }

        /* Hamburger button — hidden on desktop, shown on mobile */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Mobile dropdown menu — hidden by default */
        .mobile-menu {
            display: none;
            flex-direction: column;
            background: #1a1a1a;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            font-size: 15px;
            border-bottom: 1px solid #333;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        .mobile-menu a:hover {
            background: #2a2a2a;
        }

        /* ── Mobile breakpoint (768px and below) ── */
        @media (max-width: 768px) {
            /* Hide desktop links on mobile */
            .navbar-links {
                display: none;
            }

            /* Show hamburger button on mobile */
            .hamburger {
                display: flex;
            }
        }

        /* Hamburger lines animate into an X when menu is open */
        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }
        .hamburger.open span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }
    </style>
</head>
<body>

    <!-- ── HEADER ── -->
    <div class="navbar">
        <!-- Logo -->
        <a href="/" class="navbar-logo">
            <img src="https://i.postimg.cc/hPL7Yjft/Laravel-e-commerce-store-logo.png" alt="Logo">
        </a>

        <!-- Desktop links (visible above 768px) -->
        <div class="navbar-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('shop.index') }}">Products</a>
        </div>

        <!-- Hamburger button (visible below 768px) -->
        <button class="hamburger" id="hamburger-btn" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Mobile dropdown menu (toggled on hamburger click) -->
    <div class="mobile-menu" id="mobile-menu">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('shop.index') }}">Products</a>
        <a href="{{ route('cart.index') }}">Cart (<span id="mobile-cart-count">{{ \App\Models\Cart::sum('quantity') }}</span>)</a>
    </div>

    <!-- Cart icon — shown on desktop only, mobile uses the menu link above -->
    <div style="position:fixed; top:98px; right:10px; background:#f0f0f0; padding:5px 10px; border-radius:5px; z-index:1000; display:none;" id="desktop-cart">
        <a href="{{ route('cart.index') }}" style="font-size:20px; text-decoration:none;">
            🛒 Cart (<span id="cart-count">{{ \App\Models\Cart::sum('quantity') }}</span>)
        </a>
    </div>

    <!-- Main page content — flex:1 keeps footer pushed to the bottom -->
    <div class="page-content">
        <div class="container" style="padding:20px;">
            @yield('content')
        </div>
    </div>

    <!-- ── FOOTER ── -->
    <footer style="text-align:center; padding:20px; margin-top:20px; background:#222; color:white;">
        &copy; 2026 My Ecommerce Site
    </footer>

    <script>
        // Show cart icon on desktop, hide on mobile (mobile uses menu link instead)
        function updateCartVisibility() {
            if (window.innerWidth > 768) {
                document.getElementById('desktop-cart').style.display = 'block';
            } else {
                document.getElementById('desktop-cart').style.display = 'none';
            }
        }
        updateCartVisibility();
        window.addEventListener('resize', updateCartVisibility);

        // Hamburger button toggle
        const btn  = document.getElementById('hamburger-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', function () {
            const isOpen = menu.style.display === 'flex';

            if (isOpen) {
                menu.style.display = 'none';
                btn.classList.remove('open');
            } else {
                menu.style.display = 'flex';
                btn.classList.add('open');
            }
        });

        // Close mobile menu when any link is clicked
        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.style.display = 'none';
                btn.classList.remove('open');
            });
        });

        // Intercept every "Add to Cart" form submit with AJAX
        // so the cart count updates instantly without a page reload
        $(document).on('submit', '.add-to-cart-form', function (e) {
            e.preventDefault(); // stop normal form submission

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(), // sends _token + form fields
                success: function (response) {
                    // Update cart count in both desktop icon and mobile menu
                    $('#cart-count').text(response.total);
                    $('#mobile-cart-count').text(response.total);
                    // Show confirmation message to user
                    alert('The product has been added to the cart successfully');
                }
            });
        });
    </script>

</body>
</html>