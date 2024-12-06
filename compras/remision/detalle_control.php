<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$vid_nr = $_REQUEST['vid_nr'];
$vid_producto = $_REQUEST['vid_producto'];
$vid_deposito_salida = $_REQUEST['vid_deposito_salida'];
$vcantidad = $_REQUEST['vcantidad'];
$vid_deposito_entrada = $_REQUEST['vid_deposito_entrada'];
$vestado = $_REQUEST['vestado'];

$sql = "SELECT sp_nota_remision_detalle(". $operacion . ",". 
    (!empty($vid_nr) ? $vid_nr:0).",".
    (!empty($vid_producto) ? $vid_producto:0).",".
    (!empty($vid_deposito_salida) ? $vid_deposito_salida:0).",".
    (!empty($vcantidad) ? $vcantidad:0).",".
    (!empty($vid_deposito_entrada) ? $vid_deposito_entrada:0).",'".
    (!empty($vestado) ? $vestado:0)."') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vid_nr=".$vid_nr);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:detalle.php?vid_nr=".$vid_nr);
}
