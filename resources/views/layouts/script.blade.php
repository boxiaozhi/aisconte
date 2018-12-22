<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<script src="{{ asset('packages/adminlte/bower_components/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('packages/adminlte/bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('packages/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('packages/adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('packages/adminlte/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('js/public.js') }}"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?57b9ef85fb5c8dc96b8d3e0cdd746545";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
@yield('script')