<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$nota = $_REQUEST['vid_nota'];
$producto = $_REQUEST['vid_producto'];
$deposito = $_REQUEST['vid_deposito'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];
$descuento = $_REQUEST['vdescuento'];

$sql = "SELECT sp_compras_debito_detalle(". $operacion . ",". 
    (!empty($nota) ? $nota:0).",".
    (!empty($producto) ? $producto:0).",".
    (!empty($deposito) ? $deposito:0).",".
    (!empty($cantidad) ? $cantidad:0).",".
    (!empty($precio) ? $precio:0).",".
    (!empty($descuento) ? $descuento:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vid_nota=".$nota);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:debito_detalle.php?vid_nota=".$nota);
}
