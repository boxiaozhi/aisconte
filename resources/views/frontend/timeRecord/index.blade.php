@extends('layouts.main')
@section('css')
    <style type="text/css">
    </style>
@endsection
@section('content')
    {{--<div class="container">--}}
        {{--<div class="nickname text-center">--}}
            {{--<a href="/">--}}
                {{--<b>{{ $info['over']['children'][0]['text'] }}</b>--}}
                {{--<b>{{ $info['over']['children'][0]['children'][0]['text'] }}</b>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    <section class="section">
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child box">
                            <p class="title">{{ $info['over']['children'][0]['text'] }}</p>
                            <p class="subtitle">{{ $info['over']['children'][0]['children'][0]['text'] }}</p>
                        </article>
                        <article class="tile is-child box">
                            <!-- Put any content you want -->
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <!-- Put any content you want -->
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <!-- Put any content you want -->
                    </article>
                </div>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <!-- Put any content you want -->
                </article>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/main.js') }}"></script>
@endsection