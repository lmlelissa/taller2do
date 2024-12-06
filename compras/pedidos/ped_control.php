<?php
require '../../conexion.php';
session_start();

$ope = $_REQUEST['voperacion'];
$ped = $_REQUEST['vpedido'];
$suc = $_REQUEST['vsucursal'];
$usu = $_REQUEST['vusuario'];
$fec = $_REQUEST['vfecha'];
$obs = $_REQUEST['vobs'];

$sql = "SELECT sp_compras_pedidos(" . $ope . "," .
        (!empty($ped) ? $ped : 0) . "," .
        (!empty($suc) ? $suc : 0) . "," .
        (!empty($usu) ? $usu : 0) . ",'" .
        (!empty($fec) ? $fec : "14-08-23") . "','" .
        (!empty($obs) ? $obs : "SIN OBS") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ped_index.php");
}
