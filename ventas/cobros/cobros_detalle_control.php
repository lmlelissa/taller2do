<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_cobro = $_REQUEST['vid_cobro'];
$vid_cta = $_REQUEST['vid_cta'];
$vmonto = $_REQUEST['vmonto'];
$vgravada_5 = $_REQUEST['vgravada_5'];
$vgravada_10 = $_REQUEST['vgravada_10'];
$vexenta = $_REQUEST['vexenta'];

$sql = "SELECT sp_cobros_detalle(" . $voperacion . "," . $vid_cobro . "," . $vid_cta . "," . $vmonto . "," . $vgravada_5 . "," . $vgravada_10 . "," . $vexenta . ") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
    header("location:" . $valor[1] . ".php?vid_cobro=" . $vid_cobro);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:cobros_detalle.php?vid_cobro=" . $vid_cobro);
}
