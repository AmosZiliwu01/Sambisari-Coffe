@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        @can('pelangganR')
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5 alert alert-warning" role="alert">
                        Harap diperhatikan, pesanan Anda akan diproses setelah pembayaran telah diterima oleh kasir.
                        <br>
                        Silahkan konfirmasi ke kasir terlebih dahulu. Terima kasih atas kerjasamanya.
                    </div>
                </div>
            </div>
        @endcan
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Pesanan @can('pelangganR')Anda Disini @endcan</h1>
            </div>

        </div>
        <div class="col-lg-12 col-md-12 mt-3">
            <div class="card shadow">
                <div class="card-body">
                    @can('kasir')
                    <a href="{{ route('pesanan.deleteAll') }}" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Are you sure you want to delete all pesanan?')">Delete All Pesanan</a>
                    @endcan
                    <a href="{{ route('pesanan.tambah') }}" class="btn btn-sm btn-primary mb-2 text-right"><i class="fa fa-plus"></i> Tambah Pesanan</a>
                    <table class="table table-bordered" @can('kasir')id="dataTable" @endcan width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
{{--                            <th>Produk</th>--}}
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pesanan->nama_pelanggan }}</td>
{{--                                <td>--}}
{{--                                    @foreach ($products as $product)--}}
{{--                                        <div class="form-check">--}}
{{--                                            @can('kasir')--}}
{{--                                                <input class="form-check-input product-checkbox" type="checkbox" value="{{ $product->id }}" id="product_{{ $product->id }}" name="products[]">--}}
{{--                                            @else--}}
{{--                                                <input class="form-check-input" type="checkbox" disabled>--}}
{{--                                            @endcan--}}
{{--                                            <label class="form-check-label" for="product_{{ $product->id }}">--}}
{{--                                                {{ $product->name }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}

{{--                                </td>--}}
                                <td>{{ $pesanan->total_harga }}</td>
                                <td>{{ $pesanan->status }}</td>
                                    <td>
                                        <a href="{{route('pesanan.detail',$pesanan->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                        @can('kasir')
                                        @if($pesanan->status == 'Proses')
                                            <a href="{{ route('pesanan.updateStatus', ['id' => $pesanan->id, 'status' => 'Selesai']) }}" class="btn btn-sm btn-success">
                                                Selesai
                                            </a>
                                        @else
                                            <a href="{{ route('pesanan.updateStatus', ['id' => $pesanan->id, 'status' => 'Proses']) }}" class="btn btn-sm btn-warning">
                                                Proses
                                            </a>
                                        @endif
                                        @endcan
                                        <a href="{{route('pesanan.hapus',$pesanan->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this pesanan?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Tabel untuk menampilkan daftar produk -->
    @can('pelangganR')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="h3 mb-2 text-gray-800 mt-4">List Product</h1>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" collspacing="0">
                            <thead>
                            <tr>
                                <th>Gambar Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Kategori</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ route('storage', $product->gambar_product) }}" width="50px" height="50px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->kategori->nama_kategori }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
