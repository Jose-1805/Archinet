<div class="col-12 col-md-6">
    <div class="md-form" id="contenedor_fecha_inicio">
        {!! Form::label('fecha_inicio','Fecha de inicio (*)', ['class'=>'active']) !!}
        {!! Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control required_field no-paste valid-restrict-field', 'data-required'=>'Debe seleccionar una fecha', 'max'=>date('Y-m-d')]) !!}
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="md-form" id="contenedor_fecha_fin">
        {!! Form::label('fecha_fin','Fecha fin (*)', ['class'=>'active']) !!}
        {!! Form::date('fecha_fin',null,['id'=>'fecha_fin','class'=>'form-control required_field no-paste valid-restrict-field', 'data-required'=>'Debe seleccionar una fecha', 'max'=>date('Y-m-d')]) !!}
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