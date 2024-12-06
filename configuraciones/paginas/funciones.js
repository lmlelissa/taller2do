function registrar_paginas() {
    $.ajax({
        type: "GET",
        url: "/sysmeli/configuraciones/paginas/pag_add.php",
        beforeSend: function () {
            $("#detalles_registrar").html();
        },
        success: function (msg) {
            $("#detalles_registrar").html(msg);
        }
    });
}
function editar_paginas(datos) {
    var dat = datos.split("_");
    $.ajax({
        type: "GET",
        url: "/sysmeli/configuraciones/paginas/pag_edit.php?vpag_cod=" + dat[0],
        cache: false,
        beforeSend: function () {
            $('#detalles_editar').html('<img src="/sysmeli/dist/img/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
        },
        success: function (msg) {
            $('#detalles_editar').html(msg);
        }
    });
}

function borrar(datos) {
    var dat = datos.split("_");
    $('#si').attr('href', 'controller.php?vpag=' + dat[0]
            + '&vdireccion=null'
            + '&vnombre=null'
            + '&vmodulo=' + dat[1]
            + '&accion=2&pagina=pag_index.php');
    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar el Registro <i><strong>' + dat[2] + '</strong></i>?');
}

$("#mensaje").delay(2000).slideUp(200, function () {
    $(this).alert('close');
})


