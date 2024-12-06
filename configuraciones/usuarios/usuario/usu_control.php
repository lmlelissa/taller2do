<?php

require '../../../conexion.php';
session_start();

$cod = $_REQUEST['vid_usuario'];
$empleado = $_REQUEST['vid_empleado'];
$foto = $_REQUEST['vusu_foto'];
$nick = $_REQUEST['vusu_nick'];
$clave = $_REQUEST['vusu_clave'];
$estado = $_REQUEST['vusu_estado'];
$perfil = $_REQUEST['vid_perfil'];
$sucursal = $_REQUEST['vid_sucursal'];
$operacion = $_REQUEST['voperacion'];

$sql = "SELECT sp_ref_usuarios(" . $cod . "," . $empleado . ",'" . $foto . "','" . $nick .  "','" . $clave . "','" . $estado . 
        "'," . $perfil . "," . $sucursal . "," . $operacion . ") as usuarios";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuarios'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso ' + $sql;
    header('location:./usu_index.php' . $_REQUEST['vpagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['usuarios'];
    header('location:./usu_index.php' . $_REQUEST['vpagina']);
}
?>
