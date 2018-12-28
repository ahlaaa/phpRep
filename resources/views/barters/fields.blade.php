<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', '换货单编号:') !!}
    {!! Form::text('number', null, ['class' => 'form-control', 'readonly']) !!}
</div>

<!-- address_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_company', '详细地址:') !!}
    {!! Form::select(
        'address_id',
        app(\App\Models\Address::class)->where('user_id', $barter->user_id ?? $customer->keys()->first())->get()->pluck('location', 'id'),
        $barter->address_id ?? null,
        ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', '收件人:') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user_id', '下单用户:') !!}
    {!! Form::select('user_id', $customer, $barter->user_id ?? null, ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('store_id', '门店:') !!}
    {!! Form::select('store_id', app(\App\Repositories\StoreRepository::class)->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', '订单:') !!}
    {!! Form::select('order_id', app(\App\Repositories\OrderRepository::class)->pluck('number', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_number', '快递单号:') !!}
    {!! Form::text('delivery_number', null, ['class' => 'form-control', 'placeholder' => "请输入快递单号"]) !!}
</div>

<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_company', '快递公司:') !!}
    {!! Form::select('delivery_company', $expresses, null, ['class' => 'form-control']) !!}
</div>

<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_type', '退货方式:') !!}
    {!! Form::select('delivery_type', constants('BARTER_DELIVERY_TYPE'), null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('coupon', 'Coupon:') !!}--}}
    {{--{!! Form::number('coupon', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Amount Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('amount', 'Amount:') !!}--}}
    {{--{!! Form::number('amount', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', constants('BARTER_STATUS'), $barter->status ?? old('status'), ['class' => 'form-control']) !!}
</div>

<!-- Delivery Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barter_delivery_number', '发货快递单号:') !!}
    {!! Form::text('barter_delivery_number', null, ['class' => 'form-control', 'placeholder' => "请输入快递单号"]) !!}
</div>

<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barter_delivery_company', '发货快递公司:') !!}
    {!! Form::select('barter_delivery_company', $expresses, null, ['class' => 'form-control']) !!}
</div>

<!-- delivery_company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barter_delivery_type', '发货方式:') !!}
    {!! Form::select('barter_delivery_type', constants('ORDER_DELIVERY_TYPE'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('barters.index') !!}" class="btn btn-default">Cancel</a>
</div>
