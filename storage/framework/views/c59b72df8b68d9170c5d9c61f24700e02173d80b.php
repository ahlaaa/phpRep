
<!-- Img Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img', '袋子图片:'); ?>

    <div class="controls">
        <input id="img_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img" id="img" value="<?php echo e($bag->img ?? ''); ?>">
    </div>
</div>

<!-- Enterprise Address Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('name', '名称:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- Enterprise Telephone Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('price', '价格:'); ?>

    <?php echo Form::number('price', null, ['class' => 'form-control','step'=>0.01]); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('bags.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
    <script>

        /*
            富文本 end
         */
        fileinputSingle('img')

        function fileinput(ref) {
            var $ref = $('#' + ref)
            var $refFile = $('#' + ref + '_file')
            var imgPaths = $ref.val().split(',').filter(function (t) {
                return Boolean(t)
            }).map(function (imgPath) {
                return "<img src='/" + imgPath + "' class='file-preview-image'>"
            })

            var imgConfigs = imgPaths.map(function (e) {
                return {
                    width: '30px',
                    url: "<?php echo url('bags.deletes'); ?>",//'/delete', // 删除url
                    key: $(e).attr('src'), // 删除是Ajax向后台传递的参数
                    extra: {id: <?php echo $bag->id??0; ?>

                        ,model:'Bag'
                        ,row:ref}
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
            }).on("fileuploaded", function (e, data) {
                var res = data.response;
                if (res.success === true) {
                    if(!flag){
                        $ref.val(res.data.path);
                        flag = true;
                    }else {
                        $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path);
                    }
                } else {
                    alert('上传失败')
                }
            })
        }

        function fileinputSingle(ref) {
            var $ref = $('#' + ref)
            var $refFile = $('#' + ref + '_file')
            var imgPaths = $ref.val().split(',').filter(function (t) {
                return Boolean(t)
            }).map(function (imgPath) {
                return "<img src='/" + imgPath + "' class='file-preview-image'>"
            })

            var imgConfigs = imgPaths.map(function (e) {
                return {
                    width: '30px',
                    url: "<?php echo url('bags.deletes'); ?>",//'/delete', // 删除url
                    key: $(e).attr('src'), // 删除是Ajax向后台传递的参数
                    extra: {id: <?php echo $bag->id??0; ?>

                            ,model:'Bag'
                            ,row:ref}
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
                allowedFileExtensions : ['jpg', 'png', 'gif','jpeg'],
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
    </style>
<?php $__env->stopSection(); ?>