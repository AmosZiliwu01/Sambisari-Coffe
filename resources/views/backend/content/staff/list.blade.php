@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Staff</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('staff.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Tanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($staffs as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->jabatan }}</td>
                                <td><a href="mailto:{{ $row->email }}" class="text-primary">{{ $row->email }}</a></td> <!-- Memperbarui email menjadi tautan -->
                                <td>{{ $row->tanggung_jawab }}</td>
                                <td>
                                    <a href="{{ route('staff.ubah', $row->id_staff) }}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{ route('staff.hapus', $row->id_staff) }}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
