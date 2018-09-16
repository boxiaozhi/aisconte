@extends('admin.layouts.main')

@section('css')
@endsection

@section('content')
        <div class="content-wrapper">
            @include('admin.layouts._content_header')

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">System Info</h3>
                                @include('admin.layouts._box_tools')
                            </div>
                            <div class="box-body">
                                @foreach($systemInfo as $sysItem)
                                    <strong>{{ $sysItem['name'] }}</strong>
                                    <p class="text-muted">{{ $sysItem['value'] }}</p>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection

@section('script')
    <script src="{{ asset('packages/adminlte/dist/js/demo.js') }}"></script>
@endsection