<table class="table table-responsive" id="grades-table">
    <thead>
    <tr>
        <th>名称</th>
        <th>状态</th>
        <th>价格</th>
        <th colspan="3">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr>
        <td>{!! $product->name !!}</td>
        <td>{!! array_get(constants('CATE_STATUS'),$product->status) !!}</td>
        <td>{!! $product->price !!}</td>
        <td>
            {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
            <div class='btn-group'>

                <a href="{!! route('products.edit', ['id'=>$product->id,'search'=>6]) !!}" class='btn btn-default'><i
                            class="glyphicon glyphicon-edit"></i></a>
                {!! Form::hidden('search',6) !!}
                {!! Form::hidden('searchFields','type:=') !!}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}

            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@section('scripts')
<script>
</script>
@endsection