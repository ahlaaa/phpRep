<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>名称</th>
            <th>类型</th>
            <th>状态</th>
            <th>订单号</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $saplings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sapling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo optional($sapling->user)->name; ?></td>
            <td><?php echo optional($sapling->product)->name; ?></td>
            <td><?php echo $sapling->type_str; ?></td>
            <td><?php echo $sapling->status_str; ?></td>
            <td><?php echo $sapling->order_number; ?></td>
            <td>
                <?php echo Form::open(['route' => ['saplings.destroy', $sapling->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('saplings.edit', [$sapling->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>