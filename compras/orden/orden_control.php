<?php
require '../../conexion.php';
session_start();

$ope = $_REQUEST['voperacion'];
$ord = $_REQUEST['vorden'];
$pres = $_REQUEST['vpresu'];
$ped= $_REQUEST['vped'];
$prv = $_REQUEST['vproveedor'];
$usu = $_REQUEST['vusuario'];
$suc = $_REQUEST['vsucursal'];
$fec = $_REQUEST['vfecha'];
$mon = $_REQUEST['vmonto'];
$est = $_REQUEST['vestado'];

$sql = "SELECT sp_compras_orden(" . $ope . "," .
        (!empty($ord) ? $ord : 0) . "," .
        (!empty($pres) ? $pres : 0) . "," .
        (!empty($ped) ? $ped : 0) . "," .
        (!empty($prv) ? $prv : 0) . "," .
        (!empty($usu) ? $usu : 0) . "," .
        (!empty($suc) ? $suc : 0) . ",'" .
        (!empty($fec) ? $fec : "14-08-23") . "'," .
        (!empty($mon) ? $mon : 0) . ",'" .
        (!empty($est) ? $est : "SIN ESTADO") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ord_index.php");
}
