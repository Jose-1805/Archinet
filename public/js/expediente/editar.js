$(function () {

    $('#btn-guardar-expediente').click(function () {
        guardarFuncionario();

    });
    dominioPredeterminado();
})

function guardarFuncionario(){
    var params = new FormData(document.getElementById('form-funcionario'));
    var url = $("#general_url").val()+"/expediente/actualizar";

    abrirBlockUiCargando('Guardando');
    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Funcionario actualizado con éxito</p>');
            $('#modal-alert-success').modal('show');
            $('#form-funcionario').find('.contenedor-mensaje-validacion').remove();
            $('.input-validado-danger').removeClass('input-validado-danger');
            $('.input-validado-success').removeClass('input-validado-success');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirMensajesValidacion("form-funcionario","danger",JSON.parse(jqXHR.responseText),null,'body');
            if(JSON.parse(jqXHR.responseText).identificacion !== undefined) {
                if(JSON.parse(jqXHR.responseText).identificacion[0] == 'El numero de identificación ya existe'){
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El Funcionario con identificacion número "'+$("#identificacion").val()+'" ya se encuentra registrado</p>');
                    $('#modal-alert-danger').modal('show');
                }
            }

            if(JSON.parse(jqXHR.responseText).email !== undefined) {
                if(JSON.parse(jqXHR.responseText).email[0] == 'EL Funcionario ya se encuentra registrado'){
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El Funcionario "'+$("#email").val()+'" ya se encuentra registrado</p>');
                    $('#modal-alert-danger').modal('show');
                }
            }
            cerrarBlockUiCargando();
        }
    });
}
function dominioPredeterminado() {
    var email = $('#email').keyup(function (e) {
        var valor = $(this).val();

        if (valor.indexOf('@') !== -1){
            var valores = valor.split('@');
            valor = valores[0]+"@sena.edu.co";
            $(this).val(valor);
        }
    });
}
