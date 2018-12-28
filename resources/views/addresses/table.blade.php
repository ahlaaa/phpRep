<table class="table table-responsive" id="addresses-table">
    <thead>
        <tr>
            <th>id</th>
            <th>省份</th>
            <th>市</th>
            <th>县</th>
            <th>街道</th>
            <th>用户名</th>
            <th>收货人</th>
            <th>联系电话</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($addresses as $address)
        <tr>
            <td>{!! $address->id !!}</td>
            <td>{!! $address->province !!}</td>
            <td>{!! $address->city !!}</td>
            <td>{!! $address->county !!}</td>
            <td>{!! $address->street !!}</td>
            <td>{!! $address->user->name??null !!}</td>
            <td>{!! $address->consignee !!}</td>
            <td>{!! $address->telephone !!}</td>
            <td>
                {!! Form::open(['route' => ['addresses.destroy', $address->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('addresses.show', [$address->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('addresses.edit', [$address->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>