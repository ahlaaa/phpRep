<div class="clearfix tab-pane fade" id="cate">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;" id="unuse_standards">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 100%;">
            <p>库存</p>
        </div>
     
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 100%;">
            <label class="col-sm-6 form-group">
                {!! Form::label('code', '编码:',['class' => 'col-sm-4','style'=>'margin: 8px auto;']) !!}
                {!! Form::text('code', null, ['class' => 'form-control col-sm-10','style'=>'width: 65%;margin: 8px auto;','placeholder'=>'数字越大，排名越靠前,如果为空，默认排序方式为创建时间']) !!}
                <!-- <span class="col-sm-3" style="margin: 8px auto;">编码:</span>
                <input type="text" class="form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                       placeholder="数字越大，排名越靠前,如果为空，默认排序方式为创建时间"/> -->
            </label>
            <label class="col-sm-5 form-group">
                {!! Form::label('bar', '条码:',['class' => 'col-sm-3','style'=>'margin: 8px auto;']) !!}
                {!! Form::text('bar', null, ['class' => 'form-control col-sm-10','style'=>'width: 70%;margin: 8px auto;','placeholder'=>'数字越大，排名越靠前,如果为空，默认排序方式为创建时间']) !!}
               <!--  <span class="col-sm-3" style="margin: 8px auto;">条码:</span>
                <input type="text" class="form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                       placeholder="数字越大，排名越靠前,如果为空，默认排序方式为创建时间"/> -->
            </label>
            <label class="col-sm-12 form-group">
                {!! Form::label('weig', '重量:',['class' => 'col-sm-2','style'=>'margin: 8px auto;']) !!}
                {!! Form::text('weig', null, ['class' => 'form-control col-sm-7 form-group','style'=>'width: 60%;margin: 8px auto;','placeholder'=>'数字越大，排名越靠前,如果为空，默认排序方式为创建时间']) !!}
                {!! Form::label('weig', '克:',['class' => 'form-group form-control col-sm-3','style'=>'border: 1px solid white;margin: 8px auto;width: 6%;']) !!}
                <!-- <span class="col-sm-2" style="margin: 8px auto;">重量:</span>
                <input type="text" class="form-control col-sm-7 form-group" style="width: 60%;margin: 8px auto;"
                       placeholder="数字越大，排名越靠前,如果为空，默认排序方式为创建时间"/>
                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 6%;">
                    克
                </span> -->
            </label>
            <label class="col-sm-12 form-group">
                {!! Form::label('is_showQty', '库存:',['class' => 'col-sm-2','style'=>'margin: 8px auto;']) !!}
                {!! Form::text('qty', null, ['class' => 'form-control col-sm-7 form-group','style'=>'width: 60%;margin: 8px auto;','placeholder'=>'商品的剩余数量，如启用多规格或为虚拟卡密产品，则此处设置无效']) !!}
               
            <!--     <span class="col-sm-2" style="margin: 8px auto;">库存:</span>
                <input type="text" class="form-control col-sm-is_showQty7 form-group" style="width: 60%;margin: 8px auto;"
                       placeholder="商品的剩余数量，如启用多规格或为虚拟卡密产品，则此处设置无效"/> -->
                <label class="form-group form-control col-sm-3" style="width: 19%;margin: 8px auto;background-color: inherit;border: none;">
                    
                    {!! Form::hidden('is_showQty','0',['id'=>'is_showQty1']) !!}
                    {{--{!! Form::checkbox('is_showQty', 'true',[1===($product->is_showQty??0)?'checked':'','id'=>'is_showQty']) !!}--}}
                    <input type="checkbox" id="is_showQty" name="is_showQty" style="width: 17%;" value="1" {!! 1===($product->is_showQty??0)?'checked':'' !!} />
                    {!! Form::label('is_showQty', '显示库存:',['style'=>'margin: 8px auto;width:70%;']) !!}
                    <!-- <input type="checkbox" name="is_showQty" />
                    <span>显示库存</span> -->
                </label>
            </label>
            <label class="col-sm-10 form-group pull-right">
                <label class="col-sm-3 form-group">
                    <input type="radio" name="is_subtract" value='1' {!! ($product->is_subtract??1)==1?'checked':'' !!}/><span>拍下减库存</span>
                </label>
                <label class="col-sm-3 form-group">
                    <input type="radio" name="is_subtract" value='2' {!! ($product->is_subtract??1)==2?'checked':'' !!} /><span>付款减库存</span>
                </label>
                <label class="col-sm-3 form-group">
                    <input type="radio" name="is_subtract" value='3' {!! ($product->is_subtract??1)==3?'checked':'' !!} /><span>永不减库存</span>
                </label>
            </label>
        </div>
    </div>
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 100%;">
            规格
        </div>
        <div class="col-sm-7" id="l_rsize1"
             style="margin-left: 25px;background-color: #ccc;min-height: 100%;padding: 10px 10px;font-size: 17px;">
<!--            <label class="col-sm-12 form-group">-->
<!--                <input type="checkbox" name="on_standards" style="width: 25px;height: 25px;vertical-align: bottom;" /><span>启用产品规格</span>-->
<!--            </label>-->
            <label class="col-sm-12 pull-right form-group">
                <ul class=" nav nav-tabs" id="myTabCate">
                    <li>
                        <label>
                            <input type="hidden" name="on_standards" value="0" />
                            <input type="checkbox" value="1" name="on_standards" style="width: 25px;height: 25px;vertical-align: bottom;" />
                            <a href="#is_cate" data-toggle="tab" data-id="is_cate" id="myTabCate1">启用产品规格</a>
                        </label>
                    </li>
                </ul>
            </label>
            <div id="myTabCateContent" class="tab-content col-sm-12">
                <div class="tab-pane fade" id="is_cate">
                    <label class="col-sm-12 form-group" style="background-color: #de651c;padding: 6% 21%;">
                        <p><span>1:如果比例为空，则使用固定规则，如果都为空则无分销佣金</span></p>
                        <p><span>2:如果比例为空，则使用固定规则，如果都为空则无分销佣金</span></p>
                    </label>
                    <div class="col-sm-12" id="all_cate">
                        <div class="col-sm-12 form-group base_cate" style="display: none;">
                            <div class="panel panel-default form-group col-sm-12">
                                <div class="panel-heading col-sm-12 father_cate">
                                    <input type="text" class="form-group form-control col-sm-10" style="width: 75%;margin: 8px auto;padding-right: 25px;"/>
                                    <span class="form-group form-control col-sm-3 btn btn-primary" style="border: 1px solid white;margin: 8px auto;width: 19%;" onclick="add_child(this);">添加规格项</span>
                                    <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 6%;border: 1px solid white;margin: 8px auto;" onclick="remove_cate(this);">X</span>
                                </div>
                                <div class="panel-body col-sm-12 children_cates">
                                    <span class="col-sm-4 form-group" style="padding: 0px;">
                                        <input type="text" class="form-group form-control col-sm-10 children_cate" style="width: 75%;margin: 8px auto;" />
                                        <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 20%;border: 1px solid white;margin: 8px auto;" onclick="javascript:remove_child(this);">X</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group base_cate">
                            @if(!isset($product->cates))
                            <div class="panel panel-default form-group col-sm-12">
                                <div class="panel-heading col-sm-12 father_cate">
                                    <input type="text" class="form-group form-control col-sm-10" style="width: 75%;margin: 8px auto;padding-right: 25px;"/>
                                    <span class="form-group form-control col-sm-3 btn btn-primary" style="border: 1px solid white;margin: 8px auto;width: 19%;" onclick="add_child(this);">添加规格项</span>
                                    <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 6%;border: 1px solid white;margin: 8px auto;" onclick="remove_cate(this);">X</span>
                                </div>
                                <div class="panel-body col-sm-12 children_cates">
                                    <span class="col-sm-4 form-group" style="padding: 0px;">
                                        <input type="text" class="form-group form-control col-sm-10 children_cate" style="width: 75%;margin: 8px auto;" />
                                        <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 20%;border: 1px solid white;margin: 8px auto;" onclick="javascript:remove_child(this);">X</span>
                                    </span>
                                </div>
                            </div>
                            @else
                                <?php
                                    $standards = array();
                                    $cates_head = array();
                                    foreach ($product->standards as $standard){
                                        $name = $standard->name;
                                        $father_name = $standard->father_name;
                                        $seq = (integer)$standard->sequence;
                                        if(empty($father_name)){
                                            $cates_head[$seq] = $name;
                                            $standards[''.$name] = array();
                                        }else{
                                            array_push($standards[''.$father_name],$standard->name);
                                        }
                                    }
                                ?>
                                @foreach($standards as $index=>$standard)
                                <?php $flag = false; ?>
                                <div class="panel panel-default form-group col-sm-12">
                                    @if(!$flag)
                                        <div class="panel-heading col-sm-12 father_cate">
                                            <input type="text" class="form-group form-control col-sm-10" value="{!! $index !!}" style="width: 75%;margin: 8px auto;padding-right: 25px;"/>
                                            <span class="form-group form-control col-sm-3 btn btn-primary" style="border: 1px solid white;margin: 8px auto;width: 19%;" onclick="add_child(this);">添加规格项</span>
                                            <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 6%;border: 1px solid white;margin: 8px auto;" onclick="remove_cate(this);">X</span>
                                        </div>
                                        <?php $flag = true; ?>
                                    @endif

                                    <div class="panel-body col-sm-12 children_cates">
                                        @foreach($standard as $std)
                                            <span class="col-sm-4 form-group" style="padding: 0px;">
                                                <input value="{!! $std!!}" type="text" class="form-group form-control col-sm-10 children_cate" style="width: 75%;margin: 8px auto;" />
                                                <span class="form-group form-control col-sm-3 btn btn-danger" style="width: 20%;border: 1px solid white;margin: 8px auto;" onclick="javascript:remove_child(this);">X</span>
                                            </span>
                                        @endforeach
                                    </div>

                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary col-sm-12" onclick="javascript:add_cate();">+添加规格</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary col-sm-12" onclick="javascript:refresh_cate();">刷新规格项目表格</button>
                        </div>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-danger col-sm-12" onclick="javascript:use_cate();">添加/修改为该规格和值</button>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <table class="table">
                            <thead id="cate_head">
                            <tr>
                                @if(isset($cates_head))
                                    @foreach($cates_head as $head)
                                <th class="in_add"><span class="col-sm-12" style="padding: 0px;">{!! $head !!}</span></th>
                                    @endforeach
                                @endif
<!--                                <th><span class="col-sm-12" style="padding: 0px;">颜色</span></th><th><span class="col-sm-12" style="padding: 0px;">尺寸</span></th>-->
                                <th id="cate_names1"><label><span class="col-sm-12" style="padding: 0px;">库存</span><span class="col-sm-12" style="padding: 0px;"><input data-class="qty" type="number" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">预售价</span><span class="col-sm-12" style="padding: 0px;"><input step="0.01" data-class="pre_price" type="number" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">现价</span><span class="col-sm-12" style="padding: 0px;"><input step="0.01" data-class="price" type="number" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">原价</span><span class="col-sm-12" style="padding: 0px;"><input step="0.01" data-class="old_price" type="number" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">成本价</span><span class="col-sm-12" style="padding: 0px;"><input step="0.01" data-class="base_price" type="number" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">编码</span><span class="col-sm-12" style="padding: 0px;"><input data-class="code" type="text" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">条码</span><span class="col-sm-12" style="padding: 0px;"><input data-class="bar_code" type="text" class="form-control col-sm-12"></span></label></th>
                                <th><label><span class="col-sm-12" style="padding: 0px;">重量</span><span class="col-sm-12" style="padding: 0px;"><input step="0.01" data-class="weight" type="number" class="form-control col-sm-12"></span></label></th>
                            </tr>
                            </thead>
                            <tbody id="cate_body">
                            @if(sizeof($product->cates??[])>0)
                                @foreach($product->cates as $cate)
                            <tr>
                                <?php $cts = explode(',',$cate->name); ?>
                                @foreach($cts as $value)
                                <td>{!! $value !!}</td>
                                @endforeach
                            <td><input type="number" data-id="{!! $cate->qty.',qty' !!}" class="col-sm-12 form-control qty" value="{!! $cate->qty !!}" /></td>
                            <td><input step="0.01" type="number" data-id="{!! $cate->pre_price.',pre_price' !!}" class="col-sm-12 form-control pre_price" value="{!! $cate->pre_price !!}" /></td>
                            <td><input step="0.01" type="number" data-id="{!! $cate->price.',price' !!}" class="col-sm-12 form-control price" value="{!! $cate->price !!}" /></td>
                            <td><input step="0.01" type="number" data-id="{!! $cate->old_price.',old_price' !!}" class="col-sm-12 form-control old_price" value="{!! $cate->old_price !!}" /></td>
                            <td><input step="0.01" type="number" data-id="{!! $cate->base_price.',base_price' !!}" class="col-sm-12 form-control base_price" value="{!! $cate->base_price !!}" /></td>
                            <td><input type="text" data-id="{!! $cate->code.',code' !!}" class="col-sm-12 form-control code" value="{!! $cate->code !!}" /></td>
                            <td><input type="text" data-id="{!! $cate->bar_code.',bar_code' !!}" class="col-sm-12 form-control bar_code" value="{!! $cate->bar_code !!}" /></td>
                            <td><input step="0.01" type="number" data-id="{!! $cate->weight.',weight' !!}" class="col-sm-12 form-control weight" value="{!! $cate->weight !!}" /></td>
                            </tr>
                                @endforeach
                            @endif
<!--                            <tr>-->
<!--                                <td rowspan="2">绿色</td>-->
<!--                                <td>s</td>-->
<!--                                <td id="cate_styles"><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>m</td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                                <td><input type="text" class="col-sm-12 form-control" /></td>-->
<!--                            </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="cate_data" style="display: none;">
        <div id="cate_data_status"></div>
        <div id="standard_data_contents"></div>
        <div id="cate_data_contents"></div>
    </div>
</div>
