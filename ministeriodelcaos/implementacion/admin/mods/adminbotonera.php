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
			$msqlq="";
			$option=$_GET['opcion'];
			$btn=$_POST['btnprocesar'];
			$nmbotonc=$_POST['nmboton'];
			if($btn){
				if($option=="botonera"){
					$nombre=strtoupper($_POST['nombre']);
					$descripcion=$_POST['elm1'];
					$noticia=$_POST['elm1'];

					if($_GET['subopcion']=="agregar"){
						$sqlog="SELECT * FROM banner WHERE tipobanner='$tipobanner'";
						$pedidolog=mysql_query($sqlog,$conexion);
						echo(mysql_error());
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								$datos=mysql_fetch_array($pedidolog);
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
								$sql2="INSERT INTO botonera(seccion,tipobanner,patrocinante,imgbanner,objeto,enlace) VALUES('$seccionpagina','$tipobanner','$patrocinante','$destino','$objeto','$enlacebanners')";
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
						$sqlog="SELECT * FROM botonera WHERE ID='".$_GET['idbanner']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								//MODIFICACION
								if($nmbotonc!=''){
									//MODIFICACION
									$sql2="UPDATE botonera SET valboton='$nmbotonc' WHERE ID='".$_GET['idbanner']."'";
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
							else{
								echo("ERROR, no hay datos en la tabla.");
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
						if($_GET['opcion']=='botonera'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=botonera&entrar=".$_GET['entrar']); ?>"><h1>BOTONERA</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=botonera&entrar=".$_GET['entrar']); ?>"><h1>BOTONERA</h1></a>
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar&entrar=".$_GET['entrar']); ?>">Modificar</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr><td style="height:20px;"></td></tr>
		</table>
		<?php
				$sqlsel="SELECT * FROM botonera WHERE ID='".$_GET['idbanner']."'";
				$pedidosel=mysql_query($sqlsel,$conexion);
				if($pedidosel){
					$filassel=mysql_num_rows($pedidosel);
					if($filassel>0){
						$datserv=mysql_fetch_array($pedidosel);
						$nmbotonc=$datserv['valboton'];
					}
					else{
						$enlace='http://';
					}
				}
				
				?>
				<table>
				<tr>
					<td>
						Bot&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="patrocinantetxt" id="patrocinantetxt" onchange="abreSitio('patrocinantetxt');">
								<OPTION>[seleccione]</OPTION>
								<?php
									$sqlsel="SELECT * FROM botonera ORDER BY ID ASC";
									$pedidosel=mysql_query($sqlsel,$conexion);
									if($pedidosel){
										$filassel=mysql_num_rows($pedidosel);
										if($filassel>0){
											while($datserv=mysql_fetch_array($pedidosel)){
												$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
												$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
												$nombretmp=$datserv['idboton'];
												$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
												if($datserv['ID']==$_GET['idbanner']){
													echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
												}
												else{
													echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
												}
											}
										}
										else{
											echo("<OPTION>NO HAY BOTONES AGREGADOS</OPTION>");
										}
									}
								?>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Nombre del bot&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nmboton" id="nmboton" type="text" value="<?php echo($nmbotonc); ?>">
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="btnprocesar" id="btnprocesar" type="submit" value="Procesar" class="btn btn-info">
					</td>
				</tr>
		</table>
	</form>
</div>