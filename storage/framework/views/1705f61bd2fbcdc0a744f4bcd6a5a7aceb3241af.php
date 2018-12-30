<table class="table table-responsive" id="rebates-table">
    <thead>
        <tr>
            <th>金额</th>
            <th>用户</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $rebates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rebate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $rebate->amount; ?></td>
            <td><?php echo $rebate->user->name; ?></td>
            <td>
                <?php echo Form::open(['route' => ['rebates.destroy', $rebate->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('rebates.edit', [$rebate->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>