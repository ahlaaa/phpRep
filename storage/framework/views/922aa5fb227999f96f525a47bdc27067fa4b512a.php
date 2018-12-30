<div class="col-sm-12">
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a class="col-sm-1 <?php echo $id==$user->id?'p_in':''; ?>" style="border: 1px solid;width: auto;" href="<?php echo url('users.healthers/'.$user->id); ?>"><?php echo ($user->name).'('.($user->subordinate_limit??0).')'; ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>序号</th>
            <th>用户名</th>
            <th>姓名</th>
            <th>微信</th>
            <th>手机号电话</th>
            <th>等级</th>
        </tr>
    </thead>
    <tbody>
    <?php if(!empty($u_healthers)): ?>
    <?php $__currentLoopData = $u_healthers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $loop->index+1; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->wechat; ?></td>
            <td><?php echo $user->telephone; ?></td>

            <td><?php echo constants('USER_GRADE')[$user->grade]; ?></td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </tbody>
</table>