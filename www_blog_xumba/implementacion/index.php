<?php
session_start();
//REVISAR PAGINA COMPLETA MANANA
	include("conf/config.conf.php");
	include("functions.php");
	
	if($_GET['lang']==""){
		if($_SESSION['lang']==""){
			$_SESSION['lang']="en";
		}
	}
	elseif($_SESSION['lang']==""){
		if($_GET['lang']==""){
			$_SESSION['lang']="en";
		}
		else{
			$_SESSION['lang']=$_GET['lang'];
		}
	}
	else{
		$_SESSION['lang']=$_GET['lang'];
	}
	$conexion=mysql_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD);
	if($conexion){
		$seleccionar=mysql_select_db(NOMBRE_BD);
		mysql_query("SET NAMES 'utf8'");
		//echo("HAY CONEXION");
	}
	else{
		echo("NO HAY CONEXION");
	}
	//Determinar si esta en entorno de prueba o produccion
	$_SESSION['url_entorno']=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	//HTTP para los comentarios de facebook
	$_SESSION['url_entorno_real']="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$array_test=explode("/",$_SESSION['url_entorno']);
	//echo($array_test[0]);echo($array_test[1]);echo($array_test[2]);
	//Establecer tipo de entorno 
	$tipoentorno=strtoupper($array_test[1]);
	if($tipoentorno=="TESTING"){
		$_SESSION['tipo_entorno']="TESTING";	
	}
	else{
		$_SESSION['tipo_entorno']="PRODUCCION";
	}
	
	if($_SERVER['HTTP_REFERER']==''){
		$_SESSION['pagante']=$_SERVER['HTTP_REFERER'];
	}
	elseif($_SERVER['HTTP_REFERER']!=$_SERVER['PHP_SELF']){
		$_SESSION['pagante']=$_SERVER['HTTP_REFERER'];
	}
if($_GET['idweb']!=''){
	if($_GET['t']=='st'){
		$modul="mods/".$_GET['idweb'].".html";
	}
	elseif($_GET['t']=='dm'){
		$modul="mods/".$_GET['idweb'].".php";
	}
	elseif($_GET['t']=='tx'){
		$modul="mods/".$_GET['idweb'].".txt";
	}
	else{
		$modul="mods/".$_GET['idweb'].".php";
	}
	if(file_exists($modul)){
		$string = file_get_contents($modul);
		$string = rmBOM($string);
		file_put_contents($modul,$string);
		include($modul);
	}
	else{
		?>
			<script type="text/javascript">
				location.href="index.php";
			</script>
		<?php
	}
}
else{
	$plantilla="plantilla_std";
	$modul=$plantilla.".php";
	if(file_exists($modul)){
		include($modul);
	}
	else{
		?>
			<script type="text/javascript">
				location.href="index.php";
			</script>
		<?php
	}
}
?>