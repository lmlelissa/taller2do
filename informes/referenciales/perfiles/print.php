<?php

include '../../../plugins/tcpdf/tcpdf.php';
require '../../../conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OSWASH');
$pdf->SetTitle('REPORTE DE PERFILES');
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
$pdf->AddPage('L', 'A5');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE PERFILES", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();
//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetLineWidth(0);
$pdf->SetFont('', '');
$pdf->SetFillColor(0);

$cabecera = consultas::get_datos("SELECT * FROM ref_perfiles ORDER BY id_perfil");
if (!empty($cabecera)) {
    $pdf->SetFillColor(230, 245, 250);
    $pdf->SetFont('', 'B', 12);
    $pdf->Cell(80, 5, '#', 0, 0, 'C', 1);
    $pdf->Cell(100, 5, 'DESCRIPCION', 0, 0, 'C', 1);
    $pdf->Ln();
    $pdf->Ln();
    foreach ($cabecera as $c) {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', '', 10);
        $pdf->Cell(80, 5, $c['id_perfil'], 0, 0, 'C', 1);
        $pdf->Cell(100, 5, $c['perf_nombre'], 0, 0, 'C', 1);
        $pdf->Ln();
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('times', 'B', '10');
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Cell(180, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_perfiles.pdf', 'I');
?>
