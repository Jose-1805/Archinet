$(function () {
    $('#btn-cambiar-contrasena').click(function () {
        cambiarPassword();
    })

    $('#btn-configurar-correos').click(function () {
        configurarCorreos();
    })
})

function cambiarPassword() {
    var params = $("#form-cambio-password").serialize();
    var url = $("#general_url").val() + "/configuracion/cambiar-password";

    abrirBlockUiCargando('Guardando ');

    $.post(url, params)
        .done(function (data) {
            $("#form-cambio-password")[0].reset();
            $('#modal-contrasena').modal('hide');
            setTimeout(function () {
                $('#modal-contrasena-actualizada').modal('show');
            },300);
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR, state, error) {
            abrirMensajesValidacion('form-cambio-password','danger',JSON.parse(jqXHR.responseText));
            cerrarBlockUiCargando();
        })
}

function configurarCorreos() {
    var params = $("#form-configurar-correos").serialize();
    var url = $("#general_url").val() + "/configuracion/correos";

    abrirBlockUiCargando('Guardando ');

    $.post(url, params)
        .done(function (data) {
            abrirAlerta("alertas-configuraciones", "success", ['Configuración de correos actualizada con éxito.'], null, 'body');
            $('#modal-correos').modal('hide');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR, state, error) {
            abrirMensajesValidacion('form-configurar-correos','danger',JSON.parse(jqXHR.responseText));
            cerrarBlockUiCargando();
        })
}