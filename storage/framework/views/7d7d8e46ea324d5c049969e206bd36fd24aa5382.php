<div class="col-sm-6" style="left: 68%;">
    <div class="col-sm-5">
        <?php if(!empty(request()->get('status4ser',null)) && request()->get('days',null)==0): ?>
        <a href="/search4with?status4ser=1&days=0" class="on">当天要打款</a>
        <?php else: ?>
        <a href="/search4with?status4ser=1&days=0">当天要打款</a>
        <?php endif; ?>
    </div>
    <div class="col-sm-5">
        <?php if(request()->get('days',null)==5): ?>
        <a href="/search4with?status4ser=1&days=5" class="on">5天内要打款</a>
        <?php else: ?>
        <a href="/search4with?status4ser=1&days=5">5天内要打款</a>
        <?php endif; ?>
    </div>
</div>
<table class="table table-bordered" id="withdraws-table">
    <thead>
    <tr>
        <th>ID</th>
        <th><!--金额-->提现金额</th>
        <th>手续费</th>
        <th>个人所得税</th>
        <th>实际打款</th>
        <th class="award-name">用户昵称</th>
        <th>奖励余额<!--用户返利余额--></th>
        <th>提现方式</th>
        <th>账户名</th>
        <th>帐号</th>
        <th>银行</th>
        <th>身份证</th>
        <th>备注</th>
        <th>状态</th>
        <th>申请时间</th>
        <th colspan="3">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e(($withdraw->user->rebate < $withdraw->amount && $withdraw->status === 1 ) ? 'red' : ''); ?>">
        <td><?php echo $withdraw->id; ?></td>
        <td><?php echo $withdraw->amount; ?></td>
        <td>1%</td>
        <td><?php if(($withdraw->amount*0.99) >= 111113500): ?>
            <?php $grs = round(($withdraw->amount * 0.99 - 3500) * (app(\App\Models\Grs::class)->where([['from_money', '<', ($withdraw->amount - 3500)],
                    ['to_money', '>=', ($withdraw->amount - 3500)]])->pluck('prop')[0]), 2); ?>
            <?php echo $grs; ?>

            <?php else: ?>
            <?php $grs = 0; ?>
            <?php echo $grs; ?>

            <?php endif; ?>
        </td>
        <td><?php echo round($withdraw->amount*0.99-$grs,2); ?></td>
        <td><?php echo $withdraw->user->name; ?></td>
        <td><?php echo $withdraw->user->rebate; ?></td>
        <td><?php echo $withdraw->type_str; ?></td>
        <td class="award-name"><?php echo $withdraw->username; ?></td>
        <td><?php echo $withdraw->account; ?></td>
        <td><?php echo $withdraw->bank; ?></td>
        <td><?php echo $withdraw->identification_card; ?></td>
        <td><?php echo $withdraw->remark; ?></td>
        <td><?php echo $withdraw->status_str; ?></td>
        <td><?php echo $withdraw->created_at; ?></td>
        <td>
            <?php echo Form::open(['route' => ['withdraws.destroy', $withdraw->id], 'method' => 'delete']); ?>

            <div class='btn-group'>
                
                <?php if($withdraw->status == 1): ?><a href="<?php echo route('withdraws.edit', [$withdraw->id]); ?>"
                                              class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a><?php endif; ?>
                
            </div>
            <?php echo Form::close(); ?>

        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->startSection('scripts'); ?>
<script>
    function check_submit(e) {
        var id = $(e).data('id'),search = 'search',search_f = 'searchFields';

        $("#search1").attr('name','search');
        $("#searchFields1").attr('name','searchFields').attr('value','status:=;');
        $("#search2").attr('name','search');
        $("#searchFields2").attr('name','searchFields').attr('value','user_name:like;');
        switch (id) {
            case 1:
                search += '2';
                search_f += '2';
                break;
            case 2:search += '1';search_f += '1';break;
        }
        $("#"+search).attr('name','o');
        $("#"+search_f).attr('name','o');
        $("#submit"+id).submit();
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    .on {
        color: red;
    }
    .red {
        color: red;
    }
</style>
<?php $__env->stopSection(); ?>
