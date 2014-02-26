<?php
	session_start();
	/***************************************************
	Archivos Requeridos
	****************************************************/
	require_once('lib/function_gen.php');
	require_once('conf/config.conf.php');
	require_once('lib/op_mysql.class.php');
	$dbnreg=new op_mysql();
	$dbnreg->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	/***************************************************
	Validaciones de Campos
	****************************************************/
	//Si es persona natural
	if($_REQUEST['tipo_persona']=='N'){
		$_REQUEST['tipo_contribuyente']=0;
	}
	//Terminos y condiciones
	if($_REQUEST['terminos_condiciones']=='on'){
		$_REQUEST['terminos_condiciones']=1;
	}
	else{
		$_REQUEST['terminos_condiciones']=0;
	}
	/***************************************************
	Valida si exite el registro
	****************************************************/
	$codError=0;
	$mensaje_str='';
	$query   = "SELECT * FROM usuarios WHERE tipoidentificacion='".trim($_REQUEST['nacionalidad'])."' AND cedula='".trim($_REQUEST['nro_identificacion'])."'";
	if($dbnreg->QuerySQL($query)==0){
		if($dbnreg->getFilas()>0){
			//echo("HOLA");
			/*getData obtiene informacion de la consulta */
			$codError = 1;
			$mensaje_str  = "Error, usuario ya registrado, verifique sus datos.";
		}	
	}
	//echo($mensaje_str);
	/***************************************************
	Datos de Registro
	****************************************************/
	if ($codError==0){
		$query="INSERT INTO usuarios(tipopersona, nombre, tipoidentificacion, cedula, email, clave, telefonohab, actividad, tipocontrib, calleav, edifcasa, idestado, idmunicipio, idparroquia, statususu, statusub,fechacrea,fechamodif) VALUES ('".$_REQUEST['tipo_persona']."','".$_REQUEST['nombre']."','".$_REQUEST['nacionalidad']."','".$_REQUEST['nro_identificacion']."','".$_REQUEST['correoreg']."','".md5(trim($_REQUEST['clave']))."','".$_REQUEST['telefono']."','".$_REQUEST['actividad']."','".$_REQUEST['tipo_contribuyente']."','".$_REQUEST['calle_ave']."','".$_REQUEST['edif_casa']."','".$_REQUEST['estado']."','".$_REQUEST['municipio']."','".$_REQUEST['parroquia']."',1,0,CURDATE(),CURDATE())";
		//die($query);
		if($dbnreg->QuerySQL($query)!=0){
			$codError=1;
			$mensaje_str="Error en ingreso de datos (usuarios).";
		}
		
		/***************************************************
		Registro de Servicios
		****************************************************/
		if($codError==0){
			$query='';
			$htmlstr='';
			for($i=0;$i<count($_REQUEST['Servicios']);$i++){
				$query="INSERT INTO adjservicios(idservicio,cedusuario) VALUES('".$_REQUEST['Servicios'][$i]."','".$_REQUEST['nacionalidad'].$_REQUEST['nro_identificacion']."')";
				$pedido=$dbnreg->QuerySQL($query);
			}
			if($dbnreg->QuerySQL($query)!=0){
				$codError=1;
				$mensaje_str="Error en ingreso de datos (mt_usuario_servicio).";
			}
		}
	}
	
	/***************************************************
	Configuracion de Session de usuario
	****************************************************/
	if ($codError==0){
		$usuario['nombre']=$_REQUEST['nombre']." ".$_REQUEST['apellido'];
		$usuario['correo_sess']=$_REQUEST['correoreg'];
		$usuario['id_usuario']  =$_REQUEST['nacionalidad'].$_REQUEST['nro_identificacion'];
		$usuario['acceso'] = 1;
		$usuario['actionSubastar']=0;
		$_SESSION['g_usuario']=$usuario;
	}
	require_once("lib/phpmailer/class.phpmailer.php");
	if ($codError === 0){
		/******************************
		Envio de Correo a SUBASTA 
		******************************/
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
		  <td valign="top"><b></b></td>
		  <td>';
		  $mensaje.=$htmlstr;
		  $mensaje.='</tr>
		  </table>
		  </body>
		  </html>';
		$aenviar='admin@subastafiscal.com';
		//$toenviar='psicorisascanada@gmail.com';
		$toenviar='avasquez@xumbadevenezuela.com';
		$cabeceras = "MIME-Version: 1.0\r\n";
		$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$cabeceras .= "From: ".$aenviar."\r\n"."Reply-To: ".$aenviar."\r\n" .'X-Mailer: PHP/' . phpversion();
		$asunto="Nuevo ingreso de Usuario";
		mail($toenviar,$asunto,$mensaje,$cabeceras);
	}
	$mensaje_str = "Su registro se ha enviado satisfactoriamente,<br>recibirá un correo de confirmación.";
	$seccionpage = 'Registro de Usuario';
	$retorno[0]['sesActiva']=$codError;
	$retorno[0]['sesHtml']=fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
	echo json_encode($retorno);
?>