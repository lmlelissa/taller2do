<?php
session_start();
require '../../../conexion.php';

$operacion = $_POST['voperacion'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];

$sql = "SELECT sp_ref_serie(". $operacion . ",". $codigo .",'".$nombre ."') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:tam_index.php");
}
