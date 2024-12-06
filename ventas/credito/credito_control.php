<?php

require '../../conexion.php';
session_start();
$operacion = $_REQUEST['voperacion'];
$id_nota = $_REQUEST['vid_nota'];
$id_apecie = $_REQUEST['vid_apecie'];
$id_tim = $_REQUEST['vid_tim'];
$id_venta = $_REQUEST['vid_venta'];
$id_cliente = $_REQUEST['vid_cliente'];
$nc_comprobante = $_REQUEST['vnc_comprobante'];
$nc_fecha_sistema = $_REQUEST['vnc_fecha_sistema'];
$nc_fecha_recibido = $_REQUEST['vnc_fecha_recibido'];
$nc_estado = $_REQUEST['vnc_estado'];
$id_motivo = $_REQUEST['vid_motivo'];

$sql = "SELECT sp_ventas_ncredito(".$operacion.",".$id_nota.",".$id_apecie.",".$id_tim.",".$id_venta.",".$id_cliente.",'".
    $nc_comprobante."','".$nc_fecha_sistema."','".$nc_fecha_recibido."','".$nc_estado."',".$id_motivo.") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:credito_index.php");
}
