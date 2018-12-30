<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', '姓名:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('username', '用户名:'); ?>

    <?php echo Form::text('username', null, ['class' => 'form-control']); ?>

</div>
<!-- Username Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('subordinate_limit', '健康使者最大人数:'); ?>

    <?php echo Form::number('subordinate_limit', $user->subordinate_limit??old(0), ['class' => 'form-control',(isset($user)&&$user->grade==3)?'':'readonly']); ?>

</div>
<!-- Wechat Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('wechat', '微信:'); ?>

    <?php echo Form::text('wechat', null, ['class' => 'form-control']); ?>

</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('telephone', '电话:'); ?>

    <?php echo Form::text('telephone', null, ['class' => 'form-control']); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

</div>

<!-- Birthday Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('birthday', '生日:'); ?>

    <?php echo Form::date('birthday', $user->birthday ?? null, ['class' => 'form-control']); ?>

</div>

<!-- Open Id Field -->

    
    



<!-- Type Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('type', '类型:'); ?>

    <?php echo Form::select('type', constants('USER_TYPE'), $user->type ?? old('type'), ['class' => 'form-control']); ?>

</div>

<!-- Grade Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('grade', '等级:'); ?>

    <?php echo Form::select('grade', constants('USER_GRADE'), $user->grade ?? old('grade'), ['class' => 'form-control']); ?>

    <?php echo Form::hidden('grade',$user->grade ?? old('grade'),['id'=>'g_select']); ?>

</div>

<!-- Superior Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('superior_id', '上级:'); ?>

    <?php echo Form::select('superior_id', resolve(\App\Repositories\UserRepository::class)->another($user->id ?? ''), $user->superior_id ?? old('superior_id'), ['class' => 'form-control']); ?>


</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('status', '状态:'); ?>

    <?php echo Form::select('status', constants('USER_STATUS'), $user->status ?? old('status'), ['class' => 'form-control']); ?>

</div>



<!-- Img Head Field -->
<div class="col-sm-12" style="padding: 0;">
<div class="form-group col-sm-6">
    <?php echo Form::label('img_head', '头像:'); ?>

    <div class="controls">
        <input id="img_head_file" type="file" class="file-loading" accept="image/*">
        <input type="hidden" name="img_head" id="img_head" value="<?php echo e($user->img_head ?? old('img_head')); ?>">
    </div>
    
</div>
</div>
<!-- Password Field -->

    
    


<!-- Remember Token Field -->

    
    


<!-- Updated User Id Field -->

    
    




    
    




    
    




    
    


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('users.index'); ?>" class="btn btn-default">返回</a>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    $(function () {
        $('#type').change(function () {
            var $grade = $('#grade')
            if (this.value === '0') {
                $("#g_select").val(0);
                $grade.val(0).attr('disabled', true)
            } else {
                $grade.attr('disabled', false)
                if ($grade.val() === '0') {
                    $("#g_select").val(1);
                    $grade.val('1')
                }
            }
        }).change()

        $('#grade').change(function () {
            $("#g_select").val(this.value);
            if (this.value === '0') {
                $('#type').val(0)
                this.disabled = true
            }
        })
    })

    fileinput('img_head')

    function fileinput(ref) {
        var $ref = $('#' + ref)
        var $refFile = $('#' + ref + '_file')
        console.log($ref.val())
        var imgPaths = $ref.val().split(',').filter(function (t) {
            return Boolean(t)
        }).map(function (imgPath) {
            return "<img src='/" + imgPath + "' onerror='javascript:this.src=\"" + imgPath + "\";' class='file-preview-image'>"
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
            // showRemove: false,//是否显示删除按钮
            // showCaption: true,//是否显示输入框
            showPreview:true,
            showCancel:true,
            dropZoneEnabled: false,
            maxFileCount: 1,
            minFileCount: 0,
            autoReplace: true,
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
        })
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    img.file-preview-image {
        width: 80px;
        height: 80px;
    }
</style>
<?php $__env->stopSection(); ?>