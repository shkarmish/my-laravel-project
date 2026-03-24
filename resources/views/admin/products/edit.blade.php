<!-- resources/views/admin/products/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">Back to Products</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control"
                   value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label>Image:</label><br>
            {{-- Current image preview --}}
            @if($product->image)
                <img src="{{ asset('images/'.$product->image) }}" width="100" class="mb-2 d-block">
                <small class="text-muted">Nai image upload karo toh purani replace ho jaegi, warna same rahegi.</small>
            @endif
            <input type="file" name="image" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>
</body>
</html>