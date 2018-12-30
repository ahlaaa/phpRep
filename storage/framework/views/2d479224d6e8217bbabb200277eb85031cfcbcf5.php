<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th></th>
            <th>会员</th>
            <th>等级/标签组</th>
            <!-- <th>用户名</th> -->
            <!--<th>微信</th>-->
            <th>注册时间</th>
            <!-- <th>Email</th> -->
            <th>积分/金额</th>
            <th>成交</th>
<!--            <th>等级/区域</th>-->
<!--            <th>推荐人</th>-->
<!--	    <th>加入时间</th>-->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><input type="checkbox" name="user_checked" data-id="<?php echo $user->id; ?>" /></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->grade->name??'--'; ?>/<?php echo $user->tag->name??'--'; ?></td>
            <!-- <td><?php echo $user->username; ?></td> -->
            <!--<td><?php echo $user->wechat; ?></td>-->
            <td><?php echo $user->created_at; ?></td>
            <!-- <td><?php echo $user->email; ?></td> -->
            
            <td><span class="col-sm-12 clearfix">积分:<?php echo $user->point; ?></span><span class="col-sm-12 clearfix">余额:<?php echo $user->coupon; ?></span></td>
            <td><span class="col-sm-12 clearfix">订单:<?php echo $user->orders->count(1)??0; ?></span><span class="col-sm-12 clearfix">金额:<?php echo $user->orders->sum('amount')??0; ?></span></td>

            <td>
                <?php echo Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
<!--                <button alt="会员详情" title="会员详情" class="btn btn-default my_btn" type="button" data-toggle="modal" data-target="#contentModal<?php echo e($user->id); ?>">-->
<!--                <i class="glyphicon glyphicon-eye-open"></i>-->
<!--                    </button>-->
                    <?php if($user->type === 2): ?>
                        <a alt="团队信息" title="团队信息" href="<?php echo route('users.tree', [$user->id]); ?>" class='btn btn-default'><i class="glyphicon glyphicon-tree-conifer"></i></a>
                    <?php endif; ?>
                    
                    <a alt="编辑用户信息" title="编辑用户信息" href="<?php echo route('users.edit', [$user->id]); ?>" class='btn btn-default '><i class="glyphicon glyphicon-edit"></i></a>
                    
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal inmodal fade" id="contentModal<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 950px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">会员详情</h4>
            </div>
            <div class="modal-body" style="height:auto ">
                <ul id="myTab<?php echo e($user->id); ?>" class="nav nav-tabs">
                    <li class="active">
                        <a href="#info<?php echo e($user->id); ?>" data-toggle="tab">
                            会员详情
                        </a>
                    </li>

                    <li><a href="#order<?php echo e($user->id); ?>" data-toggle="tab">用户订单</a></li>


                    <li><a href="#jiangl<?php echo e($user->id); ?>" data-toggle="tab">奖励记录</a></li>


                    <!-- <li><a href="#up<?php echo e($user->id); ?>" data-toggle="tab">等级变更记录</a></li> -->
                    <li><a href="#team<?php echo e($user->id); ?>" data-toggle="tab">团队</a></li>

                </ul>
                <div id="myTabContent<?php echo e($user->id); ?>" class="tab-content">
                    <div class="tab-pane fade in active" id="info<?php echo e($user->id); ?>">
                        <table class="table">
                            <thead style="border: 1px solid;text-align: center;">
                            <th colspan="3">会员详情</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>用户id:<span id="t1_id"><?php echo e($user->id??null); ?></span></td>
                                <td>姓名:<span id="t1_user_name"><?php echo e($user->name??null); ?></span></td>
                                <td>注册时间:<span id="t1_regtime"><?php echo e($user->created_at??null); ?></span></td>
                            </tr>
                            <tr>
                                <td>用户身份:<span id="t1_grade"><?php if(!empty($user->grade)): ?><?php echo e($user->grade->name??null); ?><?php endif; ?></span></td>
                                <td>注册地区:<span id="t1_regori"><?php echo e($user->province??null); ?></span></td>
                    
                            </tr>
                            <tr>
                                <td>状态:<span id="t1_status"><?php echo e($user->status_str??null); ?></span></td>
                                <td colspan="2">手机:<span id="t1_tel"><?php echo e($user->telephone??null); ?></span></td>
                            </tr>
                            
                            <tr>
                            <?php if(!empty($user->superior)): ?>
                                <td>推荐人id:<span id="t1_refeid"><?php echo e($user->superior->id??null); ?></span></td>
                                <td>推荐人姓名:<span id="t1_refename"><?php echo e($user->superior->name??null); ?></span></td>
                            <?php endif; ?>
                                <td>身份证号:<span id="t1_innum"><?php echo e($user->identification_card??null); ?></span></td>
                            </tr>
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">详细地址:<input type="text" id="t1_add"
                                                            value="<?php echo e($user->province??null); ?>-<?php echo e($user->city??null); ?>-<?php echo e($user->county??null); ?>"
                                                            disabled/>
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="order<?php echo e($user->id); ?>" style="height: 350px;overflow: auto;">

                    </div>
                    <div class="tab-pane fade" id="jiangl<?php echo e($user->id); ?>" style="height: 350px;overflow: auto;">

                    </div>
                    <div class="tab-pane fade" id="team<?php echo e($user->id); ?>" style="height: 350px;overflow: auto;">

                    </div>
                    <div class="tab-pane fade" id="up<?php echo e($user->id); ?>" style="height: 350px;overflow: auto;">
                        <table id="table<?php echo e($user->id); ?>" class="table">
                            <thead>
                            <td>序号</td>
                            <td>原等级</td>
                            <td>新等级</td>
                            <td>升级途径</td>
                            <td>升级时间</td>
                            </thead>
                            <tbody>
                            
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="subContent" style="display: none">保存</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(function(){
        var val =  $("#s_type").val();
        if(val == 0){
            $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
            $("#s_types").hide();
        }else if(val == 1){
            $("#s_types").show();
            $("#s_ipt").val('superior_id:=;');
        }
    })
    $("#s_type").on('change',function(){
        var val = $(this).val();
        // alert(val);
        if(val == 0){
            $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
            $("#s_types").hide();
        }else if(val == 1){
            $("#s_types").show();
            $("#s_ipt").val('superior_id:=;');
        }
    });
    $("#s_types").on('change',function(){
        var val = $(this).val();
        $("#s_sch1").val(val);
        // alert(val);
        // if(val == 0){
        //     $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
        // }else{
        //     $("#s_ipt").val('superior_id:=;');
        // }
    });
    $("#s_sch").blur(function(){
        $.ajax({
            url:'http://yhs.yungx.xyz/api/v1/users?type=2&search='+$("#s_sch").val()+'&searchFields=name:like',
            data:'',
            dataType:"JSON",
            type:"GET",
            success:function(res){
                var data = res.data;
                $("#s_types").html("<option>无用户</option>");
                $.each(data,function(k,v){
                    if(v.type == 2){
                        var str = "<option value="+v.id+">"+v.name+"</option>";
                        $("#s_types").append(str);
                    }
                })
                
                console.log(res);
            }
        });
    });
    
</script>
<?php $__env->stopSection(); ?>