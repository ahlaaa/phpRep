<!-- 订单进度 -->
<div class="form-group col-sm-12">
    <?php $status = constants('ORDER_STATUS');$order = $order??null; ?>
    @foreach($status as $k=>$v)
        @if(0 == $loop->index)
            <span class="form-control col-sm-2 {!! ($order->status >= $k)?'in-status':'' !!}" style="width: 9%;border-radius: 50%;height: 66.78px;text-align: center;padding: 20px 0px;overflow: hidden;">
                {!! $v !!}
            </span>

        @else
            <span>
                <input type="text" class="form-control col-sm-2 {!! ($order->status >= $k)?'in-status':'' !!}" style="margin-top: 27px;width: 7%;height: 12px;border: 0px;border-top: 0.5px solid #ccc;border-bottom: 0.5px solid #ccc;" />
            </span>
            <span class="form-control col-sm-2 {!! ($order->status >= $k)?'in-status':'' !!}" style="width: 9%;border-radius: 50%;height: 66.78px;text-align: center;padding: 20px 0px;overflow: hidden;">{!! $v !!}</span>
        @endif
    @endforeach
</div>
<div class="col-sm-12 form-group">
    <div class="col-sm-4" style="border: 0.5px solid #ccc;height: 100%;padding: 35px 6px;">
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>订单类型</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->otype_str !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>订单编号</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->number !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>付款方式</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->type_str !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>买家</span>
            </div>
            <div class="col-sm-9">
                <span>{!! optional($order->user)->name??'' !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>配送方式</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->delivery_str??'--' !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>收货人</span>
            </div>
            <div class="col-sm-9" style="padding: 0px;">
                <textarea id="address_copy" class="col-sm-10" style="width: 75%;resize: none!important;border: none!important;background-color: inherit!important;" disabled>{!! (optional($order->address)->location??'--').'&nbsp;&nbsp;&nbsp;&nbsp;'.(optional($order->address)->consignee??'--') !!}</textarea>
                <span class="col-sm-2 btn btn-primary" style="width: 23%;margin-top: 5px;" onclick="javascript:copyUrl2();">复制</span>
            </div>
        </label>
    </div>
    <div class="col-sm-4" style="border: 0.5px solid #ccc;height: 100%;padding: 35px 6px;">
        <label class="col-sm-12 form-group">
            <div class="col-sm-3" style="padding: 0px;">
                <span>订单状态</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->status_str !!}</span>
            </div>
        </label>
        @if(isset($order->route_id))
        <div class="form-group col-sm-12">
        </div>
        @endif
        <div class="form-group col-sm-12">
            @if($order->status >= 2)
            <div class="col-sm-12 clearfix text-danger" style="font-size: 22px;margin: 9px;">
                {!! $order->delivery_company !!}
            </div>
            <div class="col-sm-12 clearfix text-danger" style="font-size: 22px;margin: 9px;">{!! $order->delivery_number !!}</div>
            @endif
            {{--{!! Form::open(['route' => ['orders.update', $order->id], 'method' => 'put','id'=>'a_submit']) !!}--}}
            @if($order->status == 2)
            <span class="col-sm-12">

                <label class='btn-group col-sm-12 clearfix'>
                    {{--{!! Form::hidden('type',3) !!}--}}
                    {!! Form::hidden('status',3) !!}
                    {!! Form::hidden('delivery_type',3) !!}
                    {!! Form::hidden('delivery_number','',['id'=>'delivery_number']) !!}
                    {!! Form::hidden('delivery_company','',['id'=>'delivery_company']) !!}
                    {!! Form::button('发货', ['type' => 'button', 'class' => 'btn btn-default', 'data-toggle'=>"modal", 'data-target'=>"#div-delivery"]) !!}
                </label>

            </span>
            @endif
            {{--{!! Form::close() !!}--}}
        </div>
        <div class="form-group col-sm-12">
            <span class="text-gray">提示</span>
        </div>
    </div>
    <div class="col-sm-4" style="border: 0.5px solid #ccc;height: 100%;padding: 35px 6px;">
        <label class="col-sm-12 form-group">
            <span class="text-blue">{!! isset($order->user->grade->name)?$order->user->grade->name:'--' !!}</span>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3" style="padding: 0px;">
                <span>姓名</span>
            </div>
            <div class="col-sm-9">
                <span>{!! optional($order->user)->name??'' !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3" style="padding: 0px;">
                <span>手机号</span>
            </div>
            <div class="col-sm-9">
                <span>{!! optional($order->user)->telephone??'' !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3" style="padding: 0px;">
                <span>佣金</span>
            </div>
            <div class="col-sm-9">
                <span>0</span>
            </div>
        </label>
    </div>
</div>
<div class="form-group col-sm-12">
    <h2>
        <p class="form-control col-sm-12" style="border: none;">
            <span class="text-black">商品信息</span>
        </p>
    </h2>
    <div class="col-sm-12 form-group">
        <table class="table">
            <thead>
                <tr>
                    <th>商品标题</th>
                    <th>规格/编码/条码</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>原价</th>
                    <th>折扣后</th>
                </tr>
            </thead>
            <tbody>
            <?php $cates =  sizeof($order->cates)>0?$order->cates:(isset($order->product)?[$order->product]:[]); ?>
            @foreach($cates as $cate)
            <tr>
                <td>
                    <label style="margin: 25px auto;">
                        <img src="/{!! array_get(explode(',',isset($cate->product->img_main)?$cate->product->img_main:($cate->img_main??'')),0) !!}" title="商品首图" style="max-width: 95px;" />
                        <span class="text-gray">
                                {!! isset($cate->product->name)?$cate->product->name:(optional($cate)->name??'--') !!}
                            </span>
                    </label>
                </td>
                <td>
                    <label class="form-group col-sm-10">
                        <label>规格:</label>
                        <label>{!! isset($cate->product->remark)?$cate->product->remark:'默认' !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>编码:</label>
                        <label>{!! isset($cate->product->code)?$cate->product->code:(optional($cate)->code??'') !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>条码:</label>
                        <label>{!! isset($cate->product->bar)?$cate->product->bar:(optional($cate)->bar??'') !!}</label>
                    </label>
                </td>
                <td>{!! '￥'.(isset($cate->product->price)?optional($cate->product)->price:(optional($cate)->price??'') ) !!}</td>
                <td>{!! isset($cate->product->qty)?optional($cate->product)->qty:$order->qty !!}</td>
                <td>{!! '￥'.isset($cate->product->oprice)?optional($cate->product)->oprice:(optional($cate)->oprice??'') !!}</td>
                <td>{!! '￥'.isset($cate->product->price)?optional($cate->product)->price:($order->amount??0) !!}</td>
            </tr>
            @endforeach
                <tr>
                    <td colspan="6" class="" style="position: relative;">
                        <label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">商品小计:</span>
                                <span class="col-sm-5">￥{!! $order->pre_amount !!}</span>
                            </label>
                        </label>
                        <label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">运费:</span>
                                <span class="col-sm-5">￥{!! $order->send_fee !!} </span>
                            </label>
                        </label>
                        <!--                        <label class="col-sm-12">-->
                        <!--                            <label class="col-sm-3 pull-right form-group">-->
                        <!--                                <span class="col-sm-7">会员折扣/优惠:</span>-->
                        <!--                                <span class="text-danger col-sm-5">-￥{!! $order->vip_sales !!}</span>-->
                        <!--                            </label>-->
                        <!--                        </label>-->
                        <label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">会员卡优惠/消费券抵扣:</span>
                                <span class="text-danger col-sm-5">-￥{!! $order->vip_card_sales !!}</span>
                            </label>
                        </label><label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">余额抵扣:</span>
                                <span class="text-danger col-sm-5">-￥{!! $order->coupon_reduce !!}</span>
                            </label>
                        </label>
                        <label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">优惠:</span>
                                <span class="text-danger col-sm-5">￥{!! $order->vip_sales !!}</span>
                            </label>
                        </label>
                        <label class="col-sm-12">
                            <label class="col-sm-3 pull-right form-group">
                                <span class="col-sm-7">实付款:</span>
                                <span class="col-sm-5">￥{!! $order->amount !!}</span>
                            </label>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="form-group col-sm-12">
    <a href="{!! route('orders.index') !!}" class="btn btn-default">返回</a>
</div>
<div class="modal fade" id="div-delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="divDeliveryLabel">
                    发货单
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递公司:</label>
                    {!! Form::select('delivery_company', app(\App\Models\Express::class)->get()->pluck('name','name'), $order->delivery_company ?? "申通", ['class' =>
                    'form-control', 'id' => 'deliveryComp']) !!}
                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递单号:</label>
                    {!! Form::text('delivery_number', $order->delivery_number ?? null, ['class' => 'form-control',
                    'placeholder' => "请输入快递单号",'id'=>'d_number']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary" id="btn-delivery"
                        onclick="javascript:submit1();">
                    提交更改
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@section('scripts')
<script>
    console.log({!! json_encode(optional($order)->test) !!});
    function submit1(){
        if (confirm('确认发货?')) {
            $("#delivery_number").val($("#d_number").val());
            $("#delivery_company").val($("#deliveryComp").val());
            $("#a_submit").submit();
        }

    }
    console.log({!! json_encode($order) !!});
    function copyUrl2()
    {
        var Url2=document.getElementById("address_copy");//.innerText;
        // var oInput = document.createElement('input');
        // oInput.value = Url2;
        // document.body.appendChild(oInput);
        Url2.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        console.log(Url2);
        // oInput.className = 'oInput';
        // oInput.style.display='none';
        alert('复制成功');
    }
</script>
@endsection
@section('css')
<style>
    .in-status{
        background-color: #00c1de;
    }
</style>
@endsection
