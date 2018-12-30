<!-- Order Id Field -->
<div class="form-group col-sm-12">
    
    <?php echo Html::linkRoute('orders.edit', '查看订单详情', $rebate->order_id, ['class' => 'btn btn-link']); ?>

    
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('amount', '金额:'); ?>

    <?php echo Form::number('amount', null, ['class' => 'form-control', 'disabled']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('user_id', '用户名称:'); ?>

    <?php echo Form::select('user_id', \App\Models\User::customer()->pluck('name', 'id'), $rebate->user_id, ['class' => 'form-control', 'disabled']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('created_at', '新增时间:'); ?>

    <?php echo Form::text('created_at', null, ['class' => 'form-control', 'disabled']); ?>

</div>

<!-- Updated User Id Field -->

    
    




    
    




    
    




    
    



<div class="form-group col-sm-12">
    
    <a href="<?php echo route('rebates.index'); ?>" class="btn btn-default">返回</a>
</div>
