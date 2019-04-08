@extends('frontend.layouts.main')
@section('css')
    <style type="text/css">
        body {
            --main: #000000;
            padding: 1rem;
        }
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
                margin-left: 0;
            }
        }
        @media (min-width: 961px) {
            #m-menu {
                display: none;
            }
            #menu {
                display: block;
            }
            #content {
                margin-left: 20rem;
            }
        }
        .fix {
            position: fixed;
            top: 0;
            bottom: 0;
        }
        #menu {
            width: 20rem !important;
            border-right: 1rem solid #0a0a0a;
            padding: 1rem 0;
            background: #ffffff;
        }
        #content {
            padding: 0 1rem;
        }
        .menu-list a{
            border-radius: 0px;
        }
        .mask {
            position: fixed;
            z-index: 999;
            border: .4rem solid var(--main);
            background: var(--main);
        }
        .mt {
            top: -20rem;
            height: 22rem;
            width: 100vw;
            left: 0;
        }
        .mb {
            bottom: -20rem;
            height: 21rem;
            width: 100vw;
            left: 0;
        }
        .mv {
            bottom: 0;
            height: 80vh;
            width: 21rem;
        }
        .ml, .mlt {
            left: -20rem;
        }
        .mr, .mrt {
            right: -20rem;
        }
        .ml, .mr {
            width: 21rem;
        }
        .mrt, .mlt {
            top: 0;
        }
        .menu-title {
            background: #ffffff;
            padding: 2rem;
            margin: 1rem 0 0 0;
            border-bottom: 0.1rem solid #000000;
        }
        .menu-footer {
            background: #ffffff;
            padding: 2rem;
            position: fixed;
            width: 19rem;
            bottom: 0;
            margin: 0 0 1rem 0;
            border-top: 0.1rem solid #000000;
        }
        #menu-aside {
            height: calc(100% - 9.2rem) !important;
        }
    </style>
@endsection
@section('content')
    <div class="mask mt"></div>
    <div class="mask mb"></div>
    <div class="mask mv ml"></div>
    <div class="mask mv mr"></div>
    <div class="mask mv mrt"></div>
    <div class="mask mv mlt"></div>
<div class="padding-t-b">
    <div class="overlay" id="m-menu" style="display: none;">
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
    <div class="">
        <div class="fix" id="menu">
            <div class="menu-title has-text-centered">
            </div>
            <aside class="menu" id="menu-aside">
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
            <div class="menu-footer">
            </div>
        </div>
        <div class="" id="content">
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