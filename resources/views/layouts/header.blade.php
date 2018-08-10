<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'IsConte')</title>
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">

    <link href="{{ asset('packages/bootstrap/dist/css/bootstrap-grid.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">

    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script href="{{ asset('packages/bootstrap/dist/js/bootstrap.js') }}"></script>
    @yield('css')
</head>