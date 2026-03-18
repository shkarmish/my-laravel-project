<?php
use App\Http\Controllers\ProductController;
Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products', [ProductController::class, 'store']);
// User / Shop page
Route::get('/shop', [ProductController::class, 'shop']);

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class, 'shop']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart']);
Route::get('/cart', [ProductController::class, 'cart']);


use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove-all', [CartController::class, 'removeAll'])->name('cart.removeAll');


use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'charge'])->name('checkout.charge');

?>