<table class="table table-bordered" id="stores-table">
    <thead>
        <tr>
            <th>所属用户</th>
            <th>电话</th>
            <th>门店名称</th>
            <th>地址</th>
	    <th>预存款</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stores as $store)
        <tr>
            <td>{!! $store->user->name??null !!}</td>
            <td>{!! $store->telephone !!}</td>
            <td>{!! $store->name !!}</td>
            <td>{!!  $store->province . $store->city . $store->county . $store->address !!}</td>
	    <td>{!! $store->balance !!}</td>
            <td>{!! $store->status_str !!}</td>
            <td>
                {!! Form::open(['route' => ['stores.destroy', $store->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('stores.show', [$store->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('stores.edit', [$store->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>