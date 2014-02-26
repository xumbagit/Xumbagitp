<?php
	//Enlace para entrar al administrador de noticias
	///index.php?mod=admincontent&opcion=noticias&subopcion=agregar&entrar=73e3ff68b4290444f8e39fe8e8bbd8f4
//CREAR PDF
$fileparser='libs/roslib/class.ezpdf.php';
if (file_exists($fileparser)){
	include($fileparser);
}

if($_GET['guardarpdf']=='true'){
	$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['idcarrera']."'";
	$pedidolog=mysql_query($sqlog,$conexion);
	if($pedidolog){
		$filaslog=mysql_num_rows($pedidolog);
		if($filaslog>0){
			$datacar=mysql_fetch_array($pedidolog);
			$sqlog="SELECT * FROM inspago WHERE idcarrera='".$datacar['ID']."'";
			$pedidolog1=mysql_query($sqlog,$conexion);
			if($pedidolog1){
				$filaslog1=mysql_num_rows($pedidolog1);
				if($filaslog1>0){
					while($datf=mysql_fetch_array($pedidolog1)){
						$sqlog="SELECT * FROM usuarios WHERE ID='".$datf['idusuario']."'";
						$pedidolog2=mysql_query($sqlog,$conexion);
						if($pedidolog2){
							$datos=mysql_fetch_array($pedidolog2);
							$datosrep[]=Array(								
								'Nombre'=>$datos['nombre'],
								'Email'=>$datos['email'],
								'Compa&ntilde;&iacute;a'=>$datos['compania']);
						}
					}//Crear instancia de ezpdf
					$pdf= new Cezpdf('a4','landscape');
					$nombreporte="Lista de usuarios al ".date('h:i:s-a');
					//Generar el contenido del PDF
					$pdf->selectFont('libs/roslib/fonts/Helvetica-Bold.afm');
					$pdf->selectFont('libs/roslib/fonts/Helvetica.afm');
					$pdf->ezText($nombreporte,12);
					$pdf->ezText("Fecha de Emision: ".date("D-M-Y"),12);
					$pdf->ezText("\n\n\n",10);
					$pdf->ezTable($datosrep);
					//Escribir el PDF a fichero en el servidor
					$pdfcode = $pdf->ezOutput();
					$nombre="mods/ListaUsuarios_".date('h:i:s-a').".pdf"; 
					$nombrearchivopdf=$nombre;
					$fp=fopen($nombre,'wb');
					fwrite($fp,$pdfcode);
					fclose($fp);
				}
			}
		}
	}
}
?>

<div style="z-index: 10000;margin-top: 20px;">
<div class="titulo_modulo">
	<p>Administrador de Noticias</p>
</div>
<div class="content_modulo">
	<form method="POST" enctype="multipart/form-data">
		<?php
		//guardar la fecha en la que se escribio el articulo sin mostrarlo en la pantalla date("Y-m-d"); en campo tipo date
		$btn=$_POST['btnprocesar'];
		$option=$_GET['opcion'];
		$suboption=$_GET['subopcion'];
		if($btn){
			if($suboption==''){
				echo("DEBE ELEGIR UNA OPCION");
			}
			if($option=="noticias"){
				$nombre=strtoupper($_POST['nombre']);
				$lugarentrega=$_POST['entregamat'];
				$descripcion=$_POST['elm1'];
				$fechaevento=$_POST['fechaevento'];
				$tipoevento=$_POST['tipoeventoc'];
				$enlacefotos=$_POST['enlacefotos'];
				$noticia=$_POST['elm1'];
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
				$sinscrip=$_POST['inscripoption'];
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM noticias WHERE titulo='$nombre'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
							$datos=mysql_fetch_array($pedidolog);
							$foto=$logo;
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
							if($archivo!=''){
								if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)) {
									$status = "Archivo subido: <b>".$archivo."</b>";
								}
							}
							$sql2="INSERT INTO noticias(titulo,cuerpo,fecha,tipo,fotodir) VALUES('$nombre','$noticia','$fechaevento','$tiponot','$destino')";
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
				if($_GET['subopcion']=="modificar"){
					$sqlog="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog>0){
							//MODIFICACION
							if($archivo!=''){
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
								if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)) {
									$status = "Archivo subido: <b>".$archivo."</b>";
								}
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

							if($descripcion!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET cuerpo='$noticia' WHERE ID='".$_GET['IDX']."'";
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
							if($fechaevento!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET fecha='$fechaevento' WHERE ID='".$_GET['IDX']."'";
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
							if($tipoevento!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET tipocarrera='$tipoevento' WHERE ID='".$_GET['IDX']."'";
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

							if($lugarentrega!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET entregamat='$lugarentrega' WHERE ID='".$_GET['IDX']."'";
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

							if($enlacefotos!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET enlacefotos='$enlacefotos' WHERE ID='".$_GET['IDX']."'";
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

							if($sinscrip!=''){
								//MODIFICACION
								$sql2="UPDATE noticias SET habilcrip='$sinscrip' WHERE ID='".$_GET['IDX']."'";
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
								echo("Se han eliminado con exito");
							}
							else{
								echo(mysql_error());
							}
						}
					}
				}
			}
			if($option=="banners"){
				$nombre=strtoupper($_POST['nombre']);
				$descripcion=$_POST['elm1'];
				$noticia=$_POST['elm1'];
				$tipobanner=$_POST['tipoban'];
				$seccionpagina=$_POST['seccionpag'];
				$patrocinante=$_POST['patrocinantetxt'];
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
				//Tipo de objeto, si flash o imagen
				$objeto=$_POST['tipobjeto'];
				$enlace=$_POST['enlacebanner'];
				
				if($_GET['subopcion']=="agregar"){
					$sqlog="SELECT * FROM banner WHERE tipobanner='$tipobanner'";
					$pedidolog=mysql_query($sqlog,$conexion);
					echo(mysql_error());
					if($pedidolog){
						$filaslog=mysql_num_rows($pedidolog);
						if($filaslog==0){
							$datos=mysql_fetch_array($pedidolog);
							$foto=$logo;
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)) {
							$sql2="INSERT INTO banner(seccion,tipobanner,patrocinante,imgbanner,objeto) VALUES('$seccionpagina','$tipobanner','$patrocinante','$destino','$objeto')";
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
						else {
							$datos=mysql_fetch_array($pedidolog);
							$foto=$logo;
						    // obtenemos los datos del archivo
					    	$prefijo = substr(md5(uniqid(rand())),0,6);
					        // guardamos el archivo a la carpeta files
					        $destino =  "img/".$prefijo."_".$archivo;
					        if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)) {
							$sql2="INSERT INTO banner(seccion,tipobanner,patrocinante,imgbanner,objeto) VALUES('$seccionpagina','$tipobanner','$patrocinante','$destino','$objeto')";
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
							
							if($enlace!=''){
								//MODIFICACION
								$sql2="UPDATE banner SET enlace='$enlace' WHERE ID='".$_GET['idbanner']."'";
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
														
							if($archivo!=''){
								$foto=$logo;
							    // obtenemos los datos del archivo
						    	$prefijo = substr(md5(uniqid(rand())),0,6);
						        // guardamos el archivo a la carpeta files
						        $destino =  "img/".$prefijo."_".$archivo;
								if(move_uploaded_file($_FILES["imgicono"]['tmp_name'],$destino)) {
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

			if($_GET['opcion']=='productos'){
				if(file_exists("adminproductos.php")){
					include("adminproductos.php");
				}
				else{
					echo("ERROR");
				}
			}
		}

		$numaleatorio="73e3ff68b4290444f8e39fe8e8bbd8f4";
		$cadena="true2790ArtVSa";
		if($_GET['entrar']!=$numaleatorio){
			?>
			<div style="z-index:0;">
				<form method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td>
								Usuario
							</td>
						</tr>
						<tr>
							<td>
								<INPUT name="nombre" id="nombre" type="text">
							</td>
						</tr>
						<tr>
							<td>
								Clave
							</td>
						</tr>
						<tr>
							<td>
								<INPUT name="clave" id="clave" type="password">
							</td>
						</tr>
						<tr>
							<td>
								<INPUT name="btnproc" id="btnproc" type="submit" value="Procesar">
							</td>
						</tr>
					</table>
					<?php 
					$btn=$_POST['btnproc'];
					if($btn){
						$nom=$_POST['nombre'];
						$clav=$_POST['clave'];
						
						if($nom!='' && $clav!=''){
							$nommdc=md5('admin');
							$clavmd5=md5('Admin123');
							if($nommdc==md5($nom) && $clavmd5==md5($clav)){
								$_SESSION['usrname']=$nommdc;
								?>
									<script language="JavaScript" type="text/javascript">
										location.href="?&mod=admincontent&entrar=73e3ff68b4290444f8e39fe8e8bbd8f4";
									</script>
								<?php
							}
							else{
								echo("font-size:11px; de Usuario o Clave Incorecto(s)");
							}
						}
					}
					?>
				</form>
			</div>
			<?php
		}
		else{
		?>
		<table>
			<tr style="height: 25px;">
				<td>
					
				</td>
			</tr>
			<tr style="height: 25px;">
				<td>
					
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&subopcion=agregar&entrar=".$_GET['entrar']); ?>">Agregar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&subopcion=consultar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Consultar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&subopcion=modificar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Modificar</a>
							</td>
							<td>
								|
							</td>
							<td>
								<a href="<?php echo("?mod=".$_GET['mod']."&opcion=noticias&subopcion=eliminar&categoria=9&nivelc=20&IDX=5&entrar=".$_GET['entrar']); ?>">Eliminar</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
						<?php
					if($_GET['opcion']=='productos'){
						include("adminproductos.php");
					}
					
					if($_GET['opcion']=='categorias'){
						include("admincategorias.php");
					}
					if($_GET['opcion']=='colores'){
						include("admincolor.php");
					}
					?>
		</table>
		<table>
				<?php
			
			if($_GET['opcion']=='noticias' || $_GET['opcion']==''){
				?>
				<tr>
					<td>
						Titulo de la Noticia
					</td>
				</tr>
				<tr>
					<td>
						<?php
						if($_GET['subopcion']!='agregar'){
						?>
						<SELECT name="nombre" id="nombre"  onchange="abreSitio('nombre');" style="width: 400px;">
							<OPTION>FAVOR SELECCIONAR OPCION</OPTION>
							<?php
								$sqlsel="SELECT * FROM noticias ORDER BY ID DESC";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										while($datserv=mysql_fetch_array($pedidosel)){
											if($datserv['ID']==$_GET['IDX']){
												echo("<OPTION SELECTED value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv['titulo']."</OPTION>");
											}
											else{
												echo("<OPTION value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&nivelc=".$_GET['nivelc']."&categoria=".$_GET['categoria']."&IDX=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$datserv['titulo']."</OPTION>");
											}
										}
									}
									else{
										echo("<OPTION>NO HAY NIVELES AGREGADOS</OPTION>");
									}
								}
							?>
						</SELECT>
						<?php
					}
					else{
						?>
							<INPUT name="nombre" id="nombre" type="text" style="border:1px solid black;width:540px;">
						<?php
					}
					?>
					</td>
				</tr>
				<tr>
					<td>
						Tipo Noticia
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="tiponota" id="tiponota">
							<?php
								$sqlsel="SELECT * FROM noticias WHERE ID='".$_GET['IDX']."'";
								$pedidosel=mysql_query($sqlsel,$conexion);
								if($pedidosel){
									$filassel=mysql_num_rows($pedidosel);
									if($filassel>0){
										$datserv=mysql_fetch_array($pedidosel);
										$tiponoticia=$datserv['tipo'];
										$fechaev=$datserv['fechaevento'];
										$tipoev=$datserv['tipoevento'];
										$habilinscripciones=$datserv['habilcrip'];
										$lugarentregamat=$datserv['entregamat'];
										if($fechaev==''){
											$fechaev=date("Y-m-d");
										}
										$enlace=$datserv['enlacefotos'];
										if($enlace==''){
											$enlace="http://";
										}
										$cuerpo=$datserv['cuerpo'];
									}
								}
							?>
							<OPTION <?php if($tiponoticia=="NOTICIA"){ echo("SELECTED"); } ?>>NOTICIA</OPTION>
							<OPTION <?php if($tiponoticia=="RESP.SOCIAL"){ echo("SELECTED"); } ?>>LABOR SOCIAL</OPTION>
							<OPTION <?php if($tiponoticia=="CALENDARIO"){ echo("SELECTED"); } ?>>CALENDARIO</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Noticia
					</td>
				</tr>
				<tr>
					<td>
							<textarea name="elm1" id="elm1" style="width:300px;"><?php
								echo($cuerpo);
							?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Fecha Evento/Noticia
					</td>
				</tr>
				<tr>
					<td>
						<?php
						$fechaev=date("Y-m-d");
						?>
						<INPUT name="fechaevento" id="fechaevento" value="<?php echo($fechaev); ?>">
					</td>
				</tr>
				<?php
			}
		?>
		</table>
		<?php
		}

			if($_GET['opcion']=='banners'){
				$sqlsel="SELECT * FROM banner WHERE ID='".$_GET['idbanner']."'";
				$pedidosel=mysql_query($sqlsel,$conexion);
				if($pedidosel){
					$filassel=mysql_num_rows($pedidosel);
					if($filassel>0){
						$datserv=mysql_fetch_array($pedidosel);
						$seccion=$datserv['seccion'];
						$tipobanner=$datserv['tipobanner'];
						$patrocinante=$datserv['patrocinante'];
						$objeto=$datserv['objeto'];
						$enlace=$datserv['enlace'];
						
						if($enlace==''){
							$enlace='http://';
						}
					}
					else{
						$enlace='http://';
					}
				}
				
				?>
				<table>
				<tr>
					<td>
						Patrocinante
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
														$nombretmp=$datserv['nombre']." ".$datserv['tipobanner'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idbanner']){
															echo("<OPTION SELECTED value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idbanner=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
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
						Secci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="seccionpag" id="seccionpag">
							<OPTION <?php if($seccion=='HOME'){ echo("SELECTED"); } ?>>HOME</OPTION>
							<OPTION <?php if($seccion=='NOTICIAS'){ echo("SELECTED"); } ?>>NOTICIAS</OPTION>
							<OPTION <?php if($seccion=='CALENDARIO'){ echo("SELECTED"); } ?>>CALENDARIO</OPTION>
							<OPTION <?php if($seccion=='GALERIA'){ echo("SELECTED"); } ?>>GALERIA</OPTION>
							<OPTION <?php if($seccion=='REGISTRESE'){ echo("SELECTED"); } ?>>REGISTRESE</OPTION>
							<OPTION <?php if($seccion=='CLUBES'){ echo("SELECTED"); } ?>>CLUBES</OPTION>
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
							<OPTION <?php if($objeto=='IMAGEN'){ echo("SELECTED"); } ?>>IMAGEN</OPTION>
							<OPTION <?php if($objeto=='FLASH'){ echo("SELECTED"); } ?>>FLASH</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Tipo de Banner
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="tipoban" id="tipoban">
							<OPTION <?php if($tipobanner=='HEADER'){ echo("SELECTED"); } ?>  value="HEADER">HEADER</OPTION>
							<OPTION <?php if($tipobanner=='INTERNO'){ echo("SELECTED"); } ?>  value="INTERNO">INTERNO</OPTION>
							<OPTION <?php if($tipobanner=='LATERAL SUPERIOR'){ echo("SELECTED"); } ?>  value="L1">LATERAL SUPERIOR</OPTION>
							<OPTION <?php if($tipobanner=='LATERAL INFERIOR'){ echo("SELECTED"); } ?>  value="L2">LATERAL INFERIOR</OPTION>
							<OPTION <?php if($tipobanner=='CALENDARIO SUPERIOR'){ echo("SELECTED"); } ?>  value="C1">CALENDARIO SUPERIOR</OPTION>
							<OPTION <?php if($tipobanner=='CALENDARIO MEDIO'){ echo("SELECTED"); } ?>  value="C2">CALENDARIO MEDIO</OPTION>
							<OPTION <?php if($tipobanner=='CALENDARIO INFERIOR'){ echo("SELECTED"); } ?>  value="C3">CALENDARIO INFERIOR</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Enlace
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="enlacebanner" id="enlacebanner" type="text" value="<?php echo($enlace); ?>">
					</td>
				</tr>
		</table>
				<?php
			}

if($_GET['opcion']=='usuarios'){
	?>
	<table>
		<tr>
			<td>
				REPORTES DE USUARIOS
			</td>
		</tr>
		<tr>
			<td>
				<a>
					<a target="_blank" href="<?php echo("index.php?mod=".$_GET['mod']."&option=".$_GET['option']."&opcion=".$_GET['opcion']."&guardarpdf=true"); ?>">Generar PDF</a>
				</a>
			</td>
		</tr>		
		<?php
			if($_GET['guardarpdf']=="true"){
			?>
			<tr>
				<td>
					<a target="_blank" href="<?php echo($nombrearchivopdf); ?>">Descargar</a>
				</td>
			</tr>
			<?php
			}
		?>
	</table>
	<?php
}
			//////PAGOS///////
			if($_GET['opcion']=='pagos'){
			?>
			<table>
				<tr>
					<td>
						Nombre de la Carrera
					</td>
				</tr>
				<?php
				if($_GET['subopcion']=='' || $_GET['subopcion']=='agregar'){
					?>
						<tr>
							<td>
									<SELECT name="nomcarrera2" id="nomcarrera2" onchange="abreSitio('nomcarrera2');">
										<OPTION>FAVOR SELECCIONAR CARRERA</OPTION>
										<?php
											$sqlsel="SELECT * FROM noticias WHERE tipo='CALENDARIO' AND habilcrip='SI' ORDER BY ID DESC";
											$pedidosel=mysql_query($sqlsel,$conexion);
											if($pedidosel){
												$filassel=mysql_num_rows($pedidosel);
												if($filassel>0){
													while($datserv=mysql_fetch_array($pedidosel)){
														$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
														$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
														$nombretmp=$datserv['titulo']." ".$datserv['fecha'];
														$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
														if($datserv['ID']==$_GET['idcarrera']){
															echo("<OPTION SELECTED value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idcarrera=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
														else{
															echo("<OPTION value=\"?&mod=admincontent&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&idcarrera=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']."\">".$nombre."</OPTION>");
														}
													}
												}
												else{
													echo("<OPTION>NO HAY CARRERAS AGREGADOS</OPTION>");
												}
											}
										?>
									</SELECT>
							</td>
						</tr>
						<tr>
							<td>
										<?php
											$sqlsel="SELECT * FROM corredores WHERE idcarrera='".$_GET['idcarrera']."' ORDER BY ID DESC";
											$pedidosel=mysql_query($sqlsel,$conexion);
											if($pedidosel){
												$filassel=mysql_num_rows($pedidosel);
												if($filassel>0){
												?>
												<table>
													<thead>
														<th>Nombre</th>
														<th>Apellido</th>
														<th>Cedula</th>
														<th>Tipo de Pago</th>
														<th>Banco</th>
														<th>N. Transferencia</th>
														<th>Tipo de Carrera</th>
														<th>X</th>
													</thead>
													<tbody>
												<?php
													while($datserv=mysql_fetch_array($pedidosel)){
														$sqlsel12u="SELECT * FROM inspago WHERE idusuario='".$datserv['idusuario']."'";
														$pedidosel12u=mysql_query($sqlsel12u,$conexion);
														if($pedidosel12u){
															$filassel12u=mysql_num_rows($pedidosel12u);
															if($filassel12u==0){
																$sqlsel12="SELECT * FROM usuarios WHERE ID='".$datserv['idusuario']."'";
																$pedidosel12=mysql_query($sqlsel12,$conexion);
																if($pedidosel12){
																	$filassel12=mysql_num_rows($pedidosel12);
																	if($filassel12>0){
																		$datanombreu=mysql_fetch_array($pedidosel12);
																		$idusuario=$datanombreu['ID'];
																		$idnombre=$datanombreu['nombrereal'];
																		$idapellido=$datanombreu['apellido'];
																		$idcedula=$datanombreu['ci'];
																		$tipotransfer=$datanombreu['tipotrans'];
																		$transference=$datanombreu['transferencia'];
																		$entidadbanc=$datanombreu['banco'];
																		$tipodecarrera=$datserv['tipocorredor'];
																		$tipocarrera=$datanombreu['tipodcarrera'];
																		$nombrecomp=$idnombre." ".$idapellido." ".$idcedula;
																	}
																}
																$vowelsconv = array("á", "é", "í", "ó", "ú","ñ");
																$vowels = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;");
																$nombretmp=$datserv['nomcarrera']." ".$datserv['fecha'];
																$nombre = str_replace($vowels, $vowelsconv, $nombretmp);
																echo("<tr>");
																	echo("<td>");
																	echo($idnombre);
																	echo("</td>");
																	echo("<td>");
																	echo($idapellido);
																	echo("</td>");
																	echo("<td>");
																	echo($idcedula);
																	echo("</td>");
																	echo("<td>");
																	echo($tipotransfer);
																	echo("</td>");
																	echo("<td>");
																	echo($entidadbanc);
																	echo("</td>");
																	echo("<td>");
																	echo($transference);
																	echo("</td>");
																	echo("<td>");
																	echo(ucwords($tipodecarrera));
																	echo("</td>");
																	echo("<td>");
																	?>
																		<input onclick="<?php echo("location.href='?mod=admincontent&opcion=pagos&entrar=73e3ff68b4290444f8e39fe8e8bbd8f4&confirmarpago=true&idusuario=".$idusuario."&idcarrera=".$_GET['idcarrera']."&confirmacionpago=true';"); ?>" name="btnconfirm" id="btnconfirm" type="button" value="CONFIRMAR">
																	<?php
																	echo("</td>");
																echo("</tr>");
															}
														}
													}
													
													?>
														</tbody>
													</table>
													<?php
												}
											}
										?>
							</td>
						</tr>
					<?php
				}
			}
		?>
		<?php
			if($_GET['entrar']!=''){
		?>
				<table>
					<tr>
						<td>
							<?php
							if($_GET['opcion']=='revista'){
								echo("Revista");
							}
							else{
								echo("Imagen");
							}
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
						<INPUT name="btnprocesar" id="btnprocesar" type="submit" value="Procesar">
					</td>
				</tr>
				<?php
			}
		?>
				</table>
	</form>
</div>
</div>