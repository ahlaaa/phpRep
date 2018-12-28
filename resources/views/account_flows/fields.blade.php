<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type', false) !!}
        {!! Form::checkbox('type', '1', null) !!} 1
    </label>
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_user_id', 'Updated User Id:') !!}
    {!! Form::number('updated_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_user_name', 'Updated User Name:') !!}
    {!! Form::text('updated_user_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Created User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_user_id', 'Created User Id:') !!}
    {!! Form::number('created_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_user_name', 'Created User Name:') !!}
    {!! Form::text('created_user_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('accountFlows.index') !!}" class="btn btn-default">返回</a>
</div>
