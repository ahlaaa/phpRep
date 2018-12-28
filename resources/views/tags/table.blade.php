<div class="col-sm-12">
    <table class="table">
        <thead>
        <tr>
            <td>标签名称</td><td>会员数</td>
            <td>标签描述</td><td colspan="3">操作</td>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{!! $tag->name !!}</td><td>{!! $tag->users->count(1)??0 !!}</td>
                <td>{!! $tag->contents !!}</td>
                <td>
                    {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                        <a alt="用户" title="用户" href="javascript:void(0);" class='btn btn-default '><i class="glyphicon glyphicon-edit"></i></a>
                        <a alt="添加" title="添加" href="javascript:void(0);" class='btn btn-default'><i class="glyphicon glyphicon-lock"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>