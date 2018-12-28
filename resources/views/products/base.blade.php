<div class="tab-pane fade in active" id="base">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">
            <p>基本信息</p>
        </div>
     <?php ?>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">

            <label class="col-sm-12">
                {!! Form::label('volume', '排序:',['class' => 'col-sm-2','style'=>'width: 16.5%;']) !!}
                {!! Form::number('volume', null, ['class' => 'form-group form-control col-sm-10','style'=>'width:70%;','placeholder'=>'数字越大，排名越靠前,如果为空，默认排序方式为创建时间']) !!}
                <!-- <span class="col-sm-2" style="margin: 8px auto;">排序:</span>
                <input type="number" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                       placeholder="数字越大，排名越靠前,如果为空，默认排序方式为创建时间"/> -->
            </label>
           
            <label class="col-sm-12 i_right">

                {!! Form::label('name', '商品名称:',['class' => 'col-sm-2 pro_name']) !!}
                {!! Form::text('name', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;padding-right: 104px;']) !!}
                <!-- <span class="col-sm-2 pro_name" style="">商品名称 -->

            </label>
            <label class="col-sm-12">
                {!! Form::label('cname', '副标题:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                {!! Form::textarea('cname', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;resize: none;height: 75px;','placeholder'=>'副标题长度请控制在100字以内']) !!}
          
            </label>
            <label class="col-sm-12">
                {!! Form::label('dname', '商品短标题:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                {!! Form::text('dname', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;','placeholder'=>'商品短标题 用于快递打印,以及小型热敏打印机打印']) !!}
                <!-- <span class="col-sm-2" style="margin: 8px auto;">商品短标题:</span>
                <input type="text" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                       placeholder="商品短标题 用于快递打印,以及小型热敏打印机打印"/> -->
            </label>
            <label class="col-sm-12">
                {!! Form::label('keysname', '关键字:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                {!! Form::text('keysname', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;','placeholder'=>'商品短标题 用于快递打印,以及小型热敏打印机打印']) !!}
                
               <!--  <span class="col-sm-2" style="margin: 8px auto;">关键字:</span>
                <input type="text" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                       placeholder="商品短标题 用于快递打印,以及小型热敏打印机打印"/> -->
            </label>
            <div class="col-sm-12">
                <span class="col-sm-2" style="margin: 8px auto;">商品类型:</span>
                <div class="col-sm-10" style="margin: 8px -24px;">
                    <label>
                        <input type="radio" name="type" value='1' {!! ($product->type??1)==1?'checked':'' !!}/><span>实体商品</span>
                    </label>
                    <label>
                        <input type="radio" name="type" value='2' {!! ($product->type??1)==2?'checked':'' !!}/><span>虚拟物品</span>
                    </label>
                    <label>
                        <input type="radio" name="type" value='3' {!! ($product->type??1)==3?'checked':'' !!}/><span>虚拟物品(卡密)</span>
                    </label>
                    <label>
                        <input type="radio" name="type" value='4' {!! ($product->type??1)==4?'checked':'' !!}/><span>批发商品</span>
                    </label>
                    <label>
                        <input type="radio" name="type" value='5' {!! ($product->type??1)==5?'checked':'' !!}/><span>计时/次商品</span>
                    </label>
                    <label>
                        <input type="radio" name="type" value='7' {!! ($product->type??1)==7?'checked':'' !!}/><span>香榧树</span>
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;height: 100%;">
            <p>商品信息</p>
        </div>
        <div class="col-sm-7" id="l_rsize"
             style="margin-left: 25px;background-color: #ccc;min-height: 75%;padding: 10px 10px;">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <span class="col-sm-2" style="margin-bottom: 23px;">预售设置:</span>
                    <label class="subs_presell">
                        <input type="radio" name="presell_on" value='1' {!! ($product->presell_on??0)==1?'checked':'' !!}/><span>是</span>
                    </label>
                    <label>
                        <input type="radio" name="presell_on" value='0' {!! ($product->presell_on??0)==0?'checked':'' !!}/><span>否</span>
                    </label>
                </div>
                <label class="col-sm-12">
                    {!! Form::label('product_category_id', '商品分类:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    <?php
//                    app(\App\Repositories\ProductCategoryRepository::class)->findByField('pid',0);
                    ?>
                    {!! Form::select('product_category_id',app(\App\Models\ProductCategory::class)->where('pid','!=','0')->pluck('title', 'id'),null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;','placeholder'=>'选择商品分类']) !!}
                
                    <!-- <span class="col-sm-2" style="margin: 8px auto;">商品分类:</span>
                    <input type="text" class="form-group form-control col-sm-10" style="width: 70%;margin: 8px auto;"
                           placeholder="商品短标题 用于快递打印,以及小型热敏打印机打印"/> -->
                </label>
                <label class="col-sm-12 subs_price">
                    {!! Form::label('price', '商品价格:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    {!! Form::text('price', null, ['class' => 'form-group form-control col-sm-3','style'=>'width: 23%;','placeholder'=>'产品价格(元)']) !!}
                    {!! Form::text('oprice', null, ['class' => 'form-group form-control col-sm-3','style'=>'width: 23%;margin-left: 3px;','placeholder'=>'原价(元)']) !!}
                    {!! Form::text('cprice', null, ['class' => 'form-group form-control col-sm-3','style'=>'width: 23%;margin-left: 3px;','placeholder'=>'成本价(元)']) !!}
                
                   <!--  <span class="col-sm-2" style="margin: 8px auto;">商品价格:</span>
                    <input type="text" class="form-group form-control col-sm-3" style="width: 23%;"
                           placeholder="产品价格(元)"/>
                    <input type="text" class="form-group form-control col-sm-3" style="width: 23%;margin-left: 3px;"
                           placeholder="原价(元)"/>
                    <input type="text" class="form-group form-control col-sm-3" style="width: 23%;margin-left: 3px;"
                           placeholder="成本(元)"/> -->
                </label>
                <div class="col-sm-12">
                    <label class="col-sm-12">
                        <span class="col-sm-2" style="margin: 8px -14px;">图片:</span>
                        <div class="controls col-sm-10">
                            <input id="img_main_file" type="file" class="file-loading" accept="image/*">
                            <input type="hidden" name="img_main" id="img_main"
                                   value="{{ $product->img_main ?? '' }}">
                        </div>
                    </label>
                    <label class="col-sm-12" style="margin-left: 11.5%;">
                        {!! Form::hidden('details','0') !!}
                        {{--{!! Form::checkbox('details', 'true',[1===($product->details??0)?'checked':'','id'=>'details']) !!}--}}
                        <input type="checkbox" id="details" name="details" value="1" {!! 1===($product->details??0)?'checked':'' !!} />
                        {!! Form::label('details', '详情显示首图:') !!}
                       
                        <!-- <input type="checkbox"><span>详情显示首图</span> -->
                    </label>

                </div>
                <div class="col-sm-12">
                    <label class="col-sm-12 s_right">
                        {!! Form::label('sort', '已售出数:',['class' =>'col-sm-2','style' =>'margin: 8px -13px;']) !!}
                        {!! Form::number('sort', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;padding-right: 31px;']) !!}
            
                    </label>
                    <label class="col-sm-12" style="margin-left: 11.5%;">
                         {!! Form::hidden('sales','0') !!}
                        {{--{!! Form::checkbox('sales', 'true',[1===($product->sales??0)?'checked':'','id'=>'sales']) !!}--}}
                        <input type="checkbox" id="sales" name="sales" value="1" {!! 1===($product->sales??0)?'checked':'' !!} />
                        <!-- {!! Form::checkbox('sales', $product->sales??0,['checked'=>'checked']) !!} -->
                        {!! Form::label('sales', '显示销量:') !!}
                        <!-- <input type="checkbox"><span>显示销量</span> -->
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">
            <p>商品属性</p>
        </div>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;min-height: 75%;">
            <div class="col-sm-12">
                <label class="col-sm-12 full">
                    {!! Form::label('fullpiece', '单品满件包邮:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    {!! Form::number('fullpiece', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;padding: 2px 36px;margin: 8px auto;','placeholder'=>'如果设置0或空，则不支持满件包邮']) !!}
                    
                    <!-- <span class="col-sm-2" style="margin: 8px auto;">单品满件包邮:</span>
                    <input type="number" class="form-group form-control col-sm-10"
                           style="width: 70%;padding: 2px 36px;margin: 8px auto;"
                           placeholder="如果设置0或空，则不支持满件包邮"/> -->
                </label>
                <label class="col-sm-12 full">
                    {!! Form::label('envelope', '单品满额包邮:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    {!! Form::number('envelope', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;padding: 2px 36px;margin: 8px auto;','placeholder'=>'如果设置0或空，则不支持满额包邮','step'=>'0.01']) !!}
                    
                   <!--  <span class="col-sm-2" style="margin: 8px auto;">单品满额包邮:</span>
                    <input type="number" class="form-group form-control col-sm-10"
                           style="width: 70%;padding: 2px 36px;margin: 8px auto;" step="0.01"
                           placeholder="如果设置0或空，则不支持满额包邮"/> -->
                </label>
                <label class="col-sm-12 full no_before">
                    {!! Form::label('freight', '运费设置:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    {!! Form::number('freight', null, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;padding-right: 36px;margin: 8px auto;']) !!}
                    
                    <!-- <span class="col-sm-2" style="margin: 8px auto;">运费设置:</span>
                    <input type="number" class="form-group form-control col-sm-10"
                           style="width: 70%;padding-right: 36px;margin: 8px auto;"/> -->
                </label>
                <div class="col-sm-12 ">
                    <span class="col-sm-2" style="margin: 8px auto;">所在地:</span>
                    <div class="col-sm-10 form-group" id="div-distpicker">
                        <div class="col-sm-5">
<!--                            <select name="city" class="form-control">-->
<!--                                <option name="city">请选择省份</option>-->
<!--                            </select>-->
                            {!! Form::select('province', [] , null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-5">
<!--                            <select name="country" class="form-control">-->
<!--                                <option name="country">请选择城市</option>-->
<!--                            </select>-->
                            {!! Form::select('city', [] , null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <label class="col-sm-12">
                    <!-- {!! Form::label('support', '支持收银台:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!} -->

                    <span class="col-sm-2" style="margin: 8px auto;">支持收银台:</span>
                    <label style="margin: 8px auto;">
                        <?php $support = $product->support??0; ?>
                        {!! Form::hidden('support',0,['id'=>'support1']) !!}
                        <input type="checkbox" name="support" id="support" value="1" {!! 1==$support?'checked':'' !!} />
                        {{--{!! Form::checkbox('support', 1,[1==$support?'checked':'']) !!}--}}
                        {!! Form::label('support', '支持:') !!}
                        <!-- <input type="checkbox" checked/><span>支持</span> -->
                    </label>
                </label>
                <label class="col-sm-12">
                    <span class="col-sm-2" style="margin: 8px auto;">货到付款:</span>
                    <label style="margin: 8px auto;">
                        <?php $cash = $product->cash??0; ?>
                        {!! Form::hidden('cash',0) !!}
                        <input type="checkbox" name="cash" id="cash" value="1" {!! 1==$cash?'checked':'' !!} />
                        {{--{!! Form::checkbox('cash', 1,[1==$cash?'checked':'']) !!}--}}
                        {!! Form::label('cash', '支持:') !!}
                        <!-- <input type="checkbox" checked/><span>支持</span> -->
                    </label>
                </label>
                <label class="col-sm-12">
                    <span class="col-sm-2" style="margin: 8px auto;">发票:</span>
                    <label style="margin: 8px auto;">
                        <?php $invoice = $product->invoice??0; ?>
                        {!! Form::hidden('invoice',0) !!}
                        <input type="checkbox" name="invoice" id="invoice" value="1" {!! 1==$invoice?'checked':'' !!} />
                        {{--{!! Form::checkbox('invoice', 1,[1==$invoice?'checked':'']) !!}--}}
                        {!! Form::label('invoice', '支持:') !!}
                        <!-- <input type="checkbox" checked/><span>支持</span> -->
                    </label>
                </label>
                <label class="col-sm-12">
                    <span class="col-sm-2" style="margin: 8px auto;">上架:</span>
                    <?php $status = $product->status??1; ?>
                    <label style="margin: 8px auto;">
                        <input type="radio" name="status" value='1' {!! $status == 1?'checked':'' !!} /><span>是</span>
                    </label>
                    <label style="margin: 8px auto;">
                        <input type="radio" name="status" value='2' {!! $status == 2?'checked':'' !!}/><span>否</span>
                    </label>
                    <label style="margin: 8px auto;">
                        <input type="radio" name="status" value='3' {!! $status == 3?'checked':'' !!}/><span>售罄</span>
                    </label>
                </label>
                <label class="col-sm-12" style="position: relative;">
                        <span class="col-sm-2" style="margin: 8px auto;">主商城搜索结果中
                            是否显示该商品:</span>
                    <div class="col-sm-10" style="padding: 0px;">
                        <?php $is_show_main = $product->is_show_main??1; ?>
                        <label style="margin: 8px auto;">
                            <input type="radio" name="is_show_main" value='1' {!! $is_show_main == 1?'checked':'' !!}/><span>是</span>
                        </label>
                        <label style="margin: 8px auto;">
                            <input type="radio" name="is_show_main" value='0' {!! $is_show_main == 0?'checked':'' !!}/><span>否</span>
                        </label>
                        <span style="margin: 20px 0px;padding: 0px;color: rgb(175, 172, 172);" class="col-sm-12">禁止后，在主商城搜索结果中，将不会显示该商品</span>
                    </div>
                </label>
                <label class="col-sm-12">
                    <span class="col-sm-2" style="margin: 8px auto;">是否支持退换货:</span>
                    <?php $is_back = $product->is_back??1; ?>
                    <label style="margin: 8px auto;">
                        <input type="radio" name="is_back" value='1' {!! $is_back == 1?'checked':'' !!}/><span>是</span>
                    </label>
                    <label style="margin: 8px auto;">
                        <input type="radio" name="is_back" value='0' {!! $is_back == 0?'checked':'' !!}/><span>否</span>
                    </label>
                </label>
                <label class="col-sm-12">
                    {!! Form::label('confirm', '确认收货时间:',['class' =>'col-sm-2','style' =>'margin: 8px auto;']) !!}
                    {!! Form::number('confirm', $product->confirm??7, ['class' => 'form-group form-control col-sm-10','style'=>'width: 70%;','placeholder'=>'默认为7天 -1为不自动收货']) !!}
                    
                    <!-- <span class="col-sm-2" style="margin: 8px auto;">确认收货时间:</span>
                    <input type="number" value="7" class="form-group form-control col-sm-10" style="width: 70%;"
                           placeholder="默认为7天 -1为不自动收货"/> -->
                </label>

            </div>
        </div>
    </div>

</div>
