<table class="table table-bordered" id="withdraws-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>金额</th>
            <th>用户昵称</th>
            <th>用户返利余额</th>
<th>提现方式</th>
<th>账户名</th>
<th>帐号</th>
<th>银行</th>

            <th>备注</th>
            <th>状态</th>
            <th>申请时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($withdraws as $withdraw)
        <tr>
            <td>{!! $withdraw->id !!}</td>
            <td>{!! $withdraw->amount !!}</td>
            <td>{!! $withdraw->user->name !!}</td>
            <td>{!! $withdraw->user->rebate !!}</td>
<td>{!! $withdraw->type_str !!}</td>
<td>{!! $withdraw->username !!}</td>
<td>{!! $withdraw->account !!}</td>
<td>{!! $withdraw->bank !!}</td>
            <td>{!! $withdraw->remark !!}</td>
            <td>{!! $withdraw->status_str !!}</td>
            <td>{!! $withdraw->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['withdraws.destroy', $withdraw->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('withdraws.show', [$withdraw->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('withdraws.edit', [$withdraw->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>