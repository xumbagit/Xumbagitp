<?php
function getheader(){
	?>
		<meta charset="UTF-8">
		<title>MC ® - MINISTERIO DEL CAOS -</title>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/footer.css" rel="stylesheet" type="text/css">
		<link href="css/category1.css" rel="stylesheet" type="text/css">
		<link href="css/category2.css" rel="stylesheet" type="text/css">
		<link href="css/familia.css" rel="stylesheet" type="text/css">
		<link href="css/galeria.css" rel="stylesheet" type="text/css">
		<link href="css/contacto.css" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="dist/js/bootstrap.js"></script>
		<script src="http://malsup.github.com/jquery.cycle.all.js" type="text/javascript"></script>
		<link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php
}

function getPreloaderComplete(){
	?>
		<script src="libs/jpreloader.js"></script>
		<link rel="stylesheet" href="css/jpreloader.css" type="text/css" media="screen" />
	<?php	
	getJpreloader();
}

function getJpreloader(){
?>
<style type="text/css">
	#jpreOverlay {
		background-color:#000000;
		background-image:url(img/IMG_3485_mini.jpg);
		height:100%;
		width:100%;
		background-repeat: no-repeat;
		background-size:cover;
	}
</style>
	<script>
	$(document).ready( function() {
		var timer;	//timer for splash screen
		var timer_bio;	//timer for splash screen
		var onComplete;
		mostrar_slides();
		timer_bio=setInterval("mostrar_slides()", 1500);
		onComplete=function(){
			clearInterval(timer_bio);
		}
		$('#navigation a').on('click', function() {
			if( !$(this).hasClass('btn-main') ) {
				$('#navigation a')
				.toggleClass('btn-secondary')
				.toggleClass('btn-main');
				
				var tar = $(this).attr('href');
				$('.holder').fadeOut(500, function() {
					$(tar).fadeIn(500);
				});
			}
			return false;
		});
		$('#set2').hide();
		$('#header').css('top', '-100px');
		$('#footer').css('bottom', '-100px');
		$('#wrapper').hide();
		//calling jPreLoader
		$('body').jpreLoader({
			showSplash: true,
			splashID: "#jSplash",
			loaderVPos: '50%',
			autoClose: true,
			closeBtnText: "Entrar",
			splashFunction: function() {  
				//passing Splash Screen script to jPreLoader
				$('#jSplash').children('section').not('.selected').hide();
				$('#jSplash').hide().fadeIn(800);
				
				timer = setInterval(function() {
					splashRotator();
				}, 4000);
			}
		}, function() {	//callback function
			clearInterval(timer);
			$('#footer')
			.animate({"bottom":0}, 500);
			$('#header')
			.animate({"top":0}, 800, function() {
				$('#wrapper').fadeIn(1000);
			});
		});
		
		//create splash screen animation
		function splashRotator(){
			var cur = $('#jSplash').children('.selected');
			var next = $(cur).next();
			
			if($(next).length != 0) {
				$(next).addClass('selected');
			} else {
				$('#jSplash').children('section:first-child').addClass('selected');
				next = $('#jSplash').children('section:first-child');
			}
				
			$(cur).removeClass('selected').fadeOut(800, function() {
				$(next).fadeIn(800);
			});
		}
		
		
	});
	</script>
	<script type="text/javascript" language="JavaScript">
		//Slideshow de los covers
		var contc;
		var contdiv;
		var nomdiv;
		var contcd;
		var colecnom;
		var maxslides;
		var minslides;
		var tiposlides;
		minslides=0;
		contc=-1;
		contcd=0;
		contdiv=0;
		maxslides=2;
		nomdiv="SLIDE_" + contc;
		
		function mostrar_slides(){
			$(function(){
				if(contc==maxslides){
					contc=0;
					nomaslide="#SLIDE_" + maxslides;
					nomnslide="#SLIDE_" + (contc);
					$(nomaslide).fadeOut(300);
					$(nomnslide).fadeIn(300);
				}
				else{
					nomaslide="#SLIDE_" + contc;
					nomnslide="#SLIDE_" + (contc+1);
					$(nomaslide).fadeOut(300);
					if(contc==-1){
						//$(nomnslide).show();
					}
					else{
						$(nomnslide).fadeIn(300);
					}
					++contc;
				}
			});
		}
	</script>
	<section id="jSplash">
		<section class="selected" style="margin-top: -200px;z-index:2000;">
			<img alt="" src="img/mc_dark.png" style="margin-top:500px;z-index: 2000;width:345px;height:auto;">
		</section>
	</section>
<?php
}

function getDiaSem($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	// 0->domingo	 | 6->sabado
	$diaresult= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
	$dias_semana=array("domingo","lunes","martes","miércoles" ,"jueves","viernes","sábado");
	$str_dia=strtoupper($dias_semana[$diaresult]);
	return $str_dia;
}

function getMesFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	// 1->enero	 | 12->diciembre
	$diaresult= date("n",mktime(0, 0, 0, $mes, $dia, $ano));
	$dias_semana=array("ene","feb","mar","abr" ,"may","jun","jul","ago","sep","oct","nov","dic");
	$str_dia=ucwords(strtolower($dias_semana[($diaresult-1)]));
	return $str_dia;
}


function getMesSolo($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	$dias_semana=array("ENERO","FEBRERO","MARZO","ABRIL" ,"MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$str_dia=ucwords(strtolower($dias_semana[($mes-1)]));
	return $str_dia;
}

function getDiaFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	return $dia;
}

function getAnioFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	return $ano;
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

function getbackground($seccion,$conexion){
	$etiquetas=array();
	$sql="SELECT * FROM background WHERE seccion='$seccion'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$i=0;
			$datos=mysql_fetch_array($pedido);
			$fondo=$datos['imgfoto'];
			$strimg="admin/".$fondo;
		}
	}
	return $strimg;
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
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <div class="share_area">
			<table style="display:block;margin-top:0px;margin-bottom: 20px;">
				<tr>
					<td style="width: 100px;">
						<div class="fb-share-button" data-type="button_count"></div>
					</td>
					<td style="width: 16px;">
						
					</td>
					<td style="width: 45px;">
						<a target="_blank" href="https://twitter.com/share" class="twitter-share-button" data-via="mdelcaos" data-related="mdelcaos" data-hashtags="mdelcaos">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</td>
				</tr>
			</table>
    </div>
	<?php
}

function getMenu($conexion){
	?>
	<!--START HEADER-->
	    <div class="header">
	    	<a href="index.php">
	    		<div class="logo"></div>
	    	</a>
	        <div class="styles">
	        	<?php
	        		if($_GET['mod']==''){
	        			$cadenastr="location.href='?estilo=dark';";
						$lcadenastr="location.href='?estilo=light';";
	        		}
					else{
						$cadenastr="location.href='?estilo=dark&mod=".$_GET['mod']."';";
						$lcadenastr="location.href='?estilo=light&mod=".$_GET['mod']."';";
					}
	        	
	        	?>
	            <span onclick="<?php echo($cadenastr); ?>" id="light_btn">DARK STYLE</span>
	             <span> | </span>
	            <span onclick="<?php echo($lcadenastr); ?>" id="dark_btn">LIGHT SLYTE</span>
	        </div>
	        <div class="content_nav">
	            <ul class="nav">
	            	<?php
	            		$tipobanner="BOTON1";
						$sqlog="SELECT * FROM botonera WHERE idboton='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$nombre=$datos['valboton'];
							}
						}
						//FAMILIA
	            	?>
	                <li class="nav_btn" onclick="location.href='?mod=familia';"><?php echo($nombre); ?></li>
	                <li class="line"></li>
	            	<?php
	            		$tipobanner="BOTON2";
						$sqlog="SELECT * FROM botonera WHERE idboton='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$nombre=$datos['valboton'];
							}
						}
						//MC ® VANCE SUZETTE
	            	?>
	                <li class="nav_btn" onclick="location.href='?mod=vancesuzette';"><?php echo($nombre); ?></li>
	                <li class="line"></li>
<?php
	            		$tipobanner="BOTON3";
						$sqlog="SELECT * FROM botonera WHERE idboton='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$nombre=$datos['valboton'];
							}
						}
						//category1
	            	?>
	                <li class="nav_btn" onclick="location.href='?mod=category';"><?php echo($nombre); ?></li>
	                <li class="line"></li>
<?php
	            		$tipobanner="BOTON4";
						$sqlog="SELECT * FROM botonera WHERE idboton='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$nombre=$datos['valboton'];
							}
						}
						//GALERIA
	            	?>
	                <li class="nav_btn" onclick="location.href='?mod=galeria';"><?php echo($nombre); ?></li>
	                <li class="line"></li>
<?php
	            		$tipobanner="BOTON5";
						$sqlog="SELECT * FROM botonera WHERE idboton='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$nombre=$datos['valboton'];
							}
						}
						//CONTACTO
	            	?>
	                <li class="nav_btn" onclick="location.href='?mod=contacto';"><?php echo($nombre); ?></li>
	            </ul>
	            <div class="red_line"></div>
	        </div>
	    </div>
	<!--END HEADER-->
	<?php
}

function getSocialArea(){
	?>
	    <div class="social_area">
	    	<a href="https://www.facebook.com/MinisterioCaos" target="_blank">
	    		<div class="icon" id="fb"></div>
	    	</a>
	        <a href="https://twitter.com/MdelCaos" target="_blank">
	        	<div class="icon" id="tw"></div>
	        </a>
	        <a href="http://www.youtube.com/user/MninisteriodelCaos" target="_blank">
	        	<div class="icon" id="yt"></div>
	        </a>
			<a href="http://vimeo.com/ministeriodelcaos" target="_blank">
				<div class="icon" id="vi"></div>
			</a>
			<a href="http://instagram.com/mdelcaos" target="_blank">
				<div class="icon" id="in"></div>
			</a>
	    </div>
	<?php
}

function getfooter(){
	?>
    <div class="footer">
        <div class="red_line"></div>
        <div class="content_footer">
            <ul class="nav2">
                <li class="nav_btn2" onclick="location.href='?mod=familia';">FAMILIA</li>
                <li class="nav_btn2" onclick="location.href='?mod=vancesuzette';">MC ® VANCE SUZETTE</li>
                <li class="nav_btn2" onclick="location.href='?mod=category';">LEGADO</li>
                <li class="nav_btn2" onclick="location.href='?mod=galeria';">GALERIA</li>
                <li class="nav_btn2" onclick="location.href='?mod=contacto';">CONTACTO</li>
            </ul>
        </div>
        <div class="credits">
            <div class="content_credits"> ® Derechos Reservados Ministerio de Caos C.A. RIF J-2349870-9
                <div class="credit"> Desarrollado por <a href="http://xumbadevenezuela.com/" target="_blank"><div class="logo_xumba"></div></a>
                </div>
            </div>
        </div>
    </div>
	<?php
}

function getdetalle($iddetalle,$conexion){
	$sql="SELECT * FROM noticias WHERE ID='$iddetalle'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$imagen="admin/".$datos['fotodir'];
			if($datos['tipo']=="VANCE_SUZETTE"){
				?>
		            <div class="post">
		                <div class="cover_img"><img src="<?php echo($imagen); ?>" border="0" /></div>
		                <div class="img_credit"><?php echo($datos['imgautor']); ?></div>
		                <div class="content_text">
		                    <div class="title"><?php echo($datos['titulo']); ?></div>
		                    <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
		                    <div class="author"><?php echo($datos['autor']); ?></div>
		                    <?php getRedesButtons($conexion); ?>
		                    <div class="text">
		                    	<?php echo($datos['cuerpo']); ?>
		                    </div>
		                </div>
		
		                <div class="nav_detail">
		                <?php
							$sqlsid="SELECT * FROM noticias WHERE ID<'$iddetalle' ORDER BY ID DESC LIMIT 1";
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
									if($datos['tipo']=="GALERIA"){
										$enlacearticuloante="index.php?mod=galeria&iddetalle=".$IDante;
									}
									if($datos['tipo']=="LEGADO"){
										$enlacearticuloante="index.php?mod=category&iddetalle=".$IDante;
									}
									if($datos['tipo']=="VANCE_SUZETTE"){
										$enlacearticuloante="index.php?mod=vancesuzette&iddetalle=".$IDante;
									}
									
									?>
										<a href="<?php echo($enlacearticuloante); ?>"><span class="prev"></span></a>
									<?php
								}
							}
							
							$sqlsid2="SELECT * FROM noticias WHERE ID>'$iddetalle' ORDER BY ID ASC LIMIT 1";
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
									if($datos['tipo']=="GALERIA"){
										$enlacearticuloprox="index.php?mod=galeria&iddetalle=".$IDnext;
									}
									if($datos['tipo']=="LEGADO"){
										$enlacearticuloprox="index.php?mod=category&iddetalle=".$IDnext;
									}
									if($datos['tipo']=="VANCE_SUZETTE"){
										$enlacearticuloprox="index.php?mod=vancesuzette&iddetalle=".$IDnext;
									}
									?>
			                 			<a href="<?php echo($enlacearticuloprox); ?>"><span class="next"></span></a>
									<?php
								}
							}
						?>
		                </div>
		            </div>
				<?php
			}
			if($datos['tipo']=="GALERIA"){
				?>
			        <div class="post">
			            <div class="content_text">
			                <div class="title"><?php echo($datos['titulo']); ?></div>
			                <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
			                <?php getRedesButtons($conexion); ?>
			                <div class="cover_img"><img src="<?php echo($imagen); ?>" border="0" /></div>
			                <div class="text">
			                	<?php echo($datos['cuerpo']); ?>
			                </div>
			            </div>
			        </div>
				<?php					
			}
			if($datos['tipo']=="LEGADO"){
				?>
			        <div class="post">
			           <div class="cover_img"><img src="<?php echo($imagen); ?>" border="0" /></div>
			           <div class="img_credit">Cortsia de Ministerio del Caos</div>
			           <div class="content_text">
			               <div class="title"><?php echo($datos['titulo']); ?></div>
			               <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
			               <div class="author"><?php echo($datos['autor']); ?></div>
			               <?php getRedesButtons($conexion); ?>
			               <div class="text"><?php echo($datos['cuerpo']); ?></div>
			               
			           </div>
			
			           <div class="nav_detail">
		                <?php
							$sqlsid="SELECT * FROM noticias WHERE ID<'$iddetalle' ORDER BY ID DESC LIMIT 1";
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
									if($datos['tipo']=="GALERIA"){
										$enlacearticuloante="index.php?mod=galeria&iddetalle=".$IDante;
									}
									if($datos['tipo']=="LEGADO"){
										$enlacearticuloante="index.php?mod=category&iddetalle=".$IDante;
									}
									if($datos['tipo']=="VANCE_SUZETTE"){
										$enlacearticuloante="index.php?mod=vancesuzette&iddetalle=".$IDante;
									}
									
									?>
										<a href="<?php echo($enlacearticuloante); ?>"><span class="prev"></span></a>
									<?php
								}
							}
							
							$sqlsid2="SELECT * FROM noticias WHERE ID>'$iddetalle' ORDER BY ID ASC LIMIT 1";
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
									if($datos['tipo']=="GALERIA"){
										$enlacearticuloprox="index.php?mod=galeria&iddetalle=".$IDnext;
									}
									if($datos['tipo']=="LEGADO"){
										$enlacearticuloprox="index.php?mod=category&iddetalle=".$IDnext;
									}
									if($datos['tipo']=="VANCE_SUZETTE"){
										$enlacearticuloprox="index.php?mod=vancesuzette&iddetalle=".$IDnext;
									}
									?>
			                 			<a href="<?php echo($enlacearticuloprox); ?>"><span class="next"></span></a>
									<?php
								}
							}
						?>
			           </div>
			       </div>
				<?php
			}
		}
	}
}

function getposts($categ,$conexion){
	$sql="SELECT * FROM noticias WHERE tipo='$categ'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			while($datos=mysql_fetch_array($pedido)){
				$imagen="admin/".$datos['fotodir'];
				$IDdetalle=$datos['ID'];
				if($datos['tipo']=="GALERIA"){
					$enlace="location.href='index.php?mod=galeria&iddetalle=".$IDdetalle."';";
				}
				if($datos['tipo']=="LEGADO"){
					$enlace="location.href='index.php?mod=category&iddetalle=".$IDdetalle."';";
				}
				if($datos['tipo']=="VANCE_SUZETTE"){
					$enlace="location.href='index.php?mod=vancesuzette&iddetalle=".$IDdetalle."';";
				}
				if($datos['tipo']=="VANCE_SUZETTE"){
					?>
					    <div class="preview_post" onclick="<?php echo($enlace); ?>">
					        <div class="preview_img" onclick="<?php echo($enlace); ?>"><img src="<?php echo($imagen); ?>" border="0"/></div>
					        <div class="content_text">
					            <div class="title"><?php echo($datos['titulo']); ?></div>
					            <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
					            <div class="text"><?php echo($datos['cuerpo']); ?></div>
					        </div>
					    </div>
					<?php
				}
				if($datos['tipo']=="GALERIA"){
					?>
					    <div class="preview_post" onclick="<?php echo($enlace); ?>">
					        <div class="preview_img" onclick="<?php echo($enlace); ?>"><img src="<?php echo($imagen); ?>" border="0" /></div>
					        <div class="content_text">
					            <div class="title"><?php echo($datos['titulo']); ?></div>
					            <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
					        </div>
					    </div>
					<?php					
				}
				if($datos['tipo']=="LEGADO"){
					?>
					    <div class="preview_post" onclick="<?php echo($enlace); ?>">
					        <div class="preview_img" onclick="<?php echo($enlace); ?>"><img src="<?php echo($imagen); ?>" border="0" /></div>
					        <div class="content_text">
					            <div class="title"><?php echo($datos['titulo']); ?></div>
					            <div class="date"><?php echo(getMesSolo($datos['fechacons'])." ".getDiaFecha($datos['fechacons']).", ".getAnioFecha($datos['fechacons'])); ?></div>
					            <div class="text"><?php echo($datos['cuerpo']); ?></div>
					        </div>
					    </div>
					<?php
				}
			}
		}
	}
}

function getcontactos($conexion){
	$sql="SELECT * FROM contactos";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			while($datos=mysql_fetch_array($pedido)){
				$imagen="admin/".$datos['foto'];
				$nombre=$datos['nombre'];
				$datocontacto=$datos['datcont'];
				$descripcion=$datos['descrip'];
				?>
			        <div class="person">
			            <div class="cover_img"><img src="<?php echo($imagen); ?>" border="0" /></div>
			            <div class="content_text">
			                <div class="title"><?php echo($nombre); ?></div>
			                <div class="author"><?php echo($datocontacto); ?></div>
			                <div class="text"><?php echo($descripcion); ?></div>
			            </div>
			        </div>
				<?php
			}
		}
	}
}

function getfrase($conexion){
	$sql="SELECT * FROM frase";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$frase=$datos['frase'];
			$autor=$datos['autor'];
			echo($frase."<br/> - ".$autor);
		}
	}
}

function getencabezado($seccion,$conexion){
	$sql="SELECT * FROM encabezados WHERE seccion='$seccion'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$arrfrase[0]=$datos['titulo'];
			$arrfrase[1]=$datos['frase'];
			return $arrfrase; 
		}
	}
}

function getpublicidad($conexion){
	$sql="SELECT * FROM publicidad";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$imagen="admin/".$datos['imagen'];
			$enlace=$datos['link'];
			if($enlace!=''){
				?>
					<div class="publicidad">
						<a href="<?php echo($enlace); ?>" target="_blank">
							<img src="<?php echo($imagen); ?>" border="0"/>
						</a>
					</div>
				<?php
			}
			else{
				?>
					<div class="publicidad">
						<img src="<?php echo($imagen); ?>" border="0"/>
					</div>
				<?php				
			}
		}
	}
}

function getThumbnailNotice($conexion){
	$sql="SELECT * FROM noticias ORDER BY ID DESC LIMIT 4";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$i=1;
			while($datos=mysql_fetch_array($pedido)){
				$imagen="admin/".$datos['fotodir'];
				$titulo=$datos['titulo'];
				$IDdetalle=$datos['ID'];
				$idmodule="m".$i;
				if($datos['tipo']=="GALERIA"){
					$enlace="location.href='index.php?mod=galeria&iddetalle=".$IDdetalle."';";
				}
				if($datos['tipo']=="LEGADO"){
					$enlace="location.href='index.php?mod=category&iddetalle=".$IDdetalle."';";
				}
				if($datos['tipo']=="VANCE_SUZETTE"){
					$enlace="location.href='index.php?mod=vancesuzette&iddetalle=".$IDdetalle."';";
				}
				?>
				    <div class="module" id="<?php echo($idmodule); ?>" onclick="<?php echo($enlace); ?>">
				        <div class="title"><?php echo($titulo); ?></div>
				        <img src="<?php echo($imagen); ?>" border="0"/>
				    </div>
				<?php
				$i++;
			}
		}
	}
}

function getInstagram(){
	?>
		<!-- SnapWidget -->
		<iframe src="http://snapwidget.com/in/?u=bWRlbGNhb3N8aW58NzJ8M3w2fHxub3w1fG5vbmV8b25TdGFydHx5ZXM=&v=30114" title="Instagram Widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:231px; height:462px"></iframe>
	<?php
}

function getarchivo($conexion){
	$sql="SELECT * FROM noticias ORDER BY ID DESC LIMIT 3";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$i=1;
			while($datos=mysql_fetch_array($pedido)){
				$imagen="admin/".$datos['fotodir'];
				$titulo=$datos['titulo'];
				$idmodule="m".$i;
				?>
				    <li onclick="<?php echo("index.php?mod="); ?>"><?php echo($titulo); ?></li>
                    <div class="red_line"></div>
				<?php
				$i++;
			}
		}
	}	
}
?>