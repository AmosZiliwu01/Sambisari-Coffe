@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">Detail Pesanan</h1>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pesanan</th>
                            <th>Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($itemPesanan as $ip)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$ip->product->name}}</td>
                                <td>{{$ip->qty}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
