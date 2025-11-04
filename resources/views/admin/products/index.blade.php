<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - All Products</title>
</head>

<body>
    <h1>Product Management System</h1>
    <h2>All Products</h2>

    @if (session('success'))
    <div style="color:green; margin: 10px 0; padding: 10px; border: 1;">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('products.create') }}"
        style="display: inline-block; margin-bottom: 20px; padding: 10px; text-decoration: none;">
        Add New Product
    </a>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}">View</a>
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No Products Found.</td>
            </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>