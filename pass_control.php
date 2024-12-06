<?php

require './conexion.php';
session_start();

$cod = $_REQUEST['vusuario'];
$nick = $_REQUEST['vusunick'];
$clave_old = $_REQUEST['vusupassold'];
$clave_new = $_REQUEST['vusupassnew'];
$operacion = $_REQUEST['voperacion'];

$sql = "SELECT sp_cambiar_pass(" . $cod . ",'" . $nick . "','" . $clave_old . "','" . $clave_new . "'," . $operacion . ") as usuarios";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuarios'] == null) {

    $_SESSION['mensaje'] = 'Error de Proceso ' + $sql;
    header('location:./' . $_REQUEST['vpagina']);
} else {

    $_SESSION['mensaje'] = $resultado[0]['usuarios'];
    header('location:./' . $_REQUEST['vpagina']);
}
?>


