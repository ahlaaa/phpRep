<table class="table table-responsive" id="expresses-table">
    <thead>
        <tr>
            <th>Code</th>
        <th>Name</th>
        <th>Letter</th>
        <th>Tel</th>
        <th>Status</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($expresses as $express)
        <tr>
            <td>{!! $express->code !!}</td>
            <td>{!! $express->name !!}</td>
            <td>{!! $express->letter !!}</td>
            <td>{!! $express->tel !!}</td>
            <td>{!! $express->status !!}</td>
            <td>
                {!! Form::open(['route' => ['expresses.destroy', $express->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('expresses.show', [$express->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('expresses.edit', [$express->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗？')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>