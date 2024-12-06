function registrar_permisos() {
    $.ajax({
        type: "GET",
        url: "/sysmeli/configuraciones/permisos/permisos_add.php",
        beforeSend: function () {
            $("#detalles_registrar").html();
        },
        success: function (msg) {
            $("#detalles_registrar").html(msg);
        }
    });
}

function editpag(datos) {
    var dat = datos.split("_");
    $.ajax({
        type: "GET",
        url: "/sysmeli/configuraciones/permisos/permisos_editar.php?vgru=" + dat[0] + "&vpag=" + dat[1] + "&vgrunombre=" + dat[2] + "&vpagina=" + dat[3],
        cache: false,
        beforeSend: function () {
            $('#detalles_edit').html('<img src="/sysmeli/dist/img/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
        },
        success: function (msg) {
            $('#detalles_edit').html(msg);
        }
    });
}

function borrar(datos) {
    var dat = datos.split("_");
    $('#si').attr('href', 'permisos_control.php?vgru=' + dat[0] +
            '&vpag=' + dat[1] + '&vgrunombre=' + dat[2]
            + '&consul=null&agre=null&editar=null&borrar=null'
            + '&accion=3&pagina=permisos_index.php');
    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea Borrar el Permiso Para <i><strong>' + dat[3] + '</strong></i>?');
}

$("#mensaje").delay(1500).slideUp(200, function () {
    $(this).alert('close');
})
