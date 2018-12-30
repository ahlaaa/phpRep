<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>孢子粉后台管理系统</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/a/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/a/font-awesome.min.css">

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

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(url('/home')); ?>"><b>孢子粉后台管理系统</b></a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登录系统</p>

        <form method="post" action="<?php echo e(url('/login')); ?>">
            <?php echo csrf_field(); ?>


            <div class="form-group has-feedback <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <?php if($errors->has('username')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('username')); ?></strong>
                </span>
                <?php endif; ?>
            </div>

            <div class="form-group has-feedback<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <input type="password" class="form-control" placeholder="密码" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
                <?php endif; ?>

            </div>
            <div class="row">
                <div class="col-xs-4">
                    
                    
                    
                    
                    
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        
        

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/a/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/a/adminlte.min.js"></script>
<script src="/a/icheck.min.js"></script>
<script>
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
