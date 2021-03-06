<!-- Img Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img', '首页轮播图:'); ?>

    <div class="controls">
        <input id="img_slide_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_slide" id="img_slide" value="<?php echo e($systemConfig->img_slide ?? ''); ?>">
    </div>
</div>
<?php echo Form::select('pro_list',app(\App\Models\Product::class)->get()->pluck("name","id"),null,['class'=>'form-control','id'=>'pro_sel','style'=>'display:none;','placeholder'=>'不绑定商品']); ?>

<?php
    $pros = $systemConfig->pro_id??'';
    $pros = explode(",",$pros);
?>
<?php echo Form::select('pro4img',$pros,null,['class'=>'form-control','id'=>'pro4img','style'=>'display:none;']); ?>

<?php echo Form::text("pro_id",$systemConfig->pro_id??null,['class'=>'form-control','id'=>'proid4img','style'=>'display:none;']); ?>



    
    
    




    
    
    




    
    
    




    
    
    




    
    
    


<!-- Enterprise Address Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('enterprise_address', '公司地址:'); ?>

    <?php echo Form::text('enterprise_address', null, ['class' => 'form-control']); ?>

</div>

<!-- Enterprise Telephone Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('enterprise_telephone', '联系电话(多个电话用逗号隔开):'); ?>

    <?php echo Form::text('enterprise_telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- Enterprise Email Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('enterprise_email', '邮箱(多个邮箱用逗号隔开):'); ?>

    <?php echo Form::text('enterprise_email', null, ['class' => 'form-control']); ?>

</div>



    
    
        
        
    




    
    
        
        
    


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    </div>
<?php $__env->startSection('scripts'); ?>
    <script>
        var pros = <?php echo json_encode($pros??null); ?>
        
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
        // $(".btn-xs").click(function(){
        //     var sel = $("#pro_sel");
        //     $("#pro_sel").remove();
        //     $(this).parents("div").parents("div").parents("div").prev().eq(0).append("<select>"+sel.eq(0).html()+"</select>");
        //     console.log(sel.eq(0).html());
        // });
        function change4img(id,e){
            var ip = $("input[data-id='"+id+"']"),newid = $(e).find("option:selected").val();
            ip.eq(0).attr("data-pro",newid);
            var str = [],str4check = [];
            // console.log($("input[name='id4pro']").length);
            var flag = false;
            $("input[name='id4pro']").each(function(k,v){
                var ch = $(v).eq(0).attr('data-id');
                if(str4check.indexOf(ch) == -1){
                    str4check.push($(v).eq(0).attr('data-id'));
                    str.push($(v).attr('data-pro'));
                }
            })
            str = str.join(",");
            // console.log($("#proid4img").val());
            $("#proid4img").val(str);
            // console.log($("#proid4img").val());
            // console.log(ip.eq(0).val());
            // console.log($(e).find("option:selected").val());
        };
        setTimeout(function(){
            var ip = $('input[name="id4pro"]');
            ip.each(function(k,v){
                $(v).eq(0).next().next().val($(v).eq(0).attr('data-pro'));
                // console.log($(v).siblings());
            })
        },400);
        function fileinput(ref) {
            var $ref = $('#' + ref),val1 = $("#pro_sel").val();
            var $refFile = $('#' + ref + '_file');
            var imgPaths = $ref.val().split(',').filter(function (t) {
                return Boolean(t)
            }).map(function (imgPath,k) {
                var val = $("option[value='"+pros[k]+"']","#pro_sel");
                val = val.eq(0).html()?val.eq(0).html():'';
                val = val?val:'不绑定商品';
                $("#pro_sel").val(pros[k]);
                var sel = $("#pro_sel").eq(0).html();
                console.log(sel);
                return "<img id='img"+k+"' src='/" + imgPath + "' class='file-preview-image file-preview-image-"+ref+"'>"+
                "<br><br>当前绑定:<input class='form-control' type='text' name='id4pro' disabled value='"+val+"' data-pro='"+(pros[k]?pros[k]:'')+"' data-id='"+k+"'><br>选择:<select class='form-control' onchange='javascript:change4img("+k+",this);' name='img"+k+"'>"+sel+"</select>";
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
                // alert('fk1');
                var res = data.response;
                if (res.success === true) {
                    $("#proid4img").val("");
                    $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path);
                    console.log($("#proid4img").val());
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
                maxFileCount: 9,
                minFileCount: 1,
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
                // alert('fk2');
                if (res.success === true) {
                    $("#proid4img").val("");
                    $ref.val(res.data.path)
                    console.log( $("#proid4img").val());
                } else {
                    alert('上传失败')
                }
            }).on('filepreremove', function(event, id, index) {       //只是你删除重新选择的图片才会触发，而删除原图片不会触发。
       console.log('id = ' + id + ', index = ' + index);
    }).on('filepredelete', function(event, key, jqXHR, data) {  //就是在删除原图片之前触发，而新选择的图片不会触发。能满足我们的要求。
	

   })
        }
	
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>