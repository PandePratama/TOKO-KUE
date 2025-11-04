<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Edit Product</title>
</head>

<body>
    <h1>Product Management System</h1>
    <h2>Edit Product</h2>

    {{-- Error Validation --}}
    @if ($errors->any())
    <div style="color: red; margin: 10px 0; padding: 10px; border: 1px solid red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 10px;">
            <label>Product Name:</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Description:</label><br>
            <textarea name="description" style="width: 300px; height: 100px;">{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Price:</label><br>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Stock Quantity:</label><br>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Product Image:</label><br>
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}"
                alt="{{ $product->name }}"
                width="120"
                style="display:block; margin-bottom:10px;">
            @else
            <p style="color: gray;">No Image</p>
            @endif
            <input type="file" name="image" accept="image/*">
            <small>Leave empty if you don’t want to change the image.</small>
        </div>

        <button type="submit" style="padding: 10px 15px; background:#28a745; color:white; border:none; cursor:pointer;">
            Update
        </button>
        <a href="{{ route('products.index') }}"
            style="padding: 10px 20px; background: #6c757d; color:white; text-decoration: none; display:inline-block;">
            Cancel
        </a>
    </form>

    <br>
    <a href="{{ route('products.index') }}">Back to Product List</a>
</body>

</html>