<?php

session_start();
require '../../../conexion.php';

$voperacion = $_REQUEST['voperacion'];
$vid_tim = $_REQUEST['vid_tim'];
$vid_caja = $_REQUEST['vid_caja'];
$vid_tipo_doc = $_REQUEST['vid_tipo_doc'];
$vid_sucursal = $_REQUEST['vid_sucursal'];
$vfecha_inicio = $_REQUEST['vfecha_inicio'];
$vfecha_fin = $_REQUEST['vfecha_fin'];
$vfecha_carga = $_REQUEST['vfecha_carga'];
$vnumero_inicial = $_REQUEST['vnumero_inicial'];
$vnumero_final = $_REQUEST['vnumero_final'];
$vnumero_actual = $_REQUEST['vnumero_actual'];
$vpunto_expedicion = $_REQUEST['vpunto_expedicion'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_ref_timbrados(" . $voperacion . "," . $vid_tim . "," . $vid_caja . ",'" . $vid_tipo_doc . "'," . 
        $vid_sucursal . ",'" . $vfecha_inicio . "','" . $vfecha_fin . "','" . $vfecha_carga . "'," . 
        $vnumero_inicial . "," .$vnumero_final . "," . $vnumero_actual . "," . $vpunto_expedicion . ",'" . $vestado . "') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:index.php");
}
