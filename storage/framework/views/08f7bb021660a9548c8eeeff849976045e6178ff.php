

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">分类管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="<?php echo route('productCategories.create'); ?>">新增</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="clearfix"></div>
        <div class="box box-primary">


        <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="panel panel-default form-group col-sm-12">
                <div class="panel-heading form-group col-sm-12 father_categories" style="border: 1px solid #ccc;margin: 6.5px;">
                    <span style="text-align: left;border: none;background-color: inherit;cursor: pointer;" data-id="<?php echo $productCategory->id; ?>" class="col-sm-4" data-toggle="collapse"
                            data-target="#demo<?php echo $productCategory->id; ?>">
                        <?php echo $productCategory->title; ?>

                    </span>
                    <div class="col-sm-8">
                        <?php echo Form::open(['route' => ['productCategories.destroy', $productCategory->id], 'method' => 'delete']); ?>

                        <div class="col-sm-4 pull-right right" style="display: flex;padding: 2px 0px;">
                            <span class="col-sm-3 text-gray"><?php echo e($productCategory->statusstr); ?></span>
                            <a href="<?php echo route('productCategories.create', ['pid'=>$productCategory->id]); ?>" class="col-sm-3 btn btn-default">添加</a>
                            <a href="<?php echo route('productCategories.edit', [$productCategory->id]); ?>" class="col-sm-3 btn btn-default">编辑</a>
                            <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'col-sm-3 btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]); ?>

                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                <div id="demo<?php echo $productCategory->id; ?>" class="col-sm-12 collapse <?php echo $loop->index==0?'in':''; ?>">
                    
                <?php $__currentLoopData = app(\App\Models\ProductCategory::class)->where('pid',$productCategory->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="panel-body col-sm-11 pull-right children_categories" style="padding:0px;border: 1px solid #ccc;margin: 6.5px;">
                    <div class="col-sm-12">
                        <span style="text-align: left;border: none;background-color: inherit;" data-id="<?php echo $pcs->id; ?>" class=" col-sm-4 pull-left">
                            <?php echo $pcs->title; ?>

                        </span>
                        <div class="col-sm-8" style="padding: 2px 0px;">
                            <?php echo Form::open(['route' => ['productCategories.destroy', $pcs->id], 'method' => 'delete']); ?>

                            <div class="col-sm-4 pull-right right" style="display: flex;flex-direction: row;justify-content: flex-end;">
                                <span class="col-sm-3 text-gray"><?php echo e($productCategory->statusstr); ?></span>
                                <a href="<?php echo route('productCategories.edit', [$pcs->id]); ?>" class="col-sm-3 btn btn-default">编辑</a>
                                <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'col-sm-3 btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]); ?>

                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
            </div>
        </div>
        <div class="text-center">
        
        <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $productCategories], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    .right span,a,button{
        padding: 1px;
        margin-left: 6.5px;
    }
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>