<script language="JavaScript" type="text/javascript">
	function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
	}
</script>
<div class="titulobar"></div>
<div class="modulobar" style="margin-left: 30px;">
	<form method="POST" enctype="multipart/form-data">
	<?php
	/*
	 * 
	 * 
	 <iframe width="560" height="315" src="//www.youtube.com/embed/n9qU9kVc6jM" frameborder="0" allowfullscreen></iframe>
	 * */
		//error_reporting(E_ERROR);
			$option=$_GET['opcion'];
			$btn=$_POST['btnprocesar2'];
			if(!$btn){
				$sqlsel="SELECT * FROM banner WHERE ID='".$_GET['idbanner']."'";
				$pedidsel=mysql_query($sqlsel,$conexion);
				if($pedidsel){
					$filassel=mysql_num_rows($pedidsel);
					if($filassel>0){
						$datosconsulta=mysql_fetch_array($pedidsel);
						$seccioncons=$datosconsulta['seccion'];
						$tipobannercons=$datosconsulta['tipobanner'];
						$patrocinantecons=$datosconsulta['patrocinante'];
						$objetocons=$datosconsulta['objeto'];
						$inferiorcons=$datosconsulta['textoinf'];
						$superiorcons=$datosconsulta['textosup'];
					}
				}
			}
			if($btn){
				if($option=="banners"){
					$tipobanner=$_POST['tipoban'];
					$seccionpagina=$_POST['seccionpag'];
					$patrocinante=$_POST['patrocinantetxt'];
					$superior=$_POST['textosup'];
					$inferior=$_POST['textoinf'];
					//$noticia=str_replace("p>", "",$noticia);
					$tiponot=$_POST['tiponota'];
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					//Tipo de objeto, si flash o imagen
					$objeto=$_POST['tipobjeto'];
					$enlacebanners=$_POST['enlacebanner'];
					
					if($_GET['subopcion']=="agregar"){
						$sqlog="SELECT * FROM banner";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$foto=$logo;
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
							$sql2="INSERT INTO banner(seccion,tipobanner,patrocinante,imgbanner,objeto,enlace,textosup,textoinf) VALUES('$seccionpagina','$tipobanner','$patrocinante','$destino','$objeto','$enlacebanners','$superior','$inferior')";
							//PEDIDO CONSULTA
							$pedidos=mysql_query($sql2,$conexion);
							//echo(mysql_error());
							if($pedidos){
					            $status = "Archivo subido: <b>".$archivo."</b>";
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
					if($_GET['subopcion']=="modificar"){
						$sqlog="SELECT * FROM banner WHERE ID='".$_GET['idbanner']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								//MODIFICACION
								if($seccionpagina!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET seccion='$seccionpagina' WHERE ID='".$_GET['idbanner']."'";
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
								if($tipobanner!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET tipobanner='$tipobanner' WHERE ID='".$_GET['idbanner']."'";
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
								
								if($enlacebanners!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET enlace='$enlacebanners' WHERE ID='".$_GET['idbanner']."'";
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
								
								if($objeto!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET objeto='$objeto' WHERE ID='".$_GET['idbanner']."'";
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
								
								if($superior!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET textosup='$superior' WHERE ID='".$_GET['idbanner']."'";
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
								
								if($inferior!=''){
									//MODIFICACION
									$sql2="UPDATE banner SET textoinf='$inferior' WHERE ID='".$_GET['idbanner']."'";
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
								if($archivo!=''){
									echo("HOLAAAAAAAAAAAAAAAAAAAA");
								    // obtenemos los datos del archivo
							    	$prefijo = substr(md5(uniqid(rand())),0,6);
							        // guardamos el archivo a la carpeta files
							        $destino =  "img/".$prefijo."_".$archivo;
									move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
									//MODIFICACION
									$sql2="UPDATE banner SET imgbanner='$destino' WHERE ID='".$_GET['idbanner']."'";
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
							}
						}
					}
					if($_GET['subopcion']=="eliminar"){
						$sqlog="SELECT * FROM banner WHERE ID='".$_GET['idbanner']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$sqlog="DELETE FROM banner WHERE ID='".$_GET['idbanner']."'";
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
						if($_GET['opcion']=='descargas'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=banners"); ?>"><h1>BANNERS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=banners"); ?>"><h1>BANNERS</h1></a>
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=agregar"); ?>">Agregar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar"); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=eliminar"); ?>">Eliminar</a>
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
				<tr>
					<td>
						Identificador
					</td>
				</tr>
				<tr>
					<td>
						<?php
							if($_GET['subopcion']=="agregar" || $_GET['subopcion']==""){
								?>
									<INPUT name="patrocinantetxt" id="patrocinantetxt" type="text">
								<?php
							}
							else{
								?>
								<SELECT name="patrocinantetxt" id="patrocinantetxt" onchange="abreSitio('patrocinantetxt');">
										<OPTION>FAVOR SELECCIONAR BANNER</OPTION>
										<?php
											$sqlsel="SELECT * FROM banner ORDER BY ID DESC";
											$pedidosel=mysql_query($sqlsel,$conexion);
											if($pedidosel){
												$filassel=mysql_num_rows($pedidosel);
												if($filassel>0){
													while($datserv=mysql_fetch_array($pedidosel)){
														$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
														$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
														$nombretmp=$datserv['patrocinante'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idbanner']){
															echo("<OPTION SELECTED value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
													}
												}
												else{
													echo("<OPTION>NO HAY PATROCINANTES AGREGADOS</OPTION>");
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
						Ubicaci&oacute;n P&aacute;gina
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="seccionpag" id="seccionpag">
							<OPTION <?php if($seccioncons=='HOME'){ echo("SELECTED"); } ?> >HOME</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Tipo de Objeto
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="tipobjeto" id="tipobjeto">
							<OPTION <?php if($objetocons=='IMAGEN'){ echo("SELECTED"); } ?> >IMAGEN</OPTION>
							<OPTION <?php if($objetocons=='VIDEO YOUTUBE'){ echo("SELECTED"); } ?> >VIDEO YOUTUBE</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Ubicaci&oacute;n Banner
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="tipoban" id="tipoban">
							<OPTION <?php if($tipobannercons=='HEADER'){ echo("SELECTED"); } ?>  value="HEADER">HEADER</OPTION>
						</SELECT>
					</td>
				</tr>
<?php
			if(!$btn){
				$sqlsel2="SELECT * FROM banner WHERE ID='".$_GET['idbanner']."'";
				$pedidsel2=mysql_query($sqlsel2,$conexion);
				if($pedidsel2){
					$filassel2=mysql_num_rows($pedidsel2);
					if($filassel2>0){
						$datosconsulta2=mysql_fetch_array($pedidsel2);
						$enlacecons=$datosconsulta2['enlace'];
					}
				}
			}
?>
				<tr>
					<td>
						Enlace
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="enlacebanner" id="enlacebanner" type="text" value="<?php echo($enlacecons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Archivo Objeto
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="imgicono" id="imgicono" type="file">
					</td>
				</tr>
				<tr>
					<td>
						Texto superior
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="textosup" id="textosup" type="text" value="<?php echo($superiorcons); ?>">
					</td>
				</tr>
<tr>
					<td>
						Texto inferior
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="textoinf" id="textoinf" type="text" value="<?php echo($inferiorcons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="btnprocesar2" id="btnprocesar2" type="submit" value="Procesar" class="btn btn-info">
					</td>
				</tr>
		</table>
		</form>
</div>
