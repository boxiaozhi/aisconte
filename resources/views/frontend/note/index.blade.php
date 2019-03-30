@extends('frontend.layouts.main')
@section('css')
    <style type="text/css">
        .menu-list a.is-active{
            background-color: #000000;
        }
    </style>
@endsection
@section('content')
<div class="container padding-t-b">
    <div class="columns">
        <div class="column is-one-third">
            <p class="title is-3 has-text-centered">NOTE</p>
            <aside class="menu">
                <ul class="menu-list">
                    @if($shareList)
                        @foreach($shareList as $share)
                            <li>
                                <a href="{{ route('note.index', ['docGuid' => $share['documentGuid']]) }}"
                                   class="@if((!request('docGuid') && $loop->first) || (request('docGuid') == $share['documentGuid'])) is-active @endif"
                                   title="{{ $share['title'] }}"
                                   data-doc-guid="{{ $share['documentGuid'] }}">
                                    {{ $share['title'] }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </aside>
        </div>
        <div class="column">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="n-content word-break">
                        @if($noteDetail)
                            {!! $noteDetail['html'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/frontend/note.js') }}"></script>
@endsection