<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidempleado'];
$persona = $_REQUEST['vidpersona'];
$cargo= $_REQUEST['vidcargo'];

$sql = "SELECT sp_ref_empleado(". $operacion . ",". 
        (!empty($codigo) ? $codigo:0).",".
        (!empty($persona) ? $persona:0).",".
        (!empty($cargo) ? $cargo:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:emp_index.php");
}
