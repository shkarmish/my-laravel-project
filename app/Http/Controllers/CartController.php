<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        // get all cart items
    $cartItems = Cart::with('product')->get(); 
    $total = $cartItems->sum(function($item){
        return $item->product->price * $item->quantity;
    });
    return view('shop.cart', compact('cartItems', 'total'));
    }

  // Add to cart
public function add(Request $request, Product $product)
{
 $cart = Cart::where('product_id', $product->id)->first();

    if($cart){
        $cart->quantity += 1;
        $cart->save();
    } else {
        Cart::create([
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    if($request->ajax()){
        return response()->json([
            'total' => Cart::sum('quantity')
        ]);
    }

    return redirect()->back();
}

// Increase quantity
public function increase(Product $product)
{
      $cart = Cart::where('product_id', $product->id)->first();

    if($cart){
        $cart->quantity += 1;
        $cart->save();
    }

    return redirect()->back();
}

// Decrease quantity
public function decrease(Product $product)
{
  $cart = Cart::where('product_id', $product->id)->first();

    if($cart){
        if($cart->quantity > 1){
            $cart->quantity -= 1;
            $cart->save();
        } else {
            $cart->delete();
        }
    }

    return redirect()->back();
}

// Remove item
public function remove(Product $product)
{
    // Delete the product from cart
    Cart::where('product_id', $product->id)->delete();

    // ✅ Check if cart is empty now
    if(Cart::count() == 0){
        return redirect('/shop')->with('info', 'Cart is empty!');
    }

    return redirect()->back();
}

public function removeAll()
{
    Cart::truncate(); // Ye cart table ki saari rows delete kar dega

    // Redirect to shop page after clearing cart
    return redirect('/shop')->with('info', 'All products removed from cart.');
}

}