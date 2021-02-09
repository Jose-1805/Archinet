$(function () {

    $('#btn-guardar-expediente').click(function () {
        guardarExpediente();
    });

    dominioPredeterminado();
})

function guardarExpediente() {


    var params = new FormData(document.getElementById('form-expediente'));
    var url = $("#general_url").val() + "/expediente/guardar";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {
            $("#form-expediente")[0].reset();
            $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Funcionario creado con éxito</p>');
            $('#modal-alert-success').modal('show');
            $('#form-expediente').find('.contenedor-mensaje-validacion').remove();
            $('.input-validado-danger').removeClass('input-validado-danger');
            $('.input-validado-success').removeClass('input-validado-success');
            cerrarBlockUiCargando();
        },
        error: function (jqXHR, error, state) {
            abrirMensajesValidacion('form-expediente', 'danger', JSON.parse(jqXHR.responseText));

            if (JSON.parse(jqXHR.responseText).identificacion !== undefined) {
                if (JSON.parse(jqXHR.responseText).identificacion[0] == 'El numero de identificación ya existe') {
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El funcionario con identificacion número "' + $("#identificacion").val() + '" ya se encuentra registrado</p>');
                    $('#modal-alert-danger').modal('show');
                }
            }

            if (JSON.parse(jqXHR.responseText).email !== undefined) {
                if (JSON.parse(jqXHR.responseText).email[0] == 'EL Funcionario ya se encuentra registrado') {
                    $('#modal-alert-danger').find('.modal-body').eq(0).html('<p>El funcionario"' + $("#email").val() + '" ya se encuentra registrado</p>');
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

        if (valor.indexOf('@') !== -1) {
            var valores = valor.split('@');
            valor = valores[0] + "@sena.edu.co";
            $(this).val(valor);
        }
    });
}

