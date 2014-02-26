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
		$arrenca=getencabezado("FAMILIA",$conexion);
	?>
	<div class="bg_img">
	    <img src="<?php echo(getbackground("SECCION2",$conexion)); ?>" border="0" />
	</div>
	<div class="content">
		<div class="content_familia">
		    <div class="col1">
		
		        <div class="title_seccion"><?php echo($arrenca[0]); ?></div>
		        <div class="description"><?php echo($arrenca[1]); ?></div>
				<?php
					getcontactos($conexion);
				?>
		    </div>       
		</div>
	</div>
	<!--END CONTENT-->
	<?php
		getfooter();
	?>
</body>
</html>