@extends('layouts.app')

@section('content')

<!-- ── HERO SECTION ── -->
<div class="hero">

    <!-- Dark overlay so text is readable over the background image -->
    <div class="hero-overlay"></div>

    <!-- Hero content — centered text + search bar + CTA button -->
    <div class="hero-content">
        <p class="hero-tagline">New Arrivals Every Week</p>
        <h1 class="hero-heading">Discover Products<br>You'll Actually Love</h1>
        <p class="hero-subtext">Handpicked quality items delivered straight to your door.<br>Shop the latest trends at unbeatable prices.</p>

        <!-- Search bar — submits to /shop with search query -->
        <form class="hero-search-form" action="{{ route('shop.index') }}" method="GET">
            <input
                type="text"
                name="search"
                class="hero-search-input"
                placeholder="Search for products..."
                autocomplete="off"
            >
            <button type="submit" class="hero-search-btn">Search</button>
        </form>

        <a href="{{ route('shop.index') }}" class="hero-cta">Browse All Products &rarr;</a>
    </div>

</div>

<!-- ── FEATURED PRODUCTS ── -->
<h2 class="section-title">Featured Products</h2>

<!-- Scroller wrapper — prev/next arrows + scrollable track -->
<div class="scroller-wrapper">

    <!-- Left arrow button -->
    <button class="scroll-btn scroll-btn-left" id="scrollLeft">&#8592;</button>

    <!-- Scrollable product track -->
    <div class="scroller-track" id="scrollerTrack">

        @foreach($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/'.$product->image) }}" class="product-image">
            <h4 class="product-name">{{ $product->name }}</h4>
            <p class="product-price">${{ $product->price }}</p>
            {{-- add-to-cart-form class is picked up by AJAX in app.blade.php --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                @csrf
                <button type="submit" class="view-btn">Add to Cart</button>
            </form>
        </div>
        @endforeach

    </div>

    <!-- Right arrow button -->
    <button class="scroll-btn scroll-btn-right" id="scrollRight">&#8594;</button>

</div>

<style>

    /* ══════════════════════════════
       HERO SECTION
    ══════════════════════════════ */

    .hero {
        position: relative;
        width: 100%;
        height: 560px;
        margin-bottom: 40px;
        background-image: url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1400');
        background-size: cover;
        background-position: center;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Dark overlay for text contrast */
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        border-radius: 12px;
    }

    /* Text + search container above overlay */
    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: white;
        padding: 0 20px;
        max-width: 680px;
        width: 100%;
    }

    .hero-tagline {
        font-size: 14px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #f0c040;
        margin-bottom: 12px;
    }

    .hero-heading {
        font-size: 52px;
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 16px;
    }

    .hero-subtext {
        font-size: 17px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        margin-bottom: 28px;
    }

    /* Search bar inside hero */
    .hero-search-form {
        display: flex;
        gap: 0;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .hero-search-input {
        flex: 1;
        padding: 14px 18px;
        font-size: 15px;
        border: none;
        outline: none;
        background: white;
        color: #000;
    }

    .hero-search-btn {
        padding: 14px 24px;
        background: #f0c040;
        color: #000;
        font-weight: 700;
        font-size: 15px;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .hero-search-btn:hover {
        background: #e0b030;
    }

    /* Browse all CTA link */
    .hero-cta {
        display: inline-block;
        padding: 12px 30px;
        background: transparent;
        color: white;
        font-size: 14px;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 6px;
        transition: background 0.2s;
    }

    .hero-cta:hover {
        background: rgba(255,255,255,0.15);
    }

    /* ══════════════════════════════
       FEATURED PRODUCTS SECTION
    ══════════════════════════════ */

    .section-title {
        margin-bottom: 20px;
    }

    .scroller-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .scroller-track {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding: 10px 4px;
        flex: 1;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .scroller-track::-webkit-scrollbar {
        display: none;
    }

    .product-card {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        min-width: 200px;
        max-width: 200px;
        flex-shrink: 0;
    }

    .product-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .product-name {
        margin: 8px 0 4px;
        font-size: 14px;
    }

    .product-price {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 14px;
    }

    /* Add to Cart button */
    .view-btn {
        display: inline-block;
        padding: 7px 14px;
        background: #000;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
        border: none;
        cursor: pointer;
        width: 100%;
        box-sizing: border-box;
    }

    .view-btn:hover {
        background: #333;
    }

    .scroll-btn {
        background: #000;
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        font-size: 18px;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .scroll-btn:hover {
        background: #333;
    }

    /* ══════════════════════════════
       RESPONSIVE — TABLET (768px)
    ══════════════════════════════ */
    @media (max-width: 768px) {
        .hero        { height: 440px; }
        .hero-heading { font-size: 36px; }
        .hero-subtext { font-size: 15px; }
    }

    /* ══════════════════════════════
       RESPONSIVE — MOBILE (480px)
    ══════════════════════════════ */
    @media (max-width: 480px) {
        .hero           { height: 380px; border-radius: 8px; }
        .hero-tagline   { font-size: 11px; letter-spacing: 2px; }
        .hero-heading   { font-size: 24px; margin-bottom: 10px; }
        .hero-subtext   { font-size: 13px; margin-bottom: 18px; }

        .hero-search-input { padding: 11px 12px; font-size: 13px; }
        .hero-search-btn   { padding: 11px 14px; font-size: 13px; }

        .hero-cta { padding: 10px 20px; font-size: 13px; }

        /* Hide scroll arrows on mobile — touch swipe works natively */
        .scroll-btn { display: none; }

        .product-card  { min-width: 160px; max-width: 160px; }
        .product-image { height: 130px; }
        .product-name  { font-size: 13px; }
        .product-price { font-size: 13px; }
    }
</style>

<script>
    const track        = document.getElementById('scrollerTrack');
    const btnLeft      = document.getElementById('scrollLeft');
    const btnRight     = document.getElementById('scrollRight');
    const scrollAmount = 440; // Scroll ~2 cards per click

    // Scroll left on left arrow click
    btnLeft.addEventListener('click', function () {
        track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    // Scroll right on right arrow click
    btnRight.addEventListener('click', function () {
        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
</script>

@endsection