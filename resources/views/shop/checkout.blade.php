@extends('layouts.app')

@section('content')
<h2>Checkout</h2>

<p>Total Amount: ${{ $total }}</p>

<form action="{{ route('checkout.charge') }}" method="POST" id="payment-form">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ $total * 100 }}"
        data-name="Laravel Ecommerce"
        data-description="Test Payment"
        data-currency="usd">
    </script>
</form>
@endsection