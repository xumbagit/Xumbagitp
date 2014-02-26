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
				if($option=="background"){
					$logo=$_FILES["imgicono"]['name'];
					$tamano = $_FILES["imgicono"]['size'];
				    $tipo = $_FILES["imgicono"]['type'];
				    $archivo = $_FILES["imgicono"]['name'];
					$sqlog="SELECT * FROM descargas WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					if($archivo!=''){
						echo("SI HAY IMAGEN");
						$foto=$logo;
					    // obtenemos los datos del archivo
				    	$prefijo = substr(md5(uniqid(rand())),0,6);
				        // guardamos el archivo a la carpeta files
				        $destino =  "img/".$prefijo."_".$archivo;
				        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)){
							$sqlog="UPDATE background SET imgfoto='$destino' WHERE ID='".$_GET['IDX']."'";
							$pedidolog=mysql_query($sqlog,$conexion);
							if($pedidolog){
								echo("Se han agregado la imagen con exito");
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
						if($_GET['opcion']=='background'){
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=background&entrar=".$_GET['entrar']); ?>"><h1>BACKGROUND</h1></a>
							<?php
						}
						else{
							?>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=background&entrar=".$_GET['entrar']); ?>"><h1>BACKGROUND</h1></a>
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
		<table>
		<?php
		if(($_GET['subopcion']=='modificar' || $_GET['subopcion']=='eliminar' || $_GET['subopcion']=='consultar')) {
			?>
			<tr>
				<td>
					<?php
						echo("Seleccionar Secci&oacute;n");
					?>
				</td>
			</tr>
		<?php
		}
		?>
			<tr>
				<td>
					<?php
					if($_GET['subopcion']=='modificar'){
						?>
						<SELECT name="nombreid" id="nombreid" onchange="abreSitio('nombreid');">
								<OPTION>[seleccione imagen]</OPTION>
						<?php
							$opciontabla=$_GET['opcion'];
							if($opciontabla=="background"){
								$tabladef="background";
								$campomos="nombre";
							}
							$sqlsel="SELECT * FROM ".$tabladef." ORDER BY ID ASC";
							$pedidosel=mysql_query($sqlsel,$conexion);
							if($pedidosel){
								$filassel=mysql_num_rows($pedidosel);
								//echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">HOLA</OPTION>");
								if($filassel>0){
									while($datserv=mysql_fetch_array($pedidosel)){
										if($datserv['ID']==$_GET['IDX']){
											echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
										}
										else{
											echo("<OPTION value=\"?&mod=".$_GET['mod']."&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&codigonot=".$datserv['codigonot']."&entrar=".$_GET['entrar']."\">".$datserv[$campomos]."</OPTION>");
										}
									}
								}
								else{
									echo("<OPTION>NO HAY BACKGROUND AGREGADO</OPTION>");
								}
							}
						?>
						</SELECT>
						<?php
					}
					else{
						?>
						<table>
							<tr>
								<td>Identificador</td>
							</tr>
							<tr>
								<td>
									<INPUT name="nombreid" id="nombreid" type="text">
								</td>
							</tr>
						</table>
						<?php	
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Archivo Imagen </td>
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