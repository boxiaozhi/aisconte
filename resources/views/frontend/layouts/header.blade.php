<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bulma/0.7.4/css/bulma.min.css" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    @yield('css')

    @include('frontend.layouts._statistics')
    @include('frontend.layouts._script')
</head>