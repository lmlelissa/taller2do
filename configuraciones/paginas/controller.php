<?php

require '../../conexion.php';
session_start();
$pagina = $_REQUEST['vpag'];
$direccion = $_REQUEST['vdireccion'];
$nombre = $_REQUEST['vnombre'];
$modulo = $_REQUEST['vmodulo'];
$operacion = $_REQUEST['accion'];

$sql = "SELECT sp_ref_paginas(" . $pagina . ",'" . $direccion . "','" . $nombre . "'," . $modulo . "," . $operacion . ") as paginas;";

$resultado = consultas::get_datos($sql);
if ($resultado[0]['paginas'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['paginas'];
    header('location:./' . $_REQUEST['pagina']);
}
?>
        