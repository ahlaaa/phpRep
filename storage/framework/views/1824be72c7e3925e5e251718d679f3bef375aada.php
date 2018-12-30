

<table class="table table-responsive" id="rebates-table">
    <thead>
    <tr>
        <th>获得金额</th>
        <th>用户</th>
        <th>订单</th>
        <th>下单人</th>
        <th>类型</th>
        <th>备注</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
    <?php  ?>
    <?php $__currentLoopData = $rebates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rebate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo $rebate->amount??null; ?></td>
        <td><?php echo optional($rebate->user)->name??null; ?></td>
        <td><?php echo optional($rebate->order)->number??null; ?></td>
        <td><?php echo optional(app(\App\Models\User::class)->where("id",$rebate->order->user_id??null)->first())->name; ?></td>
        <td><?php echo $rebate->type_str??null; ?></td>
        <td><?php echo $rebate->remark??null; ?></td>
        <td><?php echo $rebate->created_at??null; ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>