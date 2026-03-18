<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $products = Product::all(); // Retrieve all products from the database
    return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageName = null; // default value, image optional
        $request->validate([
      'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
    ]);


$product = new Product();
$product->name = $request->name;
$product->description = $request->description;
$product->price = $request->price;
$product->stock = $request->stock;
$product->image = $imageName; // safe, null if no image
$product->save();

if($request->hasFile('image')){
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images'), $imageName);
    $product->image = $imageName;
}

    $product->stock = $request->stock;
    $product->save();

    return redirect('/admin/products')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    // Show all products
public function shop() {
   $products = Product::all();
    return view('shop.index', compact('products'));
}

// Add to cart
public function addToCart($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect('/cart');
}

// Show cart
public function cart() {
    $cart = session()->get('cart', []);
    return view('shop.cart', compact('cart'));
}
}
