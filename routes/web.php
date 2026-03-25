<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [ProductController::class, 'home'])->name('home');

// Shop
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');

// Admin Products
Route::get('/admin/products',              [ProductController::class, 'adminIndex'])->name('admin.products.index');
Route::get('/admin/products/create',       [ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products',             [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}',    [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

// Cart
Route::get('/add-to-cart/{id}',        [ProductController::class, 'addToCart']);
Route::get('/cart',                    [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/remove/{product}',   [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add/{product}',     [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove-all',         [CartController::class, 'removeAll'])->name('cart.removeAll');

// Checkout
Route::get('/checkout',  [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'charge'])->name('checkout.charge');

use App\Http\Controllers\ContactController;

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.form');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.submit');

?>