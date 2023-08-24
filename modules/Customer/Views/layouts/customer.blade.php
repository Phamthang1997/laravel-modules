<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Laravel Modules' }}</title>
    <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
    @stack('head')
</head>
<body>
    @yield('content')

    <script src="{{asset('asset/script/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset/script/popper.min.js')}}"></script>
    <script src="{{asset('asset/script/bootstrap.min.js')}}"></script>

    @stack('scripts')
</body>
</html>