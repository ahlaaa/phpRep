<table class="table table-responsive" id="accountFlows-table">
    <thead>
        <tr>
            <th>用户</th>
            <th>类型</th>
            <th>金额</th>
            <th>时间</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $accountFlows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountFlow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $accountFlow->user->name; ?></td>
            <td><?php echo $accountFlow->type_str; ?></td>
            <td><?php echo $accountFlow->amount; ?></td>
            <td><?php echo $accountFlow->created_at; ?></td>
            
                
                
                    
                    
                    
                
                
            
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>