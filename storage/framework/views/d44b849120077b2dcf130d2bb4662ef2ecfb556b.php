<table class="table table-responsive" id="grades-table">
    <thead>
    <tr>
        <th>名称</th>
        <th>状态</th>
        <th>价格</th>
        <th colspan="3">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo $product->name; ?></td>
        <td><?php echo array_get(constants('CATE_STATUS'),$product->status); ?></td>
        <td><?php echo $product->price; ?></td>
        <td>
            <?php echo Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']); ?>

            <div class='btn-group'>

                <a href="<?php echo route('products.edit', ['id'=>$product->id,'search'=>6]); ?>" class='btn btn-default'><i
                            class="glyphicon glyphicon-edit"></i></a>
                <?php echo Form::hidden('search',6); ?>

                <?php echo Form::hidden('searchFields','type:='); ?>

                <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                btn-danger', 'onclick' => "return confirm('确认删除吗?')"]); ?>


            </div>
            <?php echo Form::close(); ?>

        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->startSection('scripts'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>