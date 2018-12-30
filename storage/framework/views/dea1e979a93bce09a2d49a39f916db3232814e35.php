<table class="table table-responsive" id="grades-table">
    <thead>
        <tr>
            <th>等级</th>
            <th>等级名称</th>
            <th>折扣</th>
            <th>升级条件</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $grade->level; ?></td>
            <td><?php echo $grade->name; ?></td>
            <td><?php echo $grade->sales; ?></td>
            <td><?php echo $grade->level==1?'默认等级':'完成订单金额满&nbsp&nbsp'.$grade->amount.'&nbsp&nbsp元'; ?></td>
            <td><?php echo array_get(constants('GRADE_STATUS'),$grade->status); ?></td>
            <td>
                <?php echo Form::open(['route' => ['grades.destroy', $grade->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
<!--                    <a href="javascript:void(0);" class='btn btn-default' title="查看用户"><i class="glyphicon glyphicon-edit"></i></a>-->
                    <a href="<?php echo route('grades.edit', [$grade->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php if($grade->level != 1): ?>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]); ?>

                    <?php endif; ?>
                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->startSection('scripts'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>