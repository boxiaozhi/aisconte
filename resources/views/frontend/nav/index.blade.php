@extends('frontend.layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bulma/0.7.5/css/bulma.min.css" />
    <style type="text/css">
        .n-content{
            word-break: break-all !important;
        }
        .n-content > div{
            word-break: break-all !important;
        }
        .c-title{
            font-size: 3rem;
            border-bottom: 1px solid;
            margin-bottom: 1rem;
        }
        .list-group-item.active{
            background-color: #ccc !important;
            border-color: #ffffff;
        }
        .column{
            border-right: 1px solid #E9E9E9;
        }
        .no-right-border{
            border-right: none;
        }
        .main{
            margin-top: 5rem;
        }
    </style>
@endsection
@section('content')
    @include('frontend.layouts._header')
    <div class="container main">
        <div class="columns is-multiline is-mobile">
         @foreach($list as $item)
            <div class="column is-one-quarter @if($loop->iteration%4==0) no-right-border @endif">
                  <a href="{{ $item->url }}" class="card-footer-item" target="_blank">{{ $item->name }}</a>
            </div>
         @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/nav.js') }}"></script>
@endsection
