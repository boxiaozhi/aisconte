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
                                    <a href="{{ route('admin.navi.create') }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-save"></i>&nbsp;&nbsp;New
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            ID<a class="fa fa-fw fa-sort-amount-asc" href="http://laravel-admin.org/demo/auth/permissions?_pjax=%23pjax-container&amp;_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc"></a>
                                        </th>
                                        <th>Name</th>
                                        <th>Labels</th>
                                        <th>Url</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($lists as $list)
                                    <tr>
                                        <td>{{ $list['id'] }}</td>
                                        <td>{{ $list['name'] }}</td>
                                        <td>
                                            @if($list['label'])
                                                @php
                                                    $labels = \App\Services\NaviLabelService::getLabelInfoById($list['label'])
                                                @endphp
                                                @if($labels)
                                                    @foreach($labels as $label)
                                                        <span class="label label-success">{{ $label['name'] }}</span>
                                                    @endforeach
                                                @endif
                                            @else
                                                -
                                            @endif</td>
                                        <td>{{ $list['url'] }}</td>
                                        <td>{{ $list['created_at'] }}</td>
                                        <td>{{ $list['updated_at'] }}</td>
                                        <td>
                                            <a href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('admin.navi.edit', ['id' => $list['id']])}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="info_delete({{ $list['id'] }})">
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
    <script src="{{ asset('js/admin/navi_info.js') }}"></script>
@endsection