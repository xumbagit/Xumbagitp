<?php

$sql="SELECT * FROM noticias WHERE tipo='FISCAL' ORDER BY fecha DESC LIMIT 1";
$pedido=mysql_query($sql,$conexion);
if($pedido){
	$filas=mysql_num_rows($pedido);
	if($filas>0){
		$datos=mysql_fetch_array($pedido);
		$fechart=$datos['fechacons'];
		$titulo=$datos['titulo'];
		$cuerpo=$datos['cuerpo'];
		$etiquetas=$datos['etiquetas'];
		$IDnoticia=$datos['ID'];
		$categoria=$datos['tipo'];
		$imagenportada="admin/".$datos['fotodir'];
	}
}
?>
<div class="contenedor_mod">
	<div class="header">
		<div class="linea"></div>
		<div class="fecha"><?php echo(get_date_publish($fechart)); ?></div>
		<?php get_cat_publish($categoria); ?>
		<div class="titulo_post1"><?php echo($titulo); ?></div>
	</div>
	<div class="content">
		<div class="divimagen">
			<img src="<?php echo($imagenportada); ?>" />
		</div>
		<?php
		
			echo($cuerpo);
		
		?>
	</div>
	<div class="etiquetas">
		<span><img src="img/icono_bandera_gris.png"> Etiquetas para este articulo</span>
		<div>
		<ul>
			<?php
				$tiq=array();
				$tiq=explode(",", $etiquetas);
				
				for($i=0;$i<=(count($tiq)-1);$i++){
					?>
						<li onclick="location.href='<?php echo("index.php?buscaretiquetas=".$tiq[$i]); ?>';">
							<?php echo($tiq[$i]); ?>
						</li>
					<?php
				}
			?>
		</ul>
		</div>
	</div>
</div>