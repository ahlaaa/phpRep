<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>商品</th>
            <th>類型</th>
            <th>买家</th>
            <th>支付/配送</th>
            <th>价格</th>
            <th>操作</th>
            <th>状态</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr style="background-color: #ccc;">
            <td colspan="7">
                <span class="col-sm-4">
                {!! date('Y年m月d日 H:i:s',strtotime($order->created_at)) !!}
                </span>
                <span class="col-sm-8">
                    订单编号:{!! $order->number !!}
                </span>
            </td>
        </tr>

        <tr>
            <?php $product = $order->product;$cates = $order->cates;$user = $order->user; ?>
            <td>
                <span class="col-sm-3"><img src="/{!! array_get(explode(',',$product->img_main??''),0) !!}" alt="无图片" title="商品首图" style="max-width: 75px;" !!} /></span>
                <span class="col-sm-5">{!! $product->name??'--' !!}</span>
                <span class="col-sm-3">
                    <span class="col-sm-12 clearfix">{!! $product->price??0 !!}</span>
                    <span class="col-sm-12 clearfix">X&nbsp;&nbsp;{!! sizeof($cates)>0?sizeof($cates):1 !!}</span>
                </span>
            </td>
            <td>{!! $order->otype_str !!}</td>
            <td>
                <label class="col-sm-12 clearfix">{!! $user->name??'--' !!}</label>
                <label class="col-sm-12 clearfix">{!! $user->telephone??'--' !!}</label>
            </td>

            <td>
                <label class="col-sm-12 clearfix">{!! $order->type_str??'--' !!}</label>
                <label class="col-sm-12 clearfix">{!! $order->delivery_str??'--' !!}</label>
            </td>
            <td>{!! $order->amount !!}</td>
            <td><a href="{!! route('orders.edit', [$order->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a></td>
            <td>
                <label class="col-sm-12 clearfix">
                    {!! $order->status_str !!}
                </label>
                {!! Form::open(['route' => ['orders.update', $order->id], 'method' => 'put','id'=>'delivery_submit'.$order->id]) !!}
                <label class='btn-group col-sm-12 clearfix'>
                    @if($order->status == 2)
                    {!! Form::hidden('status',3) !!}
                    {!! Form::hidden('delivery_type','3',['id'=>'delivery_type'.$order->id]) !!}
                    {!! Form::hidden('delivery_number','',['id'=>'delivery_number'.$order->id]) !!}
                    {!! Form::hidden('delivery_company','',['id'=>'delivery_company'.$order->id]) !!}
                    {!! Form::button('发货', ['type' => 'button', 'class' => 'btn btn-default','data-id'=>''.$order->id,'data-toggle'=>"modal",'onclick'=>'javascript:show_modal(this);']) !!}
                    @endif
                </label>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
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
    function submit1(){
        var id = $("#div-delivery").data('id');
        console.log(id);
        if (confirm('确认发货?')) {
            $("#delivery_number"+id).val($("#d_number").val());
            $("#delivery_company"+id).val($("#deliveryComp").val());
            $("#delivery_submit"+id).submit();
            $("#div-delivery").attr('data-id','');
            $("#div-delivery").modal('hide');
        }

    }
    function show_modal(e){
        $("#d_number").val("");
        $("#deliveryComp").val("安能快递");
        $("#div-delivery").attr('data-id',$(e).data('id'));
        $("#div-delivery").modal('show');
    }
</script>
@endsection