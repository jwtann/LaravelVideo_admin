@extends('admin.public.base')

@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{route('lesson.index')}}">课程列表</a></li>
        <li><a href="{{route('lesson.create')}}">添加课程</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">内容课程列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>课程标题</th>
                    <th>课程图片</th>
                    <th>视频数量</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td><img src="{{$v['thumb']}}" style="height: 80px;"></td>
                        <td>{{count($v->videos)}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('lesson.edit',$v)}}" class="btn btn-primary">编辑</a>
                                <form action="{{route('lesson.destroy',$v)}}" method="post" role="form">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-danger" onclick="del()">删除</a>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$lessons->links()}}
        </div>
    </div>


    <script>
        function del() {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定删除该课程吗?', function () {
                    $('form').submit();
                })
            })
        }
    </script>
@endsection