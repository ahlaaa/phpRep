

<?php $__env->startSection('content'); ?>
<div style='margin: 0px 10px;'>

</div>
    <section class="content-header" style='display: inline-block;padding-right:18px;'>
        <h1 class="pull-left">订单</h1>
    </section>
    <div>
        <form class="navbar-form navbar-left" style="width:100%;" role="search">
            <div class="form-group">
                <?php echo Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']); ?>

                <?php if(request()->get('searchFields','')=='number:=;'): ?>
                <?php echo Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入订单号']); ?>

                <?php echo Form::text('searchFields','number:=;', ['class' =>
                'form-control','style' => 'display:none;']); ?>

                <?php else: ?>
                <input class="form-control" placeholder="请输入订单号" type="text" name="search" />
                <input class="form-control" value="number:=;" type="hidden" name="searchFields" />
                <?php endif; ?>
                <!--<?php echo Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']); ?>-->

            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <?php echo $__env->make('orders.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="text-center">
        
        <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $orders], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>