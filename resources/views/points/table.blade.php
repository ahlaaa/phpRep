<table class="table table-responsive" id="points-table">
    <thead>
        <tr>
            <th>Percentage</th>
        <th>Point</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($points as $point)
        <tr>
            <td>{!! $point->percentage !!}</td>
            <td>{!! $point->point !!}</td>
            <td>
                {!! Form::open(['route' => ['points.destroy', $point->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('points.show', [$point->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('points.edit', [$point->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>