<?php

require '../../conexion.php';
session_start();

$voperacion = $_REQUEST['voperacion'];
$vid_fc = $_REQUEST['vid_fc'];
if ($vid_fc == 1) {
    $vid_cobro = $_REQUEST['vid_cobro'];
    $vmonto = $_REQUEST['vmonto'];

    $sql = "SELECT sp_cobros_forma_detalle(" . $voperacion . "," . $vid_fc . "," . $vid_cobro . "," . $vmonto . ") AS sql;";
    $resultado = consultas::get_datos($sql);
}
if ($vid_fc == 2) {
    $vid_ct = $_REQUEST['vid_ct'];
    $vid_cobro = $_REQUEST['vid_cobro'];
    $vnro_tarjeta = $_REQUEST['vnro_tarjeta'];
    $vid_ee = $_REQUEST['vid_ee'];
    $vid_mt = $_REQUEST['vid_mt'];
    $vnro_cupon = $_REQUEST['vnro_cupon'];
    $vtipo = $_REQUEST['vtipo'];
    $vfecha = $_REQUEST['vfecha'];
    $vmonto = $_REQUEST['vmonto'];
    $vestado = $_REQUEST['vestado'];

    $sql = "SELECT sp_cobros_tarjetas(" . $voperacion . "," . $vid_ct . "," . $vid_cobro . "," . $vnro_tarjeta . "," . $vid_ee . "," . 
        $vid_mt. "," . $vnro_cupon . ",'" . $vtipo. "','" . $vfecha . "'," . $vmonto . ",'" . $vestado. "') AS sql;";
    $resultado = consultas::get_datos($sql);
}
if ($vid_fc == 3) {
    $vid_cch = $_REQUEST['vid_cch'];
    $vid_cobro = $_REQUEST['vid_cobro'];
    $vid_banco = $_REQUEST['vid_banco'];
    $vnro_cheque = $_REQUEST['vnro_cheque'];
    $va_orden_de = $_REQUEST['va_orden_de'];
    $vfecha = $_REQUEST['vfecha'];
    $vtipo = $_REQUEST['vtipo'];
    $vcheque_venc = $_REQUEST['vcheque_venc'];
    $vmonto = $_REQUEST['vmonto'];
    $vestado = $_REQUEST['vestado'];

    $sql = "SELECT sp_cobros_cheques(" . $voperacion . "," . $vid_cch . "," . $vid_cobro . "," . $vid_banco . "," . $vnro_cheque . ",'" . 
    $va_orden_de. "','" . $vfecha . "','" . $vtipo. "','" . $vcheque_venc . "'," . $vmonto . ",'" . $vestado. "') AS sql;";
    $resultado = consultas::get_datos($sql);
}

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
    header("location:" . $valor[1] . ".php?vid_cobro=" . $vid_cobro);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:cobros_forma.php?vid_cobro=" . $vid_cobro);
}
