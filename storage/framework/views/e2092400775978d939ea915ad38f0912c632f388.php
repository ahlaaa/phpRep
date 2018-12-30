<!-- Id Field -->
<div class="form-group">
    <?php echo Form::label('id', 'Id:'); ?>

    <p><?php echo $sale->id; ?></p>
</div>

<!-- Order Id Field -->
<div class="form-group">
    <?php echo Form::label('order_id', 'Order Id:'); ?>

    <p><?php echo $sale->order_id; ?></p>
</div>

<!-- Delivery Number Field -->
<div class="form-group">
    <?php echo Form::label('delivery_number', 'Delivery Number:'); ?>

    <p><?php echo $sale->delivery_number; ?></p>
</div>

<!-- Delivery Company Field -->
<div class="form-group">
    <?php echo Form::label('delivery_company', 'Delivery Company:'); ?>

    <p><?php echo $sale->delivery_company; ?></p>
</div>

<!-- Status Field -->
<div class="form-group">
    <?php echo Form::label('status', 'Status:'); ?>

    <p><?php echo $sale->status; ?></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <?php echo Form::label('created_at', 'Created At:'); ?>

    <p><?php echo $sale->created_at; ?></p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <?php echo Form::label('updated_at', 'Updated At:'); ?>

    <p><?php echo $sale->updated_at; ?></p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    <?php echo Form::label('deleted_at', 'Deleted At:'); ?>

    <p><?php echo $sale->deleted_at; ?></p>
</div>

