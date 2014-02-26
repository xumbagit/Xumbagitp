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
			if($btn){
				if($option=="descargas"){
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					$enlaceimagen=$_POST['nombreenlace'];
					$sqlog="SELECT * FROM descargas WHERE ID='".$_GET['IDX']."' AND tipo='DESCARGA'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$datael=mysql_fetch_array($pedidolog);
							if($archivo!=''){
								echo("SI HAY IMAGEN");
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
						        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)){
									$sqlog="UPDATE descargas SET url='$destino' WHERE ID='".$_GET['IDX']."'";
									$pedidolog=mysql_query($sqlog,$conexion);
									if($pedidolog){
										echo("Se han modificado la imagen con exito");
									}
								}
							}
							
							if($enlaceimagen!=''){
								echo("SI HAY ENLACE");
								$sqlog="UPDATE descargas SET urld='$enlaceimagen' WHERE ID='".$_GET['IDX']."'";
								$pedidolog=mysql_query($sqlog,$conexion);
								if($pedidolog){
									echo("Se han modificado la imagen con exito");
								}
							}
							
							if($_GET['subopcion']=='eliminar'){
								$sqlog="DELETE FROM descargas WHERE ID='".$_GET['IDX']."'";
								$pedidolog=mysql_query($sqlog,$conexion);
								if($pedidolog){
									$urlarchivo="admin/".$datael['url'];
									unlink($urlarchivo);
								}
							}
						}
						else{
							if($archivo!=''){
								echo("SI HAY IMAGEN");
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
						        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)){
									$sqlog="INSERT INTO descargas(url,urld,tipo) VALUES('$destino','$enlaceimagen','DESCARGA')";
									$pedidolog=mysql_query($sqlog,$conexion);
									if($pedidolog){
										echo("Se han agregado la imagen con exito");
									}
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=descargas&entrar=".$_GET['entrar']); ?>"><h1>DESCARGAS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=descargas&entrar=".$_GET['entrar']); ?>"><h1>DESCARGAS</h1></a>
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
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=modificar&entrar=".$_GET['entrar']); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&subopcion=eliminar&entrar=".$_GET['entrar']); ?>">Eliminar</a>
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
						echo("Seleccionar Archivo");
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
						<SELECT name="nombreenlace" id="nombreenlace" onchange="abreSitio('nombre');">
								<OPTION>[seleccione noticia]</OPTION>
						<?php
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="descargas";
						}
						if($opciontabla=="descargas"){
							$tabladef="descargas";
							$campomos="urld";
						}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($datserv['ID']==$_GET['IDX']){
											echo("<OPTION SELECTED value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
										}
										else{
											echo("<OPTION value=\"?&mod=adminnoticias&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
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
							$opciontabla="descargas";
						}
						if($opciontabla=="descargas"){
							$tabladef="descargas";
							$campomos="urld";
						}
						?>
						<SELECT name="nombreenlace" id="nombreenlace"  onchange="abreSitio('nombre');">
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
					else{
						?>
							<tr>
								<td>Nombre</td>
							</tr>
							<tr>
								<td>
									<INPUT name="nombreenlace" id="nombreenlace" type="text">
								</td>
							</tr>
						<?php	
					}
					?>
				</td>
			</tr>
				<tr>
					<td>Archivo</td>
				</tr>
				<tr>
					<td>
						<input name="imgicono" id="imgicono" type="file">
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