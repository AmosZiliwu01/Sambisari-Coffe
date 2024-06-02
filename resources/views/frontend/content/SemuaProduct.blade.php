@extends('frontend.layout.MainProduct')
@section('content')
    <!-- Blog preview section-->

    <section class="menu pt-5">
        <h1 class="heading">Semua <span>Menu</span></h1>
        <div class="box-container">
            @foreach($product as $row)
                <div class="container">
                    <div class="rowcontainer-fluid">
                        <div>
                            <div class="box">
                                <a href="{{route('home.detailProduct',$row->id)}}">
                                    <img src="{{ route('storage',$row->gambar_product) }}" alt="{{$row->name}}" alt="" class="product-img"></a>
                                <div class="rounded-pill"></div>
                                <div class="badge bg-primary bg-gradient mb-2">{{$row->kategori->nama_kategori}}</div>
                                <h3 class="product-title">{{$row->name}}</h3>
                                <div class="price">Rp {{$row->price}}</div>
                                <p class="card-text mb-0 text-truncate">{!! substr($row->isi_product, 0, 200) !!}</p>
                                <a class="btn add-cart" href="{{route('pesanan.index')}}">Tambah Pesanan</a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn btn-dark align-items-center mb-5 mb-xl-0" style="background-color: #343a40; border-color: #343a40;">
            <a class="text-decoration-none" href="{{ route('home.index') }}" style="color: white;">
                Kembali
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection
