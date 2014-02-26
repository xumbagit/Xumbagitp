<?php
session_start();
if($_POST['guardarvariable']=="true"){
	$contenido=$_POST['contenido'];
	$variable=$_POST['variable'];
	
	$_SESSION[$variable]=$contenido;
	echo($_SESSION[$variable]);
}

?>