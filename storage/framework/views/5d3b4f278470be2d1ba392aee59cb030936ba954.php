

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">路线</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="<?php echo route('routes.create'); ?>">新增</a>
        </h1>
        <div>
            <form class="navbar-form navbar-left" style="width:100%;" role="search">
                <div class="form-group">
                    <?php echo Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']); ?>

                    <?php echo Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入路线名称']); ?>

                    <?php echo Form::text('searchFields','name:like;', ['class' =>
                    'form-control','style' => 'display:none;']); ?>

                    <!--<?php echo Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']); ?>-->

                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <?php echo $__env->make('routes.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="text-center">
        
        <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $routes], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>