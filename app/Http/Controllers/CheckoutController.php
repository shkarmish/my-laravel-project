<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // Checkout page
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        $total = 0;

        foreach($cartItems as $item){
            $total += $item->product->price * $item->quantity;
        }

        return view('shop.checkout', compact('cartItems', 'total'));
    }

    // Stripe charge
    public function charge(Request $request)
    {
        $cartItems = Cart::with('product')->get();
        $total = 0;

        foreach($cartItems as $item){
            $total += $item->product->price * $item->quantity;
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $total * 100, // cents
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return view('shop.payment', compact('paymentIntent', 'total'));
    }
}