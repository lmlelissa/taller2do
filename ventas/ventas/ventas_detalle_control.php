<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_venta = $_REQUEST['vid_venta'];
$vid_producto = $_REQUEST['vid_producto'];
$vid_deposito = $_REQUEST['vid_deposito'];
$vcantidad = $_REQUEST['vcantidad'];

$sql = "SELECT sp_ventas_factura_detalle(" . 
        $voperacion . "," . 
        $vid_venta . "," . 
        $vid_producto . "," . 
        $vid_deposito . "," . 
        $vcantidad . ") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
    header("location:" . $valor[1] . ".php?vid_venta=" . $vid_venta);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ventas_detalle.php?vid_venta=" . $vid_venta);
}
