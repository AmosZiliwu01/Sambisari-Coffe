@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Promosi</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('promosi.prosesTambah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form label">Judul Promosi</label>
                        <input type="text" name="judul_promosi" value="{{old('judul_promosi')}}" class="form-control @error('judul_promosi') is-invalid @enderror">
                        @error('judul_promosi')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Deskripsi Promosi</label>
                        <input type="text" name="deskripsi" value="{{old('deskripsi')}}" class="form-control @error('deskripsi') is-invalid @enderror">
                        @error('deskripsi')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Foto Promosi</label>
                        <input type="file" name="image_promosi" class="form-control @error('image_promosi') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('image_promosi')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="" alt="" width="15%">
                    </div>

                    <div class="mb-3">
                        <label class="form label">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Tanggal Berakhir</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Harga Diskon</label>
                        <input type="text" name="discount_price" value="{{ old('discount_price') }}" class="form-control @error('discount_price') is-invalid @enderror">
                        @error('discount_price')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Status Aktif</label>
                        <select name="active_status" class="form-control @error('active_status') is-invalid @enderror">
                            <option value="1" {{ old('active_status') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('active_status') == '0' ? 'selected' : '' }}>Non-aktif</option>
                        </select>
                        @error('active_status')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">ID Produk</label>
                        <input type="text" name="id" value="{{ old('id') }}" class="form-control @error('id') is-invalid @enderror">
                        @error('id')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('promosi.index') }}" class="btn btn-success">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
