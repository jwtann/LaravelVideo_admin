@extends('admin.public.base')

@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{route('slider.index')}}">轮播图列表</a></li>
        <li><a href="{{route('slider.create')}}">添加轮播图</a></li>
        <li class="active"><a href="{{route('slider.create')}}">编辑轮播图</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">编辑轮播图</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('slider.update',$slider)}}" method="post" class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="col-sm-2 control-label">图片:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="slider" value="{{$slider['slider']}}" readonly="readonly">
                            <div class="input-group-btn">
                                <button onclick="upImagePc(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{$slider['slider']}}" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                    <script>
                        require(['hdjs']);
                        //上传图片
                        function upImagePc() {
                            require(['hdjs'], function (hdjs) {
                                var options = {
                                    multiple: false,//是否允许多图上传
                                    //data是向后台服务器提交的POST数据
                                    data: {name: '后盾人', year: 2099},
                                };
                                hdjs.image(function (images) {
                                    //上传成功的图片，数组类型
                                    $("[name='slider']").val(images[0]);
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }

                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src', '/images/nopic.jpg');
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">跳转地址:</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" class="form-control" value="{{$slider['url']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否显示:</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="is_show" value="1" @if($slider['is_show'])checked @endif> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_show" value="0" @if($slider['is_show'] == 0)checked @endif> 隐藏
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">编辑</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
