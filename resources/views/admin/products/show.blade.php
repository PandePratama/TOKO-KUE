<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Product Details</title>
</head>

<body>
    <h1>Product Management System</h1>
    <h2>Product Details</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $product->description ?? '-' }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Stock Quantity</th>
            <td>{{ $product->stock_quantity }}</td>
        </tr>
        <tr>
            <th>Product Image</th>
            <td> @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80">
                @else
                <span style="color: gray;">No Image</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $product->created_at->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ route('products.edit', $product->id) }}"
        style="padding: 8px 15px; background:#007bff; color:white; text-decoration:none; display:inline-block;">
        Edit
    </a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
            onclick="return confirm('Are you sure you want to delete this product?')"
            style="padding: 8px 15px; background:#dc3545; color:white; border:none; cursor:pointer;">
            Delete
        </button>
    </form>

    <a href="{{ route('products.index') }}"
        style="padding: 8px 15px; background:#6c757d; color:white; text-decoration:none; display:inline-block; margin-left:10px;">
        Back to List
    </a>
</body>

</html>