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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">修改资料</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('password')}}" method="post" class="form-horizontal" role="form">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">昵称:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->username}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">原密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="oldpassword" class="form-control" placeholder="请输入原密码..." value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="请输入新密码..." value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">确认密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="请输入确认密码..." value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">确定</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
