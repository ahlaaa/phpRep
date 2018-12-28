<!-- Username Field -->
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('username', '登陆名:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>
</div>
{{--<div class="form-group col-sm-12">--}}
{{--<div class="form-group col-sm-2">--}}
    {{--{!! Form::label('password', '登陆密码:') !!}--}}
    {{--{!! Form::password('password', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}
<!-- Type Field -->
{{--</div>--}}
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('type', '类型:') !!}
    {!! Form::select('type', constants('ADMINISTRATOR_TYPE'), null, ['class' => 'form-control']) !!}
</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('administrators.index') !!}" class="btn btn-default">返回</a>
</div>

@section('scripts')
    <script>
	/*$(document).ready(function(){
		$("#password").addClass("form-control");
		$("#password").attr("autocomplete","new-password")
	})*/
    </script>
@endsection

@section('css')
    <style>
        input:-webkit-autofill { -webkit-box-shadow: 0 0 0px 1000px white inset; }


    </style>
@endsection
