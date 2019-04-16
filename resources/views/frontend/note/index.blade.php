@extends('frontend.layouts.main')
@section('css')
    <style type="text/css">
        body {
            --main: #f60c3e;
            --text: #333;
            --text2: #444;
            --darker: #000;
            --btn-bg: #333;
            --btn-text: #fff;
            --bg: #fff;
            --bg2: #efefef;
            --border: #ddd;
            --border2: #888;
            --border-type: dotted;
            --member: #e7b836;

            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: 'Anyway Type','Myriad Pro','PingFang SC','Microsoft YaHei',sans-serif;
            text-align: left;
            color: var(--text);
            line-height: 1;
            background: var(--bg);
            padding: 1rem;
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
            #menu {
                display: none !important;
            }
            #content {
                margin-left: 0;
            }
        }
        @media (min-width: 961px) {
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
            border-right: 1px var(--border-type) var(--border);
            padding: 1rem 0;
            background: #ffffff;
        }
        .menu-list a{
            background-color: var(--bg);
            border-bottom: 1px var(--border-type) var(--border);
        }
        .menu-list a:hover{
            color: var(--main);
        }
        .menu-list a.is-active{
            background-color: var(--bg);
            color: var(--text);
            font-weight: 700;
        }
        #content {
            padding: 0 1rem;
            overflow: hidden;
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
            height: 21rem;
            width: 100%;
            left: 0;
        }
        .mb {
            bottom: -20rem;
            height: 21rem;
            width: 100%;
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
        #menu-aside {
            padding: 1rem 0 0 0;
            height: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="mask mt">
        <span>Note</span>
        <span>≡</span>
    </div>
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