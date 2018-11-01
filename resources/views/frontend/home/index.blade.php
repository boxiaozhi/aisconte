@extends('layouts.main')
@section('css')
    <style type="text/css">
        body{
            background-color: rgb(102, 143, 137);
        }
        .container{
            padding: 10% 0;
        }
        .nickname{
            font-size: 35px;
            font-weight: 700;
        }
        .slogan{
            padding: 5px;
            font-weight: 700;
        }
        .contact{
            margin-bottom: 10px;
        }
        .contact-body>a+a:before{
            padding: 0 5px;
            color: #ccc;
            content: "/\00a0";
        }
        .link-body,.contact-body{
            padding: 8px 15px;
            background-color: rgba(255,255,255,.15);
        }
        .link-body>a:hover{
            color: #000000;
        }
        a {
            color: white;
        }
        a:hover{
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="nickname text-center">
            <a href="/">
                <b>{{ $info['Nickname']['children'][0]['text'] }}</b>
            </a>
        </div>
        <div class="slogan text-center">
            @php
                $index = rand(0,2);
                $slogan = $info['Slogan']['children'][$index]['text'];
            @endphp
            <p class="">{{ $slogan }}</p>
        </div>
        <div class="contact text-center">
            <div class="contact-body">
                @foreach($info['Contact']['children'] as $item)
                    @php
                        $url = getUrl($item['note']);
                    @endphp
                    @if($url)
                        <a class="margin-r-5" href="{{ $url }}" target="_blank" title="{{ $url }}">{{ $item['text'] }}</a>
                    @else
                        <a class="margin-r-5" title="{{ $item['note'] }}">{{ $item['text'] }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="link text-center">
            <div class="link-body">
                @foreach($info['SiteLink']['children'] as $item)
                    @php
                        $url = getUrl($item['note']);
                    @endphp
                    @if($url)
                        <a class="margin-r-5" href="{{ $url }}" target="_blank" title="{{ $url }}">{{ $item['text'] }}</a>
                    @else
                        <a class="margin-r-5" title="{{ $item['note'] }}">{{ $item['text'] }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/main.js') }}"></script>
@endsection