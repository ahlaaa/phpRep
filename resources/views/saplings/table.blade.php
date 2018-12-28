<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>名称</th>
            <th>类型</th>
            <th>状态</th>
            <th>订单号</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($saplings as $sapling)
        <tr>
            <td>{!! optional($sapling->user)->name !!}</td>
            <td>{!! optional($sapling->product)->name !!}</td>
            <td>{!! $sapling->type_str !!}</td>
            <td>{!! $sapling->status_str !!}</td>
            <td>{!! $sapling->order_number !!}</td>
            <td>
                {!! Form::open(['route' => ['saplings.destroy', $sapling->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('saplings.show', [$sapling->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('saplings.edit', [$sapling->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>