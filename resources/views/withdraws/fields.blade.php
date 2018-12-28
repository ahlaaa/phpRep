<!-- Amount Field -->
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('amount', '金额:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'step'=> 0.1,'readonly']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('user_id', '用户:') !!}
    {!! Form::select('user_id', app(\App\Repositories\UserRepository::class)->findWhere([['id', '>', 1]])->pluck('name', 'id'), null, ['class' => 'form-control','disabled']) !!}

</div>
</div>
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('type_str', '提现方式:') !!}
    {!! Form::text('type_str', null, ['class' => 'form-control','readonly','id'=>'tixiantype']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('username', '账户名:') !!}
    {!! Form::text('username', null, ['class' => 'form-control','readonly']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('account', '帐号:') !!}
    {!! Form::text('account', null, ['class' => 'form-control','readonly']) !!}
</div>
<div class="form-group col-sm-2" id="tixiantype_bank" style="display:none;">
    {!! Form::label('bank', '银行:') !!}
    {!! Form::text('bank', null, ['class' => 'form-control','readonly']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- remark Field -->
<div class="form-group col-sm-4 col-lg-4">
    {!! Form::label('remark', '备注:') !!}
    <!--<div id="remark_div" style="width:100%; height:200px;"></div>-->
    {!! Form::textarea('remark',  null, ['class' => 'form-control', 'id'=> 'remark','cols'=>'10','rows'=>'5']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Status Field -->
<div class="form-group col-sm-2">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', constants('WITHDRAW_STATUS'), null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Submit Field -->
<div class="form-group col-sm-4">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('withdraws.index') !!}" class="btn btn-default">返回</a>
</div>
</div>
@section('scripts')
    <script>
	$(document).ready(function(){
		if($("#tixiantype").val() == "支付宝"){
	$("#tixiantype_bank").hide();
}else{
	$("#tixiantype_bank").show();

}
})
        /*
         富文本 start
         */
        /*var editor = new wangEditor('#remark_div')
        var $content = $('#remark')

        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $content.val(html)
        }


        editor.create()

        editor.txt.html($content.val())

        $content.val(editor.txt.html())*/
    </script>
@endsection
@section('css')
    <style>
        #remark_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }

    </style>
@endsection