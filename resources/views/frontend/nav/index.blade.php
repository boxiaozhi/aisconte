@extends('frontend.layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bulma/0.7.4/css/bulma.min.css" />
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
            @foreach($list as $item)
                <div class="columns">
                    <!-- small box -->
                    <div class="column is-full">
                        <div class="card">
                            <div class="card-header">
                                <p class="card-header-title">{{ $item->name }}</p>
                            </div>

                            <div class="card-content">
                                @if($item->label)
                                    @foreach($item->label as $label)
                                        <span class="tag is-black">{{ $label }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <footer class="card-footer">
                                <a href="{{ $item->url }}" class="card-footer-item" target="_blank">
                                    Go <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </footer>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/nav.js') }}"></script>
@endsection
