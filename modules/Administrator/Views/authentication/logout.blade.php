@extends('administrator::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-6 col-xxl-4">
                <div class="text-center mb-6 mx-auto">
                    <img class="mb-7 d-dark-none" src="{{ asset('administration/assets/image/spot-illustrations/1.png') }}" alt="phoenix" />
                    <img class="mb-7 d-light-none" src="{{ asset('administration/assets/image/spot-illustrations/dark_1.png')}}" alt="phoenix" />
                    <div class="mb-6">
                        <h4 class="text-1000">Come back soon!</h4>
                        <p class="text-700">Thanks for using laravel modules <br class="d-lg-none" />You are now successfully signed out.</p>
                    </div>
                    <div class="d-grid">
                        <a class="btn btn-primary" href="{{route(request()->route()->getPrefix().'.login')}}">
                            <span class="fas fa-angle-left me-2"></span>Go to sign in page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection