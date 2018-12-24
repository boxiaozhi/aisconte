@extends('layouts.main')
@section('css')
    <style type="text/css">
        .hero-footer{
            padding: 1rem;
        }
    </style>
@endsection
@section('content')
    <section class="hero is-dark is-fullheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <a href="/">
                        <b>{{ $info['Nickname']['children'][0]['text'] }}</b>
                    </a>
                </h1>
                <h2 class="subtitle">
                    @php
                        $index = rand(0,2);
                        $slogan = $info['Slogan']['children'][$index]['text'];
                    @endphp
                    <p class="">{{ $slogan }}</p>
                </h2>
                <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                    <ul>
                        @foreach($info['Contact']['children'] as $item)
                            <li>
                            @php
                                    $url = getUrl($item['note']);
                                @endphp
                                @if($url)
                                        <a href="{{ $url }}" target="_self" title="{{ $url }}">{{ $item['text'] }}</a>

                                @else
                                        <a title="{{ $item['note'] }}">{{ $item['text'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                    <ul>
                        @foreach($info['SiteLink']['children'] as $item)
                            <li>
                            @php
                                $url = getUrl($item['note']);
                            @endphp
                            @if($url)
                                <a href="{{ $url }}" target="_self" title="{{ $url }}">{{ $item['text'] }}</a>
                            @else
                                <a title="{{ $item['note'] }}">{{ $item['text'] }}</a>
                            @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <div class="hero-footer">
            <nav class="breadcrumb is-small is-centered" aria-label="breadcrumbs">
                <ul>
                    <li><a>© {{ date('Y') }}</a></li>
                    <li><a href="https://github.com/boxiaozhi/isconte"><b>isconte</b></a></li>
                    <li><a href="https://github.com/laravel/laravel/">Powered by<strong>&nbsp;Laravel</strong></a></li>
                    <li><a>粤ICP备17015159号</a></li>
                </ul>
            </nav>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/main.js') }}"></script>
@endsection