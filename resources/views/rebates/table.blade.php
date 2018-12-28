

<table class="table table-responsive" id="rebates-table">
    <thead>
    <tr>
        <th>获得金额</th>
        <th>用户</th>
        <th>订单</th>
        <th>下单人</th>
        <th>类型</th>
        <th>备注</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
    <?php  ?>
    @foreach($rebates as $rebate)
    <tr>
        <td>{!! $rebate->amount??null !!}</td>
        <td>{!! optional($rebate->user)->name??null !!}</td>
        <td>{!! optional($rebate->order)->number??null !!}</td>
        <td>{!! optional(app(\App\Models\User::class)->where("id",$rebate->order->user_id??null)->first())->name !!}</td>
        <td>{!! $rebate->type_str??null !!}</td>
        <td>{!! $rebate->remark??null !!}</td>
        <td>{!! $rebate->created_at??null !!}</td>
    </tr>
    @endforeach
    </tbody>
</table>