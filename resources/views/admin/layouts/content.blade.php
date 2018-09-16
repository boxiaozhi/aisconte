<body class="hold-transition skin-black-light sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts._header')
        @include('admin.layouts._sidebar')

        @yield('content')

        @include('admin.layouts._footer')
        @include('admin.layouts._aside')
    </div>
    @include('admin.layouts.script')
</body>