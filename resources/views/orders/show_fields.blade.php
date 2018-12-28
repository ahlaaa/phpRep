<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $order->id !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $order->amount !!}</p>
</div>

<!-- Qty Field -->
<div class="form-group">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{!! $order->qty !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $order->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $order->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $order->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $order->deleted_at !!}</p>
</div>

<!-- Updated User Id Field -->
<div class="form-group">
    {!! Form::label('updated_user_id', 'Updated User Id:') !!}
    <p>{!! $order->updated_user_id !!}</p>
</div>

<!-- Updated User Name Field -->
<div class="form-group">
    {!! Form::label('updated_user_name', 'Updated User Name:') !!}
    <p>{!! $order->updated_user_name !!}</p>
</div>

<!-- Created User Id Field -->
<div class="form-group">
    {!! Form::label('created_user_id', 'Created User Id:') !!}
    <p>{!! $order->created_user_id !!}</p>
</div>

<!-- Created User Name Field -->
<div class="form-group">
    {!! Form::label('created_user_name', 'Created User Name:') !!}
    <p>{!! $order->created_user_name !!}</p>
</div>

