@extends('admin.public.base')

@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{route('tag.index')}}">标签列表</a></li>
        <li><a href="{{route('tag.create')}}">添加标签</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">标签列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>标签名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['tname']}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="{{route('tag.edit',$v)}}" class="btn btn-default">编辑</a>
                                <form action="{{route('tag.destroy',$v)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default">删除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{$tags->links()}}
@endsection
