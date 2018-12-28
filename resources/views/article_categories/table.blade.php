<table class="table table-responsive" id="articleCategories-table">
    <thead>
        <tr>
            <th>序号</th>
            <th>分类名称</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($articleCategories as $articleCategory)
        <tr>
            <td>{!! $articleCategory->id !!}</td>
            <td>{!! $articleCategory->title !!}</td>
            <td>
                {!! Form::open(['route' => ['articleCategories.destroy', $articleCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('articleCategories.show', [$articleCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('articleCategories.edit', [$articleCategory->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                   {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>