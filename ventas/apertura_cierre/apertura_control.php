<?php

require '../../conexion.php';
session_start();
$sql = "SELECT sp_ventas_apertura_cierre(" .
        $_REQUEST['vcod'] . "," .
        $_REQUEST['vcaja'] . "," .
        $_SESSION['id_usuario'] . "," .
        $_SESSION['id_sucursal'] . "," .
        $_REQUEST['apemonto'] . "," .
        $_REQUEST['accion'] . ") as apertura;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['apertura'] == null) {
    $valor = explode("*", $resultado[0]['apertura']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $valor = explode("*", $resultado[0]['apertura']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php?vcod=". $_REQUEST['vcod']);
}
?>


