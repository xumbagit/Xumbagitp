<?
if ($_SESSION['g_usuario']['acceso'] != 1){
	header('Location:index.php');
}

?><head>
<!--<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>-->
<!--<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>-->
<!--<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>-->
<!--<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>-->
<!--<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>-->
<!--<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>-->
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
      <!--<li class="TabbedPanelsTab" tabindex="0"><span class="icon3micuenta"></span><span class="textmicuenta">Balance P. y Certificación de Ingreso</span></li>-->
      <li class="TabbedPanelsTab" tabindex="3"><span class="icon4micuenta"></span><span class="textmicuenta">Configuración</span></li>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">   
      		<div id="contenedormicuenta">
             <div id="buscadorpormes">
            	<div id="fechamicuenta">Hoy, <!-- #BeginDate format:Sw1 -->19 Octubre, 2012<!-- #EndDate --></div>
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
				require_once('lib/function_gen.php');
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
            	<div id="fechamicuenta">Hoy, 25 de septiembre 2012</div>
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
     <!----------------------------------BALANCE PERSONALL------------------- 
     
     <div class="TabbedPanelsContent">
      		<div id="contenedormicuenta">
    <div id="buscadorpormes">
            	<div id="fechamicuenta">Hoy, 25 de septiembre 2012</div>
               <div id="inputmeses"></div>
               <div id="ordenarpor">Ordenar por:</div>
            <form action="envios.php" method="post" name="buscarmes">
                 <select name="mes" class="seleccionmicuentapedidos">
                        <option value="mes" selected="selected">todos los pedidos</option>
                         <option value="por_fecha">en transito</option>
                        <option value="pagados">pagados</option>
                        <option value="por_pagar">por pagar</option>
                        <option value="por_fecha">por fecha</option>
                        
                        </select>
                         <select name="tipobalance" class="seleccionmicuentacertificado">
                        <option value="tipobalance" selected="año">tipo</option>
                        <option value="balance_personal">Balance Personal</option>
                        <option value="balance_conyugal">Balance Conyugal</option>
                        <option value="certificacion_ingreso">Certificación de Ingreso</option>
                        
                        </select>
                       
                        
                    </form>
                    
            </div>
            
             <div id="contenedorcer">
           
           
            <div id="contenedor_subasta_micuenta2">
            
    <table width="650" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td colspan="12">
        	</td>
          </tr>
	      <tr class="fila_blanca_1ra">
	        <td colspan="12">
            <span class="celda_1ra">Pedidos de Balance Personal y Certificación de Ingreso
            </span>
            
            </td>
            
      </tr>
	      <tr class="fila_blanca">
          <span class="lineacuentacer"></span>
          <span class="lineacuentacer1"></span>
	         <td width="46px"><span class="valores2">Nro. de Orden</span></td>
            <td width="60px"><span class="valores2">Creado</span></td>
	        <td width="100px"><span class="valores2">Producto</span></td>
	        <td width="40px"><span class="valores2">Precio</span></td>
	        <td width="60px"><span class="valores2">Estado</span></td>
	        <td width="60px"><span class="valores2"></span></td>
	        
          </tr>
	      <tr class="fila_blanca">
           <td><span class="casillas">SDFJ53JDD</span></td>
	        <td><span class="casillas">13/05/2012</span></td>
	        <td><span class="casillas">Certificación de Ingreso</span></td>
	        <td><span class="casillas">800.00</span></td>
	        <td><span class="casillas"><span class="links"><a href="#">Por pagar</a></span></span></td>
	        <td><span class="casillas"><span id="eliminarmicuenta"><a href="#">eliminar</a></span></span></td>
	       
	        
          </tr>
	      <tr class="fila_gris">
	         <td><span class="casillas">SDFJ53JDD</span></td>
            <td><span class="casillas">13/06/2012</span></td>
	        <td><span class="casillas">Balance Personal</span></td>
	        <td><span class="casillas">500.00</span></td>
	        <td><span class="casillas">Completado</span></td>
	        <td><span class="casillas"></span></td>
          </tr>
           <tr class="fila_gris">
	         <td><span class="casillas">ERRFFVE4</span></td>
            <td><span class="casillas">16/07/2012</span></td>
	        <td><span class="casillas">Balance Conyugal</span></td>
	        <td><span class="casillas">500.00</span></td>
	        <td><span class="casillas">En transito</span></td>
	        <td><span class="casillas"></span></td>
          </tr>
	     
	      <tr class="fila_linea">
	        <td colspan="12"></td>
      </tr>
	      <tr class="fila_blanca_final">
	        <td colspan="12">
            <span class="celda_final_verde">
           	 ¿Tienes dudas? Resuélvelo ingresando a </span><span class="links"><a href="#">Preguntas Frecuentes</a>
             </span>
             </td>
          </tr>
        </table>
  </div>
  
  		
        
         
  </div>

  <!--------------------SI NO TIENES NINGUN BALANCE-----------
  <div id="contenedor_subasta_micuenta">
            <span class="celda_1ra">NO TIENE NINGUN BALANCE PERSONAL, NI CERTIFICACIÓN DE INGRESO</span>
            </span>
             </div>
             
             
             
  </div>
  </div>
  ---------------------------------------->
      <div class="TabbedPanelsContent">
      		<div id="contenedormicuenta">
      			<form action="action.php" method="post" >
                <br />
                <h5>Datos Personales</h5>
                <br />
                        <span id="nombreval">
                        <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
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
                            <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                            <div class="textfieldInvalidFormatMsg">(*) Formato no válido.</div>
                            <input name="nro_identificacion" type="text" class="relleno1micuenta" value="<?=$_SESSION['g_usuario']['id_usuario'];?>"/>
                            <br />
                            <br />
                            </span>
                           
                             <span id="telefono">
                          <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                          <span class="textfieldInvalidFormatMsg">(*) Formato no válido.</span>
                          <span class="textformulario">• Teléfono:</span>
                          <input name="telefono" type="text" size="40" class="rellenomicuenta"  value="<?=$_SESSION['g_usuario']['telefono'];?>"/>
                          </span>
                          <br />
                          <br />
                         
                          <span id="correo">
                          <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                          <span class="textfieldInvalidFormatMsg">(*) Formato no válido.</span>
                          <span class="textformulario">• Correo Electrónico:</span>
                          <input name="correo" type="text" size="40" class="rellenomicuenta" value="<?=$_SESSION['g_usuario']['correo'];?>"/>
                          <br />
                          <br />
                          </span>
                          <span class="textformulario">• Actividad que Realiza:</span>
                           <span id="selectactividad">
                           <div class="selectRequiredMsg">(*) Campo Obligarotio</div>
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
                        <div id="cambiodeclave">
                 
                          
                            <h5>Domicilio Fiscal</h5>
                         <br/>
                         <span class="textformulario">• Estado:</span>
                          <span id="estado">
                          <div class="selectRequiredMsg">(*) Campo Obligarotio</div>
                          <select name="estado" class="actividadrealiza">
                        <option value="">[Seleccione]</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Anzoátegui">Anzoátegui</option>
                        <option value="Apure">Apure</option>
                        <option value="Aragua">Aragua</option>
                        <option value="Barinas">Barinas</option>
                        <option value="Bolívar">Bolívar</option>
                        <option value="Carabobo">Carabobo</option>
                        <option value="Cojedes">Cojedes</option>
                        <option value="Delta Amacuro">Delta Amacuro</option>
                        <option value="Distrito Capital">Distrito Capital</option>
                        <option value="Falcón">Falcón</option>
                        <option value="Guárico">Guárico</option>
                        <option value="Lara">Lara</option>
                        <option value="Mérida">Mérida</option>
                        <option value="Miranda">Miranda</option>
                        <option value="Monagas">Monagas</option>
                        <option value="Nueva Esparta">Nueva Esparta</option>
                        <option value="Portuguesa">Portuguesa</option>
                         <option value="Sucre">Sucre</option>
                        <option value="Táchira">Táchira</option>
                        <option value="Trujillo">Trujillo</option>
                        <option value="Vargas">Vargas</option>
                        <option value="Yaracuy">Yaracuy</option>
                        <option value="Zulia">Zulia</option>
                        </select>
                        </span>
                        <br /><br />
                        <span class="textformulario">• Municipio:</span>
                        <span id="municipio">
                        <div class="selectRequiredMsg">(*) Campo Obligarotio</div>
                        <select name="municipio" class="actividadrealiza">
                        <option value="">[Seleccione]</option>
                        <option value="Baruta">Baruta</option>
                        <option value="Chacao">Chacao</option>
                        <option value="Hatillo">Hatillo</option>
                        <option value="Libertador">Libertador</option>
                        <option value="Sucre">Sucre</option>
                        </select>
                        </span>
                		<br /><br />
                         <span class="textformulario">• Parroquia:</span>
                          <span id="parroquia">
                          <div class="selectRequiredMsg">(*) Campo Obligarotio</div>
                          <select name="parroquia" class="actividadrealiza">
                        <option value="">[Seleccione]</option>
                        <option value="La Candelaria">La Candelaria</option>
                        <option value="Altagracia">Altagracia</option>
                        <option value="Antimano">Antimáno</option>
                        <option value="Coche">Coche</option>
                        <option value="Sucre">Sucre</option>
                        </select>
                        </span>
                		<br /><br />
                        <span id="calle">
                        <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                        <span class="textformulario">• Calle / Avenida:</span><input name="calle" type="text" size="40" class="rellenomicuenta1" value="<?=$_SESSION['g_usuario']['calle_ave'];?>"/>
                        <br /><br />
                        </span>
                        <span id="casa">
                        <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                        <span class="textformulario">• Edificio / Casa:</span><input name="casa" type="text" size="40" class="rellenomicuenta1" value="<?=$_SESSION['g_usuario']['edif_casa'];?>"/>
                        </span>
                        <br /><br />
                          </div>
                          
                          <br /><br />
                                   <h5>Cambiar Clave</h5>
                          <br />
                           <span id="clave">
                           <div class="textfieldRequiredMsg">(*) Campo Obligarotio</div>
                           <span class="textformulario">• Clave Vieja:</span><input name="clave" type="password" size="40" class="rellenomicuenta" />
                           <br /><br />
                   </span>
                         
                          <span id="confirmarclave">
                           <div class="confirmRequiredMsg">(*) Campo Obligarotio</div>
                           <div class="confirmInvalidMsg">(*) Valor debe ser igual al campo clave</div>
                                               
                           <span class="textformulario">• Clave Nueva:</span>
                           <input name="confirmarclave" type="password" size="40" class="rellenomicuenta" />
                          <br /><br />
                          </span>
                          <span class="textformulario">• Repetir Clave Nueva:</span>
                           <input name="confirmarclave" type="password" size="40" class="rellenomicuenta" />
                           <br /><br />
                         
                         
                           
                      
                         <input type="submit" value="cambiar" class="botoninput" />
            
            
            
            
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



                          
  