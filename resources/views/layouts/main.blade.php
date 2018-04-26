<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.header')
<body>
<div>
    @include('layouts._header')
    <div>
        @yield('content')
    </div>
    @include('layouts._footer')
</div>
@include('layouts.script')
</body>
</html>