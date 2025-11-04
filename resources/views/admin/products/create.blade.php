<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Add New Product</title>
</head>

<body>
    <h1>Product Management System</h1>
    <h2>Add New Product</h2>

    @if ($errors->any())
    <div style="color: red; margin: 10px 0; padding: 10px; border: 1px solid red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Product Image:</label><br>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>


    <br>
    <a href="{{ route('products.index') }}">Back to Product List</a>
</body>

</html>