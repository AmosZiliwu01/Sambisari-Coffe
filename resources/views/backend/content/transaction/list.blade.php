@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6">
            <h1 class="h3 mb-2 text-gray-800">List Transaksi</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" collspacing="0">
                                <a href="{{ route('transaksi.deleteAll') }}" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Are you sure you want to delete all transactions?')">Delete All Transactions</a>

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th> <!-- Tambahkan kolom Status -->
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($counter = 1)
                                @foreach($rows as $row)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->customer_name}}</td>
                                        <td>{{$row->date}}</td>
                                        <td class="text-right">Rp {{$row->total}}</td>
                                        <td>{{$row->status}}</td> <!-- Tampilkan Status -->
                                        <td>
                                        @if($row->status == 'Proses')
                                                <a href="{{ route('transaksi.updateStatus', ['id' => $row->id, 'status' => 'Selesai']) }}" class="btn btn-sm btn-success">
                                                    Selesai
                                                </a>
                                            @else
                                                <a href="{{ route('transaksi.updateStatus', ['id' => $row->id, 'status' => 'Proses']) }}" class="btn btn-sm btn-warning">
                                                    Proses
                                                </a>
                                            @endif
                                            <a href="{{ route('transaksi.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('transactions.pdf') }}"
                           target="_blank">
                            <i class="fas fa-file-pdf btn btn-sm btn-danger"> </i>
                            <span class="text-white fas btn btn-sm btn-secondary" >Cetak List</span>
                        </a>

                    </div>
                    <div class="card-footer">
                        Total Semua Transaksi: Rp {{$totalSemuaTransaksi}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

