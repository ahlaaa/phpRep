<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>姓名</th>
            <th>用户名</th>
            <th>微信</th>
            <th>电话</th>
            <th>Email</th>
            <th>生日</th>
            <th>状态</th>
            <th>类型</th>
            <th>等级</th>
            <th>上级</th>
            
            
            
            
            
            
            
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->wechat; ?></td>
            <td><?php echo $user->telephone; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->birthday; ?></td>
            
            <td><?php echo $user->status_str; ?></td>
            <td><?php echo $user->type_str; ?></td>
            <td><?php echo $user->grade_str; ?></td>
            <td><?php echo $user->superior->name; ?></td>
            
            
            
            
            
            
            
            <td>
                
                <div class='btn-group'>
                    <a href="<?php echo route('users.tree', [$user->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-tree-conifer"></i></a>
                    
                    <a href="<?php echo route('users.edit', [$user->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="<?php echo route('users.password', [$user->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-lock"></i></a>
                    
                </div>
                
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>