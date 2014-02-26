<?php
date_default_timezone_set('America/Caracas');
require_once('config.conf.php');
require_once('op_mysql.class.php');
$dbn    = new op_mysql();
$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
/**************************************************************************************************
Funciones de Datos
***************************************************************************************************/
function fnc_ejecutaQuery($sql){
	$dbn    = new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$dbn->QuerySQL($sql);
	$i = 0;
	$data = '';
	while($retorno = $dbn->getData()){
		foreach ($retorno as $y => $a){
			$retorno[$y]  = $a;
		}
		$data[$i] = $retorno;
		$i++; 
	}
	
	return $data;
}



function fnc_zerofill ($num,$zerofill) {
    while(strlen($num)<$zerofill) {
       $num = "0".$num;
   }
   return $num;
}

function fnc_formatonum($num) {
   return @number_format($num, 2, '.', ',');
 
}


function fnc_rem_acentos($String){

	 $String = str_replace('á','&aacute;',$String);
	 $String = str_replace('é','&eacute;',$String);
	 $String = str_replace('í','&iacute;',$String);
	 $String = str_replace('ó','&oacute;',$String);
	 $String = str_replace('ú','&uacute;',$String);
	 $String = str_replace('Á','&Aacute;',$String);
	 $String = str_replace('É','&Eacute;',$String);
	 $String = str_replace('Í','&Iacute;',$String);
	 $String = str_replace('Ó','&Oacute;',$String);
	 $String = str_replace('Ú','&Uacute;',$String);
	 $String = str_replace('ñ','&ntilde;',$String);
	 $String = str_replace('Ñ','&Ntilde;',$String);
	 $String = str_replace('ä','&auml;',$String);
	 $String = str_replace('ë','&euml;',$String);
	 $String = str_replace('ï','&iuml;',$String);
	 $String = str_replace('ö','&ouml;',$String);
	 $String = str_replace('ü','&uuml;',$String);
	 $String = str_replace('Ä','&Auml;',$String);
	 $String = str_replace('Ë','&Euml;',$String);
	 $String = str_replace('Ï','&Iuml;',$String);
	 $String = str_replace('Ö','&Ouml;',$String);
	 $String = str_replace('Ü','&Uuml;',$String);
	 $String = str_replace('²','&sup2;',$String);
	 $String = str_replace('ñ','&ntilde;',$String);
	 $String = str_replace('Ñ','&Ntilde;',$String);
	return $String;
}

function fnc_getmes($var_mes){

	switch($var_mes){
	case '01':
	  $valorstr ='Enero';
	  break;
	case '02':
	  $valorstr ='Febrero';
	  break;
	case '03':
	  $valorstr ='Marzo';
	  break;	    
	case '04':
	  $valorstr ='Abril';
	  break;	    
	case '05':
	  $valorstr ='Mayo';
	  break;	    
	case '06':
	  $valorstr ='Junio';
	  break;	    
	case '07':
	  $valorstr ='Julio';
	  break;	    
	case '08':
	  $valorstr ='Agosto';
	  break;	    
	case '09':
	  $valorstr ='Septiembre';
	  break;
	case '10':
	  $valorstr ='Octubre';
	  break;
	case '11':
	  $valorstr ='Noviembre';
	  break;	    
	case '12':
	  $valorstr ='Diciembre';
	  break;	    
	}
	return $valorstr;
}
		 


function fnc_busca_servicio($prm_servicio){
	$query  = "SELECT * FROM servicios ORDER BY ID ASC";
	if($dbn->QuerySQL($query)==0){
		//echo("HOLA");echo(USUARIO_BD);
		echo($dbn->getFilas());
		if($dbn->getFilas()>0){
			//echo("HOLA");
			/*getData obtiene informacion de la consulta */
			$datasql=$dbn->getAllData();
		}
	}
	return $datasql;
}

function fnc_situacion_subastalog_user($topesql, $where){
	
 $query  = "SELECT substring(fecha_bid,9,2)+'-'+substring(fecha_bid,6,2)+'-'+substring(fecha_bid,1,4) as fecha_bid,mpo_bid,
				ULTIMA_OFERTA, cod_oferta, USUARIO_OFERTA_ACT, valor_nominal, origen, MPO_ACT, 
				monto_disponible, auditoria_externa, substring(periodo_uso,6,2) + '-'+substring(periodo_uso,1,4) as periodo_uso, alias_oferta, 
				precio_base, vencimiento, dias_vence 
				FROM view_situacion_subasta_user ".$where." order by valor_nominal DESC";
	
	$retorno = fnc_ejecutaQuery($query);
	if (!is_array($retorno)){return 0;}; 
	$registro = $retorno; 
	if (isset($topesql) and strlen($topesql) > 0){
		$registro = array_pad($retorno, $topesql, '');
	}
	return $registro;
}

function fnc_situacion_subasta_user($topesql, $where){
	 $query  = "SELECT distinct ULTIMA_OFERTA, cod_oferta, USUARIO_OFERTA_ACT, valor_nominal, origen, MPO_ACT, 
				monto_disponible, auditoria_externa, substring(periodo_uso,6,2) + '-'+substring(periodo_uso,1,4) as periodo_uso, alias_oferta, precio_base, vencimiento, dias_vence 
				FROM view_situacion_subasta_user ".$where." order by valor_nominal DESC";
	
	$retorno = fnc_ejecutaQuery($query);
	if (!is_array($retorno)){return 0;}; 

	$registro = $retorno; 
	if (isset($topesql) && strlen($topesql) > 0){
		$registro = array_pad($retorno, $topesql, '');
	}
	return $registro;
}


function fnc_situacion_subasta($topesql, $where){
	$query  = "SELECT ULTIMA_OFERTA, cod_oferta, USUARIO_OFERTA_ACT, valor_nominal, origen, MPO_ACT, 
				monto_disponible, auditoria_externa, substring(periodo_uso,6,2) + '-'+substring(periodo_uso,1,4) as periodo_uso, alias_oferta, precio_base, vencimiento, dias_vence 
				FROM view_situacion_subasta ".$where." order by valor_nominal DESC";
				
				//order by ULTIMA_OFERTA DESC, valor_nominal ASC
	
	$retorno = fnc_ejecutaQuery($query);
	if (!is_array($retorno)){return 0;}; 

	$registro = $retorno; 
	if (isset($topesql) && strlen($topesql) > 0){
		$registro = array_pad($retorno, $topesql, '');
	}
	return $registro;
}



function fn_subasta_general($prm_tope,$where){
	$retorno = fnc_situacion_subasta($prm_tope,$where);
	return $retorno;
}


/**************************************************************************************************
Funciones Visuales
***************************************************************************************************/
function fnGetBanco($cod_banco){
	if ( strlen($cod_banco) == 0) {
		return 0;
	}
	
	$query  = "SELECT convert(varchar(50),BMP_Codigo) +' - '+ BMP_Nombre as banco FROM mp_BasicoMP_BMP WHERE BMP_Origen = 5 and BMP_Codigo = ".$cod_banco;
	$retorno = fnc_ejecutaQuery($query);
	return $retorno[0]["banco"];	
}


function fncv_selectInput($valor,$classv,$option,$nameselect,$data){
	if (strlen($classv)>0){
		$classv = 'class="'.$classv.'"';
	}
	
	$htmlstring = '<select name="'.$nameselect.'" '.$classv.' '.$option.' >';
	$htmlstring .= '<option value="">[Seleccione]</option>';
	
	if (is_array($data)){
		foreach ($data as $k => $v){
			$campo = '';
			$i = 0;
			foreach ($v as $y => $a){
				$campo[$i] = $a;
				$i++;			
			}
			$selected = '';
			if ($campo[0] == $valor){
				$selected = 'selected';
			}
			$htmlstring .= '<option value="'.$campo[0].'" '.$selected.'>'. fnc_rem_acentos(utf8_encode($campo[3])).'</option>';
		}
	}
	$htmlstring .= "</select>";
	echo($htmlstring);
	return 0;
}



function fncv_mostrar_Subasta($topesql){
	$retorno = fnc_situacion_subasta($topesql,'');
	for ($i=0;$i<count($retorno);$i++){
		$retorno[$i]['botdetalle'] = '<a href="javascript:getSUBID(3,'.$retorno[$i]['cod_oferta'].');">detalle</a>';
	}
	return $retorno;
}


function fncv_mostrar_servicio($prm_servicio){
	$dbser=new op_mysql();
	$dbser->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
	$query="SELECT * FROM servicios ORDER BY ID ASC";
	if($dbser->QuerySQL($query)==0){
		//echo("HOLA");echo(USUARIO_BD);
		//echo($dbser->getFilas());
		if($dbser->getFilas()>0){
			//echo("HOLA");
			/*getData obtiene informacion de la consulta */
			echo "<table>";
			while($datasql=$dbser->getData()){
				echo "<tr>";
				echo "<td>";
		        echo '<input type="checkbox" class="box" name="Servicios[]"  value="'.$datasql['ID'].'"/>';
		        echo "</td>";
				echo "<td>";
				echo '<span class="textcheckbox">'.utf8_encode($datasql['servicio']).'</span>';
				echo "</td>";
				echo "</tr>";
				//fncv_mostrar_servicio($retorno[0]);
			}
			echo "</table>";
		}
	}
}


function fncv_mostrar_situacionSubasta($retorno){
	
	if (count($retorno) == 0){ return 0;}

	for($i=0;$i<count($retorno);$i++){
	   $classformat = 'class="fila_blanca"';
	   if(($i%2)== 0){
	   	$classformat = '';
	   }
	   
	   echo '<tr '.$classformat.'>';
		//Nro.Ref.
		echo '<td><span class="casillas">'.$retorno[$i]['cod_oferta'].'</span></td>';
		//Valor Nominal
		echo '<td><span class="casillas">'.fnc_formatonum($retorno[$i]['valor_nominal']).'</span></td>';
		//Monto Disponible
		echo '<td><span class="casillas">'.fnc_formatonum($retorno[$i]['monto_disponible']).'</span></td>';
		//Auditoría Externa
		echo '<td><span class="casillas">'.$retorno[$i]['auditoria_externa'].'</span></td>';
		//Período Uso
		echo '<td><span class="casillas">'.$retorno[$i]['periodo_uso'].'</span></td>';
		//Origen
		echo '<td><span class="casillas_origen">'.$retorno[$i]['origen'].'</span></td>';
		//Agentes Retención
		echo '<td><span class="casillas_altas">'.$retorno[$i]['alias_oferta'].'</span></td>';
		//Precio Base %
		echo '<td><span class="casillas">'.fnc_formatonum($retorno[$i]['precio_base']).'</span></td>';
		//MPO %
		echo '<td><span class="casillas_mpo" id="var_cod'.$retorno[$i]['cod_oferta'].'">'.fnc_formatonum($retorno[$i]['MPO_ACT']).'</span></td>';
		//Vence
		echo '<td><span class="casillas">'.$retorno[$i]['dias_vence'].'</span></td>';
		//Imagen BID 
		echo '<td><span class="bid">';
		if(isset($retorno[$i]['cod_oferta'])){
			echo '<a href="javascript:getSUBID(3,'.$retorno[$i]['cod_oferta'].');">BID</a>';
		}
		echo '</span></td>';
		echo '</tr>';
 	}
		
}


function fncv_mostrar_situacionSubastaLog($retorno){
	
	if (count($retorno) == 0){ return 0;};
    $htmlstring = ''; 
	
	for($i=0;$i<count($retorno);$i++){
	   $classformat = 'class="fila_blanca"';
	   if(($i%2)== 0){
	   	$classformat = '';
	   }
	   
	   $htmlstring.= '<tr '.$classformat.'>
           <td><span class="casillas">'.$retorno[$i]['fecha_bid'].'</span></td>
	        <td><span class="casillas">'.$retorno[$i]['cod_oferta'].'</span></td>
	        <td><span class="casillas">'.fnc_formatonum($retorno[$i]['valor_nominal']).'</span></td>
	        <td><span class="casillas">'.fnc_formatonum($retorno[$i]['monto_disponible']).'</span></td>
	        <td><span class="casillas">'.$retorno[$i]['auditoria_externa'].'</span></td>
	        <td><span class="casillas">'.$retorno[$i]['periodo_uso'].'</span></td>
	        <td><span class="casillas_origen">'.$retorno[$i]['origen'].'</span></td>
	        <td><span class="casillas_altas">'.$retorno[$i]['alias_oferta'].'</span></td>
	        <td><span class="casillas">'.fnc_formatonum($retorno[$i]['precio_base']).'</span></td>
	        <td><span class="casillas_mpo">'.fnc_formatonum($retorno[$i]['mpo_bid']).'</span></td>
	        <td><span class="casillas">'.$retorno[$i]['dias_vence'].'</span></td>
			</tr>';
 	}
	return $htmlstring;
}

function evenBanners($var){
	//Retorna siempre que el banner empiece en www
    if (substr($var,0,3)=='www'){
		return $var;
	}
	
}
function fnv_mostrar_banners($dir){
	$explorar = scandir($dir); 
	//Imagen
	$banners = array_filter($explorar,'evenBanners');
	sort($banners);
	$numfotos=(count($banners));
	$numal= mt_rand(0,$numfotos-1);
	$banners[$numal];
	//Url
	$tamano = strlen($banners[$numal]); 
	$imagen = strrev($banners[$numal]);
	$pos = strpos($imagen, '.');
	$url = strrev(substr($imagen,$pos+1,$tamano));
		
	echo '<a href="http://'.$url.'" target="_blank">
	<img src="'.$dir.$banners[$numal].'"  style="text-align: center; border:0px solid transparent;">
	</a>';
}

function fnv_mostrar_BID($retorno){

$htmlstring = '';
$htmlstring = '<div id="contenedoremergente">
				<div id="pestanaemergente">Seleccione la cantidad de BIDs a subastar<span id="boton_x"><a href="javascript:cerrar_popup(\'ventana\',0);">x</a></span>
				</div>
      			<div id="contenedorabajoemergente">
       				<div class="tabla_bid">
						<table width="656" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="46"><span class="valores2">Nro.<br />Ref.</span></td>
							<td width="73"><span class="valores2">Valor<br />Nominal</span></td>
							<td width="73"><span class="valores2">Monto<br />Disponible</span></td>
							<td width="62"><span class="valores2">Auditoría<br />Externa</span></td>
							<td width="60"><span class="valores2">Período Uso</span></td>
							<td width="57"><span class="valores2">Origen</span></td>
							<td width="62"><span class="valores2">Agentes<br />Retención</span></td>
							<td width="50"><span class="valores2">Precio <br />Base %</span></td>
							<td width="50"><span class="valores2">MPO %</span></td>
							<td width="55"><span class="valores2">Vence<br>(días)</span></td>
							<td width="53"><span class="valores2">Ofertar</span></td>
						 </tr>
						 <tr class="fila_linea">
	           				 <td colspan="12"></td>
             			 </tr>
          			</tr>
				  <tr class="fila_blanca">
					<td><span class="casillas" id="bid_codoferta">           '.$retorno[0]['cod_oferta'].        '</span></td>
					<td><span class="casillas" id="bid_nominal">             '.fnc_formatonum($retorno[0]['valor_nominal']).     '</span></td>
					<td><span class="casillas" id="bid_disponible">          '.fnc_formatonum($retorno[0]['monto_disponible']).  '</span></td>
					<td><span class="casillas" id="bid_auditoria">           '.$retorno[0]['auditoria_externa']. '</span></td>
					<td><span class="casillas" id="bid_periodo">             '.$retorno[0]['periodo_uso'].       '</span></td>
					<td><span class="casillas_origen" id="bid_origen">       '.$retorno[0]['origen'].            '</span></td>
					<td><span class="casillas_altas" id="bid_agentretencion">'.$retorno[0]['alias_oferta'].      '</span></td>
					<td><span class="casillas" id="bid_preciobase">          '.fnc_formatonum($retorno[0]['precio_base']).       '</span></td>
					<td><span class="casillas_mpo" id="bid_mpo">             '.fnc_formatonum($retorno[0]['MPO_ACT']).'</span></td>
					<td><span class="casillas" id="bid_fechavence">          '.$retorno[0]['dias_vence'].        '</span></td>
					<td><span class="bid1"><a href="javascript:selecBID(0.25);">+0.25</a></span></td> 
				  </tr>
				  <tr class="fila_blanca">
	        	  <td  height="26" colspan="10"></td>
	        		<td><span class="bid2"><a href="javascript:selecBID(0.50);">+0.50</a></span></td> 
          			</tr>
				  <tr class="fila_blanca">
					<td height="26" colspan="10"></td>
					<td><span class="bid3"><a href="javascript:selecBID(1.00);">+1.00</a></span></td> 
				  </tr>
				  <tr class="fila_linea">
					   <td colspan="12"></td>
				  </tr>
				</table>
				</div>
			  <div id="textoemergentebid"  style="display:none;">
				¿Estas seguro de aumentar la subasta <span class="aumento" id="aumento">+0.25 </span> ?
					<div id="acciones"><input type="hidden" id="BIDCodOferta" value="'.$retorno[0]['cod_oferta'].'"><input type="hidden" id="BIDOferta">
						<span class="boton_naranja_i"><a href="javascript:ingresaBID(BIDCodOferta.value,BIDOferta.value);">aceptar</a></span>
					</div>
			  </div>
			  </div>
			</div>';
return $htmlstring;	
}


function fnv_mostrar_mensajegeneral($tipo_error,$prm_seccion,$mensaje_page){
	switch ($tipo_error){
	case 0: 
		//Mensaje exitoso
		$classcss = 'checkverde';
		break;
	case 1: 
		//Mensaje de error
		$classcss = 'checkrojo';
		break;
	case 2: 
		//Mensaje de informacion
		$classcss = 'checkamarillo';
		break;	
	}
	//Contruye ventana
	$htmlstring = '';
	$htmlstring .= '<div id="contenedoremergente">';
	$htmlstring .= '<div id="pestanaemergente"><h6>'.$prm_seccion.'</h6></div>';
    $htmlstring .= '<div id="contenedorabajoemergente">';
    $htmlstring .= '<div class="'.$classcss.'"></div>';
    $htmlstring .= '<div id="textoemergente">'.$mensaje_page.'</div>';
    $htmlstring .= '</div>';
	$htmlstring .= '</div>';
	echo($htmlstring);
	return 0;
}

/**************************************************************************************************
Funciones de Respuesta de JQuery
***************************************************************************************************/
switch ( trim($_REQUEST['accionpage']) ) {
case 1: 
	
	//Muestra lista de valores fiscales en el home
	$retorno = fncv_mostrar_Subasta($_REQUEST['prm_valor']);
	echo json_encode($retorno);
	break;
	
case 2:
	
	//Valida si puede o ingresar ofertas.	
	if(isset($_SESSION['g_usuario']['acceso'])){
		//Valida permiso para subastar
		if($_SESSION['g_usuario']['actionSubastar'] == '0'){
			$codError = 2;
			$mensaje_str = 'Estimado usuario, su información de registro esta siendo evaluada por nuestros expertos <br> para poder ofertar, se le notificará por correo electrónico el estatus de su cuenta.';
			$seccionpage = 'Información';
			$retorno[0]['sesActiva']  = 0;
			$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		}else{
			$retorno[0]['sesActiva']  = 1;
		}
		echo json_encode($retorno);
	}else{
		$codError = 2;
		$mensaje_str = 'Estimado usuario, para poder subastar debe ingresar como usuario.';
		$seccionpage = 'Información';
		$retorno[0]['sesActiva']  = 0;
		$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		echo json_encode($retorno);
	}
	break;
	
case 3:
	
	//Valida si puede subastar en la seccion de subasta fiscal.	
	if(isset($_SESSION['g_usuario']['acceso'])){
		if($_SESSION['g_usuario']['actionSubastar'] == '0'){
			$codError = 2;
			$mensaje_str = 'Estimado usuario, su información de registro esta siendo evaluada por nuestros expertos <br> para poder ofertar, se le notificará por correo electrónico el estatus de su cuenta.';
			$seccionpage = 'Información';
			$retorno[0]['sesActiva']  = 0;
			$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		}else{
			$retornodata = fnc_situacion_subasta('', 'WHERE dias_vence > 0 AND cod_oferta = '.$_REQUEST['codreg']);
			$retorno[0]['sesHtml'] = fnv_mostrar_BID($retornodata);
		}
		echo json_encode($retorno);
	}else{
		$codError = 2;
		$mensaje_str = 'Estimado usuario, para poder subastar debe ingresar como usuario.';
		$seccionpage = 'Información';
		$retorno[0]['sesActiva']  = 0;
		$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		echo json_encode($retorno);
	}
	break;
	
case 4:
	
	//inserta el BID seleccionado	
	if(isset($_SESSION['g_usuario']['acceso'])){
		$dbn    = new db();
		$conex  = $dbn->db_connect();
	
		//Inserta valores en la tabla (mt_subasta)
		$query  = "INSERT INTO mt_subasta (cod_oferta,mt_usuario,mpo,fecha_crea) 
		select ".$_REQUEST['codoferta'].",'".$_SESSION['g_usuario']['id_usuario']."',".$_REQUEST['valorbid'].",getdate() ";
		$result	= $dbn->db_query($query);
		$campo  = $dbn->db_num_rows($result);
		if($campo <> 1 ){
			$codError = 1;
			$mensaje_str = "Error al ingresar BID (mt_subasta).";
		}else{
			$codError = 0;
			$mensaje_str = "Estimado usuario, su oferta fue colocada exitosamente.";
		}
		
		$retornodata = fnc_situacion_subasta('', 'WHERE dias_vence > 0 AND cod_oferta = '.$_REQUEST['codoferta']);
		if (count($retornodata) > 0 ){ 
			$valormpo = $retornodata[0]['MPO_ACT'];
		}
		
		$seccionpage = 'Subasta de Valores Fiscales';
		$retorno[0]['mpoAct']  = $valormpo;
		$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		echo json_encode($retorno);
	}
	break;
				
case 5:
	
	if (strlen($_REQUEST['codreg']) > 0 ){
		$sql = "SELECT b.documento as documento, b.descripcion as descripcion
			FROM df_documento_origen a, df_documento b
			where a.documento = b.documento and a.origen = '".$_REQUEST['codreg']."'";
		$datasql    = fnc_ejecutaQuery($sql);
		
		echo fncv_selectInput($valor,'activoscirculante',$optiones,'tipodocumento',$datasql);
		
	}else{
		echo fncv_selectInput($valor,'activoscirculante',$optiones,'tipodocumento',$datasql);
	}
	break;
case 6:
	//Seccion Mi Cuenta Buqueda por mes y ano TAB: Movimientos
	
	$where = "WHERE dias_vence > 0  and mt_usuario = '".$_SESSION['g_usuario']['id_usuario']."'  
	and substring(fecha_bid,4,2)+substring(fecha_bid,7,4) = '".$_REQUEST['mes'].$_REQUEST['ano']."'";
	
	$retorno =  fnc_situacion_subastalog_user(10,$where);
	$htmlstring = '';
	if ($retorno > 0 ){
		$htmlstring = '
			<span class="celda_1ra">Resumen '.fnc_getmes($_REQUEST['mes']).' '.$_REQUEST['ano'].'</span>
			<div id="contenedor_subasta_micuenta">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
            
			<tr class="fila_linea">
	        <td colspan="11"></td>
      		</tr>
			<tr class="fila_blanca" >
            <td width="56px"><span class="valores2">Fecha</span></td>
            <td width="36px"><span class="valores2">Nro.<br />Ref.</span></td>
            <td width="73px"><span class="valores2">Valor<br />Nominal</span></td>
            <td width="73px"><span class="valores2">Monto<br />Disponible</span></td>
            <td width="62px"><span class="valores2">Auditoría<br />Externa</span></td>
            <td width="60px"><span class="valores2">Período<br />Uso</span></td>
            <td width="57px"><span class="valores2">Origen</span></td>
            <td width="62px"><span class="valores2">Agentes<br />Retención</span></td>
            <td width="50px"><span class="valores2">Precio <br />Base %</span></td>
            <td width="50px"><span class="valores2">MPO %</span></td>
            <td width="55px"><span class="valores2">Vence</span></td>
            </tr>
			<tr class="fila_linea">
	        <td colspan="11"></td>
      		</tr>
			';
		$htmlstring .= fncv_mostrar_situacionSubastaLog($retorno);
		$htmlstring .= '</table></div>';
	}else{
        $htmlstring = '<span class="celda_1ra">USTED NO TIENE NINGUN MOVIMIENTO</span>';
    }
	echo $htmlstring;
	break;
	
	case 7:
	//Registro - Municipio
    if (strlen(trim($_REQUEST['codreg'])) > 0 ){
        $sql = "SELECT Pai_Codigo, Pai_Nombre FROM mp_Pais_Pai where Pai_EdoMunPar = 2 and Pai_CodigoPadre = ".$_REQUEST['codreg'];
		$datasql    = fnc_ejecutaQuery($sql);
        
        echo fncv_selectInput($valor,'domicilio','id="municipio" accept="required" onchange="cambiaSelect(this.value,\'selectparroquia\',8)"','municipio',$datasql);
        
    }else{
        echo fncv_selectInput($valor,'domicilio','id="municipio" accept="required" onchange="cambiaSelect(this.value,\'selectparroquia\',8)"','municipio',$datasql);
    }
    break;    
case 8:
	//Registro - Parroquia
    if (strlen(trim($_REQUEST['codreg'])) > 0 ){
		
		$sql = "SELECT Pai_Codigo, Pai_Nombre FROM mp_Pais_Pai where Pai_EdoMunPar = 3 and Pai_CodigoPadre = ".$_REQUEST['codreg'];
        $datasql    = fnc_ejecutaQuery($sql);
        echo fncv_selectInput($valor,'domicilio','accept="required"','parroquia',$datasql);
        
    }else{
        echo fncv_selectInput($valor,'domicilio','accept="required" ','parroquia',$datasql);
    }
    break;    
case 9:    
    $retorno = fnc_situacion_subasta('', 'WHERE dias_vence > 0');
    if ( count($retorno) > 0 ){
		for ($i=1;$i<=count($retorno);$i++){
            $htmlstring .= '<span class="naranja">Origen - '.$retorno[$i]['origen'].'</span>';
            $htmlstring .= '<span class="blanco">Valor Nominal - '.fnc_formatonum($retorno[$i]['valor_nominal']).'</span>';
            $htmlstring .= '<span class="blanco">Mto. Disponible - '.fnc_formatonum($retorno[$i]['monto_disponible']).'</span>';
            $htmlstring .= '<span class="verde">MPO - '.fnc_formatonum($retorno[$i]['MPO_ACT']).'%</span>';
        }
        echo $htmlstring;
    
	}
	
    
    break;
case 10:
    //Registro - Municipio
    if (strlen(trim($_REQUEST['codreg'])) > 0 ){
        $sql = "SELECT Pai_Codigo, Pai_Nombre FROM mp_Pais_Pai where Pai_EdoMunPar = 2 and Pai_CodigoPadre = ".$_REQUEST['codreg'];
        $datasql    = fnc_ejecutaQuery($sql);
        echo fncv_selectInput($valor,'actividadrealiza','id="municipio" accept="required" onchange="cambiaSelect(this.value,\'selectparroquia\',11)"','municipio',$datasql);
        
    }else{
        echo fncv_selectInput($valor,'actividadrealiza','id="municipio" accept="required" onchange="cambiaSelect(this.value,\'selectparroquia\',11)"','municipio',$datasql);
    }
    break;    
case 11:
	//Registro - Parroquia
    if (strlen(trim($_REQUEST['codreg'])) > 0 ){
        $sql = "SELECT Pai_Codigo, Pai_Nombre FROM mp_Pais_Pai where Pai_EdoMunPar = 3 and Pai_CodigoPadre = ".$_REQUEST['codreg'];
        $datasql    = fnc_ejecutaQuery($sql);
        
        echo fncv_selectInput($valor,'actividadrealiza','accept="required"','parroquia',$datasql);
        
    }else{
        echo fncv_selectInput($valor,'actividadrealiza','accept="required" ','parroquia',$datasql);
    }
    break;
case 12:
	//Valida si puede crear balances o certificados.	
	if(isset($_SESSION['g_usuario']['acceso'])){
		$retorno[0]['sesActiva']  = 1;
		echo json_encode($retorno);
	}else{
		$codError = 2;
		$mensaje_str = 'Estimado usuario, para poder crear balances o certificados debe ingresar como usuario.';
		$seccionpage = 'Información';
		$retorno[0]['sesActiva']  = 0;
		$retorno[0]['sesHtml']    = fnv_mostrar_mensajegeneral($codError,$seccionpage,$mensaje_str);
		echo json_encode($retorno);
	}
	break;
	
}


function fnc_getfecha(){
    $hoy = getdate();
    return "Hoy, ".$hoy['mday']." ".fnc_getmes($hoy['mon']).", ".$hoy['year'];
}
	

include_once 'mp_functions.php';
?>