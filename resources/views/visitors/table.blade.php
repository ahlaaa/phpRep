<table class="table table-responsive" id="visitors-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>昵称</th>
            <th>Openid</th>
            <th>访问时间</th>
            {{--<th colspan="3">操作</th>--}}
        </tr>
    </thead>
    <tbody>
    @foreach($visitors as $visitor)
        <tr>
            <td>{!! $visitor->id !!}</td>
            <td>{!! $visitor->nickname !!}</td>
            <td>{!! $visitor->openid !!}</td>
            <td>{!! $visitor->created_at !!}</td>
            {{--<td>--}}
                {{--{!! Form::open(['route' => ['visitors.destroy', $visitor->id], 'method' => 'delete']) !!}--}}
                {{--<div class='btn-group'>--}}
                    {{--<a href="{!! route('visitors.show', [$visitor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    {{--<a href="{!! route('visitors.edit', [$visitor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>