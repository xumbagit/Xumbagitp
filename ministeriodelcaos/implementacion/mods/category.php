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
?>
</head>
<body class="<?php echo($_SESSION['estilo']); ?>">
<?php
	getMenu($conexion);
	getSocialArea();
?>

<div class="bg_img">
    <img src="<?php echo(getbackground("SECCION4",$conexion)); ?>" border="0" />
</div>

<div class="content">
<div class="content_category1">
    <div class="col1">
        <!--LOS POSTS-->
		<?php 
			if($_GET['iddetalle']!=''){
				getdetalle($_GET['iddetalle'],$conexion);
			}
			else{
				getposts("LEGADO",$conexion);
			}
		?>
    </div>


    <div class="col2">
        <div class="tweet_area">
            <a class="twitter-timeline"  href="https://twitter.com/MdelCaos"  data-widget-id="369858528913010689">Tweets by @MdelCaos</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
        <div class="archive">
            <h2>Archivo</h2>
            <div class="red_line"></div>
            <ul class="list_archive">
                <?php
                	getarchivo($conexion);
                ?>
            </ul>
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