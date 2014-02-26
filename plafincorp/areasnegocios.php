<table>
	<tr>
		<td style="position: relative;border:0px transparent;vertical-align: top;margin-top: 0px;">
<div class="titulo_modulo" style="width: 555px; border:0px transparent;margin-top: 0px;">
	<p>AREAS DE NEGOCIOS</p>
</div>
<div style="position:relative; margin: 0px auto;">
<div class="content_modulo" style="border:0px transparent;">
	<div id="botonesdentro">
		<table>
			<tr>
				<?php
					if($_GET['sm']=='ic'){
						?>
				<td class="boton_ic_alter" onclick="location.href='index.php?mod=areasnegocios&sm=ic';">
					<a href="index.php?mod=areasnegocios&sm=ic">

					</a>
				</td>
						<?php
					}
					else{
						?>
				<td class="boton_ic" onclick="location.href='index.php?mod=areasnegocios&sm=ic';">
					<a href="index.php?mod=areasnegocios&sm=ic">

					</a>
				</td>
						<?php						
					}
					
					if($_GET['sm']=='ii'){
						?>
				<td class="boton_ii_alter" onclick="location.href='index.php?mod=areasnegocios&sm=ii';">
					<a href="index.php?mod=areasnegocios&sm=ii">
						
					</a>					
				</td>
						<?php
					}
					else{
						?>
				<td class="boton_ii" onclick="location.href='index.php?mod=areasnegocios&sm=ii';">
					<a href="index.php?mod=areasnegocios&sm=ii">
						
					</a>					
				</td>
						<?php			
					}
					
					if($_GET['sm']=='pt'){
						?>
				<td class="boton_pt_alter" onclick="location.href='index.php?mod=areasnegocios&sm=pt';">
					<a href="index.php?mod=areasnegocios&sm=pt">
						
					</a>
				</td>
						<?php
					}
					else{
						?>
				<td class="boton_pt" onclick="location.href='index.php?mod=areasnegocios&sm=pt';">
					<a href="index.php?mod=areasnegocios&sm=pt">
						
					</a>
				</td>
						<?php			
					}
					
					if($_GET['sm']=='ot'){
						?>
				<td class="boton_ot_alter" onclick="location.href='index.php?mod=areasnegocios&sm=ot';">
					<a href="index.php?mod=areasnegocios&sm=ot">
					</a>
				</td>						
						<?php
					}
					else{
						?>
				<td class="boton_ot" onclick="location.href='index.php?mod=areasnegocios&sm=ot';">
					<a href="index.php?mod=areasnegocios&sm=ot">
					</a>
				</td>
						<?php			
					}
					
					if($_GET['sm']=='alt'){
						?>
				<td class="boton_alt_alter" onclick="location.href='index.php?mod=areasnegocios&sm=alt';">
					<a href="index.php?mod=areasnegocios&sm=alt">
						
					</a>
				</td>
						<?php
					}
					else{
						?>
				<td class="boton_alt" onclick="location.href='index.php?mod=areasnegocios&sm=alt';">
					<a href="index.php?mod=areasnegocios&sm=alt">
						
					</a>
				</td>
						<?php						
					}
				?>
			</tr>
		</table>
	</div>
	<div class="clastexto">
		<?php
		
		if($_GET['sm']=="ic"){
			?>
<h1>Impuestos Corporativos</h1> 
<ul>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Atención a las consultas sobre las implicaciones tributarias que se derivan de las operaciones de la compañía.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Determinación de los efectos fiscales en procesos de fusión, compra o restructuración de compañías.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Evaluación de la razonabilidad de la tasa efectiva de impuesto.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Preparación o revisión de sus declaraciones de impuesto sobre la renta (ISLR), impuesto al valor       agregado (IVA), impuesto a las actividades económicas (IPIC), contribuciones parafiscales (INCES, SSO, RPVH, LOCTI, LOCTISEP).
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Revisión de deberes formales en materia de Retenciones de ISLR, IVA y Ordenanzas de Impuestos sobre actividades económicas.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Asistencia en el cálculo del impuesto diferido.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Cálculo de contingencias fiscales.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Asistencia en la determinación o revisión de los efectos fiscales en la preparación de modelos financieros.
	</li>
	
</ul>
<?php
		}
		if($_GET['sm']=="ii"){
			?>
			<h1>
				Impuestos Internacionales
			</h1>
			<ul>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
					Análisis de las implicaciones fiscales de operaciones realizadas con compañías extranjeras relacionadas.		
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
					Asistencia en la interpretación y aplicación de tratados para tevitar la doble tributación.
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
					Asesoría en procesos de restructuración internacional.
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
					Evaluación de operaciones en jurisdicciones de baja imposición fiscal (paraísos fiscales).
				</li>
			</ul>
<?php
		}
		
		if($_GET['sm']=="pt"){
			?>
			<h1>
				Precios de Transferencias
			</h1>
			<ul>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
Análisis de las implicaciones fiscales, así como de la razonabilidad de la gerencia tributaria relacionada con operaciones realizadas con compañías extranjeras.					
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
Preparación o revisión del estudio y la documentación soporte de los ingresos, costos y gastos producto de operaciones realizadas con compañías extranjeras vinculadas.					
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
Preparación o revisión de la declaración informativa (PT-99).					
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
Asesoramiento en Procesos de Fiscalización en Materia de Precios de Transferencia.					
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
Desarrollo de Cursos y Capacitación In-House.					
				</li>
	<br>
				<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
					Acceso a las bases de datos utilizadas a nivel mundial.
				</li>
			</ul>
<br>
<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">

</p>
			<?php
		}
		if($_GET['sm']=="ot"){
			?>
<h1>Otros Tributos</h1>
<ul>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Evaluación de proyectos considerados deducibles a los fines del cumplimiento del aporte exigido en la Ley Orgánica de Ciencia y Tecnología e Innovación y Ley Orgánica contra el tráfico ilícito de Estupefaciente y Sustancia Psicotrópicas.
	</li>
	<br>
	<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
		Preparación de la declaración informativa establecida en la Ley Orgánica de Ciencia y Tecnología e Innovación y Ley Orgánica contra el tráfico ilícito de Estupefaciente y Sustancia Psicotrópicas.
	</li>
</ul>
			<?php
		}
		if($_GET['sm']=="alt"){
			?>
				<h1>
					Asesoria Legal Tributaria
				</h1>
				<ul>
					<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
						Realización de escritos y asesoría técnica tributaria para la defensa de los intereses de nuestros clientes relacionados a requerimientos exigidos por las Administraciones Tributaria Nacionales y Municipales.
					</li>
	<br>
					<li style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
						Nuestro servicio incluye el seguimiento de las causas en todas las instancias, abarcando todo tipo de acciones y recursos ante Tribunales de la Republica, Tribunales Contenciosos Tributarios y el Tribunal Supremo de Justicia.
					</li>
				</ul>
			<?php
		}
		?>
	</div>
<div style="clear:both;"></div>
</div>
</div>

		</td>
		<td style="width: 90px;border:0px transparent;">
			
		</td>
		<td style="position: relative;border:0px transparent;vertical-align: top;margin-top: 0px;">
			<div style="margin-top: 0px;">
	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 3,
  interval: 30000,
  width: 300,
  height: 370,
  theme: {
    shell: {
      background: '#F68B00',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#000000',
      links: '#F68B00'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: false,
    behavior: 'default'
  }
}).render().setUser('@Plafincorp').start();
</script>
			</div>			
		</td>
	</tr>
</table>