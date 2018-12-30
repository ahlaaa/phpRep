<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>价格</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo optional($route)->name; ?></td>
            <td><?php echo optional($route)->price; ?></td>
            <td>
                <?php echo Form::open(['route' => ['routes.destroy', $route->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('routes.edit', [$route->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>