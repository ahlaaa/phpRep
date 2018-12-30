<div class="tab-pane fade" id="sales_data">
    <?php
        $d_grades = app(\App\Models\Grade::class)->where('type',2)->get();
        $in_distribute = isset($product->in_distribute)?$product->in_distribute:2;
        $distributes = isset($product->distributes)?$product->distributes:[];
        $type_in = 0;
        foreach($distributes as $distribute){
            if ($distribute->pivot->in_use == 1)
                $type_in = $distribute->pivot->type;
        }

    ?>
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">分销</div>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
            <label class="col-sm-12 form-group">
                <span class="col-sm-2">是否参与分销:</span>
                <span class="col-sm-6">
                    <label class="form-group col-sm-4" style="width: 35%;"><input type="radio" value="1" name="in_distribute" <?php echo ($in_distribute==1)?'checked':''; ?> />是</label>
                    <label class="form-group col-sm-4" style="width: 35%;"><input type="radio" value="2" name="in_distribute" <?php echo ($in_distribute==2)?'checked':''; ?> />否</label>
                </span>
            </label>
            <label class="col-sm-12 form-group">
                <span class="col-sm-2">独立规则:</span>
                <span class="col-sm-6">
                    <label class="form-group col-sm-4" style="width: 60%;"><input  type="checkbox" name="is_on" />启用独立佣金比例</label>
                </span>
            </label>
            <label class="col-sm-10 pull-right form-group">
                <ul class=" nav nav-tabs" id="myTab1">
                    <li class="active">
<!--                        <label class="form-group col-sm-4" style="width: 35%;">-->
                        <label>
                            <input data-id=".is_common_use" data-idv="#is_details" data-idt="#is_common" type="radio" name="is_common" <?php echo (in_array($type_in,[0,1]))?'checked':''; ?> />
                            <a href="#is_common" data-toggle="tab" data-id="is_details" class="myTab1">统一分销佣金</a>
                        </label>
<!--                        </label>-->
                    </li>
                    <li>
<!--                        <label class="form-group col-sm-4" style="width: 35%;">-->
                        <label>
                            <input type="radio" data-id=".is_detail_use" data-idv="#is_common" data-idt="#is_details" name="is_common" <?php echo ($type_in == 2)?'checked':''; ?> />
                            <a href="#is_details" data-toggle="tab" data-id="is_common" class="myTab1">设置详细分销佣金</a>
                        </label>
<!--                        </label>-->
                    </li>
                </ul>

            </label>
            <div id="myTab1Content" class="tab-content col-sm-12">
                <div class="tab-pane fade <?php echo ($type_in == 2)?'in active':''; ?>" id="is_details">
                    <label class="col-sm-12 form-group" style="background-color: #de651c;padding: 8px 16%;">
                        <span>
                            <p>填写佣金规则,如果是数字(只能是纯数字),则是以固定金额给佣金</p>
                            <p>例如 1 就是按照卖一件,给分销商1元</p>
                            <p>如果上百分号</p>
                            <p>例如 1% 则是以支付商品金额的百分比给佣金</p>
                        </span>
                    </label>
                    <label class="form-group col-sm-12">
                        <span class="col-sm-2">
                            统一设置
                        </span>
                        <span class="col-sm-3 form-group">
                            <?php echo Form::select('dis_grade_id',$d_grades->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'选择等级','id'=>'dis_grade_id']); ?>

                        </span>
                        <span class="col-sm-3 form-group">
                            <?php echo Form::select('dis_type',constants('DISTRIBUTER_TYPE'),null,['class'=>'form-control','placeholder'=>'选择佣金级别','id'=>'dis_type']); ?>

                        </span>
                        <span class="col-sm-3 form-group">
                            <?php echo Form::text('dis_rules','',['class'=>'form-control','placeholder'=>'请输入规则','id'=>'dis_rules']); ?>

                        </span>
                        <span class="col-sm-1 form-group btn btn-danger" style="padding: 6px;" onclick="javascript:set_dis_details();">设置</span>
                    </label>
                    <div class="col-sm-12" style="padding: 0px;" id="div_dis_fv">
                    

                    <?php $__currentLoopData = $distributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($distribute->pivot->type == 2): ?>
                        <?php
                            $dis_type_num = isset($distribute->pivot->distribute_type_num)?explode(';',$distribute->pivot->distribute_type_num):[];
                        ?>
                        <?php if(sizeof($dis_type_num) > 0): ?>
                        <label class="col-sm-12 form-group div_pre_dis">
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][grade_id]'; ?>" value="<?php echo $distribute->pivot->grade_id; ?>" />
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][type]'; ?>" value="2" />
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][in_use]'; ?>" class="is_detail_use" value="" />
                        <span class="col-sm-2">
                            <?php echo app(\App\Models\Grade::class)->find($distribute->pivot->grade_id)->name; ?>

                        </span>
                        <?php $__currentLoopData = $dis_type_num; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis_nums): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $dis_list = explode(':',$dis_nums);
                        ?>
                        <input type="hidden" value="<?php echo $distribute->pivot->distribute_type_num; ?>" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][distribute_type_num]'; ?>" />
                        <span class="col-sm-3">
                            <input type="text" placeholder="<?php echo array_get(constants('DISTRIBUTER_TYPE'),$dis_list[0]); ?>" value="<?php echo $dis_list[1]; ?>" class="form-control" />
                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </label>
                        <?php endif; ?>
                        <?php endif; ?>
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="1级" class="form-control" />-->
<!--                        </span>-->
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="2级" class="form-control" />-->
<!--                        </span>-->

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    </div>
<!--                    <label class="col-sm-12 form-group">-->
<!--                        <span class="col-sm-2">-->
<!--                            等级1-->
<!--                        </span>-->
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="1级" class="form-control" />-->
<!--                        </span>-->
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="2级" class="form-control" />-->
<!--                        </span>-->
<!--                    </label>-->
<!--                    <label class="col-sm-12 form-group">-->
<!--                        <span class="col-sm-2">-->
<!--                            等级2-->
<!--                        </span>-->
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="1级" class="form-control" />-->
<!--                        </span>-->
<!--                        <span class="col-sm-3">-->
<!--                            <input type="text" placeholder="2级" class="form-control" />-->
<!--                        </span>-->
<!--                    </label>-->
                </div>
                <div class="tab-pane fade <?php echo (in_array($type_in,[0,1]))?'in active':''; ?>" id="is_common">
                    <label class="col-sm-12 form-group" style="background-color: #de651c;padding: 6% 21%;">
                        <span>如果比例为空，则使用固定规则，如果都为空则无分销佣金</span>
                    </label>
                    <?php $__currentLoopData = $d_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="col-sm-12 form-group">
                        <span class="col-sm-2" style="margin: 8px auto;"><?php echo $grade->name; ?>:</span>
                        <?php if($type_in == 1): ?>
                        <?php $__currentLoopData = $distributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($distribute->pivot->grade_id == $grade->id): ?>
                        <?php if($distribute->pivot->type == 1): ?>
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][grade_id]'; ?>" value="<?php echo $distribute->pivot->grade_id; ?>" />
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][type]'; ?>" value="1" />
                        <input type="hidden" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][in_use]'; ?>" class="is_common_use" value="" />
                        <input type="number" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][perc_num]'; ?>" value="<?php echo $distribute->pivot->perc_num; ?>" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>
                        <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">% 固定</span>
                        <input type="number" class="form-group form-control col-sm-10" name="<?php echo 'distributes['.($distribute->pivot->distribute_id).'][price_num]'; ?>" value="<?php echo $distribute->pivot->price_num; ?>" style="width: 27%;margin: 8px auto;" step="0.01">
                        <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>
                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php else: ?>
                       <input type="hidden" name="<?php echo 'distributes['.($grade->id).'][grade_id]'; ?>" value="<?php echo $grade->id; ?>" />
                        <input type="hidden" name="<?php echo 'distributes['.($grade->id).'][in_use]'; ?>" class="is_common_use" value="" />
                        <input type="hidden" name="<?php echo 'distributes['.($grade->id).'][type]'; ?>" value="1" />
                        <input type="number" name="<?php echo 'distributes['.($grade->id).'][perc_num]'; ?>" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>
                        <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">% 固定</span>
                        <input type="number" name="<?php echo 'distributes['.($grade->id).'][price_num]'; ?>" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">
                        <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>
                        <?php endif; ?>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>