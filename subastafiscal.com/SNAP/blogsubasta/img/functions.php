<?php
function get_cat_img_posts($categoria){
	if($categoria=="FISCAL"){
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
	return $imgen; 
}

function get_cat_img($categoria){
	if($categoria=="FISCAL"){
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
	if($categoria=="ALERTAS"){
		$imgen="img/icono_alerta_blanco.png";
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
?>