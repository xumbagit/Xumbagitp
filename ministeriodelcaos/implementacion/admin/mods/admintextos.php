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
				if($option=="textos"){
					$seccion=strtoupper($_GET['seccion']);
					$descripcion=$_POST['descrip'];
					$texto=$_POST['texto'];

					if($_GET['subopcion']=="agregar"){
						$sqlog="SELECT * FROM textos WHERE seccion='$seccion'";
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
								$sql2="INSERT INTO textos(seccion,texto,descrip) VALUES('$seccion','$texto','$descripcion')";
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
						}
					}
					if($_GET['subopcion']=="modificar"){
						$sqlog="SELECT * FROM textos WHERE seccion='".$_GET['seccion']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							$filaslog=mysql_num_rows($pedidolog);
							if($filaslog>0){
								//MODIFICACION
								if($descripcion!=''){
									//MODIFICACION
									$sql2="UPDATE textos SET descrip='$descripcion' WHERE seccion='".$_GET['seccion']."'";
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
								
								if($texto!=''){
									//MODIFICACION
									$sql2="UPDATE textos SET texto='$texto' WHERE seccion='".$_GET['seccion']."'";
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
						if($_GET['opcion']=='textos'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=textos&entrar=".$_GET['entrar']); ?>"><h1>TEXTOS</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=textos&entrar=".$_GET['entrar']); ?>"><h1>TEXTOS</h1></a>
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
				$sqlsel="SELECT * FROM textos WHERE ID='".$_GET['idbanner']."'";
				$pedidosel=mysql_query($sqlsel,$conexion);
				if($pedidosel){
					$filassel=mysql_num_rows($pedidosel);
					if($filassel>0){
						$datserv=mysql_fetch_array($pedidosel);
						$seccion=$datserv['seccion'];
						$texto=$datserv['texto'];
						$descrip=$datserv['descrip'];
					}
					else{
						$enlace='http://';
					}
				}
		?>
				<table>
					<?php
					if($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar'){
						?>
							<tr>
								<td>
									Secci&oacute;n
								</td>
							</tr>
							<tr>
								<td>
									<SELECT name="patrocinantetxt" id="patrocinantetxt" onchange="abreSitio('patrocinantetxt');">
											<OPTION>[seleccione]</OPTION>
											<OPTION <?php echo("value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&seccion=FAMILIA&entrar=".$_GET['entrar']."\""); if($seccion=="FAMILIA"){ echo("SELECTED"); } ?> value="FAMILIA">FAMILIA</OPTION>
											<OPTION <?php echo("value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&seccion=VANCE_SUZETTE&entrar=".$_GET['entrar']."\""); if($seccion=="VANCE_SUZETTE"){ echo("SELECTED"); } ?> value="VANCE_SUZETTE">VANCE SUZETTE</OPTION>
											<OPTION <?php echo("value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&seccion=CONTACTO&entrar=".$_GET['entrar']."\""); if($seccion=="CONTACTO"){ echo("SELECTED"); } ?> value="CONTACTO">CONTACTO</OPTION>
									</SELECT>
								</td>
							</tr>
						<?php
					}
					else{
						?>
				<tr>
					<td>
						Secci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="patrocinantetxt" id="patrocinantetxt">
								<OPTION>[seleccione]</OPTION>
								<OPTION <?php if($seccion=="FAMILIA"){ echo("SELECTED"); } ?> value="FAMILIA">FAMILIA</OPTION>
								<OPTION <?php if($seccion=="VANCE_SUZETTE"){ echo("SELECTED"); } ?> value="VANCE_SUZETTE">VANCE SUZETTE</OPTION>
								<OPTION <?php if($seccion=="CONTACTO"){ echo("SELECTED"); } ?> value="CONTACTO">CONTACTO</OPTION>
						</SELECT>
					</td>
				</tr>
				<?php
						}
				
				?>
				<tr>
					<td>
						Texto
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nmboton" id="nmboton" type="text" value="<?php echo($texto); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Descripci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nmdescripcion" id="nmdescripcion" type="text" value="<?php echo($descrip); ?>">
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