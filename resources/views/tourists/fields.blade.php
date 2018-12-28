<input type="hidden" name="otype" value="3" />
<?php $tourist = $tourist??null; ?>
<input type="hidden" name="XXX" id="getPID" value="{!! optional($tourist)->id??'' !!}" />
<div class="clearfix"></div>

@include('flash::message')
<div class="col-sm-12">
    <div class="form-group col-sm-3">
        {!! Form::label('status','状态') !!}
        {!! Form::select('status',constants('TOURIST_STATUS'),optional($tourist)->status??null,['class'=>'form-control select']) !!}
    </div>
</div>

<div class="col-sm-12">

<div class="form-group col-sm-3">
    {!! Form::label('user_id','开团用户') !!}
    <?php
    $user = app(\App\Repositories\UserRepository::class)
        ->scopeQuery(function($query){
            return $query->with('gradesProx')->where('users.id','!=',1);
        })->get()->toArray();
    $arr = array();
    array_map(function($item) use (&$arr){
        if (sizeof($item['grades_prox']??[]) > 0)
            $arr[$item['id']] = $item['name'];
//            return $item;
    },$user);
    ?>
    {!! Form::select('user_id',$arr,optional($tourist)->user_id??null,['class'=>'form-control select']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('name','开团名称') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('route_id','路线选择') !!}
    {!! Form::select('route_id',app(\App\Models\Route::class)->pluck("name","id")->toArray(),null,['class'=>'form-control']) !!}
</div>
</div>
<div class="col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('begin_at', '开始时间:',['class'=>'col-sm-12','style'=>'padding:0px;']) !!}
        {!! Form::text('begin_at', optional($tourist)->begin_at??date('Y-m-d H:i:s'), ['class' => 'form-control col-sm-5 date block','id'=> 'datepicker1' ,'autocomplete'=>"off",'style'=>'width:45%;','data-provide'=>"datepicker"]) !!}
        <input type="time" value="00:00" class="form-control col-sm-2" style="width: 20%;" onchange="javascript:add_time(this);" data-id="datepicker1" />
        <div class="input-group-addon" style="position: absolute;top: 50%;right: 31%;">
            <span class="glyphicon glyphicon-th" style="top: -1px;"></span>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('end_at', '结束时间:',['class'=>'col-sm-12','style'=>'padding:0px;']) !!}
        {!! Form::text('end_at', optional($tourist)->end_at??date('Y-m-d H:i:s',strtotime('+1 day')), ['data-provide'=>"datepicker",'class' => 'form-control col-sm-5 date block','id'=> 'datepicker2'  ,'autocomplete'=>"off",'style'=>'width:45%;']) !!}
        <input type="time" value="00:00" class="form-control col-sm-2" style="width: 20%;" onchange="javascript:add_time(this);" data-id="datepicker2" />
        <div class="input-group-addon" style="position: absolute;top: 50%;right: 31%;">
            <span class="glyphicon glyphicon-th" style="top: -1px;"></span>
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('remark','说明',['class'=>'col-sm-3']) !!}
    {{--{!! Form::text('remark',null,['class'=>'form-control']) !!}--}}
    <div class="col-sm-8" id="content_div" style="width:100%; height:200px;">{!! optional($tourist)->remark??'' !!}</div>
    {!! Form::textarea('remark', old('remark'), ['class' => 'form-control', 'id'=> 'remark','style'=>'resize:none;']) !!}
</div>
<!--<div class="form-group col-sm-6">-->
<!--    首订单id:<input type="number" name="father_id" value="219" />-->
<!--</div>-->

<div class="col-sm-12">
    <div class="form-group col-sm-6 pull-left">
        <?php $users = optional($tourist)->users??[]; ?>
        <label>人数({!! sizeof($users) !!})</label>
    </div>
    <div class="form-group col-sm-12 pull-left">
        <table class="table">
            <thead>
            <tr>
                <th>用户名</th>
<!--                <th>订单号</th>-->
<!--                <th>支付金额</th>-->
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                {{--<td>{!! optional(app(\App\Models\Order::class)->find($user->pivot->order_id))->number??'' !!}</td>--}}
                {{--<td>{!! $user->pivot->amount !!}</td>--}}
                <td>{!! constants('UO_STATUS')[$user->pivot->status] !!}</td>
                <td><a href="{!! url('tourists.out/'.($user->pivot->id)) !!}" class="btn btn-xs btn-danger">退出</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--<div class="form-group col-sm-6">-->
<!--    开始时间:<input type="date" name="begin_at" value="" />-->
<!--</div>-->
<!--<div class="form-group col-sm-6">-->
<!--    结束时间:<input type="date" name="end_at" value="" />-->
<!--</div>-->
<!--<div class="form-group col-sm-6">-->
<!--    <div class="form-group col-sm-12">-->
<!--        <span>路线1</span>-->
<!--        名称:<input type="text" name="routes[1][name]" value="" /><br>-->
<!--        说明:<input type="text" name="routes[1][remark]" value="" /><br>-->
<!--        图片:<input type="text" name="routes[1][images]" value="" /><br>-->
<!--    </div>-->
<!--    <div class="form-group  col-sm-12">-->
<!--        <span>路线2</span>-->
<!--        名称:<input type="text" name="routes[2][name]" value="" /><br>-->
<!--        说明:<input type="text" name="routes[2][remark]" value="" /><br>-->
<!--        图片:<input type="text" name="routes[2][images]" value="" /><br>-->
<!--    </div>-->
<!--</div>-->
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tourists.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script type="text/javascript"
        src="https://cdn.bootcss.com/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript"
        src="https://cdn.bootcss.com/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<script>
    $('#datepicker1').datepicker({
//        date: new Date(),
        viewMode: "days",
        autoclose: false,
        beforeShowDay: $.noop,
        calendarWeeks: false,
        clearBtn: false,
        daysOfWeekDisabled: [],
        endDate: Infinity,
        forceParse: true,
        format: "yyyy-mm-dd",
        keyboardNavigation: true,
        language: 'zh-CN',
        minViewMode: 0,
        minuteStep:1,
        orientation: "auto",
        rtl: false,
        startDate: -Infinity,
        startView: 0,
        todayBtn: true,
        todayHighlight: false,
        weekStart: 0,
        bootcssVer:3,
    });
    $('#datepicker2').datepicker({
//        date: new Date(),
        viewMode: "days",
        autoclose: false,
        beforeShowDay: $.noop,
        calendarWeeks: false,
        clearBtn: false,
        daysOfWeekDisabled: [],
        endDate: Infinity,
        forceParse: true,
        format: "yyyy-mm-dd",
        keyboardNavigation: true,
        language: 'zh-CN',
        minViewMode: 0,
        minuteStep:1,
        orientation: "auto",
        rtl: false,
        startDate: -Infinity,
        startView: 0,
        todayBtn: true,
        todayHighlight: false,
        weekStart: 0
    });
    function  add_time(e) {
        var time_ipt = $("#"+$(e).data('id')),pre_time = ($(time_ipt).val().split(' '))[0];
        $(time_ipt).val(pre_time+" "+$(e).val()+":00");
    }
    /*
    富文本 start
    */
    // $(function(){
    var editor = new wangEditor('#content_div');
    var $content = $('#remark')

    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $content.val(html)
    }
    editor.customConfig.customUploadImg = function (files, insert) {
        // files 是 input 中选中的文件列表
        // insert 是获取图片 url 后，插入到编辑器的方法

        // 上传代码返回结果之后，将图片插入到编辑器中
        var data = new FormData();
        data.append("file_data", files[0]);
        $.ajax({
            data: data,
            type: "POST",
            url: "/upload", //图片上传出来的url，返回的是图片上传后的路径，http格式
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (datas) { //data是返回的hash,key之类的值，key是定义的文件名
                console.log(datas);
                insert("https://jmy.15dk.top/" + datas.data.path)
            },
            error: function (data) {
                alert("上传失败");
            }
        });
    }
    editor.create()

    editor.txt.html($content.val())

    $content.val(editor.txt.html())
    // })
    /*
     *   富文本 end
     */
    //    base
    $(function () {

        $(".file-preview-image").attr("src",$("#img_heads").val());

        // $('.dept_select').chosen();
        $('#div-distpicker').distpicker();
        // $('#div-distpicker').distpicker()

    });
    fileinput('route_images', 10);
    for (var i = 1;i < 555;i++){
        var id = 'p'+i+'_images';
        if (!$('#'+id))
            break;
        fileinput(id, 10);
    }
    // fileinput('img_main', 10);
    // fileinput('img_main', 10);

    function fileinput(ref, num) {
        num = num || 10;

        var $ref = $('#' + ref);
        var $refFile = $('#' + ref + '_file');
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "'  class='file-preview-image'>"
        });

        var imgConfigs = imgPaths.map(function () {
            return {
                width: '120px',
                //url: '/eim/project/deleteFile.do', // 删除url
                //key: 1, // 删除是Ajax向后台传递的参数
                //extra: {id: 100}
            }
        });

        $refFile.fileinput({
            language: 'zh',
            uploadUrl: "/upload",
            showUpload: true,//是否显示上传按钮
            showRemove: true,//是否显示删除按钮
            // showCaption: true,//是否显示输入框
            showPreview: true,
            showCancel: true,
            dropZoneEnabled: false,
            maxFileCount: num,
            minFileCount: 0,
            initialPreviewShowDelete: true,
            msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: ['image'],
            initialPreviewConfig: imgConfigs,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            browseClass: "btn btn-primary", //按钮样式
            initialPreview: imgPaths,
            // initialPreview: imgPaths,
            layoutTemplates: {
                actionDelete: '',
                actionUpload: '',
            }
        }).on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.success === true) {
                if (num === 1) {
                    $ref.val(res.data.path)
                } else {
                    $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path)
                }
            } else {
                alert('上传失败')
            }
        }).on('filecleared', function (e, data, msg) {
            if (confirm("确定清空轮播图吗？保存后生效")) {
                // console.log($ref);
                $ref.val("");
                setTimeout(function(){
                    $('#l_rsize').prev('div').eq(0).height($('#l_rsize')[0].offsetHeight);
                },200);

            } else {
                window.location.reload()
            }
        });
        // var btn = num == 1 ? document.getElementsByClassName('fileinput-remove-button')[0] : document.getElementsByClassName('fileinput-remove-button')[1];
        //
        // btn.onclick = function () {
        //     if (confirm("确定清空轮播图吗？保存后生效")) {
        //         $ref.val("")
        //     } else {
        //         window.location.reload()
        //     }
        // };

    }
    function add_parameters(e) {
        var index = +$('.count_row').length+1;
        var str = '<tr class="count_row">' +
            '<td><input type="text" name="routes['+index+'][name]" class="form-control"/></td>' +
            '<td><input type="text" name="routes['+index+'][remark]" class="form-control"/></td>' +
            '<td>'
            +'<label class="controls col-sm-10">'
            +'<input id="p'+index+'_images_file" type="file" class="file-loading" accept="image/*">'
            +'<input type="hidden" name="routes['+index+'][images]" id="p'+index+'_images">'
            +'</label>'
            +'</td>' +
            '<td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);" value="删除"/></td>';
        if ($("#getPID").val())
            str += '<td><input type="hidden" name="routes['+index+'][father_id]" class="form-control" value="'+$("#getPID").val()+'"/></td>';
        str +=  '</tr>';
        $("#parameters").append(str);
    }
    function remove_parameters(e) {
        // console.log($(e).parents('tr'));
        $(e).parents('tr').remove();
    }
</script>
@endsection
@section('css')
<link type="text/css" href="{{ URL::asset('/choosen/chosen.min.css') }}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css"
      href="https://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.css">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.bootcss.com/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"
      media="screen"/>
<style>
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }

    #remark {
        display: none;
    }

    .krajee-default.file-preview-frame .kv-file-content {
        height: 100%;
    }

    .krajee-default.file-preview-frame .kv-file-content img {
        width: 100%;
        max-height: 100%;
    }

    .krajee-default.file-preview-frame {
        width: 350px;
    }

    .file-zoom-content img {
        width: 100%;
        max-height: 100%;
    }
    img.file-preview-image {
        width: 45px;
        height: 45px;
    }
    .file-zoom-content>.file-preview-image{
        width: 75%;
        height: 75%;
    }
    /*img.file-preview-image {*/
        /*width: 80px;*/
        /*height: 80px;*/
    /*}*/
    /*.file-zoom-content>.file-preview-image{*/
        /*width: 75%;*/
        /*height: 75%;*/
    /*}*/
    .bootstrap-select, .show-tick {
        width: 69% !important;
    }

    .selectpicker, .dropdown-toggle {
        width: 100% !important;
    }
    .datepicker{
        top: 0px!important;
        z-index: 9999999!important;
    }
</style>
@endsection
