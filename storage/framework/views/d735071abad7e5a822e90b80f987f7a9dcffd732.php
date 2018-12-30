<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>省份</th>
            <th>市</th>
            <th>县</th>
            <th>街道</th>
            <th>用户名</th>
            <th>联系电话</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $address->province; ?></td>
            <td><?php echo $address->city; ?></td>
            <td><?php echo $address->county; ?></td>
            <td><?php echo $address->street; ?></td>
            <td><?php echo $address->user->name; ?></td>
            <td><?php echo $address->telephone; ?></td>
            <td>
                <?php echo Form::open(['route' => ['addresses.destroy', $address->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('addresses.edit', [$address->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>