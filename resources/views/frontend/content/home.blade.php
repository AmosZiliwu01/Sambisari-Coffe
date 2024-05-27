@extends('frontend.layout.main')
@section('content')

    <!-- NEWS SECTION -->
    <section class="news" id="news">
        <h1 class="heading" id="newsLates"><span>Latest</span> News</h1>
        <div class="box-container">
            <div class="news-container">
                <!-- LightWidget WIDGET -->
                <iframe src="https://cdn.lightwidget.com/widgets/29a631c7a2285c009faaf3b865d7348b.html" scrolling="no"
                        allowtransparency="true" class="lightwidget-widget"
                        style="width:100%;border:white;overflow:hidden;"></iframe>
            </div>
            <div class="text-center mt-3">
                <a class="btn btn-dark align-items-center" href="https://www.instagram.com/amos_zil/" target="_blank"
                   style="background-color: #343a40; border-color: #343a40;">
                    Lihat Semua Berita
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>



    <!-- Menu Product-->
    <section class="menu">
        <h1 class="heading mt-5" id="menu">Our <span>Menu</span></h1>
        <div class="box-container">
            @foreach($product as $row)
                <div class="container">
                    <div class="rowcontainer-fluid">
                        <div>
                            <div class="box">
                                <a href="{{route('home.detailProduct',$row->id)}}">
                                    <div class="image">
                                        <img src="{{ route('storage',$row->gambar_product) }}" alt="{{$row->name}}"
                                             alt="" class="product-img">
                                    </div>
                                </a>
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
        <div class="text-center mt-3">
            <a class="btn btn-dark align-items-center" href="{{route('home.product')}}" style="background-color: #343a40; border-color: #343a40;">
                Lihat Semua Product
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>


    </section>

@endsection
