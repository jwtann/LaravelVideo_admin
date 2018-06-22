@extends('admin.public.base')

@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{route('tag.index')}}">标签列表</a></li>
        <li class="active"><a href="{{route('tag.create')}}">添加标签</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加标签</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('tag.store')}}" method="post" class="form-horizontal" role="form">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">标签名称:</label>
                    <div class="col-sm-10">
                        <input type="text" name="tname" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
