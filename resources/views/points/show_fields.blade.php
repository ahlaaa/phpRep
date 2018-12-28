<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $point->id !!}</p>
</div>

<!-- Percentage Field -->
<div class="form-group">
    {!! Form::label('percentage', 'Percentage:') !!}
    <p>{!! $point->percentage !!}</p>
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', 'Point:') !!}
    <p>{!! $point->point !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $point->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $point->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $point->deleted_at !!}</p>
</div>

