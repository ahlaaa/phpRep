<table class="table table-responsive" id="orders-table">
    <thead>
    <tr>
        <th>商品</th>
        <th>买家</th>
        <th>支付/配送</th>
        <th>价格</th>
        <th>操作</th>
        <th>类型</th>
        <th>状态</th>
    </tr>
    </thead>
    <tbody>
    @foreach($maintains as $maintain)
    <?php $order = $maintain->order; ?>
    <tr style="background-color: #ccc;">
        <td colspan="7">
                <span class="col-sm-4">
                {!! date('Y年m月d日 H:i:s',strtotime($maintain->created_at)) !!}
                </span>
            <span class="col-sm-8">
                    订单编号:{!! $maintain->number !!}
                </span>
        </td>
    </tr>
    <tr>
        <?php $product = $order->product;$cates = $order->cates;$user = $maintain->user; ?>
        <td>
            <span class="col-sm-3"><img src="/{!! array_get(explode(',',$product->img_main??''),0) !!}" alt="无图片" title="商品首图" style="max-width: 75px;" !!} /></span>
            <span class="col-sm-5">{!! $product->name??'--' !!}</span>
            <span class="col-sm-3">
                    <span class="col-sm-12 clearfix">{!! $product->price??0 !!}</span>
                    <span class="col-sm-12 clearfix">X&nbsp;&nbsp;{!! sizeof($cates)>0?sizeof($cates):1 !!}</span>
                </span>
        </td>
        <td>
            <label class="col-sm-12 clearfix">{!! $user->name??'--' !!}</label>
            <label class="col-sm-12 clearfix">{!! $user->telephone??'--' !!}</label>
        </td>
        <td>
            <label class="col-sm-12 clearfix">{!! $order->type_str??'--' !!}</label>
            <label class="col-sm-12 clearfix">{!! $order->delivery_str??'--' !!}</label>
        </td>
        <td>{!! $order->amount !!}</td>
        <td><a href="{!! route('maintains.edit', [$maintain->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a></td>
        <td>{!! $maintain->type_str !!}</td>
        <td>
            <label class="col-sm-12 clearfix">
                {!! $maintain->status_str !!}
            </label>
            {!! Form::open(['route' => ['maintains.update', $maintain->id], 'method' => 'put']) !!}
            <label class='btn-group col-sm-12 clearfix'>
                @if(!in_array($maintain->status,[4,5]))
                {!! Form::hidden('status',4) !!}
                {!! Form::button('退款/换货', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('确定退货/退款吗？')"]) !!}
                @endif
            </label>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
<script>
    console.log({!! json_encode($maintains) !!})
</script>
@endsection