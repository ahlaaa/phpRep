
<div id="div-distpicker">

    <!-- Province Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province', '省:') !!}
    {!! Form::select('province', [] , null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', '市:') !!}
    {!! Form::select('city', [] , null, ['class' => 'form-control']) !!}

    {{--{!! Form::text('city', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- County Field -->
<div class="form-group col-sm-6">
    {!! Form::label('county', '县:') !!}
    {!! Form::select('county', [] , null, ['class' => 'form-control']) !!}
    {{--{!! Form::text('county', null, ['class' => 'form-control']) !!}--}}
</div>

</div>
<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street', '街道:') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('consignee', '收货人:') !!}
    {!! Form::text('consignee', null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户:') !!}
    {!! Form::select('user_id', $customer, null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telephone', '联系电话:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
    {{--{!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('addresses.index') !!}" class="btn btn-default">返回</a>
</div>

@section('scripts')
<script>
    $(function () {
        $('#div-distpicker').distpicker()

        var province = "{!! $address->province ?? null  !!}";

        if (province) {
            defaultRegion(province)
        }
        function defaultRegion(province) {
            $('#province option[value=' + province + ']').attr('selected', true)
            $('#province').change()
            $('#city option[value="{!! $address->city ?? null  !!}"]').attr('selected', true)
            $('#city').change()
            $('#county option[value="{!! $address->county ?? null !!}"]').attr('selected', true)
        }
    })
</script>
@endsection