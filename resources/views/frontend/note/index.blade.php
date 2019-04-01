@extends('frontend.layouts.main')
@section('css')
    <style type="text/css">
        .menu-list a.is-active{
            background-color: #000000;
        }
        .overlay {
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0,0,0,.8);
        }
        @media (max-width: 960px) {
            #m-menu {
                display: block !important;
            }
            #menu {
                display: none !important;
            }
            #content {
                margin: 0 !important;
            }
        }
        @media (min-width: 961px) {
            #m-menu {
                display: none !important;
            }
            #menu {
                display: block !important;
            }
            #content {
                margin-left: 370px !important;
            }
        }
        .fix {
            position: fixed;
            width: auto !important;
            height: 100vh;
            top: 0;
            bottom: 0;
        }
        #menu {
            width: 340px !important;
        }
    </style>
@endsection
@section('content')
<div class="container padding-t-b">
    <div class="columns overlay" id="m-menu" style="display: none;">
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
    </div>
    <div class="columns">
        <div class="column fix" id="menu">
            <p class="title has-text-centered">NOTE</p>
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
        <div class="column" id="content">
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