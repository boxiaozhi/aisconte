@extends('frontend.layouts.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.bootcss.com/bulma/0.7.4/css/bulma.min.css" />
    <style type="text/css">
        .padding-t-1{
            padding-top: 1rem !important;
        }
        .box{
            border-radius: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @include('frontend.layouts._header')
        <div class="tile is-12 padding-t-1">
            <div class="tile is-child box">
                @include('frontend.components.nav')
            </div>
        </div>
        <div class="tile is-ancestor padding-t-1">
            <div class="tile is-4 is-vertical is-parent">
                <div class="tile is-child box">
                    <p class="title">{{ $title }}</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>
                <div class="tile is-child box">
                    <p class="title">Two</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <p class="title">Three</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut. Morbi maximus, leo sit amet vehicula eleifend, nunc dui porta orci, quis semper odio felis ut quam.</p>
                    <p>Suspendisse varius ligula in molestie lacinia. Maecenas varius eget ligula a sagittis. Pellentesque interdum, nisl nec interdum maximus, augue diam porttitor lorem, et sollicitudin felis neque sit amet erat. Maecenas imperdiet felis nisi, fringilla luctus felis hendrerit sit amet. Aenean vitae gravida diam, finibus dignissim turpis. Sed eget varius ligula, at volutpat tortor.</p>
                    <p>Integer sollicitudin, tortor a mattis commodo, velit urna rhoncus erat, vitae congue lectus dolor consequat libero. Donec leo ligula, maximus et pellentesque sed, gravida a metus. Cras ullamcorper a nunc ac porta. Aliquam ut aliquet lacus, quis faucibus libero. Quisque non semper leo.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/frontend/main.js') }}"></script>
    <script src="{{ asset('js/frontend/home_'.$version.'.js') }}"></script>
@endsection