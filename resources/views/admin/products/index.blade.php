<!-- resources/views/admin/products/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>All Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('images/'.$product->image) }}" width="80">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    {{-- Edit button --}}
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="btn btn-warning btn-sm">Edit</a>

                    {{-- Delete button --}}
                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                          method="POST"
                          style="display:inline-block;"
                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>