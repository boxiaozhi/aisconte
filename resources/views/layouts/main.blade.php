<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?57b9ef85fb5c8dc96b8d3e0cdd746545";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
@include('layouts.header')
<body>
    <div class="content">
        @yield('content')
        @include('layouts.script')
    </div>
    @include('layouts.footer')
</body>
</html>