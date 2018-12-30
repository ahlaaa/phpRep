<table class="table table-bordered" id="withdraws-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>金额</th>
            <th>用户昵称</th>
            <th>用户返利余额</th>
<th>提现方式</th>
<th>账户名</th>
<th>帐号</th>
<th>银行</th>

            <th>备注</th>
            <th>状态</th>
            <th>申请时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $withdraw->id; ?></td>
            <td><?php echo $withdraw->amount; ?></td>
            <td><?php echo $withdraw->user->name; ?></td>
            <td><?php echo $withdraw->user->rebate; ?></td>
<td><?php echo $withdraw->type_str; ?></td>
<td><?php echo $withdraw->username; ?></td>
<td><?php echo $withdraw->account; ?></td>
<td><?php echo $withdraw->bank; ?></td>
            <td><?php echo $withdraw->remark; ?></td>
            <td><?php echo $withdraw->status_str; ?></td>
            <td><?php echo $withdraw->created_at; ?></td>
            <td>
                <?php echo Form::open(['route' => ['withdraws.destroy', $withdraw->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    
                    <a href="<?php echo route('withdraws.edit', [$withdraw->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>