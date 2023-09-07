@extends('administrator::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xxl-4">
                <a class="d-flex flex-center text-decoration-none mb-4" href="#">
                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
                        <img src="{{ asset('administration/assets/image/icons/logo.png') }}" alt="phoenix" width="58" />
                    </div>
                </a>
                <div class="px-xxl-5">
                    <div class="text-center mb-6">
                        <h4 class="text-1000">Forgot your password?</h4>
                        <p class="text-700 mb-5">Enter your email below and we will send <br class="d-sm-none" />you a reset link</p>
                        <form class="d-flex align-items-center mb-3" action="{{ route('management.password.send') }}" method="post">
                            @csrf
                            <input class="form-control flex-1" name="email" id="email" type="email" placeholder="Email" />
                            <button class="btn btn-primary ms-2">Send<span class="fas fa-chevron-right ms-2"></span></button>
                        </form>
                        @if ($errors->has('email'))
                            <div class="form-icon-container">
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            </div>
                        @endif
                        <a class="fs--1 fw-bold" href="#!">Still having problems?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (session('status'))
    @push('scripts')
        <script async>
            Swal.fire({
                icon: 'success',
                title: '{{ __('administrator::commons.reset_password') }}',
                text: '{{ session('status') }}',
            })
        </script>
    @endpush
@endif