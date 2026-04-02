@extends('admin.layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Produk</h6>
        </div>

        <div class="card-body">
            <div class="row">

                {{-- IMAGE --}}
                <div class="col-md-4 text-center">
                    @if ($product->primaryImage)
                    <img
                        src="{{ Storage::url($product->primaryImage->image_path) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid img-thumbnail mb-3"
                        style="max-height:250px">
                    @else
                    <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </div>

                {{-- INFO --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID Produk</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $product->description ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>
                                <span class="badge badge-success">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>
                                <span class="badge badge-info">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ optional($product->created_at)->format('d M Y H:i') ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Terakhir Update</th>
                            <td>{{ optional($product->updated_at)->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('admin.products.edit', $product) }}"
                        class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.products.destroy', $product) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection