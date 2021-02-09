<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        {!! Form::label('no_resolucion','Nª resolución (*)', ['class'=>'active']) !!}
        {!! Form::text('no_resolucion',null,['id'=>'no_resolucion','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un número de resolución', 'data-min-length'=>'2', 'maxLength'=>'4', 'data-field']) !!}
    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        {!! Form::label('no_resolucion_anterior','Nª resolución anterior (*)', ['class'=>'active']) !!}
        {!! Form::text('no_resolucion_anterior',null,['id'=>'no_resolucion_anterior','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un número de resolución anterior', 'data-min-length'=>'2', 'maxLength'=>'4', 'data-field']) !!}
    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        {!! Form::label('no_dias_no_vacacionados','Nª días no vacacionados (*)', ['class'=>'active']) !!}
        {!! Form::text('no_dias_no_vacacionados',null,['id'=>'no_dias_no_vacacionados','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir el número de días no vacacionados', 'maxLength'=>'3', 'data-field']) !!}
    </div>
</div>