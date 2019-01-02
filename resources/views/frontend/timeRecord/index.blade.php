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
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="tile is-ancestor">
                <div class="tile is-vertical is-8">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child box">
                                <p class="title">{{ $info['over']['children'][0]['text'] }}</p>
                                <p class="subtitle">{{ $info['over']['children'][0]['children'][0]['text'] }}</p>
                                <input type="hidden" id="over-">
                            </article>
                            <article class="tile is-child box">
                                <p class="title">{{ $info['future']['children'][0]['text'] }}</p>
                                <p class="subtitle" id="future-0"></p>
                                <input type="hidden" id="future-value-0" value="{{ $info['future']['children'][0]['children'][0]['text'] }}">
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
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/timeRecord.js') }}"></script>
    <script>
        $(function () {
            //递归每秒调用countTime方法，显示动态时间效果
            setInterval("countTime('future-0', '"+$('#future-value-0').val()+"')", 1000);
        });
    </script>
@endsection