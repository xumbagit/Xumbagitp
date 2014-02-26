<?
include_once('lib/functions.php');
?>
<head>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script src="js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<style type="text/css">
label.error { 
width:auto;
display:inline-block;
height:auto;
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
font-size:11px;
font-weight:bold;
color:#F00;
position:absolute;
right:50px;

}
</style>
<? if (isset($_SESSION['reg-subasta'])){?>
	<script type="text/javascript">
		$("#ventana").html('<? echo $_SESSION['reg-subasta'][0]['sesHtml'];?>');
		 mostrar_popup('ventana',1);
	</script>

<? unset($_SESSION['reg-subasta']);} ?>

<script type="text/javascript">

var redirecwait;
function redirectPage(){
	clearTimeout(redirecwait);
	document.location.href = "index.php?webpage=2";
}


$(document).ready(function(){
	$("#ofertaform").validate();
	
 });
 

var a = 0;
$('.relleno2').live('change',function() {
		//Input Actual
		var idimagen   = 'img-'+ a; 
      	var valorid    = $('input[id *= img-]').attr("id");
		var valorname  = $('input[id *= img-]').attr("value"); 
		var nombrefile = valorname.split("\\").reverse();
		
			
		$('.relleno2').appendTo('#dataimg').removeClass('relleno2');
	   	$('#fromimg').append('<input type="file" name="imagensf[]" id="'+ idimagen +'" class="relleno2">');
		
		var strclass = 'fila_gris';
		if ( a%2 == 0){
			strclass = 'fila_blanca';
		}
		codHtml  = '<tr class="'+ strclass +'" id="tr-'+valorid+'">';
    	codHtml += '<td><span class="casillas_archivo">'+ nombrefile[0] +'</span></td>';
    	codHtml += '<td><span id="eliminar"><a href="javascript:removerImg(\'' + valorid + '\')">eliminar</a></span></td>';
  		codHtml += '</tr>';

	
		$('#tablaImagen').append(codHtml);
		
		a++;
			
  });
  
  
function removerImg(seleccion){
	$('#'+seleccion).remove();
	$('#'+'tr-'+seleccion).remove();

} 

</script>


<div id="separador3"></div>
	<div id="contenedorformulario">
    	<div id="pestana2">Venta de Crédito Fiscal
        </div>
        	<div id="contenedorinput">
        	<form action="registro-subasta-action.php" method="post" id="ofertaform"  enctype="multipart/form-data">
            <center>
            <table border="0" width="600px">
            <tr height="60px">
            <td width="300px" colspan="2" align="left"><h5>Datos Generales de Solicitud</h5></td>
            </tr>
            <tr height="40px">
            <td align="left" width="300px"><span class="textformulario">• Alias para la Oferta:</span></td>
            <td align="left" width="300px"><input name="alias_ofertavalor" type="text"  class="relleno" accept="required"/></td>
            </tr>
            <tr height="40px">
            <td align="left" width="300px"><span class="textformulario">• Breve Descripción:</span></td>
            <td align="left" width="300px"><textarea name="descripcion_oferta" wrap="soft" class="relleno_textarea"  accept="required" ></textarea></td>
            </tr>
            </table>
            <br>
            <div id="lineag"></div>
            
            <table border="0" width="600px">
            <tr height="60px">
            <td width="300px" colspan="2" align="left"><h5>Datos de Valor Fiscal</h5></td>
            </tr>
            <tr height="40px">
            <td align="left" width="300px" > 
            <span class="textformulario">• Origen del Valor:</span> </td>
            <td align="left" width="300px">
            <select name="origenvalor" class="domicilio" accept="required">
            <option value="">[Seleccione]</option>
            <option value="DocumentoConstitutivo">Documento Constitutivo</option>
            <option value="RelacionDeComprobante">Relacion de Comprobante</option>
            </select>
            </td >
            </tr>
            <tr height="40px">
            <td  align="left" width="300px" > <span class="textformulario">• Valor Nominal (Bs.F):</span> </td>
            <td  align="left" width="300px" > <input name="valor_nominal" type="number" size="40" class="relleno" accept="required"/> 
            </td>
            </tr>
            <tr height="40px">
            <td  align="left" width="300px" ><span class="textformulario">• Monto Disponible (Bs.F):</span></td>
            <td  align="left" width="300px" ><input name="monto_disponible" type="number" size="40" class="relleno" accept="required"/> 
            </td>
            </tr>
            <tr height="40px">
            <td  align="left" width="300px" ><span class="textformulario">• Auditoría Externa:</span></td>
            <td  align="left" width="300px" >
            <select name="auditoria_externa" class="domicilio" accept="required">
            <option value="">[Seleccione]</option>
            <option value="LOCAL">LOCAL</option>
            <option value="BIG5">BIG5</option>
            <option value="AAA">AAA</option>  
            </select> 
            </td>
            </tr>
            <tr height="40px">
            <td  align="left" width="300px" ><span class="textformulario">• Periodo de Uso:</span></td>
            <td  align="left" width="300px" >
            <select name="periodo_uso_mes" class="mes" accept="required">
            <option value="">[mes]</option>
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
          
          <select name="periodo_uso_ano" class="ano" accept="required">
        <option value="">[año]</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        </select>
		 </td>
         </tr>
         <tr height="40px">
        <td  align="left" width="300px" ><span class="textformulario">• Precio Base %:</span></td>
        <td  align="left" width="300px" ><input name="precio_baseval" type="number" size="40" class="relleno_corto" accept="required" /></td>
        </tr>   
        </table>
        <br>
        <div id="lineag"></div>
               
        <table border="0" width="600px">
        <tr height="60px">
        <td width="600px" colspan="2" align="left"><h5>Archivos que avalen la solicitud</h5></td>
        </tr>
        <tr height="40px">
        <td align="left" width="122px"><span class="textformulario">• Tipo de Documentación:</span></td>
        <td align="left" width="300px">
         <span id="selecdocum">
          <select name="tipodocumento" class="activoscirculante" accept="required">
          <option value=""  >[Seleccione tipo]</option>
          </select>
         </span>  
        </td>
        </tr>
        <tr height="40px">
        <td align="left" width="122px"><span class="textformulario">• Elegir Documento:</span></td>
        <td align="left" width="300px">
        <div id="fromimg">
		<input type="file" name='imagensf[]' id="img-" class="relleno2">
		</div>
        </td>
        </tr>
        </table>
		
    	<br>
        <div id="pestanabalance" style="width:360px;">Resumen de Documentos Adjuntados</div>
        <div id="dataimg" style="display:none"></div>
        <table width="360px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" id="tablaImagen" >
        <tr class="fila_blanca_balance">
        <td width="300px"><span class="valores_archivo">Archivo</span></td>
        <td width="60px"><span class="valores"></span></td>
        </tr>
        <tr class="fila_linea">
        <td colspan="2"></td>
        </tr>
        </table>

        <br>   
            
            <br>
            <input type="submit" value="crear" class="botoninput" />
            <br> 
            <br>
            <div id="lineag"></div>
            <span class="celda_final_verde">
            ¿Tienes dudas? Resuélvelo ingresando a <span class="links"><a href="#">Preguntas Frecuentes</a></span>
            </span>
            <br /><br />
      </center>                          
 </form>
</div>
</div>
<div id="banner3">
<a href="index.php?webpage=4" target="_self">
<img src="img/banner_balance.png" width="300" height="224" border="0" />
</a>
</div>
<div id="banner3"><a href="index.php?webpage=14" target="_self"><img src="img/banner_biblioteca.png" width="300" height="224" border="0" /></a></div>
<div id="separador">
</div>

