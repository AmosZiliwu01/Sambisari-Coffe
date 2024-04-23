@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Product</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('product.prosesUbah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Product</label>
                        <input type="text" name="judul_product" value="{{ $product->judul_product }}" class="form-control" @error('judul_product') is-invalid @enderror>
                        @error('judul_product')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
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

                    <div class="mb-3">
                        <label class="form-label">Foto product</label>
                        <input type="file" name="gambar_product" class="form-control @error('gambar_product') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('judul_product')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn,net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B0510O5KABlN930GwaMQz.jpg';" src="{{ route('storage',$product->gambar_product) }}" alt="" width="15%">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi product</label>
                        <textarea id="editor" name="isi_product" class="form-control @error('isi_product') is-invalid @enderror">{{ $product->isi_product }}</textarea>
                        @error('isi_product')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
