<?php
session_start();
require '../../conexion.php';

$operacion = $_POST['voperacion'];
$pagina = $_POST['vpagina'];
$codigo = $_POST['vcodigo'];
$nombre = $_POST['vnombre'];
$pais = $_POST['vpais'];

$sql = "SELECT sp_ref_ciudad(". $operacion . ",". $codigo .",'".$nombre ."'," . $pais .") AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:". $pagina);
}
