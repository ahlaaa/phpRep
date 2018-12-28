<div class="col-sm-12"  style="padding: 35px 0px!important;">
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            等级
        </div>
        <div class="col-sm-6">
            {!! Form::number('level',null,['class'=>'form-control','style'=>'width:35%;','placeholder'=>'数字越大，等级越高']) !!}
<!--            <input class="form-control" style="width: 35%;" name="level" type="number" value="0" placeholder="数字越大，等级越高" />-->
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
<!--            等级类型-->
        </div>
        <div class="col-sm-6">
            {!! Form::hidden('type',1,['class'=>'form-control','style'=>'width:35%;']) !!}
            <!--            <input class="form-control" style="width: 35%;" name="level" type="number" value="0" placeholder="数字越大，等级越高" />-->
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            等级名称<span class="text-danger">*</span>
        </div>
        <div class="col-sm-6">
            {!! Form::text('name',null,['class'=>'form-control']) !!}
<!--            <input class="form-control" type="text" value="" />-->
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            升级条件
        </div>
        <div class="col-sm-6">
            <span class="form-control col-sm-2" style="width: 23%;">完成订单金额满</span>
            {!! Form::number('amount',null,['class'=>'form-control col-sm-6','style'=>'width:55%;','placeholder'=>'会员升级条件，不填写默认为不自动升级','step'=>'0.01']) !!}
<!--            <input class="form-control col-sm-6" style="width: 55%;" type="text" value="" placeholder="会员升级条件，不填写默认为不自动升级" />-->
            <span class="form-control col-sm-1" style="width: 7%;">元</span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
           折扣
        </div>
        <div class="col-sm-6">
            {!! Form::number('sales',null,['class'=>'form-control col-sm-6','style'=>'width:55%;','placeholder'=>'','step'=>'0.01']) !!}
<!--            <input class="form-control col-sm-6" style="width: 55%;" type="text" value="" placeholder="会员升级条件，不填写默认为不自动升级" />-->
            <span class="form-control col-sm-1" style="width: 7%;">元</span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2">
            状态
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="status" value="1" {!! 1 == ($grade->status??1)?'checked':'' !!} /><span>启用</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="status" value="2" {!! 2 == ($grade->status??1)?'checked':'' !!} /><span>禁用</span>
            </label>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('grades.index') !!}" class="btn btn-default">返回</a>
</div>