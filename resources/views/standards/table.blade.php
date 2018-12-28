<table class="table table-responsive" id="standards-table">
    <thead>
        <tr>
            <th>产品名称</th>
            <th>规格型号</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($standards as $standard)
        <tr>
            <td>{!! $standard->product->name !!}</td>
            <td>{!! $standard->name !!}</td>
            <td>
                {!! Form::open(['route' => ['standards.destroy', $standard->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('standards.show', [$standard->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('standards.edit', [$standard->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>