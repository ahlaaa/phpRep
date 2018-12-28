<div class="tab-pane fade" id="oauth">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">购买权限</div>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
            <label class="col-sm-12 pieces">
<!--                <span class="col-sm-2" style="margin: 8px auto;">单次最多购买:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;padding-right: 25px;"-->
<!--                       placeholder="用户单次购买此商品数量限制"/>-->
                {!! Form::label('one_max','单次最多购买:',['class'=>"col-sm-2",'style'=>"margin: 8px auto;"]) !!}
                {!! Form::number('one_max',null,['class'=>"form-group form-control col-sm-10",'style'=>"width: 70%;margin: 8px auto;padding-right: 25px;",
                'placeholder'=>"用户单次购买此商品数量限制"]) !!}
            </label>
            <label class="col-sm-12 pieces">
<!--                <span class="col-sm-2" style="margin: 8px auto;">单次最低购买:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;padding-right: 25px;"-->
<!--                       placeholder="用户单次必须最少购买此商品数量限制"/>-->
                {!! Form::label('one_min','单次最低购买:',['class'=>"col-sm-2",'style'=>"margin: 8px auto;"]) !!}
                {!! Form::number('one_min',null,['class'=>"form-group form-control col-sm-10",'style'=>"width: 70%;margin: 8px auto;padding-right: 25px;",'placeholder'=>"用户单次必须最少购买此商品数量限制"]) !!}
            </label>
            <label class="col-sm-12 pieces">
<!--                <span class="col-sm-2" style="margin: 8px auto;">最多购买:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;padding-right: 25px;"-->
<!--                       placeholder="用户购买过的此商品数量限制"/>-->
                {!! Form::label('max','最多购买:',['class'=>"col-sm-2",'style'=>"margin: 8px auto;"]) !!}
                {!! Form::number('max',null,['class'=>"form-group form-control col-sm-10",'style'=>"width: 70%;margin: 8px auto;padding-right: 25px;",'placeholder'=>'用户购买过的此商品数量限制']) !!}
            </label>
            <label class="col-sm-12 form-group">
                <span class="col-sm-2" style="margin: 8px auto;">会员等级浏览权限:</span>
                <div class="col-sm-10" style="margin: 8px auto;padding: 0px;">
                    {!! Form::select('grade_browse',app(\App\Models\Grade::class)->get()->pluck('name','id'),null,['class'=>"form-control select",'placeholder'=>'请选择...']) !!}
<!--                    <select name="browser" class="form-control select">-->
<!--                        <option name="browser">请选择...</option>-->
<!--                    </select>-->
                </div>
            </label>
            <label class="col-sm-12 form-group">
                <span class="col-sm-2" style="margin: 8px auto;">会员等级购买权限:</span>
                <div class="col-sm-10" style="margin: 8px auto;padding: 0px;">
                    {!! Form::select('grade_buy',app(\App\Models\Grade::class)->get()->pluck('name','id'),null,['class'=>"form-control select",'placeholder'=>'请选择...']) !!}
<!--                    <select name="pay"  class="form-control select">-->
<!--                        <option name="pay" >请选择...</option>-->
<!--                    </select>-->
                </div>
            </label>
        </div>
    </div>
</div>