<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $article->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $article->title !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $article->content !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $article->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $article->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $article->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
{{--
<div class="form-group">--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--<p>{!! $article->deleted_at !!}</p>--}}
    {{--
</div>--}}

<!-- Updated User Id Field -->
<div class="form-group">
    {!! Form::label('updated_user_id', 'Updated User Id:') !!}
    <p>{!! $article->updated_user_id !!}</p>
</div>

<!-- Updated User Name Field -->
<div class="form-group">
    {!! Form::label('updated_user_name', 'Updated User Name:') !!}
    <p>{!! $article->updated_user_name !!}</p>
</div>

<!-- Created User Id Field -->
<div class="form-group">
    {!! Form::label('created_user_id', 'Created User Id:') !!}
    <p>{!! $article->created_user_id !!}</p>
</div>

<!-- Created User Name Field -->
<div class="form-group">
    {!! Form::label('created_user_name', 'Created User Name:') !!}
    <p>{!! $article->created_user_name !!}</p>
</div>

