<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_pedido = $_REQUEST['vid_pedido'];
$vid_producto = $_REQUEST['vid_producto'];
$vcantidad = $_REQUEST['vcantidad'];

$sql = "SELECT sp_ventas_pedidos_detalle(" . 
        $voperacion . "," . 
        $vid_pedido . "," . 
        $vid_producto . "," . 
        $vcantidad . ") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
    header("location:" . $valor[1] . ".php?vid_pedido=" . $vid_pedido);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ped_detalle.php?vid_pedido=" . $vid_pedido);
}
