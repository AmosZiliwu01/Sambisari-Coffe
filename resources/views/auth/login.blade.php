@extends('backend.layout.login')
@section('judul','Login')
@section('content')

    <body class="bg-img1">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 90vh;">

            <div class="col-lg-4">
                <form class="form" style="text-align: center;" method="post" action="{{route('auth.verify')}}">
                    @csrf
                    <div class="form-title"><span>sign in to</span></div>
                    <div class="title-2"><span>SAMBISARI COFFE</span></div>
                    @if(session()->has('pesan'))
                        <div class="alert alert-{{session()->get('pesan')[0]}}">
                            {{session()->get('pesan')[1]}}
                        </div>
                    @endif
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
                        <span class="sign-text">Sign in</span>
                    </button>

                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="btn-user btn-block">
                            Forgot Password
                        </a>
                    </div>

                    <div class="text-center">
                        <span class="small">or sign in with</span>
                    </div>
                    <div class="text-center">
                        <a href="index.html" class="d-inline-block">
                            <i class="h1 fab fa-google fa-fw"></i>
                        </a>
                    </div>

                    <p class="signup-link">
                        Don't have an account?
                        <a href="{{ route('register.index') }}" class="up">Sign Up!</a>
                    </p>
                </form>
            </div>

        </div>

    </div>
    </body>
@endsection
