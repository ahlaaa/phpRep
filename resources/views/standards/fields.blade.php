<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', '产品名称:') !!}
    {!! Form::select('product_id', app(\App\Repositories\ProductRepository::class)->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '规格型号:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('standards.index') !!}" class="btn btn-default">返回</a>
</div>
