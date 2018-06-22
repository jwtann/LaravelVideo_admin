@extends('admin.public.base')

@section('content')
    {{--@include('admin.public.message')--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @foreach ($errors->all() as $error)
            <strong>{{$error}}</strong>
            @endforeach
        </div>
    @endif
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{route('user.index')}}">用户列表</a></li>
        <li class="active"><a href="{{route('user.create')}}">添加用户</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加管理员</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('user.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" placeholder="请输入用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">电子邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" placeholder="请输入邮箱地址">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-10">
                    <input type="text" name="password" class="form-control" placeholder="请输入密码">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">确认密码:</label>
                    <div class="col-sm-10">
                    <input type="text" name="password_confirmation" class="form-control" placeholder="请确认密码">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">立即添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection