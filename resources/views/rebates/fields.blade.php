<!-- Order Id Field -->
<div class="form-group col-sm-12">
    {{--{!! Form::label('order_id', 'Order Id:') !!}--}}
    {!! Html::linkRoute('orders.edit', '查看订单详情', $rebate->order_id, ['class' => 'btn btn-link']) !!}
    {{--{!! Form::number('order_id', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', '金额:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户名称:') !!}
    {!! Form::select('user_id', \App\Models\User::customer()->pluck('name', 'id'), $rebate->user_id, ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', '新增时间:') !!}
    {!! Form::text('created_at', null, ['class' => 'form-control', 'disabled']) !!}
</div>

<!-- Updated User Id Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('updated_user_id', 'Updated User Id:') !!}--}}
    {{--{!! Form::number('updated_user_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Updated User Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('updated_user_name', 'Updated User Name:') !!}--}}
    {{--{!! Form::text('updated_user_name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Created User Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('created_user_id', 'Created User Id:') !!}--}}
    {{--{!! Form::number('created_user_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Created User Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('created_user_name', 'Created User Name:') !!}--}}
    {{--{!! Form::text('created_user_name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Submit Field -->--}}
<div class="form-group col-sm-12">
    {{--{!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}--}}
    <a href="{!! route('rebates.index') !!}" class="btn btn-default">返回</a>
</div>
