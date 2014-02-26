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
		$condic2="WHERE idioma='es' AND tipo='".$_GET['categ']."' ORDER BY fechacons DESC";
	}
	elseif($_GET['buscarelementos']!=''){
		$condic2="WHERE titulo LIKE '%".$_GET['buscarelementos']."%' idioma='es' ORDER BY fechacons DESC";
	}
	elseif($_GET['eventos']=='true'){
		$condic2="WHERE tipo='EVENTO' AND destacado='SI' AND idioma='es' ORDER BY fechacons DESC";
	}
	else{
		$condic2="WHERE idioma='es' AND destacado<>'SI' AND tipo<>'EVENTO' ORDER BY fechacons DESC";
	}
	//PAGINACION
	$ssql = "SELECT * FROM noticias ".$condic2;
	//echo($ssql);
	$rs = mysql_query($ssql,$conexion);
	$num_total_registros = mysql_num_rows($rs);
	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros/$TAMANO_PAGINA);
	//echo($num_total_registros);
	////echo($total_paginas); 
	/////////////////////////////////////////////////////////
	$sql="SELECT * FROM noticias WHERE tipo<>'EVENTO' ORDER BY ID DESC LIMIT 1";
	$pedido=mysql_query($sql,$conexion);
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Subastafiscal.com Blog</title>
	<meta name="description" content="Blog de www.subastafiscal.com, aquí encontrarás información relacionada con noticias del acontecer económico,fiscal y tribuario de Venezuela" />
	<meta name="keywords" content="subasta | fiscal | subastafiscal | blog | fiscal | tributaria | impuestos | SICAD | Cadivi | " />
	<meta name="author" content="metatags generator">
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="7 days" />
	<title>Subastafiscal blog, información económica al momento</title>
	<!-- subastafiscal | Nicolas Bianco | Blog -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
	<script src="js/bootstrap.js"></script>
    <script src="js/tests/vendor/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-45899812-1', 'subastafiscal.com');
	  ga('send', 'pageview');
	
	</script>
  </head>

  <body>
	<!-- .container -->
<div id="container_total">
	<div id="contenedorheader">
	      <div id="header">
	    <div id="sombra"></div>
	        <div id="verdebackground">
	        	<div id="contenedorelementosverde">
	            <div id="contenedorusuario">
	            <form method="get">
	           		<input id="buscarelementos" name="buscarelementos" type="text" style="width:545px;height:25px;" placeholder="Buscar Noticias..."/>
	            </form>
	            <script type="text/javascript">
	            var_chat = 1;
				//Valida el formulario
				$('#ingresomenu').submit(function(event) {  
					event.preventDefault();  
					
					
					var url   = $(this).attr('action');  
					var datos = $(this).serialize();  
					
					
					if (validUsuario()==false){
						
						return false;
					}
					
					var request = $.ajax({
						type: "POST",
						data: datos,
						dataType:"json",
						url: url,
						success: function(data){
							$.each(data,function(index,value) {
								
								if (data[index].sesActiva != '0'){
									$("#ventana").html( data[index].sesHtml );
									mostrar_popup('ventana',1);
								}else{
									document.location.href = "index.php?webpage=1";	
								}
							});
						},
						fail:function(jqXHR, textStatus) { 
						//alert( "Request failed: " + textStatus ); 
						}
									
					});
					
					document.ingresomenu.reset(); 
				  
				}); 
				
				function validUsuario(){		
	                var var_usuario = document.getElementById('loginuser').value;
	                var var_clave   = document.getElementById('passwordusu').value;
	                //Valida Usuario
	                if ((var_usuario == '' ) || (var_usuario == 'Correo' )){
	                    valor_ini();
	                    return false;
	                }
	                
	                //Valida Clave
	                if ((var_clave == '' ) || (var_clave == 'Contraseña' )){
	                    valor_ini();
	                    return false;
	                }
					return true;
	         		 
	            }
				
				
				passwordElement1 = document.getElementById('passwordusux');
	     		passwordElement2 = document.getElementById('passwordusu');
	
				 function claveFocus() {
					  passwordElement1.style.display = "none";
					  passwordElement2.style.display = "inline";
					  passwordElement2.focus();
			
				 }
	
				 function claveBlur() {
			
					if(passwordElement2.value=='') {
			
					   passwordElement2.style.display = "none";
					   passwordElement1.style.display = "inline";
					   passwordElement1.focus();
			
					}
			
				 }
	
				function valor_ini(){
					document.getElementById('loginuser').value = "Correo";
					document.getElementById('passwordusux').value = "Contraseña";
				}
	
				function vaciar_usuario(){
					document.getElementById('loginuser').value = '';
				}
		
				function vaciar_clave(){
					passwordElement2.value = '';	
				}
				function ChatIni(){
					//$('#descripcion_chat').html('Escriba aqui...');
					$('#descripcion_chat').html('');
				}
				
				String.prototype.trim=function () {
	  				return this.replace(/^\s+/,'').replace(/\s+$/,'');
				}
				function ChatWrite(valor){
					//if (valor.trim() == 'Escriba aqui...'){
						this.value='';
					//}
				}
				
				//Muestra Chat
				function showChat(){
					if (var_chat == 1){
						ChatIni();
						mostrardiv('contenedorchatabajo');
						var_chat = 0;
					}else{
						cerrar('contenedorchatabajo');
						var_chat = 1;
					}
		
				}
							
		 		//Muestra menu
				function mostrardiv(identificadordiv) {
					div = document.getElementById(identificadordiv);
					div.style.display = "";
				}
				
				function cerrar(identificadordiv) {
					div = document.getElementById(identificadordiv);
					div.style.display='none';
				}
				</script>
	        	<div style="position:relative;margin-top:-20px;margin-left:560px;float:left;height:35px;width:200px;">
					<a href="https://twitter.com/SubastaFiscal" target="_blank">
						<img src="img/icono_twitter.png" />
					</a>
					<a href="https://www.facebook.com/subasta.fiscal?fref=ts" target="_blank">
						<img src="img/icono_facebook.png" />
					</a>
					<a href="#">
						<img src="img/icono_linkedin.png" />
					</a>
					<a href="http://www.youtube.com/user/SubastaFiscal" target="_blank">
						<img src="img/icono_youtube.png" />
					</a>
	        	</div>
	            </div>
	          		</div>
	          </div>
	          <?php  
			   if (isset($_SESSION['g_usuario']['acceso'])){ 
			  ?>
	          <!--Session Activa-->
	          <div id="bienvenido">Bienvenido! <span class="nombre"><? echo $_SESSION['g_usuario']['nombre']?></span></div>
	          <?php } ?>
	          <!--Session Inanctiva-->
	          <?php  
			   if (!isset($_SESSION['g_usuario']['acceso'])){ 
			  	
			  ?>
	          <script type="text/javascript">valor_ini();</script>
	          <div id="registrate" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('registrateimg','','img/registratehover.png',1);">
	          
	          <?php } ?>
	          
	          
	          <!--Session Activa-->
	          <?php if (isset($_SESSION['g_usuario']['acceso'])) { ?> 
	          <div id="registrate" onmouseout="MM_swapImgRestore();cerrar('contenedormenuusuario')" onmouseover="MM_swapImage('registrateimg','','img/micuentahover.png',1);mostrardiv('contenedormenuusuario');">
	          
	          <img src="img/micuenta.png" name="registrate" width="100" height="55" border="0" id="registrateimg" />
	          
	          <br>
	 		<div id="contenedormenuusuario" style="display:none;">
	        
	        <li class="botonesusuario"><span class="icon"></span><a href="index.php?webpage=15&amp;seccpnt=0">Subasta Activa</a></li>
	          <li class="botonesusuario"><span class="icon2"></span><a href="index.php?webpage=15&amp;seccpnt=1">Movimientos</a></li>
	       <li class="botonesusuario"><a href="index.php?webpage=15&amp;seccpnt=2"><span class="icon3"></span>Balance y Certif.</a></li>
	        <li class="botonesusuario"><span class="icon4"></span><a href="index.php?webpage=15&amp;seccpnt=3">Configuración</a></li>
	        <li class="botonesusuario"><span class="icon5"></span><a href="usuario_out-action.php">Cerrar Sesión</a></li>
	        </div>
	        <?php } ?>
	       </div>
	                       
	                        
	           	
	            
	  
	        	<div id="logo"><img src="img/logo_subasta_blog.png" width="248" height="192" border="0"  onclick="document.location.href='index.php';" style="cursor:pointer;margin-left:-10px;"/>
	            </div>
	            	<div id="blanco">
	                </div>
	                	<div id="menu">
	                		<div id="gris">
	                        </div>
	                        	<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
	                            <div id="cuadromenu">
	                            	<ul class="menuprincipal">
	                            			
	                              <li class="botongrande"><a href="<?php echo("index.php?idnoticia=".$IDnoticiaMenu); ?>"><span class="botonesgrande">Art&iacute;culo de la</span><br /><span class="botonesgrande">Semana</span></a></li>
	                                        
	                                  <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" />
	                                  </div>
	                                    	<li class="botongrande"><a href="http://subastafiscal.com/sf/web/index.php?webpage=7"><span class="botonesgrande">La Empresa</span></a></span></li>
	                                    <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
	                                  <li class="botongrande"><a href="index.php?enmedios=true"><span class="botonesgrande">Subastafiscal <br> en medios</span></a></li>
	                      			<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
	                                    	<li class="botongrande"><a href="http://cefincorp.com/"><span class="botonesgrande">Cursos de</span>
	                                    	<br /><span class="botonesgrande">Cefincorp</span></a></li>
	                                     <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
	                                       <li class="botongrande"><a href="index.php?eventos=true"><span class="botonesgrande">Eventos</span>
	                                    </a></li>
										<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
	                            		<div id="grisfinal"></div>
	                                </ul>
	                                
	                         
	                                
	                       	   </div>
	        	  </div>
	    	</div>
		</div>
	</div>
</div>
<div style="position: relative;width:100%;height:50px; background: #FFF;color:#FFF;top:161px;"></div>
		<div id="container_centrado">
			<div id="medio">
				<div id="columnaizq">
					<?php
					
					if($_GET['articulosemanal']=="true"){
						include("mods/articulosemanal.php");
					}
					if($_GET['laempresa']=="true"){
						include("mods/laempresa.php");
					}
					if($_GET['enmedios']=="true"){
						?>
							<div class="moddestacado">
								<span><img src="img/icono_medios.png"> SubastaFiscal en medios</span>
							</div>
						<?php
					}
					if($_GET['mod']=='' && $_GET['categ']=='' && $_GET['archivos']=='' && $_GET['articulosemanal']!='true' && $_GET['laempresa']!='true' && $_GET['enmedios']!='true' && $_GET['cefincorp']!='true' && $_GET['eventos']!='true' && $_GET['idnoticia']=='' && $_GET['buscarelementos']=='' && $_GET['buscaretiquetas']==''){
						$sql4="SELECT * FROM noticias WHERE destacado='SI' ORDER BY ID DESC LIMIT 1";
						$pedido4=mysql_query($sql4,$conexion);
						//echo(mysql_error());
						if($pedido4){
							$filas4=mysql_num_rows($pedido4);
							if($filas4>0){
								while($datos4=mysql_fetch_array($pedido4)){
									?>
										<div id="noticiagrande" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
											<?php
												$dirfoto="admin/".$datos4['fotodir'];
												//echo($dirfoto);
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfoto" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($datos4['tipo'])); ?>" /></div>
													<?php
												}
												elseif(file_exists($dirfoto)){
													?>
														<div id="medcontentfoto" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><img src="<?php echo($dirfoto); ?>" /></div>
													<?php
												}
											?>
											<div id="noticiamed" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(ucwords(mb_strtolower($datos4['titulo'],"UTF-8"))); ?></div>
											</div>
											<div id="piednoti" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div id="fecha" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(get_date_publish($datos4['fechacons'])); ?></div>
												<div id="categ"><img src="<?php echo(get_cat_img($datos4['tipo'])); ?>" /></div>
											</div>
											<div id="leyenda" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(strip_tags(substr($datos4['cuerpo'], 0,330))."..."); ?></div>
											</div>
										</div>
									<?php
								}
							}
						}
						else{
							//echo($pedido4);
						}
					}
					
					if($_GET['idnoticia']!=''){
						$sql="SELECT * FROM noticias WHERE ID='".$_GET['idnoticia']."'";
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
								<div class="titulo_post1"><?php echo(ucwords(mb_strtolower($titulo,"UTF-8"))); ?></div>
							</div>
							<div class="content">
								<div class="divimagen">
									<?php
									
									if(file_exists($imagenportada)){
										?>
											<img src="<?php echo($imagenportada); ?>" />
										<?php
										$imgdef="http://subastafiscal.com/sf/web/blogsubasta/".$imagenportada;
									}
									else{
										?>
											<img src="<?php echo(get_cat_img_posts($categoria)); ?>" />
										<?php
										$imgdef="http://subastafiscal.com/sf/web/blogsubasta/".get_cat_img_posts($categoria);
									}
									
									?>
								</div>
								<?php
									//echo($imgdef);
									getRedesButtons($titulo,$imgdef);
									echo($cuerpo);
								?>
							</div>
							<?php
								if($etiquetas!=''){
									$tiq=array();
									$tiq=explode(",", $etiquetas);
								}
								if(count($tiq)>0){
							?>
							<div class="etiquetas">
								<span><img src="img/icono_bandera_gris.png"> Etiquetas para este art&iacute;culo</span>
								<div>
								<ul>
									<?php
										for($i=0;$i<=(count($tiq)-1);$i++){
											?>
												<li onclick="location.href='<?php echo("index.php?buscarelementos=".$tiq[$i]); ?>';">
													<?php echo($tiq[$i]); ?>
												</li>
											<?php
										}
									?>
								</ul>
								</div>
							</div>
							<?php
								}
							?>
						</div>
						<?php
					}
					else{
						if($_GET['articulosemanal']!='true' && $_GET['laempresa']!='true'){
?>
					<div id="noticia_content">
					<?php
					if($_GET['buscarelementos']!=''){
						$q=$_GET['buscarelementos'];
						$sqlbuscar="SELECT DISTINCT * FROM noticias WHERE titulo LIKE '%$q%' LIMIT ".$inicio.",".$TAMANO_PAGINA;
						$query=mysql_query($sqlbuscar,$conexion);
						if($query){
							$filas=mysql_num_rows($query);
							if($filas>0){
								$x=0;
								while($datos2=mysql_fetch_array($query)){
									$exa=$x%2;
									if($exa==0){
									?>
										<div id="colizqpq">
											<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
											<?php $dirfoto="admin/".$datos2['fotodir'];
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo("admin/".$datos2['fotodir']); ?>" /></div>
													<?php
												}
											?>
												<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
												</div>
												<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
													<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
												</div>
												<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
												</div>
											</div>
										</div>
									<?php
									}
									else{
										?>
											<div id="colderpq">
												<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
											<?php 
												$dirfoto="admin/".$datos2['fotodir'];
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo($dirfoto); ?>" /></div>
													<?php
												}
											?>
													<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
														<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
													</div>
												</div>
											</div>
										<?php
									}
									$x++;
								}
							}
							else{
								$sqlbuscar="SELECT DISTINCT * FROM noticias,etiquetas WHERE etiquetas.etiqueta LIKE '%$q%' LIMIT ".$inicio.",".$TAMANO_PAGINA;
								$query=mysql_query($sqlbuscar,$conexion);
								if($query){
									$filas=mysql_num_rows($query);
									if($filas>0){
										$x=0;
										while($datos2=mysql_fetch_array($query)){
											$exa=$x%2;
											if($exa==0){
											?>
												<div id="colizqpq">
													<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<?php $dirfoto="admin/".$datos2['fotodir'];
														if(!file_exists($dirfoto)){
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
															<?php
														}
														else{
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo("admin/".$datos2['fotodir']); ?>" /></div>
															<?php
														}
													?>
														<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
															<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
														</div>
														<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
															<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
															<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
														</div>
														<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
															<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
														</div>
													</div>
												</div>
											<?php
											}
											else{
												?>
													<div id="colderpq">
														<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
													<?php 
														$dirfoto="admin/".$datos2['fotodir'];
														if(!file_exists($dirfoto)){
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
															<?php
														}
														else{
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo($dirfoto); ?>" /></div>
															<?php
														}
													?>
															<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
																<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
															</div>
															<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
																<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
																<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
															</div>
															<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
																<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
															</div>
														</div>
													</div>
												<?php
											}
											$x++;
										}
									}
								}
							}
						}
					}
					if($_GET['categ']!=''){
						$q=$_GET['categ'];
						$sqlbuscar="SELECT * FROM noticias WHERE tipo='$q' LIMIT ".$inicio.",".$TAMANO_PAGINA;
						$query=mysql_query($sqlbuscar,$conexion);
						if($query){
							$filas=mysql_num_rows($query);
							if($filas>0){
								$x=0;
								while($datos2=mysql_fetch_array($query)){
									$exa=$x%2;
									if($exa==0){
									?>
										<div id="colizqpq">
											<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
											<?php 
												$dirfoto="admin/".$datos2['fotodir'];
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo($dirfoto); ?>" /></div>
													<?php
												}
											?>
												<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
												</div>
												<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
													<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
												</div>
												<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
													<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
												</div>
											</div>
										</div>
									<?php
									}
									else{
										?>
											<div id="colderpq">
												<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
											<?php 
												$dirfoto="admin/".$datos2['fotodir'];
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><img src="<?php echo("admin/".$datos2['fotodir']); ?>" /></div>
													<?php
												}
											?>
													<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
														<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
													</div>
												</div>
											</div>
										<?php
									}
									$x++;
								}
							}
						}
					}
						if($_GET['buscarelementos']=='' && $_GET['categ']==''){
					?>
						<div id="colizqpq">
							<?php
							
							if($_GET['eventos']=="true"){
								?>
									<div class="moddestacado">
										<span><img src="img/icono_eventos.png">Eventos</span>
									</div>
								<?php
								$tiponoticia="EVENTO";
							}
							elseif($_GET['enmedios']=="true"){
								$tiponoticia="EVENTO";				
							}
							else{
								?>
									<div class="moddestacado">
										<span><img src="img/icono_noticia_gris.png">Destacadas</span>
									</div>
								<?php								
							}
							if($_GET['eventos']=="true"){
								$colarr=array("e28228","faaf40");
								?>
								<ul class="calendario_eventos">
									<li id="MesEnero" style="background:#e28228;">
										<span>Enero</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivEnero" style="display: none;">
										<ul>
<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='01' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=4500;
														$x1=4300;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesFebrero" style="background:#faaf40;">
										<span>Febrero</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivFebrero" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='02' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=3500;
														$x1=3300;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesMarzo" style="background:#e28228;">
										<span>Marzo</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivMarzo" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='03' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=3010;
														$x1=2300;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesAbril" style="background:#faaf40;">
										<span>Abril</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivAbril" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='04' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=300;
														$x1=1300;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesMayo" style="background:#e28228;">
										<span>Mayo</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivMayo" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='05' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=400;
														$x1=1400;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesJunio" style="background:#faaf40;">
										<span>Junio</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivJunio" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='06' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=500;
														$x1=1500;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesJulio" style="background:#e28228;">
										<span>Julio</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivJulio" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='07' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=600;
														$x1=1600;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo($datos2['titulo']); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesAgosto" style="background:#faaf40;">
										<span>Agosto</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivAgosto" style="display: none;">
										<ul>
											<?php
												$sqlbuscaragos="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='08' AND YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query2=mysql_query($sqlbuscaragos,$conexion);
												if($query2){
													//echo("FILAS".$filas);
													$filasw=mysql_num_rows($query2);
													if($filasw>0){
														//echo("FILAS".$filas);
														$x=700;
														$x1=1700;
														while($datos2=mysql_fetch_array($query2)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesSeptiembre" style="background:#e28228;">
										<span>Septiembre</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivSeptiembre" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='09' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=800;
														$x1=1800;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesOctubre" style="background:#faaf40;">
										<span>Octubre</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivOctubre" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='10' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=100;
														$x1=1100;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesNoviembre" style="background:#e28228;">
										<span>Noviembre</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivNoviembre" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='11' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=110;
														$x1=1110;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
									<li id="MesDiciembre" style="background:#faaf40;">
										<span>Diciembre</span>
										<img src="img/icono_expandir_evento.png">
									</li>
									<li id="SubdivDiciembre" style="display: none;">
										<ul>
											<?php
												$sqlbuscar="SELECT * FROM noticias WHERE tipo='EVENTO' AND MONTH(fechaev)='12' AND  YEAR(fechaev)='".date("Y")."' ORDER BY fechaev DESC";
												$query=mysql_query($sqlbuscar,$conexion);
												if($query){
													$filas=mysql_num_rows($query);
													if($filas>0){
														$x=120;
														$x1=1220;
														while($datos2=mysql_fetch_array($query)){
															$divancla="DIVANCLA_".$x;
															$divdesplegado="DIVDESPLEGADO_".$x1;
															?>
															<li>
																<span id="<?php echo($divancla); ?>"><?php echo($datos2['titulo']); ?></span>
																<ul id="<?php echo($divdesplegado); ?>" style="display: none;">
																	<li>
																		<div>
																			<?php echo($datos2['cuerpo']); ?>
																		</div>
																	</li>
																</ul>											
															</li>
															<script type="text/javascript">
																//Abrir colapsar
																jQuery(document).ready(function(){
																  //jQuery("#submenuCollection").hide();
																  //toggle the componenet with class msg_body
																  //alert("HOLA");
																  jQuery(<?php echo($divancla); ?>).click(function(e){
																  	//e.preventDefault();
																    jQuery(this).next(<?php echo($divdesplegado); ?>).slideToggle(150);
																  });
																});
															</script>
															<?php
															$x++;
															$x1++;
														}
													}
												}
											?>
										</ul>
									</li>
								</ul>
								<?php
							}
							else{
								if($tiponoticia==''){
									$sql2="SELECT * FROM noticias WHERE destacado='SI' ORDER BY ID DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
								}
								else{
									if($_GET['eventos']=="true"){
										$tiponoticia="EVENTO";
									}
									$sql2="SELECT * FROM noticias WHERE destacado='SI' AND tipo='$tiponoticia' ORDER BY ID DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
								}
								$pedido2=mysql_query($sql2,$conexion);
								//echo($pedido2);
								if($pedido2){
									$filas2=mysql_num_rows($pedido2);
									if($filas2>0){
										while($datos2=mysql_fetch_array($pedido2)){
											?>
												<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
											<?php
												$dirfoto="admin/".$datos2['fotodir'];
												if(!file_exists($dirfoto)){
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo(get_cat_img_posts($datos2['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';"><img src="<?php echo("admin/".$datos2['fotodir']); ?>" /></div>
													<?php
												}
											?>
													<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
														<div><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
														<div id="fecha"><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
														<div id="categ"><img src="<?php echo(get_cat_img($datos2['tipo'])); ?>" /></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>';">
														<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,100))."..."); ?></div>
													</div>
												</div>
											<?php
										}
									}
								}
							}
							?>
						</div>
						<?php
							}
							if($_GET['buscarelementos']=='' && $_GET['buscaretiquetas']=='' && $_GET['categ']==''){
						?>
						<div id="colderpq">
								<?php
								if($_GET['enmedios']=="true"){
									$tiponoticia="EVENTO";
								}
								elseif($_GET['eventos']=="true"){
									$tiponoticia="EVENTO";
									?>
										<div class="moddestacado">
											<span><img src="img/icono_noticia_gris.png">Destacadas</span>
										</div>
									<?php				
								}
								else{
									?>
										<div class="moddestacado">
											<span><img src="img/icono_noticia_gris.png">Otras Noticias</span>
										</div>
									<?php								
								}
								
							if($_GET['categ']!='' && $_GET['eventos']!='true'){
								$sql3="SELECT * FROM noticias WHERE idioma='es' AND destacado<>'SI' AND tipo='".$_GET['categ']."' ORDER BY fechacons DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
							}
							elseif($_GET['buscarelementos']!=''){
								$sql3="SELECT * FROM noticias WHERE titulo LIKE '%".$_GET['buscarelementos']."%' AND destacado<>'SI' AND idioma='es' ORDER BY fechacons DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
							}
							elseif($_GET['eventos']=='true'){
								$sql3="SELECT * FROM noticias WHERE tipo='EVENTO' AND destacado='SI' AND idioma='es' ORDER BY fechacons DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
							}
							else{
								if($tiponoticia==''){
									$sql3="SELECT * FROM noticias WHERE idioma='es' AND destacado<>'SI'  ORDER BY fechacons DESC, ID DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
								}
								else{
									$sql3="SELECT * FROM noticias WHERE destacado<>'SI' AND tipo='$tiponoticia' ORDER BY fechacons DESC,ID DESC LIMIT ".$inicio.",".$TAMANO_COLUMNA;
								}
							}
								
								$pedido3=mysql_query($sql3,$conexion);
								//echo(mysql_error());
								if($pedido3){
									$filas3=mysql_num_rows($pedido3);
									//echo($filas3);
									if($filas3>0){
										while($datos3=mysql_fetch_array($pedido3)){
													?>
														<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'">
														<?php
														$dirfoto="admin/".$datos3['fotodir'];
														if(!file_exists($dirfoto)){
															?>
																<div id="medcontentfotopq" onclick="<?php echo("location.href='index.php?idnoticia=".$datos3['ID']."';"); ?>"><img src="<?php echo(get_cat_img_posts($datos3['tipo'])); ?>" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'" /></div>
															<?php
														}
														else{
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>';"><img src="<?php echo("admin/".$datos3['fotodir']); ?>" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'" /></div>
															<?php
														}
													?>
													<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>';">
														<div><?php echo(ucwords(mb_strtolower($datos3['titulo'],"UTF-8"))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>';">
														<div id="fecha"><?php echo(get_date_publish($datos3['fechacons'])); ?></div>
														<div id="categ"><img src="<?php echo(get_cat_img($datos3['tipo'])); ?>" /></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>';">
														<div><?php echo(strip_tags(substr($datos3['cuerpo'], 0,130))."..."); ?></div>
													</div>
												</div>
											<?php
										}
									}
								}
							?>
						</div>
					<?php
							}
					?> </div> <?php
						}
					}
					?>
				</div>
				<div id="columnader">
					<div id="cuadrocateg">
						<span><img src="img/icono_noticia_blanco.png" /> Noticias por categor&iacute;a</span>
						<ul>
							<li onclick="location.href='?categ=FISCAL';">
								<img src="img/icono_carpeta_blanco.png" />Fiscal
							</li>
							<li onclick="location.href='?categ=LABORAL';">
								<img src="img/icono_laboral_blanco.png" />Laboral
							</li>
							<li onclick="location.href='?categ=TRIBUTARIA';">
								<img src="img/icono_tributaria_blanco.png" />Tributaria
							</li>
							<li onclick="location.href='?categ=OUTSOURCING.CONTABLE';">
								<img src="img/icono_outsourcing_blanco.png" />Outsourcing Contable
							</li>
							<li onclick="location.href='?categ=ALERTAS.FISCALES';">
								<img src="img/icono_alerta_blanco.png" />Alertas Fiscales
							</li>
						</ul>
					</div>
					<div id="twitter">
						<a class="twitter-timeline"  href="https://twitter.com/SubastaFiscal" height="500" data-widget-id="364860277826658304">Tweets por @SubastaFiscal</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<div id="cuadroarchivos">
						<span><img src="img/icono_archivos.png" />Archivos</span>
						<ul>
							<?php
								$sql="SELECT * FROM noticias GROUP BY YEAR(fechacons) ORDER BY fechacons DESC";
								$pedido=mysql_query($sql,$conexion);
								if($pedido){
									$filas=mysql_num_rows($pedido);
									if($filas>0){
										while($datos=mysql_fetch_array($pedido)){
											$array=explode("-",$datos['fechacons']);
											$anio=$array[0];
											?>
												<li onclick="location.href='<?php echo("index.php?buscarporanio=".$anio); ?>';">
													<?php echo($anio); ?>
												</li>
											<?php
										}
									}
								}
							?>
						</ul>
					</div>
					<div id="cuadrodescargables2">
						<span><img src="img/icono_descarga_gris.png" style="margin-right:10px;" />Descargables</span>
					</div>
					<div id="cuadrodescargables">
						<ul>
							<?php
								$sql="SELECT * FROM descargas ORDER BY ID DESC LIMIT 4";
								$pedido=mysql_query($sql,$conexion);
								if($pedido){
									$filas=mysql_num_rows($pedido);
									if($filas>0){
										while($datos=mysql_fetch_array($pedido)){
											$urlabs="admin/".$datos['url'];
											?>
												<li>
													<span>
														<a href="<?php echo($urlabs); ?>" target="_blank">
															<?php
																echo($datos['urld']);
															?>
														</a>
													</span>
												</li>
											<?php
										}
									}
								}
							?>
						</ul>
					</div>
				</div>
			</div>
			<?php if($_GET['idnoticia']=='' && $_GET['articulosemanal']!='true'){ ?>
			<div class="paginacion">
				<ul style="<?php 
				if($pagina==0){
					echo("width:".(($total_paginas*730)/6)."px;");
				} 
				elseif($pagina>0 && $pagina<$total_paginas){
					echo("width:".(($total_paginas*790)/6)."px;");
				}
				else{
					echo("width:".(($total_paginas*730)/6)."px;");
				}
				?>">
				<?php
					//muestro los distintos índices de las páginas, si es que hay varias páginas
					if ($total_paginas>1){
						if($pagina>1){
							echo("<a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . ($pagina-1)."&criterio=".$_GET['criterio']."&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'><li class=\"prev\"><span id='derecha'>Anterior</span></li></a>");
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
						          echo("<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true'>".$pagina."</a></li>");
						        }
						       else{
						       		if($i==$total_paginas){
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
						       		}
									else {
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li ".$style."><a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
									}
						       }
						    }																
						}
						if($pagina!=$total_paginas){
							echo "<a href='index.php?mod=productos&mar_id=".$_GET['mar_id']."&pagina=" . ($pagina+1) . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$TAMANO_PAGINA."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'><li class=\"next\"><span id='izquierda'>Siguiente</span></li></a> ";
						}
					}
				?>
				</ul>
			</div>
			<div class="boton_inicio">
				<a href="index.php">
					INICIO
				</a>
			</div>
			<?php } ?>
		</div>
		<div id="container_centrado2">
			<div class="footer">
				<div class="letra_g_grande">
					<span onclick="location.href='?articulosemanal=true';">Artículo de la semana</span>
					<span onclick="location.href='http://subastafiscal.com/sf/web/index.php?webpage=7';">La Empresa</span>
					<span onclick="location.href='index.php?enmedios=true';">Subastafiscal en medios</span>
					<span onclick="location.href='http://cefincorp.com/';">Cursos de Cefincorp</span>
					<span onclick="location.href='index.php?eventos=true';">Eventos</span>
				</div>
				<div class="letra_f_pq">Todos los derechos reservados ® 2012 www.SubastaFiscal.com c.a. J-30950027-9. Diseño y Desarrollo <span class="estxumba" onclick="window.open('http://xumbadevenezuela.com','_blank');">Xumba de Venezuela</span></div>
			</div>
		</div>
    <!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript">
		//Abrir colapsar
		jQuery(document).ready(function(){
		  //jQuery("#submenuCollection").hide();
		  //toggle the componenet with class msg_body
		  jQuery("#MesEnero").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivEnero").slideToggle(150);
		  });
		  jQuery("#MesFebrero").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivFebrero").slideToggle(150);
		  });
		  jQuery("#MesMarzo").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivMarzo").slideToggle(150);
		  });
		  jQuery("#MesAbril").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivAbril").slideToggle(150);
		  });
		  jQuery("#MesMayo").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivMayo").slideToggle(150);
		  });
		  jQuery("#MesJunio").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivJunio").slideToggle(150);
		  });
		  jQuery("#MesJulio").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivJulio").slideToggle(150);
		  });
		  jQuery("#MesAgosto").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivAgosto").slideToggle(150);
		  });
		  jQuery("#MesSeptiembre").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivSeptiembre").slideToggle(150);
		  });
		  jQuery("#MesOctubre").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivOctubre").slideToggle(150);
		  });
		  jQuery("#MesNoviembre").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivNoviembre").slideToggle(150);
		  });
		  jQuery("#MesDiciembre").click(function(e){
		  	//e.preventDefault();
		    jQuery(this).next("#SubdivDiciembre").slideToggle(150);
		  });
		});
	</script>
  </body>
</html>
