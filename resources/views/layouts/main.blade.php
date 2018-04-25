<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.header')
<body>
<div>
    @include('layouts._header')
    <div>
        @include('layouts._sidebar')
        @yield('content')
    </div>
    @include('layouts._footer')
</div>
@include('layouts.script')
</body>
</html>