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
                            <h3 class="box-title">Add</h3>
                        </div>
                        <form class="form-horizontal" id="add-form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">名称</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="名称" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputUrl" class="col-sm-2 control-label">Url</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUrl" placeholder="Url" name="url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputLabel" class="col-sm-2 control-label">标签</label>

                                    <div class="col-sm-10">
                                        <select class="col-sm-12" name="label" multiple>
                                            @foreach($labels as $label)
                                                <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer col-sm-12">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-info" onclick="info_create()">添加</button>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/navi_info.js') }}"></script>
@endsection