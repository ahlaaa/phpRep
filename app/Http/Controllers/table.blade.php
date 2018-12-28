<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">请选择导出方式</h4>
            </div>
            <div class="modal-body" style="padding-left:30px;">
				<label class="radio">
					<input type="radio" name="optionsRadiosinline" id="optionsRadios1" value="1" checked> 导出当前列表待发货订单快递单
				</label>
				<label class="radio">
					<input type="radio" name="optionsRadiosinline" id="optionsRadios2" value="2"> 导出当前列表全部订单快递单
				</label>
				<label class="radio">
					<input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="3"> 导出当日全部订单快递单
				</label>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="excelOut">确认导出</button>
            </div>
        </div>
    </div>

</div>
<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>订单编号</th>
            <th>金额</th>
            <th>状态</th>
            <th>下单人</th>
            <th>下单时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{!! $order->number??null !!}</td>
            <td>{!! $order->amount??null !!}</td>
            <td>{!! $order->status_str??null !!}</td>
            <td>{!! $order->user->name??null !!}</td>
            <td>{!! $order->created_at??null !!}</td>
            <td>
                {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('orders.show', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('orders.edit', [$order->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                    @if($order->status == 2)
                    <button type="button" onclick="javascript:show_model({{ $order->id }});">发货
                    </button>
                    @endif
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@foreach($orders as $order)
<div class="modal fade" id="div-delivery{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="divDeliveryLabel">
                    发货单
                </h4>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('delivery_company', '手机号码:') !!}
                {!! Form::text(
                'telephone',
                app(\App\Models\Address::class)->where('id', $order->address_id)->get()->pluck('telephone')[0]??null,
                ['class' => 'form-control', 'disabled']) !!}
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('delivery_company', '详细地址:') !!}
                {!! Form::text(
                'address_id',
                app(\App\Models\Address::class)->where('id', $order->address_id)->get()->pluck('location')[0]??null,
                ['class' => 'form-control', 'disabled']) !!}
            </div>
            {!! Form::model($order, ['route' => ['orders.update', $order->id], 'method' =>
            'patch','id'=>'form'.$order->id]) !!}
            <input type="hidden" name="status" value="3"/>
            <div class="modal-body">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递公司:</label>
                    {!! Form::select('delivery_company', app(\App\Models\Express::class)->get()->pluck('name','id'), $order->delivery_company ?? "申通", ['class' =>
                    'form-control', 'id' => 'deliveryComp']) !!}
                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <label for="status">快递单号:</label>
                    {!! Form::text('delivery_number', $order->delivery_number ?? null, ['class' => 'form-control',
                    'placeholder' => "请输入快递单号"]) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary" id="btn-delivery"
                        onclick="javascript:submit1({{ $order->id }});">
                    提交更改
                </button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@endforeach
@section('scripts')
<script>
var tableDatasss = <?php echo json_encode($orders); ?>;
var tableDatabbb = tableDatasss.data;
console.log(tableDatabbb);

function submit1(id) {
    console.log(id);
    if (confirm('即将发货')) {
        $("#form" + id).submit();
    }
    return false;
}
function show_model(id) {
    for (var i = 0; i < tableDatabbb.length; i++) {
        if (tableDatabbb[i].id == id && tableDatabbb[i].status_str == "待发货") {//|| tableDatabbb[i].status_str == "已取消")
            console.log(id);
            $('#div-delivery' + id).modal();
        } else if (tableDatabbb[i].id == id) {
            alert(tableDatabbb[i].status_str);
        }
    }
}
var tableData = [];
$('#excelOut').click(function () {
    var typess = $("[name='optionsRadiosinline']:checked").val(),c_flag = [];
    console.log(typess);
    for(var i = 0 ; i < tableDatabbb.length; i++){
        if(typess == 1 && eval(tableDatabbb[i].status) == 2){
            tableData.push(tableDatabbb[i])
        }else if(typess == 2){
            tableData.push(tableDatabbb[i])
        }else if(typess == 3){
            tableData.push(tableDatabbb[i])
        }else{
            //WHAT FUCK
        }
    }
    var data = {
        "title": [{
            "value": "编号",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "寄件人姓名",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "寄件人手机",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "寄件人座机",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        },{
            "value": "收件人姓名",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "收件人手机",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "收件人座机",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "收件地址",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }, {
            "value": "物品信息",
            "type": "ROW_HEADER_HEADER",
            "datatype": "string"
        }],
        "data": []
    };
    var dataArr = [];
    console.log(tableData)
    $.each(tableData,function(i,item){
        // var types = "";
        // var kuaidisex = item.courier_company ? item.courier_company : "暂无";
        // var kuaidinum = item.courier_number ? item.courier_number : "暂无";
        // switch(item.type){
        // 	case 0:types = "已取消";break;
        // 	case 1:types = "待付款";break;
        // 	case 2:types = "待查账";break;
        // 	case 3:types = "待发货";break;
        // 	case 4:types = "已发货";break;
        // 	case 10:types = "已完成";break;
        // }
        var products = "";
        console.log(item.products);
        continue;
        for(var i = 0 ;i<item.goods.length;i++){
            products += ("商品：" + item.goods[i].pro_name + "  数量：" +item.goods[i].qty + "  规格：" +item.goods[i].pivot.remark + " \n\r ")
        }
        var $flag = false;
        if (item.address) {
            $flag = true;
        }
        var dataLength = [{
                "value": item.number,
                "type": "ROW_HEADER",
                "datatype": "default"
            }, {
                "value": "魅力女神SEMRA",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
                "value": "13318368799",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
                "value": "",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
            "value": $flag ? item.address.consignee : "",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
            "value": $flag ? item.address.telephone : "",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
                "value": "",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
            "value": $flag ? (item.address.province + item.address.city + item.address.county + item.address.street) : "",
                "type": "ROW_HEADER",
                "datatype": "default"					
            },{
                "value": products,
                "type": "ROW_HEADER",
                "datatype": "default"					
            }];
            dataArr.push(dataLength);
    })
    data.data = dataArr;
    
    function dateFormatUtil() {
        var dateTypeDate = "";
        var date = new Date();
        dateTypeDate += date.getFullYear(); //年
        dateTypeDate += "-" + getMonth(date); //月
        dateTypeDate += "-" + getDay(date); //日
        dateTypeDate += "-" + getHours(date); //时
        dateTypeDate += "-" + getMinutes(date); //分
        dateTypeDate += "-" + getSeconds(date); //秒
        return dateTypeDate;
    }
    //返回 01-12 的月份值
    function getMonth(date) {
        var month = "";
        month = date.getMonth() + 1; //getMonth()得到的月份是0-11
        if (month < 10) {
            month = "0" + month;
        }
        return month;
    }
    //返回01-30的日期
    function getDay(date) {
        var day = "";
        day = date.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        return day;
    }
    //小时
    function getHours(date) {
        var hours = "";
        hours = date.getHours();
        if (hours < 10) {
            hours = "0" + hours;
        }
        return hours;
    }
    //分
    function getMinutes(date) {
        var minute = "";
        minute = date.getMinutes();
        if (minute < 10) {
            minute = "0" + minute;
        }
        return minute;
    }
    //秒
    function getSeconds(date) {
        var second = "";
        second = date.getSeconds();
        if (second < 10) {
            second = "0" + second;
        }
        return second;
    }
    // console.log(data);
    // return;
    if (data == '')
        return;
    JSONToExcelConvertor(data.data, "快递单信息" + dateFormatUtil(), data.title);
});
function JSONToExcelConvertor(JSONData, FileName, ShowLabel) {
    //先转化json  
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var excel = '<table>';

    //设置表头  
    var row = "<tr>";
    for (var i = 0, l = ShowLabel.length; i < l; i++) {
        row += "<td>" + ShowLabel[i].value + '</td>';
    }


    //换行  
    excel += row + "</tr>";

    //设置数据  
    for (var i = 0; i < arrData.length; i++) {
        var row = "<tr>";

        for (var index in arrData[i]) {
            var value = arrData[i][index].value === "." ? "" : arrData[i][index].value;
            row += '<td style="mso-number-format:\'\@\';">' + value + '</td>';
        }

        excel += row + "</tr>";
    }

    excel += "</table>";

    var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'>";
    excelFile += '<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
    excelFile += '<meta http-equiv="content-type" content="application/vnd.ms-excel';
    excelFile += '; charset=UTF-8">';
    excelFile += "<head>";
    excelFile += "<!--[if gte mso 9]>";
    excelFile += "<xml>";
    excelFile += "<x:ExcelWorkbook>";
    excelFile += "<x:ExcelWorksheets>";
    excelFile += "<x:ExcelWorksheet>";
    excelFile += "<x:Name>";
    excelFile += "{worksheet}";
    excelFile += "</x:Name>";
    excelFile += "<x:WorksheetOptions>";
    excelFile += "<x:DisplayGridlines/>";
    excelFile += "</x:WorksheetOptions>";
    excelFile += "</x:ExcelWorksheet>";
    excelFile += "</x:ExcelWorksheets>";
    excelFile += "</x:ExcelWorkbook>";
    excelFile += "</xml>";
    excelFile += "<![endif]-->";
    excelFile += "</head>";
    excelFile += "<body>";
    excelFile += excel;
    excelFile += "</body>";
    excelFile += "</html>";


    var uri = 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(excelFile);

    var link = document.createElement("a");
    link.href = uri;

    link.style = "visibility:hidden";
    link.download = FileName + ".xls";

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    $('#myModal').modal('hide');
    tableData = [];
}
</script>
@endsection