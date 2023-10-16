@extends('customer::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3"><a class="d-flex flex-center text-decoration-none mb-4" href="/">
                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block"><img src="{{ asset('customer/assets/image/icons/logo.png') }}" alt="phoenix" width="58" /></div>
                </a>
                <div class="text-center mb-7">
                    <h3 class="text-1000">Sign Up</h3>
                    <p class="text-700">Create your account today</p>
                </div><button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs--1"></span>Sign up with google</button><button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs--1"></span>Sign up with facebook</button>
                <div class="position-relative mt-4">
                    <hr class="bg-200" />
                    <div class="divider-content-center">or use email</div>
                </div>
                <form action="{{ route('customer.store.create') }}" method="post">
                    @csrf
                    <div class="mb-3 text-start"><label class="form-label" for="name">Name</label><input class="form-control" id="name" type="text" placeholder="Name" name="name" /></div>
                    <div class="mb-3 text-start"><label class="form-label" for="email">Email address</label><input class="form-control" id="email" type="email" placeholder="name@example.com" name="email" /></div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6"><label class="form-label" for="password">Password</label><input class="form-control form-icon-input" id="password" type="password" placeholder="Password" name="password" /></div>
                        <div class="col-sm-6"><label class="form-label" for="confirmPassword">Confirm Password</label><input class="form-control form-icon-input" id="confirmPassword" type="password" placeholder="Confirm Password" name="confirm_password" /></div>
                    </div>
                    <div class="form-check mb-3"><input class="form-check-input" id="termsService" type="checkbox" name="terms_service"/><label class="form-label fs--1 text-none" for="termsService">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label></div><button class="btn btn-primary w-100 mb-3">Sign up</button>
                    <div class="text-center"><a class="fs--1 fw-bold" href="{{ route('customer.login') }}">Sign in to an existing account</a></div>
                </form>
            </div>
        </div>
    </div>
@endsection