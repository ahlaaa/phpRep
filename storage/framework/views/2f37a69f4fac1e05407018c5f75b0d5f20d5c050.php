<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>订单编号</th>
            <th>金额</th>
            <th>数量</th>
            <th>状态</th>
            <th>下单人</th>
            <th>下单时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $order->number; ?></td>
            <td><?php echo $order->amount; ?></td>
            <td><?php echo $order->qty; ?></td>
            <td><?php echo $order->status_str; ?></td>
            <td><?php echo isset($order->user->name)?$order->user->name:''; ?></td>
            <td><?php echo $order->created_at; ?></td>
            <td>
                
                <div class='btn-group'>
                    
                    <a href="<?php echo route('orders.edit', [$order->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->startSection('scripts'); ?>
<script>
    console.log(<?php echo json_encode($orders); ?>);
</script>
<?php $__env->stopSection(); ?>