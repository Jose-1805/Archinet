$(function () {

    $('#btn-guardar-usuario').click(function () {
        guardarUsuario();
    });

    $('#fecha_inicio_contrato').change(function () {
        var fecha_fin = $('#fecha_terminacion_contrato').val();
        if(fecha_fin){
            fecha_fin = new Date(fecha_fin);
            fecha_inicio = new Date($(this).val());
            if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                abrirMensajesValidacion('contenedor_fecha_inicio',"danger",{'fecha_inicio_contrato':['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin de contrato" ']});
            }
        }
    });



    $('#fecha_terminacion_contrato').change(function () {
        var fecha_inicio = $('#fecha_inicio_contrato').val();
        if(fecha_inicio){
            fecha_inicio = new Date(fecha_inicio);
            fecha_fin = new Date($(this).val());
            if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                abrirMensajesValidacion('contenedor_fecha_terminacion',"danger",{'fecha_terminacion_contrato':['no es posible seleccionar una fecha menor a la establecida en el campo "fecha inicio de contrato"']});
            }
        }
    });
})

function guardarUsuario(){
    var params = new FormData(document.getElementById('form-usuario'));
    var url = $("#general_url").val()+"/usuario/actualizar";

    abrirBlockUiCargando('Guardando');
    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Usuario actualizado con éxito</p>');
            $('#modal-alert-success').modal('show');
            $('#form-usuario').find('.contenedor-mensaje-validacion').remove();
            $('.input-validado-danger').removeClass('input-validado-danger');
            $('.input-validado-success').removeClass('input-validado-success');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirMensajesValidacion("form-usuario","danger",JSON.parse(jqXHR.responseText),null,'body');
            if(JSON.parse(jqXHR.responseText).identificacion !== undefined) {
                if(JSON.parse(jqXHR.responseText).identificacion[0] == 'El numero de identificación ya existe'){
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El usuario con identificacion número "'+$("#identificacion").val()+'" ya se encuentra registrado</p>');
                    $('#modal-alert-danger').modal('show');
                }
            }

            if(JSON.parse(jqXHR.responseText).email !== undefined) {
                if(JSON.parse(jqXHR.responseText).email[0] == 'EL usuario ya se encuentra registrado'){
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El usuario "'+$("#email").val()+'" ya se encuentra registrado</p>');
                    $('#modal-alert-danger').modal('show');
                }
            }
            cerrarBlockUiCargando();
        }
    });
}
