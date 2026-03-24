<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::latest()->take(8)->get();
        return view('home', compact('products'));
    }

    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function show(Product $product)
    {
        //
    }

    // Edit form show
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update to database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        // If a new image is uploaded, replace it; otherwise, keep the old one.
        if ($request->hasFile('image')) {
            // Delete the old image (if it exists).
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->stock       = $request->stock;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete it
    public function destroy(Product $product)
    {
        // Delete the image from the server as well.
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function shop()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart    = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name"     => $product->name,
                "quantity" => 1,
                "price"    => $product->price,
                "image"    => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }
}

?>