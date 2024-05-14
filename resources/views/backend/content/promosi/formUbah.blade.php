@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Promosi</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('promosi.prosesUbah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form label">Judul Promosi</label>
                        <input type="text" name="judul_promosi" value="{{$promosi->judul_promosi}}" class="form-control @error('judul_promosi') is-invalid @enderror">
                        @error('judul_promosi')
                        <span style="">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Deskripsi Promosi</label>
                        <input type="text" name="deskripsi" value="{{$promosi->deskripsi}}" class="form-control @error('deskripsi') is-invalid @enderror">
                        @error('deskripsi')
                        <span style="">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Product Promosi</label>
                        <select name="id" class="form-control @error('id') is-invalid @enderror">
                            @foreach($product as $row)
                                @php
                                    $selected = ($row->id == $promosi->id) ? "selected" : "";
                                @endphp
                                <option value="{{$row->id}}" {{$selected}}>{{$row->name}}</option>
                            @endforeach
                        </select>
                        @error('id')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Foto Promosi</label>
                        <input type="file" name="image_promosi" class="form-control @error('image_promosi') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('image_promosi')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="{{route('storage',$promosi->image_promosi)}}" alt="" width="15%">
                    </div>

                    <div class="mb-3">
                        <label class="form label">Start Date</label>
                        <input type="date" name="start_date" value="{{$promosi->start_date}}" class="form-control @error('start_date') is-invalid @enderror">
                        @error('start_date')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">End Date</label>
                        <input type="date" name="end_date" value="{{$promosi->end_date}}" class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Discount Price</label>
                        <input type="number" step="0.01" name="discount_price" value="{{$promosi->discount_price}}" class="form-control @error('discount_price') is-invalid @enderror">
                        @error('discount_price')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Active Status</label>
                        <select name="active_status" class="form-control @error('active_status') is-invalid @enderror">
                            <option value="1" {{ $promosi->active_status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $promosi->active_status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active_status')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="id_promosi" value="{{$promosi->id_promosi}}">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('promosi.index') }}" class="btn btn-success">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
