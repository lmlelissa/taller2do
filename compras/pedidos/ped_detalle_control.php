<?php
require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$pedido = $_REQUEST['vidpedido'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];


$sql = "SELECT sp_compras_pedidos_detalle(". $operacion . ",". 
        (!empty($pedido) ? $pedido:0).",".
        (!empty($producto) ? $producto:0).",".
        (!empty($deposito) ? $deposito:0).",".
        (!empty($cantidad) ? $cantidad:0).") AS sql;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['sql'] != NULL) {
    $valor = explode("*" , $resultado[0]['sql']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
    header("location:" . $valor[1] . ".php?vid=" .$pedido);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:ped_detalle.php?vid=" . $pedido);
}
