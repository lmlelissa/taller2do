<?php

include '../../../plugins/tcpdf/tcpdf.php';
require '../../../conexion.php';

class MYPDF extends TCPDF {

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AV');
$pdf->SetTitle('REPORTE DE ORDENES DE COMPRAS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);
// AGREGAR PAGINA
$pdf->AddPage('L', 'A4');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE ORDENES DE COMPRAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

if ($_REQUEST['vop'] == '1') {
    $pedidos = consultas::get_datos("select * from v_compras_orden where ord_fecha BETWEEN '" . $_REQUEST['vdesde'] . "' AND '" . $_REQUEST['vhasta'] . "'");
    if (!empty($pedidos)) {
        foreach ($pedidos as $pedido) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $pedido['id_orden'], 0, 0, 'C', 1);
            $pdf->Cell(80, 5, $pedido['fecdate'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['suc_nombre'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['ord_estado'], 0, 0, 'C', 1);

            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE ORDEN NRO.:    ' . $pedido['id_orden'], 0, 0, 'C', 0);
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_compras_orden_detalle WHERE id_orden=" . $pedido['id_orden'] . " ORDER BY id_orden");
            if (!empty($detalles)) {
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(125, 5, 'PRODUCTO', 1, 0, 'C', 1);
                $pdf->Cell(125, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Ln();

                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(125, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                    $pdf->Cell(125, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
            }
            $pdf->Ln();
            $pdf->Cell(350, 0, '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(265, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}
if ($_REQUEST['vop'] == '2') {
    $pedidos = consultas::get_datos("select * from v_compras_orden where ord_estado ='" . $_REQUEST['vestado'] . "'");
    if (!empty($pedidos)) {
        foreach ($pedidos as $pedido) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $pedido['id_orden'], 0, 0, 'C', 1);
            $pdf->Cell(80, 5, $pedido['fecdate'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['suc_nombre'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $pedido['ord_estado'], 0, 0, 'C', 1);

            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE ORDEN NRO.:    ' . $pedido['id_orden'], 0, 0, 'C', 0);
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_compras_orden_detalle WHERE id_orden=" . $pedido['id_orden'] . " ORDER BY id_orden");
            if (!empty($detalles)) {
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(125, 5, 'PRODUCTO', 1, 0, 'C', 1);
                $pdf->Cell(125, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Ln();

                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($detalles as $detalle) {
                    $pdf->Cell(125, 5, $detalle['pro_descri'], 1, 0, 'C', 1);
                    $pdf->Cell(125, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
                $pdf->Ln();
                $pdf->Cell(350, 0, '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
                $pdf->Ln();
            }
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(265, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ordenes.pdf', 'I');
?>
