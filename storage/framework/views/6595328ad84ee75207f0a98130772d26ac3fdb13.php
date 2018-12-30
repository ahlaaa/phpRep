<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">提现记录</h1>
        
           
        
        <div class="row col-sm-12" style="margin: 9px auto;">
        <div class="col-sm-3">
        <form class="navbar-form navbar-left" action="<?php echo route('withdraws.index'); ?>" id="submit1" style="width:100%;" role="search">
            <div class="form-group">
                <?php echo Form::select('search',constants('WITHDRAW_STATUS'),null, ['class' => 'form-control','placeholder' => '请选择状态','id'=>'search1']); ?>

                <?php echo Form::text('searchFields','status:=;', ['class' => 'form-control','style' => 'display:none;','id'=>'searchFields1']); ?>


            </div>
            <button type="button" data-id="1" onclick="javascript:check_submit(this);" class="btn btn-default">搜索</button>
        </form>
        </div>
        <div class="col-sm-4">
        <form class="navbar-form navbar-left" id="submit2" action="<?php echo route('withdraws.index'); ?>" style="width:100%;" role="search">
            <div class="form-group">
                <?php echo Form::text('search',null, ['class' => 'form-control',
                'placeholder' => '输入用户昵称查询','id'=>'search2']); ?>

                <?php echo Form::text('searchFields','user_name:like;', ['class' =>
                'form-control','style' => 'display:none;','id'=>'searchFields2']); ?>


            </div>
            <button type="button" data-id="2" onclick="javascript:check_submit(this);" class="btn btn-default">搜索</button>
        </form>
        </div>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <?php echo $__env->make('withdraws.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="text-center">
            <?php echo $withdraws->appends(['days'=>request()->get('days',null),"status4ser"=>request()->get('status4ser',null)])->render(); ?>

            

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>