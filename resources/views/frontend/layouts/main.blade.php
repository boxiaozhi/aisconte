<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('frontend.layouts.header')
<body>
    @yield('content')
    @yield('footer')
    @include('frontend.layouts.script')
</body>