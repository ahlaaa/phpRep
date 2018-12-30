

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">会员管理</h1>
        
           
        

    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <?php $s_type = $_GET['s_type']??0;$s_type = $_GET['s_types']??null; ?>
        <form class="navbar-form navbar-left" style="width:50%;" role="search" id="form_1">
            <div class="form-group">
                <?php echo Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']); ?>

               
               
               <!-- <select class='form-control' id='s_type'>
                   <option value="0">关键字</option>
                   <option value="1">推荐人</option>
               </select> -->
              
                <?php if(empty($_GET['s_type'])): ?>
                <?php echo Form::hidden('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']); ?>

                <?php else: ?>
                <?php echo Form::hidden('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']); ?>

                <?php endif; ?>
                <?php if(request()->get('type', 1) == 2): ?>
                <?php echo Form::select('s_type',["关键字","推荐人"],0, ['class' => 'form-control','id' => 's_type']); ?>

                <?php echo Form::text('searchs',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch']); ?>

                <?php echo Form::select('s_types',[],0, ['class' => 'form-control','id' => 's_types','placeholder' => '无用户']); ?>

                <?php else: ?>
                <?php echo Form::text('search',null, ['class' => 'form-control','placeholder' => '请输入关键字','id'=>'s_sch1']); ?>

                <?php endif; ?>
                <input type="hidden" name="searchFields" value="name:like;username:like;wechat:like;telephone:like;email:like;province:like;city:like;county:like;" id='s_ipt' />
               
		
	        <!--<?php echo Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']); ?>-->

            </div>
            <button type="button" onclick="javascript:$('#form_1').submit();" class="btn btn-default">搜索</button>
        </form>
    
        <?php if(request()->get('type', 1) == 2): ?>
        <form class="navbar-form navbar-left" style="width:50%;" role="search" id="form_2">
            <div class="form-group">
                <?php echo Form::text('type', '1',['class' => 'form-control','style' => 'display:none;']); ?>

                <?php echo Form::select('search',app(\App\Models\Grade::class)->where('type',2)->get()->pluck('name','id'),null, ['class' => 'form-control','placeholder' => '选择查找等级']); ?>

		<?php echo Form::text('searchFields','grade_id:=;', ['class' => 'form-control','style' => 'display:none;']); ?>

	        <!--<?php echo Form::select('grade_id',constants('REBATE_TYPE'),null, ['class' => 'form-control']); ?>-->

            </div>
            <button type="button" onclick="javascript:$('#form_2').submit();"  class="btn btn-default">搜索</button>
        </form>
        <?php endif; ?>

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    <?php echo $__env->make('users.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="text-center">
        
        <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $users], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>