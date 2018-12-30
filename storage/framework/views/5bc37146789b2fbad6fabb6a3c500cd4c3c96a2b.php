<table class="table table-responsive" id="administrators-table">
    <thead>
        <tr>
            <th>用户名</th>
            <th>类型</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $administrators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $administrator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $administrator->username; ?></td>
            <td><?php echo $administrator->type_str; ?></td>
            <td>
                <?php echo Form::open(['route' => ['administrators.destroy', $administrator->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    <a href="<?php echo route('administrators.edit', [$administrator->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="<?php echo route('administrators.password', [$administrator->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-lock"></i></a>
                    
                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>