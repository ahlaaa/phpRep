<table class="table table-responsive" id="systemConfigs-table">
    <thead>
        <tr>
            <th>id</th>
            <th>袋子名称</th>
            <th>袋子价格</th>
            <th>创建时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $bags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $bag->id; ?></td>
            <td><?php echo $bag->name; ?></td>
            <td><?php echo $bag->price; ?></td>
            <td><?php echo $bag->created_at; ?></td>
            <td>
                <?php echo Form::open(['route' => ['bags.destroy', $bag->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    <a href="<?php echo route('bags.show', [$bag->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="<?php echo route('bags.edit', [$bag->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>