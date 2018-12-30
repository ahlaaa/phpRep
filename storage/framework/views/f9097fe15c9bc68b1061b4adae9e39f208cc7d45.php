<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(constants('APP_NAME')); ?></title>
        <link href="/css/app.css" rel="stylesheet">
	<link href="/css/mystyle.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
        .unclick {
            pointer-events: none;
        }
        .btmc {
            border-width: 0px;
            position: absolute;
            left: 0px;
            /*top: 0px;*/
            width: 70px;
            height: 2px;
            background: inherit;
            background-color: rgba(57, 166, 247, 1);
            border: none;
            border-radius: 0px;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .spehidden {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: top;
            max-width: 200px;
        }
        .box-body .panel-body {
            background: white !important;
        }
        section > h1 {
            font-size: 1em !important;
        }
        #m_navbar {
            background-color: white !important;
            margin-left: 367px;
        }

        @media (max-width: 767px) {
            #m_navbar {
                /*margin: 0;*/
                margin-left: 0px !important;
            }
        }
        .treeview > .av-list {
            background: white !important;
        }
        .treeview a.isThisPage {
            color: rgb(57, 166, 247);
            background-color: rgb(237, 246, 255);
        }
        #bottom-box {
    position: fixed;
    bottom: 70px;
    right: 20px;
    width: 300px;
    height: 200px;
		border:1px solid #ddd;
		z-index:999;
		background-color:#fff;
		display: none;
	}
    .krajee-default.file-preview-frame .kv-file-content {
        height: auto !important;
    }
    .hide{
        display:none!important;
    }
	#bottom-box-close{
		position: absolute;
		top:-5px;
		right:5px;
		font-size: 2em;
		z-index:1000;
		color:red;
	}
	</style>
        <?php echo $__env->yieldContent('css'); ?>
    </head>
    <body class="skin-blue">
        <div id="app">
            <?php if(!Auth::guest()): ?>
                <div class="wrapper">
                    <!-- Main Header -->
                    <header class="main-header" style="background-color: white;">
                        <!--                        margin-left: 150px;-->
                        <div class="col-sm-1 user-panel"
                             style="width: 115px;display: inline-block;float: left;background-color: #222d32;">
                            <div class="pull-left image" style="width: 30px;">
                                <img src="<?php echo e(Auth::user()->img_head); ?>" class="img-circle" style="margin-left: 10px;"
                                     alt="User Image"/>
                            </div>
                            <div class="pull-left info" style="padding-top: 0px;padding-left: 0px;">
                                <?php if(Auth::guest()): ?>
                                <p><?php echo e(constants('APP_NAME')); ?></p>
                                <?php else: ?>
                                <p><?php echo e(Auth::user()->name); ?></p>
                                <?php endif; ?>
                                <!-- Status -->
                                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                            </div>
                        </div>
                        <!-- Logo -->
                        <a href="/home" class="logo" style="background-color: white;padding-top: 10px;">
                            <span style="color: #000;font-size: 25px;float: left;">
                            <span class="glyphicon glyphicon-home"></span>
                            
                             </span>
                        </a>

                        <!-- Header Navbar -->
                        <nav class="navbar navbar-static-top" role="navigation" id="m_navbar">
                            <!-- Sidebar toggle button-->
                            
                                
                            

                            <!-- Navbar Right Menu -->
                            <div class="navbar-custom-menu" style="height: 50px;">
                                <li class="dropdown" style="float: left;">
                                    <span class="dropdown-toggle" data-toggle="dropdown"
                                          style="color: #000;font-size: 15px;float: left;margin-top: 13px;margin-right: 25px;cursor: pointer;">
                                        <span><?php echo e(constants('APP_NAME')); ?></span>
                                        <span class="glyphicon glyphicon-chevron-down" style="font-size: 0.1px;"></span>
                                    </span>
                                    <ul class="dropdown-menu">
                                        <li style="text-align: center;"><a href="#">
                                                <span class="glyphicon glyphicon-briefcase"
                                                      style="font-size: 2px;"></span>
                                                权限管理</a>
                                        </li>
                                        <li style="text-align: center;"><a href="#">
                                                <span class="glyphicon glyphicon-lock" style="font-size: 2px;"></span>
                                                修改密码</a></li>
                                    </ul>
                                </li>
                                <ul class="nav navbar-nav" style="border-left: 0.03px solid #ccc;">
                                    <!-- User Account Menu -->
                                    <li class="dropdown user user-menu">
                                        <!-- Menu Toggle Button -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                           style="height: 100%;">
                                            <!-- The user image in the navbar-->
                                            <img src="<?php echo e(Auth::user()->img_head); ?>"
                                                 class="user-image" alt="User Image"/>
                                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                            <span class="hidden-xs"><?php echo Auth::user()->name; ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="<?php echo e(Auth::user()->img_head); ?>"
                                                     class="img-circle" alt="User Image"/>
                                                <p>
                                                    <?php echo Auth::user()->name; ?>

                                                    <small>注册时期 <?php echo Auth::user()->created_at->format('Y-m-d'); ?></small>
                                                </p>
                                            </li>
                                            <!-- Menu Footer-->
                                            <li class="user-footer">
                                                <div class="pull-right">
                                                    <a href="<?php echo url('/logout'); ?>" class="btn btn-default btn-flat"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        登出
                                                    </a>
                                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                                        <?php echo e(csrf_field()); ?>

                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="content-wrapper" style="min-height: 100%;">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

                    <!-- Main Footer -->
                    <footer class="main-footer" style="max-height: 100px;text-align: center">
                    </footer>

                </div>
            <?php else: ?>
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">

                            <!-- Collapsed Hamburger -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#app-navbar-collapse">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <!-- Branding Image -->
                            <a class="navbar-brand" href="<?php echo url('/'); ?>">
                                InfyOm Generator
                            </a>
                        </div>

                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Left Side Of Navbar -->
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo url('/home'); ?>">Home</a></li>
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <li><a href="<?php echo url('/login'); ?>">Login</a></li>
                                <li><a href="<?php echo url('/register'); ?>">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
	<div id="bottom-box">
		<span id="bottom-box-close">×</span>
		<div style="text-align:center;padding:5px 0;background-color:#f2f2f2;">系统提示</div>
		<div style="padding:5px 10px;"><a href="<?php echo url('orders?search=2&searchFields=status:='); ?>">您有 <span style="color:red;">
        <?php
            echo app(\App\Models\Order::class)->where("status",2)->count();
        ?>
        </span> 笔订单未处理</a></div>
		<div style="padding:5px 10px;"><a href="<?php echo url('stores?search=1&searchFields=status:='); ?>">您有 <span style="color:red;">
        <?php
            echo app(\App\Models\Store::class)->where("status",1)->count();
        ?>
        </span> 笔门店申请未处理</a></div>
		<div style="padding:5px 10px;"><a href="<?php echo url('users?type=1&search=1&searchFields=status:='); ?>">您有 <span style="color:red;">
        <?php
            echo app(\App\Models\User::class)->where([["status",1],["type",1]])->count();
        ?>
        </span> 笔代理商申请未处理</a></div>
		<div style="padding:5px 10px;"><a href="<?php echo url('withdraws?search=1&searchFields=status:='); ?>">您有 <span style="color:red;">
        <?php
            echo app(\App\Models\Withdraw::class)->where("status",1)->count();
        ?>
        </span> 笔提现申请未处理</a></div>
		<div style="padding:5px 10px;"><a href="<?php echo url('war4bala'); ?>">近期有 <span style="color:red;">
        <?php
            echo app(\App\Models\Store::class)->where("balance",'<=',50)->count();
        ?>
        </span> 名用户预存款不足。</a></div>
    </div>
    <div id='show_notify' style="position:fixed;bottom: 68px;right: 20px;cursor:pointer;" onclick="javascript:ttt(this);" class="hide">
        <span v-html="hml" style="color:red;"><span>
    </div>
    </body>
    <script src="/js/app.js"></script>
    <script>
        $("a[data-toggle='collapse']").click(function () {
            $("a[data-toggle='collapse']").css("pointer-events", " none");
            var ids = $(this).attr("href"), _in = $("ul .in").attr("id");
            if (_in)
                $("#" + _in).removeClass("in").attr('aria-expanded', true);
            setTimeout(function () {
                $("" + ids).addClass("in").attr('aria-expanded', true);
                $("a[data-toggle='collapse']").css("pointer-events", " auto");
            }, 300)
            // console.log($("" + ids).attr('class'));
        })
        var v_test = new Vue({
            el:"#show_notify",
            data:{"hml":"显示提示"}
        });
        function ttt(e){
            $('#bottom-box').attr('style','');
            $(e).addClass("hide");
            v_test.$data.htm = "";
            setTimeout(function(){
                $("#bottom-box").slideToggle("slow");
            },500);
        }
        $("#bottom-box-close").click(function(){
            v_test.$data.htm = "显示提示";
            $("#bottom-box").slideToggle("slow");
            $("#show_notify").removeClass("hide");
            // $("#show_notify").slideToggle("slow");
        });
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>' }
        })
        var ntf = localStorage.getItem("yhs_notify");
        if(!ntf){
            setTimeout(function(){
                $("#bottom-box").slideToggle("slow");
            },500);
            $("#bottom-box-close").click(function(){
                $("#bottom-box").slideToggle("slow");
                $('#show_notify').removeClass("hide");
                $("#show_notify").slideToggle("slow");
            });
            localStorage.setItem("yhs_notify",1);
            $("#show_notify").addClass("hide");
        }else{
            $("#show_notify").removeClass("hide");
            $("#bottom-box").attr("style","display:none!important;");
        }
		
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</html>