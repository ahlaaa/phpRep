<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', '分类:') !!}
    {!! Form::select('category_id', \App\Models\ArticleCategory::pluck('title', 'id')->toArray(), $article->category_id
    ?? null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_top', '显示在首页:') !!}
    {!! Form::select('is_top', [0=>'否', 1=> '是'], null, ['class' => 'form-control']) !!}
</div>

<!-- Img Field -->
<div class="form-group col-sm-12">
    {!! Form::label('img', '文章首图:') !!}
    <div class="controls">
        <input id="img_first_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_first" id="img_first" value="{{ $article->img_first ?? '' }}">
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', '内容:') !!}
    <div id="content_div" style="width:100%; height:200px;">{!! $article->content ?? '' !!}</div>
    {!! Form::textarea('content', $article->content ?? '', ['class' => 'form-control', 'id'=> 'content']) !!}
</div>


<!-- Status Field -->
{{--
<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('status', 'Status:') !!}--}}
    {{--<label class="checkbox-inline">--}}
        {{--{!! Form::hidden('status', false) !!}--}}
        {{--{!! Form::checkbox('status', '1', null) !!} 1--}}
        {{--</label>--}}
    {{--
</div>--}}

<div class="form-group col-md-12">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status', constants('ARTICLE_STATUS'), $article->status ?? 0, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('articles.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
<script>
    /*
        富文本 start
     */
    var editor = new wangEditor('#content_div')
    var $content = $('#content')

    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $content.val(html)
    }

    editor.create()

    $content.val(editor.txt.html())

    /*
        富文本 end
     */
    fileinput('img_first')

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
            allowedFileExtensions: ['jpg', 'png', 'gif'],
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

</style>
@endsection
