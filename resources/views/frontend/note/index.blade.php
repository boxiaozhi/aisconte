@extends('layouts.main')
@section('css')
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
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
    </style>
@endsection
@section('content')
<div class="container">
    <div class="c-title row justify-content-center align-middle">
        CWIZ NOTE
    </div>
    <div class="row justify-content-center">
        <div class="c-side-bar col-md-3 list-group list-group-flush">
            @if($shareList)
                @foreach($shareList as $share)
                <a href="{{ route('note.index', ['docGuid' => $share['documentGuid']]) }}"
                   class="text-truncate list-group-item list-group-item-action @if((!request('docGuid') && $loop->first) || (request('docGuid') == $share['documentGuid'])) active @endif"
                   title="{{ $share['title'] }}"
                   data-doc-guid="{{ $share['documentGuid'] }}">
                    {{ $share['title'] }}
                </a>
                @endforeach
            @endif
        </div>
        <div class="col-md-9">
            <div class="n-content word-break">
                @if($noteDetail)
                    {!! $noteDetail['html'] !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/note/note.js') }}"></script>
@endsection