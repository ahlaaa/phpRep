<table class="table table-responsive" id="sales-table">
    <thead>
        <tr>
            <th>订单号</th>
            <th>赠品名称</th>
            <th>快递单号</th>
            <th>快递公司</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo isset($sale->order->number)?$sale->order->number:''; ?></td>
            <td><?php echo $sale->giveaway->name; ?></td>
            <td><?php echo $sale->delivery_number; ?></td>
            <td><?php echo $sale->delivery_company; ?></td>
            <td><?php echo $sale->status_str; ?></td>
            <td>
                
                <div class='btn-group'>
                    
                    <a href="<?php echo route('sales.edit', [$sale->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>