
<!-- Street Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('order_number', '订单编号:'); ?>

    <?php echo Form::text('order_number', null, ['class' => 'form-control']); ?>

</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('SAPLING_STATUS'), null, ['class' => 'form-control']); ?>

</div>
<div class="form-group col-sm-6">
    <?php echo Form::label('type', '类型:'); ?>

    <?php echo Form::select('type', [6 => '树苗', 7 => '香榧树',], null, ['class' => 'form-control']); ?>

</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('user_name', '用户名称:'); ?>

    <?php echo Form::text('user_name', optional(optional($sapling)->user)->name??'', ['class' => 'form-control']); ?>

    <?php echo Form::hidden('user_id', null, ['class' => 'form-control']); ?>

    
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('product_name', '商品名称:'); ?>

    <?php echo Form::text('product_name', optional(optional($sapling)->product)->name??'', ['class' => 'form-control']); ?>

    <?php echo Form::hidden('product_id', null, ['class' => 'form-control']); ?>

    
</div>

<div class="form-group col-sm-6">
    <?php echo Form::label('cate', '商品规格:'); ?>

    <?php echo Form::text('cate', optional(optional($sapling)->cate)->name??'', ['class' => 'form-control']); ?>

    <?php echo Form::hidden('cate_id', null, ['class' => 'form-control']); ?>

    
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('saplings.index'); ?>" class="btn btn-default">返回</a>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>