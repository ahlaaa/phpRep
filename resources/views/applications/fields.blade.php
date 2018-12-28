<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', '申请用户:') !!}
    {!! Form::text('user_name', $application->user->name??'', ['class' => 'form-control','disabled']) !!}
    {!! Form::hidden('user_id', $application->user_id??'', ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('is_use_chance', '是否使用机会:') !!}
    {!! Form::text('is_use_chance', constants('USE_CHANCE')[$application->use_chance??0], ['class' => 'form-control','disabled']) !!}
    {!! Form::hidden('use_chance', $application->use_chance??0, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('order_number', '订单号:') !!}
    {!! Form::text('order_number', $application->order->id??'', ['class' => 'form-control','disabled']) !!}
    {!! Form::hidden('order_id', $application->order_id??'', ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('order_status', '订单状态:') !!}
    {!! Form::text('order_number', $application->order->status_str??'', ['class' => 'form-control','disabled']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '申请状态:') !!}
    {!! Form::select('status',constants('APPLICATION_STATUS'), $application->status ?? null, ['class' => 'form-control','id'=>'card_type']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('level_name', '申请代理级别:') !!}
    {!! Form::text('level_name', $application->province.$application->city.$application->country.'--'.$application->level.'级代理', ['class' => 'form-control','disabled']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('applications.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script>

</script>
@endsection
@section('css')
<style>
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }

    #content {
        display: none;
    }

    .krajee-default.file-preview-frame .kv-file-content {
        height: 100%;
    }

    .krajee-default.file-preview-frame .kv-file-content img {
        width: 100%;
        max-height: 100%;
    }

    .krajee-default.file-preview-frame {
        width: 350px;
    }

    .file-zoom-content img {
        width: 100%;
        max-height: 100%;
    }
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
    .file-zoom-content>.file-preview-image{
        width: 75%;
        height: 75%;
    }
</style>
@endsection
