<!-- Amount Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('amount', '金额:'); ?>

    <?php echo Form::number('amount', $order->amount ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Qty Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('qty', '数量:'); ?>

    <?php echo Form::number('qty', $order->qty ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('ORDER_STATUS'), $order->status ?? null, ['class' => 'form-control']); ?>

</div>



<div class="form-group col-sm-6">
    <?php echo Form::label('is_packing', '包装:'); ?>

    <?php echo Form::select('is_packing', ['否', '是'], $order->is_packing ?? 0, ['class' => 'form-control']); ?>

</div>

<!-- delivery_number Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_number', '快递单号:'); ?>

    <?php echo Form::text('delivery_number', $order->delivery_number ?? null, ['class' => 'form-control', 'placeholder' => "请输入快递单号"]); ?>

</div>

<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_company', '快递公司:'); ?>

    <?php echo Form::select('delivery_company', $expresses, $order->delivery_company ?? null, ['class' => 'form-control']); ?>

</div>

<div class="form-group col-sm-6">
    <?php echo Form::label('user_id', '下单用户:'); ?>

    <?php echo Form::select('user_id', $customer, $order->user_id ?? null, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('user_name', $order->user_name ?? $customer->first()); ?>

</div>

<!-- address_id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('delivery_company', '详细地址:'); ?>

    <?php echo Form::select(
        'address_id',
        \App\Models\Address::where('user_id', $order->user_id ?? $customer->keys()->first())->get()->pluck('location', 'id'),
        $order->address_id ?? null,
        ['class' => 'form-control']); ?>

</div>

<!-- giveaway_id Field -->
<?php if(isset($order->giveaway)): ?>
<div class="form-group col-sm-6">
    <?php echo Form::label('giveaway', '赠品:'); ?>

    <table class="table">
    <?php $__currentLoopData = $order->giveaway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo app(\App\Models\Giveaway::class)->find($v->id)->name; ?></td>
    </tr>
    <?php echo Form::hidden('giveaway['.$k.']',$v->id, ['class' => 'form-control']); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<?php endif; ?>

    
    
    
    
    
    
    


<!-- Updated User Id Field -->

    
    


<!-- Updated User Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('updated_user_name', '最后操作人:'); ?>

    <?php echo Form::text('updated_user_name', $order->updated_user_name ?? null, ['class' => 'form-control', 'readonly' => true]); ?>

</div>

<!-- Created User Id Field -->

    
    


<!-- Created User Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('created_user_name', '创建人:'); ?>

    <?php echo Form::text('created_user_name', $order->created_user_name ?? null, ['class' => 'form-control', 'readonly' => true]); ?>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary', 'id' => 'btn-save']); ?>

    <a href="<?php echo route('orders.index'); ?>" class="btn btn-default">返回</a>
</div>

<div class="modal fade" id="div-delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="divDeliveryLabel">
                    发货单
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递公司:</label>
                    <?php echo Form::select('', $expresses, $order->delivery_company ?? null, ['class' => 'form-control', 'id' => 'deliveryComp']); ?>

                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递单号:</label>
                    <?php echo Form::text(
                        '',
                        $order->delivery_number ?? null,
                        ['class' => 'form-control', 'id' => 'delivery', 'placeholder' => "请输入快递单号"]
                        ); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary" id="btn-delivery">
                    提交更改
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    $(function () {
        $('#status').change(function () {
            var $this = $(this)
            if (this.value === '2') {
                $('#div-delivery').modal()
            }
        });

        $('#btn-delivery').click(function () {
            $('#delivery_number').val($('#delivery').val())
            console.log($('#deliveryComp').val())
            $('#delivery_company').val($('#deliveryComp').val())
            $('#btn-save').click()
        })

        var addresses = $.parseJSON('<?php echo \App\Models\Address::all()->map(function ($item) {
            return $item->only(['id', 'full_info', 'user_id']);
        }); ?>');

        $('#user_id').change(function () {
            var _this = this
            $('[name="address_id"]').html(function () {
                return addresses.filter(function (item) {
                    return item.user_id == _this.value;
                }).map(function (item) {
                    return '<option value="' + item.id + '">' + item.full_info + '</option>';
                })
            })
        })
    })
</script>
<?php $__env->stopSection(); ?>
