<div class="col-sm-12">
    <table class="table">
        <thead>
        <tr>
            <td>标签名称</td><td>会员数</td>
            <td>标签描述</td><td colspan="3">操作</td>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo $tag->name; ?></td><td><?php echo $tag->users->count(1)??0; ?></td>
                <td><?php echo $tag->contents; ?></td>
                <td>
                    <?php echo Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete']); ?>

                    <div class='btn-group'>

                        <a alt="用户" title="用户" href="javascript:void(0);" class='btn btn-default '><i class="glyphicon glyphicon-edit"></i></a>
                        <a alt="添加" title="添加" href="javascript:void(0);" class='btn btn-default'><i class="glyphicon glyphicon-lock"></i></a>
                        <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>