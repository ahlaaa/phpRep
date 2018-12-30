<div class="tab-pane fade" id="distributers" style="padding: 35px 0px!important;">
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>上级分销商</span>
        </div>

        <div class="col-sm-6">
            <?php if(isset($list1->pivot)): ?>
            
            <input type="hidden" value="<?php echo $list1->pivot->type; ?>" id="u_distribute_type" name="grades[<?php echo $list1->id; ?>][type]" />
            <input class="form-control col-sm-6" id="u_distribute_name" style="width: 35%;" value="<?php echo app(\App\Models\User::class)->find($list1->pivot->superior_id)->name??''; ?>"  readonly />
            <input type="hidden" name="grades[<?php echo $list1->id; ?>][superior_id]" value="<?php echo $list1->pivot->superior_id; ?>" id="u_distribute_id"  />
            
            <?php else: ?>
            <input type="hidden" value="2" id="u_distribute_type" name="grades_type" />
            <input class="form-control col-sm-6" style="width: 35%;" id="u_distribute_name" value=""  readonly />
            <input type="hidden" name="grades_superior_id" value="" id="u_distribute_id"  />
            <?php endif; ?>
            <button type="button" class="form-control col-sm-3 btn btn-primary" data-toggle="modal" data-target="#disc_Modal" style="width: 22%;">选择上级分销商</button>
            <span>
                <input type="button" class="form-control col-sm-2 btn btn-danger" onclick="javascript:del_disc_sup();" style="width: 10%;" value="清除" />
            </span>
        </div>
    </div>
    <div class="modal fade" id="disc_Modal" tabindex="-1" role="dialog" aria-labelledby="disc_ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="disc_ModalLabel">上级分销商选择</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $u_list_all = array();
                    $user_all = app(\App\Models\User::class)->with('grades')->get()->map(function($query) use (&$u_list_all){
                        if(isset($query->grades) && sizeof($query->grades) > 0){
//                            array_push($u_list_all,$query->name);//->pluck('name','id'));
                            $u_list_all[$query->id] = $query->name;
//                            return $query->pluck('name','id');
                        }

                    });
                    ?>
                    <?php echo Form::select('disc_sup_id',$u_list_all,null,['class'=>'form-control','id'=>'disc_sup_id','placeholder'=>'选择上级分销商']); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="javascript:select_disc_sup();">选择</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>是否固定上级</span>
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="is_static_desc" value="1" <?php echo 1 == ($user->is_static_desc??1)?'checked':''; ?> /><span>是</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="is_static_desc" value="2" <?php echo 2 == ($user->is_static_desc??1)?'checked':''; ?> /><span>否</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>分销商等级</span>
        </div>
        <div class="col-sm-6">
            <?php echo Form::select('gradesid',app(\App\Models\Grade::class)->where('type',2)->get()->pluck('name','id'),null,['class'=>'form-control','placeholder'=>'选择分销商等级','onchange'=>'javascript:select_desc(this);','id'=>'dis_grade','data-id'=>''.($list1->id??0)]); ?>

        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>累计佣金</span>
        </div>
        <div class="col-sm-6">
            <span>0</span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>已打款佣金</span>
        </div>
        <div class="col-sm-6">
            <span>0</span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>成为分销商时间</span>
        </div>
        <div class="col-sm-6">
            <span><?php echo isset($list1->pivot->created_at)?$list1->pivot->created_at:'--'; ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>分销商权限</span>
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][is_oauthed]':'disc_oauthed'; ?>" value="1" class="is_oauthed" <?php echo 1==(isset($list1->pivot->is_oauthed)?$list1->pivot->is_oauthed:1)?'checked':''; ?> /><span>是</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][is_oauthed]':'disc_oauthed'; ?>" value="2" class="is_oauthed" <?php echo 2==(isset($list1->pivot->is_oauthed)?$list1->pivot->is_oauthed:1)?'checked':''; ?> /><span>否</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>审核通过</span>
        </div>
        <div class="col-sm-6">

            <label class="col-sm-4">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][status]':'disc_status'; ?>" value="1" class="dist_status" <?php echo 1==(isset($list1->pivot->status)?$list1->pivot->status:0)?'checked':''; ?> /><span>是</span>
            </label>
            <label class="col-sm-4">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][status]':'disc_status'; ?>" value="2" class="dist_status" <?php echo 2==(isset($list1->pivot->status)?$list1->pivot->status:0)?'checked':''; ?> /><span>否</span>
            </label>
            <label class="col-sm-4" >
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][status]':'disc_status'; ?>" value="0" class="dist_status" <?php echo 0==(isset($list1->pivot->status)?$list1->pivot->status:0)?'checked':''; ?> /><span>审核中</span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-3">
            <span>强制不自动升级</span>
        </div>
        <div class="col-sm-6">
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][is_autoup]':'disc_up'; ?>" value="1" class="dist_is_autoup" <?php echo 1==(isset($list1->pivot->is_autoup)?$list1->pivot->is_autoup:1)?'checked':''; ?> /><span>允许自动升级</span>
            </label>
            <label class="col-sm-5">
                <input type="radio" name="<?php echo isset($list1->id)?'grades['.$list1->id.'][is_autoup]':'disc_up'; ?>" value="2" class="dist_is_autoup" <?php echo 2==(isset($list1->pivot->is_autoup)?$list1->pivot->is_autoup:1)?'checked':''; ?> /><span>强制不自动升级</span>
            </label>
        </div>
    </div>
</div>