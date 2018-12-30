<!-- Title Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', '优惠券名称:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('type', '类型:'); ?>

    <?php echo Form::select('type',constants('CARD_TYPE'), $card->type ?? null, ['class' => 'form-control','id'=>'card_type']); ?>

</div>
<div class="form-group col-sm-6 <?php echo isset($card->type)?$card->type==3?'hide':'':''; ?>" id="card_price">
    <?php echo Form::label('price', '优惠面额:'); ?>

    <?php echo Form::number('price', null, ['class' => 'form-control','step'=>'0.01']); ?>

</div>
<div class="form-group col-sm-12 <?php echo isset($card->type)?$card->type==3?'':'hide':'hide'; ?>" id="card_product">
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        <?php echo Form::label('product_id', '关联商品:'); ?>

        <br>
        <div class='row radio'>
            <?php $arr = \App\Models\Product::pluck('name', 'id')->toArray();
            ?>

                <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6" style='padding: 0px 38px;'>
                <?php echo Form::radio('product_id',$k??null,true,["id"=>'pd'.$k,'class'=>'radio','style'=>'display:
                inline-block;',isset($card->type)?$card->product_id==$k?'checked':'':'']); ?>

                <?php echo Form::label('pd'.$k, $v??old($v),['style'=>'padding-left: 0px;']); ?>

            </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="form-group col-sm-6">
            <?php echo Form::label('product_num','商品数量/大小:'); ?>

            <?php echo Form::number('product_num',null,['class'=>'form-control']); ?>

        </div>
        <div class="form-group col-sm-6">
            <?php echo Form::label('product_unit','商品单位:'); ?>

            <?php echo Form::text('product_unit',null,['class'=>'form-control']); ?>

        </div>
    </div>
</div>

<!-- Img Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('images', '优惠券图片:'); ?>

    <div class="controls">
        <input id="images_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="images" id="images" value="<?php echo e($card->images ?? ''); ?>">
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12" id="con_hide">
    <?php echo Form::label('remark', '说明:'); ?>

    <div id="content_div" style="width:100%; height:200px;"><?php echo $card->remark ?? ''; ?></div>
    <?php echo Form::textarea('remark', $card->remark ?? '', ['class' => 'form-control', 'id'=> 'content']); ?>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('cards.index'); ?>" class="btn btn-default">返回</a>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
    $("#card_type").change(function () {
        if ($(this).val() == 3) {
            $("#card_product").removeClass('hide');
            $("#card_price").hide();
        } else {
            $("#card_product").addClass('hide');
            $("#card_price").show();
        }
    });
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
                insert("https://jmy.15dk.top/" + datas.data.path)
            },
            error: function (data) {
                alert("上传失败");
            }
        });
    }
    editor.create()

    $content.val(editor.txt.html())
    $(".ols").change(function () {

    })
    /*
        富文本 end
     */
    fileinput('images')

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
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
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
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
    .file-zoom-content>.file-preview-image{
        width: 75%;
        height: 75%;
    }
</style>
<?php $__env->stopSection(); ?>
