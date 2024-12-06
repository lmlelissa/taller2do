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
$pdf->SetTitle('REPORTE DE COBROS');
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
$pdf->Cell(0, 0, "REPORTE DE COBROS", 0, 1, 'C');
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
    $cobros = consultas::get_datos("select * from v_cobros where fecha BETWEEN '" . $_REQUEST['vdesde'] . "' AND '" . $_REQUEST['vhasta'] . "'");
    if (!empty($cobros)) {
        foreach ($cobros as $cobro) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(30, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'CLIENTE', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(30, 5, $cobro['id_cobro'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['fecha1'], 0, 0, 'C', 1);
            $pdf->Cell(80, 5, $cobro['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['total'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['estado'], 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_cobros_detalle WHERE id_cobro=" . $cobro['id_cobro'] . " ORDER BY id_cobro");
            if (!empty($detalles)) {
                $pdf->SetFont('times', 'B', 9);
                $pdf->Cell(0, 3, 'DETALLE DE COBROS NRO.:    ' . $cobro['id_cobro'], 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(55, 5, 'FACTURA N°', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'CONDICION', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'IMPORTE', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'EFECTIVO', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'TARJETA', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'CHEQUE', 1, 0, 'C', 1);
                $pdf->Ln();

                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(55, 5, $detalle['nro_factura'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['condicion'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['cta_importe'], 1, 0, 'C', 1);
                }
                $formacobro = consultas::get_datos("SELECT * FROM v_cobros_forma_detalle WHERE id_cobro=" . $cobro['id_cobro'] . " ORDER BY id_cobro");
                foreach ($formacobro as $formacob) {
                    if ($formacob['id_fc'] == 1) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                    if ($formacob['id_fc'] == 2) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                    if ($formacob['id_fc'] == 3) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                }
                $pdf->Ln();
            } else {
                $pdf->SetFont('times', 'B', '10');
                $pdf->Cell(265, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
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
    $cobros = consultas::get_datos("select * from v_cobros where estado ='" . $_REQUEST['vestado'] . "'");
    if (!empty($cobros)) {
        foreach ($cobros as $cobro) {
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(30, 5, '#', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'CLIENTE', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(30, 5, $cobro['id_cobro'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['fecha1'], 0, 0, 'C', 1);
            $pdf->Cell(80, 5, $cobro['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['total'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $cobro['estado'], 0, 0, 'C', 1);
            $pdf->Ln();
            $pdf->Ln();
            $detalles = consultas::get_datos("SELECT * FROM v_cobros_detalle WHERE id_cobro=" . $cobro['id_cobro'] . " ORDER BY id_cobro");
            if (!empty($detalles)) {
                $pdf->SetFont('times', 'B', 9);
                $pdf->Cell(0, 3, 'DETALLE DE COBROS NRO.:    ' . $cobro['id_cobro'], 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->SetFont('', 'B', 10);
                $pdf->SetFillColor(188, 188, 188);
                $pdf->Cell(55, 5, 'FACTURA N°', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'CONDICION', 1, 0, 'C', 1);
                $pdf->Cell(50, 5, 'IMPORTE', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'EFECTIVO', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'TARJETA', 1, 0, 'C', 1);
                $pdf->Cell(35, 5, 'CHEQUE', 1, 0, 'C', 1);
                $pdf->Ln();

                $pdf->SetFont('', '', 10);
                $pdf->SetFillColor(255, 255, 255);

                foreach ($detalles as $detalle) {
                    $pdf->Cell(55, 5, $detalle['nro_factura'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['condicion'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $detalle['cta_importe'], 1, 0, 'C', 1);
                }
                $formacobro = consultas::get_datos("SELECT * FROM v_cobros_forma_detalle WHERE id_cobro=" . $cobro['id_cobro'] . " ORDER BY id_cobro");
                foreach ($formacobro as $formacob) {
                    if ($formacob['id_fc'] == 1) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                    if ($formacob['id_fc'] == 2) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                    if ($formacob['id_fc'] == 3) {
                        $pdf->Cell(35, 5, $formacob['monto'], 1, 0, 'C', 1);
                    }
                }
                $pdf->Ln();
            } else {
                $pdf->SetFont('times', 'B', '10');
                $pdf->Cell(265, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
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
$pdf->Output('reporte_de cobros.pdf', 'I');
?>
