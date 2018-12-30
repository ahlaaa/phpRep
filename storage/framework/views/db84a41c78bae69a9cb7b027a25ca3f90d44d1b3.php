<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(constants('APP_NAME')); ?></title>
        <link href="/css/app.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
	.kv-file-content>img{
	    max-width: 160px;
	}
</style>        
<?php echo $__env->yieldContent('css'); ?>
    </head>
    <body class="skin-blue">
        <div id="app">
            <?php if(!Auth::guest()): ?>
                <div class="wrapper">
                    <!-- Main Header -->
                    <header class="main-header">

                        <!-- Logo -->
                        <a href="#" class="logo">
                            <b><?php echo e(constants('APP_NAME')); ?></b>
                        </a>

                        <!-- Header Navbar -->
                        <nav class="navbar navbar-static-top" role="navigation">
                            <!-- Sidebar toggle button-->
                            
                                
                            
                            <!-- Navbar Right Menu -->
                            <div class="navbar-custom-menu">
                                <ul class="nav navbar-nav">
                                    <!-- User Account Menu -->
                                    <li class="dropdown user user-menu">
                                        <!-- Menu Toggle Button -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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

                    <!-- Left side column. contains the logo and sidebar -->
                <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>

                    <!-- Main Footer -->
                    <footer class="main-footer" style="max-height: 100px;text-align: center">
                        <strong>Copyright © 2018 <a href="#">创否科技</a>.</strong> 提供技术支持.
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
    </body>
    <script src="/js/app.js"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '<?php echo e(csrf_token()); ?>' }
        })
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</html>
