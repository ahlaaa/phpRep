<!-- Name Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('name', '名称:'); ?>

    <?php echo Form::text('name', old('name'), ['class' => 'form-control']); ?>

</div>

<!-- Describe Field -->
<div class="form-group col-sm-12 col-lg-12">
    <?php echo Form::label('describe', '介绍:'); ?>

    <div id="describe_div" style="width:100%; height:200px;"><?php echo $giveaway->describe ?? ''; ?></div>
    <?php echo Form::textarea('describe', old('describe'), ['class' => 'form-control', 'id'=> 'describe']); ?>

</div>

<!-- Cost Price Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('cost_price', '成本价:'); ?>

    <?php echo Form::number('cost_price', old('cost_price'), ['class' => 'form-control']); ?>

</div>

<!-- Market Price Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('market_price', '市场价:'); ?>

    <?php echo Form::number('market_price', old('market_price'), ['class' => 'form-control']); ?>

</div>

<!-- Factory Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('factory_id', '工厂:'); ?>

    <?php echo Form::select('factory_id', \App\Models\Factory::pluck('name', 'id')->toArray(), $giveaway->factory_id ?? old('factory_id'), ['class' => 'form-control']); ?>

</div>

<!-- WIth NumberField -->
<div class="form-group col-sm-6">
    <?php echo Form::label('with_number', '附赠产品件数:'); ?>

    <?php echo Form::number('with_number', old('with_number') ?? 999999999, ['class' => 'form-control']); ?>

</div>
<!-- Factory Id Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('type', '类型:'); ?>

    <?php echo Form::select('type', constants('GIVEAWAY_TYPE'), $giveaway->type ?? old('type'), ['class' => 'form-control','onchange'=>'javascript:c_show(this);']); ?>

</div>
<?php if(isset($giveaway)): ?>
<div id="g_chil" class="form-group col-sm-6 <?php echo $giveaway->type != 2?'hidden':''; ?>" style="padding: 0px;">
    <?php
    $children_id = $giveaway->children->pluck('id')->toArray();
    $gw_c = app(\App\Models\Giveaway::class)->where([['type',3]])->get();
    ?>
    <?php $__currentLoopData = $gw_c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <label class="col-sm-3">
        <input type="checkbox" onchange="javascript:gw_c_ch(this);" data-sid="<?php echo $giveaway->id; ?>" data-id="<?php echo $gw->id; ?>" name="c_gw" <?php echo in_array($gw->id,$children_id)?'checked':''; ?> />
        <span><?php echo $gw->name; ?></span>
    </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    <?php echo Form::submit('保存', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('giveaways.index'); ?>" class="btn btn-default">返回</a>
</div>

<?php $__env->startSection('scripts'); ?>
    <script>
        function c_show(e){
            if($(e).val() == 2){
                $("#g_chil").removeClass('hidden');
            }else{
                $("#g_chil").addClass('hidden');
            }
        }
        function gw_c_ch(e){
            var $id = $(e).data('id'),sup_id = $(e).data('sid');
            if(!$(e).prop('checked')){
                sup_id = '';
            }
            if ($id)
                $.ajax({
                    url:'/api/v1/giveaways/'+$id,
                    type:'put',
                    dataType:'json',
                    async:'false',
                    headers: {
                        'Authorization': "Bearer "
                    },
                    data:{
                        father_id:sup_id
                    },
                    success:function(res){
                        console.log(res);
                    },
                    fail:function (res) {
                        console.log(res);
                    },
                    error:function (res) {
                        console.log(res);
                    }
                })
        }
        /*
            富文本 start
         */
        var editor = new wangEditor('#describe_div')
        var $describe = $('#describe')

        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $describe.val(html)
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

        $describe.val(editor.txt.html())

        /*
            富文本 end
         */
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        #describe_div {
            width: 100%;
            min-height: 330px;
            height: auto;
        }
        #describe{
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>
