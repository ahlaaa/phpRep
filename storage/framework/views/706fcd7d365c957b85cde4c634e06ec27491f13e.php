<!-- Amount Field -->
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    <?php echo Form::label('amount', '金额:'); ?>

    <?php echo Form::number('amount', null, ['class' => 'form-control', 'step'=> 0.1,'readonly']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('user_id', '用户:'); ?>

    <?php echo Form::select('user_id', app(\App\Repositories\UserRepository::class)->findWhere([['id', '>', 1]])->pluck('name', 'id'), null, ['class' => 'form-control','disabled']); ?>


</div>
</div>
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    <?php echo Form::label('fei', '手续费:'); ?>

    <?php echo Form::text('fei', '1%', ['class' => 'form-control', 'readonly']); ?>

</div>
    <div class="form-group col-sm-2">
        <?php echo Form::label('grs', '个人所得税:'); ?>

        <?php if(($withdraw->amount*0.99) >= 1111113500): ?>
        <?php $grs = round(($withdraw->amount * 0.99 - 3500) * (app(\App\Models\Grs::class)->where([['from_money', '<', ($withdraw->amount - 3500)],
                ['to_money', '>=', ($withdraw->amount - 3500)]])->pluck('prop')[0]), 2); ?>
        <?php echo Form::text('grs',
        $grs,
        ['class' => 'form-control', 'readonly']); ?>

        <?php else: ?>
        <?php $grs = 0; ?>
        <?php echo Form::text('grs',
        $grs,
        ['class' => 'form-control', 'readonly']); ?>

        <?php endif; ?>

    </div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('amount1', '实际打款:'); ?>

    <?php echo Form::number('amount1', round($withdraw->amount*0.99-$grs,2), ['class' => 'form-control', 'step'=>
    0.1,'readonly']); ?>

</div>
    <?php echo Form::hidden('amount', round($withdraw->amount,2), ['class' => 'form-control', 'step'=>
    0.1,'hidden']); ?>

</div>
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    <?php echo Form::label('type_str', '提现方式:'); ?>

    <?php echo Form::text('type_str', null, ['class' => 'form-control','readonly','id'=>'tixiantype']); ?>

</div>
<div class="form-group col-sm-2">
    <?php echo Form::label('identification_card', '身份证号:'); ?>

    <?php echo Form::text('identification_card', null, ['class' => 'form-control','readonly']); ?>

</div>
</div>
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    <?php echo Form::label('username', '账户名:'); ?>

    <?php echo Form::text('username', null, ['class' => 'form-control','readonly']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('account', '帐号:'); ?>

    <?php echo Form::text('account', null, ['class' => 'form-control','readonly']); ?>

</div>
<div class="form-group col-sm-2" id="tixiantype_bank" style="display:none;">
    <?php echo Form::label('bank', '银行:'); ?>

    <?php echo Form::text('bank', null, ['class' => 'form-control','readonly']); ?>

</div>
</div>
<div class="form-group col-sm-12">
<!-- remark Field -->
<div class="form-group col-sm-4 col-lg-4">
    <?php echo Form::label('remark', '备注:'); ?>

    <!--<div id="remark_div" style="width:100%; height:200px;"></div>-->
    <?php echo Form::textarea('remark',  null, ['class' => 'form-control', 'id'=> 'remark','cols'=>'10','rows'=>'5']); ?>

</div>
</div>
<div class="form-group col-sm-12">
<!-- Status Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('WITHDRAW_STATUS'), null, ['class' => 'form-control']); ?>

</div>
</div>
<div class="form-group col-sm-12">
<!-- Submit Field -->
<div class="form-group col-sm-4">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('withdraws.index'); ?>" class="btn btn-default">返回</a>
</div>
</div>
<?php $__env->startSection('scripts'); ?>
    <script>
        console.log(<?php echo $withdraw??null;?>)
	$(document).ready(function(){
		if($("#tixiantype").val() == "支付宝"){
	$("#tixiantype_bank").hide();
}else{
	$("#tixiantype_bank").show();

}
})
        /*
         富文本 start
         */
        /*var editor = new wangEditor('#remark_div')
        var $content = $('#remark')

        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $content.val(html)
        }


        editor.create()

        editor.txt.html($content.val())

        $content.val(editor.txt.html())*/
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        #remark_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }

    </style>
<?php $__env->stopSection(); ?>