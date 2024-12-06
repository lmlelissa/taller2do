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
$pdf->SetAuthor('SYSTEC');
$pdf->SetTitle('REPORTE DE VENTAS');
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
$pdf->Cell(0, 0, "REPORTE DE VENTAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);

if ($_REQUEST['vop'] == '1') {
    $ventas = consultas::get_datos("select * from v_ventas_factura where fecha BETWEEN '" . $_REQUEST['vdesde'] . "' AND '" . $_REQUEST['vhasta'] . "'");
    if (!empty($ventas)) {
        foreach ($ventas as $venta) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(15, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'FACTURA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $venta['id_venta'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $venta['fecha1'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['nro_factura'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['estado'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['total'], 0, 0, 'C', 1);
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_ventas_factura_detalle WHERE id_venta=" . $venta['id_venta'] . " ORDER BY id_venta");
            if (!empty($detalles)) {
                $pdf->SetFont('times', 'B', 9);
                $pdf->Cell(0, 3, 'DETALLE DE VENTAS NRO.:    ' . $venta['id_venta'], 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(100, 5, 'PRODUCTO', 1, 0, 'C', 1);
                $pdf->Cell(45, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'SUBTOTAL', 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($detalles as $detalle) {
                    if (!empty($detalle['pro_descri'])) {
                        $det = $detalle['pro_descri'];
                    } else {
                        $det = $detalle['servi_descri'];
                    }
                    $det = $pdf->Cell(100, 5, $det, 1, 0, 'C', 1);
                    $pdf->Cell(45, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['precio'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
            }
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

            $pdf->Ln();
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
    $ventas = consultas::get_datos("select * from v_ventas_factura where estado ='" . $_REQUEST['vestado'] . "'");
    if (!empty($ventas)) {
        foreach ($ventas as $venta) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(15, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'FACTURA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $venta['id_venta'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $venta['fecha1'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['nro_factura'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['estado'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['total'], 0, 0, 'C', 1);
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_ventas_factura_detalle WHERE id_venta=" . $venta['id_venta'] . " ORDER BY id_venta");
            if (!empty($detalles)) {
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(100, 5, 'PRODUCTO', 1, 0, 'C', 1);
                $pdf->Cell(45, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'SUBTOTAL', 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($detalles as $detalle) {
                    if (!empty($detalle['pro_descri'])) {
                        $det = $detalle['pro_descri'];
                    } else {
                        $det = $detalle['servi_descri'];
                    }
                    $det = $pdf->Cell(100, 5, $det, 1, 0, 'C', 1);
                    $pdf->Cell(45, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['precio'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
            }
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

            $pdf->Ln();
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

if ($_REQUEST['vop'] == '3') {
    $ventas = consultas::get_datos("select * from v_ventas_factura where id_cliente ='" . $_REQUEST['vid_cliente'] . "'");
    if (!empty($ventas)) {
        foreach ($ventas as $venta) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(15, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'FACTURA', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $venta['id_venta'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $venta['fecha1'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['nro_factura'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['estado'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $venta['total'], 0, 0, 'C', 1);
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_ventas_factura_detalle WHERE id_venta=" . $venta['id_venta'] . " ORDER BY id_venta");
            if (!empty($detalles)) {
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(100, 5, 'PRODUCTO', 1, 0, 'C', 1);
                $pdf->Cell(45, 5, 'CANTIDAD', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'SUBTOTAL', 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($detalles as $detalle) {
                    if (!empty($detalle['pro_descri'])) {
                        $det = $detalle['pro_descri'];
                    } else {
                        $det = $detalle['servi_descri'];
                    }
                    $det = $pdf->Cell(100, 5, $det, 1, 0, 'C', 1);
                    $pdf->Cell(45, 5, $detalle['cantidad'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['precio'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['subtotal'], 1, 0, 'C', 1);
                    $pdf->Ln();
                }
            }
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

            $pdf->Ln();
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
//SALIDA AL NAVEGADOR
$pdf->Output('reporte.pdf', 'I');
?>
