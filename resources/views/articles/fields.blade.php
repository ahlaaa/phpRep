<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('category_id', '分类:') !!}
    {!! Form::select('category_id', \App\Models\ArticleCategory::pluck('title', 'id')->toArray(), $article->category_id ?? null, ['class' => 'form-control']) !!}
</div>--}}
<div class="form-group col-sm-12">
<div class="form-group col-sm-3">
    {!! Form::label('category_id', '分类:') !!}
    @if(empty($article->category_id))
    <?php echo Form::select('category_id', app(App\Repositories\ArticleCategoryRepository::class)->pluck("title", 'id')->toArray(), $article->category_id??old('category_id'), ['class' => 'form-control ols']); ?>
    @else
    <?php echo Form::select('category_id', app(App\Repositories\ArticleCategoryRepository::class)->pluck("title", 'id')->toArray(), $article->category_id??old('category_id'), ['class' => 'form-control ols', 'disabled']); ?>
    @endif
</div>
</div>
<div class="form-group col-sm-12">
<!-- User Id Field -->
<div class="form-group col-sm-6 ztmsyx">
    {!! Form::label('category_id', '关联商品（多选）:') !!}
    <br>
    <div class='row checkbox'>
    <?php $arr = \App\Models\Product::pluck('name', 'id')->toArray();
    foreach ($arr as $k => $v) {
        $flag = false;
        if (!empty($article)) {

            foreach ($article->products as $pk => $pv) {
            if ($pv->id == $k) {
                $flag = true;
            }
        }
    }
        ?>
        <div class="col-sm-6" style='padding: 0px 38px;'>
            @if($flag)
            {!! Form::checkbox('products[]',$k??null,true,["id"=>'pd'.$k,'class'=>'checkbox','style'=>'display: inline-block;']) !!}
            {{-- {!! Form::textarea('content[]',$pv->content??null,["id"=>'con'.$k,'class'=>'text','style'=>'display: inline-block;']) !!} --}}
            @else
            {!! Form::checkbox('products[]',$k??null,false,["id"=>'pd'.$k,'class'=>'checkbox','style'=>'display: inline-block;']) !!}
            {{-- {!! Form::textarea('content[]',$pv->content,["id"=>'con'.$k,'class'=>'text','style'=>'display: none;']) !!} --}}
            @endif
            {!! Form::label('pd'.$k, $v??old($v),['style'=>'padding-left: 0px;']) !!}
        </div>  
        <?php
    }
    ?>
</div>
</div>
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_top', '显示在首页:') !!}
    {!! Form::select('is_top', [0=>'否', 1=> '是'], null, ['class' => 'form-control']) !!}
</div>

<!-- Img Field -->
<div class="form-group col-sm-12">
    {!! Form::label('img', '首图(一张):') !!}
    <div class="controls">
        <input id="img_first_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_first" id="img_first" value="{{ $article->img_first ?? '' }}">
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12" id="con_hide">
    {!! Form::label('content', '内容:') !!}
    <div id="content_div" style="width:100%; height:200px;">{!! $article->content ?? '' !!}</div>
    {!! Form::textarea('content', $article->content ?? '', ['class' => 'form-control', 'id'=> 'content']) !!}
</div>



<!-- Status Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('status', 'Status:') !!}--}}
    {{--<label class="checkbox-inline">--}}
        {{--{!! Form::hidden('status', false) !!}--}}
        {{--{!! Form::checkbox('status', '1', null) !!} 1--}}
    {{--</label>--}}
{{--</div>--}}

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
$(function(){
    if($(".ols").val() == 8){
        $(".ztmsyx").hide();
        $(".ztmswz").show();
    }
    if($(".ols").val() == 7){
        $("#con_hide").hide();
        $("#content").attr("name","content1");
    }
})
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
                insert("https://yhs.yungx.xyz/" + datas.data.path)
            },
            error: function (data) {
                alert("上传失败");
            }
        });
    }
    editor.create()

    $content.val(editor.txt.html())
    $(".ols").change(function(){
        var type_id = $(this).val();
        if(type_id == 8){
            // $(".ztmswz").hide();
            // $(".ztmsyx").show();
            $(".ztmsyx").hide();
            $(".ztmswz").show();
            $("#con_hide").show();
            $("#content").attr("name","content");
        }else{
            if(type_id == 2){
                $("#con_hide").show();
            }
            if(type_id == 7){
                $("#con_hide").hide();
                $("#content").attr("name","content1");
                // $("#content_div").html("");
            }else{
                $("#content").attr("name","content");
            }
            $(".ztmswz").hide();
            $(".ztmsyx").show();
            
        }
    })
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
		initialPreview: imgPaths,
			layoutTemplates:{
				actionDelete:'',
				actionUpload:'',
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
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }
    #content{
        display: none;
    }
.krajee-default.file-preview-frame .kv-file-content{
	height:100%;
}
.krajee-default.file-preview-frame .kv-file-content img{
	width:100%;
	max-height:100%;
}
.krajee-default.file-preview-frame{
	width:350px;
}
.file-zoom-content img{
	width:100%;
	max-height:100%;
}

</style>
@endsection
