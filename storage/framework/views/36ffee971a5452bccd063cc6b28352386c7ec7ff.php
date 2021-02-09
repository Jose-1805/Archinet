<div class="col-12">
    <div class="md-form">
        <?php echo Form::label('fecha_expedicion','Fecha de expedición', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_expedicion',null,['id'=>'fecha_expedicion','class'=>'form-control','max'=>date('Y-m-d')]); ?>

    </div>
</div>