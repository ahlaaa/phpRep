<!-- Img Field -->
<div class="form-group col-sm-12">
    {!! Form::label('img', '首页轮播图:') !!}
    <div class="controls">
        <input id="img_slide_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_slide" id="img_slide" value="{{ $systemConfig->img_slide ?? '' }}">
    </div>
</div>



{{--<!-- Introduce Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('introduce', '首页介绍:') !!}--}}
    {{--<div id="introduce_div" style="width:100%; height:200px;">{!! $systemConfig->introduce ?? '' !!}</div>--}}
    {{--{!! Form::textarea('introduce', $systemConfig->introduce ?? '', ['class' => 'form-control', 'id'=> 'introduce']) !!}--}}
{{--</div>--}}

{{--<!-- Enterprise Synopsis Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('enterprise_synopsis', '企业简介:') !!}--}}
    {{--<div id="enterprise_synopsis_div" style="width:100%; height:200px;">{!! $systemConfig->enterprise_synopsis ?? '' !!}</div>--}}
    {{--{!! Form::textarea('enterprise_synopsis', $systemConfig->enterprise_synopsis ?? '', ['class' => 'form-control', 'id'=> 'enterprise_synopsis']) !!}--}}
{{--</div>--}}

{{--<!-- Enterprise Synopsis Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('enterprise_situation', '企业现状:') !!}--}}
    {{--<div id="enterprise_situation_div" style="width:100%; height:200px;">{!! $systemConfig->enterprise_situation ?? '' !!}</div>--}}
    {{--{!! Form::textarea('enterprise_situation', $systemConfig->enterprise_situation ?? '', ['class' => 'form-control', 'id'=> 'enterprise_situation']) !!}--}}
{{--</div>--}}

{{--<!-- Enterprise Synopsis Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('enterprise_growth', '企业发展:') !!}--}}
    {{--<div id="enterprise_growth_div" style="width:100%; height:200px;">{!! $systemConfig->enterprise_growth ?? '' !!}</div>--}}
    {{--{!! Form::textarea('enterprise_growth', $systemConfig->enterprise_growth ?? '', ['class' => 'form-control', 'id'=> 'enterprise_growth']) !!}--}}
{{--</div>--}}

{{--<!-- Enterprise Synopsis Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('enterprise_coalition', '企业合并:') !!}--}}
    {{--<div id="enterprise_coalition_div" style="width:100%; height:200px;">{!! $systemConfig->enterprise_coalition ?? '' !!}</div>--}}
    {{--{!! Form::textarea('enterprise_coalition', $systemConfig->enterprise_coalition ?? '', ['class' => 'form-control', 'id'=> 'enterprise_coalition']) !!}--}}
{{--</div>--}}

<!-- Enterprise Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enterprise_address', '公司地址:') !!}
    {!! Form::text('enterprise_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Enterprise Telephone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enterprise_telephone', '联系电话(多个电话用逗号隔开):') !!}
    {!! Form::text('enterprise_telephone', null, ['class' => 'form-control']) !!}
</div>

<!-- Enterprise Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enterprise_email', '邮箱(多个邮箱用逗号隔开):') !!}
    {!! Form::text('enterprise_email', null, ['class' => 'form-control']) !!}
</div>

{{--<!-- Img Ad Field -->--}}
{{--<div class="form-group col-sm-12">--}}
    {{--{!! Form::label('img_ad', '二维码图片1:') !!}--}}
    {{--<div class="controls">--}}
        {{--<input id="qrcode1_file" type="file" class="file-loading" accept="image/*">--}}
        {{--<input type="hidden" name="qrcode1" id="qrcode1" value="{{ $systemConfig->qrcode1 ?? '' }}">--}}
    {{--</div>--}}
{{--</div>--}}

{{--<!-- Img Ad Field -->--}}
{{--<div class="form-group col-sm-12">--}}
    {{--{!! Form::label('img_ad', '二维码图片2:') !!}--}}
    {{--<div class="controls">--}}
        {{--<input id="qrcode2_file" type="file" class="file-loading" accept="image/*">--}}
        {{--<input type="hidden" name="qrcode2" id="qrcode2" value="{{ $systemConfig->qrcode2 ?? '' }}">--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    </div>
@section('scripts')
    <script>
        /*
            富文本 start
         */


//        editorDiv('introduce')
//        editorDiv('enterprise_synopsis')
//        editorDiv('enterprise_situation')
//        editorDiv('enterprise_growth')
//        editorDiv('enterprise_coalition')

        function editorDiv(ref) {
            var editor = new wangEditor('#' + ref + '_div')
            var $ref = $('#' + ref)
            editor.customConfig.onchange = function (html) {
                // 监控变化，同步更新到 textarea
                $ref.val(html)
            }
            editor.create()
            $ref.val(editor.txt.html())
        }

        /*
            富文本 end
         */
        fileinput('img_slide')
//        fileinputSingle('img_ad')
//        fileinputSingle('qrcode1')
//        fileinputSingle('qrcode2')

        function fileinput(ref) {
            var $ref = $('#' + ref)
            var $refFile = $('#' + ref + '_file')
            var imgPaths = $ref.val().split(',').filter(function (t) {
                return Boolean(t)
            }).map(function (imgPath) {
                return "<img src='/" + imgPath + "' class='file-preview-image file-preview-image-"+ref+"'>"
            })

            /*var imgConfigs = imgPaths.map(function (imgPath) {
		var sbc = imgPath;
		var abc = sbc.slice(19);
		var wbc = abc.slice(0,abc.indexOf("'"));
                return {
                    width: '30px',
                    url: '/upload.delete', // 删除url
                    extra: {
			path: 100
        	    },
                }
            })*/
            $refFile.fileinput({
                language: 'zh',
                uploadUrl: "/upload",
                //showUpload: true,//是否显示上传按钮
                //showRemove: false,//是否显示删除按钮
                //showCaption: false,//是否显示输入框
                showPreview:true,
                showCancel:true,
                dropZoneEnabled: false,
                maxFileCount: 9,
                minFileCount: 1,
                initialPreviewShowDelete:true,
                msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                previewFileIcon: '<i class="fa fa-file"></i>',
                allowedPreviewTypes: ['image'],
                //initialPreviewConfig: imgConfigs,
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
                    $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path)
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
var btn = document.getElementsByClassName('fileinput-remove-button')[0];

btn.onclick = function(){
	if(confirm("确定清空轮播图吗？保存后生效")){
	$ref.val("")
}else{
	window.location.reload()}
}
        }

        function fileinputSingle(ref) {
            var $ref = $('#' + ref)
            var $refFile = $('#' + ref + '_file');
	    var $refFileRp = $('.file-preview-image-' + ref);
            var imgPaths = $ref.val().split(',').filter(function (t) {
                return Boolean(t)
            }).map(function (imgPath) {
                return "<img src='/" + imgPath + "' class='file-preview-image file-preview-image-"+ref+"'>"
            })

            var imgConfigs = imgPaths.map(function () {
                return {
                    width: '30px',
                    url: '/upload.delete', // 删除url
                    extra: function() { 
            		return {path: $('#' + ref).val()}
        	    },
                }
            })

            $refFile.fileinput({
                language: 'zh',
                uploadUrl: "/upload",
                showUpload: true,//是否显示上传按钮
                showRemove: false,//是否显示删除按钮
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
            }).on('filepreremove', function(event, id, index) {       //只是你删除重新选择的图片才会触发，而删除原图片不会触发。
       console.log('id = ' + id + ', index = ' + index);
    }).on('filepredelete', function(event, key, jqXHR, data) {  //就是在删除原图片之前触发，而新选择的图片不会触发。能满足我们的要求。
	

   })
        }
	
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
	width:250px;
	max-height:180px;
}
.file-zoom-content img{
	width:100%;
	max-height:100%;
}
    </style>
@endsection