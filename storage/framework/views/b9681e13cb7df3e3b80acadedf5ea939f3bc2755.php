

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1 class="pull-left">操作记录</h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>

       <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <table class="table">
                        <thead>
                            <th>序号</th>
                            <th>操作者</th>
                            <th>操作用户/门店</th>
                            <th>操作</th>
                            <th>时间</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $k+1; ?></td>
                                <td><?php echo $log->updated_user_name; ?></td>
                                <td><?php echo $log->created_user_name; ?></td>
                                <td><?php echo $log->txt; ?></td>
                                <td><?php echo $log->created_at; ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="text-center">
        
            <?php echo $__env->make('adminlte-templates::common.paginate', ['records' => $logs], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?> 


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>