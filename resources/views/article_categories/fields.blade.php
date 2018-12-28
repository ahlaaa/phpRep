<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img', '图标:') !!}
    <div class="controls">
        <input id="img_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img" id="img" value="{{ $articleCategory->img ?? '' }}">
    </div>
</div>

<!-- Updated User Id Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('updated_user_id', 'Updated User Id:') !!}--}}
    {{--{!! Form::number('updated_user_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Updated User Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('updated_user_name', 'Updated User Name:') !!}--}}
    {{--{!! Form::text('updated_user_name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Created User Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('created_user_id', 'Created User Id:') !!}--}}
    {{--{!! Form::number('created_user_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Created User Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('created_user_name', 'Created User Name:') !!}--}}
    {{--{!! Form::text('created_user_name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('articleCategories.index') !!}" class="btn btn-default">返回</a>
</div>
@section('scripts')
    <script>
        fileinput('img')

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
                // showRemove: false,//是否显示删除按钮
                // showCaption: true,//是否显示输入框
                showPreview:true,
                showCancel:true,
                dropZoneEnabled: false,
                maxFileCount: 1,
                minFileCount: 0,
                initialPreviewShowDelete:true,
                msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                previewFileIcon: '<i class="fa fa-file"></i>',
                allowedPreviewTypes: ['image'],
                initialPreviewConfig: imgConfigs,
                allowedFileExtensions : ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary", //按钮样式
                initialPreview: imgPaths,
            }).on("fileuploaded", function (e, data) {
                var res = data.response;
                if (res.success === true) {
                    $ref.val(res.data.path)
                } else {
                    alert('上传失败')
                }
            })
        }
    </script>
@endsection