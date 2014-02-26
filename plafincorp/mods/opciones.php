<?php
session_start();
if($_POST['guardarvariable']=="true"){
	$contenido=$_POST['contenido'];
	$variable=$_POST['variable'];
	
	$_SESSION[$variable]=$contenido;
	echo($_SESSION[$variable]);
}

if($_POST['enviaremailcontactopc']=="true"){
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$mensaje=$_POST['mensaje'];
	$asunto="CONTACTO PLAFINCORP";
	$cabeceras = "MIME-Version: 1.0\r\n";
	$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$cabeceras .= "From: ".$email."\r\n"."Reply-To: ".$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	$msjpedido.="<br><br>".$nombre."<br><br>".$apellido."<br><br>".$telefono."<br><br>".$email."<br><br>".$mensaje."<br><br>";
	$msjpedido.="</body></html>";
	//Email para Info plafincorp
	$email="info@plafincorp.com";
	mail($email,$asunto,$msjpedido,$cabeceras);
}

if($_POST['enviaremailcontacto']=="true"){
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$mensaje=$_POST['mensaje'];
	$asunto="CONTACTO PLAFINCORP";
	$cabeceras = "MIME-Version: 1.0\r\n";
	$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$cabeceras .= "From: ".$email."\r\n"."Reply-To: ".$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	$msjpedido.="<br><br>".$nombre."<br><br>".$apellido."<br><br>".$telefono."<br><br>".$email."<br><br>".$mensaje."<br><br>";
	$msjpedido.="</body></html>";
	//Email para Info plafincorp
	$email="info@plafincorp.com";
	mail($email,$asunto,$msjpedido,$cabeceras);	
}
?>