@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">Ubah Produk</h1>
            </div>
        </div>

        @if(session()->has('pesan'))
            <div class="alert alert-{{session()->get('pesan')[0]}}">
                {{ session()->get('pesan')[1] }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('product.prosesUbah') }}"  method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Foto Product</label>
                        <input type="file" name="gambar_product" class="form-control @error('gambar_product') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('name')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn,net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B0510O5KABlN930GwaMQz.jpg';" src="{{ route('product',$product->gambar_product) }}" alt="" width="15%">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Barcode</label>
                        <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control" @error('judul_product') is-invalid @enderror>
                        @error('barcode')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" @error('judul_product') is-invalid @enderror>
                        @error('name')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" value="{{ $product->price }}" class="form-control" @error('judul_product') is-invalid @enderror>
                        @error('price')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Product</label>
                        <textarea class="form-control" name="isi_product" required>{{ $product->isi_product }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Product</label>
                        <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            @foreach ($kategori as $row)
                                @php
                                    $selected = ($row->id_kategori == $product->id_kategori) ? "selected" : "";
                                @endphp
                                <option value="{{ $row->id_kategori }}" {{ $selected }}>{{ $row->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <span style="...">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
