<?php
function get_cat_img_posts($categoria){
	if($categoria=="FISCAL"){
		$imgen="img/Subasta_Blog_Imagenes-01.png";
	}
	if($categoria=="LEGAL"){
		$imgen="img/Subasta_Blog_Imagenes-01.png";
	}
	if($categoria=="LABORAL"){
		$imgen="img/Subasta_Blog_Imagenes-02.png";
	}
	if($categoria=="TRIBUTARIA"){
		$imgen="img/Subasta_Blog_Imagenes-03.png";
	}
	if($categoria=="OUTSOURCING.CONTABLE"){
		$imgen="img/Subasta_Blog_Imagenes-04.png";
	}
	if($categoria=="ALERTAS"){
		$imgen="img/Subasta_Blog_Imagenes-05.png";
	}
	if($categoria=="EVENTO"){
		$imgen="img/Subasta_Blog_Imagenes-06.png";
	}
	return $imgen; 
}

function get_cat_img($categoria){
	if($categoria=="FISCAL"){
		$imgen="img/icono_carpeta_blanco.png";
	}
	if($categoria=="LEGAL"){
		$imgen="img/icono_carpeta_blanco.png";
	}
	if($categoria=="LABORAL"){
		$imgen="img/icono_laboral_blanco.png";
	}
	if($categoria=="TRIBUTARIA"){
		$imgen="img/icono_tributaria_blanco.png";
	}
	if($categoria=="OUTSOURCING.CONTABLE"){
		$imgen="img/icono_outsourcing_blanco.png";
	}
	if($categoria=="ALERTAS.FISCALES"){
		$imgen="img/icono_alerta_blanco.png";
	}
	if($categoria=="EVENTO"){
		$imgen="img/icono_eventos_blanco.png";
	}
	return $imgen; 
}

function get_cat_name($categoria){
	if($categoria=="f"){
		$imgen="Fiscal";
	}
	if($categoria=="l"){
		$imgen="Laboral";
	}
	if($categoria=="le"){
		$imgen="Legal";
	}
	if($categoria=="t"){
		$imgen="Tributaria";
	}
	if($categoria=="oc"){
		$imgen="Outsourcing Contable";
	}
	if($categoria=="af"){
		$imgen="Alertas Fiscales";
	}
	return $imgen; 
}

function traducir_mes($mes){
	$arrayesp=array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$arrayeng=array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DICEMBER");
	$mesi=intval($mes);
	--$mesi;
	for($i=0;$i<=(count($arrayeng)-1);$i++){
		if($mesi==$i){
			break;
		}
	}
	
	return $arrayesp[$i]; 
}

function get_date_publish($date){
	$array=explode("-",$date);
	$mes=$array[1];
	$strdate="Publicado el ".$array[2]." de ".strtolower(traducir_mes($mes))." de ".$array[0];
	return $strdate; 
}
function get_cat_publish($cat){
	if($cat=="FISCAL"){
		?>
			<div class="categnoticia fiscal"></div>
		<?php
	}
	if($cat=="LEGAL"){
		?>
			<div class="categnoticia legal"></div>
		<?php
	}
	if($cat=="LABORAL"){
		?>
			<div class="categnoticia laboral"></div>
		<?php
	}
	if($cat=="TRIBUTARIA"){
		?>
			<div class="categnoticia tributaria"></div>
		<?php
	}
	if($cat=="OUTSOURCING.CONTABLE"){
		?>
			<div class="categnoticia outcontable"></div>
		<?php
	}
	if($cat=="ALERTAS.FISCALES"){
		?>
			<div class="categnoticia alerta"></div>
		<?php
	}
	return 0; 
}

function get_etiquetas($idarticulo,$conexion){
	$etiquetas=array();
	$sql="SELECT * FROM noticias WHERE ID='$idarticulo'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$i=0;
			$datos=mysql_fetch_array($pedido);
			$etiquetas_str=$datos['etiquetas'];
			$datstr=explode(",",$etiquetas_str);
			for($i=0;$i<=(count($datstr)-1);$i++){
				$etiquetas[$i]=$datstr[$i];
			}
		}
	}
	return $etiquetas;
}

function getRedesButtons($conexion){
	$urlmedia=$media; 

	$sql="SELECT * FROM noticias WHERE ID='".$_GET['idnoticia']."'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$fechart=$datos['fechacons'];
			$titulo=$datos['titulo'];
			$cuerpo=$datos['cuerpo'];
			$etiquetas=$datos['etiquetas'];
			$IDnoticiaMenu=$datos['ID'];
			$categoria=$datos['tipo'];
			$imagenportada="admin/".$datos['fotodir'];
		}
	}
?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=552237048176856";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    <div class="share_area">
			<table style="display:block;margin-top: 20px;margin-bottom: 20px;">
				<tr>
					<td style="width: 100px;">
						<div class="fb-share-button" data-href="<?php echo("http://xumbadevenezuela.com/entorno_prueba_xumbablog/index.php?idnoticia=".$_GET['idnoticia']."&p[title]=".$titulo."&p[summary]=".$cuerpo."&p[url]=http://xumbadevenezuela.com/entorno_prueba_xumbablog/index.php?idnoticia=".$_GET['idnoticia']."&p[image]=http://xumbadevenezuela.com/entorno_prueba_xumbablog/".$imagenportada); ?>" data-type="button"></div>
					</td>
					<td style="width: 16px;">
						
					</td>
					<td style="width: 45px;">
						<a target="_blank" href="https://twitter.com/share" class="twitter-share-button" data-via="xumbavenezuela" data-related="xumbavenezuela" data-hashtags="xumbavenezuela">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</td>
				</tr>
			</table>
    </div>
	<?php
}
?>