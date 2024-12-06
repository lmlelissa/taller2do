<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidpersona'];
$ciudad = $_REQUEST['vidciudad'];
$cedula = $_REQUEST['vci'];
$fecha = $_REQUEST['vfechan'];
$nombre = $_REQUEST['vnombre'];
$apellido = $_REQUEST['vapellido'];
$ruc = $_REQUEST['vruc'];
$telefono = $_REQUEST['vtelefono'];
$email = $_REQUEST['vemail'];

$sql = "SELECT sp_ref_persona(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($ciudad) ? $ciudad : 0) . ",'" .
        (!empty($nombre) ? $nombre : "SIN NOMBRE") . "','" .
        (!empty($apellido) ? $apellido : "SIN APELLIDO") . "','" .
        (!empty($fecha) ? $fecha : "14-08-97") . "','" .
        (!empty($cedula) ? $cedula : "SIN CI") . "','" .
        (!empty($ruc) ? $ruc : "SIN RUC") . "','" .
        (!empty($telefono) ? $telefono : "SIN TEL") . "','" .
        (!empty($email) ? $email : "@") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:/sysmeli/archivos/" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:per_index.php");
}
