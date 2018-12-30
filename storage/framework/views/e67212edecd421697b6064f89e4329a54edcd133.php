<div class="tab-pane fade" id="proxs" style="padding: 35px 0px!important;">
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理商等级</span>
        </div>
        <div class="col-sm-6" style="padding: 0px;">
            <div class="col-sm-12 form-group" style="padding: 0px;" id="prox-distpicker">
                <div class="col-sm-4" id="div-province">
                    <?php echo Form::select('province', [] , null, ['class' => 'form-control','id'=>'prox_province']); ?>

                </div>
                <div class="col-sm-4" id="div-city" style="<?php echo 2 ==($list2->id??0) || 3 ==($list2->id??0) ?'':'display: none;'; ?>">
                    <?php echo Form::select('city', [] , null, ['class' => 'form-control','id'=>'prox_city']); ?>

                </div>
                <div class="col-sm-4" id="div-country" style="<?php echo 2 ==($list2->id??0) ?'':'display: none;'; ?>">
                    <?php echo Form::select('country', [] , null, ['class' => 'form-control','id'=>'prox_country']); ?>

                </div>
            </div>
            
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理商级别</span>
        </div>
        <?php if(isset($list2->pivot)): ?>
        <input type="hidden" value="<?php echo $list2->pivot->type; ?>" id="u_distribute_types2" name="grades[<?php echo $list2->id; ?>][type]" />
        <?php else: ?>
        <input type="hidden" value="3" id="u_distribute_types2" name="grades_type" />
        <?php endif; ?>
        <div class="col-sm-6">
            <?php echo Form::select('gradesid1',app(\App\Models\Grade::class)->where('type',3)->get()->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'选择代理商地区','onchange'=>'javascript:prox_change(this);','id'=>'prox_grade','data-id'=>''.($list2->id??0)]); ?>

        </div>
        <div class="col-sm-3">
            <?php echo Form::select('level',constants('PROX_LEVEL'),optional(optional(optional($list2)->pivot))->prox_level??null,['class'=>'form-control','placeholder'=>'选择代理商级别','id'=>'prox_level','data-id'=>''.($list2->id??0)]); ?>

        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理省份</span>
        </div>
        <div class="col-sm-6 prox_name4">
            <span><?php echo isset($list2->pivot->prox_name4)?$list2->pivot->prox_name4:'--'; ?></span>
            <input type="hidden" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][prox_name4]':''; ?>" value="<?php echo isset($list2->pivot)?$list2->pivot->prox_name4:''; ?>" />
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理城市</span>
        </div>
        <div class="col-sm-6 prox_name3">
            <span><?php echo isset($list2->pivot->prox_name3)?$list2->pivot->prox_name3:'--'; ?></span>
            <input type="hidden" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][prox_name3]':''; ?>}" value="<?php echo isset($list2->pivot)?$list2->pivot->prox_name3:''; ?>" />
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理地区</span>
        </div>
        <div class="col-sm-6 prox_name2">
            <span><?php echo isset($list2->pivot->prox_name2)?$list2->pivot->prox_name2:'--'; ?></span>
            <input type="hidden" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][prox_name2]':''; ?>" value="<?php echo isset($list2->pivot)?$list2->pivot->prox_name2:''; ?>" />
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理等级</span>
        </div>
        <div class="col-sm-6">
            <span id="prox_level_name"><?php echo isset($list2->pivot->prox_level)?($list2->pivot->prox_level).'级代理商':'--'; ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
<!--            <span>代理地区</span>-->
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" onclick="javascript:add_prox();">添加代理区域</button>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>累计分红</span>
        </div>
        <div class="col-sm-6">
            <span class="form-control col-sm-3" style="width: 20%;">总额：0.00元</span>
            <span class="form-control col-sm-3" style="width: 20%;margin-left: 9px;">省级：0.00元</span>
            <span class="form-control col-sm-3" style="width: 20%;margin-left: 9px;">市级：0.00元</span>
            <span class="form-control col-sm-3" style="width: 20%;margin-left: 9px;">县级：0.00元</span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>代理商权限</span>
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][is_oauthed]':''; ?>" value="1" class="is_oauthed2" <?php echo 1==(isset($list2->pivot->is_oauthed)?$list2->pivot->is_oauthed:1)?'checked':''; ?> /><span>是</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][is_oauthed]':''; ?>" value="2" class="is_oauthed2" <?php echo 2==(isset($list2->pivot->is_oauthed)?$list2->pivot->is_oauthed:1)?'checked':''; ?> /><span>否</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>审核通过</span>
        </div>
        <div class="col-sm-6">

            <label class="col-sm-4">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][status]':''; ?>" value="1" class="dist_status2" <?php echo 1==(isset($list2->pivot->status)?$list2->pivot->status:0)?'checked':''; ?> /><span>是</span>
            </label>
            <label class="col-sm-4">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][status]':''; ?>" value="2" class="dist_status2" <?php echo 2==(isset($list2->pivot->status)?$list2->pivot->status:0)?'checked':''; ?> /><span>否</span>
            </label>
            <label class="col-sm-4" >
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][status]':''; ?>" value="0" class="dist_status2" <?php echo 0==(isset($list2->pivot->status)?$list2->pivot->status:0)?'checked':''; ?> /><span>审核中</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>强制不自动升级</span>
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][is_autoup]':''; ?>" value="1" class="dist_is_autoup2" <?php echo 1==(isset($list2->pivot->is_autoup)?$list2->pivot->is_autoup:1)?'checked':''; ?> /><span>允许自动升级</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list2->id)?'grades['.$list2->id.'][is_autoup]':''; ?>" value="2" class="dist_is_autoup2" <?php echo 2==(isset($list2->pivot->is_autoup)?$list2->pivot->is_autoup:1)?'checked':''; ?> /><span>强制不自动升级</span>
            </label>
        </div>
    </div>
</div>