<table class="table table-responsive" id="articles-table">
    <thead>
    <tr>
        <th>兑换用户</th>
        <th>物品</th>
        <th>状态</th>
        
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $exchangelogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exchangelog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo optional($exchangelog->user)->name??''; ?></td>
        <td><?php echo optional($exchangelog->card)->name??''; ?></td>
        <td><?php echo $exchangelog->status_str; ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div class='model_1'
     style="background-color: #ccc;overflow:auto;border:1px solid #ccc;position:fixed;left:30%;top:62px;height:85%;width: 669px;display:none;">
    <div style="position:absolute;right: 6px;font-size: 2em;color:red;opacity:0.4;" class='model_1_hide'>x</div>
    <div class='model_1_content'></div>
</div>
<?php $__env->startSection('scripts'); ?>
<script>

    function show(id) {
        $.each(list.data, function (k, v) {
            if (v.id == id) {
                $(".model_1").show();
                if (!v.content) {
                    $(".model_1_content").html("<h1><center>暂无内容</center></h1>");
                } else {
                    $(".model_1_content").html(v.content);
                }

            }
        });
    }

    $('.model_1_hide').click(function () {
        $(".model_1").hide();
        $(".model_1_content").html("");
    });
    $(document).mouseup(function (e) {
        var con = $(".model_1");   // 设置目标区域
        if (!con.is(":hidden")) {
            if (!con.is(e.target) && con.has(e.target).length === 0) {
                con.hide();
                $(".model_1_content").html("");
            }
        }
    })
</script>
<?php $__env->stopSection(); ?>