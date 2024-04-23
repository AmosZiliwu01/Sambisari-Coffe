@extends('backend/layout/main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Tambah Product</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('product.prosesTambah')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="col-form-label">Judul product</label>
                    <input type="text" name="judul_product" value="{{old('nama_kategori')}}" class="form-control @error('judul_product') is-invalid @enderror">
                    @error('judul_product')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Kategori product</label>
                    <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                        @foreach($kategori as $row)
                            <option value="{{$row->id_kategori}}">{{$row->nama_kategori}}</option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Foto product</label>
                    <input type="file" name="gambar_product"  class="form-control @error('gambar_product') is-invalid @enderror"
                           accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                    @error('judul_product')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                    @enderror
                    <p></p>
                    <img id="tampilFoto" onerror="this.onerror=null; this.src='https://www.shutterstock.com/id/image-illustration/no-picture-available-placeholder-thumbnail-icon-2179364083'" src="" alt="" width="15%">
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Isi product</label>
                    <textarea id="editor" name="isi_product" class="form-control @error('isi_product') is-invalid @enderror">{{old('isi_product')}}</textarea>
                    @error('isi_product')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{route('product.index')}}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
