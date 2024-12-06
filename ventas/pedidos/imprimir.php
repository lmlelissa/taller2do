<?php

// Include the main TCPDF library (search for installation path).
include_once '../../plugins/tcpdf/tcpdf.php';
include_once '../../conexion.php';

$sql = "SELECT * FROM v_ventas_pedidos WHERE id_pedido = " . $_REQUEST['vid_pedido'] . " ORDER BY id_pedido";
$rs = consultas::get_datos($sql);
// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('PEDIDOS DE CLIENTE');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);
$pdf->Cell(50, 1, 'Pedido de Cliente', 0, 0, 'C', null, null, 1);

$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));

//datos de cabecera
$pdf->Ln(15);
//Fecha
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   NRO: ', 0, 0, 'l');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/* 1 */90, /* 2 */ 1, /* 3 */ $rs[0]['id_pedido'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->Ln(10);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/* 1 */90, /* 2 */ 1, /* 3 */ $rs[0]['fecha_corta1'], /* 4 */ 0, /* 5 */ 1, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   A NOMBRE DE: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/* 1 */90, /* 2 */ 1, /* 3 */ $rs[0]['cliente'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//cuadro de detalles
$pdf->RoundedRect(15, 65, 178, 155, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(30);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(100, 1, 'Descripcion', 0, 0, 'C');
$pdf->Cell(20, 1, 'Cantidad', 0, 0, 'C');
$pdf->Cell(25, 1, 'Precio', 0, 0, 'C');
$pdf->Cell(25, 1, 'Subtotal', 0, 0, 'C');
$pdf->Ln(5);

$consultas = "SELECT * FROM v_ventas_pedidos_detalle WHERE id_pedido=" . $_REQUEST['vid_pedido'];
$detalle = consultas::get_datos($consultas);

foreach ($detalle as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(100, 1, $report['producto'], 0, 0, 'C', null, null, 1, null, null, null);
    $pdf->Cell(20, 1, $report['cantidad'], 0, 0, 'C');
    $pdf->Cell(25, 1, number_format(($report['precio']), 0, ',', '.'), 0, 0, 'C');
    $pdf->Cell(25, 1, number_format(($report['subtotal']), 0, ',', '.'), 0, 1, 'C');
    $pdf->Ln(2);
}




$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'TOTAL GENERAL');
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(165, 243, 'Gs. ' . number_format(($rs[0]['total']), 0, ',', '.'));

$pdf->Output('pedidos.pdf', 'I');

