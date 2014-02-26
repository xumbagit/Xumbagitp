
<?php

function esta_duplicado($ID,$conexion){
	$sqlog="SELECT * FROM noticias WHERE codigonot='$ID' AND lang='en'";
	$pedidolog=mysql_query($sqlog,$conexion);
	if($pedidolog){
		$filaslog=mysql_num_rows($pedidolog);
		if($filaslog>0){
			$data=mysql_fetch_array($pedidolog);
			$duplicadoin="en";
		}
		else{
			$duplicadoin="off";
		}
	}
	$sqlog="SELECT * FROM noticias WHERE codigonot='$ID' AND lang='es'";
	$pedidolog=mysql_query($sqlog,$conexion);
	if($pedidolog){
		$filaslog=mysql_num_rows($pedidolog);
		if($filaslog>0){
			$data=mysql_fetch_array($pedidolog);
			$duplicadoes="es";
		}
		else{
			$duplicadoes="off";
		}
	}
	$sqlog="SELECT * FROM noticias WHERE codigonot='$ID' AND lang='fr'";
	$pedidolog=mysql_query($sqlog,$conexion);
	if($pedidolog){
		$filaslog=mysql_num_rows($pedidolog);
		if($filaslog>0){
			$data=mysql_fetch_array($pedidolog);
			$duplicadofr="fr";
		}
		else{
			$duplicadofr="off";
		}
	}
	
	$sid[0]=$duplicadoin;
	$sid[1]=$duplicadoes;
	$sid[2]=$duplicadofr;
	
	return $sid;
}

?>
<script language="JavaScript" type="text/javascript">
	function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
	}
	$(function(){
		$('#etiquetas_1').tagsInput({width:'auto'});
	});
</script>
<div class="titulobar"></div>
<div class="modulobar" style="margin-left: 30px;">
	<form method="POST" enctype="multipart/form-data">
		<?php
		//error_reporting(E_ERROR);
		//nivel,numlocal,nombreloc,descripcion,dirimagen,fecha,disponibilidad,idcategoria,rifclocal,web,telefono,email,twitter,facebook,x,y,r,logo
		$msqlq="";
		if($_GET['IDX']!=''){
			$sqle="SELECT * FROM eventos WHERE ID='".$_GET['IDX']."'";
			$msqlq=mysql_query($sqle,$conexion);
			if($msqlq){
				$mfilas=mysql_num_rows($msqlq);
				if($mfilas>0){
					$datos=mysql_fetch_array($msqlq);
					$titulevento=$datos['nombreev'];
					$lugar=$datos['lugar'];
					$fecha=$datos['fecha'];
					$hora=$datos['autorportada'];
					$costo=$datos['autorarticulo'];
				}
			}
		}
		
		//guardar la fecha en la que se escribio el articulo sin mostrarlo en la pantalla date("Y-m-d"); en campo tipo date
		$btn=$_POST['btnprocesar'];
		$option=$_GET['opcion'];
		$suboption=$_GET['subopcion'];
		if($btn){
			$option="eventos";
			if($option==''){
				echo("DEBE ELEGIR UNA OPCION");
			}
			if($option=="eventos"){
				$nombre=strtoupper($_POST['nombre']);
				$nombreanot=strtoupper($_POST['nombreautor']);
				$nombreaimg=strtoupper($_POST['nombresutorimg']);
				if($nombreanot==''){
					die("Debe ingresar el nombre del autor de la noticia");
				}
				$lugar=$_POST['content'];
				$nombreev=$_POST['etiquetas_1'];
				$fecha=$_POST['nombreautor'];
				$hora=$_POST['nombreautorimg'];
				$costo=$_POST['content'];
				$idioma=$_POST['idiomacmb'];
				$logo=$_FILES["imgicono"]['name'];
				$tamano = $_FILES["imgicono"]['size'];
			    $tipo = $_FILES["imgicono"]['type'];
			    $archivo = $_FILES["imgicono"]['name'];
				$destacado=$_POST['opthome'];
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM noticias WHERE titulo='$nombre'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog==0){
							$datos=mysql_fetch_array($pedidolog);
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
							$sql2="INSERT INTO noticias(titulo,cuerpo,fecha,tipo,fotodir,idioma,fechacons,autorportada,autorarticulo,codigonot,etiquetas,qescribio,destacado) VALUES('$nombre','$noticia','".date("M d, Y")."','$tiponot','$destino','$idioma','".date("Y-m-d")."','$imgautor','$autor','$prefijo','$etiq','".$_SESSION['usuarioreg']."','$destacado')";
							//PEDIDO CONSULTA
							$pedidos=mysql_query($sql2,$conexion);
							echo(mysql_error());
							if($pedidos){
					            $status = "Archivo subido: <b>".$archivo."</b>";
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
				if($_GET['subopcion']=="modificar"){
					$nombre=strtoupper($_POST['nombre']);
					$nombreanot=strtoupper($_POST['nombreautor']);
					$nombreaimg=strtoupper($_POST['nombresutorimg']);
					if($nombreanot==''){
						die("Debe ingresar el nombre del autor de la noticia");
					}
					$etiq=$_POST['etiquetas_1'];
					$descripcion=$_POST['content'];
					$autor=$_POST['nombreautor'];
					$imgautor=$_POST['nombreautorimg'];
					$noticia=$_POST['content'];
					$idioma=$_POST['idiomacmb'];
					//$noticia=str_replace("p>", "",$noticia);
					$tiponot=$_POST['tiponota'];
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					$logof=$_FILES["calendariof"]['name'];
					$tamanof = $_FILES["calendariof"]['size'];
				    $tipof = $_FILES["calendariof"]['type'];
				    $archivof = $_FILES["calendariof"]['name'];
					$destacado=$_POST['opthome'];
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$data=mysql_fetch_array($pedidolog);
							//MODIFICACION
							if($nombre!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET titulo='$nombre' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
								$logo=$_FILES["imgicono"]['name'];
								$tamano = $_FILES["imgicono"]['size'];
							    $tipo = $_FILES["imgicono"]['type'];
							    $archivo = $_FILES["imgicono"]['name'];
								$logof=$_FILES["calendariof"]['name'];
								$tamanof = $_FILES["calendariof"]['size'];
							    $tipof = $_FILES["calendariof"]['type'];
							    $archivof = $_FILES["calendariof"]['name'];
							if($idioma!=''){
								$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
								$pedidonew=mysql_query($sqlog,$conexion);
								if($pedidonew){
									$filasnew=mysql_num_rows($pedidonew);
									if($filasnew>0){
										$datos=mysql_fetch_array($pedidonew);
										$imagendir=$datos['fotodir'];
										if($datos['idioma']!=$idioma){
											$codigonot=$_GET['codigonot'];
											$idiomanew=$_GET['idioma'];
											$sidup=esta_duplicado($codigonot,$conexion);
											$i=0;
											
											while($i!=3){
												if($sidup[$i]==$idioma){
													break;
												}
												else{
													$i++;
												}
											}
											//echo($sidup[$i].$idioma);
											if($sidup[$i]!=$idioma){
											    // obtenemos los datos del archivo
										    	$prefijo = substr(md5(uniqid(rand())),0,6);
										        // guardamos el archivo a la carpeta files
										        $destino =  "img/".$prefijo."_".$archivo;
										        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
												$sql2="INSERT INTO noticias(titulo,cuerpo,fecha,tipo,fotodir,idioma,fechacons,autorportada,autorarticulo,codigonot) VALUES('$nombre','$noticia','".date("M d, Y")."','$tiponot','$imagendir','$idioma','".date("Y-m-d")."','$imgautor','$autor','".$_GET['codigonot']."')";
												//PEDIDO CONSULTA
												$pedidos=mysql_query($sql2,$conexion);
												echo(mysql_error());
												if($pedidos){
										            $status = "Archivo subido: <b>".$archivo."</b>";
													echo("Se han duplicado los datos al idioma seleccionado");
												}
												else{
													echo(mysql_error());
												}
											}
										}
									}
								}
								//MODIFICACION
								/*
								 * 
								 * $sql2="UPDATE noticias SET idioma='$idioma' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}
								 * 
								 * */
							}
							if($destacado!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET destacado='$destacado' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}
							}
							if($descripcion!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET cuerpo='$descripcion' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}
							}
							if($etiquetas!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET etiquetas='$etiq' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($tiponot!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET tipo='$tiponot' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
							        $status = "Archivo subido: <b>".$archivo."</b>";
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($autor!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET autorarticulo='$autor' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							if($imgautor!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET autorportada='$imgautor' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}	
							}
							$logo=$_FILES["imgicono"]['name'];
							$tamano = $_FILES["imgicono"]['size'];
						    $tipo = $_FILES["imgicono"]['type'];
						    $archivo = $_FILES["imgicono"]['name'];
							$logof=$_FILES["calendariof"]['name'];
							$tamanof = $_FILES["calendariof"]['size'];
						    $tipof = $_FILES["calendariof"]['type'];
						    $archivof = $_FILES["calendariof"]['name'];
							if($archivo!=''){
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
						        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
								//MODIFICACION
								$sql2="UPDATE noticias SET fotodir='$destino' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}								
							}

							if($data['codigonot']==''){
								//MODIFICACION
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
								$sql2="UPDATE noticias SET codigonot='$prefijo' WHERE ID='".$_GET['IDX']."'";
								//PEDIDO CONSULTA
								$pedidos=mysql_query($sql2,$conexion);
								echo(mysql_error());
								if($pedidos){
									echo("Se han realizado las modificaciones con exito");
								}
								else{
									echo(mysql_error());
								}								
							}
							
							
						}
					}
				}
				if($_GET['subopcion']=="eliminar"){
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$sqlog="DELETE FROM noticias WHERE ID='".$_GET['IDX']."'";
							$pedidolog=mysql_query($sqlog,$conexion);
							if($pedidolog){
								echo("Se han eliminido con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
			}
		}
		?>
		<table>
			<tr>
				<td>
						<?php
						if($_GET['opcion']=='noticias'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=eventos&entrar=".$_GET['entrar']); ?>"><h1>EVENTOS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=eventos&entrar=".$_GET['entrar']); ?>"><h1>EVENTOS</h1></a>
							<?php							
						}
						?>
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=agregar&entrar=".$_GET['entrar']); ?>">Agregar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=eliminar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Eliminar</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr><td style="height:20px;"></td></tr>
		</table>
		<table>
		<?php
		if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']=='niveles') {
			?>
			<tr>
				<td>
					<?php
						echo("Seleccionar Noticia");
					?>
				</td>
			</tr>
		<?php
		}
		?>
			<tr>
				<td>
					<?php
					if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']=='niveles') {
						?>
						<SELECT name="nombre" id="nombre" onchange="abreSitio('nombre');">
								<OPTION>[seleccione noticia]</OPTION>
						<?php
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="noticias";
						}
						if($opciontabla=="eventos"){
							$tabladef="eventos";
							$campomos="nombreev";
						}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($_GET['option']!='niveles'){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}	
										}
										else{
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
										}
									}
								}
								else{
									echo("<OPTION>NO HAY NOTICIAS AGREGADAS</OPTION>");
								}
							}
						?>
						</SELECT>
						<?php
					}
					elseif(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar') && $_GET['opcion']!='niveles') {
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="eventos";
						}
						if($opciontabla=="eventos"){
							$tabladef="eventos";
							$campomos="nombreev";
						}
						?>
						<SELECT name="nombre" id="nombre"  onchange="abreSitio('nombre');">
							<OPTION>[seleccione noticia]</OPTION>
							<?php
								$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										while($datserv=mysql_fetch_array($pedidosel)){
											if($_GET['option']!='niveles'){
												if($datserv['ID']==$_GET['IDX']){
													echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}	
											}
											else{
												if($datserv['ID']==$_GET['IDX']){
													echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&codigonot=".$datserv['codigonot']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
												}
											}
										}
									}
									else{
										echo("<OPTION>NO HAY NOTICIAS AGREGADAS</OPTION>");
									}
								}
							?>
						</SELECT>
						<?php
					}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo("Nombre del Evento");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombre" id="nombre" type="text" style="border:1px solid black;width:333px;" value="<?php echo($titulnoticia); ?>">
				</td>
			</tr>
				<tr>
					<td>
						<?php
							echo("Imagen Portada");
						?>
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="imgicono" id="imgicono" type="file" style="border:1px solid black;width:333px;">
					</td>
				</tr>
			<tr>
				<td>
					<?php
						echo("Autor de la imagen");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombreautorimg" id="nombreautorimg" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($portadart); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Categor&iacute;a
					</td>
				</tr>
				<tr>
					<td>
<?php
								$sqlsel="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										$datserv=mysql_fetch_array($pedidosel);
										$tiponota=$datserv['tipo'];
									}
								}
							?>
						<SELECT name="tiponota" id="tiponota">
							<OPTION <?php if($tiponota=="FISCAL"){ echo("SELECTED"); } ?> value="FISCAL">FISCAL</OPTION>
							<OPTION <?php if($tiponota=="LABORAL"){ echo("SELECTED"); } ?> value="LABORAL">LABORAL</OPTION>
							<OPTION <?php if($tiponota=="TRIBUTARIA"){ echo("SELECTED"); } ?> value="TRIBUTARIA">TRIBUTARIA</OPTION>
							<OPTION <?php if($tiponota=="OUTSOURCING.CONTABLE"){ echo("SELECTED"); } ?> value="OUTSOURCING.CONTABLE">OUTSOURCING CONTABLE</OPTION>
							<OPTION <?php if($tiponota=="ALERTAS.FISCALES"){ echo("SELECTED"); } ?> value="ALERTAS.FISCALES">ALERTAS FISCALES</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Idioma
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="idiomacmb" id="idiomacmb">
							<OPTION <?php if($idiomatxt=="es"){ echo("SELECTED"); } ?> value="es" >ESPA&Ntilde;OL</OPTION>
						</SELECT>
					</td>
				</tr>
			<tr>
				<td>
					<?php
						echo("Autor de la noticia");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombreautor" id="nombreautor" type="text" style="border:1px solid black;width:333px;" value="<?php echo($articuloaut); ?>">
				</td>
			</tr>
				<tr>
					<td>
						Texto de la Noticia
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="content" id="content" style="width:100%;display:block;"><?php
								echo($cuerponoticia);
							?></textarea>
						<!-- CKEditor -->
						<script type="text/javascript">
							CKEDITOR.replace( 'content' );	
						</script>
					</td>
				</tr>
				<tr>
					<td>
						Etiquetas del tema
					</td>
				</tr>
				<tr>
					<td>
						<input name="etiquetas_1" id="etiquetas_1" type="text" value="<?php echo($etiquetas); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Destacado
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="opthome" id="opthome">
							<?php
							if($sihome!=''){
								if($destacado=="SI"){
									?>
										<OPTION SELECTED>SI</OPTION>
										<OPTION>NO</OPTION>
									<?php
								}
								else{
									?>
										<OPTION SELECTED>NO</OPTION>
										<OPTION>SI</OPTION>
									<?php										
								}	
							}
							else{
									?>
										<OPTION>NO</OPTION>
										<OPTION>SI</OPTION>
									<?php													
							}
							?>
						</SELECT>
					</td>
				</tr>
		</table>
		<table>
			<tr>
				<td>
					<input id="btnprocesar" name="btnprocesar" type="submit" class="btn btn-large btn-primary" value="Procesar"></input>
				</td>
			</tr>
		</table>
	</form>
</div>