@extends('backend.layout.login')
@section('judul','Login')
@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register User Baru</h1>
                        </div>
                        <div class="text-center">
                            <h2 class="h4 sidebar-brand-text mx-3">SAMBISARI <i class="text-danger">COFFE</i></h2>
                        </div>
                        @if(session()->has('pesan'))
                            <div class="alert alert-danger">
                                {{session()->get('pesan')}}
                            </div>
                        @endif

                        <form class="user" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control form-control-user"
                                           placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control form-control-user"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-user"
                                           placeholder="Password">
                                </div>
                            </div>

                            <button class="btn bg-success1 text-white btn-block" type="submit">Register</button>
                            <a href="/login" class="btn btn-primary btn-block">Kembali</a>
                            <hr>
                            <div class="text-center">
                                <span class="small">or register with</span>
                            </div>
                            <div class="text-center">
                                <a href="index.html" class="d-inline-block">
                                    <i class="h1 fab fa-google fa-fw"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
