$(function () {
    $('#btn-certificado-basico').click(function () {
        validarRequisitos(abrirModalTramite);
    })

    $('#btn-certificado-detallado').click(function () {
        validarRequisitos(modalDetallado);
    })

    $('#btn-generar-basico-tramite').click(function () {
        certificadoBasico();
    })

    $('#btn-enviar-solicitud-detallado').click(function () {
        enviarSolicitudCertificadoDetallado();
    })
})

function validarRequisitos(callback) {
    var params = {_token:$('#general_token').val()};
    var url = $("#general_url").val() + "/certificado/validar-requisitos";

    abrirBlockUiCargando('Validando requisitos ');

    $.post(url, params)
        .done(function (data) {
            cerrarBlockUiCargando();
            callback();
        })
        .fail(function (jqXHR, state, error) {
            abrirAlerta("alertas-certificados", "danger", JSON.parse(jqXHR.responseText), null, null);
            cerrarBlockUiCargando();
        })
}

function abrirModalTramite() {
    $('#modal_tramite').modal('show');
}

function certificadoBasico() {
    if($('#tramite').val()){
        window.open($('#general_url').val()+'/certificado/basico/'+$('#tramite').val());
    }
}

function modalDetallado(){
    $('#modal_certificado_detallado').modal('show');
}

function enviarSolicitudCertificadoDetallado() {
    abrirBlockUiCargando('Enviando solicitud ');

    var params = $('#form-certificado-detallado').serialize();
    var url = $('#general_url').val()+'/certificado/solicitud-certificado-detallado';

    $.post(url,params)
        .done(function (data) {
            $('#modal_certificado_detallado').modal('hide');
            $('#modal-alert-success').find('.modal-body').eq(0).html('<p>La solicitud de certificado laboral detallado ha sido enviada con éxito</p>');

            setTimeout(function () {
                $('#modal-alert-success').modal('show');
            },500);

            cerrarBlockUiCargando();
        }).fail(function (jqXHR,state,error) {
            abrirMensajesValidacion("form-certificado-detallado", "danger", JSON.parse(jqXHR.responseText));
            cerrarBlockUiCargando();
        });
}