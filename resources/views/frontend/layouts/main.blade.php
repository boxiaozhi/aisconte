<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('frontend.layouts.header')
<body>
    @yield('content')
    @include('frontend.layouts.script')
    @if(!in_array($viewName, ['frontend.home.index', 'frontend.note.index']))
        @include('frontend.layouts.footer')
    @endif
</body>
F