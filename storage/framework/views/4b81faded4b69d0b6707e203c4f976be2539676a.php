<div class="tab-pane fade" id="parameter">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">
            <p>参数</p>
        </div>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
            <table class="table form-group">
                <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数值</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="parameters">
                <?php if(!isset($product->parameters) | 0 == sizeof($product->parameters??[])): ?>
                <tr class="count_row">
                    <td><input name="parameters[1][p_key]" type="text" class="form-control"/></td>
                    <td><input name="parameters[1][p_value]" type="text" class="form-control"/></td>
                    <td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);"
                               value="删除"/></td>
                </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $product->parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="count_row">
                            <td><input value="<?php echo $parameter->pivot->p_key; ?>" name="parameters[<?php echo $parameter->id; ?>][p_key]" type="text" class="form-control"/></td>
                            <td><input value="<?php echo $parameter->pivot->p_value; ?>" name="parameters[<?php echo $parameter->id; ?>][p_value]" type="text" class="form-control"/></td>
                            <td><input type="button" class="btn btn-danger" onclick="javascript:remove_parameters(this);"
                                       value="删除"/></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>
            </table>
            <div class="col-sm-12">
                <button class="btn btn-primary" type="button" onclick="javascript:add_parameters(this);">添加</button>
            </div>
        </div>
    </div>
</div>