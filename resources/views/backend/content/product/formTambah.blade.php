@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">Tambah Produk</h1>
            </div>
        </div>

        @if(session()->has('pesan'))
            <div class="alert alert-{{session()->get('pesan')[0]}}">
                {{ session()->get('pesan')[1] }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('product.prosesTambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="col-form-label">Foto Product</label>
                        <input type="file" name="gambar_product" class="form-control @error('gambar_product') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('gambar_product')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null; this.src='https://www.shutterstock.com/id/image-illustration/no-picture-available-placeholder-thumbnail-icon-2179364083'" src="" alt="" width="15%">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Kategori Product</label>
                        <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            @foreach($kategori as $row)
                                <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode:</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_product">Deskripsi Product:</label>
                        <textarea class="form-control" id="isi_product" name="isi_product" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
