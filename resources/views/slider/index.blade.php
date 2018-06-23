@extends('admin.public.base')
@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{route('slider.index')}}">轮播图列表</a></li>
        <li><a href="{{route('slider.create')}}">添加轮播图</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">轮播图列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>图片</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sliders as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>
                            <img src="{{$v['slider']}}" style="height: 80px;">
                        </td>
                        <td>
                            @if($v['is_show'])
                                显示
                            @else
                                隐藏
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="{{route('slider.edit',$v)}}" class="btn btn-default">编辑</a>
                                <form action="{{route('slider.destroy',$v)}}" method="post">
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
    {{$sliders->links()}}
@endsection