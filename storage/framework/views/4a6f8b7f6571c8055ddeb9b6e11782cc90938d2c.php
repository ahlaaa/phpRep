<!-- Title Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('title', '标题:'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('category_id', '分类:'); ?>

    <?php echo Form::select('category_id', \App\Models\ArticleCategory::pluck('title', 'id')->toArray(), $article->category_id ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Img Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img', '文章首图:'); ?>

    <div class="controls">
        <input id="img_first_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_first" id="img_first" value="<?php echo e($article->img_first ?? ''); ?>">
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('content', '内容:'); ?>

    <div id="content_div" style="width:100%; height:200px;"><?php echo $article->content ?? ''; ?></div>
    <?php echo Form::textarea('content', $article->content ?? '', ['class' => 'form-control', 'id'=> 'content']); ?>

</div>

<!-- Status Field -->

    
    
        
        
    


<div class="form-group col-md-12">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('ARTICLE_STATUS'), $article->status ?? 0, ['class' => 'form-control']); ?>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('articles.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    /*
        富文本 start
     */
    var editor = new wangEditor('#content_div')
    var $content = $('#content')

    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $content.val(html)
    };
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
                console.log(datas.data.path);
                insert("https://bzf.15dk.top/"+datas.data.path);//"http://mlns.yungx.xyz/" + datas.data.path)
            },
            error: function (data) {
                alert("上传失败");
            }
        });
    };
    editor.create()

    $content.val(editor.txt.html())

    /*
        富文本 end
     */
    fileinput('img_first')
    var flag = false;
    function fileinput(ref) {
        var $ref = $('#' + ref)
        var $refFile = $('#' + ref + '_file')
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "' class='file-preview-image'>"
        })

        var imgConfigs = imgPaths.map(function (e) {
            console.log($(e).attr('src'));
            return {
                width: '120px',
                url: '/delete', // 删除url
                key: $(e).attr('src'), // 删除是Ajax向后台传递的参数
                extra: {id: <?php echo $article->id??0; ?>}
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
            allowedFileExtensions : ['jpg', 'png', 'gif','jpeg'],
            browseClass: "btn btn-primary", //按钮样式
            initialPreview: imgPaths,
        }).on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.success === true) {
                // if(!flag){
                //     fileinput('img_first');
                    $ref.val(res.data.path);
                //     flag = true;
                // }else {
                //     $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path);
                // }

                // $ref.val(res.data.path)
            } else {
                alert('上传失败')
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    #content_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }
    #content{
        display: none;
    }
</style>
<?php $__env->stopSection(); ?>
