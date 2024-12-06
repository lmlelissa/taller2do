<?php

require '../../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidproveedor'];
$ciudad = $_REQUEST['vidciudad'];
$ruc = $_REQUEST['vruc'];
$razon = $_REQUEST['vrazon'];
$direccion = $_REQUEST['vdireccion'];
$telefono = $_REQUEST['vtelefono'];
$email = $_REQUEST['vemail'];

$sql = "SELECT sp_ref_proveedor(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($ciudad) ? $ciudad : 0) . ",'" .
        (!empty($ruc) ? $ruc : "SIN RUC") . "','" .
        (!empty($razon) ? $razon : "SIN RAZON") . "','" .
        (!empty($direccion) ? $direccion : "SIN DIRECCION") . "','" .
        (!empty($telefono) ? $telefono : "SIN TEL") . "','" .
        (!empty($email) ? $email : "@") . "') AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*", $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:/sysmeli/compras/referenciales/" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:prv_index.php");
}
