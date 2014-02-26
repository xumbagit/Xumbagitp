<?php
session_start();
/***************************************************
Archivos Requeridos
****************************************************/
require_once('lib/function_gen.php');
require_once('conf/config.conf.php');
require_once('lib/op_mysql.class.php');
$dbn=new op_mysql();
$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
/***************************************************
Validaciones de Campos
****************************************************/
if ( isset($_REQUEST['loginuser']) &&  isset($_REQUEST['passwordusu']) ){
	/***************************************************
	Valida si exite el registro
	****************************************************/
	$codError    = 0;
	$mensaje_str = '';

	$query="SELECT * FROM usuarios WHERE email='".trim($_REQUEST['loginuser'])."' and clave='".md5(trim($_REQUEST['passwordusu']))."'";
	$dbn->QuerySQL($query);
	$retorno=$dbn->getData();
	
	if ( strlen(trim($retorno['cedula']))== 0){ ;
		$codError    = 1;
		$mensaje_str = "Error, usuario no existe lo invitamos a que se registre.";
	}
	
	if ($codError == 0){
		//Usuario Activo
		if ((int) $retorno['statususu'] == 1){
			$usuario['nombre']         = $retorno['nombre'];
			$usuario['correo_sess']    = $_REQUEST['loginuser'];
			$usuario['id_usuario']     = $retorno['tipoidentificacion'].$retorno['cedula'];
			$usuario['acceso']         = 1;
			$usuario['actionSubastar'] = $retorno['estatus_subastar'];
			//Otros datos
			$usuario['telefono']       = $retorno['telefonohab'];
			$usuario['correo']         = $retorno['email'];
			$usuario['Actividad']      = $retorno['actividad'];
			$usuario['clave']          = $retorno['clave'];
			$usuario['estado']         = $retorno['idestado'];
			$usuario['municipio']      = $retorno['idmunicipio']; 
			$usuario['parroquia']      = $retorno['idparroquia'];
			$usuario['calle_ave']      = $retorno['calleav'];
			$usuario['edif_casa']      = $retorno['edifcasa'];
			
			$usuario['nro_identificacion'] = $retorno['cedula'];
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