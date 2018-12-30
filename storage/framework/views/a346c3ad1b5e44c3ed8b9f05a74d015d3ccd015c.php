<table class="table table-responsive" id="articles-table">
    <thead>
        <tr>
            <th>标题</th>
            <th>内容</th>
            <th>分类</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $article->title; ?></td>
            <td><?php echo e($article->simple_content); ?></td>
            <td><?php echo $article->category->title; ?></td>
            <td><?php echo $article->status_str; ?></td>
            <td>
                <?php echo Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('articles.edit', [$article->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>