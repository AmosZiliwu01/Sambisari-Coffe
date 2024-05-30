@extends('backend.layout.login')
@section('content')

    <body class="bg-img1">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 90vh;">

            <div class="col-lg-4">
                <form class="form" style="text-align: center;" method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-title"><span>Forgot Your Password?</span></div>
                    <div class="title-2"><span>Don't worry, it happens!</span></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="input-container">
                        <input class="input-mail" name="email" type="email" placeholder="Enter your email" style="width: 80vw; max-width: 100%;">
                    </div>

                    <section class="bg-stars">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </section>

                    <button type="submit" class="submit" style="width: 80vw; max-width: 100%;">
                        <span class="sign-text">Send Password Reset Link</span>
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ route('auth.index') }}" class="btn-user btn-block">
                            Back to Login
                        </a>
                    </div>
                </form>
            </div>

        </div>

    </div>
    </body>
@endsection
