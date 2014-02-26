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
			$sqle="SELECT * FROM contactos WHERE ID='".$_GET['IDX']."'";
			$msqlq=mysql_query($sqle,$conexion);
			if($msqlq){
				$mfilas=mysql_num_rows($msqlq);
				if($mfilas>0){
					$datos=mysql_fetch_array($msqlq);
					$nombrecontacto=$datos['nombre'];
					$datocontacto=$datos['datcont'];
					$cuerponoticia=$datos['descrip'];
				}
			}
		}
		
		//guardar la fecha en la que se escribio el articulo sin mostrarlo en la pantalla date("Y-m-d"); en campo tipo date
		$btn=$_POST['btnprocesar'];
		$option=$_GET['opcion'];
		$suboption=$_GET['subopcion'];
		if($btn){
			$option="noticias";
			if($option==''){
				echo("DEBE ELEGIR UNA OPCION");
			}
			if($option=="noticias"){
				$nombre=strtoupper($_POST['nombre']);
				$datocontacto=$_POST['datocontacto'];
				$descripcion=$_POST['content'];
				$logo=$_FILES["imgicono"]['name'];
				$tamano = $_FILES["imgicono"]['size'];
			    $tipo = $_FILES["imgicono"]['type'];
			    $archivo = $_FILES["imgicono"]['name'];
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM noticias WHERE titulo='$nombre'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
				    // obtenemos los datos del archivo
			    	$prefijo = substr(md5(uniqid(rand())),0,6);
			        // guardamos el archivo a la carpeta files
			        $destino =  "img/".$prefijo."_".$archivo;
			        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
					$sql2="INSERT INTO contactos(nombre,datcont,foto,descrip) VALUES('$nombre','$datocontacto','$destino','$descripcion')";
					//PEDIDO CONSULTA
					$pedidos=mysql_query($sql2,$conexion);
					echo(mysql_error());
					if($pedidos){
						echo("Se han agregado los datos con exito");
					}
					else{
						echo(mysql_error());
					}
				}
				if($_GET['subopcion']=="modificar"){
					$nombre=strtoupper($_POST['nombre']);
					$datocontacto=$_POST['datocontacto'];
					$descripcion=$_POST['content'];
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
							if($nombre!=''){
								//MODIFICACION
								$sql2="UPDATE contactos SET nombre='$nombre' WHERE ID='".$_GET['IDX']."'";
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
							if($datocontacto!=''){
								//MODIFICACION
								$sql2="UPDATE contactos SET datcont='$datocontacto' WHERE ID='".$_GET['IDX']."'";
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
								$sql2="UPDATE contactos SET descrip='$descripcion' WHERE ID='".$_GET['IDX']."'";
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
							if($archivo!=''){
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
						        move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino);
								//MODIFICACION
								$sql2="UPDATE contactos SET foto='$destino' WHERE ID='".$_GET['IDX']."'";
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
					$sqlog="SELECT * FROM contactos WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							$sqlog="DELETE FROM contactos WHERE ID='".$_GET['IDX']."'";
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
		?>
		<table>
			<tr>
				<td>
						<?php if($_GET['opcion']=='noticias'){ ?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=contactos&entrar=".$_GET['entrar']); ?>"><h1>FAMILIA</h1></a>
							<?php } else{ ?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=contactos&entrar=".$_GET['entrar']); ?>"><h1>FAMILIA</h1></a>
							<?php } ?>
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
						echo("Seleccionar Contacto");
					?>
				</td>
			</tr>
		<?php
		}
		?>
			<tr>
				<td>
					<?php
					if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar') {
						?>
						<SELECT name="nombre" id="nombre" onchange="abreSitio('nombre');">
								<OPTION>[seleccione contacto]</OPTION>
						<?php
						if($_GET['opcion']!=''){
							$opciontabla=$_GET['opcion'];
							
						}
						else{
							$opciontabla="contactos";
						}
						if($opciontabla=="contactos"){
							$tabladef="contactos";
							$campomos="nombre";
						}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID DESC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($_GET['option']!='niveles'){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}	
										}
										else{
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
											}
										}
									}
								}
								else{
									echo("<OPTION>NO HAY CONTACTOS AGREGADOS</OPTION>");
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
						echo("Nombre del contacto");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="nombre" id="nombre" type="text" style="border:1px solid black;width:333px;" value="<?php echo($nombrecontacto); ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php
						echo("Dato de Contacto");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<INPUT name="datocontacto" id="datocontacto" type="text" style="border:1px solid black;width:333px;" maxlength="40" value="<?php echo($datocontacto); ?>">
				</td>
			</tr>
				<tr>
					<td>
						<?php
							echo("Imagen de Portada");
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
						Descripci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="content" id="content" style="width:100%;display:block;"><?php echo($cuerponoticia); ?></textarea>
						<!-- CKEditor --><script type="text/javascript"> CKEDITOR.replace('content'); </script>
					</td>
				</tr>
		</table>
		<table>
			<tr>
				<td>
					<input id="btnprocesar" name="btnprocesar" type="submit" class="btn btn-info" value="Procesar"></input>
				</td>
			</tr>
		</table>
	</form>
</div>