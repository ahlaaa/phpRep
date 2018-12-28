<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $administrator->id !!}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{!! $administrator->username !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{!! $administrator->type !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{!! $administrator->password !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $administrator->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $administrator->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $administrator->deleted_at !!}</p>
</div>

