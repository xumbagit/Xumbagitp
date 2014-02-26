<?
include_once('lib/function_gen.php');
?><head>
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
right:10px;

}
</style>
<script type="text/javascript">
var redirecwait;

function redirectPage(){
	clearTimeout(redirecwait);
	document.location.href = "index.php";
}

$(document).ready(function(){
	$("#formcontacto").validate({
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
				//alert(data);
				$.each(data,function(index,value) {
					if (data[index].sesActiva != '0'){
							$("#ventana").html( data[index].sesHtml );
							mostrar_popup('ventana',1);
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

<!--
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
-->

<div id="separador4">
<span class="slogan bold">Visítanos</span>
<div id="texto2">Podrá ubicarnos a nivel nacional en la oficina de su cercanía, seleccionado los puntos en el mapa de Venezuela.</div>



</div>
<div id="mapa">
	<div id="punto1"><a href="punto1.html" target="iframe"></a></div>
    <div id="punto2"><a href="punto2.html" target="iframe"></a></div>
    <div id="punto3"><a href="punto3.html" target="iframe"></a></div>
    <div id="punto4"><a href="punto4.html" target="iframe"></a></div>
    <div id="punto5"><a href="punto5.html" target="iframe"></a></div>
    <div id="punto6"><a href="punto6.html" target="iframe"></a></div>
    
	<div id="cuadro">
    <iframe id="iframe" name="iframe"  src="punto4.html" class="iframe" width="214" height="158" frameborder="0" scrolling="no">
    </iframe>
	</div>
</div>
<div id="contacto1">
	<div id="tel"></div>
	<span id="pestana"><h6>Comunícate ahora</h6></span>
 
	<div id="contenedorinput2">
    <span class="celda_1ra" ><b>MASTER:</b> (+58) 212. 750.5416/ 5400</span>        
    <br />
    <form action="contacto-action.php" method="post" name="formcontacto" id="formcontacto">
                <br />
                	<span id="nombreval">
                		
               			<span class="textformulario2" id="nombre">Nombre:</span><input name="nombre" type="text" size="40" class="relleno_corto2"  accept="required" />
                    </span>
                    <br /><br />
                    <span id="camp_apellido">
                        <span class="textformulario2">Apellido:</span><input id="apellido" name="apellido"  type="text" value=""class="relleno_corto2" accept="required"/>
                    </span>
                		<br /><br />
               <span id="correo">
                         <span class="textformulario2">Correo:</span>
                          <input name="correo" type="text" size="40" class="relleno_corto2" accept="required email"/>
               </span>
               <br /><br />
               <span id="empresa">
                          
               		                       <span class="textformulario2">Empresa:</span>
                          <input name="empresa" type="text" size="40" class="relleno_corto2" accept="required"/>
                          <br />
                          <br />
               </span>
               <span id="telefono">
                         
                          
                          <span class="textformulario2">Teléfono:</span>
                          <input name="telefono" type="number" size="40" class="relleno_corto2" accept="required"/>
                          <br />
                          <br />
                          
                          </span>
               <span id="comentario">
               		
	      <span class="textformulario2">Comentario<br />/ Preguntas:</span><textarea name="comentario" wrap="soft" class="relleno_textarea2" accept="required"></textarea>
               </span>
                <br /><br /><br /><br /> <br /><br /><br />
               <input type="submit" value="enviar" class="botoninput2" />
               <div id="lineag2"></div>
               <span class="celda_f">Escríbenos también a través de <span class="links"><a href="mailto:nbianco@subastafiscal.com" target="_blank">nbianco@subastafiscal.com</a></span></span>      
    </form>
    

		</div>
	</div>

<div id="contenedor_noticias">
    	<div id="pestana"><span id="boton-prev"><a href="#"><<</a></span><h6>Actualidad Fiscal</h6>
            <span id="boton-next"><a href="#">>></a></span>
        </div>
	    <?php
			include("conf/config.conf.php");
			$conexion=mysql_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD);
			if($conexion){
				$seleccionar=mysql_select_db(NOMBRE_BD);
				mysql_query("SET NAMES 'utf8'");
			}
			
			$sqlbuscar="SELECT * FROM noticias WHERE destacado='SI' ORDER BY fechacons DESC LIMIT 3";
			$query=mysql_query($sqlbuscar,$conexion);
			if($query){
				$filas=mysql_num_rows($query);
				if($filas>0){
					$x=0;
					while($datos2=mysql_fetch_array($query)){
						$fecha=explode('-',$datos2['fechacons']);
						?>
						     <div class="modulos">
						    	<div id="titulo_noticia"><?php echo(ucwords(mb_strtolower($datos2['titulo'],"UTF-8"))); ?></div>
						        <div id="fecha_noticia"><?php echo($fecha[2]."/".$fecha[1]."/".$fecha[0]); ?></div>
						      	<div id="contenido_noticia"><?php echo(strip_tags(substr($datos2['cuerpo'], 0,106))."..."); ?></div>
						        <span class="boton_verde_i"><a href="<?php echo("/sf/web/blogsubasta/index.php?idnoticia=".$datos2['ID']); ?>" target="_self">leer más</a></span>
						     </div>
						<?php
					}
				}
			}
			mysql_close();
	    ?>
  </div>
          
         <div id="twitter">
        <script charset="utf-8" src="js/widget.js"></script> 
         <script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
 rpp: 10,
  interval: 30000,
  width: 300,
  height: 514,
  theme: {
    shell: {
      background: '#efc85e',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#8e8e8e',
      links: '#4F4F4F'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: false,
    behavior: 'all'
  }
}).render().setUser('subastafiscal').start();
</script>
        </div>
         
	<div id="banner5">
<?
fnv_mostrar_banners("banners/");
?>
  	</div>     
<div id="separador"></div>


</div>



