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
            LOGIN
        </div>
        <div class="row justify-content-center">
            <form id="login-form">
                <div class="form-group">
                    <label>用户名</label>
                    <input type="email" class="form-control" id="username" placeholder="Username">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="button" class="btn btn-primary" onclick="login()">确定</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/auth.js') }}"></script>
@endsection