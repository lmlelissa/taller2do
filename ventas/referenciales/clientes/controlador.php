<?php
session_start();
require '../../../conexion.php';

$voperacion = $_REQUEST['voperacion'];
$vid_cliente = $_REQUEST['vid_cliente'];
$vid_persona = $_REQUEST['vid_persona'];
$vci = $_REQUEST['vper_ci'];
$vnombre = $_REQUEST['vper_nombres'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_ref_clientes(". $voperacion . ",". $vid_cliente.",".$vid_persona.",'".$vci."','".$vnombre."','".$vestado."') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:index.php");
}
