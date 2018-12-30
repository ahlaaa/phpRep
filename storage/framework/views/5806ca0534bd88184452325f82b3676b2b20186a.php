
<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('order_id', '订单:'); ?>

    <?php echo Form::select('order_id', \App\Models\Order::status(1)->selectRaw('CONCAT("订单号: ", number) as number, id')->pluck('number', 'id'), $sale->order_id ?? null, ['class' => 'form-control']); ?>

</div>

<!-- delivery_number Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_number', '快递单号:'); ?>

    <?php echo Form::text('delivery_number', null, ['class' => 'form-control', 'placeholder' => "请输入快递单号"]); ?>

</div>
<div class="form-group col-sm-6">
    <?php echo Form::label('giveaway_id', '赠品名称:'); ?>

    <?php echo Form::hidden('giveaway_id', null, ['class' => 'form-control', 'placeholder' => "请输入快递单号"]); ?>

    <?php echo Form::text('name_gw',
    isset($sale->giveaway_id)?app(\App\Models\Giveaway::class)->find($sale->giveaway_id)->name??'':'', ['class' =>
    'form-control', 'placeholder' => "请输入快递单号"]); ?>

</div>
<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_company', '快递公司:'); ?>

    <?php echo Form::select('delivery_company', $expresses, $sale->delivery_company ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('SALE_STATUS'), $sale->status ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('sales.index'); ?>" class="btn btn-default">退出</a>
</div>
