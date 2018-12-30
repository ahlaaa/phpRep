<!-- User Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('user_id', '用户:'); ?>

    <?php echo Form::select('user_id', \App\Models\User::Factories()->pluck('name', 'id')->toArray(), $factory->user_id ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Img Promise Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('img_promise', '承诺书:'); ?>


    <div class="controls">
        <input id="img_promise_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_promise" id="img_promise" value="<?php echo e($factory->img_promise ?? ''); ?>">
    </div>

</div>

<!-- Img Qualification Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('img_qualification', '工厂资质:'); ?>


    <div class="controls">
        <input id="img_qualification_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_qualification" id="img_qualification" value="<?php echo e($factory->img_qualification ?? ''); ?>">
    </div>
</div>

<!-- Img Scene Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('img_scene', '实景图片:'); ?>


    <div class="controls">
        <input id="img_scene_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_scene" id="img_scene" value="<?php echo e($factory->img_scene ?? ''); ?>">
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', '名字:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('address', '地址:'); ?>

    <?php echo Form::text('address', null, ['class' => 'form-control']); ?>

</div>

<!-- Linkman Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('linkman', '联系人:'); ?>

    <?php echo Form::text('linkman', null, ['class' => 'form-control']); ?>

</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('telephone', '联系电话:'); ?>

    <?php echo Form::text('telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- White Book Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('white_book', '白皮书:'); ?>


    <div id="white_book_div" style="width:100%; height:200px;"><?php echo $factory->white_book ?? ''; ?></div>

    <?php echo Form::textarea('white_book', $factory->white_book ?? '', ['class' => 'form-control', 'id' => 'white_book']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('factories.index'); ?>" class="btn btn-default">返回</a>
</div>

<?php $__env->startSection('scripts'); ?>
    <script>
        var flag = false;
        /*
            富文本 start
         */
        var editor = new wangEditor('#white_book_div')
        var $white_book = $('#white_book')

        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $white_book.val(html)
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
                    console.log(datas.data.path);
                    insert("https://bzf.15dk.top/"+datas.data.path);//"http://mlns.yungx.xyz/" + datas.data.path)
                },
                error: function (data) {
                    alert("上传失败");
                }
            });
        };
        editor.create()

        $white_book.val(editor.txt.html())

        /*
            富文本 end
         */

        fileinput('img_promise', 10)
        fileinput('img_qualification', 10)
        fileinput('img_scene', 10)


        function fileinput(ref, num) {
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
                    //url: '/eim/project/deleteFile.do', // 删除url
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
                maxFileCount: 3,
                minFileCount: 0,
                initialPreviewShowDelete:true,
                msgFilesTooMany: "选择上传的文件数量 超过允许的最大数值！",
                previewFileIcon: '<i class="fa fa-file"></i>',
                allowedPreviewTypes: ['image'],
                initialPreviewConfig: imgConfigs,
                allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
                browseClass: "btn btn-primary", //按钮样式
                initialPreview: imgPaths,
            }).on("fileuploaded", function (e, data) {
                var res = data.response;
                if (res.success === true) {
                    if (!flag) {
                        $ref.val(res.data.path);
                        flag = true;
                    } else {
                        $ref.val($ref.val() ? $ref.val() + ',' + res.data.path : res.data.path)
                    }
                } else {
                    alert('上传失败')
                }
            }).on('filecleared', function (e, data, msg) {
                if (confirm("确定清空轮播图吗？保存后生效")) {
                    // console.log($ref);
                    $ref.val("")
                } else {
                    window.location.reload()
                }
            });
            // alert('1');
            // var btn = $ref.prev('div').children('button').eq(0);
            // var btn = document.getElementsByClassName('fileinput-remove-button')[0];
            // alert('2');
            // btn.onclick = function () {
            //     if (confirm("确定清空轮播图吗？保存后生效")) {
            //         console.log($ref);
            //         $ref.val("")
            //     } else {
            //         window.location.reload()
            //     }
            // }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    #white_book_div {
        width: 100%;
        min-height: 330px;
        height: auto;
    }
    #white_book {
        display: none;
    }
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
</style>
<?php $__env->stopSection(); ?>
