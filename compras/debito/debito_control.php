<?php
require '../../conexion.php';
session_start();
$operacion = $_REQUEST['voperacion'];
$id_nota = $_REQUEST['vid_nota'];
$nc_comprobante = $_REQUEST['vnc_comprobante'];
$id_proveedor = $_REQUEST['vid_proveedor'];
$id_compra = $_REQUEST['vid_compra'];
$id_usuario = $_REQUEST['vid_usuario'];
$id_sucursal = $_REQUEST['vid_sucursal'];
$nc_fecha_sistema = $_REQUEST['vnc_fecha_sistema'];
$nc_fecha_recibido = $_REQUEST['vnc_fecha_recibido'];
$nc_nro_timbrado = $_REQUEST['vnc_nro_timbrado'];
$nc_timbrado_venc = $_REQUEST['vnc_timbrado_venc'];
$vid_motivo = $_REQUEST['vid_motivo'];

$sql = "SELECT sp_compras_debito(" . $operacion . "," .(!empty($id_nota) ? $id_nota : 0) . ",'" .
        (!empty($nc_comprobante) ? $nc_comprobante : 0) . "'," .(!empty($id_proveedor) ? $id_proveedor : 0) . "," .
        (!empty($id_compra) ? $id_compra : 0) . "," .(!empty($id_usuario) ? $id_usuario : 0) . "," .
        (!empty($id_sucursal) ? $id_sucursal : 0) . ",'" .(!empty($nc_fecha_sistema) ? $nc_fecha_sistema : "14-08-23") . "','" .
        (!empty($nc_fecha_recibido) ? $nc_fecha_recibido : "14-08-23") . "'," .(!empty($nc_nro_timbrado) ? $nc_nro_timbrado : "0") . ",'" .
        (!empty($nc_timbrado_venc) ? $nc_timbrado_venc : "14-08-23")."',".(!empty($vid_motivo) ? $vid_motivo:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:debito_detalle.php");
}
