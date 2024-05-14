@extends('backend.layout.login')
@section('judul','Register')
@section('content')

    <body class="bg-img1">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 90vh;">

            <div class="col-lg-4">
                <form class="form" method="post" action="{{route('register.index')}}">
                    @csrf
                    <div class="form-title"><span>Register</span></div>
                    <div class="title-2"><span>SAMBISARI COFFE</span></div>
                    @if(session()->has('pesan'))
                        <div class="alert alert-danger">
                            {{session()->get('pesan')}}
                        </div>
                    @endif
                    <div class="input-container">
                        <input class="input-mail" name="name" type="text" placeholder="Enter name" style="width: 80vw; max-width: 100%;">
                        <span> </span>
                    </div>

                    <section class="bg-stars">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </section>

                    <div class="input-container">
                        <input class="input-mail" name="email" type="email" placeholder="Enter email" style="width: 80vw; max-width: 100%;">
                        <span> </span>
                    </div>

                    <section class="bg-stars">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </section>

                    <div class="input-container">
                        <input class="input-pwd" name="password" type="password" placeholder="Enter password" style="width: 80vw; max-width: 100%;">
                    </div>
                    <button type="submit" class="submit" style="width: 80vw; max-width: 100%;">
                        <span class="sign-text">Register</span>
                    </button>

                    <div class="text-center">
                        <span class="small">or register with</span>
                    </div>
                    <div class="text-center">
                        <a href="index.html" class="d-inline-block">
                            <i class="h1 fab fa-google fa-fw"></i>
                        </a>
                    </div>
                    <p class="signup-link">
                        Already have an account?
                        <a href="/login" class="up">Sign in!</a>
                    </p>
                </form>
            </div>

        </div>

    </div>
    </body>
@endsection
