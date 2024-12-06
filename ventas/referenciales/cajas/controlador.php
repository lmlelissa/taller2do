<?php
session_start();
require '../../../conexion.php';

$voperacion = $_REQUEST['voperacion'];
$vid_caja = $_REQUEST['vid_caja'];
$vid_sucursal = $_REQUEST['vid_sucursal'];
$vdescripcion = $_REQUEST['vdescripcion'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_ref_cajas(". $voperacion . ",". $vid_caja.",".$vid_sucursal.",'".$vdescripcion."','".$vestado ."') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:index.php");
}
