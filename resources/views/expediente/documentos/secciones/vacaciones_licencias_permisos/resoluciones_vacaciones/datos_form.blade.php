@php
    $tipos = [
        ''=>'Seleccione',
        'Individuales'=>'Individuales',
        'Colectivas'=>'Colectivas'
    ];

@endphp

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        {!! Form::label('no_resolucion','Nª resolución (*)', ['class'=>'active']) !!}
        {!! Form::text('no_resolucion',null,['id'=>'no_resolucion','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un número de resolución', 'data-min-length'=>'2', 'maxLength'=>'4', 'data-field']) !!}
    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 " id="contenedor_tipo">
    <div class="">
        {!! Form::label('tipo','Tipo (*)', ['class'=>'active']) !!}
        {!! Form::select('tipo',$tipos,null,['id'=>'tipo','class'=>'form-control']) !!}
    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        {!! Form::label('no_dias_vacacionar','Nª días a vacacionar (*)', ['class'=>'active']) !!}
        {!! Form::text('no_dias_vacacionar',null,['id'=>'no_dias_vacacionar','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir el número de días a vacacionar', 'maxLength'=>'3', 'data-field']) !!}
    </div>
</div>

<div class="col-12">
    <div class="row">
        <h5 class="col-12 text-center">PERIODO LABORADO</h5>
        <div class="col-12 col-md-6">
            <div class="md-form" id="contenedor_fecha_inicio">
                {!! Form::label('fecha_inicio','Inicio (*)', ['class'=>'active']) !!}
                {!! Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control required_field no-paste valid-restrict-field', 'data-required'=>'Debe seleccionar una fecha', 'max'=>date('Y-m-d')]) !!}
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="md-form" id="contenedor_fecha_fin">
                {!! Form::label('fecha_fin','Fin (*)', ['class'=>'active']) !!}
                {!! Form::date('fecha_fin',null,['id'=>'fecha_fin','class'=>'form-control required_field no-paste valid-restrict-field', 'data-required'=>'Debe seleccionar una fecha', 'max'=>date('Y-m-d')]) !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#fecha_inicio').change(function () {
            var fecha_fin = $('#fecha_fin').val();
            if(fecha_fin){
                fecha_fin = new Date(fecha_fin);
                fecha_inicio = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_inicio',"danger",{'fecha_inicio':['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin" ']});
                }else{
                    var id = $(this).attr('id');
                    var data = '{"' + id + '":[""]}';
                    data = JSON.parse(data);
                    var parar = false;
                    var id_contenedor = '';
                    var element = $(this).parent().parent();
                    while (!parar) {
                        if ($(element).attr('id')) {
                            parar = true;
                            id_contenedor = $(element).attr('id');
                        } else {
                            element = $(element).parent();
                        }
                    }
                    abrirMensajesValidacion(id_contenedor,"success",data);
                }
            }else{
                var id = $(this).attr('id');
                var data = '{"' + id + '":[""]}';
                data = JSON.parse(data);
                var parar = false;
                var id_contenedor = '';
                var element = $(this).parent().parent();
                while (!parar) {
                    if ($(element).attr('id')) {
                        parar = true;
                        id_contenedor = $(element).attr('id');
                    } else {
                        element = $(element).parent();
                    }
                }
                abrirMensajesValidacion(id_contenedor,"success",data);
            }
        });

        $('#fecha_fin').change(function () {
            var fecha_inicio = $('#fecha_inicio').val();
            if(fecha_inicio){
                fecha_inicio = new Date(fecha_inicio);
                fecha_fin = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_fin',"danger",{'fecha_fin':['no es posible seleccionar una fecha menor o igual a la establecida en el campo "fecha inicio"']});
                }else{
                    var id = $(this).attr('id');
                    var data = '{"' + id + '":[""]}';
                    data = JSON.parse(data);
                    var parar = false;
                    var id_contenedor = '';
                    var element = $(this).parent().parent();
                    while (!parar) {
                        if ($(element).attr('id')) {
                            parar = true;
                            id_contenedor = $(element).attr('id');
                        } else {
                            element = $(element).parent();
                        }
                    }
                    abrirMensajesValidacion(id_contenedor,"success",data);
                }
            }else{
                var id = $(this).attr('id');
                var data = '{"' + id + '":[""]}';
                data = JSON.parse(data);
                var parar = false;
                var id_contenedor = '';
                var element = $(this).parent().parent();
                while (!parar) {
                    if ($(element).attr('id')) {
                        parar = true;
                        id_contenedor = $(element).attr('id');
                    } else {
                        element = $(element).parent();
                    }
                }
                abrirMensajesValidacion(id_contenedor,"success",data);
            }
        });
    })
</script>