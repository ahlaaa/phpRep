<!-- User Id Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('user_id', '合伙人:'); ?>

    <?php echo Form::select('user_id', \App\Models\User::Partner()->pluck('name', 'id'),null, ['class' => 'form-control']); ?>

</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('name', '名称:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- Telephone Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('telephone', '联系电话:'); ?>

    <?php echo Form::text('telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('address', '地址:'); ?>

    <?php echo Form::text('address', null, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('testingStores.index'); ?>" class="btn btn-default">返回</a>
</div>
