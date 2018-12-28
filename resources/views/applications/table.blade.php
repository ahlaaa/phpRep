<table class="table table-responsive" id="articles-table">
    <thead>
    <tr>
        <th>用户</th>
        <th>是否免费申请</th>
        <th>订单号</th>
        <th>订单状态</th>
        <th>申请等级</th>
        <th>申请状态</th>
        <th colspan="3">操作</th>
    </tr>
    </thead>
    <?php  ?>
    <tbody>
    @foreach($applications as $application)
    <tr>
        <td>{!! $application->user->name??'' !!}</td>
        <td>{!! constants('USE_CHANCE')[$application->use_chance] !!}</td>
        <td>{!! optional($application->order)->number??'' !!}</td>
        <td>{!! optional($application->order)->status_str??'' !!}</td>
        <td>{!! $application->level??'' !!}级代理商</td>
        <td>{!! constants('APPLICATION_STATUS')[$application->status??1] !!}</td>
        <td>
            {!! Form::open(['route' => ['applications.destroy', $application->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('applications.edit', [$application->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗？')"]) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div class='model_1'
     style="background-color: #ccc;overflow:auto;border:1px solid #ccc;position:fixed;left:30%;top:62px;height:85%;width: 669px;display:none;">
    <div style="position:absolute;right: 6px;font-size: 2em;color:red;opacity:0.4;" class='model_1_hide'>x</div>
    <div class='model_1_content'></div>
</div>
@section('scripts')
<script>

    function show(id) {
        $.each(list.data, function (k, v) {
            if (v.id == id) {
                $(".model_1").show();
                if (!v.content) {
                    $(".model_1_content").html("<h1><center>暂无内容</center></h1>");
                } else {
                    $(".model_1_content").html(v.content);
                }

            }
        });
    }

    $('.model_1_hide').click(function () {
        $(".model_1").hide();
        $(".model_1_content").html("");
    });
    $(document).mouseup(function (e) {
        var con = $(".model_1");   // 设置目标区域
        if (!con.is(":hidden")) {
            if (!con.is(e.target) && con.has(e.target).length === 0) {
                con.hide();
                $(".model_1_content").html("");
            }
        }
    })
</script>
@endsection