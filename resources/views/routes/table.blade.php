<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>价格</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($routes as $route)
        <tr>
            <td>{!! optional($route)->name !!}</td>
            <td>{!! optional($route)->price !!}</td>
            <td>
                {!! Form::open(['route' => ['routes.destroy', $route->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('saplings.show', [$sapling->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('routes.edit', [$route->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>