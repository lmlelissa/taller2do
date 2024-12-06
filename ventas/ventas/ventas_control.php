<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_venta = $_REQUEST['vid_venta'];
$vid_pedido= $_REQUEST['vid_pedido'];
$vid_apecie = $_REQUEST['vid_apecie'];
$vid_sucursal = $_REQUEST['vid_sucursal'];
$vid_usuario = $_REQUEST['vid_usuario'];
$vid_cliente = $_REQUEST['vid_cliente'];
$vfecha = $_REQUEST['vfecha'];
$vcondicion = $_REQUEST['vcondicion'];
$vcuota = $_REQUEST['vcuota'];
$vintervalo = $_REQUEST['vintervalo'];
$vtotal = $_REQUEST['vtotal'];
$vnro_factura = $_REQUEST['vnro_factura'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_ventas_factura(" . $voperacion . "," . $vid_venta . "," . $vid_pedido. "," . $vid_apecie . "," . $vid_sucursal . "," . $vid_usuario . "," .
        $vid_cliente .",'" . $vfecha . "','" . $vcondicion . "'," . $vcuota . "," . $vintervalo . "," . $vtotal. ",'" . $vnro_factura. "','". $vestado . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ventas_index.php");
}
