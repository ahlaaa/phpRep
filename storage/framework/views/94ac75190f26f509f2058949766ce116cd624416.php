<table class="table table-responsive" id="factories-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>名称</th>
            <th>地址</th>
            <th>联系人</th>
            <th>联系电话</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $factories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $factory->user->name; ?></td>
            <td><?php echo $factory->name; ?></td>
            <td><?php echo $factory->address; ?></td>
            <td><?php echo $factory->linkman; ?></td>
            <td><?php echo $factory->telephone; ?></td>
            <td>
                <?php echo Form::open(['route' => ['factories.destroy', $factory->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('factories.edit', [$factory->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>