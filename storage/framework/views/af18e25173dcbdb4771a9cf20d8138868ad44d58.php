

    
    




    
    





<?php $__currentLoopData = app(\App\Repositories\PointRepository::class)->findWhere([['id', '>', 0]]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Point Field -->
    <div class="form-group col-sm-6">
        <?php echo Form::label('point', '献金余额'. $point->percentage  . '%以上每消费一元获得'); ?>

        <?php echo Form::number('point[' . $point->id . '][point]', $point->point, ['class' => 'form-control', 'step'=> 0.01, 'min'=> 0]); ?>

        <?php echo Form::hidden('point[' . $point->id . '][id]', $point->id); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="form-group col-sm-12">
<?php echo Form::submit('提交', ['class' => 'btn btn-primary']); ?>


</div>