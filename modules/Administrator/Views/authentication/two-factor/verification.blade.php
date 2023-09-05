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
                        <h4 class="text-1000">Enter the verification code</h4>
                        <p class="text-700 mb-0">An email containing a 6-digit verification code has been sent to the email address - exa*********.com </p>
                        <P class="fs--2 mb-5">Don’t have access? <a href="#!">Use another method</a></P>
                        <form class="verification-form" action="" method="post" data-2FA-varification="data-2FA-varification">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <input class="form-control px-2 text-center" type="number" />
                                <input class="form-control px-2 text-center" type="number" disabled="disabled" />
                                <input class="form-control px-2 text-center" type="number" disabled="disabled" />
                                <span>-</span>
                                <input class="form-control px-2 text-center" type="number" disabled="disabled" />
                                <input class="form-control px-2 text-center" type="number" disabled="disabled" />
                                <input class="form-control px-2 text-center" type="number" disabled="disabled" />
                            </div>
                            <div class="form-check text-start mb-4">
                                <input class="form-check-input" id="2fa-checkbox" type="checkbox" />
                                <label for="2fa-checkbox">Don’t ask again on this device</label>
                            </div>
                            <Button class="btn btn-primary w-100 mb-5" type="submit">Varify</Button>
                            <a class="fs--1" href="#!">Didn’t receive the code? </a>
                        </form>
                    </div>
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
                title: '{{ __('administrator::commons.auth_title') }}',
                text: '{{ $errors->first('warning') }}',
            })
        </script>
    @endpush
@endif