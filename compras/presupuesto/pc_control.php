<?php
require '../../conexion.php';
session_start();

$ope = $_REQUEST['voperacion'];
$pres = $_REQUEST['vpresupuesto'];
$suc = $_REQUEST['vsucursal'];
$usu = $_REQUEST['vusuario'];
$prv = $_REQUEST['vproveedor'];
$ped = $_REQUEST['vpedido'];
$fec = $_REQUEST['vfecha'];
$val = $_REQUEST['vvalidez'];
$mon = $_REQUEST['vmonto'];
$est = $_REQUEST['vestado'];

$sql = "SELECT sp_compras_presupuesto(" . $ope . "," .
        (!empty($pres) ? $pres : 0) . "," .
        (!empty($suc) ? $suc : 0) . "," .
        (!empty($usu) ? $usu : 0) . "," .
        (!empty($prv) ? $prv : 0) . "," .
        (!empty($ped) ? $ped : 0) . ",'" .
        (!empty($fec) ? $fec : "14-08-23") . "'," .
        (!empty($val) ? $val : 7) . "," .
        (!empty($mon) ? $mon : 0) . ",'" .
        (!empty($est) ? $est : "SIN ESTADO") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pc_index.php");
}
