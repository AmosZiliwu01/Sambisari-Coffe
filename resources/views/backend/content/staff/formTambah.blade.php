@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Staff</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('staff.prosesTambah') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror">
                            <option value="">Pilih Jabatan</option>
                            <option value="Barista" {{ old('jabatan') == 'Barista' ? 'selected' : '' }}>Barista</option>
                            <option value="Kasir" {{ old('jabatan') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="Pelayan" {{ old('jabatan') == 'Pelayan' ? 'selected' : '' }}>Pelayan</option>
                            <!-- Tambahkan opsi jabatan lainnya sesuai kebutuhan -->
                        </select>
                        @error('jabatan')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggung Jawab</label>
                        <input type="text" name="tanggung_jawab" value="{{ old('tanggung_jawab') }}" class="form-control @error('tanggung_jawab') is-invalid @enderror">
                        @error('tanggung_jawab')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('staff.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
