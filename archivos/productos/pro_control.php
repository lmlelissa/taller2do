<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidproducto'];
$marca = $_REQUEST['vidmarca'];
$tipo = $_REQUEST['vidtipo'];
$tam = $_REQUEST['vid_serie'];
$impuesto = $_REQUEST['viva'];
$compra = $_REQUEST['vprecioc'];
$venta = $_REQUEST['vpreciov'];
$nombre = $_REQUEST['vnombre'];
$codigob = $_REQUEST['vcodbarra'];
$estado = $_REQUEST['vestado'];

$sql = "SELECT sp_ref_producto(" . $operacion . "," . $codigo . "," . $marca . "," . $tipo . "," . $tam . "," .
    $impuesto . "," . $compra . "," . $venta . ",'" . $nombre . "','" . $codigob . "','" . $estado . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:/sysmeli/archivos/" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pro_index.php");
}
