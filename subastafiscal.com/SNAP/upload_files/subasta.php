<?
require_once('lib/function_gen.php');
?>
	<div id="separador1">
        <span class="hoy"> <?=fnc_getfecha();?>
        </span>
	</div>
  <div id="contenedor_subasta2">
  <div id="bolsa"></div>
    <table width="656" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td colspan="12">
           <div id="pestana"><h6>Subasta de Valores Fiscales</h6><span id="boton-prev"><a href="#"><<</a></span>
            <span id="boton-next"><a href="#">>></a></span>
        	</div></td>
          </tr>
	      <tr class="fila_blanca_1ra">
	        <td colspan="12">
            <span class="celda_1ra">¡Participa ahora! creando tu propia Oferta<span class="boton_vender"><a href="javascript:getSUBID(2,0);">Vender Crédito Fiscal</a></span>
            </span>
            
            </td>
            
      </tr>
	      <tr>
	        <td width="45px"><span class="valores2">Nro.<br />Ref.</span></td>
	        <td width="84px"><span class="valores2">Valor<br />Nominal</span></td>
	        <td width="84px"><span class="valores2">Monto<br />Disponible</span></td>
	        <td width="62px"><span class="valores2">Auditoría<br />Externa</span></td>
	        <td width="60px"><span class="valores2">Período Uso</span></td>
	        <td width="57px"><span class="valores2">Origen</span></td>
	        <td width="62px"><span class="valores2">Agentes<br />Retención</span></td>
	        <td width="50px"><span class="valores2">Precio <br />Base %</span></td>
	        <td width="50px"><span class="valores2">MPO %</span></td>
	        <td width="49px"><span class="valores2">Vence<br>(días)</span></td>
	        <td width="53px"><span class="valores2"></span></td>
          </tr>
          <? 
			
			$retorno = fn_subasta_general(15,'WHERE dias_vence > 0 ');
			fncv_mostrar_situacionSubasta($retorno);
		  ?>
          
	     
  <tr class="fila_linea">
	        <td colspan="12"></td>
      </tr>
	      <tr class="fila_blanca_final">
	        <td colspan="12">
            <span class="celda_final_verde">
           	 ¿Tienes dudas? Resuélvelo ingresando a </span><span class="links"><a href="#">Preguntas Frecuentes</a></span>
             </td>
          </tr>
        </table>
  </div>
  <div id="banner3">
   		 <a href="javascript:getSUBID(12,0);" target="_self">
         <img src="img/banner_balance.png" width="300" height="224" border="0" />
         </a>
  </div>
      <div id="banner3"><a href="index.php?webpage=14" target="_self"><img src="img/banner_biblioteca.png"  border="0" /></a></div>
        <div id="separador">
        </div>
        

