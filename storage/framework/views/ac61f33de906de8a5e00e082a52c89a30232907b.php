<!-- Title Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('title', '标题:'); ?>

    <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('content', '内容:'); ?>

    <div id="content_div" style="width:100%; height:200px;"><?php echo $brand->content ?? ''; ?></div>
    <?php echo Form::textarea('content', $brand->content ?? '', ['class' => 'form-control', 'id'=> 'content']); ?>

</div>

<div class="form-group col-md-12">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('BRAND_STATUS'), $brand->status ?? 0, ['class' => 'form-control']); ?>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('brands.index'); ?>" class="btn btn-default">返回</a>
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

        $content.val(editor.txt.html())

        /*
            富文本 end
         */
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