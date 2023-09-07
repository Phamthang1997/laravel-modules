@extends('administrator::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <a class="d-flex flex-center text-decoration-none mb-4" href="/">
                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
                        <img src="{{ asset('administration/assets/image/icons/logo.png') }}" alt="phoenix" width="58"/>
                    </div>
                </a>
                <div class="text-center mb-7">
                    <h3 class="text-1000">Sign In</h3>
                    <p class="text-700">Get access to your account</p>
                </div>
                <button class="btn btn-phoenix-secondary w-100 mb-3">
                    <span class="fab fa-google text-danger me-2 fs--1"></span>Sign in with google
                </button>
                <button class="btn btn-phoenix-secondary w-100"><span
                            class="fab fa-facebook text-primary me-2 fs--1"></span>Sign in with facebook
                </button>
                <div class="position-relative">
                    <hr class="bg-200 mt-5 mb-4"/>
                    <div class="divider-content-center">or use email</div>
                </div>
                <form action="{{route(request()->route()->getPrefix().'.authenticate')}}" method="post">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Email address</label>
                        <div class="form-icon-container">
                            <input class="form-control form-icon-input" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="name@example.com"/>
                            <span class="fas fa-user text-900 fs--1 form-icon"></span>
                        </div>
                        @if ($errors->has('email'))
                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-icon-container">
                            <input class="form-control form-icon-input" name="password" id="password" type="password" placeholder="Password"/>
                            <span class="fas fa-key text-900 fs--1 form-icon"></span>
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="row flex-between-center mb-7">
                        <div class="col-auto">
                            <div class="form-check mb-0">
                                <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked"/>
                                <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                            </div>
                        </div>
                        <div class="col-auto"><a class="fs--1 fw-semi-bold" href="{{ route('management.password.forgot') }}">Forgot Password?</a></div>
                    </div>
                    <button class="btn btn-primary w-100 mb-3">Sign In</button>
                </form>
                <div class="text-center"><a class="fs--1 fw-bold" href="/">Create an account</a></div>
            </div>
        </div>
    </div>
@endsection

@if ($errors->has('warning'))
    @push('scripts')
        <script async>
            Swal.fire({
                icon: 'error',
                title: '{{ __('administrator::commons.auth_title') }}',
                text: '{{ $errors->first('warning') }}',
            })
        </script>
    @endpush
@endif