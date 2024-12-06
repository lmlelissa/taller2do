<?php

require '../../conexion.php';
session_start();

$ope = $_REQUEST['voperacion'];
$compra = $_REQUEST['vcompra'];
$orden = $_REQUEST['vorden'];
$usu = $_REQUEST['vusuario'];
$suc = $_REQUEST['vsucursal'];
$prv = $_REQUEST['vproveedor'];
$fec = $_REQUEST['vfecha'];
$fecfac = $_REQUEST['vfechafactura'];
$nrofac = $_REQUEST['vfactura'];
$nrotim = $_REQUEST['vtimbrado'];
$timvenc = $_REQUEST['vvencimiento'];
$condi = $_REQUEST['vcondicion'];
$cuota = $_REQUEST['vcuota'];
$inter = $_REQUEST['vintervalo'];
$iva = $_REQUEST['vtotiva'];
$mon = $_REQUEST['vtotal'];
$est = $_REQUEST['vestado'];

$sql = "SELECT sp_compras(" . $ope . "," .
        (!empty($compra) ? $compra : 0) . "," .
        (!empty($orden) ? $orden : 0) . "," .
        (!empty($usu) ? $usu : 0) . "," .
        (!empty($suc) ? $suc : 0) . "," .
        (!empty($prv) ? $prv : 0) . ",'" .
        (!empty($fec) ? $fec : "14-08-23") . "','" .
        (!empty($fecfac) ? $fecfac : "14-08-23") . "','" .
        (!empty($nrofac) ? $nrofac : "001-001-12345") . "','" .
        (!empty($nrotim) ? $nrotim : "1234567") . "','" .
        (!empty($timvenc) ? $timvenc : "14-08-23") . "','" .
        (!empty($condi) ? $condi : 0) . "'," .
        (!empty($cuota) ? $cuota : 1) . ",'" .
        (!empty($inter) ? $inter : 30) . "'," .
        (!empty($iva) ? $iva : 0) . "," .
        (!empty($mon) ? $mon : 0) . ",'" .
        (!empty($est) ? $est : "SIN ESTADO") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:compras_index.php");
}
