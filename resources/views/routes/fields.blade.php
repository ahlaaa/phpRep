<?php $route = $route??null; ?>
<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '价格:') !!}
    {!! Form::number('price', null, ['class' => 'form-control','step'=>0.01]) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('remark','说明',['class'=>'col-sm-3']) !!}
    {{--{!! Form::text('remark',null,['class'=>'form-control']) !!}--}}
    <div class="col-sm-8" id="content_div" style="width:100%; height:200px;">{!! optional($route)->remark??'' !!}</div>
    {!! Form::textarea('remark', old('remark'), ['class' => 'form-control', 'id'=> 'remark','style'=>'resize:none;']) !!}
</div>
<div class="col-sm-12">
    <div class="col-sm-12"><label>地点说明</label></div>
    <div class="col-sm-12" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
        <table class="table form-group">
            <thead>
            <tr>
                <th>到达地名称</th>
                <th>说明</th>
                <th>图片</th>
                <!--                <th>操作</th>-->
            </tr>
            </thead>
            <tbody id="parameters">
            @if(!isset($route->parameters) | 0 == sizeof($route->parameters??[]))
            <tr class="count_row">
                <td><input name="parameters[1][name]" type="text" class="form-control"/></td>
                <td><input name="parameters[1][remark]" type="text" class="form-control"/></td>
                <td>
                    <label class="controls col-sm-10">
                        <input id="p1_images_file" type="file" class="file-loading" accept="image/*">
                        <input type="hidden" name="parameters[1][images]" id="p1_images"
                               value="">
                    </label>
                    <!--                    <input name="routes[1][images]" type="text" class="form-control"/>-->
                </td>
                <td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);"
                           value="删除"/></td>
            </tr>
            @else
            @foreach($route->parameters as $parameter)
            <tr class="count_row">
                <td><input value="{!! $parameter->pivot->name !!}" name="parameters[{!! $parameter->id !!}][name]" type="text" class="form-control"/></td>
                <td><input value="{!! $parameter->pivot->remark !!}" name="parameters[{!! $parameter->id !!}][remark]" type="text" class="form-control"/></td>
                <td>
                    <label class="controls col-sm-10">
                        <input id="p{!! $loop->index+1 !!}_images_file" type="file" class="file-loading" accept="image/*">
                        <input type="hidden" name="parameters[{!! $parameter->id !!}][images]" id="p{!! $loop->index+1 !!}_images"
                               value="{{ $parameter->pivot->images ?? '' }}">
                    </label>
                    <!--                    <input value="{!! $parameter->pivot->images !!}" name="routes[{!! $parameter->parameter_id !!}][images]" type="text" class="form-control"/>-->
                </td>
                <td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);"
                           value="删除"/></td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
        <div class="col-sm-12">
            <button class="btn btn-primary" type="button" onclick="javascript:add_parameters(this);">添加</button>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group col-sm-12 pull-left" style="padding: 0px;">
        {!! Form::label('images','旅游路线总图',['class'=>'col-sm-3']) !!}
        <div class="controls col-sm-10">
            <input id="images_file" type="file" class="file-loading" accept="image/*">
            <input type="hidden" name="images" id="images"
                   value="{{ optional($route)->images ?? '' }}">
            <?php  ?>
        </div>
        {{--{!! Form::text('images',null,['class'=>'form-control']) !!}--}}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routes.index') !!}" class="btn btn-default">返回</a>
</div>

@section('scripts')
<script>
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
    fileinput('images', 10);
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
            '<td><input type="text" name="parameters['+index+'][name]" class="form-control"/></td>' +
            '<td><input type="text" name="parameters['+index+'][remark]" class="form-control"/></td>' +
            '<td>'
            +'<label class="controls col-sm-10">'
            +'<input id="p'+index+'_images_file" type="file" class="file-loading" accept="image/*">'
            +'<input type="hidden" name="parameters['+index+'][images]" id="p'+index+'_images" value="">'
            +'</label>'
            +'</td>' +
            '<td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);" value="删除"/></td>';

        str +=  '</tr>';
        $("#parameters").append(str);
        fileinput('p'+index+'_images', 10);
    }
    function remove_parameters(e) {
        // console.log($(e).parents('tr'));
        $(e).parents('tr').remove();
    }
</script>
@endsection
@section('css')
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
</style>
@endsection
