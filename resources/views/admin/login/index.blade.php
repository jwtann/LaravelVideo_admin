<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>后盾人 - houdunren.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script>
        window.hdjs = {};
        //组件目录必须绝对路径(在网站根目录时不用设置)
        window.hdjs.base = '/node_modules/hdjs';
        //上传文件后台地址(配置上传图片路由,找到对应控制器的方法,由于图片上传不是后台单独使用,可能前台也会使用,所以我将上传图片的路由写在web.php里面)
        window.hdjs.uploader = '/shangchuanImg';
        //获取文件列表的后台地址,留下问号
        window.hdjs.filesLists = '/fileLists?';
    </script>
    <script src="/node_modules/hdjs/static/requirejs/require.js"></script>
    <script src="/node_modules/hdjs/static/requirejs/config.js"></script>

    <link href="/css/hdcms.css" rel="stylesheet">

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body class="site">
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li class="top_menu active">
                        <a href="">
                            <i class="'fa-w fa fa-comments-o"></i> 网站主页 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://houdunwang.com" target="_blank">
                            <i class="'fa-w fa fa-cubes"></i> 实战培训 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://houdunren.com">
                            <i class="'fa-w fa fa-cubes"></i> 在线视频 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://bbs.houdunwang.com">
                            <i class="'fa-w fa fa-cubes"></i> 论坛讨论 </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(Auth::user())
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="/admin/changePassword" class="dropdown-toggle">
                                <i class="fa fa-w fa-user"></i>
                                {{Auth::user()->username}}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="/admin/logout" class="dropdown-toggle">
                                <i class="fa fa-w fa-sign-out"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <!--导航end-->
</div>
<!--主体-->
<div class="container-fluid admin_menu">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">后台登录</h3>
        </div>
        @include('admin.public.message')
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal" role="form">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">邮箱:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="" placeholder="请输入登录的邮箱地址...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" value="" placeholder="请输入登录密码...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">验证码:</label>
                    <div class="col-sm-2">
                        <input type="text" name="code" class="form-control" value="" placeholder="请输入验证码...">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <img src="/admin/code" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<style>
    .pagination {
        margin: 0px;
        float: right;
    }
</style>