$(function () {
    $("#telefono").numericInput({ allowNegative: false,allowFloat: false});
    $("#enviar_registro").click(function () {
        abrirBlockUiCargando("Enviando");
        var params = $("#form-registro").serialize();
        var url = $("#general_url").val()+"/registro";

        $.post(url,params)
        .done(function (data) {
            $("#form-registro")[0].reset();
            $("#form-registro #nombre").focus();
            abrirAlerta("alertas-registro","success",["Tus datos han sido enviados con éxito!! <br/>Pronto nos pondremos en contacto contigo."],null,"modal-registro");
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-registro","danger",JSON.parse(jqXHR.responseText),null,"modal-registro");
            cerrarBlockUiCargando();
        })
    })

    $('body').on('click','.card-servicio',function () {
        var data = $(this).data('info');
        $('#modal-servicios').find('.modal-title').addClass('d-none');
        $('#modal-servicios').find('.msj_servicio').addClass('d-none');
        $('#modal-servicios').find('#titulo_'+data).removeClass('d-none');
        $('#modal-servicios').find('#msj_'+data).removeClass('d-none');
        $('#modal-servicios').modal('show');
    })
})