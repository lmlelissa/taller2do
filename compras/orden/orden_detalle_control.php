<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$orden = $_REQUEST['vidorden'];
$producto = $_REQUEST['vidproducto'];
$deposito = $_REQUEST['viddeposito'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];


$sql = "SELECT sp_compras_orden_detalle(". $operacion . ",". 
        (!empty($orden) ? $orden:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).",".
        (!empty($precio) ? $precio:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vidord=".$orden);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:orden_detalle.php?vidord=".$orden);
}
