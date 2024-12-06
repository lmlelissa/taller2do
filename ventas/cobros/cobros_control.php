<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_cobro = $_REQUEST['vid_cobro'];
$vid_apecie = $_REQUEST['vid_apecie'];
$vid_cliente = $_REQUEST['vid_cliente'];
$vfecha = $_REQUEST['vfecha'];
$vestado = $_REQUEST['vestado'];
$vexentas = $_REQUEST['vexentas'];
$viva5 = $_REQUEST['viva5'];
$viva10 = $_REQUEST['viva10'];
$vivatotal= $_REQUEST['vivatotal'];
$vtotal = $_REQUEST['vtotal'];
$vnro_recibo = $_REQUEST['vnro_recibo'];
$vcondicion = $_REQUEST['vcondicion'];


$sql = "SELECT sp_cobros(" . $voperacion . "," . $vid_cobro . "," . $vid_apecie . "," . $vid_cliente . ",'" . $vfecha . "','" .
        $vestado . "'," . $vexentas . "," . $viva5 . "," . $viva10 . "," . $vivatotal. "," . $vtotal. ",'" .(!empty($vnro_recibo) ? $vnro_recibo : null). "','". $vcondicion . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php?vid_cobro=".$vid_cobro);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:cobros_index.php");
}
