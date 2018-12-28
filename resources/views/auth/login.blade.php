<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! constants('APP_NAME') !!}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/a/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/a/font-awesome.min.css">
    <!--必要样式-->
    <link href="jl/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="jl/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="jl/css/loaders.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="/a/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/a/AdminLTE.min.css">
    <link rel="stylesheet" href="/a/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="/a/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/a/html5shiv.min.js"></script>
    <script src="/a/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-page, .register-page {
             background: none!important;
        }
    </style>
</head>
<body class="hold-transition login-page" style="background-color:#000!important;opacity: 0.5;">
<div class="login-box login" style="padding-top:5px;width:33%;">
<div class='login_title'>
<center><a style="color:white;" href="{{ url('/home') }}"><b>{!! constants('APP_NAME') !!}</b></a></center>
    <!-- <span>管理员登录</span> -->
</div>
<form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            <div class="has-feedback {{ $errors->has('username') ? ' has-error' : '' }} login_fields" style="width:100%;">
                <div class='login_fields__user' style="padding-left: 19px;">
                    <div class='icon' style="background-color:#000;border-radius: 30%;">
                        <img alt="" src='jl/img/user_icon_copy.png'>
                    </div>
                <!--name-->
                    <input type="text" class="form-group form-control" style="width:95%;padding-left: 41px;background-color: white;"  name="username" value="{{ old('username') }}" autocomplete="off"  placeholder="用户名">
                    <!-- autocomplete="off" 禁止记录 -->
                    <!-- <div class='validation'>
                        <img alt="" src='jl/img/tick.png'>
                    </div> -->
                <!-- </div> -->
                <!-- <span class="form-control-feedback glyphicon glyphicon-user "></span> -->
                @if ($errors->has('username'))
                <div class='validation'>
                    <img alt="" src='jl/img/tick.png'>
                </div>
                <center>
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                </center>
                @endif
                </div>
                <!--end name-->
                <!-- <input name="login" placeholder='用户名' maxlength="16" type='text' autocomplete="off" value="kbcxy"/>
                    <div class='validation'>
                    <img alt="" src='img/tick.png'>
                    </div>
                </div> -->
                <br>
                 <div class="has-feedback{{ $errors->has('password') ? ' has-error' : '' }} login_fields__password" style="padding-left: 19px;">
                    <div class='icon' style="background-color:#000;border-radius: 24%;">
                        <img alt="" src='jl/img/lock_icon_copy.png'>
                    </div>
                    <input type="password" class="form-group form-control"  placeholder="密码" style="width:95%;padding-left: 41px;background-color: white;" name="password" autocomplete="off" value="{{ old('password') }}">
                    <!-- autocomplete="off" 禁止记录 -->
                    <!-- <span class="form-control-feedback glyphicon glyphicon-lock "></span> -->
                    @if ($errors->has('password'))
                    <center>
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    </center>
                    @endif

                </div> 
                <!--pwd-->
                {{-- <div class="login_fields__password has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class='icon'>
                    <img alt="" src='jl/img/lock_icon_copy.png'>
                </div>
                <input name="password" placeholder='密码' maxlength="16" type='text' autocomplete="off">
                @if ($errors->has('password'))
                    <div class='validation'>
                        <img alt="" src='jl/img/tick.png'>
                    </div>
                    <span class="help-block">
                     <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
                </div> --}}
                <!--<div class="login_fields__password has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class='icon'>
                    <img alt="" src='img/lock_icon_copy.png'>
                </div>
                <input name="password" placeholder='密码' maxlength="16" type='text' autocomplete="off">
                <div class='validation'>
                    <img alt="" src='img/tick.png'>
                </div>
                </div> -->
                <!--end pwd-->
                <!-- <div class='login_fields__password'> -->
                <!-- <div class='icon'>
                    <img alt="" src='jl/img/key.png'>
                </div> -->
                <!-- <input name="code" placeholder='验证码' maxlength="4" type='text' name="ValidateNum" autocomplete="off"> -->
                <!-- <div class='validation' style="opacity: 1; right: -5px;top: -3px;">
                <canvas class="J_codeimg" id="myCanvas" onclick="Code();">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
                </div> -->
                <!-- </div> -->
                <div class='login_fields__submit'>
                <center><input style="margin-top:30px;" type='submit' value='登录'></center>
                </div>
            </div>
            <!-- <div class='success'>
                </div>
                <div class='disclaimer'>
                    <p>欢迎登陆后台管理系统</p>
                </div>
            </div> -->
            <div class='authent'>
                <div class="loader" style="height: 44px;width: 44px;margin-left: 28px;">
                    <div class="loader-inner ball-clip-rotate-multiple">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    </div>
                <p>认证中...</p>
            </div>
            <!--begin div-->
            {{--<div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">--}}
                {{--<input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="用户名">--}}
               {{-- <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="密码" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-4">--}}
                    {{--<div class="checkbox icheck">--}}
                    {{--<label>--}}
                    {{--<input type="checkbox" name="remember"> Remember Me--}}
                    {{--</label>--}}
                    {{--</div>--}}
               {{-- </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
            </div> --}}
            <!--end div-->
        </form>
<div>
{{-- <div class="login-box" style="">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>{!! constants('APP_NAME') !!}</b></a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登录系统</p> --}}

        

        {{--<a href="{{ url('/password/reset') }}">忘记密码</a><br>--}}
        {{--<a href="{{ url('/register') }}" class="text-center">Register a new membership</a>--}}

    <!-- </div> -->
    <!-- /.login-box-body -->
<!-- </div> -->
<!-- /.login-box -->
<div class="OverWindows"></div>
<link href="jl/layui/css/layui.css" rel="stylesheet" type="text/css" />

<!--jl-->
<script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="jl/js/jquery-ui.min.js"></script>
<script type="text/javascript" src='jl/js/stopExecutionOnTimeout.js?t=1'></script>
<script src="jl/layui/layui.js" type="text/javascript"></script>
<script src="jl/js/Particleground.js" type="text/javascript"></script>
<script src="jl/js/Treatment.js" type="text/javascript"></script>
<script src="jl/js/jquery.mockjax.js" type="text/javascript"></script>
<!--end jl-->
<!-- <script src="/js/jquery-3.3.1.min.js"></script> -->
<script src="/a/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/a/adminlte.min.js"></script>
<script src="/a/icheck.min.js"></script>
<script>
    //粒子背景特效
    $('body').particleground({
        dotColor: '#E8DFE8',
        lineColor: '#133b88'
    });
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
