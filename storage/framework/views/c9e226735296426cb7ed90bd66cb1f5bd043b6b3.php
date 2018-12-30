

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="pull-left">

        兑换记录

    </h1>
    <h1 class="pull-right">
        
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <?php echo $__env->make('exchangelogs.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="text-center">

        <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $exchangelogs], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>