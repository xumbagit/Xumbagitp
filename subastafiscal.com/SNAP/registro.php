<?php
	require_once('lib/functions.php');
	require_once('conf/config.conf.php');
	require_once('lib/op_mysql.class.php');
	$dbn    = new op_mysql();
	$dbn->ConectarBD(USUARIO_BD,CLAVE_BD,SERVIDOR_BD,NOMBRE_BD);
?>
<head>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
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
<script type="text/javascript">
var redirecwait;

function redirectPage(){
	clearTimeout(redirecwait);
	document.location.href = "index.php";
}

$(document).ready(function(){
	$("#registroform").validate({
		submitHandler: function(form) 
		{
         	
			var direccionurl = $(form).attr('action');
			var varfield     = $(form).serialize();
			
			var request = $.ajax({
			type: "POST",
			data: varfield ,
			dataType:"json",
			url:direccionurl,
			success: function(data){
				$.each(data,function(index,value) {
					if (data[index].sesActiva != '0'){
							$("#ventana").html( data[index].sesHtml );
							mostrar_popup('ventana',1);
					}
					else{
						$("#ventana").html( data[index].sesHtml );
						mostrar_popup('ventana',0);
						redirecwait = setTimeout('redirectPage()',3000);
								
					}
				});
			},
			fail:function(jqXHR, textStatus) { 
			alert( "Request failed: " + textStatus ); 
			}
						
		});	
			
   		}
	});

 });
 
 

</script>
</head>
<div id="separador3">
</div>
	<div id="contenedorformulario">
    	<div id="pestanaformulario">Registro de Usuario
        </div>
        	<div id="contenedorinput">
            	<br>
                <form action="registro-action.php" method="post" name="registroform" id="registroform">
                <center>
                <table border="0" width="600px">
                <tr height="40px">
                <td align="left" width="300px"><span class="textformulario">Tipo de Persona:</span></td>
                <td align="left" width="300px">
                <select name="tipo_persona" class="seleccion" onchange="select_tipopersona(this.value);" id="tipo_persona">
                <option value="N">Natural</option>
                <option value="J">Juridica</option>
                </select>
                </td>
                </tr>
                <tr height="40px">
                <td align="left" width="300px"><span class="textformulario" id="nombre">Nombre Completo:</span></td>
                <td align="left" width="300px"><input name="nombre" type="text" value="" class="relleno"  accept="required" /></td>
                </tr>
                <tr height="40px">
                <td align="left" width="300px"><span class="textformulario" id="cedula">Cédula:</span></td>
                <td align="left" width="300px">
                <span id="tipoidentificacion">
               <select name="nacionalidad" class="seleccion1">
                <option value="V" selected >V</option>
                <option value="E">          E</option>
                </select>
                </span>
                <input name="nro_identificacion" type="number" class="relleno1" accept="required"/>
               
			    </td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Correo Electrónico:</span></td>
                <td width="300px" align="left"><input name="correoreg"  type="email" size="40"  accept="required email" class="relleno"/></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Clave:</span></td>
                <td width="300px" align="left"><input name="clave" id="clave" type="password"  size="40" class="relleno" accept="required"/></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Confirmar Clave:</span></td>
                <td width="300px" align="left"><input name="confirmarclave" id="confirmarclave" type="password" size="40" class="relleno" accept="required" equalTo="#clave"  /></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Teléfono:</span></td>
                <td width="300px" align="left"><input name="telefono" type="number" size="40" class="relleno" accept="required"/></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Actividad que Realiza:</span></td>
                <td width="300px" align="left">
                <select name="actividad" class="domicilio" accept="required">
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
                </td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span id="tipocontribuyentename" ></span></td>
                <td width="300px" align="left"><span id="tipocontribuyentevalor" ></span></td>
                </tr>
                <tr height="20px">
                <td width="300px" colspan="2" align="left"><h5>Domicilio Fiscal</h5></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Estado:</span></td>
                <td width="300px" align="left">
                
                <?php
					if($dbn->QuerySQL("SELECT * FROM estados")==0){
						//echo("HOLA");echo(USUARIO_BD);
						//echo($dbn->getFilas());
						if($dbn->getFilas()>0){
							//echo("HOLA");
							/*getData obtiene informacion de la consulta */
							$datasql=$dbn->getAllData();
							fncv_selectInput($valor,'domicilio','id="estado" accept="required" onchange="cambiaSelect(this.value,\'selectmunicipio\',7)"','estado',$datasql);
						}
					}
				?>
                </td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Municipio:</span></td>
                <td width="300px" align="left">
                <span id="selectmunicipio">
                <select name="municipio" class="domicilio" accept="required">
                <option value="">[Seleccione]</option>
                </select>
                        
                </span>
                </td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Parroquia:</span></td>
                <td width="300px" align="left">
                <span id="selectparroquia">
                <select name="parroquia" class="domicilio" accept="required">
                <option value="">[Seleccione]</option>
                </select>
                </td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Calle / Avenida:</span></td>
                <td width="300px" align="left"><input name="calle_ave" type="text" size="40" class="relleno" accept="required"/></td>
                </tr>
                <tr height="40px">
                <td width="300px" align="left"><span class="textformulario">Edificio / Casa:</span></td>
                <td width="300px" align="left"><input name="edif_casa" type="text" size="40" class="relleno" accept="required"/></td>
                </tr>
                <tr height="40px">
                <td width="300px" colspan="2" align="left"><h5>Servicios de Interés</h5></td>
                </tr>
                <tr height="40px">
                <td width="300px" colspan="2" align="left">
				<?php fncv_mostrar_servicio(0); ?>
                </td>
                </tr>
                <tr height="60px">
                <td width="300px" colspan="2" align="left">
				<span class="textcheckbox">Acepto los</span> 
                <span class="terminos">
                <a href="index.php?webpage=20" target="_blank">Términos y Condiciones</a>
                </span> 
                <input type="checkbox" class="box"  name="terminos_condiciones" accept="required"/>
                
                </td>
                </tr>
                <tr height="60px">
                <td width="300px" colspan="2"><input type="submit" value="registrar" class="botoninput" /></td>
                </tr>
                </table>
                </center>
                            
 </form>
 </div>
</div>
<div id="separador">
</div> 

<script type="text/javascript">
select_tipopersona('N');
</script>
