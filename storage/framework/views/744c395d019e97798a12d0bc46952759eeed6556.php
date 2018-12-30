<!-- Id Field -->
<div class="form-group">
    <?php echo Form::label('id', 'Id:'); ?>

    <p><?php echo $giveaway->id; ?></p>
</div>

<!-- Name Field -->
<div class="form-group">
    <?php echo Form::label('name', '名称:'); ?>

    <p><?php echo $giveaway->name; ?></p>
</div>

<!-- Describe Field -->
<div class="form-group">
    <?php echo Form::label('describe', '介绍:'); ?>

    <p><?php echo $giveaway->describe; ?></p>
</div>

<!-- Cost Price Field -->
<div class="form-group">
    <?php echo Form::label('cost_price', '成本价:'); ?>

    <p><?php echo $giveaway->cost_price; ?></p>
</div>

<!-- Market Price Field -->
<div class="form-group">
    <?php echo Form::label('market_price', '市场价:'); ?>

    <p><?php echo $giveaway->market_price; ?></p>
</div>

<!-- Factory Id Field -->
<div class="form-group">
    <?php echo Form::label('factory_id', '工厂:'); ?>

    <p><?php echo $giveaway->factory->name; ?></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo $giveaway->created_at; ?></p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo $giveaway->updated_at; ?></p>
</div>

<!-- Updated User Id Field -->
<div class="form-group">
    <?php echo Form::label('updated_user_id', 'Updated User Id:'); ?>

    <p><?php echo $giveaway->updated_user_id; ?></p>
</div>

<!-- Updated User Name Field -->
<div class="form-group">
    <?php echo Form::label('updated_user_name', 'Updated User Name:'); ?>

    <p><?php echo $giveaway->updated_user_name; ?></p>
</div>

<!-- Created User Id Field -->
<div class="form-group">
    <?php echo Form::label('created_user_id', 'Created User Id:'); ?>

    <p><?php echo $giveaway->created_user_id; ?></p>
</div>

<!-- Created User Name Field -->
<div class="form-group">
    <?php echo Form::label('created_user_name', 'Created User Name:'); ?>

    <p><?php echo $giveaway->created_user_name; ?></p>
</div>

