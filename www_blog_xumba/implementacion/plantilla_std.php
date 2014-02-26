<?php
	if($_GET['eventos']=="true"){
		$tiponoticia="EVENTO";
	}
	elseif($_GET['enmedios']=="true"){
		$tiponoticia="EVENTO";				
	}
	else{
		$tiponoticia="";
	}
	/////////////////////PAGINACION////////////////////////////////////////////
	$TAMANO_PAGINA=8;
	$TAMANO_COLUMNA=4;
	$pagina = $_GET["pagina"];
	if (!$pagina){
	    $inicio=0;
	    $pagina=1;
	}
	else {
	    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	//////////////////////////////////////////////////////////////////
	if($_GET['categ']!=''){
		$condic2="SELECT * FROM noticias WHERE idioma='es' AND tipo='".$_GET['categ']."' ORDER BY fechacons DESC";
	}
	elseif($_GET['search']!=''){
		$condic2="SELECT * FROM noticias WHERE titulo LIKE '%".$_GET['search']."%' ORDER BY fechacons DESC";
		$condic3="SELECT * FROM etiquetas WHERE etiqueta LIKE '%".$_GET['search']."%' ORDER BY ID DESC";
	}
	else{
		$condic2="SELECT * FROM noticias WHERE idioma='es' AND destacado<>'SI' ORDER BY fechacons DESC";
	}
	//PAGINACION
	$ssql = $condic2;
	//echo($ssql);
	if($ssql!=''){
		$rs = mysql_query($ssql,$conexion);
	}
	if($rs){
		$num_total_registros = mysql_num_rows($rs);
		if(mysql_num_rows>0){
			$num_total_registros = mysql_num_rows($rs);
			//calculo el total de páginas
			$total_paginas = ceil($num_total_registros/$TAMANO_PAGINA);
			//echo($num_total_registros);
			////echo($total_paginas); 
			/////////////////////////////////////////////////////////
		}	
		else{
			//PAGINACION
			$ssql = $condic3;
			//echo($ssql);
			$rs = mysql_query($ssql,$conexion);
			if($rs){
				$num_total_registros = mysql_num_rows($rs);
				if(mysql_num_rows>0){
					$num_total_registros = mysql_num_rows($rs);
					//calculo el total de páginas
					$total_paginas = ceil($num_total_registros/$TAMANO_PAGINA);
					//echo($num_total_registros);
					////echo($total_paginas); 
					/////////////////////////////////////////////////////////
				}
			}			
		}
	}
	$sql="SELECT * FROM noticias WHERE tipo<>'EVENTO' ORDER BY ID DESC LIMIT 1";
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
	
	$sql="SELECT * FROM noticias WHERE destacado='SI' ORDER BY ID DESC LIMIT 1";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$destacados=$filas;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php
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
<meta property="og:title" content="<?php echo($titulo); ?>" />
<meta name="title" content="<?php echo($titulo); ?>" />
<meta property="og:description" content="<?php echo($cuerpo); ?>" />
<meta name="description" content="<?php echo($cuerpo); ?>" />
<meta property="og:url" content="http://xumbadevenezuela.com/xumbablog" />
<meta property="fb:app_id" content="552237048176856"/>
<meta property="og:site_name" content="XumbaBlog" />
<meta property="og:type" content="website" />
<title>BLOG CORPORACIÓN XUMBA DE VENEZUELA C.A.</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js" type="text/javascript"></script>
<script src="http://malsup.github.com/jquery.cycle.all.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/content.css" rel="stylesheet" type="text/css">
<link href="css/category.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="dist/css/bootstrap.min.css"></link>
<link rel="stylesheet" href="dist/css/bootstrap-theme.css"></link>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript">
    $(document).ready(function () {
        $('#banner_content_slide').cycle({
            fx: 'fade',
            timeout: 5000, 
            pager:  '#banner_nav',
		    // callback fn that creates a thumbnail to use as pager anchor 
		    pagerAnchorBuilder: function(idx, slide) { 
		        return "<div class=\"sq\"></div>"; 
		    } 
        });
    });
</script>
</head>

<body>


  <div id="header">
      <div id="cintillo">
        <div class="cintas" style="background-color:#FF3030;margin-left:29px;"></div>
        <div class="cintas" style="background-color:#A0108F;"></div>
        <div class="cintas" style="background-color:#FF9922;"></div>
        <div class="cintas" style="background-color:#7FCCCC;"></div>
        <div class="cintas" style="background-color:#0099CC;"></div>
        <div class="cintas" style="background-color:#80C900;"></div>
      </div>
      <a href="index.php">
      	<div class="logo"></div>
      </a>
        
        <div class="content_nav1">
        	<ul class="nav1">
        		<?php
        		
        		if($_GET['categ']=="AGENCIA"){
        			?>
        				<li class="n1" style="color:white;background:#A0108F;" onclick="location.href='?categ=AGENCIA';">LA AGENCIA</li>
        			<?php
        		}
				else{
        			?>
        				<li class="n1" onclick="location.href='?categ=AGENCIA';">LA AGENCIA</li>
        			<?php					
				}

        		if($_GET['categ']=="EVENTOS"){
        			?>
        				<li class="n2" style="color:white;background:#FF9922;" onclick="location.href='?categ=EVENTOS';">EVENTOS</li>
        			<?php
        		}
				else{
        			?>
        				<li class="n2" onclick="location.href='?categ=EVENTOS';">EVENTOS</li>
        			<?php					
				}
				
        		if($_GET['categ']=="INTERESES"){
        			?>
        				<li class="n3" style="color:white;background:#7FCCCC;" onclick="location.href='?categ=INTERESES';">INTERESES</li>
        			<?php
        		}
				else{
        			?>
        				<li class="n3" onclick="location.href='?categ=INTERESES';">INTERESES</li>
        			<?php
				}
				
        		if($_GET['categ']=="CREANDO"){
        			?>
        				<li class="n4" style="color:white;background:#0099CC;" onclick="location.href='?categ=CREANDO';">CREANDO</li>
        			<?php
        		}
				else{
        			?>
        				<li class="n4" onclick="location.href='?categ=CREANDO';">CREANDO</li>
        			<?php					
				}
				
        		if($_GET['categ']=="UNOALAVEZ"){
        			?>
        				<li class="n5" style="color:white;background:#80C900;" onclick="location.href='?categ=UNOALAVEZ';">UNO A LA VEZ</li>
        			<?php
        		}
				else{
        			?>
        				<li class="n5" onclick="location.href='?categ=UNOALAVEZ';">UNO A LA VEZ</li>
        			<?php					
				}
        		?>
            </ul>
         </div>
         
    <div class="line"></div>
    </div>
	<?php
		if($_GET['idnoticia']==''){
	?>
    <div class="content">
    	<div class="col1">
			<?php
				$sql="SELECT * FROM noticias WHERE destacado='SI' ORDER BY fechacons DESC LIMIT 5";
				$pedido=mysql_query($sql,$conexion);
				echo(mysql_error());
				if($pedido){
					$filas=mysql_num_rows($pedido);
					if($filas>0){
						if($_GET['categ']=='' && $_GET['search']==''){
						?>
            				<div id="banner_content_slide" class="cycle-slideshow">
						<?php
							while($datos=mysql_fetch_array($pedido)){
								$IDnoticiaMenu=$datos['ID'];
								$imagenportada="admin/".$datos['fotodir'];
								$tipo_str=$datos['tipo'];
								if($tipo_str=="AGENCIA"){
									$estilocss="col1_3 category1";
									$estilocss2="category1";
								}
								if($tipo_str=="EVENTOS"){
									$estilocss="col1_3 category2";
									$estilocss2="category2";
								}
								if($tipo_str=="INTERESES"){
									$estilocss="col1_3 category3";
									$estilocss2="category3";
								}
								if($tipo_str=="CREANDO"){
									$estilocss="col1_3 category4";
									$estilocss2="category4";
								}
								if($tipo_str=="UNOALAVEZ"){
									$estilocss="col1_3 category5";
									$estilocss2="category5";
								}
							?>
				                <div class="banner" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    <div id="slide" class="<?php echo($estilocss2); ?>" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                        <a class="triangle_b" href="#" target="_self" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        <div class="caption" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                        <h2 onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($datos['titulo']); ?></h2>
				                        	<div class="caption_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            	<?php echo($datos['cuerpo']); ?>
				                            </div>
				                        </div>
				                        <img onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" src="<?php echo($imagenportada); ?>" width="690" border="0" />
				                    </div>
				                </div>
							<?php
						}
						?>
            				</div>
						<?php	
						}
					}
				}
			?>
<div class="category1" id="banner_nav"></div>
 <!-- AREA DE LOS POSTS-->
            <div class="preview_view">
<?php
	$sql=$condic2;
	if($sql!=''){
		$pedido=mysql_query($sql,$conexion);
	}
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($_GET['search']!=''){
			?>
				<div class="results_text">
                	Resultados encontrados con "<?php echo($_GET['search']); ?>" <span class="bold" id="#">(<?php echo($filas); ?>)</span>
            	</div>
			<?php
		}
		if($filas>0){
			$etiquetas=array();
			while($datos=mysql_fetch_array($pedido)){
				$fechart=$datos['fechacons'];
				$fecha_str=$datos['fecha'];
				$titulo=$datos['titulo'];
				$cuerpo=$datos['cuerpo'];
				$etiquetas=$datos['etiquetas'];
				$IDnoticiaMenu=$datos['ID'];
				$categoria=$datos['tipo'];
				$imagenportada="admin/".$datos['fotodir'];
				$tipo=$datos['tipo'];
				if($tipo=="AGENCIA"){
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				?>
					<!-- 1ER POST-->
	            	<div class="preview_post category1">
	                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
	                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
	                    </div>
	                    <div class="content_text">
	                    	<div class="date"><?php echo($fecha_str); ?></div>
	                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
	                        <div class="view1" onclick="location.href='index.php?categ=ANGENCIA">
	                            <div class="triangle"></div>
	                            <span class="category_name" onclick="location.href='index.php?categ=AGENCIA';">LA AGENCIA</span>
	                        </div>
	                        <div class="summary_post"><?php echo($cuerpo); ?></div>
	                    </div>
		                <ul class="tag_list1">
		                	<?php
		                	
			                	for($i=0;$i<=(count($etiquetas)-1);$i++){
			                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
			                		?>
			                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
			                		<?php
			                	}
		                	
		                	?>
		                </ul>
	                </div>
	               	<div class="line2"></div> 
				<?php				
				}
				if($tipo=="EVENTOS"){
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				?>
					<!-- 1ER POST-->
	            	<div class="preview_post category2">
	                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
	                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
	                    </div>
	                    <div class="content_text">
	                    	<div class="date"><?php echo($fecha_str); ?></div>
	                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
	                        <div class="view1" onclick="location.href='index.php?categ=EVENTOS';">
	                            <div class="triangle"></div>
	                            <span class="category_name" onclick="location.href='index.php?categ=EVENTOS';">EVENTOS</span>
	                        </div>
	                        <div class="summary_post"><?php echo($cuerpo); ?></div>
	                    </div>
		                <ul class="tag_list1">
		                	<?php
		                	
			                	for($i=0;$i<=(count($etiquetas)-1);$i++){
			                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
			                		?>
			                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
			                		<?php
			                	}
		                	
		                	?>
		                </ul>
	                </div>
	               	<div class="line2"></div> 
				<?php				
				}
				if($tipo=="INTERESES"){
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				?>
					<!-- 1ER POST-->
	            	<div class="preview_post category3">
	                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
	                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
	                    </div>
	                    <div class="content_text">
	                    	<div class="date"><?php echo($fecha_str); ?></div>
	                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
	                        <div class="view1" onclick="location.href='index.php?categ=INTERESES';">
	                            <div class="triangle"></div>
	                            <span class="category_name" onclick="location.href='index.php?categ=INTERESES';">INTERESES</span>
	                        </div>
	                        <div class="summary_post"><?php echo($cuerpo); ?></div>
	                    </div>
		                <ul class="tag_list1">
		                	<?php
		                	
			                	for($i=0;$i<=(count($etiquetas)-1);$i++){
			                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
			                		?>
			                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
			                		<?php
			                	}
		                	
		                	?>
		                </ul>
	                </div>
	               	<div class="line2"></div> 
				<?php				
				}
				if($tipo=="CREANDO"){
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				?>
					<!-- 1ER POST-->
	            	<div class="preview_post category4">
	                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
	                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
	                    </div>
	                    <div class="content_text">
	                    	<div class="date"><?php echo($fecha_str); ?></div>
	                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
	                        <div class="view1" onclick="location.href='index.php?categ=CREANDO';">
	                            <div class="triangle"></div>
	                            <span class="category_name" onclick="location.href='index.php?categ=CREANDO';">CREANDO</span>
	                        </div>
	                        <div class="summary_post"><?php echo($cuerpo); ?></div>
	                    </div>
		                <ul class="tag_list1">
		                	<?php
		                	
			                	for($i=0;$i<=(count($etiquetas)-1);$i++){
			                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
			                		?>
			                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
			                		<?php
			                	}
		                	
		                	?>
		                </ul>
	                </div>
	               	<div class="line2"></div> 
				<?php				
				}
				if($tipo=="UNOALAVEZ"){
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				?>
					<!-- 1ER POST-->
	            	<div class="preview_post category5">
	                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
	                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
	                    </div>
	                    <div class="content_text">
	                    	<div class="date"><?php echo($fecha_str); ?></div>
	                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
	                        <div class="view1" onclick="location.href='index.php?categ=UNOALAVEZ';">
	                            <div class="triangle"></div>
	                            <span class="category_name" onclick="location.href='index.php?categ=UNOALAVEZ';">UNO A LA VEZ</span>
	                        </div>
	                        <div class="summary_post"><?php echo($cuerpo); ?></div>
	                    </div>
		                <ul class="tag_list1">
		                	<?php
		                	
			                	for($i=0;$i<=(count($etiquetas)-1);$i++){
			                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
			                		?>
			                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
			                		<?php
			                	}
		                	
		                	?>
		                </ul>
	                </div>
	               	<div class="line2"></div> 
				<?php				
				}
			}
		}
		else{
			$sql=$condic3;
			if($sql!=''){
				$pedido=mysql_query($sql,$conexion);
			}
			echo(mysql_error());
			if($pedido){
				$filas=mysql_num_rows($pedido);
				if($filas>0){
					$etiquetas=array();
					while($datos=mysql_fetch_array($pedido)){
						$ID_art=$datos['ID_art'];
						$sqldos="SELECT * FROM noticias WHERE ID='$ID_art' ORDER BY ID DESC LIMIT 1";
						$pedidodos=mysql_query($sqldos,$conexion);
						echo(mysql_error());
						if($pedidodos){
							$filasdos=mysql_num_rows($pedidodos);
							if($filasdos>0){
								$datos2=mysql_fetch_array($pedidodos);
								$fechart=$datos2['fechacons'];
								$fecha_str=$datos2['fecha'];
								$titulo=$datos2['titulo'];
								$cuerpo=$datos2['cuerpo'];
								$etiquetas=$datos2['etiquetas'];
								$IDnoticiaMenu=$datos2['ID'];
								$categoria=$datos2['tipo'];
								$imagenportada="admin/".$datos2['fotodir'];
								$tipo=$datos2['tipo'];
							}
						}
						if($tipo=="AGENCIA"){
							$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
						?>
							<!-- 1ER POST-->
			            	<div class="preview_post category1">
			                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
			                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
			                    </div>
			                    <div class="content_text">
			                    	<div class="date"><?php echo($fecha_str); ?></div>
			                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
			                        <div class="view1" onclick="location.href='index.php?categ=ANGENCIA">
			                            <div class="triangle"></div>
			                            <span class="category_name" onclick="location.href='index.php?categ=AGENCIA';">LA AGENCIA</span>
			                        </div>
			                        <div class="summary_post"><?php echo($cuerpo); ?></div>
			                    </div>
				                <ul class="tag_list1">
				                	<?php
				                	
					                	for($i=0;$i<=(count($etiquetas)-1);$i++){
					                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
					                		?>
					                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
					                		<?php
					                	}
				                	
				                	?>
				                </ul>
			                </div>
			               	<div class="line2"></div> 
						<?php				
						}
						if($tipo=="EVENTOS"){
							$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
						?>
							<!-- 1ER POST-->
			            	<div class="preview_post category2">
			                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
			                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
			                    </div>
			                    <div class="content_text">
			                    	<div class="date"><?php echo($fecha_str); ?></div>
			                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
			                        <div class="view1" onclick="location.href='index.php?categ=EVENTOS';">
			                            <div class="triangle"></div>
			                            <span class="category_name" onclick="location.href='index.php?categ=EVENTOS';">EVENTOS</span>
			                        </div>
			                        <div class="summary_post"><?php echo($cuerpo); ?></div>
			                    </div>
				                <ul class="tag_list1">
				                	<?php
				                	
					                	for($i=0;$i<=(count($etiquetas)-1);$i++){
					                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
					                		?>
					                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
					                		<?php
					                	}
				                	
				                	?>
				                </ul>
			                </div>
			               	<div class="line2"></div> 
						<?php				
						}
						if($tipo=="INTERESES"){
							$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
						?>
							<!-- 1ER POST-->
			            	<div class="preview_post category3">
			                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
			                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
			                    </div>
			                    <div class="content_text">
			                    	<div class="date"><?php echo($fecha_str); ?></div>
			                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
			                        <div class="view1" onclick="location.href='index.php?categ=INTERESES';">
			                            <div class="triangle"></div>
			                            <span class="category_name" onclick="location.href='index.php?categ=INTERESES';">INTERESES</span>
			                        </div>
			                        <div class="summary_post"><?php echo($cuerpo); ?></div>
			                    </div>
				                <ul class="tag_list1">
				                	<?php
				                	
					                	for($i=0;$i<=(count($etiquetas)-1);$i++){
					                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
					                		?>
					                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
					                		<?php
					                	}
				                	
				                	?>
				                </ul>
			                </div>
			               	<div class="line2"></div> 
						<?php				
						}
						if($tipo=="CREANDO"){
							$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
						?>
							<!-- 1ER POST-->
			            	<div class="preview_post category4">
			                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
			                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
			                    </div>
			                    <div class="content_text">
			                    	<div class="date"><?php echo($fecha_str); ?></div>
			                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
			                        <div class="view1" onclick="location.href='index.php?categ=CREANDO';">
			                            <div class="triangle"></div>
			                            <span class="category_name" onclick="location.href='index.php?categ=CREANDO';">CREANDO</span>
			                        </div>
			                        <div class="summary_post"><?php echo($cuerpo); ?></div>
			                    </div>
				                <ul class="tag_list1">
				                	<?php
				                	
					                	for($i=0;$i<=(count($etiquetas)-1);$i++){
					                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
					                		?>
					                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
					                		<?php
					                	}
				                	
				                	?>
				                </ul>
			                </div>
			               	<div class="line2"></div> 
						<?php				
						}
						if($tipo=="UNOALAVEZ"){
							$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
						?>
							<!-- 1ER POST-->
			            	<div class="preview_post category5">
			                	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;">
			                    	<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor:pointer;"/>
			                    </div>
			                    <div class="content_text">
			                    	<div class="date"><?php echo($fecha_str); ?></div>
			                    	<div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>"><?php echo($titulo); ?></div>
			                        <div class="view1" onclick="location.href='index.php?categ=UNOALAVEZ';">
			                            <div class="triangle"></div>
			                            <span class="category_name" onclick="location.href='index.php?categ=UNOALAVEZ';">UNO A LA VEZ</span>
			                        </div>
			                        <div class="summary_post"><?php echo($cuerpo); ?></div>
			                    </div>
				                <ul class="tag_list1">
				                	<?php
				                	
					                	for($i=0;$i<=(count($etiquetas)-1);$i++){
					                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
					                		?>
					                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
					                		<?php
					                	}
				                	
				                	?>
				                </ul>
			                </div>
			               	<div class="line2"></div> 
						<?php				
						}
					}
				}
			}			
		}
	}
?> 
            </div>
            <div class="pagination">
                <ul class="content_num">
			<?php if($_GET['idnoticia']=='' && $_GET['articulosemanal']!='true'){
					//muestro los distintos índices de las páginas, si es que hay varias páginas
					if ($total_paginas>1){
						if($pagina>1){
							?>
								<div class="prev" style="display:inline-block;cursor: pointer;" <?php echo("location.href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . ($pagina-1)."&criterio=".$_GET['criterio']."&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."';"); ?>></div>
							<?php
						}
						if($total_paginas<=10){
						    for ($i=1,$x=1;$i<=$total_paginas,$x<=$total_paginas;$i++,$x++){
						    	if($i==1){
						    		$style="style='margin-left:40px;'";
						    	}
								elseif($i==$total_paginas){
									$style="style='margin-right:50px;'";
								}
								else{
									$style="";
								}
						       if ($pagina == $i){
						          //si muestro el índice de la página actual, no coloco enlace
						          echo("<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true'>".$pagina."</a></li>");
						       }
						       else{
						       		if($i==$total_paginas){
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo("<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>");
						       		}
									else {
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
									}
						       }
						    }
						}
						else{
							$_SESSION['pagina']=$pagina;
							$limitemenor=1;
							$limitemayor=3+$pagina;
						    for ($i=$limitemenor;$i<=$limitemayor;$i++){
						       if ($pagina == $i){
						          //si muestro el índice de la página actual, no coloco enlace
						          echo("<li class='num'><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true'>".$pagina."</a></li>");
						        }
						       else{
						       		if($i==$total_paginas){
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li class='num'><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
						       		}
									else {
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li class='num'><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
									}
						       }
						    }																
						}
						if($pagina!=$total_paginas){
							?>
								<div class="next" style="display:inline-block;cursor: pointer;" <?php echo("location.href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . ($pagina+1)."&criterio=".$_GET['criterio']."&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."';"); ?>></div>
							<?php
						}
					}
			} ?>
                </ul>
            </div>    
        </div>
        </div>
   <!-- COLUMNA 2-->
        <div class="col2">
            <div class="search_area">
            	<form method="get">
	         		<input id="search" name="search" class="search_bar" type="text" placeholder="BUSCAR" />
	        		<input id="lupa" name="lupa" class="lupa" type="submit" value=""/>
            	</form>
            </div>
            
            <div class="social_area">
            	<a class="xumba" href="http://www.xumbadevenezuela.com/" target="_blank"></a>
                <a class="fb" href="https://www.facebook.com/XumbaDeVenezuelaCA" target="_blank"></a>
                <a class="tw" href="https://twitter.com/xumbavenezuela" target="_blank"></a>
                <a class="yt" href="http://www.youtube.com/xumbadevenezuela" target="_blank"></a>
                <a class="in" href="http://instagram.com/xumbadevenezuela" target="_blank"></a>
            </div>
            
            <div class="line2"></div>
            
            <div class="recent_area">
            	<div class="title2">RECIENTE</div>
                  <div class="preview_mini_post">
  <!-- MINI POST 1-->    
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='AGENCIA' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category1" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=AGENCIA';">LA AGENCIA</span>
				                            </div>
				                       </div>
				                    </div>
								<?php
							}
						}
            		?>
  <!-- MINI POST 2-->
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='EVENTOS' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category2" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" src="<?php echo($imagenportada); ?>" border="0"/>
				                            <a onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" class="triangle_b2" href="#"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" class="date"><?php echo($fecha_str); ?></div>
				                            <div onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" class="title"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" class="category_name" onclick="location.href='index.php?categ=EVENTOS';">EVENTOS</span>
				                            </div>
				                       </div>
				                   </div>
								<?php
							}
						}
            		?>
 <!-- MINI POST 3 -->   
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='INTERESES' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category3" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=INTERESES';">INTERESES</span>
				                            </div>
				                       </div>
				                   </div>
								<?php
							}
						}
            		?>
						<!-- MINI POST 4 -->                      
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='CREANDO' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category4" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=CREANDO';">CREANDO</span>
				                            </div>
				                       </div>
				                    </div>
								<?php
							}
						}
            		?>
  <!-- MINI POST 5 -->                    
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='UNOALAVEZ' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category5" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
					                        <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
					                        <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
					                        <div class="view2">
											<span class="category_name" onclick="location.href='index.php?categ=UNOALAVEZ';">UNO A LA VEZ</span>
										</div>
									</div>
								</div>
								<?php
							}
						}
            		?>
                   </div> 
                </div>

                <div class="instagram_area">
                    <div class="title2">INSTANTES</div>
                    <!-- SnapWidget -->
					<iframe src="http://snapwidget.com/in/?u=eHVtYmFkZXZlbmV6dWVsYXxpbnw3MHwzfDN8fG5vfDV8bm9uZXxvblN0YXJ0fHllcw==&v=221113" title="Instagram Widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:225px; height:225px"></iframe>
                </div>

                <div class="tw_area">
					<a class="twitter-timeline"  href="https://twitter.com/xumbavenezuela"  data-widget-id="403958422325850112">
						Tweets por @xumbavenezuela
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="subscribe_area">
                    <div class="title2">BOLETIN XUMBA</div>
                    <div class="text">RECIBE NUESTRO BOLETIN<br/> DE ACTUALIZACIONES Y NOVEDADES</div>
                    <form class="subscribe_form" method="post" enctype="multipart/form-data">
                        <input id="name" name="name" class="text_bar" type="text" placeholder="NOMBRE" />
                        <input id="email" name="email" class="text_bar" type="text" placeholder="E-MAIL" />
                        <input id="btn_enviar" name="btn_enviar" class="btn_input" type="submit" value="ENVIAR" />
	                    <?php
		                    $btn=$_POST['btn_enviar'];
		                    if($btn){
		                    	$email=$_POST['email'];
								$nombre=$_POST['name'];
								$sql0="SELECT * FROM cotizacion WHERE correo='$email'";
								$pedidod0=mysql_query($sql0,$conexion);
								if($pedidod0){
									$filas=mysql_num_rows($pedidod0);
									if($filas>0){
										$datos=mysql_fetch_array($pedidod0);
										$idcli=$datos['ID'];
										$sql="UPDATE clientes SET provienede='BOLETIN_PAGINA' WHERE ID='$idcli'";
										$pedidod=mysql_query($sql,$conexion);
										if($pedidod){
											//$_SESSION['usuariopag']=$nombreu;
											//RECEPCION DE DATOS////////////////////////////////////////////////
											$emailfrom="cotizaciones.ferreco@gmail.com";
											$emailto="cotizaciones.ferreco@gmail.com";
											$asunto="DATOS DEL NUEVO REGISTRO BOLETIN ferreco.com.ve";
											//CABECERAS////////////////////////////////////////////////
											$cabeceras = "MIME-Version: 1.0\r\n";
											$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
											$cabeceras .= "From: ".$emailfrom."\r\n"."Reply-To: ".$emailfrom."\r\n" .'X-Mailer: PHP/' . phpversion();
											//MENSAJE////////////////////////////////////////////////
											$msjpedido.="SE HA REGISTRADO EL USUARIO ".$nombreu." PARA BOLETINES EN LA PAGINA WEB.";
											$msjpedido.="<br><br>Gracias por preferirnos.<br><br>";
											$msjpedido.="FERRECO, C.A.<br><br>";
											$msjpedido.="</body></html>";
											//ENVIO////////////////////////////////////////////////
											mail($emailto,$asunto,$msjpedido,$cabeceras);
											?>
												<script type="text/javascript">
													alert("Se ha registrado exitosamente");
												</script>
											<?php
				
										}
										else{
											echo("Error al procesar los datos: ".mysql_error());
										}
									}
									else{
										$sql="INSERT INTO cotizacion(nombre,correo,provienede) VALUES('$nombre','$email','BOLETIN_PAGINA')";
										$pedidod=mysql_query($sql,$conexion);
										if($pedidod){
											//$_SESSION['usuariopag']=$nombreu;
											//RECEPCION DE DATOS////////////////////////////////////////////////
											$emailfrom="cotizaciones.ferreco@gmail.com";
											$emailto="cotizaciones.ferreco@gmail.com";
											$asunto="DATOS DEL NUEVO REGISTRO BOLETIN ferreco.com.ve";
											//CABECERAS////////////////////////////////////////////////
											$cabeceras = "MIME-Version: 1.0\r\n";
											$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
											$cabeceras .= "From: ".$emailfrom."\r\n"."Reply-To: ".$emailfrom."\r\n" .'X-Mailer: PHP/' . phpversion();
											//MENSAJE////////////////////////////////////////////////
											$msjpedido.="SE HA REGISTRADO EL USUARIO ".$nombreu." PARA BOLETINES EN LA PAGINA WEB.";
											$msjpedido.="<br><br>Gracias por preferirnos.<br><br>";
											$msjpedido.="FERRECO, C.A.<br><br>";
											$msjpedido.="</body></html>";
											//ENVIO////////////////////////////////////////////////
											mail($emailto,$asunto,$msjpedido,$cabeceras);
											?>
												<script type="text/javascript">
													alert("Se ha registrado exitosamente");
												</script>
											<?php
				
										}
										else{
											echo("Error al procesar los datos: ".mysql_error());
										}										
									}
								}
		                    }
	                    ?>
                    </form>
                </div>
              </div>
            </div>
          </div>
       </div>
    </div>
        <?php
		}
		else{
			$sql="SELECT * FROM noticias WHERE ID='".$_GET['idnoticia']."'";
			$pedido=mysql_query($sql,$conexion);
			echo(mysql_error());
			if($pedido){
				$filas=mysql_num_rows($pedido);
				if($filas>0){
					$etiquetas_detalle=array();
					$datos=mysql_fetch_array($pedido);
					$fechart=$datos['fechacons'];
					$fecha_str=$datos['fecha'];
					$autorarticulo=$datos['autorarticulo'];
					$autorportada=$datos['autorportada'];
					$titulo=$datos['titulo'];
					$cuerpo=$datos['cuerpo'];
					$etiquetas=$datos['etiquetas'];
					$IDnoticiaMenu=$datos['ID'];
					$categoria=$datos['tipo'];
					$imagenportada="admin/".$datos['fotodir'];
					$tipo_str=$datos['tipo'];
					if($tipo_str=="AGENCIA"){
						$estilocss="col1_3 category1";
						$estilocss2="detail_view category1";
					}
					if($tipo_str=="EVENTOS"){
						$estilocss="col1_3 category2";
						$estilocss2="detail_view category2";
					}
					if($tipo_str=="INTERESES"){
						$estilocss="col1_3 category3";
						$estilocss2="detail_view category3";
					}
					if($tipo_str=="CREANDO"){
						$estilocss="col1_3 category4";
						$estilocss2="detail_view category4";
					}
					if($tipo_str=="UNOALAVEZ"){
						$estilocss="col1_3 category5";
						$estilocss2="detail_view category5";
					}
					if($tipo_str=="AGENCIA"){
						$tipo_str="LA AGENCIA";
					}
					if($tipo_str=="UNOALAVEZ"){
						$tipo_str="UNO A LA VEZ";
					}
					
					$etiquetas=get_etiquetas($IDnoticiaMenu,$conexion);
				}
			}
        ?>
<!-- CONTENT -->

    <div class="content">
        <div class="col1_2">
            <div class="<?php echo($estilocss); ?>">
                <div class="date"><?php echo($fecha_str); ?></div>
                <div class="view3" href="#">
                    <span class="category_name"><?php echo($tipo_str); ?></span>
                    <div class="triangle"></div>
                    
                </div>
            </div>

            <div class="<?php echo($estilocss2); ?>">
                <div class="post">
                    <div class="content_text">
                        <div class="title" href="#"><?php echo($titulo); ?></div><br><br>
                        <div class="autor">by <span id="#"><?php echo($autorarticulo); ?></span></div>
                        <div class="cover">
                            <img src="<?php echo($imagenportada); ?>" border="0"/>
                        </div>

                        <div class="photo_credit">Cortesia de <?php echo($autorportada); ?></div>

                        <div class="content_text"><?php echo($cuerpo); ?></div>

                        <div class="internal"></div>
                    	<?php
                    		getRedesButtons($conexion);
                    	?>
                        <ul class="tag_list2">
<?php
		                	for($i=0;$i<=(count($etiquetas)-1);$i++){
		                		$onclicketi="location.href='index.php?search=".$etiquetas[$i]."';"
		                		?>
		                			<li class="tag" onclick="<?php echo($onclicketi); ?>"><?php echo($etiquetas[$i]); ?></li>
		                		<?php
		                	}
?>
                        </ul>
                        <div class="navigation">
			       			<?php
			       			
							$sqlsid="SELECT * FROM noticias WHERE ID<'$IDnoticiaMenu' ORDER BY ID DESC LIMIT 1";
							//echo("HOLA");
							$pedidosid=mysql_query($sqlsid,$conexion);
							if($pedidosid){
								//echo("HOLA");
								$filasid=mysql_num_rows($pedidosid);
								//echo($filaslog);
								if($filasid>0){
									//echo("HOLA");
									$i=0;
									$datasid=mysql_fetch_array($pedidosid);
									$IDante=$datasid['ID'];
									$enlacearticuloante="location.href='index.php?idnoticia=".$IDante."';";
									?>
										<div onclick="<?php echo($enlacearticuloante); ?>" class="prev"></div>
									<?php
								}
							}
							
							$sqlsid2="SELECT * FROM noticias WHERE ID>'$IDnoticiaMenu' ORDER BY ID ASC LIMIT 1";
							//echo("HOLA");
							$pedidosid2=mysql_query($sqlsid2,$conexion);
							if($pedidosid2){
								//echo("HOLA");
								$filasid2=mysql_num_rows($pedidosid2);
								//echo($filaslog);
								if($filasid2>0){
									//echo("HOLA");
									$i=0;
									$datasid2=mysql_fetch_array($pedidosid2);
									$IDnext=$datasid2['ID'];
									$enlacearticuloprox="location.href='index.php?idnoticia=".$IDnext."';";
									?>
			                 			<div onclick="<?php echo($enlacearticuloprox); ?>" class="next"></div>
									<?php
								}
							}
			       			?>
                        </div>
                        <div class="comments_area">
							<div class="fb-comments" data-href="<?php echo("http://xumbadevenezuela.com/entorno_prueba_xumbablog/index.php?idnoticia=".$IDnoticiaMenu); ?>" data-width="510" data-numposts="5" data-colorscheme="light"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col2">
   <!-- COLUMNA 2-->
        <div class="col2">
            <div class="search_area">
            	<form method="get">
	         		<input id="search" name="search" class="search_bar" type="text" placeholder="BUSCAR" />
	        		<input id="lupa" name="lupa" class="lupa" type="submit" value=""/>
            	</form>
            </div>
            
            <div class="social_area">
            	<a class="xumba" href="http://www.xumbadevenezuela.com/" target="_blank"></a>
                <a class="fb" href="https://www.facebook.com/XumbaDeVenezuelaCA" target="_blank"></a>
                <a class="tw" href="https://twitter.com/xumbavenezuela" target="_blank"></a>
                <a class="yt" href="http://www.youtube.com/xumbadevenezuela" target="_blank"></a>
                <a class="in" href="http://instagram.com/xumbadevenezuela" target="_blank"></a>
            </div>
            
            <div class="line2"></div>
            
            <div class="recent_area">
            	<div class="title2">RECIENTE</div>
                  <div class="preview_mini_post">
  <!-- MINI POST 1-->    
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='AGENCIA' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category1" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=AGENCIA';">LA AGENCIA</span>
				                            </div>
				                       </div>
				                    </div>
								<?php
							}
						}
            		?>
  <!-- MINI POST 2-->
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='EVENTOS' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category2" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=EVENTOS';">EVENTOS</span>
				                            </div>
				                       </div>
				                   </div>
								<?php
							}
						}
            		?>
 <!-- MINI POST 3 -->   
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='INTERESES' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category3" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img src="<?php echo($imagenportada); ?>" border="0" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"/>
				                            <a class="triangle_b2" href="#"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=INTERESES';">INTERESES</span>
				                            </div>
				                       </div>
				                   </div>
								<?php
							}
						}
            		?>
						<!-- MINI POST 4 -->                      
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='CREANDO' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category4" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" src="<?php echo($imagenportada); ?>" border="0"/>
				                            <a class="triangle_b2" href="#" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"></a>
				                        </div>
				                        <div class="content_text">
				                            <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
				                            <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
				                            <div class="view2">
				                                <span class="category_name" onclick="location.href='index.php?categ=CREANDO';">CREANDO</span>
				                            </div>
				                       </div>
				                    </div>
								<?php
							}
						}
            		?>
  <!-- MINI POST 5 -->                    
            		<?php
						$sql="SELECT * FROM noticias WHERE tipo='UNOALAVEZ' ORDER BY ID DESC LIMIT 1";
						$pedido=mysql_query($sql,$conexion);
						echo(mysql_error());
						if($pedido){
							$filas=mysql_num_rows($pedido);
							if($filas>0){
								$datos=mysql_fetch_array($pedido);
								$fechart=$datos['fechacons'];
								$fecha_str=$datos['fecha'];
								$titulo=$datos['titulo'];
								$cuerpo=$datos['cuerpo'];
								$etiquetas=$datos['etiquetas'];
								$IDnoticiaMenu=$datos['ID'];
								$categoria=$datos['tipo'];
								$imagenportada="admin/".$datos['fotodir'];
								?>
				                	<div class="mini_posts category5" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    	<div class="cover" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
				                    		<img onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;" src="<?php echo($imagenportada); ?>" border="0"/>
				                            <a class="triangle_b2" href="#"></a>
				                        </div>
				                        <div class="content_text" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;">
					                        <div class="date" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($fecha_str); ?></div>
					                        <div class="title" onclick="<?php echo("location.href='index.php?idnoticia=".$IDnoticiaMenu."';"); ?>" style="cursor: pointer;"><?php echo($titulo); ?></div>
					                        <div class="view2">
											<span class="category_name" onclick="location.href='index.php?categ=UNOALAVEZ';">UNO A LA VEZ</span>
										</div>
									</div>
								</div>
								<?php
							}
						}
            		?>
                   </div> 
                </div>

                <div class="instagram_area">
                    <div class="title2">INSTANTES</div>
                    <!-- SnapWidget -->
					<iframe src="http://snapwidget.com/in/?u=eHVtYmFkZXZlbmV6dWVsYXxpbnw3MHwzfDN8fG5vfDV8bm9uZXxvblN0YXJ0fHllcw==&v=221113" title="Instagram Widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:225px; height:225px"></iframe>
                </div>

                <div class="tw_area">
					<a class="twitter-timeline"  href="https://twitter.com/xumbavenezuela"  data-widget-id="403958422325850112">
						Tweets por @xumbavenezuela
					</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="subscribe_area">
                    <div class="title2">BOLETIN XUMBA</div>
                    <div class="text">RECIBE NUESTRO BOLETIN<br/> DE ACTUALIZACIONES Y NOVEDADES</div>
                    <form class="subscribe_form" method="post" enctype="multipart/form-data">
                        <input id="name" name="name" class="text_bar" type="text" placeholder="NOMBRE" />
                        <input id="email" name="email" class="text_bar" type="text" placeholder="E-MAIL" />
                        <input id="btn_enviar" name="btn_enviar" class="btn_input" type="submit" value="ENVIAR" />
	                    <?php
		                    $btn=$_POST['btn_enviar'];
		                    if($btn){
		                    	$email=$_POST['email'];
								$nombre=$_POST['name'];
								$sql0="SELECT * FROM cotizacion WHERE correo='$email'";
								$pedidod0=mysql_query($sql0,$conexion);
								if($pedidod0){
									$filas=mysql_num_rows($pedidod0);
									if($filas>0){
										$datos=mysql_fetch_array($pedidod0);
										$idcli=$datos['ID'];
										$sql="UPDATE clientes SET provienede='BOLETIN_PAGINA' WHERE ID='$idcli'";
										$pedidod=mysql_query($sql,$conexion);
										if($pedidod){
											//$_SESSION['usuariopag']=$nombreu;
											//RECEPCION DE DATOS////////////////////////////////////////////////
											$emailfrom="cotizaciones.ferreco@gmail.com";
											$emailto="cotizaciones.ferreco@gmail.com";
											$asunto="DATOS DEL NUEVO REGISTRO BOLETIN ferreco.com.ve";
											//CABECERAS////////////////////////////////////////////////
											$cabeceras = "MIME-Version: 1.0\r\n";
											$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
											$cabeceras .= "From: ".$emailfrom."\r\n"."Reply-To: ".$emailfrom."\r\n" .'X-Mailer: PHP/' . phpversion();
											//MENSAJE////////////////////////////////////////////////
											$msjpedido.="SE HA REGISTRADO EL USUARIO ".$nombreu." PARA BOLETINES EN LA PAGINA WEB.";
											$msjpedido.="<br><br>Gracias por preferirnos.<br><br>";
											$msjpedido.="FERRECO, C.A.<br><br>";
											$msjpedido.="</body></html>";
											//ENVIO////////////////////////////////////////////////
											mail($emailto,$asunto,$msjpedido,$cabeceras);
											?>
												<script type="text/javascript">
													alert("Gracias, le estaremos enviando nuestros boletines.");
												</script>
											<?php
				
										}
										else{
											echo("Error al procesar los datos: ".mysql_error());
										}
									}
									else{
										$sql="INSERT INTO cotizacion(nombre,correo,provienede) VALUES('$nombre','$email','BOLETIN_PAGINA')";
										$pedidod=mysql_query($sql,$conexion);
										if($pedidod){
											//$_SESSION['usuariopag']=$nombreu;
											//RECEPCION DE DATOS////////////////////////////////////////////////
											$emailfrom="cotizaciones.ferreco@gmail.com";
											$emailto="cotizaciones.ferreco@gmail.com";
											$asunto="DATOS DEL NUEVO REGISTRO BOLETIN ferreco.com.ve";
											//CABECERAS////////////////////////////////////////////////
											$cabeceras = "MIME-Version: 1.0\r\n";
											$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
											$cabeceras .= "From: ".$emailfrom."\r\n"."Reply-To: ".$emailfrom."\r\n" .'X-Mailer: PHP/' . phpversion();
											//MENSAJE////////////////////////////////////////////////
											$msjpedido.="SE HA REGISTRADO EL USUARIO ".$nombreu." PARA BOLETINES EN LA PAGINA WEB.";
											$msjpedido.="<br><br>Gracias por preferirnos.<br><br>";
											$msjpedido.="FERRECO, C.A.<br><br>";
											$msjpedido.="</body></html>";
											//ENVIO////////////////////////////////////////////////
											mail($emailto,$asunto,$msjpedido,$cabeceras);
											?>
												<script type="text/javascript">
													alert("Gracias, le estaremos enviando nuestros boletines.");
												</script>
											<?php
				
										}
										else{
											echo("Error al procesar los datos: ".mysql_error());
										}										
									}
								}
		                    }
	                    ?>
                    </form>
                </div>
              </div>
		</div>
    </div>
    <?php
		}
    ?>
     <!-- AREA DE FOOTER-->
      <!-- end content -->
  <div id="footer">
    <div class="content_footer">
        <div class="adress"> Av. Venezuela, Torre Oxal, Planta Baja, Local 1. El Rosal, Caracas-Venezuela<br/>
            <span style="font-weight:bold;">(+58) 0212 750.54.23 / ventas@xumbadevenezuela.com</span>
        </div>
        <div class="credits">
            Corporación Xumba de Venezuela, C.A. Rif: J-29779337-2
        </div>
        <div class="social_area2">
            <a class="xumba" href="http://www.xumbadevenezuela.com/" target="_blank"></a>
            <a class="fb" href="https://www.facebook.com/XumbaDeVenezuelaCA" target="_blank"></a>
            <a class="tw" href="https://twitter.com/xumbavenezuela" target="_blank"></a>
            <a class="yt" href="http://www.youtube.com/xumbadevenezuela" target="_blank"></a>
            <a class="in" href="http://instagram.com/xumbadevenezuela" target="_blank"></a>
        </div>
    </div>
  </div>
</body>
</html>
