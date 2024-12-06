<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_pedido = $_REQUEST['vid_pedido'];
$vid_sucursal = $_REQUEST['vid_sucursal'];
$vid_usuario = $_REQUEST['vid_usuario'];
$vid_cliente = $_REQUEST['vid_cliente'];
$vfecha = $_REQUEST['vfecha'];
$vtotal = $_REQUEST['vtotal'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_ventas_pedidos(" . 
        $voperacion . "," . 
        $vid_pedido . "," . 
        $vid_sucursal . "," . 
        $vid_usuario . "," .
        $vid_cliente .",'" . 
        $vfecha . "'," . 
        $vtotal. ",'" . 
        $vestado . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ped_index.php");
}
