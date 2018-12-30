

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            用户
        </h1>
   </section>
   <div class="content">
       <?php echo $__env->make('adminlte-templates::common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <?php echo Form::model($user, ['route' => ['users.password', $user->id], 'method' => 'post']); ?>

                   <div class="form-group col-sm-12">
                       <?php echo Form::label('password', '密码:'); ?>

                       <?php echo Form::text('password', '', ['class' => 'form-control']); ?>

                   </div>
                   <div class="form-group col-sm-12">
                       <?php echo Form::label('password', '重新输入密码:'); ?>

                       <?php echo Form::text('re_password', '', ['class' => 'form-control']); ?>

                   </div>
                   <div class="form-group col-sm-12">
                       <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

                       <a href="<?php echo route('users.index'); ?>" class="btn btn-default">返回</a>
                   </div>
                   <?php echo Form::close(); ?>

               </div>
           </div>
       </div>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>