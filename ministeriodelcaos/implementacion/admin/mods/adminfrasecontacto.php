<?php
	$sqlsel="SELECT * FROM encabezados WHERE seccion='".$_GET['seccionmod']."'";
	$pedidosel=mysql_query($sqlsel,$conexion);
	if($pedidosel){
		$filassel=mysql_num_rows($pedidosel);
		if($filassel>0){
			//echo("SIENTRA");
			$datserv=mysql_fetch_array($pedidosel);
			$frasecons=htmlspecialchars($datserv['titulo']);
			$frasecaut=htmlspecialchars($datserv['frase']);
			$frasecseccion=$datserv['seccion'];
		}
	}
?>
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
		//error_reporting(E_ERROR);
			$option=$_GET['opcion'];
			$btn=$_POST['btnprocesar'];
			$nmbotonc=$_POST['nmboton'];
			$autor=$_POST['nmbotonaut'];
			if($btn){
				echo("HOLA");
				if($option=="encabezado"){
					echo("HOLA");
					if($_GET['subopcion']=="modificar"){
						echo("HOLA");
						$sqlog="SELECT * FROM encabezados WHERE seccion='".$_GET['seccionmod']."'";
						$pedidolog=mysql_query($sqlog,$conexion);
						if($pedidolog){
							echo("HOLA");
							//MODIFICACION
							$sql2="UPDATE encabezados SET titulo='$nmbotonc', frase='$autor' WHERE seccion='".$_GET['seccionmod']."'";
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
						else{
							echo(mysql_error());
						}
					}
				}
			}
		?>
		<table>
			<tr>
				<td>
					<?php
					if($_GET['opcion']=='encabezado'){
						?>
							<a href="<?php echo("?mod=".$_GET['mod']."&opcion=encabezado&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']); ?>"><h1>ENCABEZADO</h1></a>
						<?php
					}
					else{
						?>
							<a href="<?php echo("?mod=".$_GET['mod']."&opcion=encabezado&subopcion=".$_GET['subopcion']."&entrar=".$_GET['entrar']); ?>"><h1>ENCABEZADO</h1></a>
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
				<tr>
					<td>
						Secci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<SELECT name="patrocinantetxt" id="patrocinantetxt" onchange="abreSitio('patrocinantetxt');">
								<OPTION>[seleccione]</OPTION>
								<OPTION <?php if($frasecseccion=="FAMILIA"){ echo("SELECTED"); }?> value="<?php echo("?mod=".$_GET['mod']."&opcion=encabezado&subopcion=".$_GET['subopcion']."&seccionmod=FAMILIA"); ?>">FAMILIA</OPTION>
								<OPTION <?php if($frasecseccion=="VANCE_SUZETTE"){ echo("SELECTED"); }?> value="<?php echo("?mod=".$_GET['mod']."&opcion=encabezado&subopcion=".$_GET['subopcion']."&seccionmod=VANCE_SUZETTE"); ?>">VANCE SUZETTE</OPTION>
								<OPTION <?php if($frasecseccion=="CONTACTO"){ echo("SELECTED"); }?> value="<?php echo("?mod=".$_GET['mod']."&opcion=encabezado&subopcion=".$_GET['subopcion']."&seccionmod=CONTACTO"); ?>">CONTACTO</OPTION>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td>
						Titulo
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nmboton" id="nmboton" type="text" value="<?php print($frasecons); ?>">
					</td>
				</tr>
				<tr>
					<td>
						Descripci&oacute;n
					</td>
				</tr>
				<tr>
					<td>
						<INPUT name="nmbotonaut" id="nmbotonaut" type="text" value="<?php print($frasecaut); ?>">
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