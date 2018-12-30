<!-- Img Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img', '首页轮播图:'); ?>

    <div class="controls">
        <input id="img_slide_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_slide" id="img_slide" value="<?php echo e($systemConfig->img_slide ?? ''); ?>">
    </div>
</div>

<!-- Img Ad Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img_ad', '首页广告:'); ?>

    <div class="controls">
        <input id="img_ad_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_ad" id="img_ad" value="<?php echo e($systemConfig->img_ad ?? ''); ?>">
    </div>
</div>

<!-- Introduce Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('introduce', '首页介绍:'); ?>

    <div id="introduce_div" style="width:100%; height:200px;"><?php echo $systemConfig->introduce ?? ''; ?></div>
    <?php echo Form::textarea('introduce', $systemConfig->introduce ?? '', ['class' => 'form-control', 'id'=> 'introduce']); ?>

</div>

<!-- Enterprise Synopsis Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('enterprise_synopsis', '企业简介:'); ?>

    <div id="enterprise_synopsis_div" style="width:100%; height:200px;"><?php echo $systemConfig->enterprise_synopsis ?? ''; ?></div>
    <?php echo Form::textarea('enterprise_synopsis', $systemConfig->enterprise_synopsis ?? '', ['class' => 'form-control', 'id'=> 'enterprise_synopsis']); ?>

</div>

<!-- Enterprise Synopsis Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('enterprise_situation', '企业现状:'); ?>

    <div id="enterprise_situation_div" style="width:100%; height:200px;"><?php echo $systemConfig->enterprise_situation ?? ''; ?></div>
    <?php echo Form::textarea('enterprise_situation', $systemConfig->enterprise_situation ?? '', ['class' => 'form-control', 'id'=> 'enterprise_situation']); ?>

</div>

<!-- Enterprise Synopsis Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('enterprise_growth', '企业发展:'); ?>

    <div id="enterprise_growth_div" style="width:100%; height:200px;"><?php echo $systemConfig->enterprise_growth ?? ''; ?></div>
    <?php echo Form::textarea('enterprise_growth', $systemConfig->enterprise_growth ?? '', ['class' => 'form-control', 'id'=> 'enterprise_growth']); ?>

</div>

<!-- Enterprise Synopsis Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('enterprise_coalition', '企业合并:'); ?>

    <div id="enterprise_coalition_div" style="width:100%; height:200px;"><?php echo $systemConfig->enterprise_coalition ?? ''; ?></div>
    <?php echo Form::textarea('enterprise_coalition', $systemConfig->enterprise_coalition ?? '', ['class' => 'form-control', 'id'=> 'enterprise_coalition']); ?>

</div>

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

<!-- Img Ad Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img_ad', '二维码图片1:'); ?>

    <div class="controls">
        <input id="qrcode1_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="qrcode1" id="qrcode1" value="<?php echo e($systemConfig->qrcode1 ?? ''); ?>">
    </div>
</div>

<!-- Img Ad Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('img_ad', '二维码图片2:'); ?>

    <div class="controls">
        <input id="qrcode2_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="qrcode2" id="qrcode2" value="<?php echo e($systemConfig->qrcode2 ?? ''); ?>">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('systemConfigs.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
    <script>
        /*
            富文本 start
         */

        var flag = false;
        editorDiv('introduce')
        editorDiv('enterprise_synopsis')
        editorDiv('enterprise_situation')
        editorDiv('enterprise_growth')
        editorDiv('enterprise_coalition')

        function editorDiv(ref) {
            var editor = new wangEditor('#' + ref + '_div')
            var $ref = $('#' + ref)
            editor.customConfig.onchange = function (html) {
                // 监控变化，同步更新到 textarea
                $ref.val(html)
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
            $ref.val(editor.txt.html())
        }

        /*
            富文本 end
         */
        fileinput('img_slide')
        fileinputSingle('img_ad')
        fileinputSingle('qrcode1')
        fileinputSingle('qrcode2')

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
                    url: "<?php echo url('systemConfigs.deletes'); ?>",//'/delete', // 删除url
                    key: $(e).attr('src'), // 删除是Ajax向后台传递的参数
                    extra: {id: <?php echo $systemConfig->id??0; ?>

                            ,model:'SystemConfig'
                    ,row:ref}
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
                allowedFileExtensions : ['jpg', 'png', 'gif','jpeg'],
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
                console.log($(e).attr('src'));
                var $key = $(e).attr('src').substr(1);
                return {
                    width: '30px',
                    url: "<?php echo url('systemConfigs.deletes'); ?>",//'/delete', // 删除url
                    key: $key, // 删除是Ajax向后台传递的参数
                    extra: {id: <?php echo $systemConfig->id??0; ?>

                    ,model:'SystemConfig'
                    ,row:ref}
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