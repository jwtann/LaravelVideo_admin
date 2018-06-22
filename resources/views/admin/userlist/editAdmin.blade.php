@extends('admin.public.base')

@section('content')
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
        <li><a href="{{route('user.create')}}">添加用户</a></li>
        <li class="active"><a href="#">编辑用户</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">编辑管理员</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('user.update',$user)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" placeholder="请输入用户名" value="{{$user['username']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">电子邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" placeholder="请输入邮箱地址" value="{{$user['email']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection