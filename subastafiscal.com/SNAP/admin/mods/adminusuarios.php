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
				$sqlsel="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
			    //echo $query;
				if($dbn->QuerySQL($sqlsel)==0){
					if($dbn->getFilas()>0){
						/*getData obtiene informacion de la consulta */
						$datosconsulta=$dbn->getData();
						$nombre_cons=$datosconsulta['nombre'];
						$idperfil_cons=$datosconsulta['idperfil'];
					}
				}
			}
			if($btn){
				if($option=="usuarios"){
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
						if($dbn->QuerySQL($sqlog)==0){
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
							$sql2="INSERT INTO usuarios(seccion,tipobanner,patrocinante,imgbanner,objeto,enlace,textosup,textoinf) VALUES('$seccionpagina','$tipobanner','$patrocinante','$destino','$objeto','$enlacebanners','$superior','$inferior')";
							if($dbn->QuerySQL($sql2)==0){
								echo("Se han agregado los datos con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
					if($_GET['subopcion']=="modificar"){
						$sqlog="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								//MODIFICACION
								if($seccionpagina!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET seccion='$seccionpagina' WHERE ID='".$_GET['idusr']."'";
									//PEDIDO CONSULTA
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								if($tipobanner!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET tipobanner='$tipobanner' WHERE ID='".$_GET['idusr']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								
								if($enlacebanners!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET enlace='$enlacebanners' WHERE ID='".$_GET['idusr']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								
								if($objeto!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET objeto='$objeto' WHERE ID='".$_GET['idusr']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								
								if($superior!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET textosup='$superior' WHERE ID='".$_GET['idusr']."'";
									if($dbn->QuerySQL($sql2)==0){
										echo("Se han realizado las modificaciones con exito");
									}
									else{
										echo(mysql_error());
									}	
								}
								
								if($inferior!=''){
									//MODIFICACION
									$sql2="UPDATE usuarios SET textoinf='$inferior' WHERE ID='".$_GET['idusr']."'";
									if($dbn->QuerySQL($sql2)==0){
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
						$sqlog="SELECT * FROM usuarios WHERE ID='".$_GET['idusr']."'";
						if($dbn->QuerySQL($sqlog)==0){
							if($dbn->getFilas()>0){
								$sqlog2="DELETE FROM usuarios WHERE ID='".$_GET['idusr']."'";
								if($dbn->QuerySQL($sqlog2)==0){
									echo("Se han eliminido con exito");
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
						if($_GET['opcion']=='usuarios'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=usuarios"); ?>"><h1>USUARIOS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=usuarios"); ?>"><h1>USUARIOS</h1></a>
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=adjudicar"); ?>">Adjudicar</a>
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
						ID Perfil
					</td>
				</tr>
				<tr>
					<td>
						<?php
							if($_GET['subopcion']=="agregar" || $_GET['subopcion']==""){
								?>
									<INPUT name="usuariotxt" id="usuariotxt" type="text">
								<?php
							}
							else{
								?>
								<SELECT name="usuariotxt" id="usuariotxt" onchange="abreSitio('usuariotxt');">
										<OPTION>FAVOR SELECCIONAR PERFIL</OPTION>
										<?php
											$sqlsel="SELECT * FROM usuarios ORDER BY ID DESC";
											if($dbn->QuerySQL($sqlsel)==0){
												if($dbn->getFilas()>0){
													while($datserv=$dbn->getData()){
														$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
														$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
														$nombretmp=$datserv['nombre'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idusr']){
															echo("<OPTION SELECTED value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idusr=".$datserv['ID']."&idperfil=".$datserv['idperfil']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idusr=".$datserv['ID']."&idperfil=".$datserv['idperfil']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
													}
												}
												else{
													echo("<OPTION>NO HAY USUARIOS AGREGADOS</OPTION>");
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
						Nombre de Usuario
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nombre" id="nombre" type="text" value="<?php echo($nombre_cons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Clave
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="clave" id="clave" type="text">
					</td>
				</tr>
				<tr>
					<td>
						Repita Clave
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="reclave" id="reclave" type="text">
					</td>
				</tr>
				<tr>
					<td>
						Nivel
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="niveltxt" id="niveltxt">
							<OPTION>[Seleccione]</OPTION>
							<?php
								$sqlperf="SELECT * FROM perfiles ORDER BY ID DESC";
								if($dbn->QuerySQL($sqlperf)==0){
									if($dbn->getFilas()>0){
										while($datserv=$dbn->getData()){
											$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
											$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
											$nombretmp=$datserv['nombre'];
											$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
											if($datserv['ID']==$idperfil_cons){
												echo("<OPTION SELECTED value=\"".$datserv['ID']."\">".$nombre."</OPTION>");
											}
											else{
												echo("<OPTION value=\"".$datserv['ID']."\">".$nombre."</OPTION>");
											}
										}
									}
									else{
										echo("<OPTION>NO HAY PERFILES AGREGADOS</OPTION>");
									}
								}
							?>
						</SELECT>
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
