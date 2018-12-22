@extends('layouts.main')
@section('css')
    <style type="text/css">
        body{
            background-color: rgb(255, 255, 255);
        }
        .container{
            padding: 10% 0;
        }
        .nickname{
            font-size: 35px;
            font-weight: 700;
        }
        .nickname>a:hover{
            color: black;
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
            color: #000000;
            content: "/\00a0";
        }
        .link-body,.contact-body{
            padding: 8px 15px;
            background-color: rgba(33, 33, 33, 0.15);
        }
        .link-body>a:hover{
            color: #ffffff;
        }
        a {
            color: #000000;
        }
        a:hover{
            color: #ffffff;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="nickname text-center">
            <a href="/">
                <b>{{ $info['over']['children'][0]['text'] }}</b>
                <b>{{ $info['over']['children'][0]['children'][0]['text'] }}</b>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/main.js') }}"></script>
@endsection