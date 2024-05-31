<!-- Di dalam file trashed.blade.php -->
@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">List Produk yang Sudah Dihapus</h1>

        @if($trashedProducts->isEmpty())
            <div class="alert alert-info">
                Tidak ada produk yang telah dihapus.
            </div>
        @else
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Produk</th>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>Deskripsi Produk</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Aksi</th> <!-- Tambah kolom untuk tombol aksi -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trashedProducts as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ route('storage', $product->gambar_product) }}" width="50px" height="50px"></td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->isi_product }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->kategori->nama_kategori }}</td>
                                    <td>
                                        <form action="{{ route('product.restore', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i> Restore</button>
                                        </form>
                                        <form action="{{ route('product.delete-permanent', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-secondary btn-danger"><i class="fa fa-trash"> </i> Hapus Permanent</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
