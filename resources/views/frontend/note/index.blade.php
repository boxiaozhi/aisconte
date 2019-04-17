@extends('frontend.layouts.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.bootcss.com/bulma/0.7.4/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/5.8.1/css/all.min.css">
    <style type="text/css">
        ::-webkit-scrollbar {
            display:none
        }
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
        .fix {
            position: fixed;
            top: 0;
            bottom: 0;
        }
        #menu {
            width: 20rem;
            border-right: 1px var(--border-type) var(--border);
            padding: 1rem 0;
            background: #ffffff;
            transition: 0.2s;
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
            overflow: scroll;
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
        .mask-menu {
            padding: 0 1rem;
            width: 100%;
            height: 1rem;
            position:absolute;
            bottom: 0;
        }
        .logo {
            font-weight: bold;
            color: var(--bg);
            float: left;
            display: inline-block;
        }
        .btn-trigger {
            font-weight: bold;
            color: var(--bg);
            float: right;
            display: inline-block;
        }
        @media (max-width: 960px) {
            #menu {
                width: calc(100% - 2rem);
                display: none;
                z-index: 999;
                margin: 2rem 0 0 0;
                background-color: var(--main);
                border-right: none;
            }
            #content {
                margin-left: 0;
                padding: 1rem 1rem 0;
            }
            .mt {
                top: -19rem !important;
            }
            .mask-menu {
                display: block;
            }
            .menu-list a{
                background: var(--main);
                border-bottom: 1px var(--border-type) var(--bg);
            }
            .menu-list a.is-active{
                background-color: var(--main);
                color: var(--bg);
            }
        }
        @media (min-width: 961px) {
            #menu {
                display: block !important;
                z-index: 1;
                margin: 0;
                background: var(--bg);
            }
            #content {
                margin-left: 20rem;
                padding: 0 1rem;
            }
            .mt {
                top: -20rem !important;
            }
            .mask-menu {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    <div class="mask mt">
        <div class="mask-menu">
            <div class="logo">Note</div>
            <div class="btn-trigger" id="tigger"><i class="fas fa-bars"></i></div>
        </div>
    </div>
    <div class="mask mb"></div>
    <div class="mask mv ml"></div>
    <div class="mask mv mr"></div>
    <div class="mask mv mrt"></div>
    <div class="mask mv mlt"></div>

    <div class="padding-t-b">
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