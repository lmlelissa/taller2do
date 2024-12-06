<?php
require '../../conexion.php';
session_start();
$operacion = $_REQUEST['voperacion'];
$vid_ajuste = (!empty($_REQUEST['vid_ajuste']) ? $_REQUEST['vid_ajuste']:0);
$vid_producto = (!empty($_REQUEST['vid_producto']) ? $_REQUEST['vid_producto']:0);
$vid_deposito = (!empty($_REQUEST['vid_deposito']) ? $_REQUEST['vid_deposito']:0);
$vid_mj = (!empty($_REQUEST['vid_mj']) ? $_REQUEST['vid_mj']:0);
$vid_usuario = (!empty($_REQUEST['vid_usuario']) ? $_REQUEST['vid_usuario']:0);
$vaj_fecha = (!empty($_REQUEST['vaj_fecha']) ? $_REQUEST['vaj_fecha']:"14-08-23");
$vaj_observacion = (!empty($_REQUEST['vaj_observacion']) ? $_REQUEST['vaj_observacion']:"SIN OBS.");
$vaj_cantidad = (!empty($_REQUEST['vaj_cantidad']) ? $_REQUEST['vaj_cantidad']:0);
$vaj_estado = (!empty($_REQUEST['vaj_estado']) ? $_REQUEST['vaj_estado']:"PENDIENTE");


$sql = "SELECT sp_compras_ajustes(".$operacion.",".$vid_ajuste.",".$vid_producto.",".$vid_deposito.",".$vid_mj.",".$vid_usuario.",'".$vaj_fecha."','".$vaj_observacion."',".$vaj_cantidad.",'".$vaj_estado."') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ajuste_index.php");
}
