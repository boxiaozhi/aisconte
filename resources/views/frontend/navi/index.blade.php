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
            C-NAVI
        </div>
        <div class="row justify-content-center">
            @foreach($naviList as $naviInfo)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $naviInfo->name }}</h3>

                            <p>
                                @if($naviInfo->label)
                                    @php
                                        $labels = \App\Services\NaviLabelService::getLabelInfoById($naviInfo->label)
                                    @endphp
                                    @if($labels)
                                        @foreach($labels as $label)
                                            <span class="label label-success">{{ $label['name'] }}</span>
                                        @endforeach
                                    @endif
                                @endif
                            </p>
                        </div>

                        <a href="{{ $naviInfo->url }}" class="small-box-footer" target="_blank">
                            Go <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/frontend/navi.js') }}"></script>
@endsection