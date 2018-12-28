<table class="table table-responsive" id="administrators-table">
    <thead>
        <tr>
            <th>用户名</th>
            <th>类型</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($administrators as $administrator)
        <tr>
            <td>{!! $administrator->username !!}</td>
            <td>{!! $administrator->type_str !!}</td>
            <td>
                {!! Form::open(['route' => ['administrators.destroy', $administrator->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('administrators.edit', [$administrator->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="{!! route('administrators.password', [$administrator->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-lock"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>