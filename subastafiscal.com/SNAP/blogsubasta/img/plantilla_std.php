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
	//echo($conexion);
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
	<script src="js/bootstrap.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
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
	            <?  
			   	if (!isset($_SESSION['g_usuario']['acceso'])){ 
			  	?>
	            
	            <form method="get" name="ingresomenu" id="ingresomenu" enctype="multipart/form-data">
	           		<input id="buscarelementos" name="buscarelementos" type="text" style="width:545px;height:25px;" placeholder="Buscar Noticias..."/>
	            </form>
	            <? 
				} 
				?>
	            <script type="text/javascript">
	            var_chat = 1;
				//Valida el formulario
				$('#ingresomenu').submit(function(event) {  
					event.preventDefault();  
					
					
					var url   = $(this).attr('action');  
					var datos = $(this).serialize();  
					
					
					if (validUsuario()== false){
						
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
					<a href="#">
						<img src="img/icono_twitter.png" />
					</a>
					<a href="#">
						<img src="img/icono_facebook.png" />
					</a>
					<a href="#">
						<img src="img/icono_linkedin.png" />
					</a>
					<a href="#">
						<img src="img/icono_youtube.png" />
					</a>
	        	</div>
	            </div>
	          		</div>
	          </div>
	          <?  
			   if (isset($_SESSION['g_usuario']['acceso'])){ 
			  ?>
	          <!--Session Activa-->
	          <div id="bienvenido">Bienvenido! <span class="nombre"><? echo $_SESSION['g_usuario']['nombre']?></span></div>
	          <? } ?>
	          <!--Session Inanctiva-->
	          <?  
			   if (!isset($_SESSION['g_usuario']['acceso'])){ 
			  	
			  ?>
	          <script type="text/javascript">valor_ini();</script>
	          <div id="registrate" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('registrateimg','','img/registratehover.png',1);">
	          
	          <? } ?>
	          
	          
	          <!--Session Activa-->
	          <? if (isset($_SESSION['g_usuario']['acceso'])) { ?> 
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
	        <? } ?>
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
	                            			
	                              <li class="botongrande"><a href="index.php?articulosemanal=true"><span class="botonesgrande">Art&iacute;culo de la</span><br /><span class="botonesgrande">Semana</span></a></li>
	                                        
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
												if($data4['fotodir']==""){
													?>
														<div id="medcontentfoto" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($data4['tipo'])); ?>" /></div>
													<?php
												}
												else{
													?>
														<div id="medcontentfoto" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><img src="<?php echo("admin/".$datos4['fotodir']); ?>" /></div>
													<?php
												}
											?>
											<div id="noticiamed" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(ucwords(strtolower(utf8_decode($datos4['titulo'])))); ?></div>
											</div>
											<div id="piednoti" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(get_date_publish($datos4['fechacons'])); ?></div>
											</div>
											<div id="leyenda" onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos4['ID']); ?>'"><?php echo(substr($datos4['cuerpo'], 0,330)."..."); ?></div>
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
						<?php
					}
					else{
						if($_GET['articulosemanal']!='true' && $_GET['laempresa']!='true'){
?>
					<div id="noticia_content">
					<?php
					if($_GET['buscarelementos']!=''){
						$q=$_GET['buscarelementos'];
						$sqlbuscar="SELECT noticias.ID,fotodir,fechacons,cuerpo,titulo,tipo,autorarticulo,autorportada,qescribio,etiquetas.ID_art,etiqueta FROM noticias, etiquetas WHERE MATCH(etiquetas.etiqueta) AGAINST('$q') LIMIT 8";
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
											<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
																							<?php
												if($datos2['fotodir']==""){
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
													<div><?php echo(ucwords(strtolower(utf8_decode($datos2['titulo'])))); ?></div>
												</div>
												<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
													<div><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
												</div>
												<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
													<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(substr($datos2['cuerpo'], 0,106)."..."); ?></div>
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
												if($datos2['fotodir']==""){
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
														<div><?php echo(ucwords(strtolower(utf8_decode($datos2['titulo'])))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(substr($datos2['cuerpo'], 0,106)."..."); ?></div>
													</div>
												</div>
											</div>
										<?php
									}
									$x++;
								}
							}
							else{
								
							}
						}
					}
					if($_GET['buscaretiquetas']!=''){
						$q=$_GET['buscaretiquetas'];
						$sqlbuscar="SELECT * FROM noticias WHERE MATCH(etiquetas) AGAINST('$q') LIMIT 8";
						$query=mysql_query($sqlbuscar,$conexion);
						if($query){
							$filas=mysql_num_rows($query);
							if($filas>0){
								$x=0;
								while($datos2=mysql_fetch_array($query)){
									?>
										<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
																																		<?php
												if($datos2['fotodir']==""){
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
												<div><?php echo(ucwords(strtolower(utf8_decode($datos2['titulo'])))); ?></div>
											</div>
											<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
												<div><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
											</div>
											<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
												<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(substr($datos2['cuerpo'], 0,106)."..."); ?></div>
											</div>
										</div>
									<?php
								}
							}
							else{
								
							}
						}
					}
						if($_GET['buscarelementos']=='' && $_GET['buscaretiquetas']==''){
					?>
						<div id="colizqpq">
							<?php
							
							if($_GET['eventos']=="true"){
								?>
									<div class="moddestacado">
										<span><img src="img/icono_noticia_gris.png">Eventos</span>
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
							
								if($tiponoticia==''){
									$sql2="SELECT * FROM noticias WHERE destacado='SI' ORDER BY ID DESC LIMIT 4";
								}
								else{
									$sql2="SELECT * FROM noticias WHERE destacado='SI' AND tipo='$tiponoticia' ORDER BY ID DESC LIMIT 4";
								}
								$pedido2=mysql_query($sql2,$conexion);
								//echo($pedido2);
								if($pedido2){
									$filas2=mysql_num_rows($pedido2);
									if($filas2>0){
										while($datos2=mysql_fetch_array($pedido2)){
											?>
												<div id="noticiapequeno" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
											<?php
												if($datos2['fotodir']==""){
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
														<div><?php echo(ucwords(strtolower(utf8_decode($datos2['titulo'])))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div><?php echo(get_date_publish($datos2['fechacons'])); ?></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'">
														<div onclick="location.href='<?php echo("index.php?idnoticia=".$datos2['ID']); ?>'"><?php echo(substr($datos2['cuerpo'], 0,100)."..."); ?></div>
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
							if($_GET['buscarelementos']=='' && $_GET['buscaretiquetas']==''){
						?>
						<div id="colderpq">
								<?php
								if($_GET['enmedios']=="true"){
									$tiponoticia="EVENTO";				
								}
								else{
									?>
										<div class="moddestacado">
											<span><img src="img/icono_noticia_gris.png">Otras Noticias</span>
										</div>
									<?php								
								}
								
								
								if($tiponoticia==''){
									$sql3="SELECT * FROM noticias WHERE destacado<>'SI' ORDER BY ID DESC LIMIT 4";
								}
								else{
									$sql3="SELECT * FROM noticias WHERE destacado<>'SI' AND tipo='$tiponoticia' ORDER BY ID DESC LIMIT 4";
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
														if($datos3['fotodir']==""){
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'"><img src="<?php echo(get_cat_img_posts($datos3['tipo'])); ?>" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'" /></div>
															<?php
														}
														else{
															?>
																<div id="medcontentfotopq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'"><img src="<?php echo("admin/".$datos3['fotodir']); ?>" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'" /></div>
															<?php
														}
													?>
													<div id="noticiamedpq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'">
														<div><?php echo(ucwords(strtolower(utf8_decode($datos3['titulo'])))); ?></div>
													</div>
													<div id="piednotipq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'">
														<div><?php echo(get_date_publish($datos3['fechacons'])); ?></div>
													</div>
													<div id="leyendapq" onclick="location.href='<?php echo("index.php?idnoticia=".$datos3['ID']); ?>'">
														<div><?php echo(substr($datos3['cuerpo'], 0,130)."..."); ?></div>
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
					?>
					</div> <?php
						}
					}
					?>	
				</div>
				<div id="columnader">
					<div id="cuadrocateg">
						<span><img src="img/icono_noticia_blanco.png" /> Noticias por categor&iacute;a</span>
						<ul>
							<li onclick="location.href='?categ=fiscal';">
								<img src="img/icono_carpeta_blanco.png" />Fiscal
							</li>
							<li onclick="location.href='?categ=laboral';">
								<img src="img/icono_laboral_blanco.png" />Laboral
							</li>
							<li onclick="location.href='?categ=tributario';">
								<img src="img/icono_tributaria_blanco.png" />Tributaria
							</li>
							<li onclick="location.href='?categ=outcont';">
								<img src="img/icono_outsourcing_blanco.png" />Outsourcing Contable
							</li>
							<li onclick="location.href='?categ=afiscales';">
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
			<div class="footer">
				<div class="letra_g_grande">
					<span onclick="location.href='?articulosemanal=true';">Artículo de la semana</span>
					<span onclick="location.href='http://subastafiscal.com/sf/web/index.php?webpage=7';">La Empresa</span>
					<span onclick="location.href='index.php?enmedios=true';">Subastafiscal en medios</span>
					<span onclick="location.href='http://cefincorp.com/';">Cursos de Cefincorp</span>
					<span onclick="location.href='index.php?eventos=true';">Eventos</span>
				</div>
				<div class="letra_f_pq">Todos los derechos reservados ® 2012 www.SubastaFiscal.com c.a. J-30950027-9. Diseño y Desarrollo <span class="estxumba" onclick="location.href='http://xumbadevenezuela.com'">Xumba de Venezuela</span></div>
			</div>
		</div>
    <!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
