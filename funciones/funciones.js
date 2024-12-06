$(function () {
    script_mensaje();
    script_buscador();
});

function script_mensaje() {
    $.ajax({
        type: "POST", url: "/sysmeli/funciones/mensaje.php", data: {filtro: ""}
    }).done(function (datos) {
        $("#div_mensaje").html(datos);
    });
}
$("#div_mensaje").delay(2000).slideUp(200, function () {
    $(this).alert('close');
});

function script_buscador() {
    $.ajax({
        type: "POST", url: "/sysmeli/funciones/buscador.php", data: {filtro: ""}
    }).done(function (datos) {
        $("#div_buscador").html(datos);
    });
}





