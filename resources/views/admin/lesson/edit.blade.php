@extends('admin.public.base')

@section('content')
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="/admin/lesson">课程列表</a></li>
        <li><a href="/admin/lesson/create">添加课程</a></li>
        <li class="active"><a href="#">编辑课程</a></li>
    </ul>
    <form action="{{route('lesson.update',$lesson)}}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">课程编辑</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">课程名称</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{$lesson['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">课程介绍</label>
                    <div class="col-sm-10">
                        <textarea name="introduce" class="form-control" rows="5" style="resize: none;">{{$lesson['introduce']}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">缩略图</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="thumb" readonly="" value="{{$lesson['thumb']}}">
                            <div class="input-group-btn">
                                <button onclick="upImagePc(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{$lesson['thumb']}}" class="img-responsive img-thumbnail" width="150">
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
                                    $("[name='thumb']").val(images[0]);
                                    $('.imgnail').show();
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }

                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src', '/img/nopic.jpg');
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否推荐</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="is_commend" value="1" @if($lesson['is_commend']) checked @endif> 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_commend" value="0" @if(!$lesson['is_commend']) checked @endif> 否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否热门</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="is_hot" value="1"  @if($lesson['is_hot']) checked @endif> 是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_hot" value="0"  @if(!$lesson['is_hot']) checked @endif> 否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">点击数</label>
                    <div class="col-sm-10">
                        <input type="text" name="click" class="form-control" value="{{$lesson['click']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">课程标签</label>
                    <div class="col-sm-10">
                        @foreach($tags as $v)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tags[]" value="{{$v['id']}}" @if(in_array($v['id'],$lessonTags)) checked @endif> {{$v['tname']}}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">视频管理</h3>
            </div>
            <div class="panel-body" id="app">
                <div class="panel panel-default" v-for="(v,k) in videos">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">视频标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="请输入视频标题" v-model="v.title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">链接地址</label>
                            <div class="col-sm-10 container">
                                <input type="text" class="form-control" v-model="v.path" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">上传视频</label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-info" :id="'one'+v.btnid">选择文件
                                </button>
                                <button type="button" class="btn btn-success" :id="'two'+v.btnid">开始上传
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">上传状态</label>
                            <div class="col-sm-10">
                                <div class="progress">
                                    <div :class="'progress-bar-striped active progress-bar add'+v.btnid" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group image">--}}
                            {{--<label class="col-sm-2 control-label">视频图片</label>--}}
                            {{--<div class="col-sm-10">--}}
                                {{--<img :src="v.path" alt="" :class="'img-thumbnail image'+v.btnid" style="height: 150px">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-sm-2">
                            <button class="btn btn-danger" @click.prevent="del(k)">删除视频</button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" @click.prevent="add()">添加视频</button>
                <textarea name="videos" hidden cols="30" rows="10">@{{ videos }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">确定修改</button>
            </div>
        </div>
    </form>

    <script>
        new Vue({
            el:'#app',
            data:{
                videos:JSON.parse('{!! $videos !!}')
            },
            methods:{
                add(){
                    var video = {title:'', path:'',btnid:new Date().getTime()};
                    this.videos.push(video);
                    oss(video);
                },
                del(k){
                    this.videos.splice(k, 1);
                }
            }
        })


        function oss(video) {
            require(['oss'], function (oss) {
                var uploader = oss.upload({
                    //容器
                    container: 'container',
                    //文件选择按钮
                    pick: 'one'+video.btnid,
                    //开始上传按钮
                    upButton: 'two'+video.btnid,
                    //获取签名
                    serverUrl: '{{route('oss')}}?',
                    //上传目录
                    dir: 'houdunren/',
                    //local_name本地文件名 random_name随机文件名
                    name_type: 'random_name',
                    //允许上传类型
                    filters: {
                        //文件类型
                        mime_types: [
                            //只允许上传图片和zip,rar文件
                            {title: "Image files", extensions: "jpg,gif,png,bmp,jpeg"},
                            {title: "Zip files", extensions: "zip,rar"},
                            {title: "Video", extensions: "mp4"}
                        ],
                        //最大能上传的文件
                        max_file_size: '1024mb',
                        //不允许选取重复文件
                        prevent_duplicates: true
                    },
                    event: {
                        //选择文件
                        select: function (file) {
                            $('.add'+video.btnid).width('0%').html('0%');
                        },
                        //开始上传
                        start: function (up, file) {
                            console.log('开始上传');
                        },
                        progress: function (up, file) {
                            //上传进度
                            $('.add'+video.btnid).width(file.percent + "%").html('<span>' + file.percent + "%</span>");
                        },
                        success: function (up, file, info) {
                            file.name = "https://hd92.oss-cn-beijing.aliyuncs.com/" + file.name;
                            video.path = file.name;
                            $('.image'+video.btnid).attr('src', file.name);
                            $('.image').show();
                        },
                        error: function (up, file, info) {
                            alert(info.response);
                        }
                    }
                });
            })
        }

    </script>

@endsection












