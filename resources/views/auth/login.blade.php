{{-- layout --}}
@extends('layouts.auth')

{{-- title --}}
@section('title', 'Login | ' . config('app.name'))

{{-- content --}}
@section('content')
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="col-sm-8 col-md-6 col-xl-9">
            <h2 class="mb-3 fs-7 fw-bolder">Welcome to {{ config('app.name') }}</h2>
            <p class=" mb-9">Your Admin Dashboard</p>
            <div class="row">
                <div class="col-12 mb-2 mb-sm-0">
                    <a class="btn btn-white text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                        href="{{ URL::to('/auth/redirect') }}" role="button">
                        <img src="{{ asset('/') }}images/svgs/google-icon.svg" alt="" class="img-fluid me-2"
                            width="18" height="18">
                        <span class="d-none d-sm-block me-1 flex-shrink-0">Sign in with</span>Google
                    </a>
                </div>
            </div>
            <div class="position-relative text-center my-4">
                <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                    or sign in
                    with</p>
                <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
            </div>
            <form id="login-form" action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input required name="email" type="email" class="form-control" id="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input required name="password" type="password" class="form-control" id="password">
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            Remeber this Device
                        </label>
                    </div>
                    <a class="text-primary fw-medium" href="{{ route('password.request') }}">Forgot Password ?</a>
                </div>
                <button onclick="submitForm('#login-form')" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign
                    In</button>
                <div class="d-flex align-items-center justify-content-center d-none">
                    <a class="text-primary fw-medium ms-2" href="./authentication-register.html">Create an account</a>
                </div>
            </form>
        </div>
    </div>
@endsection
