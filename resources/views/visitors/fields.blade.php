<!-- Nickname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nickname', 'Nickname:') !!}
    {!! Form::text('nickname', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img_avatar', 'Img Avatar:') !!}
    {!! Form::text('img_avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Openid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('openid', 'Openid:') !!}
    {!! Form::text('openid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('visitors.index') !!}" class="btn btn-default">Cancel</a>
</div>
