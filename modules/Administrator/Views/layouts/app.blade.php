<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    Document Title-->
    <title>{{ $title ?? 'Laravel Modules' }}</title>
    <!--    Favicons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('administration/assets/image/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('administration/assets/image/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('administration/assets/image/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('administration/assets/image/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('administration/assets/image/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('administration/assets/image/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('administration/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('administration/assets/script/vendors/config.js') }}"></script>
    <!--    Stylesheets-->
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link href="https://fonts.gstatic.com/" crossorigin="" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('administration/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('administration/assets/css/vendors/iconscout/css/line.css') }}" rel="stylesheet" >
    {{--<link href="{{ asset('administration/assets/css/site/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">--}}
    <link href="{{ asset('administration/assets/css/site/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    {{--<link href="{{ asset('administration/assets/css/site/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">--}}
    <link href=" {{ asset('administration/assets/css/site/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    {{--<script>
        let phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            let linkDefault = document.getElementById('style-default');
            let userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            let linkRTL = document.getElementById('style-rtl');
            let userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>--}}
    <link href="{{ asset('administration/vendors/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('administration/vendors/leaflet/markercluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('administration/vendors/leaflet/markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
    <link href="{{ asset('administration/vendors/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    @stack('head')
</head>
<body>
    <main class="main" id="top">
        <!--    footer-->
        @yield('content')
        <!--    footer-->
        @include('administrator::components.footer')
    </main>

    <!--    JavaScripts-->
    <script src="{{ asset('administration/assets/script/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('administration/assets/script/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/polyfill/polyfill.min58be.js?features=window.scroll') }}"></script>
    <script src="{{ asset('administration/vendors/list/list.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('administration/assets/script/vendors/phoenix.js') }}"></script>
    <script src="{{ asset('administration/vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('administration/vendors/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('administration/vendors/leaflet/markercluster/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('administration/vendors/leaflet/colorfilter/leaflet-tilelayer-colorfilter.min.js') }}"></script>
    <script src="{{ asset('administration/assets/script/vendors/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('administration/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
    @stack('scripts')
</body>
</html>