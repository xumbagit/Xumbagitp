<table style="position: relative;z-index: 6;border: 0px;">
	<tr>
		<td style="position: relative;z-index: 6;border: 0px;">

<div class="titulo_modulo" style="width: 550px; border:0px transparent;">
		<p>
			<?php
				if($_GET['sm']=="qsomos"){
					echo("QUIENES SOMOS");
				}
				else{
					echo("DIRECTORES");
				}
			?>
		</p>
</div>
<div class="content_modulo" style="position:relative; border:0px transparent;z-index: 200000;">
		<?php
			if($_GET['sm']=="qsomos"){
				?>
					<p>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Somos una organización de asesores de carácter multidisciplinario que busca satisfacer las necesidades directas de nuestros clientes relacionadas con las operaciones estratégicas en el área financiera, ayudándolos a mitigar los riesgos, planificar las cargas fiscales y en definitiva a gerenciar los negocios de nuestros clientes con valor agregado.<br><br>
							Colaboramos y compartimos el conocimiento, capitalizando nuestra experiencia colectiva para proporcionar asesoría  tributaria de alta calidad y a la medida de las necesidades de nuestros clientes, ayudándolos a aliviar las presiones asociadas con la toma de decisiones financiera y fiscales complejas asegurándonos que nuestros clientes se adhieran tanto a la mejor práctica como a las leyes fiscales.<br><br>
							Plafincorp es una organización independiente de firmas de auditoria por lo cual quedamos libres de los conflictos de interés generados por los controles profesionales que presentan en su actualidad las cuatro importantes firmas de auditores optimizando así la prestación de servicios y evitando pérdida de tiempo.<br><br>
						</p>
						
						<h1>
							Misión
						</h1>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Ofrecer a  nuestros clientes nacionales y multinacionales servicios de consultoría tributaria altamente especializada, con un trato directo y preferencial. Este trato preferencial se realizará mediante una estructura organizacional especializada por sector de negocios, con la finalidad de permitir que nuestros clientes  y relacionados puedan lograr una eficiente gestión fiscal en sus operaciones, sin incurrir en conflictos de independencia con servicios de auditoria externa.
						</p>
						
						<h1>
							Visión
						</h1>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Posicionarnos como la empresa de consultoría tributaria, reconocida por su trato directo, preferencial, con los estándares más modernos, eficientes y actuales en la prestación de servicios fiscales a clientes nacionales y multi nacionales.
						</p>
						
						<h1>
							Valores
						</h1>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Profesionalismo y trabajo en equipo<br>
							Somos un equipo multidisciplinario comprometido con sus objetivos laborales,  con los más altos estándares de calidad, especialización, innovación y con el firme propósito de crear valor a nuestros clientes.
						</p>
						
						<h1>
							Integridad y Liderazgo
						</h1>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Les ofrecemos a nuestros clientes el apoyo, responsabilidad y mística de trabajo, de un grupo de profesionales responsables, calificados y comprometidos con los más altos valores éticos.
						</p>
						
						<h1>
							Relaciones de largo plazo
						</h1>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Construimos relaciones de largo plazo con nuestros clientes y entre nosotros mismos, a través del apoyo oportuno y con valor agregado.
						</p>
					</p>
		<?php
			}
			else{
				?>
					<p>
						<h1 style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Nicolas Bianco
						</h1>
						<p>
							Presidente	
						</p>
						<p>
							Economista egresado de la UCV	
						</p>
						<p>
							Nbianco@subastafiscal.com
						</p>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Presidente de la Junta Directiva de la empresa, posee amplia experiencia y prestigio en el mercado de valores fiscales, lo que ha permitido que nuestra firma, sea Líder en el Área Financiera e Impositiva, proyectando nuevos conocimientos e innovación en el mundo tributario, logrando consolidar la confianza en la racionalización de los impuestos de nuestros clientes.
						</p>
						<p style="position:relative; border:0px transparent;z-index: 200000;font-family: Arial, Helvetica, sans-serif; font-weight: normal;">
							Desde sus inicios en el mercado de valores fiscales, ha participado como trader formador de precios, hoy en día es una referencia en las transacciones que se realizan en los mercados llamados over the counter o mercados secundarios en el mercado Venezolano.
						</p>
					</p>				
				<?php				
			}
		?>	
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