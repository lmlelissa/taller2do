<?php
require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_nota = $_REQUEST['vid_nota'];
$vid_producto = $_REQUEST['vid_producto'];
$vid_deposito = $_REQUEST['vid_deposito'];
$vcantidad = $_REQUEST['vcantidad'];
$vmonto_concepto = $_REQUEST['vmonto_concepto'];
$vmonto_descuento = $_REQUEST['vmonto_descuento'];
$vmonto_final = $_REQUEST['vmonto_final'];

$sql = "SELECT sp_ventas_ndebito_detalle(". $voperacion . ",". 
    (!empty($vid_nota) ? $vid_nota:0).",".
    (!empty($vid_producto) ? $vid_producto:0).",".
    (!empty($vid_deposito) ? $vid_deposito:0).",".
    (!empty($vcantidad) ? $vcantidad:0).",".
    (!empty($vmonto_concepto) ? $vmonto_concepto:0).",".
    (!empty($vmonto_descuento) ? $vmonto_descuento:0).",".
    (!empty($vmonto_final) ? $vmonto_final:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vid_nota=".$vid_nota);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:debito_detalle.php?vid_nota=".$vid_nota);
}
