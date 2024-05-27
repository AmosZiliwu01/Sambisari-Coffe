@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Product</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('product.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        @if(session()->has('pesan'))
            <div class="alert alert-{{session()->get('pesan')[0]}}">
                {{ session()->get('pesan')[1] }}
            </div>

        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" collspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar Product</th>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Deskripsi Product</th>
                            <th>Price</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><img src="{{ route('storage', $product->gambar_product) }}" width="50px" height="50px"></td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->isi_product }}</td> <!-- Display isi_product -->
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->kategori->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('product.ubah', $product->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{ route('product.hapus', $product->id) }}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-secondary btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
