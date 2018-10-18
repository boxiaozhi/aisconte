<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'IsConte')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://cdn.bootcss.com/limonte-sweetalert2/7.21.1/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/dist/css/alt/AdminLTE-select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/adminlte/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    @yield('css')
</head>