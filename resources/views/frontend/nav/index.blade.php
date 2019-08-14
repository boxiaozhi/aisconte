@extends('frontend.layouts.main')
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
            NAV
        </div>
        <div class="row justify-content-center">
            @foreach($list as $item)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $item->name }}</h3>

                            <p>
                                @if($item->label)
                                    @foreach($item->label as $label)
                                        <span class="label label-success">{{ $label }}</span>
                                    @endforeach
                                @endif
                            </p>
                        </div>

                        <a href="{{ $item->url }}" class="small-box-footer" target="_blank">
                            Go <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/nav.js') }}"></script>
@endsection