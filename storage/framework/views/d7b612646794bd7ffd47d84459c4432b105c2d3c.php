<table class="table table-responsive" id="articleCategories-table">
    <thead>
        <tr>
            <th>序号</th>
            <th>分类名称</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $articleCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articleCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $articleCategory->id; ?></td>
            <td><?php echo $articleCategory->title; ?></td>
            <td>
                <?php echo Form::open(['route' => ['articleCategories.destroy', $articleCategory->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('articleCategories.edit', [$articleCategory->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                   
                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>