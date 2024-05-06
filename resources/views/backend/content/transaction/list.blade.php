@extends('backend.layout.main')
@section('judul','Data Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($counter = 1)
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->date}}</td>
                                    <td class="text-right">Rp {{$row->total}}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info ">
                                            <i class="fas fa-eye  "></i>
                                        </a>
                                        <a href="{{url("transaksi/$row->id/pdf")}}"
                                           target="_blank"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-file-pdf  "></i>
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
    </div>

@endsection
