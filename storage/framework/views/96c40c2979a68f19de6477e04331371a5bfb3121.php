<table class="table table-responsive" id="giveaways-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>描述</th>
            <th>成本价</th>
            <th>市场价</th>
            <th>工厂</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $giveaways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $giveaway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $giveaway->name; ?></td>
<td><button alt="详情" title="详情" class="btn btn-default my_btn" type="button" data-toggle="modal" data-target="#contentModal<?php echo e($giveaway->id); ?>">详情</button></td>
           
            <td><?php echo $giveaway->cost_price; ?></td>
            <td><?php echo $giveaway->market_price; ?></td>
            <td><?php echo isset($giveaway->factory->name)?$giveaway->factory->name:''; ?></td>
            <td>
                
                <div class='btn-group'>
                    
                    <a href="<?php echo route('giveaways.edit', [$giveaway->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__currentLoopData = $giveaways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-sm-12">
    <div class="col-sm-12 modal inmodal fade" id="contentModal<?php echo $gv->id??null; ?>" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 950px;left:auto!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">详情</h4>
                </div>
                <div id='m1_modal' class="modal-body" style="height:275px;overflow:auto;width:95%;">
			<?php echo $gv->describe; ?>
		</div>
<div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="subContent" style="display: none">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('scripts'); ?>
function inner(text,id){
	document.getElementById("m1_modal"+id).innerHTML=text;
}
<?php $__env->stopSection(); ?>
