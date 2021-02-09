<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('numero_resolucion','Nª resolución (*)', ['class'=>'active']); ?>

        <?php echo Form::text('numero_resolucion',null,['id'=>'numero_resolucion','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un número de resolución', 'data-min-length'=>'2', 'maxLength'=>'4', 'data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('numero_resolucion_anterior','Nª resolución anterior (*)', ['class'=>'active']); ?>

        <?php echo Form::text('numero_resolucion_anterior',null,['id'=>'numero_resolucion_anterior','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un número de resolución anterior', 'data-min-length'=>'2', 'maxLength'=>'4', 'data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('no_dias_no_vacacionados','Nª días no vacacionados (*)', ['class'=>'active']); ?>

        <?php echo Form::text('no_dias_no_vacacionados',null,['id'=>'no_dias_no_vacacionados','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir el número de días no vacacionados', 'maxLength'=>'3', 'data-field']); ?>

    </div>
</div>