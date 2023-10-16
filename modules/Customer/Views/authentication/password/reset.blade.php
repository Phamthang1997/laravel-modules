@extends('customer::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <a class="d-flex flex-center text-decoration-none mb-4" href="#">
                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
                        <img src="{{ asset('customer/assets/image/icons/logo.png') }}" alt="phoenix" width="58" />
                    </div>
                </a>
                <div class="text-center mb-6">
                    <h4 class="text-1000">Reset new password</h4>
                    <p class="text-700">Type your new password</p>
                    <form class="mt-5" action="" method="post">
                        @csrf
                        <div class="mb-3 text-start">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="password" id="password" type="password" placeholder="Type new password"/>
                                <span class="fas fa-key text-900 fs--1 form-icon"></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="confirm_password" id="confirmPassword" type="password" placeholder="Confirm new password"/>
                                <span class="fas fa-key text-900 fs--1 form-icon"></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Set Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($errors->has('warning'))
    @push('scripts')
        <script async>
            Swal.fire({
                icon: 'error',
                title: '{{ __('customer::commons.auth_title') }}',
                text: '{{ $errors->first('warning') }}',
            })
        </script>
    @endpush
@endif