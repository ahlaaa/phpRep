<table class="table table-responsive" id="accountFlows-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>类型</th>
            <th>金额</th>
            <th>时间</th>
            {{--<th colspan="3">操作</th>--}}
        </tr>
    </thead>
    <tbody>
    @foreach($accountFlows as $accountFlow)
        <tr>
            <td>{!! $accountFlow->user->name !!}</td>
            <td>{!! $accountFlow->type_str !!}</td>
            <td>{!! $accountFlow->amount !!}</td>
            <td>{!! $accountFlow->created_at !!}</td>
            {{--<td>--}}
                {{--{!! Form::open(['route' => ['accountFlows.destroy', $accountFlow->id], 'method' => 'delete']) !!}--}}
                {{--<div class='btn-group'>--}}
                    {{--<a href="{!! route('accountFlows.show', [$accountFlow->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    {{--<a href="{!! route('accountFlows.edit', [$accountFlow->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>