<?php

require '../../conexion.php';
session_start();
$operacion = $_REQUEST['voperacion'];
$id_nota = $_REQUEST['vid_nota'];
$id_apecie = $_REQUEST['vid_apecie'];
$id_tim = $_REQUEST['vid_tim'];
$id_venta = $_REQUEST['vid_venta'];
$id_cliente = $_REQUEST['vid_cliente'];
$id_motivo = $_REQUEST['vid_motivo'];
$nc_comprobante = $_REQUEST['vnd_comprobante'];
$nd_fecha = $_REQUEST['vnd_fecha'];
$nd_monto = $_REQUEST['vnd_monto'];
$nd_monto_iva = $_REQUEST['vnd_monto_iva'];
$nd_estado = $_REQUEST['vnd_estado'];


$sql = "SELECT sp_ventas_ndebito(".$operacion.",".$id_nota.",".$id_apecie.",".$id_tim.",".$id_venta.",".$id_cliente.",".
    $id_motivo.",'".$nc_comprobante."','".$nd_fecha."',".$nd_monto.",".$nd_monto_iva.",'".$nd_estado."') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:debito_index.php");
}
