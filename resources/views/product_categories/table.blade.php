<table class="table table-responsive" id="productCategories-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>是否置项</th>
            <th>级别</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productCategories as $productCategory)
        <tr>
            <td>{!! $productCategory->title !!}</td>
            <td>{!! $productCategory->is_top ? '是' : '否' !!}</td>
            <td>{!! $productCategory->pid === 0  ? '一级分类' : '二级分类' !!}</td>
            <td>
                {!! Form::open(['route' => ['productCategories.destroy', $productCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('productCategories.show', [$productCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('productCategories.edit', [$productCategory->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>