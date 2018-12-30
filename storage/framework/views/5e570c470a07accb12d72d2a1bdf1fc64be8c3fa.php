

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">合伙人</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <?php if(isset($users)): ?>
                <?php echo $__env->make('users.healthers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    无数据
                <?php endif; ?>
            </div>
        </div>
        <div class="text-center">
        <?php if(!empty($u_healthers)): ?>
             <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $u_healthers], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    .p_in{
        color:red;
    }
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>