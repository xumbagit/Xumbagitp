	<div class="titulo_modulo"  style="margin-top:20px;border: 0px;">
	<?php
		if($_GET['tipoarticulo']=="RESP.SOCIAL" || $_GET['tipo']=="RESP.SOCIAL"){
			?>
				<p>Labor Social</p>
			<?php
		}
		else{
			?>
				<p>Noticias</p>
			<?php		
		}
	?>
	</div>
	<div class="content_modulo" style="border: 0px;">
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr style="border: 0px;vertical-align:top;">
				<td style="border: 0px;">
		<div class="collumnam2" style="width:690px;border: 0px;">
		<?php
			if($_GET['nr']!=''){
				$limite=$_GET['nr'];
			}
			else{
				$limite=4;
			}
				
			if($_GET['idnotice']!=''){
				$sqlsel="SELECT * FROM noticias WHERE ID='".$_GET['idnotice']."' LIMIT 1";
				$pedidosel=mysql_query($sqlsel,$conexion);
				if($pedidosel){
					$filassel=mysql_num_rows($pedidosel);
					if($filassel>0){
							$datserv=mysql_fetch_array($pedidosel);
							$titulonotice=$datserv['titulo'];
							$cuerponotice=str_replace("\n", "<br>", $datserv['cuerpo']);
							$fechanotice=$datserv['fecha'];
							$fechaevento=$datserv['fechaevento'];
							$fotonotice=$datserv['fotodir'];
							$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
							$fecha=explode("-", $fechaevento);
							$mes=$fecha[1]-1;
							$fechastr=$fecha[2]." de ".$meses[$mes]." de ".$fecha[0];
							$mesact=$fecha[1];
							?>
							<table style="border: 0px;">
								<tr style="border: 0px;vertical-align:top;">
									<td style="border: 0px;">
								<table style="border: 0px;">
									<tr style="border: 0px;vertical-align:top;">
										<td style="border: 0px;">
											<!-- TITULO NOTICIA !-->
											<p class="titulonot" style="border: 0px;">
												<?php echo($titulonotice); ?>
											</p> 
										</td>
									</tr>
									<tr style="border: 0px;height:auto;">
										<td style="border: 0px;height:auto;">
											<!-- IMAGEN NOTICIA !-->
											<img style="width:500px;" src="<?php echo($fotonotice); ?>">
										</td>
									</tr>
									<tr style="border: 0px;">
										<td style="border: 0px;">
											<!-- NOTICIA !-->
											<table style="border: 0px;">
												<?php
												if($_GET['tipoarticulo']!="ENTRETENIMIENTO"){
													?>
														<tr style="border: 0px;">
															<td style="border: 0px;">
																<!-- DETALLE NOTICIA !-->
																<div class="cuerponot" style="width:620px;border: 0px;">
																	<?php 
																		echo($cuerponotice); 
																	?>
																</div>
															</td>
														</tr>
													<?php
												}
												if($_GET['tipoarticulo']=='CALENDARIO'){
													?>
														<tr>
															<td>
																<p style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;color: black;">
																	Fecha del Evento/Noticia
																</p>
															</td>
														</tr>
														<tr>
															<td>
																<p style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
																	<?php
																		if($fechastr!=''){
																			echo($fechastr);
																		} 
																	?>
																</p>
															</td>
														</tr>
													<?php
												} 
												?>
												<tr style="border: 0px;">
													<td style="border: 0px;">
														<p class="pienot" style="border: 0px;">
															<!-- FECHA NOTICIA !-->
															<?php echo("Publicado: ".$fechanotice); ?>
														</p> 
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
									</td>
									<td  style="border: 0px;width: 200px;">
										
									</td>
								</tr>
							</table>
							<?php
					}
				}
			}
			else{
				if($_GET['tipoarticulo']!=''){
					if($_GET['tipoarticulo']=='NOTICIA' || $_GET['tipoarticulo']=='EVENTO' || $_GET['tipoarticulo']=='CALENDARIO'){
						$tiponoticia=strtoupper($_GET['tipoarticulo']);
					}
					else{
						$tiponoticia="NOTICIA";
					}
				}
				
				if($_GET['noticiasante']==""){
					if($_GET['noticiasante']=="true"){
						$opadicionales="WHERE ID<'".$_GET['idnoticia']."'";
						$limite=4;
					}
				}
				else{
					$opadicionales="WHERE ID='".$_GET['idnoticia']."'";
					$limite=4;
				}
				
				if($_GET['idnotice']==""){
					$opadicionales="WHERE tipo='".$_GET['tipoarticulo']."' ORDER BY ID DESC";
					$limite=4;
				}
				
				if($_GET['ny']!=""){
					$opadicionales="WHERE fecha like '%".$_GET['ny']."%' AND tipo='".$_GET['tipoarticulo']."'";
					$limite=4;
				}
				
				if($_GET['nm']!=""){
					$opadicionales="WHERE fecha like '%".$_GET['nm']."%' AND tipo='".$_GET['tipoarticulo']."'";
					$limite=4;
				}
								
				if($_GET['nr']!=''){
					$limite=$_GET['nr'];
				}
				else{
					$limite=4;
				}
				if($_GET['tipoarticulo']=='CALENDARIO'){
					$opadicionales="WHERE tipo='CALENDARIO' GROUP BY MONTH(fechaevento) ORDER BY MONTH(fechaevento) ASC";
				}
					
				$sqlsel="SELECT * FROM noticias ".$opadicionales;
				$pedidosel=mysql_query($sqlsel,$conexion);
				if($pedidosel){
					$filassel=mysql_num_rows($pedidosel);
					if($filassel>0){
						$i=0;
						$w=0;
						while($datserv=mysql_fetch_array($pedidosel)){
							$titulonotice=$datserv['titulo'];
							if($_GET['tipoarticulo']!='CALENDARIO'){
								$cuerponotice=substr($datserv['cuerpo'], 0,140);
							}
							else{
								$cuerponotice=$datserv['cuerpo'];
							}
							$cuerponotice=$cuerponotice."...";
							$fechanotice=$datserv['fecha'];
							$fechaevento=$datserv['fechaevento'];
							$fotonotice=$datserv['fotodir'];
							$idnot=$datserv['ID'];
							$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
							$fecha=explode("-", $fechaevento);
							$mes=$fecha[1]-1;
							$fechastr=$fecha[2]." de ".$meses[$mes];
							$mesact=$fecha[1];
							if($_GET['tipoarticulo']!='CALENDARIO'){
								?>
								<table>
									<tr>
										<td>
											<div style="position:relative; text-align:center;width:250px;height:200px;overflow: hidden;">
											<?php
												if($_GET['tipoarticulo']=='ENTRETENIMIENTO'){
													?>
														<p style="position:relative; text-align:center; margin-left: 17%;">
															<!-- IMAGEN NOTICIA !-->
															<a href="<?php echo($fotonotice); ?>" rel="lightbox"><img style="width:550px;" src="<?php echo($fotonotice); ?>"></a>
														</p>	
													<?php
												}
												else{
													?>
														<!-- IMAGEN NOTICIA !-->
														<img style="width:200px;" src="<?php echo($fotonotice); ?>">
													<?php
												}
											?>
											</div>
										</td>
										<td>
											<!-- NOTICIA !-->
											<table>
												<tr>
													<td>
														<!-- TITULO NOTICIA !-->
														<p class="titulonot">
															<?php echo($titulonotice); ?>
														</p>
													</td>
												</tr>
												<tr>
													<td style="height:15px;">
														
													</td>
												</tr>
													<?php
														if($_GET['tipoarticulo']=='CALENDARIO'){
															?>
																<tr>
																	<td>
																		Fecha del Evento/Noticia
																	</td>
																</tr>
																<tr>
																	<td>
																		<?php
																			if($fechaevento!=''){
																				echo($fechaevento);
																			} 
																		?>
																	</td>
																</tr>
															<?php
														} 
													?>
													<tr style="width:700px;">
														<td>
															<div class="cuerponot">
																	<?php 
																		echo($cuerponotice); 
																	?>
																<!-- DETALLE NOTICIA !-->
															</div>
														</td>
													</tr>
													<tr>
														<td style="width:500px;">
															<p class="pienot">
																<!-- FECHA NOTICIA !-->
																<?php echo("Publicado: ".$fechanotice); ?>
															</p>
															<p class="pienot">
																<a onclick="<?php echo("location.href='?mod=noticias&idnotice=".$idnot."&tipoarticulo=".$_GET['tipoarticulo']."';"); ?>" style="background:none; color:#FF4E00; height:30px; width:110px; border:0px; cursor: pointer; text-align: right; font-weight:normal; font-style:oblique; "><img src="img/seguirleyendo.png"> </a>
															</p>
														</td>
													</tr>
											</table>
										</td>
									</tr>
								</table>
								<?php
							}
							else {
								?>
								<table style="background:#E6E6E6;width: 569px;height: 20px;margin-top: -2px; margin-left: -13px;margin-bottom: -2px;">
									<tr>
										<td>
											<p style="font-size: 14px; font-family: Arial, Helvetica, sans-serif; font-weight: bolder;color: black;">
												<?php 
													echo(ucwords(strtolower($meses[$mes])));
												?>
											</p>
										</td>
									</tr>
								</table>
								<table>
									<tr>
										<td style="height: 5px;">
											<td>
												<hr style="width:1070px;height:1px;color:black;background:black;margin-left:-7px;">
											</td>
										</td>
									</tr>
								</table>
								<table>
									<tr>
										<td style="width: 10px;">
										</td>
										<td>
							<?php
															
								$sqlselvar="SELECT * FROM noticias WHERE tipo='CALENDARIO' AND fechaevento LIKE '%-".$fecha[1]."-%'";
								$pedidoselvar=mysql_query($sqlselvar,$conexion);
								if($pedidoselvar){
									$filasselvar=mysql_num_rows($pedidoselvar);
									if($filasselvar>0){
										while($datserva=mysql_fetch_array($pedidoselvar)){
												$idnot=$datserva['ID'];
													$celdacontents='celdacontent'.$w;
													?>
													<table>
														<tr onclick="cambiarDisplay('<?php echo($celdacontents); ?>');">
															<td style="color:#FF4E00; font-weight: bolder; cursor: pointer;">
																<?php
																	$titulonotice=$datserva['titulo'];
																	$titulonotice=strtr(strtoupper($titulonotice),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
																	echo($titulonotice);
																?>
															</td>
														</tr>
														<tr style="display: none;" id="<?php echo($celdacontents); ?>">
															<td>
																<table>
																	<tr>
																		<td style="width: 400px;">
																			<?php
																				$cuerponotice=$datserva['cuerpo']; 
																				echo($cuerponotice); 
																			?>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<p class="pienot">
																				<a onclick="<?php echo("location.href='?mod=noticias&idnotice=".$idnot."&tipoarticulo=".$_GET['tipoarticulo']."';"); ?>" style="background:none; color:#FF4E00; height:30px; width:110px; border:0px; cursor: pointer; text-align: right; font-weight:normal; font-style:oblique; margin-top: 5px; margin-left: 70%;"><img src="img/seguirleyendo.png"> </a>
																			</p>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td>
															<table>
																<tr>
																	<td style="height: 5px;">
																		<td>
																			<hr style="width:1070px;height:1px;color:black;background:#CCCCCC;margin-left:-7px;">
																		</td>
																	</td>
																</tr>
															</table>
															</td>
														</tr>
													</table>
													<?php
													$w++;
													}
												}
											}
											?>
										</td>
									</tr>
								</table>
								<?php
							}
							?>
								<table>
									<tr>
										<td style="height: 30px;">
											
										</td>
									</tr>
								</table>
							<?php
							if($i<($filassel-1)){
							?>
								<table>
									<tr>
										<td style="height: 1px;">
											<td>
												<hr style="width:1070px;height:1px;color:black;background:black;margin-left:-7px;">
											</td>
										</td>
									</tr>
								</table>
							<?php
							}
							$i++;
						}
					}
					else{
						echo("NO HAY NOTICIAS ANTERIORES");	
					}
				}
			}
			
			$sqlsel="SELECT * FROM noticias WHERE tipo='NOTICIA' ORDER BY ID DESC LIMIT 1";
			$pedidosel=mysql_query($sqlsel,$conexion);
			if($pedidosel){
				$filassel=mysql_num_rows($pedidosel);
				if($filassel>0){
					while($datserv=mysql_fetch_array($pedidosel)){
						$titulonotice=$datserv['titulo'];
						$cuerponotice=$datserv['cuerpo'];
						$fechanotice=$datserv['fecha'];
						$fotonotice=$datserv['fotodir'];
						$idnotyet=$datserv['ID'];
					}
				}
			}
			
			if($_GET['tipoarticulo']=='CALENDARIO'){
				?>
			<table>
				<tr>
					<td>
						<a href="<?php echo("?mod=".$_GET['mod']."&noticiasante=true&tipoarticulo=".$_GET['tipoarticulo']."&idnoticia=".$idnotyet."&idnotice=".$idnotyet);  ?>">Noticias Anteriores</a>
					</td>
				</tr>
			</table>
				<?php
			}
			else{
				if($_GET['tipoarticulo']=="CALENDARIO"){
				?>
			<table>
				<tr>
					<td>
						<a href="<?php echo("?mod=".$_GET['mod']."&noticiasante=true&tipoarticulo=".$_GET['tipoarticulo']."&idnoticia=".$idnotyet."&idnotice=".$idnotyet);  ?>">Eventos Anteriores</a>
					</td>
				</tr>
			</table>
				<?php
				}				
			}
			
			if($_GET['tipoarticulo']=="CALENDARIO"){
				?>
			<table>
				<tr>
					<td>
						<?php echo("Mostrar ".$limite." Resultados"); ?>
					</td>
				</tr>
				<tr>
					<td>
						Resultados
					</td>
					<td>
						<SELECT name="numresult" id="numresult" onchange="abreSitio('numresult');">
							<?php
								
								if($limite==1){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&tipoarticulo=".$_GET['tipoarticulo']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=1\">1</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&tipoarticulo=".$_GET['tipoarticulo']."&subopcion=".$_GET['subopcion']."&nr=1\">1</OPTION>");
								}
								if($limite==2){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&tipoarticulo=".$_GET['tipoarticulo']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=2\">2</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&tipoarticulo=".$_GET['tipoarticulo']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=2\">2</OPTION>");
								}
								if($limite==3){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=3\">3</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=3\">3</OPTION>");
								}
								if($limite==4){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=4\">4</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=4\">4</OPTION>");
								}
								if($limite==5){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=5\">5</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=5\">5</OPTION>");
								}
								if($limite==10){
									echo("<OPTION SELECTED value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=10\">10</OPTION>");
								}
								else{
									echo("<OPTION value=\"?&mod=noticias&opcion=".$_GET['opcion']."&tipoarticulo=".$_GET['tipoarticulo']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nr=10\">10</OPTION>");
								}
							?>
						</SELECT>
					</td>
					<td>
						A&ntilde;o
					</td>
					<td>
						<SELECT name="slectanio" id="slectanio" onchange="abreSitio('slectanio');">
							<?php
								$anio=date("Y");
								for($x=1970;$x<=$anio;$x++){
									if($_GET['ny']!=''){
										if($x==$_GET['ny']){
											echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&ny=".$x."&nr=".$_GET['nr']."\">".$x."</OPTION>");
										}
										else{
											echo("<OPTION value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&ny=".$x."&nr=".$_GET['nr']."\">".$x."</OPTION>");
										}
									}
									else{
										if($x==$anio){
											echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&ny=".$x."&nr=".$_GET['nr']."\">".$x."</OPTION>");
										}
										else{
											echo("<OPTION value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&ny=".$x."&nr=".$_GET['nr']."\">".$x."</OPTION>");
										}
									}
								}
							?>
						</SELECT>
					</td>
					<td>
						Mes
					</td>
					<td>
						<SELECT name="slectmes" id="slectmes" onchange="abreSitio('slectmes');">
							<?php
								$mesactual=date("m");
								for($i=1;$i<=12;$i++){
									if($i==$mesactual){
										echo("<OPTION SELECTED value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nm=".$i."&ny=".$_GET['ny']."&nr=".$_GET['nr']."\">".$i."</OPTION>");
									}
									else{
										echo("<OPTION value=\"?&mod=".$_GET['mod']."&tipoarticulo=".$_GET['tipoarticulo']."&opcion=".$_GET['opcion']."&categoria=".$_GET['categoria']."&nivelc=".$datserv['ID']."&subopcion=".$_GET['subopcion']."&nm=".$i."&ny=".$_GET['ny']."&nr=".$_GET['nr']."\">".$i."</OPTION>");
									}
								}
							?>
						</SELECT>
					</td>
				</tr>
			</table>
				<?php
			}
			?>
		</div>
				</td>
				<td style="border: 0px;">
              <div id="noticias2">
              	<h1>ACTUALIDAD TRIBUTARIA</h1>
				<?php
					//NOTICIAS
					$limit=5;
					$sqlsel="SELECT * FROM noticias WHERE tipo='NOTICIA' ORDER BY ID DESC LIMIT ".$limit;
					$pedidosel=mysql_query($sqlsel,$conexion);
					if($pedidosel){
						$filassel=mysql_num_rows($pedidosel);
						if($filassel>0){
							$i=0;
							while($datserv=mysql_fetch_array($pedidosel)){
								$titulonotice=ucwords(strtolower($datserv['titulo']));
								$cuerponotice=substr($datserv['cuerpo'], 0,130);
								$cuerponotice=$cuerponotice."...";
								$fechanotice=$datserv['fecha'];
								$idnot=$datserv['ID'];
								?>
									<table>
										<tr>
											<td style="width: 330px;border: 0px;height: 20px;">
												<p style="color:black;margin-top: 3%; font-size: 14px; font-weight: bolder;">
													<?php
														echo($titulonotice);
													?>
												</p>
											</td>
										</tr>
										<tr>
											<td style="width: 330px;border: 0px;">
												<p style="font-size: 10px; font-weight: normal;">
													<?php
														echo($cuerponotice);
													?>
												</p>
											</td>
										</tr>
										<tr>
											<td style="width: 330px;border: 0px;">
												<?php
													echo("<div id=\"botongenral\"><a href=\"index.php?&mod=noticias&tiponoticia=NOTICIA&idnotice=".$idnot."\">Leer Mas...</a></div>");
												?>
											</td>
										</tr>
									</table>
									<?php
									if($filassel!=($i+1)){
										?>
											<div id="lineahorizontal"></div>
										<?php
									}
									?>
								<?php
								$i++;
							}
						}
					}
				?>
				</div>
				</td>
			</tr>
		</table>
	</form>
	</div>