<table class="table table-responsive" id="barters-table">
    <thead>
        <tr>
            <th>换货单编号</th>
            <th>收货人</th>
            <th>下单用户</th>
            <th>状态</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($barters as $barter)
        <tr>
            <td>{!! $barter->number !!}</td>
            <td>{!! $barter->user_name !!}</td>
            <td>{!! $barter->user->id !!}</td>
            <td>{!! $barter->status_str !!}</td>
            <td>
                {!! Form::open(['route' => ['barters.destroy', $barter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('barters.show', [$barter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('barters.edit', [$barter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>