<!DOCTYPE html>
<html>
<head>
<?php
	getheader();
?>
</head>
<body class="<?php echo($_SESSION['estilo']); ?>">
<?php
	getMenu($conexion);
	getSocialArea();
?>
<div class="bg_img">
    <img src="<?php echo(getbackground("SECCION5",$conexion)); ?>" border="0" />
</div>

<div class="content">
<div class="content_contacto">
    <div class="col1">

        <div class="title_seccion">GRACIAS POR LLEGARTE A NUESTRO PORTAL</div>
        <div class="description">Contáctanos llenando los espacios con tus datos y nosotros nos comunicaremos de vuelta contigo.</div>

        <div class="content_form">
            <form class="form1" method="post" enctype="multipart/form-data">
               <input type="text" name="name" id="name" class="field" placeholder="Nombre"/>
               <div class="required">*</div>
               <input type="text" name="lastname" id="lastname" class="field" placeholder="Apellido"/>
               <div class="required">*</div>
               <input type="text" id="email" name="email" class="field" placeholder="E-mail" />
               <div class="required">*</div>
               <textarea id="message" name="message" class="area" placeholder="Escribe tu mensaje"></textarea>
               <input name="send"id="send" class="btn" type="submit" value="enviar"/>
                    <?php
	                    $botonform=$_POST['send'];
						if($botonform){
							$aenviar='contacto@elministerio.tv';
							//$toenviar='contacto@elministerio.tv';
							$toenviar='avasquez@xumbadevenezuela.com';
							$comentario=utf8_encode("NOMBRE: ".$_POST['name']."<br><br>APELLIDO: ".$_POST['lastname']."<br><br>EMAIL: \n".$_POST['email']."<br><br>MENSAJE: <br><br>".$_POST['message']."<br><br><br>ELMINISTERIOS.TV");
							$cabeceras = "MIME-Version: 1.0\r\n";
							$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
							$cabeceras .= "From: ".$aenviar."\r\n"."Reply-To: ".$aenviar."\r\n" .'X-Mailer: PHP/'.phpversion();
							$asunto="CONTACTO PAGINA ELMINISTERIO.TV";
							mail($toenviar,$asunto,$comentario,$cabeceras);
							echo("the message has been sent");
						}
                    ?>
            </form>
        </div>
    </div>
</div>
</div>
<!--END CONTENT-->
<?php
	getfooter();
?>
</body>
</html>