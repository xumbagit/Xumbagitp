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

function getRedesButtons($titulo,$media){
	?>

    <meta name="Title" content="SubastaFiscal Blog"  />
    <meta name="og:title" content="SubastaFiscal Blog" />
    <meta name="description" content="SubastaFiscal Blog"/>
    <meta name="og:description" content="SubastaFiscal Blog" />
		<table style="display:block;margin-top: 20px;margin-bottom: 20px;">
			<tr>
				<td style="width: 100px;">
	    		<?php
					if($_SESSION['lang']=="es"){
						?>
							<a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Compartir</a>
						<?php
					}
					elseif($_SESSION['lang']=="fr"){
						?>
							<a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a>
						<?php
					}
					else{
						?>
							<a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a>
						<?php
					}
					
					$urlmedia=$media;
	    		?>
				</td>
				<td style="width: 16px;">
					
				</td>
				<td style="width: 45px;">
					<a target="_blank" href="https://twitter.com/share" class="twitter-share-button" data-via="subastafiscal" data-related="subastafiscal" data-hashtags="subastafiscal">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</td>
				<td style="width: 118px;">
					<script src="//platform.linkedin.com/in.js" type="text/javascript">lang: es_ES</script><script type="IN/Share" data-counter="right"></script>
				</td>
				<td style="width: 16px;">
					
				</td>
				<td target="_blank" style="width: 60px;">
					<g:plusone size="medium" href="<?php echo($urlmedia); ?>"></g:plusone>
				</td>
			</tr>
		</table>
	<?php
}
?>