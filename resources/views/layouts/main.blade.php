<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.header')
<body>
    @yield('content')
    @include('layouts.script')
</body>
</html>