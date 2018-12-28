<table class="table table-responsive" id="grades-table">
    <thead>
        <tr>
            <th style="text-align:center" width="3%" height="50px"><input style="width: 25px;height: 25px;" type="checkbox"></th>
            <td colspan="5">
                <button data-id="2" onclick="javascript:status_change(this);" class="col-sm-3 btn btn-default" style="margin: 0px 16px;">删除</button>
            </td>
        </tr>
        <tr>
            <th style="text-align:center" width="3%" height="50px"></th>
            <th style="text-align:center" width="7%" height="50px">排序</th>
            <th style="text-align:center">商品</th>
            <th style="text-align:center" style="text-align:center">价格</th>
            <th style="text-align:center">库存</th>
            <th style="text-align:center">销量</th>
            <th style="text-align:center">状态</th>
            <th style="text-align:center" colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $v)
        <tr>
            <td style="text-align:center" width="3%" height="50px"><input style="width: 17px;height: 17px;" data-id="{!! $v->id !!}" type="checkbox"></td>
            <td style="text-align:center" width="7%" height="50px">{!! $loop->index+1 !!}</td>
            <?php $images = explode(',',$v->img_main??' '); ?>
            <td style="text-align:center" width="10%" height="50px">
                <span class="col-sm-3" style="width: 30%;"><img style="max-width: 55px;" src="/{!! $images[0]??'' !!}" /></span>
                <span class="col-sm-3" style="width: 60%;">{!! $v->name !!}</span></td>
            <td style="text-align:center" width="9%" height="50px">{!! $v->price !!}</td>
            <td style="text-align:center" width="8%" height="50px">{!! $v->qty !!}</td>
            <td style="text-align:center" width="5%" height="50px">{!! $v->sort !!}</td>
            <td style="text-align:center" width="8%" height="50px">{!! $v->status_str !!}/{!! $v->check_str !!}</td>
            <td style="text-align:center" width="10%" height="50px">
                {!! Form::open(['route' => ['products.destroy', $v->id], 'method' => 'delete']) !!}
                <input type="hidden" name="uri" value="{!! url()->full() !!}" />
                <div class='btn-group' style="display: flex;">
                    {{--<a href="{!! route('products.show', [$v->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('products.edit', ['id'=>$v->id,'uri'=>url()->full(),'search'=>request()->get('search',1)]) !!}"
                       class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确认删除吗?')"]) !!}
<!--                    <a href="javascript:void(0);" class="btn btn-primary"></a>-->
<!--                    <a href="javascript:void(0);" class="btn btn-primary"></a>-->
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<form action="/products.change" id="status_sub" style="display: none;" method="post">
    {{ csrf_field() }}
    <input type="text" name="uri" value="{!! url()->full() !!}" />
    <div id="status_change"></div>
</form>
@section('scripts')
<script>
    $("#grades-table thead input[type='checkbox']").eq(0).click(function(){
        $("#grades-table tbody input[type='checkbox']").prop('checked',$(this).prop('checked'));
    });
    function status_change(e){
        if ($("#grades-table thead input[type='checkbox']").eq(0).prop('checked')){
            $("#status_change").html("");
            if(1===$(e).data('id')) {
                $("#grades-table tbody input[type='checkbox']").each(function () {
                    $("#status_change").append('<input type="text" name="status[]" value="' + $(this).data("id") + '">');
                });
            }
            if(2===$(e).data('id')) {
                $("#grades-table tbody input[type='checkbox']").each(function () {
                    $("#status_change").append('<input type="text" name="deletes[]" value="' + $(this).data("id") + '">');
                });
            }
            if(3===$(e).data('id')) {
                $("#grades-table tbody input[type='checkbox']").each(function () {

                });
                return false;
            }
            $("#status_sub").submit();
        }
    }
</script>
@endsection