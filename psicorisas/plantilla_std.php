<!DOCTYPE html>
<html>
<head>
<?php
	getheader();
?>
<script type="text/javascript" src="jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="jquery.cycle.all.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.slide_show').cycle({
            fx: 'scrollUp',
            timeout: 0, 
			resizeContainer: true,
			slideResize: true,
		    //after: function(currSlideElement, nextSlideElement, options, forwardFlag){
		      //    $('#caption_cont').cycle('next');
		    //},
		    // callback fn that creates a thumbnail to use as pager anchor
			pager:  '.slide_list',
		    pagerAnchorBuilder: function(i) {
	        	return '<li href="#">'+(i+1)+'</li>';
	    	}
        });
        $('#caption_cont').cycle({
            fx: 'fade',
            timeout: 0,
			resizeContainer: true,
			slideResize: true,
			cleartypeNoBg:true,
	        pager:   '.slide_list',
	        pagerAnchorBuilder: function(i) {
		        return $('.slide_list li:eq('+i+')');
		    }
        });
		$("#btninscripcion").click(function() {
			//alert("HOLA");
		     $('html, body').animate({
		         scrollTop: $("#content_inscripcion").offset().top
		     }, 'slow');
		 });
    });
</script>
</head>
<body>
    <?php
		if($_GET['programacion']!="true"){
    ?>
    <div class="yellow">
    </div>
    <?php
if($_GET['getdetalle']!="true" && $_GET['programacion']!='true'){
	if($_GET['iddetalle']=="" && $_GET['mod']==""){
    ?>
    <div class="blue">
        <div class="shadow2"></div>
        <div class="shadow"></div>
    </div>
    <?php
		}
	}
	getMenu();
if($_GET['getdetalle']=="true"){
		$sqldes1="SELECT * FROM noticias WHERE ID='".$_GET['iddetalle']."'";
		$pedido1=mysql_query($sqldes1,$conexion);
		if($pedido1){
			$filas1=mysql_num_rows($pedido1);
			if($filas1>0){
				$datoscons=mysql_fetch_array($pedido1);
				$IDante=$datoscons['ID'];
				$fecha=$datoscons['fechaev'];
				$fechaeventocons=$datoscons['fechaev'];
				//echo($fecha);
				$titulo=$datoscons['titulo'];
				$tipo=$datoscons['tipo'];
				$cuerpo=$datoscons['cuerpo'];
				$dirimagen='admin/'.$datoscons['fotodir'];
				$detalles=$datoscons['detallesevento'];
				$precio=$datoscons['precio'];
				$duracion=$datoscons['duracion'];
				$caducado=$datasid['caducado'];
				if($fecha>date("Y-m-d")){
					$caducadostr="&caducado=false";
				}
				else{
					$caducadostr="&caducado=true";
				}
				$enlacearticulosql="?getdetalle=true&iddetalle=".$IDante.$caducadostr;
			}
		}
	if($_GET['iddetalle']!=""){
		if($_GET['caducado']=="false"){
		//PLANILLA INSCRIPCION
		?>
    <div class="content_detalle">
        <div class="events">
            <div class="col1">
                <div class="content_detail_event" id="#">
                    <div class="detail_event">
                        <div class="date">
                            <span class="day"><?php echo(getDiaSem($fecha)); ?>, <span/>
	                        <span class="number"> <?php echo(getDiaFecha($fecha)); ?> </span>
	                        <span class="month"><?php echo(getMesFecha($fecha)); ?></span>
	                        <span class="year">DE <?php echo(getAnioFecha($fecha)); ?></span>
                        </div>
                         <div class="title">
                         	<?php echo($titulo); ?>
                         </div>
                        <div class="category"><?php echo($tipo); ?></div>
                        <div class="cover_img" onclick="<?php echo("location.href='".$enlacearticulosql."';"); ?>" style="cursor: pointer;">
                            <img src="<?php echo($dirimagen); ?>" border="0"/>
                        </div>
                        <?php getRedesButtons($conexion); ?>
                        <div class="accion_area">
                            <div class="btn inscribir" name="btninscripcion" id="btninscripcion">
                            	inscribirme
                            </div>
                        </div>

                        <div class="description">
							<?php echo($cuerpo); ?>
                        </div>
                        
                    </div>
                    <div class="flap" id="cost">
                    	<?php echo($precio); ?>
                    </div>
                     <div class="flap" id="duration">
                     	<?php echo($duracion); ?>
                     </div>
                </div>
                <div class="nav_">
			       			<?php
			       				$idnoticia=$_GET['iddetalle'];
								$sqlsid="SELECT * FROM noticias WHERE fechaev<'$fechaeventocons' ORDER BY fechaev DESC LIMIT 1";
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
										$caducado=$datasid['caducado'];
										$fecha=$datasid['fechaev'];
										if($fecha>date("Y-m-d")){
											$caducadostr="&caducado=false";
										}
										else{
											$caducadostr="&caducado=true";
										}
										$enlacearticuloante="?getdetalle=true&iddetalle=".$IDante.$caducadostr;
										?>
											<div class="prev" onclick="<?php echo("location.href='".$enlacearticuloante."';")?>"></div>
										<?php
									}
								}
								
								$sqlsid2="SELECT * FROM noticias WHERE fechaev>'$fechaeventocons' LIMIT 1";
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
										$caducado2=$datasid2['caducado'];
										$fecha=$datasid2['fechaev'];
										if($fecha>date("Y-m-d")){
											$caducadostr2="&caducado=false";
										}
										else{
											$caducadostr2="&caducado=true";
										}
										$enlacearticuloprox="?getdetalle=true&iddetalle=".$IDnext.$caducadostr2;
										?>
				                 			<div class="next" onclick="<?php echo("location.href='".$enlacearticuloprox."';")?>"></div>
										<?php
									}
								}
			       			?>
                </div>
            
            </div>

            <div class="col2">
                <div class="content_calendar">
                    <h1 class="white">Calendario por mes</h1>
                    <div class="per_month">
                        <ul class="list">
                        	<?php
	                        	$u=0;
								$o=0;
								$sqlbuscar="SELECT * FROM noticias GROUP BY MONTH(fechaev) ORDER BY MONTH(fechaev) ASC, DAY(fechaev) ASC";
								$query=mysql_query($sqlbuscar,$conexion);
								if($query){
									$filas=mysql_num_rows($query);
									if($filas>0){
										while($datanot=mysql_fetch_array($query)){
											$nom1="clkmesuno".$u;
											$nom2="calmesuno1".$o;
											if($u==0){
												$stylebox="display:inline-block;";
											}
											else{
												$stylebox="display:none;";
											}
											$fechart=$datanot['fechacons'];
											$titulo_redes=$datanot['titulo'];
											$cuerpo=$datanot['cuerpo'];
											$IDnoticiaMenu=$datanot['ID'];
											$categoria=$datanot['tipo'];
											$imagenportada="admin/".$datanot['fotodir'];
											$caducado=$datanot['caducado'];
											$fecha=$datanot['fechaev'];
											if($fecha>date("Y-m-d")){
												$caducadostr="&caducado=false";
											}
											else{
												$caducadostr="&caducado=true";
											}
											$enlacearticuloppal="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
											?>
											<script type="text/javascript">
											    $(document).ready(function(){
													  $(<?php echo($nom1); ?>).click(function(e){
													  		//e.preventDefault();
													  		$(".name_events").slideUp(420);
													  		$(this).next('ul').slideToggle('fast');
													  });
											    });
											</script>
					                            <li id="<?php echo($nom1); ?>" class="months"><?php echo(getMesFechaNumStr($datanot['fechaev'])." ".getAnioFecha($datanot['fechaev'])); ?></li>
					                            <ul id="<?php echo($nom2); ?>" class="name_events" style="<?php echo($stylebox); ?>">
													<?php
														$sqlbuscar2="SELECT * FROM noticias WHERE MONTH(fechaev)='".getMesFechaNum($datanot['fechaev'])."' AND  YEAR(fechaev)='".getAnioFecha($datanot['fechaev'])."' ORDER BY fechaev DESC";
														$query2=mysql_query($sqlbuscar2,$conexion);
														if($query2){
															$filas=mysql_num_rows($query2);
															if($filas>0){
																while($datos=mysql_fetch_array($query2)){
																	?>
										                                <li class="sub" onclick="<?php echo("location.href='".$enlacearticuloppal."';"); ?>"><?php echo($datos['titulo']); ?></li>
										                                <li class="line"></li>
																	<?php
																}
															}
															else{
																	?>
										                                <li class="sub">No se encuentran resultados</li>
										                                <li class="line"></li>
																	<?php
															}
														}
													?>
					                            </ul>
											<?php
											$u++;
											$o++;
										}
									}
								}
                        	?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow2"></div>
        <div class="shadow"></div>
    </div>

    <div class="content_below" name="content_inscripcion" id="content_inscripcion">
        <div class="col1">
            
            <div class="content_form">
                <h1 class="naranja">Inscríbete colocando tus datos a continuación:</h1>
                <form class="inscripcion" method="post" enctype="multipart/form-data">
                    <div class="col1">
                        <div class="title">Datos Personales:</div>
                        <input type="text" name="name" id="name" class="field" placeholder="Nombre"/>
                        <div class="required">*</div>
                        <input type="text" name="lastname" id="lastname" class="field" placeholder="Apellido"/>
                        <div class="required">*</div>
                        <input type="text" id="telef" name="telef" class="field" placeholder="Teléfono" />
                        <div class="required">*</div>
                        <input type="text" id="email" name="email" class="field" placeholder="E-mail" />
                        <div class="required">*</div>
                        <input type="text" id="address" name="address" class="field" placeholder="Dirección" />
                        <div class="required">*</div>

                        <div class="title">Forma de Pago:</div>
                        <div class="styled-select2">
                           <select name="formapago" id="formapago">
                                <option>Elija entre las opciones</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="cheque">Cheque</option>
                                <option value="paypal">Paypal</option>
                                <option value="prepago y postpago">Pre-pago y Post-pago</option>
                            </select>
                        </div>
                        <div class="required">*</div>
                        <input id="send" name="send" class="btn enviar" type="submit" value="enviar"/>
                        <div class="datos">(*) Datos requeridos</div>
                    </div>    
                    <div class="col2">
                        <div class="title">Seleccione:</div>
                        <div class="styled-select">
                           <select name="eventopart" id="eventopart">
                                <option>Elija el evento a participar</option>
									<?php
										$sql="SELECT * FROM noticias WHERE fechaev>".date("Y-m-d")." ORDER BY fechacons ASC";
										$pedido=mysql_query($sql,$conexion);
										echo(mysql_error());
										if($pedido){
											$filas=mysql_num_rows($pedido);
											if($filas>0){
												while($datos=mysql_fetch_array($pedido)){
													$fechart=$datos['fechacons'];
													$titulo_redes=$datos['titulo'];
													$cuerpo=$datos['cuerpo'];
													$IDnoticiaMenu=$datos['ID'];
													$categoria=$datos['tipo'];
													$imagenportada="admin/".$datos['fotodir'];
													$caducado=$datos['caducado'];
													$fecha=$datos['fechaev'];
													if($fecha>date("Y-m-d")){
														$caducadostr="&caducado=false";
													}
													else{
														$caducadostr="&caducado=true";
													}
													$enlacearticuloppal="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
													?>
														<option><?php echo($titulo_redes); ?></option>
													<?php
												}
											}
										}
									?>
                            </select>
                        </div>
                        <div class="required2">*</div>
                        <textarea id="motivation" name="motivation" class="area" placeholder="¿Qué te motiva a participar en este evento?"></textarea>
                        <textarea id="themes" name="themes" class="area2" placeholder="¿Qué otros temas te gustaría que tratáramos en futuros eventos?"></textarea>
                    </div>
                    <?php
                    $botonform=$_POST['send'];
					if($botonform){
						$aenviar='psicorisascanada@gmail.com';
						//$toenviar='psicorisascanada@gmail.com';
						$toenviar='avasquez@xumbadevenezuela.com';
						$comentario=utf8_encode("NOMBRE: ".$_POST['name']."<br><br>APELLIDO: ".$_POST['lastname']."<br><br>TELEFONO: \n".$_POST['telef']."<br><br>EMAIL: ".$_POST['email']."<br><br>DIRECCI&Oacute;N: <br><br>".$_POST['address']."<br><br>FORMA DE PAGO: <br><br>".$_POST['formapago']."<br><br>EVENTO A PARTICIPAR: <br><br>".$_POST['eventopart']."<br><br>QUE LO MOTIVA A PARTICIPAR: <br><br>".$_POST['motivation']."<br><br>TEMAS QUE LE GUSTARIAN TRATARAN EN OTRO EVENTO: <br><br>".$_POST['themes']."<br><br><br>PSICORISAS.COM");
						$cabeceras = "MIME-Version: 1.0\r\n";
						$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$cabeceras .= "From: ".$aenviar."\r\n"."Reply-To: ".$aenviar."\r\n" .'X-Mailer: PHP/' . phpversion();
						$asunto="CONTACTO PAGINA PSICORISAS.COM";
						mail($toenviar,$asunto,$comentario,$cabeceras);
						$toenviar='inscripciones@psicorisas.com';
						mail($toenviar,$asunto,$comentario,$cabeceras);
						echo("the message has been sent");
					}
                    ?>
                </form>
            </div>
            
        </div>
        <div class="col2">
            <div class="asa3">
                <div class="mail2"></div>
                <div class="text">Para mayor información envía un correo a:<br/><span class="destacado">psicorisascanada@gmail.com</span>
                </div>
                <div class="cel2"></div>
                <div class="text">O comunícate directamente al :<br/><span class="destacado">403-990-69-52</span></div>
            </div>
        </div>
    </div>
    </div>
		<?php
		}
else{
		////////////////////////
		//CUANDO ESTA CADUCADO
		?>
       <div class="content_detalle">
        <div class="events">
            <div class="col1">

                <div class="content_detail_event" id="#">
                    <div class="detail_event">
                        <div class="date">
                            <span class="day"><?php echo(getDiaSem($fecha)); ?>, <span/>
	                        <span class="number"> <?php echo(getDiaFecha($fecha)); ?> </span>
	                        <span class="month"><?php echo(getMesFecha($fecha)); ?></span>
	                        <span class="year">DE <?php echo(getAnioFecha($fecha)); ?></span>
                        </div>
                         <div class="title">
                         	<?php echo($titulo); ?>
                         </div>
                        <div class="category"><?php echo($tipo); ?></div>
                        <div class="cover_img" onclick="<?php echo("location.href='".$enlacearticulosql."';"); ?>" style="cursor: pointer;">
                            <img src="<?php echo($dirimagen); ?>" border="0"/>
                        </div>
                        <?php getRedesButtons($conexion); ?>
                        <div class="accion_area">
                            <div class="btn caducado">caducado
                            </div>
                        </div>

                        <div class="description">
							<?php echo($cuerpo); ?>
                        </div>
                        
                    </div>
                    <div class="flap" id="cost">
                    	<?php echo($precio); ?>
                    </div>
                     <div class="flap" id="duration">
                     	<?php echo($duracion); ?>
                     </div>
                </div>
                <div class="nav_">
			       			<?php
			       				$idnoticia=$_GET['iddetalle'];
								$sqlsid="SELECT * FROM noticias WHERE fechaev<'$fechaeventocons' ORDER BY fechaev DESC LIMIT 1";
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
										$caducado=$datasid['caducado'];
										$fecha=$datasid['fechaev'];
										if($fecha>date("Y-m-d")){
											$caducadostr="&caducado=false";
										}
										else{
											$caducadostr="&caducado=true";
										}
										$enlacearticuloante="?getdetalle=true&iddetalle=".$IDante.$caducadostr;
										?>
											<div class="prev" onclick="<?php echo("location.href='".$enlacearticuloante."';")?>"></div>
										<?php
									}
								}
								
								$sqlsid2="SELECT * FROM noticias WHERE fechaev>'$fechaeventocons' LIMIT 1";
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
										$caducado2=$datasid2['caducado'];
										$fecha=$datasid2['fechaev'];
										if($fecha>date("Y-m-d")){
											$caducadostr2="&caducado=false";
										}
										else{
											$caducadostr2="&caducado=true";
										}
										$enlacearticuloprox="?getdetalle=true&iddetalle=".$IDnext.$caducadostr2;
										?>
				                 			<div class="next" onclick="<?php echo("location.href='".$enlacearticuloprox."';")?>"></div>
										<?php
									}
								}
			       			?>
                </div>
                <div class="title2">Algunos Momentos</div>
            </div>

            <div class="col2">
                <div class="content_calendar">
                    <h1 class="white">Calendario por mes</h1>
                    <div class="per_month">
                        <ul class="list">
                        	<?php
	                        	$u=0;
								$o=0;
								$sqlbuscar="SELECT * FROM noticias GROUP BY MONTH(fechaev) ORDER BY MONTH(fechaev) ASC, DAY(fechaev) ASC";
								$query=mysql_query($sqlbuscar,$conexion);
								if($query){
									$filas=mysql_num_rows($query);
									if($filas>0){
										while($datanot=mysql_fetch_array($query)){
											$nom1="clkmesuno".$u;
											$nom2="calmesuno1".$o;
											if($u==0){
												$stylebox="display:inline-block;";
											}
											else{
												$stylebox="display:none;";
											}
											$fechart=$datanot['fechacons'];
											$titulo_redes=$datanot['titulo'];
											$cuerpo=$datanot['cuerpo'];
											$IDnoticiaMenu=$datanot['ID'];
											$categoria=$datanot['tipo'];
											$imagenportada="admin/".$datanot['fotodir'];
											$caducado=$datanot['caducado'];
											$fecha=$datanot['fechaev'];
											if($fecha>date("Y-m-d")){
												$caducadostr="&caducado=false";
											}
											else{
												$caducadostr="&caducado=true";
											}
											$enlacearticuloppal="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
											?>
											<script type="text/javascript">
											    $(document).ready(function(){
													  $(<?php echo($nom1); ?>).click(function(e){
													  		//e.preventDefault();
													  		$(".name_events").slideUp(420);
													  		$(this).next('ul').slideToggle('fast');
													  });
											    });
											</script>
					                            <li id="<?php echo($nom1); ?>" class="months"><?php echo(getMesFechaNumStr($datanot['fechaev'])." ".getAnioFecha($datanot['fechaev'])); ?></li>
					                            <ul id="<?php echo($nom2); ?>" class="name_events" style="<?php echo($stylebox); ?>">
													<?php
														$sqlbuscar2="SELECT * FROM noticias WHERE MONTH(fechaev)='".getMesFechaNum($datanot['fechaev'])."' AND  YEAR(fechaev)='".getAnioFecha($datanot['fechaev'])."' ORDER BY fechaev DESC";
														$query2=mysql_query($sqlbuscar2,$conexion);
														if($query2){
															$filas=mysql_num_rows($query2);
															if($filas>0){
																while($datos=mysql_fetch_array($query2)){
																	?>
										                                <li class="sub" onclick="<?php echo("location.href='".$enlacearticuloppal."';"); ?>"><?php echo($datos['titulo']); ?></li>
										                                <li class="line"></li>
																	<?php
																}
															}
															else{
																	?>
										                                <li class="sub">No se encuentran resultados</li>
										                                <li class="line"></li>
																	<?php
															}
														}
													?>
					                            </ul>
											<?php
											$u++;
											$o++;
										}
									}
								}
                        	?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow2"></div>
        <div class="shadow"></div>
    </div>

    <div class="content_below" id="#">
        <div class="col1">
            
            <div class="photos">
                <?php echo($detalles); ?>
            </div>
        </div>
        <div class="col2">
            <div class="asa3">
                <div class="mail2"></div>
                <div class="text">Para mayor información envía un correo a:<br/><span class="destacado">psicorisascanada@gmail.com</span>
                </div>
                <div class="cel2"></div>
                <div class="text">O comunícate directamente al :<br/><span class="destacado">403-990-69-52</span></div>
            </div>
        </div>
    </div>  
</div>
		<?php
		}
	}
}

if($_GET['getdetalle']!="true"){
	if($_GET['iddetalle']=="" && $_GET['programacion']!='true'){
?>
    <div class="content">
        <div class="content_slide">
           <div class="slide_show">
				<?php
					$sql="SELECT * FROM banner ORDER BY ID ASC LIMIT 5";
					$pedido=mysql_query($sql,$conexion);
					echo(mysql_error());
					if($pedido){
						$filas=mysql_num_rows($pedido);
						if($filas>0){
							$x=1;
							while($datos=mysql_fetch_array($pedido)){
								$imagenportada="admin/".$datos['imgbanner'];
								$nombreslide="s".$x;
								$tipodbanner=$datos['objeto'];
								if($tipodbanner=="IMAGEN"){
									?>
						                <div id="<?php echo($nombreslide); ?>" class="slide">
						                    <img src="<?php echo($imagenportada); ?>" border="0"/>
						                </div>
									<?php
								}
								elseif($tipodbanner=="VIDEO YOUTUBE"){
									$linkyoutube="http://www.youtube.com/embed/".$datos['enlace'];
									?>
						                <div id="<?php echo($nombreslide); ?>" class="slide">
											<iframe width="857" height="302" src="<?php echo($linkyoutube); ?>" frameborder="0"></iframe>
						                </div>
									<?php
								}
								$x++;
							}
						}
					}
				?>
            </div>
            <div class="nav_slide">
                <ul class="slide_list"></ul>
            </div>
            <div id="caption_cont" style="background: none;">
				<?php
					$sql="SELECT * FROM banner ORDER BY ID ASC LIMIT 5";
					$pedido=mysql_query($sql,$conexion);
					echo(mysql_error());
					if($pedido){
						$filas=mysql_num_rows($pedido);
						if($filas>0){
							$x=1;
							while($datos=mysql_fetch_array($pedido)){
								?>
					                <div class="caption">
						                <div class="title"> <?php echo($datos['textosup']); ?> 
						                </div>
						                <div class="text"> <?php echo($datos['textoinf']); ?> 
						                </div>
						            </div>
								<?php
								$x++;
							}
						}
					}
				?>
            </div>
        </div>
   
        <div class="title2">• • Eventos Recientes • •
        </div>
    </div>

    <div class="content_events_home">
        <div class="events">


        <!-- primer evento-->
		<?php
		$x=0;
		$sqldes="SELECT * FROM noticias WHERE fechaev>'".date("Y-m-d")."'  ORDER BY MONTH(fechaev) ASC, DAY(fechaev) ASC LIMIT 3";
		$pedido=mysql_query($sqldes,$conexion);
		if($pedido){
			$filas=mysql_num_rows($pedido);
			if($filas>0){
				while($datos=mysql_fetch_array($pedido)){
					$caducado=$datos['caducado'];
					$fecha=$datos['fechaev'];
					if($fecha>date("Y-m-d")){
						$caducadostr="&caducado=false";
					}
					else{
						$caducadostr="&caducado=true";
					}
					$IDnoticiaMenu=$datos['ID'];
					
					$enlacearticulosql="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
					$imagendir="admin/".$datos['fotodir'];
					if($x==3){
						$x=0;
						?>
							<div class="sep"></div>
						<?php
					}
					else{
						?>
				            <div class="content_prev_event" id="#">
				                <div class="prev_event">
				                    <div class="date">
				                        <span class="day"><?php echo(getDiaSem($datos['fechaev'])); ?>, <span/>
				                        <span class="number"> <?php echo(getDiaFecha($datos['fechaev'])); ?> </span>
				                        <span class="month"><?php echo(getMesFecha($datos['fechaev'])); ?></span>
				                        <span class="year">DE <?php echo(getAnioFecha($datos['fechaev'])); ?></span>
				                    </div>
				                    <div class="category home"><?php echo($datos['tipo']); ?></div>
				                    <div class="cover_img" onclick="<?php echo("location.href='".$enlacearticulosql."';"); ?>" style="cursor: pointer;">
				                        <img src="<?php echo($imagendir); ?>" border="0"/>
				                    </div>
				                    <div class="title"><?php echo($datos['titulo']); ?>
				                    </div>
				                    <div class="description">
				                    	<?php echo($datos['cuerpo']); ?>
				                    </div>
				                    <?php
									$fecha=$datos['fechaev'];
									if($fecha>date("Y-m-d")){
										$caducadostr="&caducado=false";
									}
									else{
										$caducadostr="&caducado=true";
									}
				                    
				                    if($datos['caducado']=="true"){
				                    	?>
				                    		<div class="more" onclick="<?php echo("location.href='?getdetalle=true&iddetalle=".$datos['ID'].$caducadostr."';"); ?>">ver mas</div>
				                    	<?php
				                    }
									else{
				                    	?>
				                    		<div class="more" onclick="<?php echo("location.href='?getdetalle=true&iddetalle=".$datos['ID'].$caducadostr."';"); ?>">ver mas</div>
				                    	<?php										
									}
				                    
				                    ?>
				                </div>
				                <div class="flap" id="cost"><?php echo($datos['precio']); ?>
				                </div>
				                 <div class="flap" id="duration">
				                 	<?php echo($datos['duracion']); ?>
				                 </div>
				            </div>
						<?php
						$x++;
					}
				}
			}
		}
		
		?>
        <!-- fin evento-->
        </div>
        <div class="asa">
            <div class="text">¿Te gustó?</div>
            <div class="title2 clikable" onclick="location.href='?programacion=true';">Psico Risas en Acción</div>
        </div>
        <div class="shadow"></div>
    </div>
    <div class="content_below">
        <div class="content_contact">
            <h1 class="naranja">Comunícate con nosotros para poder orientarte, pregunta por María Carolina:</h1>
            <div class="contact_icons">
                <div class="icon cel"></div>
                <div class="icon mail"></div>
                <div class="icon fb"></div>
                <div class="icon tw"></div>
            </div>
            <div class="text">
                403-990-69-52 <br/> psicorisascanada@gmail.com <br/> Psico Risas <br/> @PsicoRisas <br/>
            </div>
        </div>

        <div class="tw_area">
            <a class="twitter-timeline"  href="https://twitter.com/PsicoRisas"  data-widget-id="410866077392846848">Tweets by @PsicoRisas</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
        <div class="cloud" onclick="location.href='?idweb=contacto'">
            <div class="content_cloud">
                <h2 class="azul">¿Te gustaría pertenecer <br/>al club PsicoRisas?</h2>
                <div class="text">Descubre los beneficios aquí</div>
            </div>
        </div>
    </div>
    <?php
	    }
	}
    ?>
    	<div class="footer">
			<?php
				getfooter();
			?>
        </div>
    </div>
    <?php
		}
		else{
			?>
    <div class="yellow">
    </div>
	<?php
		getMenu();
	?>
    <div class="content">
        <div class="title3">• • Nuestro Calendario de Eventos • •
        </div>
    </div>
    <div class="content_completo">
        <div class="events">

        <!-- primer evento-->
		<?php
		$x=0;
		$sqldes="SELECT * FROM noticias WHERE YEAR(fechaev)='".date("Y")."' ORDER BY MONTH(fechaev) ASC, DAY(fechaev) ASC";
		$pedido=mysql_query($sqldes,$conexion);
		if($pedido){
			$filas=mysql_num_rows($pedido);
			if($filas>0){
				while($datos=mysql_fetch_array($pedido)){
					//echo($x);
					//echo($x);
					$IDnoticiaMenu=$datos['ID'];
					$fecha=$datos['fechaev'];
					if($fecha>date("Y-m-d")){
						$caducadostr="&caducado=false";
					}
					else{
						$caducadostr="&caducado=true";
					}
					$enlacearticulosql="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
					$imagendir="admin/".$datos['fotodir'];
					if($x==3){
						?>
							<div class="sep"></div>
				            <div class="content_prev_event" id="#">
				                <div class="prev_event">
				                    <div class="date">
				                        <span class="day"><?php echo(getDiaSem($datos['fechaev'])); ?>, <span/>
				                        <span class="number"> <?php echo(getDiaFecha($datos['fechaev'])); ?> </span>
				                        <span class="month"><?php echo(getMesFecha($datos['fechaev'])); ?></span>
				                        <span class="year">DE <?php echo(getAnioFecha($datos['fechaev'])); ?></span>
				                    </div>
				                    <div class="category home"><?php echo($datos['tipo']); ?></div>
				                    <div class="cover_img" onclick="<?php echo("location.href='".$enlacearticulosql."';"); ?>" style="cursor: pointer;">
				                        <img src="<?php echo($imagendir); ?>" border="0"/>
				                    </div>
				                    <div class="title"><?php echo($datos['titulo']); ?>
				                    </div>
				                    <div class="description">
				                    	<?php echo($datos['cuerpo']); ?>
				                    </div>
				                   	<?php
									$fecha=$datos['fechaev'];
									if($fecha>date("Y-m-d")){
										$caducadostr="&caducado=false";
									}
									else{
										$caducadostr="&caducado=true";
									}
				                    ?>
				                    	<div class="more" onclick="<?php echo("location.href='?getdetalle=true&iddetalle=".$datos['ID'].$caducadostr."';"); ?>">ver mas</div>
				                </div>
				                <div class="flap" id="cost"><?php echo($datos['precio']); ?>
				                </div>
				                 <div class="flap" id="duration">
				                 	<?php echo($datos['duracion']); ?>
				                 </div>
				            </div>
						<?php
						$x=0;
					}
					else{
						?>
				            <div class="content_prev_event" id="#">
				                <div class="prev_event">
				                    <div class="date">
				                        <span class="day"><?php echo(getDiaSem($datos['fechaev'])); ?>, <span/>
				                        <span class="number"> <?php echo(getDiaFecha($datos['fechaev'])); ?> </span>
				                        <span class="month"><?php echo(getMesFecha($datos['fechaev'])); ?></span>
				                        <span class="year">DE <?php echo(getAnioFecha($datos['fechaev'])); ?></span>
				                    </div>
				                    <div class="category home"><?php echo($datos['tipo']); ?></div>
				                    <div class="cover_img" onclick="<?php echo("location.href='".$enlacearticulosql."';"); ?>" style="cursor: pointer;">
				                        <img src="<?php echo($imagendir); ?>" border="0"/>
				                    </div>
				                    <div class="title"><?php echo($datos['titulo']); ?>
				                    </div>
				                    <div class="description">
				                    	<?php echo($datos['cuerpo']); ?>
				                    </div>
				                    <?php
									$fecha=$datos['fechaev'];
									if($fecha>date("Y-m-d")){
										$caducadostr="&caducado=false";
									}
									else{
										$caducadostr="&caducado=true";
									}
				                    ?>
				                    	<div class="more" onclick="<?php echo("location.href='?getdetalle=true&iddetalle=".$datos['ID'].$caducadostr."';"); ?>">ver mas</div>
				                </div>
				                <div class="flap" id="cost"><?php echo($datos['precio']); ?>
				                </div>
				                 <div class="flap" id="duration">
				                 	<?php echo($datos['duracion']); ?>
				                 </div>
				            </div>
						<?php
					}
					$x++;
				}
			}
		}
		
		?>
        <!-- fin evento-->

        <div class="sep"></div>

            <div class="pagination">
                <div class="content_num">
                    <ul>
			<?php if($_GET['idnoticia']=='' && $_GET['articulosemanal']!='true'){
					//muestro los distintos índices de las páginas, si es que hay varias páginas
					if ($total_paginas>1){
						if($pagina>1){
							?>
								<div class="prev" style="display:inline-block;cursor: pointer;" <?php echo("location.href='index.php?programacion=true&pagina=" . ($pagina-1)."';"); ?>></div>
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
						          echo("<li ".$style."><a href='index.php?programacion=true&mar_id=".$_GET['mar_id']."&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true'>".$pagina."</a></li>");
						       }
						       else{
						       		if($i==$total_paginas){
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo("<li ".$style."><a href='index.php?programacion=true&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."ultima=true' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>");
						       		}
									else {
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li ".$style."><a href='index.php?programacion=true&pagina=" . $i . "&categ=".$_GET['categ']."&idsubcateg=".$_GET['idsubcateg']."&criterio=".$_GET['criterio']."&vista=".$_GET['vista']."&idc=".$_GET['idc']."' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
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
						          echo("<li class='num'><a href='index.php?programacion=true&pagina=" . $i . "&ultima=true'>".$pagina."</a></li>");
						        }
						       else{
						       		if($i==$total_paginas){
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li class='num'><a href='index.php?programacion=true&pagina=".$i."&ultima=true' style='z-index=10000000000000000000000000000000000000000000000000000000;'>" . $i . "</a></li>";
						       		}
									else {
								          //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
								          echo "<li class='num'><a href='index.php?programacion=true&pagina=".$i."' style='z-index=10000000000000000000000000000000000000000000000000000000;'>".$i."</a></li>";
									}
						       }
						    }																
						}
						if($pagina!=$total_paginas){
							?>
								<div class="next" style="display:inline-block;cursor: pointer;" <?php echo("location.href='index.php?programacion=true&pagina=" . ($pagina+1)."';"); ?>></div>
							<?php
						}
					}
			} ?>
                    </ul>
                </div>
            </div>    
        </div>

        <div class="asa2">
            <div class="text">Vive este día con la consciencia de que es Irrepetible... <br/>Y sonríe!</div>
            <div class="star"></div>
        </div>
        <div class="shadow2"></div>
        <div class="shadow"></div>
    </div>

    <div class="content_below">
    </div>

    <div class="footer">
			<?php
				getfooter();
			?>
    </div>
			<?php
		}
    ?>
</body>
</html>