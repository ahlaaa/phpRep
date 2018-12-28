
<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_number', '订单编号:') !!}
    {!! Form::text('order_number', null, ['class' => 'form-control']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', constants('SAPLING_STATUS'), null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('type', '类型:') !!}
    {!! Form::select('type', [6 => '树苗', 7 => '香榧树',], null, ['class' => 'form-control']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', '用户名称:') !!}
    {!! Form::text('user_name', optional(optional($sapling)->user)->name??'', ['class' => 'form-control']) !!}
    {!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_name', '商品名称:') !!}
    {!! Form::text('product_name', optional(optional($sapling)->product)->name??'', ['class' => 'form-control']) !!}
    {!! Form::hidden('product_id', null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('cate', '商品规格:') !!}
    {!! Form::text('cate', optional(optional($sapling)->cate)->name??'', ['class' => 'form-control']) !!}
    {!! Form::hidden('cate_id', null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('saplings.index') !!}" class="btn btn-default">返回</a>
</div>

@section('scripts')
<script>
</script>
@endsection