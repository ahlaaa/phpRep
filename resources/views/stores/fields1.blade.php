<!-- User Id Field -->
<div class="form-group col-sm-12">
<div class="form-group col-sm-2">
    {!! Form::label('user_id', '门店用户:') !!}
    {!! Form::select('user_id',  app(\App\Repositories\UserRepository::class)->stores(), $store->user_id ?? old('user_id'), ['class' => 'form-control']) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-2">
    {!! Form::label('telephone', '电话:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
</div>

</div>
<div class="form-group col-sm-12">

<!-- Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('name', '门店名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('balance', '预存款:') !!}
    {!! Form::text('balance', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<div id="div-distpicker">

    <!-- Province Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('province', '省:') !!}
        {!! Form::select('province', [] , null, ['class' => 'form-control']) !!}
    </div>

    <!-- City Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('city', '市:') !!}
        {!! Form::select('city', [] , null, ['class' => 'form-control']) !!}

        {{--{!! Form::text('city', null, ['class' => 'form-control']) !!}--}}
    </div>

    <!-- County Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('county', '县:') !!}
        {!! Form::select('county', [] , null, ['class' => 'form-control']) !!}
    </div>

</div>
</div>
<div class="form-group col-sm-12">
<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', '地址:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Balance Field -->
<!-- Status Field -->
<div class="form-group col-sm-2">
    {!! Form::label('status', '状态:') !!}
    {!! Form::select('status',  constants('STORE_STATUS'), $store->status ?? old('status'), ['class' => 'form-control']) !!}
</div>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('img_avatar', '门店头像:') !!}
    <div class="controls">
        <input id="img_avatar_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_avatar" id="img_avatar" value="{{ $store->img_avatar ?? '' }}">
    </div>
</div>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('img_introduce', '图片展示:') !!}
    <div class="controls">
        <input id="img_introduce_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_introduce" id="img_introduce" value="{{ $store->img_introduce ?? '' }}">
    </div>
</div>
</div>
<div class="form-group col-sm-12">
<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('lng', '经度:') !!}
    {!! Form::text('lng', null, ['class' => 'form-control', 'readonly']) !!}
</div>

<!-- Img Main Field -->
<div class="form-group col-sm-2 col-lg-2">
    {!! Form::label('lat', '纬度:') !!}
    {!! Form::text('lat', null, ['class' => 'form-control', 'readonly']) !!}
</div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stores.index') !!}" class="btn btn-default">返回</a>
</div>

@section('scripts')
    <script>
        $(function () {
            $('#div-distpicker').distpicker()

            var province = "{!! $store->province ?? null  !!}";

            if (province) {
                defaultRegion(province)
            }
            function defaultRegion(province) {
                $('#province option[value=' + province + ']').attr('selected', true)
                $('#province').change()
                $('#city option[value="{!! $store->city ?? null  !!}"]').attr('selected', true)
                $('#city').change()
                $('#county option[value="{!! $store->county ?? null !!}"]').attr('selected', true)
            }

            fileinput('img_avatar', 1)
            fileinput('img_introduce')


            function fileinput(ref, num) {
                num = num || 9

                var $ref = $('#' + ref)
                var $refFile = $('#' + ref + '_file')
                var imgPaths = $ref.val().split(',').filter(function (t) {
                    return Boolean(t)
                }).map(function (imgPath) {
                    return "<img src='/" + imgPath + "' class='file-preview-image'>"
                })
                console.log(imgPaths)

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
                    maxFileCount: num,
                    minFileCount: 0,
                    initialPreviewShowDelete:true,
                    msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                    previewFileIcon: '<i class="fa fa-file"></i>',
                    allowedPreviewTypes: ['image'],
                    initialPreviewConfig: imgConfigs,
                    allowedFileExtensions : ['jpg', 'png', 'gif'],
                    browseClass: "btn btn-primary", //按钮样式
                    initialPreview: imgPaths,
			layoutTemplates:{
				actionDelete:'',
				actionUpload:'',
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
                }).on('filepreremove', function(event, id, index) {       //只是你删除重新选择的图片才会触发，而删除原图片不会触发。
       console.log('id = ' + id + ', index = ' + index);
    }).on('filepredelete', function(event, key, jqXHR, data) {  //就是在删除原图片之前触发，而新选择的图片不会触发。能满足我们的要求。
	//$ref.val("");
	//var rps = document.querySelectorAll(".file-preview-image");
	//console.log(rps);
         })
var btn = num == 1 ? document.getElementsByClassName('fileinput-remove-button')[0] : document.getElementsByClassName('fileinput-remove-button')[1];

btn.onclick = function(){
	if(confirm("确定清空轮播图吗？保存后生效")){
	$ref.val("")
}else{
	window.location.reload()}
}
        }
            
        })
    </script>
@endsection
@section('css')
    <style>
        #introduce_div,
        #enterprise_synopsis_div,
        #enterprise_situation_div,
        #enterprise_growth_div,
        #enterprise_coalition_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }
        #introduce,#enterprise_synopsis,#enterprise_situation,#enterprise_growth,#enterprise_coalition{
            display: none;
        }
.krajee-default .file-preview-image{
	width:150px;
	max-height:180px;
}
.file-zoom-content img{
	width:100%;
	max-height:100%;
}
    </style>
@endsection