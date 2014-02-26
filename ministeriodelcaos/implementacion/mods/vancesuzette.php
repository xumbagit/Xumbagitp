<!DOCTYPE html>
<html>
<head>
<?php
	getheader();
	if($_GET['iddetalle']!=''){
		$iddetalle=$_GET['iddetalle'];
		$sql="SELECT * FROM noticias WHERE ID='$iddetalle'";
		$pedido=mysql_query($sql,$conexion);
		echo(mysql_error());
		if($pedido){
			$filas=mysql_num_rows($pedido);
			if($filas>0){
				$datos=mysql_fetch_array($pedido);
				$imagen="admin/".$datos['fotodir'];
				?>
				<meta property="og:title" content="<?php echo($datos['titulo']); ?>"/>
				<meta property="og:description" content="<?php echo(strip_tags($datos['cuerpo'])); ?>"/>
				<meta property="og:image" content="<?php echo($imagen); ?>"/>
				<meta property="og:url" content="www.elministerio.tv"/>
				<?php
			}
		}
	}
	$arrenca=getencabezado("VANCE_SUZETTE",$conexion);
?>
</head>

<body class="<?php echo($_SESSION['estilo']); ?>">
<?php
	getMenu($conexion);
	getSocialArea();
?>
<div class="bg_img">
    <img src="<?php echo(getbackground("SECCION3",$conexion)); ?>" border="0" />
</div>
<div class="content">
    <div class="content_category2">
        <div class="col1">
            <div class="big_title"><?php echo($arrenca[0]); ?></div>
			<?php 
				if($_GET['iddetalle']!=''){
					getdetalle($_GET['iddetalle'],$conexion);
				}
				else{
					getposts("VANCE_SUZETTE",$conexion);	
				}
			?>
        </div>

        <div class="col2">
           <div class="instagram_area">
           	<?php
           		getInstagram();
           	?>
           </div>
           <div class="frase">
           	<?php
           		getfrase($conexion);
           	?>
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