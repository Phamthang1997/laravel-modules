@extends('administrator::layouts.app')

@section('content')
    <div class="px-3">
        <div class="row min-vh-100 flex-center p-5">
            <div class="col-12 col-xl-10 col-xxl-8">
                <div class="row justify-content-center align-items-center g-5">
                    <div class="col-12 col-lg-6 text-center order-lg-1">
                        <img class="img-fluid w-lg-100 d-dark-none" src="{{ asset('administration/assets/image/spot-illustrations/404-illustration.png') }}" alt="illustration" width="400" />
                        <img class="img-fluid w-md-50 w-lg-100 d-light-none" src="{{ asset('administration/assets/image/spot-illustrations/dark_404-illustration.png') }}" alt="illustration" width="540" />
                    </div>
                    <div class="col-12 col-lg-6 text-center text-lg-start">
                        <img class="img-fluid mb-6 w-50 w-lg-75 d-dark-none" src="{{ asset('administration/assets/image/spot-illustrations/404.png') }}" alt="illustration" />
                        <img class="img-fluid mb-6 w-50 w-lg-75 d-light-none" src="{{ asset('administration/assets/image/spot-illustrations/dark_404.png') }}" alt="illustration" />
                        <h2 class="text-800 fw-bolder mb-3">Page Missing!</h2>
                        <p class="text-900 mb-5">
                            But no worries! Our ostrich is looking everywhere<br class="d-none d-sm-block" />while you wait safely.
                        </p>
                        <a class="btn btn-lg btn-primary" href="{{ route('management.index') }}">Go Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection