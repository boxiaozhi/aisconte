<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.header')
<body>
    @yield('content')
    @include('layouts.script')
    @if(!in_array($viewName, ['frontend.home.index']))
        @include('layouts.footer')
    @endif
</body>
</html>