<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108159539-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-108159539-1');
</script>
<!-- baidu -->
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