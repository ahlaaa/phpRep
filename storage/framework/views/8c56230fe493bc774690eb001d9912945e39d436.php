

<?php $__env->startSection('content'); ?>
<div class="container">
    <section class="content-header">
        <h1 class="pull-left">
            <span class="glyphicon glyphicon-minus" style="transform: rotate(90deg);color: aqua;"></span>
            <span>当前位置:首页</span>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary" style="background: #ecf0f5!important;">
            <div class="box-body">
                <?php echo $__env->make('block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="text-center">


        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>