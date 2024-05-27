@extends('frontend.layout.mainProduct')
@section('content')
<section class="py-5 text-white mt-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <img class="img-fluid rounded-circle" src="{{asset("assets/img/undraw_profile.svg")}}" alt="..." width="50rem"/>
                    <div class="ms-3">
                        <div class="fw-bold">Admin</div>
                        <div class="text-white">{{$product->kategori->nama_kategori}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{$product->name}}</h1>
                        <!-- Post meta content-->
                        <div class="text-white fst-italic mb-2">{{$product->created_at}}</div>
                        </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{route('storage',$product->gambar_product)}}" alt="{{$product->name}}" width="50%"/></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $product->isi_product !!}</p>
                    </section>
                </article>

            </div>
        </div>
    </div>
    <div class="btn btn-dark align-items-center mb-5 mb-xl-0" style="background-color: #343a40; border-color: #343a40;">
        <a class="text-decoration-none" href="{{ route('home.index') }}" style="color: white;">
            Kembali
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>
@endsection
