<?php	 	
session_start();
date_default_timezone_set('America/Caracas');

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
if ($_SESSION['variablespago']['tipo_persona'] == 'N') $_SESSION['variablespago']['tipo_contribuyente'] = 0;
//Terminos y condiciones
if ($_SESSION['variablespago']['terminos_condiciones'] == 'on') {
	$_SESSION['variablespago']['terminos_condiciones'] = 1;
}else{
	$_SESSION['variablespago']['terminos_condiciones'] = 0;
}

/***************************************************
Valida si exite el registro
****************************************************/
$codError    = 0;
$mensaje_str = '';

$query   = "SELECT 1 as existe FROM mt_usuario_foroisrl WHERE tipo_identificacion+nro_identificacion ='".trim($_SESSION['variablespago']['nacionalidad']).trim($_SESSION['variablespago']['nro_identificacion'])."'";
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
	
	if (strlen(trim($_REQUEST['tipo_pago'])) == 0 ) { 
		$_REQUEST['tipo_pago'] = "null";
	}
	if (strlen(trim($_REQUEST['banco_pago'])) == 0 ) { 
		$_REQUEST['banco_pago'] = "null";
	}
	
	
			
	//Numero de documento para el pago
	$tipo_pago = $_REQUEST['tipo_pagoisrl'];
	switch ((int)trim($tipo_pago)) {
	case 1:
		//DEPOSITO 
		$numero_documento = $_REQUEST['soporte_dep'];
		$titulopago = "DEPOSITO";
		$tipo_pago  = 1;
		break;
	case 2:
		//TRANSFERENCIA
		$numero_documento = $_REQUEST['soporte_tra'];
		$titulopago = "TRANSFERENCIA";
		$tipo_pago  = 2;
		break;
	case 3:
		$numero_documento = "";
		$titulopago = "TARJETA DE CREDITO";
		$tipo_pago  = 3;
		break;	
	}
	
	
	
	//Fecha de Pago
	if (strlen(trim($_REQUEST['fecha'])) == 0 ) { 
		$fechapago = "";
	}else{

		$fecha = explode('/',$_REQUEST["fecha"]);
		if (count($fecha) > 0 ){
			$fechapago =  $fecha[2] . '-' . $fecha[1] . '-' .$fecha[0];
		}else{
			$fechapago = date("Y-m-d");	
		
		}
	}
	
 $query  = "INSERT INTO mt_usuario_foroisrl (tipo_persona, nombre, tipo_identificacion, nro_identificacion, correo, clave, telefono, actividad, tipo_contribuyente, 			
						 calle_ave, edif_casa, estado, municipio, parroquia, estatus_usuario, estatus_subastar, terminos_condiciones,fecha_crea,fecha_modif, tipo_pago, nro_documento, banco, fecha_pago)
						 
	VALUES               ('".$_SESSION['variablespago']['tipo_persona']."', '".$_SESSION['variablespago']['nombre']."','".$_SESSION['variablespago']['nacionalidad']."','".
						$_SESSION['variablespago']['nro_identificacion']."','".$_SESSION['variablespago']['correoreg']."','".md5(trim($_SESSION['variablespago']['clave']))."','".$_SESSION['variablespago']['telefono']."','".
						$_SESSION['variablespago']['actividad']."',".$_SESSION['variablespago']['tipo_contribuyente'].",'".$_SESSION['variablespago']['calle_ave']."','".$_SESSION['variablespago']['edif_casa']."','".
						$_SESSION['variablespago']['estado']."','".$_SESSION['variablespago']['municipio']."','".$_SESSION['variablespago']['parroquia']."',1,0,".$_SESSION['variablespago']['terminos_condiciones'].",getdate(),getdate(),".$tipo_pago.",'".$numero_documento."',".$_REQUEST['banco_pago'].",'".$fechapago."')";
	//die($query); 				
	$result	= $dbn->db_query($query);
	$campo  = $dbn->db_num_rows($result);
	if($campo <> 1 ){
		$codError = 1;
		$mensaje_str = "Error en ingreso de datos (mt_usuario_foroisrl).";
	}
	
	/***************************************************
	Registro de Servicios
	****************************************************/
	if ($codError === 0){
		$query = '';
		for ($i = 0; $i < count($_SESSION['variablespago']['Servicios']); $i++) {
			$query .= "INSERT INTO mt_usuario_servicio_foroisrl select '".$_SESSION['variablespago']['nacionalidad'].$_SESSION['variablespago']['nro_identificacion']."', '".$_SESSION['variablespago']['Servicios'][$i]."' ";
		}
		
		$result	= $dbn->db_query($query);
		$campo  = $dbn->db_num_rows($result);
	
		if($campo <> 1 ){
			$codError = 1;
			$mensaje_str = "Error en ingreso de datos (mt_usuario_servicio_foroisrl).";	
		}	
	}
	

}

if ($codError === 0){
	$mensaje_str = "Estimado usuario, usted se ha registrado satisfactoriamente.";
}
require_once("lib/phpmailer/class.phpmailer.php");

if ($codError === 0){
	/******************************
	Envio de Correo a SUBASTA 
	******************************/
	
	$mail = new PHPMailer();
	$mail->IsSMTP();                                    
	$mail->Host = "dedrelay.secureserver.net";
	$mail->From = "atencion@subastafiscal.com";
	$mail->FromName = "SUBASTA FISCAL";
	$mail->AddAddress("nbianco@subastafiscal.com");
	$mail->AddAddress("atencion@subastafiscal.com");
	//$mail->AddAddress("artav17@gmail.com");
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Subject = "Inscripcion al Foro ISRL a tu medida";
	
	$mensaje = '
	<html>
	<head>
	<title>www.SubastaFical.com</title>
	</head>
	<body style="font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;">
	<p><font size="+2"><b>Inscripcion al Foro ISRL a tu medida</b></font></p>
	<table>
	<tr>
	  <td valign="top"><b>Nombre:</b></td>
	  <td>'.$_SESSION['variablespago']['nombre'].'
	</tr>
	<tr>
	  <td valign="top"><b>Identificacion:</b></td>
	  <td>'.$_SESSION['variablespago']['nacionalidad'].$_SESSION['variablespago']['nro_identificacion'].'
	</tr>
	<tr>
	  <td valign="top"><b>Telefono:</b></td>
	  <td>'.$_SESSION['variablespago']['telefono'].'
	</tr>
	<tr>
	  <td valign="top"><b>Correo:</b></td>
	  <td>'.$_SESSION['variablespago']['correoreg'].'
	</tr>
	<tr>
	  <td valign="top"><b>Servicios de Interes</b></td>
	  <td>';
	  $htmlstr = '';
	   
	   for ($i = 0; $i < count($_SESSION['variablespago']['Servicios']); $i++) {
			$query   = "SELECT nombre_servicio FROM df_servicios WHERE tipo_acceso = 1 and servicio = '".$_SESSION['variablespago']['Servicios'][$i]."'";
	  		$result	 = $dbn->db_query($query);
	  		$retorno = $dbn->db_fetch_array($result);
			$htmlstr .= $retorno['nombre_servicio']."<br>";
	   }
	  $mensaje.= $htmlstr;
	  $mensaje.= '</tr>
	  <tr>
	  <td valign="top"><b>Tipo de Pago:</b></td>
	  <td>'.$titulopago.'
	  </tr>';
	  $htmlstr = '';
	  if ((int)trim($tipo_pago) == 1 or (int)trim($tipo_pago) == 2){
	  	$htmlstr .= "<tr>";
		$htmlstr .= "<td>Documento:</td>";
		$htmlstr .= "<td>".$numero_documento."</td>";
		$htmlstr .= "</tr>";
		$htmlstr .= "<tr>";
		$htmlstr .= "<td>Fecha Documento:</td>";
		$htmlstr .= "<td>".$fechapago."</td>";
		$htmlstr .= "</tr>"; 
		if ((int)trim($tipo_pago) == 2){
			$htmlstr .= "<tr>";
			$htmlstr .= "<td>Banco:</td>";
			$htmlstr .= "<td>". fnGetBanco($_REQUEST['banco_pago'])."</td>";
			$htmlstr .= "</tr>";
		}
		
	  }
	  $mensaje.= $htmlstr;
	  $mensaje.= '</table>
	  </body>
	  </html>';
	
	$mail->Body    = $mensaje;
	$mail->Send();
}
$_SESSION['variablespago']['terminos_condiciones']  = "";
$seccionpage = 'Inscripcion al Foro ISRL a tu medida';
$retorno[0]['sesActiva']  = $codError;
$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
unset($_SESSION['variablespago']); 
echo json_encode($retorno);
?>
