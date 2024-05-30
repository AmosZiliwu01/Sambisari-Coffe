@extends('backend.layout.login')
@section('content')

    <body class="bg-img1">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 90vh;">
            <div class="col-lg-4">
                <form class="form" style="text-align: center;" method="post" action="{{ route('password.update', ['token' => $email]) }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-title"><span>Reset Your Password</span></div>
                    <div class="title-2"><span>Enter your new password</span></div>
                    <!-- Input field for new password -->
                    <div class="form-group">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password (min 6)" required>
                    </div>
                    <!-- Input field for password confirmation -->
                    <div class="form-group">
                        <input id="password-confirm" type="password" name="c_new_password" class="form-control" placeholder="Confirm New Password"  autocomplete="new-password">
                    </div>
                    <button type="submit" class="submit" style="width: 80vw; max-width: 100%;">
                        <span class="sign-text">Reset Password</span>
                    </button>
                    <a href="{{ route('auth.index') }}">Back to Login</a>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection
