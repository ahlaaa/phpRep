<!-- 维权进度 -->
<div class="form-group col-sm-12">
    <?php
        $status = constants('MAINTAIN_STATUS');
        if($maintain->type == 1){
            $status1 = [array_get($status,2),array_get($status,3)];
            $status = array_diff($status,$status1);
        }
    ?>
    @foreach($status as $k=>$v)
    @if(0 == $loop->index)
    <span class="form-control col-sm-2 {!! ($maintain->status >= $k)?'in-status':'' !!}" style="width: 9%;border-radius: 50%;height: 66.78px;text-align: center;padding: 20px 0px;overflow: hidden;">
                {!! $v !!}
            </span>

    @else
    <span>
                <input type="text" class="form-control col-sm-2 {!! ($maintain->status >= $k)?'in-status':'' !!}" style="margin-top: 27px;width: 7%;height: 12px;border: 0px;border-top: 0.5px solid #ccc;border-bottom: 0.5px solid #ccc;" />
            </span>
    <span class="form-control col-sm-2 {!! ($maintain->status >= $k)?'in-status':'' !!}" style="width: 9%;border-radius: 50%;height: 66.78px;text-align: center;padding: 20px 0px;overflow: hidden;">{!! $v !!}</span>
    @endif
    @endforeach
</div>
<?php $order = $maintain->order;$user = $maintain->user;$m_cates = $maintain->cates; ?>
<div class="col-sm-12 form-group">
    <div class="col-sm-4" style="border: 0.5px solid #ccc;height: 100%;padding: 35px 6px;">
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>维权类型</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->type_str !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>退款金额</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->re_amount !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>维权原因</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->reason !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>维权说明</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->comments !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>维权编号</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->number !!}</span>
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
                <span>订单金额</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->o_amount !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>买家</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->user->name !!}</span>
            </div>
        </label>
        <label class="col-sm-12 form-group">
            <div class="col-sm-3">
                <span>付款方式</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $order->created_at !!}</span>
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
    </div>
    <div class="col-sm-4" style="border: 0.5px solid #ccc;height: 100%;padding: 35px 6px;">
        <label class="col-sm-12 form-group">
            <div class="col-sm-3" style="padding: 0px;">
                <span>维权状态</span>
            </div>
            <div class="col-sm-9">
                <span>{!! $maintain->status_str !!}</span>
            </div>
        </label>
        <div class="form-group col-sm-12">
            {{--{!! Form::open(['route' => ['orders.update', $order->id], 'method' => 'put','id'=>'a_submit']) !!}--}}
            @if(!in_array($maintain->status,[4,5]))
            <span class="col-sm-12">

                <label class='btn-group col-sm-12 clearfix'>
                    {!! Form::hidden('status',4) !!}
                    {!! Form::button('退货/退款', ['type' => 'submit', 'class' => 'btn btn-default', 'data-toggle'=>"modal", 'onclick'=>"javascript:alert('确认已退货/退款'):"]) !!}
                </label>

            </span>
            @endif
            {{--{!! Form::close() !!}--}}
        </div>
        <div class="form-group col-sm-12">
            <span class="text-gray">提示</span>
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    <h2>
        <p class="form-control col-sm-12" style="border: none;">
            <span class="text-black">订单商品信息</span>
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
            <?php $cates =  sizeof($order->cates)>1?$order->cates:(isset($order->product)?[$order->product]:[]); ?>
            @foreach($cates as $cate)
            <tr>
                <td>
                    <label style="margin: 25px auto;">
                        <!--                            <span class="col-sm-7">-->
                        <img src="/{!! array_get(explode(',',isset($cate->product->img_main)?$cate->product->img_main:($cate->img_main??'')),0) !!}" title="商品首图" style="max-width: 95px;" />
                        <!--                            </span>-->
                        <span class="text-gray">
                                {!! isset($cate->product->name)?$cate->product->name:($cate->name??'--') !!}
                            </span>
                    </label>
                </td>
                <td>
                    <label class="form-group col-sm-10">
                        <label>规格:</label>
                        <label>{!! isset($cate->pivot->remark)?$cate->pivot->remark:'默认' !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>编码:</label>
                        <label>{!! isset($cate->product->code)?$cate->product->code:($cate->code??'') !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>条码:</label>
                        <label>{!! isset($cate->product->bar)?$cate->product->bar:($cate->bar??'') !!}</label>
                    </label>
                </td>
                <td>{!! '￥'.(isset($cate->product->price)?$cate->product->price:($cate->price??'') ) !!}</td>
                <td>{!! isset($cate->pivot->qty)?$cate->pivot->qty:$order->qty !!}</td>
                <td>{!! '￥'.isset($cate->product->oprice)?$cate->product->oprice:($cate->oprice??'') !!}</td>
                <td>{!! '￥'.isset($cate->pivot->price)?$cate->pivot->price:($order->amount??0) !!}</td>
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
                    <label class="col-sm-12">
                        <label class="col-sm-3 pull-right form-group">
                            <span class="col-sm-7">会员折扣:</span>
                            <span class="text-danger col-sm-5">-￥{!! $order->vip_sales !!}</span>
                        </label>
                    </label>
                    <label class="col-sm-12">
                        <label class="col-sm-3 pull-right form-group">
                            <span class="col-sm-7">会员卡优惠:</span>
                            <span class="text-danger col-sm-5">-￥{!! $order->vip_card_sales !!}</span>
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
@if($maintain->type == 2)
<div class="form-group col-sm-12">
    <h2>
        <p class="form-control col-sm-12" style="border: none;">
            <span class="text-black">换货商品信息</span>
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
            <?php $cates =  sizeof($m_cates)>1?$m_cates:(isset($maintain->product)?[$maintain->product]:[]); ?>
            @foreach($cates as $cate)
            <tr>
                <td>
                    <label style="margin: 25px auto;">
                        <!--                            <span class="col-sm-7">-->
                        <img src="/{!! array_get(explode(',',isset($cate->product->img_main)?$cate->product->img_main:($cate->img_main??'')),0) !!}" title="商品首图" style="max-width: 95px;" />
                        <!--                            </span>-->
                        <span class="text-gray">
                                {!! isset($cate->product->name)?$cate->product->name:($cate->name??'--') !!}
                            </span>
                    </label>
                </td>
                <td>
                    <label class="form-group col-sm-10">
                        <label>规格:</label>
                        <label>{!! isset($cate->pivot->remark)?$cate->pivot->remark:'默认' !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>编码:</label>
                        <label>{!! isset($cate->product->code)?$cate->product->code:($cate->code??'') !!}</label>
                    </label>
                    <label class="form-group col-sm-10">
                        <label>条码:</label>
                        <label>{!! isset($cate->product->bar)?$cate->product->bar:($cate->bar??'') !!}</label>
                    </label>
                </td>
                <td>{!! '￥'.(isset($cate->product->price)?$cate->product->price:($cate->price??'') ) !!}</td>
                <td>{!! isset($cate->pivot->qty)?$cate->pivot->qty:$order->qty !!}</td>
                <td>{!! '￥'.isset($cate->product->oprice)?$cate->product->oprice:($cate->oprice??'') !!}</td>
                <td>{!! '￥'.isset($cate->pivot->price)?$cate->pivot->price:($order->amount??0) !!}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@endif
<div class="form-group col-sm-12">
    <a href="{!! route('maintains.index') !!}" class="btn btn-default">返回</a>
</div>
@section('css')
<style>
    .in-status{
        background-color: #00c1de;
    }
</style>
@endsection