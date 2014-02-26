<?php 
session_start();
//REVISAR PAGINA COMPLETA MANANA
	$conexion=mysql_connect('localhost','programmer','Xumba123');
	if($conexion){
		$seleccionar=mysql_select_db("db_plafincorp");
		mysql_query("SET NAMES 'utf8'");
	}
	
if($_POST['calcularfecha']=='true'){
		$txt=$_POST['txtbox'];
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$mesesing = array("January","February","March","April","May","June","July","August","September","October","November","December");
		?>
				<table>
					<thead>
						<th class="celdacalendar">Dom</th>
						<th class="celdacalendar">Lun</th>
						<th class="celdacalendar">Mar</th>
						<th class="celdacalendar">Mie</th>
						<th class="celdacalendar">Jue</th>
						<th class="celdacalendar">Vie</th>
						<th class="celdacalendar">Sab</th>
					</thead>
					<?php 
					
						
// fecha actual (por ejemplo 2005-08-03)
	$meslet=$_POST['mescalc'];
	for($i=0;$i<=11;$i++){
		if($meses[$i]==$meslet){
			$mesn=$i+1;
			break;
		}
	}
	$anio=$_POST['aniocalc'];
	$month=(int)$mesn;
	$year=(int)$anio;
	$diasmes=date('t', mktime(0,0,0, $month, 1, $year));
	$array_date = getdate(mktime(0, 0, 0, $month, 1, $year));
	$first_week_day = $array_date["wday"];
					?>
					<tbody>
						<tr>
						<?php
							$dx=1;
							$control=0;
							
							if($first_week_day>=1){
								for($i=1;$i<=$diasmes;$i++){
									if($i<($first_week_day+1)){
										echo("<td class=\"celdacalendar\"></td>");
										$control++;
									}
								}
							}
							elseif($first_week_day==1){
								$control=0;
							}
							$c='celda';
							for($i=1;$i<=$diasmes;$i++){
								$fechacurso=$anio."-".$month."-".$i;
								if($control==6){
									$sqlsel12="SELECT fecha FROM cursos WHERE fecha='$fechacurso'";
									$pedidosel12=mysql_query($sqlsel12,$conexion);
									if($pedidosel12){
										$filassel=mysql_num_rows($pedidosel12);
										if($filassel>0){
											echo("<td class=\"celdacalendar_sub\" onclick=\"mostrar_evento('$fechacurso');\">".$dx."</td>");
										}
										else{
											echo("<td class=\"celdacalendar\">".$dx."</td>");
										}
									}
									echo("</tr>");
									echo("<tr>");
									$dx++;
									$control=0;
								}
								else{
									$sqlsel12="SELECT fecha FROM cursos WHERE fecha='$fechacurso'";
									$pedidosel12=mysql_query($sqlsel12,$conexion);
									if($pedidosel12){
										$filassel=mysql_num_rows($pedidosel12);
										if($filassel>0){
											echo("<td class=\"celdacalendar_sub\" onclick=\"mostrar_evento2('$fechacurso');\">".$dx."</td>");
										}
										else{
											echo("<td class=\"celdacalendar\">".$dx."</td>");
										}
									}
									$dx++;
									$control++;
								}
							}
						?>
					</tbody>
				</table>
		<?php
	}

if($_POST['calcularevento']=='true'){
	$fechacurso=$_POST['fecha'];
	$sqlsel="SELECT * FROM cursos WHERE fecha='$fechacurso'";
	$pedidosel=mysql_query($sqlsel,$conexion);
	if($pedidosel){
		$filassel=mysql_num_rows($pedidosel);
		if($filassel>0){
			$datoscurso=mysql_fetch_array($pedidosel);
			$nombre=$datoscurso['nombre'];
			$descripcion=$datoscurso['descripcion'];
			?>
			<div id="myModal" class="reveal-modal small">
				<h1><?php echo($nombre); ?></h1>
				<p><?php echo($descripcion); ?></p>
				<a class="close-reveal-modal" onclick="ocultar('myModal');">&#215;</a>
			</div>
			<?php
		}
		else{
			echo($fechacurso);
		}
	}
}
?>