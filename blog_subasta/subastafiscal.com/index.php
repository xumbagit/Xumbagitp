 <?php session_start();

switch ((int)trim($_REQUEST['webpage'])) {
	case 1: 
		//Registro de Usuario
		if(!isset($_SESSION['g_usuario']['acceso'])){
			$pagesf='registro.php';	
		}else{
			$_REQUEST['webpage'] = 0;
			$pagesf='inicio.php';
		}
		
		break;
	case 2: 
		//Subasta Fiscal vista general
		$pagesf='subasta.php';
		break;
	case 3: 
		//Subasta Fiscal vista general
		if(!isset($_SESSION['g_usuario']['acceso'])){
			$_REQUEST['webpage'] = 0;
			$pagesf='inicio.php';
		}else{
			$pagesf='registro-subasta.php';
		}
		break;
	case 4:
		//Balance al Dia
		if(!isset($_SESSION['g_usuario']['acceso'])){
			$_REQUEST['webpage'] = 0;
			$pagesf='inicio.php';
		}else{
			$pagesf='balance-registro.php';	
		}
		break;
	case 5:
		//Contacto
		$pagesf = 'contacto.php';
		break;
	case 6:
		//Aliados
		$pagesf = 'aliados.html';
		break;
	case 7:
		//Empresa
		$pagesf = 'empresa.html';
		break;				
	
	case 8:
		//Responsabilidad Social
		$pagesf = 'responsabilidad_social.html';
		break;
	case 9:
		//Actualidad Fiscal
		$pagesf = 'actualidad.php';
		break;					
	case 10:
		//Actualidad Fiscal
		$pagesf = 'actualidad1.html';
		break;					
	case 11:
		//Actualidad Fiscal
		$pagesf = 'actualidad2.html';
		break;					
	case 12:
		//Actualidad Fiscal
		$pagesf = 'actualidad3.html';
		break;					
	case 13:
		//Actualidad Fiscal
		$pagesf = 'actualidad4.html';
		break;
	case 14:
		//Biblioteca
		$pagesf = 'biblioteca_fiscal.html';
		break;					
	case 15:
		//Mi cuenta
		if(!isset($_SESSION['g_usuario']['acceso'])){
			$_REQUEST['webpage'] = 0;
			$pagesf='inicio.php';
		}else{
			$pagesf = 'micuenta.php';
		}
		break;
	case 16: 
		//Servicios
	   $pagesf='asesoria_fiscal.php';
	   break;
	case 17: 
		//Servicios
	   $pagesf='asesoria_legal.php';
	   break;
	case 18: 
		//Servicios
	   $pagesf='outsorcing_contable.php';
	   break; 
	case 19: 
		//Servicios
	   $pagesf='asesoria_laboral.php';
	   break;    
	case 20: 
		//Servicios
	   $pagesf='terminos.html';
	   break;    
	case 21: 
		//Servicios
	   $pagesf='como_funciona.html';
	   break;    
	case 22:
		//Incripcion Foro ISRL
		if(!isset($_SESSION['variablespago'])){
			$pagesf='registro-isrl.php';
		}else{
			//Pago Foro ISRL
			$pagesf='pagotab_isrl.php';	
		}
		break;
	case 23:
		//Actualidad Fiscal
		$pagesf = 'actualidad5.html';
		break;
	case 24:
		//Actualidad Fiscal
		$pagesf = 'actualidad6.html';
		break;
	case 25:
		//Actualidad Fiscal
		$pagesf = 'actualidad7.html';
		break;
	case 26:
		//Actualidad Fiscal
		$pagesf = 'actualidad8.html';
		break;
	case 27:
		//Actualidad Fiscal
		$pagesf = 'actualidad9.html';
		break;
	case 28:
		//Actualidad Fiscal
		$pagesf = 'actualidad10.html';
		break;
	case 29:
		//Actualidad Fiscal
		$pagesf = 'actualidad11.html';
		break;
	case 30:
		//Actualidad Fiscal
		$pagesf = 'actualidad12.html';
		break;
	case 31:
		//Actualidad Fiscal
		$pagesf = 'actualidad13.html';
		break;
	case 32:
		//Actualidad Fiscal
		$pagesf = 'actualidad14.html';
		break;
	default: 
		//Pagina de inicio
	   $pagesf='inicio.php';
	   break;
}
//Seccion de Contenido de Contenido
$_SESSION['g_idpage'] = $_REQUEST['webpage'];
$_SESSION['g_page']   = $pagesf;
//Ventana emergente de mensajes para las pantalla
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Subasta Fiscal</title>
<META NAME="author" CONTENT="Xumba de Venezuela">
<META NAME="subject" CONTENT="subasta | fiscal | subasta fiscal | medios | audiovisual | comerciales | Estudio de mercado | FB | FACEBOOK | TW | twitter | youtube | redes sociales | Red Social | Web | WWW | WWW. | localhost | apache">
<META NAME="Classification" CONTENT="Xumba de Venezuela">
<META NAME="Keywords" CONTENT="subasta | fiscal | subasta fiscal | medios | audiovisual | comerciales | Estudio de mercado | FB | FACEBOOK | TW | twitter | youtube | redes sociales | Red Social | Web | WWW | WWW. | localhost | apache">
<META NAME="Geography" CONTENT="Caracas, Venezuela">
<META NAME="Language" CONTENT="Spanish, English">
<META HTTP-EQUIV="Expires" CONTENT="never">
<META NAME="Copyright" CONTENT="Subasta Fiscal">
<META NAME="Designer" CONTENT="Xumba de Venezuela">
<META NAME="Publisher" CONTENT="Xumba de Venezuela, c.a.">
<META NAME="Revisit-After" CONTENT="7 days">
<META NAME="distribution" CONTENT="Global">
<META NAME="Robots" CONTENT="INDEX,FOLLOW">
<META NAME="city" CONTENT="Caracas">
<META NAME="country" CONTENT="Venezuela">
<script type="text/javascript" src="js/jquery.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<!--script type="text/javascript" src="js/jquery.js"></script-->
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<!--<script type="text/javascript" src="js/jquery.validate.min.js"></script>-->
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>


<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function getSUBID(seccionpage,codregsub){	
	var request = $.ajax({
		type: "POST",
  		data: {accionpage:seccionpage,codreg:codregsub},
		dataType:"json",
		url: "lib/function_gen.php",
		success: function(data){
       		switch (seccionpage){
			case 2:
				SUBIDShowlink(data);
				break;
			case 3:
				SUBIDShowbox(data);
				break;	
			case 12:
				BCactions(data);
				break;
			
			}
			
			
		},
		fail:function(jqXHR, textStatus) { 
		//alert( "Request failed: " + textStatus ); 
		}
					
	});
}

function SUBIDShowlink(data){
 	$.each(data,function(index,value) {
		if(data[index].sesActiva == 0){
			//No session			
			$("#ventana").html( data[index].sesHtml );
			mostrar_popup('ventana',1);
		}else{
			document.location.href = "index.php?webpage=3";
		}
		
	});

}

function BCactions(data){
 	$.each(data,function(index,value) {
		if(data[index].sesActiva == 0){
			//No session			
			$("#ventana").html( data[index].sesHtml );
			mostrar_popup('ventana',1);
			
		}else{
			
			document.location.href = "index.php?webpage=4";
			
		}
		
	});
}


function SUBIDShowbox(data){
 	$.each(data,function(index,value) {
		if(data[index].sesActiva == 0){
			//No session			
			$("#ventana").html( data[index].sesHtml );
			mostrar_popup('ventana',1);
			
		}else{
			$("#ventana").html( data[index].sesHtml );
			mostrar_popup('ventana',0);
		}
		
	});
}

function ContrasenaShow(){
	mostrar_popup('ventanacontrasena',0);
}

getBannerSUB();
setInterval('getBannerSUB()',1000*30);
function getBannerSUB(){		
	var seccionpage = 9;
	var request = $.ajax({
		type: "POST",
  		data: {accionpage : seccionpage},
		dataType:"html",
		url: "lib/function_gen.php"
	});
	
	//Transaccion exitosa
	request.done(function(data){
		$("#bannerlist").html(data);	 
    });

	//Error en Transaccion
	request.fail(function(jqXHR, textStatus) { 
		//alert( "Request failed: " + textStatus ); 
	});
	
}


function selecBID(var_valor){
	document.getElementById('aumento').innerHTML = var_valor;
	document.getElementById('BIDOferta').value   = var_valor;
	mostrardiv('textoemergentebid');
	
}

function ingresaBID(var_cod,var_bid){
	var seccionpage = 4;
	var request = $.ajax({
		type: "POST",
  		data: {accionpage:seccionpage,codoferta:var_cod,valorbid:var_bid},
		dataType:"json",
		url: "lib/function_gen.php",
		success: function(data){
			cerrar_popup("ventana",0);
			$.each(data,function(index,value) {
				$("#ventana").html( data[index].sesHtml );
				$("#var_cod"+var_cod).html(data[index].mpoAct);
				mostrar_popup('ventana',1);
			});
		},
		fail:function(jqXHR, textStatus) { 
		//alert( "Request failed: " + textStatus ); 
		}
					
	});
}

var  popuptimer;
function mostrar_popup(idseccion,timerventana) {
	window.scrollTo(0,0);
	div = document.getElementById(idseccion);
	div.style.display = "";
	document.body.style.overflow = 'hidden';
	if (timerventana == 1){
		popuptimer = setTimeout("cerrar_popup('"+idseccion+"',"+timerventana+")",5000);
	}
}
			
function cerrar_popup(idseccion,timerventana) {
	if (timerventana == 1){
		clearTimeout(popuptimer);
	}
	div = document.getElementById(idseccion);
	div.style.display='none';
	document.body.style.overflow = 'visible';
}

function publicidad_islr(){
	var caracteristicas = "height=310,width=600,Top=200,Left=300,scrollbars=NO,resizable=NO,location=NO,toolbar=NO,menubar=NO,directories=NO,fullscreen";
    nueva=window.open("islr_public.html", 'EventoISLR', caracteristicas);
    return false;
}
</script>
<script type="text/javascript"  src="js/function_jsgen.js"></script>
<link href="css/emergente.css" rel="stylesheet" />
<link href="css/header.css" rel="stylesheet" />
<link href="css/content.css" rel="stylesheet" />
<link href="css/footer.css" rel="stylesheet" />
<link href="css/subasta.css" rel="stylesheet" />
<link href="css/balance.css" rel="stylesheet" />
<link href="css/asesoria_fiscal.css" rel="stylesheet" />
<link href="css/rs.css" rel="stylesheet" />
<link href="css/micuenta.css" rel="stylesheet" />
<link href="css/extras.css" rel="stylesheet" />
<link href="css/chat.css" rel="stylesheet" />
<link href="css/comofunciona.css" rel="stylesheet" />
<link href="css/form.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45900719-1', 'subastafiscal.com');
  ga('send', 'pageview');

</script>
</head>
<body onload="MM_preloadImages('img/facebookhover.png','img/twitter.png','img/youtubehover.png','img/registratehover1.png');//publicidad_islr();">
<!------------------ Ventana Emergente de Informacion --------------------------------->
<div class="blocker" style="display:none" id="ventana">
</div>
<!------------------ Ventana Emergente de Olvido contrasena --------------------------------->
<div class="blocker"  style="display:none" id="ventanacontrasena">
<div id="contenedoremergente">
	
    <div id="pestanaemergente">¿Olvidó Contraseña? <span id="boton_x"><a href="javascript:cerrar_popup('ventanacontrasena',0);">x</a></span>
    </div>
    
    <div id="contenedorabajoemergente">
        <div id="textoemergente">Ingrese su correo para recuperarla
        <br /><br />
            <form action="#" method="post" >
            <input name="olvidocontrasena" type="text" size="40" class=".rellenocontrasena" />
            <br /><br />
            <input type="submit" value="recuperar" class="botoninputcontrasena" />
            </form>
        </div>
    </div>
</div>
</div>

<!---------------------- Chat -------------------------------------->
<?php if(isset($_SESSION['g_usuario'])) require_once 'chat_sf/chat.php'; ?>
<!--   Olvido Contrasena -------------------------------------------->
<!------------------ HEADER SF ---------------------------------------->
<div id="contenedorheader">
      <div id="header">
    <div id="sombra"></div>
    
		
        <div id="verdebackground">
        		<div id="contenedorelementosverde">
          			<div id="comofunciona"><a href="index.php?webpage=21">¿Comó Funciona?</a></div>
                    <div id="contenedorlogos">
    					
                        <div id="facebook"><a href="http://www.facebook.com/subasta.fiscal?ref=ts" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('facebook','','img/facebookhover.png',1)" target="_blank"><img src="img/facebook.png" name="facebook" width="32" height="32" border="0" id="facebook2" /></a></div>
                
                <div id="twitter1"><a href="https://twitter.com/SubastaFiscal" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('twitter','','img/twitter.png',1)" target="_blank"><img src="img/twitterhover.png" name="twitter" width="32" height="32" border="0" id="twitter2" /></a></div>
                
                <div id="youtube"><a href="http://www.youtube.com/user/SubastaFiscal?feature=watch"  target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('youtube','','img/youtubehover.png',1)"><img src="img/youtube.png" name="youtube" width="32" height="32" border="0" id="youtube2" /></a></div>
                
           </div>
            <div id="contenedorusuario">
            <?  
		   	if (!isset($_SESSION['g_usuario']['acceso'])){ 
		  	?>
            
            <form action="usuario-action.php" method="post" name="ingresomenu" id="ingresomenu">
            <input id="loginuser"    name="loginuser"     type="text" size="40"    onclick="vaciar_usuario();vaciar_clave();"/>
            <input id="passwordusux" name="passwordusux"  type="text" size="40"    onfocus="claveFocus()"/>
            <input id="passwordusu"  name = "passwordusu" type="password"  	size="40"    style="display:none;" onblur="claveBlur()" />
            <div class="ingresar"><input type="submit" value="ingresar" class="botoninput" /></div>
            </form>
            <div id="olvidocontrasena"><a href="javascript:ContrasenaShow();">¿Olvidó Contraseña?</a></div>
            <? 
			} 
			?>
            <script type="text/javascript">
            var_chat = 1;
			//Valida el formulario
			$('#ingresomenu').submit(function(event) {  
				event.preventDefault();  
				
				
				var url   = $(this).attr('action');  
				var datos = $(this).serialize();  
				
				
				if (validUsuario()== false){
					
					return false;
				}
				
				var request = $.ajax({
					type: "POST",
					data: datos,
					dataType:"json",
					url: url,
					success: function(data){
						$.each(data,function(index,value) {
							
							if (data[index].sesActiva != '0'){
								$("#ventana").html( data[index].sesHtml );
								mostrar_popup('ventana',1);
							}else{
								document.location.href = "index.php?webpage=1";	
							}
						});
					},
					fail:function(jqXHR, textStatus) { 
					//alert( "Request failed: " + textStatus ); 
					}
								
				});
				
				document.ingresomenu.reset(); 
			  
			}); 
			
			function validUsuario(){		
                var var_usuario = document.getElementById('loginuser').value;
                var var_clave   = document.getElementById('passwordusu').value;
                //Valida Usuario
                if ((var_usuario == '' ) || (var_usuario == 'Correo' )){
                    valor_ini();
                    return false;
                }
                
                //Valida Clave
                if ((var_clave == '' ) || (var_clave == 'Contraseña' )){
                    valor_ini();
                    return false;
                }
				return true;
         		 
            }
			
			
			passwordElement1 = document.getElementById('passwordusux');
     		passwordElement2 = document.getElementById('passwordusu');

			 function claveFocus() {
				  passwordElement1.style.display = "none";
				  passwordElement2.style.display = "inline";
				  passwordElement2.focus();
		
			 }

			 function claveBlur() {
		
				if(passwordElement2.value=='') {
		
				   passwordElement2.style.display = "none";
				   passwordElement1.style.display = "inline";
				   passwordElement1.focus();
		
				}
		
			 }

			function valor_ini(){
				document.getElementById('loginuser').value = "Correo";
				document.getElementById('passwordusux').value = "Contraseña";
			}

			function vaciar_usuario(){
				document.getElementById('loginuser').value = '';
			}
	
			function vaciar_clave(){
				passwordElement2.value = '';	
			}
			function ChatIni(){
				//$('#descripcion_chat').html('Escriba aqui...');
				$('#descripcion_chat').html('');
			}
			
			String.prototype.trim=function () {
  				return this.replace(/^\s+/,'').replace(/\s+$/,'');
			}
			function ChatWrite(valor){
				//if (valor.trim() == 'Escriba aqui...'){
					this.value='';
				//}
			}
			
			//Muestra Chat
			function showChat(){
				if (var_chat == 1){
					ChatIni();
					mostrardiv('contenedorchatabajo');
					var_chat = 0;
				}else{
					cerrar('contenedorchatabajo');
					var_chat = 1;
				}
	
			}
						
	 		//Muestra menu
			function mostrardiv(identificadordiv) {
				div = document.getElementById(identificadordiv);
				div.style.display = "";
			}
			
			function cerrar(identificadordiv) {
				div = document.getElementById(identificadordiv);
				div.style.display='none';
			}
			</script>

            </div>
          		</div>
          </div>
          <?  
		   if (isset($_SESSION['g_usuario']['acceso'])){ 
		  ?>
          <!--Session Activa-->
          <div id="bienvenido">Bienvenido! <span class="nombre"><? echo $_SESSION['g_usuario']['nombre']?></span></div>
          <? } ?>
          <!--Session Inanctiva-->
          <?  
		   if (!isset($_SESSION['g_usuario']['acceso'])){ 
		  	
		  ?>
          <script type="text/javascript">valor_ini();</script>
          <div id="registrate" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('registrateimg','','img/registratehover.png',1);">
          <img src="img/registrate.png" name="registrate" width="100" height="55" border="0" id="registrateimg"  onclick="document.location.href='index.php?webpage=1';" style="cursor:pointer;"/>
          <? } ?>
          
          
          <!--Session Activa-->
          <? if (isset($_SESSION['g_usuario']['acceso'])) { ?> 
          <div id="registrate" onmouseout="MM_swapImgRestore();cerrar('contenedormenuusuario')" onmouseover="MM_swapImage('registrateimg','','img/micuentahover.png',1);mostrardiv('contenedormenuusuario');">
          
          <img src="img/micuenta.png" name="registrate" width="100" height="55" border="0" id="registrateimg" />
          
          <br>
 		<div id="contenedormenuusuario" style="display:none;">
        
        <li class="botonesusuario"><span class="icon"></span><a href="index.php?webpage=15&amp;seccpnt=0">Subasta Activa</a></li>
          <li class="botonesusuario"><span class="icon2"></span><a href="index.php?webpage=15&amp;seccpnt=1">Movimientos</a></li>
       <li class="botonesusuario"><a href="index.php?webpage=15&amp;seccpnt=2"><span class="icon3"></span>Balance y Certif.</a></li>
        <li class="botonesusuario"><span class="icon4"></span><a href="index.php?webpage=15&amp;seccpnt=3">Configuración</a></li>
        <li class="botonesusuario"><span class="icon5"></span><a href="usuario_out-action.php">Cerrar Sesión</a></li>
        
        
		
        </div>
        <? } ?>
       </div>
                       
                        
           	
            
  
        	<div id="logo"><img src="img/logo_11.png" width="248" height="192" border="0"  onclick="document.location.href='index.php';" style="cursor:pointer;"/>
            </div>
            	<div id="blanco">
                </div>
                	<div id="menu">
                		<div id="gris">
                        </div>
                        	<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
                            <div id="cuadromenu">
                            	<ul class="menuprincipal">
                            			
                              <li class="botonpeq"><a href="#"><span class="butpeq">Empresa</span><br /><span class="butpeq">Líder</span></a>
                                		<ul class="submenuempresa">
                                        <li class="botonesempresa"><span class="filosubmenue"></span><span class="sombraempresa"></span><a href="index.php?webpage=7">Historia</a></li>
                                        <li class="botonesempresa"><span class="filosubmenue"></span><a href="index.php?webpage=6">Aliados</a></li>
                                        </ul>
                                  </li>
                                        
                                  <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" />
                                  </div>
                                    	<li class="botongrande"><a href="index.php?webpage=2"><span class="botonesgrande">Subasta de</span><br /><span class="botonesgrande">Valores Fiscales</span></a></span></li>
                                    <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" />
                                    </div>
                                    	<li class="botongrande"><a href="#"><span class="botonesgrande">Nuestros</span><br /><span class="botonesgrande">Servicios</span></a>
										<ul class="submenuservicios">
                                        <li class="botonservicios"><span class="filosubmenu"></span><span class="sombraservicio"></span><a href="index.php?webpage=16">Asesoría Fiscal</a></li> 
                                        <li class="botonservicios"><span class="filosubmenu"></span><a href="index.php?webpage=17">Asesoría Legal</a></li> 
                                        <li class="botonservicios"><span class="filosubmenu"></span><a href="index.php?webpage=18">Outsourcing Contable</a></li> 
                                        <li class="botonservicios"><span class="filosubmenu"></span><a href="index.php?webpage=19">Asesoría Laboral</a></li> 
                                        <li class="botonservicios"><span class="filosubmenu"></span><a href="index.php?webpage=14">Biblioteca Fiscal</a></li> 
                                        <li class="botonservicios"><span class="filosubmenu"></span><a href="javascript:getSUBID(12,0);">Balance al Día</a></li> 
                                        </ul>
                                  </li>                                   
                                    
                      <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
                                    	<li class="botongrande"><a href="index.php?webpage=8"><span class="botonesgrande">Responsabilidad</span>
                                    	<br /><span class="botonesgrande">Social</span></a></li>
										<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
										<li class="botonpeq"><a href="/sf/web/blogsubasta/" target="_blank"><span class="butcontacto">Blog</span></a></li>
										<div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
                                      	<li class="botonpeq"><a href="index.php?webpage=5"><span class="butcontacto">Contacto</span></a></li>
                                     <div class="filo"><img src="img/filo.png" width="3" height="54" border="0" /></div>
                            	<div id="grisfinal">
                        </div>
                                </ul>
                                
                         
                                
                       	   </div>
          </div>
                    <div id="cintavalores">
                                <marquee class="cifra" direction="left" style="text-align: center; width:1020px;height:30px;border:0px;padding:3px" scrollamount="3" >

<div id="contenedorcifras">
<span id="bannerlist" style="white-space:nowrap;">
</div>
</marquee>
      </div>
    </div>
</div>
<!------------------ HEADER SF ---------------------------------------->
<!------------------ CONTENIDO SF ---------------------------------------->
<div id="content">
	<?
	//Contenido de Subasta Fiscal
	include_once($_SESSION['g_page']);
	?>
</div>
<!------------------ CONTENIDO SF ---------------------------------------->
<!------------------ FOOTER SF ---------------------------------------->
<div id="contenedorcompletofooter">
<div id="contenedorfooter">
	<div id="footer">
    	<div id="columna1">
        	<div class="contenedorlinks">
    			<div id="inicio"><a href="index.php">Inicio</a></div>
                <div class="empresa"><h4>Empresa</h4>
                	<ul class="contenedorempresa">
                    	<li class="botonempresa"><a href="index.php?webpage=7"><h3>Historia</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=6"><h3>Aliados</h3></a></li>
                  </ul>
              </div>
       	  	<div id ="contacto"><a href="index.php?webpage=5">Contacto</a></div>
          </div>
        </div>
        <div class="separacion"></div>
        	<div id="columna2">
        		<div class="contenedorlinks1">
            		<ul class="contenedorservicios"><h4>Servicios</h4>
                    	<li class="botonempresa"><a href="index.php?webpage=16"><h3>Asesoría Fiscal</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=17"><h3>Asesoría Legal</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=18"><h3>Outsourcing Contable</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=19"><h3>Asesoría Laboral</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=14"><h3>Biblioteca Fiscal</h3></a></li>
                        <li class="botonempresa"><a href="index.php?webpage=4"><h3>Balance al Día</h3></a></li>
                    </ul>
            </div>
   	 </div>
     <div class="separacion"></div>
     					
                        <div id="columna3">
                        	<div class="contenedorlinks1">
                            	<ul class="contenedorservicios"><h4>Ayuda</h4>
                                	<li class="botonempresa"><a href="index.php?webpage=21"><h3>¿Cómo Funciona?</h3></a></li>
                                    <li class="botonempresa"><a href="#"><h3>Preguntas Frecuentes</h3></a></li>
                                    <li class="botonempresa"><a href="index.php?webpage=20" ><h3>Términos y Condiciones</h3></a></li>
                                     
                                     </ul>
                              </div>
                         </div>
                         <div class="separacion"></div>
                        	 <div id="columna4">
                         		<div class="contenedorlinks">
    								<div id="inicio"><a href="index.php?webpage=2">Subasta de<br />Valores Fiscales</a></div>
                                 </div>
                              </div>
                              <div class="separacion"></div>
                              <div id="columna5">
                         		<div class="contenedorlinks">
    								<div id="inicio"><a href="/sf/web/blogsubasta/" target="_blank">Blog</a></div>
                               </div>
                               		</div>
                                    <div class="separacion"></div>
                                    <div id="columna6">
                         		<div class="contenedorlinks">
    								<div id="responsabilidad"><a href="index.php?webpage=8">Responsabilidad Social</a></div>
                               </div>
                               		</div>
                              
                                                                        
	</div>
    <div id="footerverde">Todos los derechos reservados ® 2012 www.SubastaFiscal.com c.a. J-30950027-9. Diseño y Desarrollo<span class="butdesarrollo"><a href="http://www.xumbadevenezuela.com"> Xumba de Venezuela</a></span>/<span class="butdesarrollo"><a href="http://www.metraestudio.com"> Metra Estudio</a></span>
    </div>
</div>

<!------------------ FOOTER SF ---------------------------------------->
</body>
</html>
