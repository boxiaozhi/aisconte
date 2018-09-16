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
                            <h3 class="box-title">Edit</h3>
                        </div>
                        <form class="form-horizontal" id="edit-form">
                            <input type="hidden" name="id" value="{{ $info['id'] }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">名称</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ $info['name'] }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer col-sm-12">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-default margin-r-5">返回</button>
                                    <button type="button" class="btn btn-info" onclick="label_edit()">确认</button>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal modal-primary fade" id="modal-primary">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Primary Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/navi_label.js') }}"></script>
@endsection