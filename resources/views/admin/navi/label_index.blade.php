@extends('admin.layouts.main')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.layouts._content_header')

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="pull-right">
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="{{ route('admin.naviLabel.create') }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-save"></i>&nbsp;&nbsp;{{ __('admin.new') }}
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.created_at') }}</th>
                                    <th>{{ __('admin.updated_at') }}</th>
                                    <th>{{ __('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($lists as $list)
                                        <tr>
                                            <td>{{ $list['id'] }}</td>
                                            <td>{{ $list['name'] }}</td>
                                            <td>{{ $list['created_at'] }}</td>
                                            <td>{{ $list['updated_at'] }}</td>
                                            <td>
                                                {{--<a href="#">--}}
                                                    {{--<i class="fa fa-eye"></i>--}}
                                                {{--</a>--}}
                                                <a href="{{route('admin.naviLabel.edit', ['id' => $list['id']])}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="label_delete({{ $list['id'] }})">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/navi_label.js') }}"></script>
@endsection