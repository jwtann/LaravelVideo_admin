@extends('admin.public.base')
@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{route('user.index')}}">用户列表</a></li>
        <li><a href="{{route('user.create')}}">添加用户</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">用户列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['username']}}</td>
                        <td>{{$v['email']}}</td>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="{{route('user.edit',$v)}}" class="btn btn-default">编辑</a>
                                @can('delete',$v)
                                    <form action="{{route('user.destroy',$v)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default">删除</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection