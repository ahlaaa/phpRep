<!-- Id Field -->
<div class="form-group">
    <?php echo Form::label('id', 'Id:'); ?>

    <p><?php echo $order->id; ?></p>
</div>

<!-- Amount Field -->
<div class="form-group">
    <?php echo Form::label('amount', 'Amount:'); ?>

    <p><?php echo $order->amount; ?></p>
</div>

<!-- Qty Field -->
<div class="form-group">
    <?php echo Form::label('qty', 'Qty:'); ?>

    <p><?php echo $order->qty; ?></p>
</div>

<!-- Status Field -->
<div class="form-group">
    <?php echo Form::label('status', 'Status:'); ?>

    <p><?php echo $order->status; ?></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo $order->created_at; ?></p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo $order->updated_at; ?></p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    <?php echo Form::label('deleted_at', 'Deleted At:'); ?>

    <p><?php echo $order->deleted_at; ?></p>
</div>

<!-- Updated User Id Field -->
<div class="form-group">
    <?php echo Form::label('updated_user_id', 'Updated User Id:'); ?>

    <p><?php echo $order->updated_user_id; ?></p>
</div>

<!-- Updated User Name Field -->
<div class="form-group">
    <?php echo Form::label('updated_user_name', 'Updated User Name:'); ?>

    <p><?php echo $order->updated_user_name; ?></p>
</div>

<!-- Created User Id Field -->
<div class="form-group">
    <?php echo Form::label('created_user_id', 'Created User Id:'); ?>

    <p><?php echo $order->created_user_id; ?></p>
</div>

<!-- Created User Name Field -->
<div class="form-group">
    <?php echo Form::label('created_user_name', 'Created User Name:'); ?>

    <p><?php echo $order->created_user_name; ?></p>
</div>

