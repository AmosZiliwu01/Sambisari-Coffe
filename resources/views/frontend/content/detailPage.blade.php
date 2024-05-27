@extends('frontend.layout.mainProduct')
@section('content')
    <section class="py-5 text-white mt-5">
        <div class="container px-5 my-5">

            <div class="row gx-5">
                <div class="col-lg-3">
                    <div class="d-flex align-items-center mt-lg-5 mb-4">
                        <img class="img-fluid rounded-circle" src="{{asset("assets/img/undraw_profile.svg")}}" alt="..." width="50%"/>
                        <div class="ms-3">
                            <div class="fw-bold">Admin</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{$page->judul_page}}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">{{$page->created_at}}</div>
                        </header>
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $page->isi_page !!}</p>
                    </section>
                </article>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
