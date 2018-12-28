<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '勋章名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('prob_num', '勋章概率(%):') !!}
    {!! Form::number('prob_num', null, ['class' => 'form-control','step'=>'0.01','id'=>'prob_num']) !!}
</div>
<!-- Img Field -->
<div class="form-group col-sm-12">
    {!! Form::label('images', '勋章图片:') !!}
    <div class="controls">
        <input id="images_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="images" id="images" value="{{ $card->images ?? '' }}">
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12" id="con_hide">
    {!! Form::label('remark', '说明:') !!}
    <div id="content_div" style="width:100%; height:200px;">{!! $medal->remark ?? '' !!}</div>
    {!! Form::textarea('remark', $medal->remark ?? '', ['class' => 'form-control', 'id'=> 'content']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medals.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script>
    $("#card_type").change(function () {
        if ($(this).val() == 3) {
            $("#card_product").removeClass('hide');
            $("#card_price").hide();
        } else {
            $("#card_product").addClass('hide');
            $("#card_price").show();
        }
    });
    /*
        富文本 start
     */
    var editor = new wangEditor('#content_div')
    var $content = $('#content')

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

    $content.val(editor.txt.html())
    $(".ols").change(function () {

    })
    /*
        富文本 end
     */
    fileinput('images')

    function fileinput(ref) {
        var $ref = $('#' + ref)
        var $refFile = $('#' + ref + '_file')
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "' class='file-preview-image'>"
        })

        var imgConfigs = imgPaths.map(function () {
            return {
                width: '120px',
                url: '/eim/project/deleteFile.do', // 删除url
                key: 1, // 删除是Ajax向后台传递的参数
                extra: {id: 100}
            }
        })

        $refFile.fileinput({
            language: 'zh',
            uploadUrl: "/upload",
            showUpload: true,//是否显示上传按钮
            showRemove: true,//是否显示删除按钮
            // showCaption: true,//是否显示输入框
            showPreview: true,
            showCancel: true,
            dropZoneEnabled: false,
            maxFileCount: 1,
            minFileCount: 0,
            initialPreviewShowDelete: true,
            msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: ['image'],
            initialPreviewConfig: imgConfigs,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            browseClass: "btn btn-primary", //按钮样式
            initialPreview: imgPaths,
            initialPreview: imgPaths,
            layoutTemplates: {
                actionDelete: '',
                actionUpload: '',
            }
        }).on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.success === true) {
                $ref.val(res.data.path)
            } else {
                alert('上传失败')
            }
        })
        var btn = document.getElementsByClassName('fileinput-remove-button')[0];
        btn.onclick = function () {
            if (confirm("确定清空轮播图吗？保存后生效")) {
                $ref.val("")
            } else {
                window.location.reload()
            }
        }
    }
</script>
@endsection
@section('css')
<style>
    #prob_num:after{
        content: '%';
        color: #0e90d2;
    }
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }

    #content {
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
        width: 80px;
        height: 80px;
    }
    .file-zoom-content>.file-preview-image{
        width: 75%;
        height: 75%;
    }
</style>
@endsection
