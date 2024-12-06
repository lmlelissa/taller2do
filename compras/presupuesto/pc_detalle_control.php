<?php
require '../../conexion.php';
session_start();


$operacion = $_REQUEST['voperacion'];
$pres = $_REQUEST['vidpresu'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];
$subtotal = $_REQUEST['vsubtotal'];

$sql = "SELECT sp_compras_presupuesto_detalle(". $operacion . ",". 
        (!empty($pres) ? $pres:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).",".
        (!empty($precio) ? $precio:0).",".
        (!empty($subtotal) ? $subtotal:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vidpc=" .$pres);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:pc_detalle.php?vidpc=" . $pres);
}
