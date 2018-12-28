<table class="table table-responsive" id="brands-table">
    <thead>
        <tr>
            <th>标题</th>
            <th>内容</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr>
            <td>{!! $brand->title !!}</td>
            <td>{!! e($brand->simple_content) !!}</td>
            <td>{!! $brand->status_str !!}</td>
            <td>
                {!! Form::open(['route' => ['brands.destroy', $brand->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('brands.show', [$brand->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('brands.edit', [$brand->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>