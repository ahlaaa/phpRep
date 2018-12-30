

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            新增产品
        </h1>
    </section>
    <div class="content">
        <?php echo $__env->make('adminlte-templates::common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <?php echo Form::open(['route' => 'products.store','onsubmit'=>'return check_form();']); ?>

                    <?php if(request()->get('search',1) == 6): ?>
                    <?php echo $__env->make('products.saplings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                    <?php echo $__env->make('products.fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>