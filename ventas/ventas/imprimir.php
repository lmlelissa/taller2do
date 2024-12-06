<?php

// Include the main TCPDF library (search for installation path).
include_once '../../plugins/tcpdf/tcpdf.php';
include_once '../../conexion.php';

$sql = "SELECT *,(select sp_numero_letras(total)) AS total_letra FROM v_ventas_factura WHERE id_venta = " . $_REQUEST['id_venta'] . " ORDER BY 1";
$rs = consultas::get_datos($sql);
// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('FACTURA DE VENTA');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);
$pdf->Cell(85, 1, 'SYSMELI', 0, 0, 'C', null, null, 1);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(90, 1, 'Dirección: Santa Rosa', 0, 0, 'C');
$pdf->Cell(85, 1, 'COMPROBANTE DE VENTA', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Teléfono: 0991 781 202', 0, 0, 'C');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(50, 1, '   Nro: ', 0, 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(70, 1, $rs[0]['id_venta'], 0, 0, 'L');

$pdf->SetFont('Times', '', 12);
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Timbrado N°: ' . '1', 0, 0, 'C');
$pdf->Cell(50, 1, '   Factura N°: ', 0, 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(70, 1, $rs[0]['nro_factura'], 0, 0, 'L');
$pdf->Ln(5);
$pdf->Cell(85, 1, 'Vigencia: ' . '05-08-2025', 0, 0, 'C');

$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
//cuadros de arriba
$pdf->RoundedRect(15, 12, 90, 42, 6.0, '1111', '', $style6, array(200, 200, 200));
$pdf->RoundedRect(105, 12, 87, 42, 6.0, '1111', '', $style6, array(200, 200, 200));

//cuadro de cabecera
$pdf->RoundedRect(15, 55, 177, 20, 5.0, '1111', '', $style6, array(200, 200, 200));

//datos de cabecera
$pdf->Ln(15);
//Fecha
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/* 1 */90, /* 2 */ 1, /* 3 */ $rs[0]['fecdate'], /* 4 */ 0, /* 5 */ 1, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   A NOMBRE DE: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/* 1 */90, /* 2 */ 1, /* 3 */ $rs[0]['cliente'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'A RUC DE: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rs[0]['per_ci'], 0, 1, 'L');
//$pdf->Text(165, 243, 'Gs. '.number_format(($rs[0]['total']),0,',','.'));
//datos de cabecera
//$pdf->Ln(3);
//cuadro de detalles
$pdf->RoundedRect(15, 75, 178, 155, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(10);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 1, 'Descripcion', 0, 0, 'C');
$pdf->Cell(33, 1, 'IVA 5', 0, 0, 'C');
$pdf->Cell(33, 1, 'IVA 10', 0, 0, 'C');
$pdf->Cell(33, 1, 'Exentas', 0, 0, 'C');
$pdf->Cell(35, 1, 'Subtotal', 0, 0, 'C');
$pdf->Ln(5);

$consultas = "SELECT * FROM v_ventas_factura_detalle WHERE id_venta=" . $_REQUEST['id_venta'];
$detalle = consultas::get_datos($consultas);

foreach ($detalle as $report) {
    $pdf->SetFont('Times', '', 10);
    if (!empty($report['pro_descri'])) {
        $concepto = $report['pro_descri'];
    } else {
        $concepto = $report['servi_descri'];
    }
    $pdf->Cell(40, 1, $concepto, 0, 0, 'C', null, null, 1, null, null, null);
    $pdf->Cell(33, 1, number_format(($report['iva5']), 0, ',', '.'), 0, 0, 'C');
    $pdf->Cell(33, 1, number_format(($report['iva10']), 0, ',', '.'), 0, 0, 'C');
    $pdf->Cell(33, 1, number_format(($report['exenta']), 0, ',', '.'), 0, 0, 'C');
    $pdf->Cell(35, 1, number_format(($report['subtotal']), 0, ',', '.'), 0, 1, 'C');
    $pdf->Ln(2);
}
$posicion = $pdf->GetY();
$pdf->Line(190, 230, 15, $posicion);

//cuadro de subtotales
$pdf->RoundedRect(15, 230, 177, 30, 4.0, '1111', '', $style6, array(200, 200, 200));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 235, 'TOTAL IVA');
$pdf->SetFont('Times', '', 10);
$pdf->Text(140, 235, 'Gs. ' . number_format(($rs[0]['total_iva']), 0, ',', '.'));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'TOTAL GENERAL');
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(165, 243, 'Gs. ' . number_format(($rs[0]['total']), 0, ',', '.'));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(55, 251, 'Son Gs. ' . ucfirst(strtolower($rs[0]['total_letra'])));
$pdf->Output('factura.pdf', 'I');

