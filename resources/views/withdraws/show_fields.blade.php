<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $withdraw->id !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{!! $withdraw->amount !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $withdraw->user_id !!}</p>
</div>

<!-- Remark Field -->
<div class="form-group">
    {!! Form::label('remark', 'Remark:') !!}
    <p>{!! $withdraw->remark !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $withdraw->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $withdraw->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $withdraw->deleted_at !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $withdraw->status !!}</p>
</div>

