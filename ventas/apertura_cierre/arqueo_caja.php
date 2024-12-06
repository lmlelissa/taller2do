<?php
session_start();
include_once '../../plugins/tcpdf/tcpdf.php';
include_once '../../conexion.php';
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));

$sql = "select * from v_ventas_apertura where id_apecie = " . $_REQUEST['vcod'];
$resul = consultas::get_datos($sql);

$pdf = new TCPDF('P', 'mm', array(215.9, 330.2));
$pdf->SetMargins(17, 15, 18);
$pdf->SetTitle("ARQUEO DE CAJA");
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 14);
//$pdf->SetLineWidth(5);
$pdf->Cell(0, 0, "ARQUEO DE LA APERTURA NRO: " . $resul[0]['id_apecie'] . " (" . $resul[0]['caj_descri'] . ")", 0, 1, 'C');

//RECUADRO IZQUIERDO
$pdf->RoundedRect(16, 30, 90, 22, 4.0, '1111', '', $style6, array(200, 200, 200));
//RECUADRO DERECHO
$pdf->RoundedRect(108, 30, 90, 22, 4.0, '1111', '', $style6, array(200, 200, 200));
$pdf->Ln(7);

//INFORMACION LINEA 1 IZQUIERDA
$pdf->SetFont('Times', 'B', 12); //TIPO DE LETRA PARA TITULO
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ 'CAJERO:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12); //TIPO DE LETRA PARA DATO
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $_SESSION['persona'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/* 1 */8, /* 2 */ 1, /* 3 */ '', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//INFORMACION LINEA 1 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12); //TIPO DE LETRA PARA TITULO
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'MONTO EN EFECTIVO:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12); //TIPO DE LETRA PARA DATO
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ number_format($resul[0]['monto_efectivo'], 0, ',', '.'), /* 4 */ 0, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
//INFORMACION LINEA 2 IZQUIERDA
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ 'FECHA APERTURA:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $resul[0]['fecha_apertura'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/* 1 */8, /* 2 */ 1, /* 3 */ '', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//INFORMACION LINEA 2 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12); //TIPO DE LETRA PARA TITULO
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'MONTO EN CHEQUE:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12); //TIPO DE LETRA PARA DATO
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ number_format($resul[0]['monto_cheque'], 0, ',', '.'), /* 4 */ 0, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
//INFORMACION LINEA 3 IZQUIERDA
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ 'FECHA CIERRE:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $resul[0]['fecha_cierre'], /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/* 1 */8, /* 2 */ 1, /* 3 */ '', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
//INFORMACION LINEA 3 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12); //TIPO DE LETRA PARA TITULO
$pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'MONTO EN TARJETA:', /* 4 */ 0, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
$pdf->SetFont('Times', '', 12); //TIPO DE LETRA PARA DATO
$pdf->Cell(/* 1 */35, /* 2 */ 1, /* 3 */ number_format($resul[0]['monto_tarjeta'], 0, ',', '.'), /* 4 */ 0, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
//DETALLES DE CHEQUES
$sqlchs = "select * from v_cobros_cheques where id_apecie = " . $resul[0]['id_apecie'] . "";
$rschs = consultas::get_datos($sqlchs);
if ($rschs) {
    $pdf->Ln(8);
    $pdf->SetFont('Times', 'B', 14);
    //$pdf->SetLineWidth(5);
    $pdf->Cell(0, 0, "DETALLE DE CHEQUES", 0, 1, 'C');
    $pdf->SetFont('Times', 'B', 10); //TIPO DE LETRA PARA TITULO
    $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'TITULAR', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ 'NRO. CHEQUE', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'BANCO', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ 'FECHA PAGO', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */30, /* 2 */ 1, /* 3 */ 'IMPORTE', /* 4 */ 1, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    foreach ($rschs as $chs) {
        $pdf->SetFont('Times', '', 10); //TIPO DE LETRA PARA TITULO
        $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $chs['a_orden_de'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ $chs['nro_cheque'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $chs['ban_descri'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ $chs['fechacobro_format'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */30, /* 2 */ 1, /* 3 */ number_format($chs['monto'], 0, ',', '.'), /* 4 */ 1, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    }
}
//DETALLES DE TARJETAS
$sqltars = "select * from v_cobros_tarjetas where id_apecie = " . $resul[0]['id_apecie'] . "";
$rstars = consultas::get_datos($sqltars);
if ($rstars) {
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 0, "DETALLE DE TARJETAS", 0, 1, 'C');
    $pdf->SetFont('Times', 'B', 10); //TIPO DE LETRA PARA TITULO
    $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'TARJETA', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ 'NRO. TARJETA', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ 'ENTIDAD', /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    $pdf->Cell(/* 1 */30, /* 2 */ 1, /* 3 */ 'IMPORTE', /* 4 */ 1, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);

    foreach ($rstars as $tar) {
        $pdf->SetFont('Times', '', 10); //TIPO DE LETRA PARA TITULO
        $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $tar['mt_descri'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */25, /* 2 */ 1, /* 3 */ $tar['nro_tarjeta'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */50, /* 2 */ 1, /* 3 */ $tar['ee_nombre'], /* 4 */ 1, /* 5 */ 0, /* 6 */ 'L', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
        $pdf->Cell(/* 1 */30, /* 2 */ 1, /* 3 */ number_format($tar['monto'], 0, ',', '.'), /* 4 */ 1, /* 5 */ 1, /* 6 */ 'R', /* 7 */ null, /* 8 */ null, /* 9 */ 1, /* 10 */ null, /* 11 */ null, /* 12 */ null);
    }
}
$pdf->Output('ARQUEO DE CAJA.pdf', 'I');
