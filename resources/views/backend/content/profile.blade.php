@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Profile</h1>

        @if(session()->has('pesan'))
            <div class="alert alert-{{session()->get('pesan')[0]}}">
                {{ session()->get('pesan')[1] }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('user.prosesUpdateProfile') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="col-form-label">Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    <a href="{{ routeForRole() }}" class="btn btn-secondary">Kembali</a> <!-- Dynamic route for role -->
                </form>
            </div>
        </div>
    </div>
@endsection

@php
    function routeForRole() {
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin':
                return route('dashboard.index');
            case 'kasir':
                return route('kategori.index');
            case 'pelanggan':
                return route('pesanan.index');
            default:
                return route('http://127.0.0.1:8000/'); // Default route if role is not recognized
        }
    }
@endphp
