@extends('administrator::layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-center min-vh-100 py-5">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <div class="text-center mb-5">
                    <div class="avatar avatar-4xl mb-4"><img class="rounded-circle" src="{{ asset('administration/assets/image/team/avatar.webp') }}" alt="avatar" /></div>
                    <h2 class="text-1000"> <span class="fw-normal">Hello </span>Laravel modules</h2>
                    <p class="text-700">Enter your password to access the admin</p>
                </div>
                <form class="mt-5" action="" method="post">
                    @csrf
                    <input class="form-control mb-3" id="password" type="password" placeholder="Enter Password" />
                    <a class="btn btn-primary w-100" href="#">Sign In</a>
                </form>
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