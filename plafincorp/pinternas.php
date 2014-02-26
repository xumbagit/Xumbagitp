<?php
$mod=$_GET['mod'].".php";
if(file_exists($mod)){
	include($mod);
}
else{
	echo("El modulo no existe");
}

?>