<!-- Pid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pid', '上级:') !!}
    {!! Form::select('pid', [0=>'--无--'] + app(\App\Repositories\ProductCategoryRepository::class)->findByField('pid', 0)->pluck('title', 'id')->toArray(), $productCategory->pid ?? old('pid'), ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('sort', '排序:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div>
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '分类名称:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', '分类描述:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
<!-- Is Top Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_top', '是否显示:') !!}
    {!! Form::select('is_top', [0=> '否', 1=> '是'], $productCategory->is_top ?? old('is_top'), ['class' => 'form-control']) !!}
</div>

<!-- Img Main Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('img', '图片:') !!}
    <div class="controls">
        <input id="img_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img" id="img" value="{{ $productCategory->img ?? '' }}">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productCategories.index') !!}" class="btn btn-default">返回</a>
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
                return "<img src='/" + imgPath + "' style='max-width: 75px;' class='file-preview-image'>"
            })

            var imgConfigs = imgPaths.map(function () {
                return {
                    width: '120px',
                    //url: '/eim/project/deleteFile.do', // 删除url
                    //key: 1, // 删除是Ajax向后台传递的参数
                    //extra: {id: 100}
                }
            })

            $refFile.fileinput({
                language: 'zh',
                uploadUrl: "/upload",
                showUpload: true,//是否显示上传按钮
                showRemove: true,//是否显示删除按钮
                // showCaption: true,//是否显示输入框
                showPreview:true,
                showCancel:true,
                dropZoneEnabled: false,
                maxFileCount: 3,
                minFileCount: 0,
                initialPreviewShowDelete:true,
                msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                previewFileIcon: '<i class="fa fa-file"></i>',
                allowedPreviewTypes: ['image'],
                initialPreviewConfig: imgConfigs,
                allowedFileExtensions : ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary", //按钮样式
                initialPreview: imgPaths,
		initialPreview: imgPaths,
			layoutTemplates:{
				actionDelete:'',
				actionUpload:'',
	    	 	}
            }).on("fileuploaded", function (e, data) {
                var res = data.response;
                if (res.success === true) {
                    $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path)
                } else {
                    alert('上传失败')
                }
            })
var btn = document.getElementsByClassName('fileinput-remove-button')[0];
	btn.onclick = function(){
		if(confirm("确定清空轮播图吗？保存后生效")){
			$ref.val("")
		}else{
			window.location.reload()}
		}
        }
    </script>
@endsection
@section('css')
<style>
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
