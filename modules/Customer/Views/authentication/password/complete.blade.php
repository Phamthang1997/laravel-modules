@extends('customer::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <a class="d-flex flex-center text-decoration-none mb-4" href="/">
                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
                        <img src="{{ asset('customer/assets/image/icons/logo.png') }}" alt="phoenix" width="58"/>
                    </div>
                </a>
                <div class="text-center mb-7">
                    <h3 class="text-1000">Password is changed</h3>
                    <p class="text-700">Your password is successfully changed. Please Sign
                        in to your account and start a new project.</p>
                </div>
                <div class="mb-5 mt-3 text-center">
                    <a class="btn btn-primary w-50 " href="{{ route('customer.login') }}"> Sign In</a>
                </div>
                <div class="text-center">Did’t receive an email? <a class="fs-0 fw-bold" href="{{ route('customer.password.forgot') }}">Try Again</a></div>
                <div class="col-12 text-center order-lg-1">
                    <img class="img-fluid w-lg-100 d-dark-none" src="{{ asset('customer/assets/image/spot-illustrations/2.png') }}" alt="illustration" width="400" />
                    <img class="img-fluid w-md-50 w-lg-100 d-light-none" src="{{ asset('customer/assets/image/spot-illustrations/dark_2.png') }}" alt="illustration" width="540" />
                </div>
            </div>
        </div>
    </div>
@endsection