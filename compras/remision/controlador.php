<?php
session_start();
require '../../conexion.php';

$voperacion = $_REQUEST['voperacion'];
$vid_nr = $_REQUEST['vid_nr'];
$vid_usuario = $_REQUEST['vid_usuario'];
$vid_empleado = $_REQUEST['vid_empleado'];
$vid_vehiculo = $_REQUEST['vid_vehiculo'];
$vnr_timbrado = $_REQUEST['vnr_timbrado'];
$vnr_fecha = $_REQUEST['vnr_fecha'];
$vfecha_inicio = $_REQUEST['vfecha_inicio_translado'];
$vfecha_fin= $_REQUEST['vfecha_fin_translado'];
$vmotivo_translado= $_REQUEST['vmotivo_translado'];
$vsucursal_salida = $_REQUEST['vsucursal_salida'];
$vsucursal_entrada = $_REQUEST['vsucursal_entrada'];
$vnr_estado = $_REQUEST['vnr_estado'];

$sql = "SELECT sp_nota_remision(". $voperacion . ",". $vid_nr.",".$vid_usuario.",".$vid_empleado.",".$vid_vehiculo.",".$vnr_timbrado.",'".
        $vnr_fecha."','".$vfecha_inicio."','".$vfecha_fin."','".$vmotivo_translado."',".$vsucursal_salida.",".
        $vsucursal_entrada.",'".$vnr_estado."') AS sql";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1] . ".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:index.php");
}
