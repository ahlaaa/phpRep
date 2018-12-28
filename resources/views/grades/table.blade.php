<table class="table table-responsive" id="grades-table">
    <thead>
        <tr>
            <th>等级</th>
            <th>等级名称</th>
            <th>折扣</th>
            <th>升级条件</th>
            <th>状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($grades as $grade)
        <tr>
            <td>{!! $grade->level !!}</td>
            <td>{!! $grade->name !!}</td>
            <td>{!! $grade->sales !!}</td>
            <td>{!! $grade->level==1?'默认等级':'完成订单金额满&nbsp&nbsp'.$grade->amount.'&nbsp&nbsp元' !!}</td>
            <td>{!! array_get(constants('GRADE_STATUS'),$grade->status) !!}</td>
            <td>
                {!! Form::open(['route' => ['grades.destroy', $grade->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('grades.show', [$grade->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
<!--                    <a href="javascript:void(0);" class='btn btn-default' title="查看用户"><i class="glyphicon glyphicon-edit"></i></a>-->
                    <a href="{!! route('grades.edit', [$grade->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    @if($grade->level != 1)
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                    @endif
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