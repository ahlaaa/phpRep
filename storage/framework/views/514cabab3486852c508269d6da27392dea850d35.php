<table class="table table-responsive" id="systemConfigs-table">
    <thead>
        <tr>
            <th>Img Slide</th>
            <th>Img Ad</th>
            <th>Introduce</th>
            <th>Enterprise Synopsis</th>
            <th>Enterprise Situation</th>
            <th>Enterprise Growth</th>
            <th>Enterprise Coalition</th>
            <th>Enterprise Address</th>
            <th>Enterprise Telephone</th>
            <th>Enterprise Email</th>
            <th>Qrcode1</th>
            <th>Qrcode2</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $systemConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $systemConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $systemConfig->img_slide; ?></td>
            <td><?php echo $systemConfig->img_ad; ?></td>
            <td><?php echo $systemConfig->introduce; ?></td>
            <td><?php echo $systemConfig->enterprise_synopsis; ?></td>
            <td><?php echo $systemConfig->enterprise_situation; ?></td>
            <td><?php echo $systemConfig->enterprise_growth; ?></td>
            <td><?php echo $systemConfig->enterprise_coalition; ?></td>
            <td><?php echo $systemConfig->enterprise_address; ?></td>
            <td><?php echo $systemConfig->enterprise_telephone; ?></td>
            <td><?php echo $systemConfig->enterprise_email; ?></td>
            <td><?php echo $systemConfig->qrcode1; ?></td>
            <td><?php echo $systemConfig->qrcode2; ?></td>
            <td><?php echo $systemConfig->updated_user_id; ?></td>
            <td><?php echo $systemConfig->updated_user_name; ?></td>
            <td><?php echo $systemConfig->created_user_id; ?></td>
            <td><?php echo $systemConfig->created_user_name; ?></td>
            <td>
                <?php echo Form::open(['route' => ['systemConfigs.destroy', $systemConfig->id], 'method' => 'delete']); ?>

                <div class='btn-group'>
                    <a href="<?php echo route('systemConfigs.show', [$systemConfig->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="<?php echo route('systemConfigs.edit', [$systemConfig->id]); ?>" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]); ?>

                </div>
                <?php echo Form::close(); ?>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>