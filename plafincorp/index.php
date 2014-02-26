<?php
 $conexion=mysql_connect('plafincorp.db.8692891.hostedresource.com','plafincorp','Plafin01');
if($conexion){
	$seleccionar=mysql_select_db("plafincorp");
	mysql_query("SET NAMES 'utf8'");
}
else{
	echo(mysql_error());
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Plafincorp una Nueva Perspectiva de Negocios</title>
<link href="css.css" rel="stylesheet" type="text/css"/>
<LINK REL="SHORTCUT ICON" HREF="favicon.ico">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="libs/colorbox/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="libs/ajax.js"></script>
<script type="text/javascript" src="libs/lib.js"></script>
<style type="text/css">
</style>
<script type="text/javascript">
function abreSitio(valselect){
		var URL = "http://";
		var web = document.getElementById(valselect).value;
		location.href=web;
}
	
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
  function oculta (kpa) {
   var capa = document.getElementById(kpa);
   setTimeout("capa.style.display='none'",2000);
}
  function limpiar (kpa) {
   var capa = document.getElementById(kpa);
   capa.value='';
	}
  function escribir (kpa,cadena) {
   var capa = document.getElementById(kpa);
   if(capa.value==''){
   	   capa.value=cadena;
   }
   }
   
	//function mostrar_popup() {
		//window.open("popup.html", "_blank", 'width=520,height=273');
	//}
	
	mostrar_popup();
</script>
</head>
<body onload=&lt;/head;MM_preloadImages('botones/two.png','botones/faceo.png','botones/ipngn.png','botones/iign.png','botones/ptgn.png','botones/otgn.png','botones/atgn.png')>
<div id="content">
		<div id="header">
			<div id="contenedorlogos">
				<a href="index.php">
					<div id="planfincorp"> 
					</div>
				</a> 
              <div id="logosfacebookcontend">
                <div id="logosredessocialescontenedor">
                  <div id="logosredessocialescontenedor2">
                    <div id="tw"><a href="https://twitter.com/Plafincorp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','botones/two.png',1)"><img src="botones/twb.png" width="31" height="31" id="Image1" /></a> </div>
                    <div id="fb"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','botones/faceo.png',1)"><img src="botones/faceb.png" width="31" height="31" id="Image2" /></a> 
                    </div>
                    	
                  </div>
                  		
                </div>
                <br />
               	<div id="wwwsubastafiscalcom">
                    	Una Empresa del Grupo<br />
                        www.SubastaFiscal.com 
                </div>
            </div>
          </div>
  </div>
  <div id="botoneracontenedor" style="margin: 0px auto;">
       	  <div id="botonera">
       	  	<a href="index.php">HOME</a>
       	  </div>
          <div id="botonera" style="cursor: pointer;">
          	<a>
          		LA EMPRESA
          		<ul id="submenu1">
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=empresa&sm=qsomos';">
          				Quienes Somos
          			</li>
          			<li style="color:#00484B; background:#00484B; width:170px ;height: 2px;">
          				<p style="color:#00484B; background:#00484B; width:170px ;height: 2px;"></p>
          			</li>
          			<li style="cursor: pointer;"  onclick="location.href='index.php?mod=empresa&sm=directores';">Directores</li>
          		</ul>
          	</a>
          </div>
          <div id="botonera" style="cursor: pointer;">
          	<a>
          		AREAS DE NEGOCIO
          		<ul id="submenu2">
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=areasnegocios&sm=ic';">Impuestos Corporativos</li>
          			          			<li style="color:#00484B; background:#00484B; width:170px ;height: 2px;">
          				<p style="color:#00484B; background:#00484B; width:170px ;height: 2px;"></p>
          			</li>
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=areasnegocios&sm=ii';" >Impuestos Internacionales</li>
          			          			<li style="color:#00484B; background:#00484B; width:170px ;height: 2px;">
          				<p style="color:#00484B; background:#00484B; width:170px ;height: 2px;"></p>
          			</li>
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=areasnegocios&sm=pt';" >Precios de Transferencia</li>
          			          			<li style="color:#00484B; background:#00484B; width:170px ;height: 2px;">
          				<p style="color:#00484B; background:#00484B; width:170px ;height: 2px;"></p>
          			</li>
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=areasnegocios&sm=ot';" >Otros Tributos</li>
          			          			<li style="color:#00484B; background:#00484B; width:170px ;height: 2px;">
          				<p style="color:#00484B; background:#00484B; width:170px ;height: 2px;"></p>
          			</li>
          			<li style="cursor: pointer;" onclick="location.href='index.php?mod=areasnegocios&sm=alt';" >Asesoria Fiscal Tributaria</li>
          		</ul>
          	</a>
          </div>          
        <div id="botonera">
        	<a href="index.php?mod=calendariof">
        		CALENDARIO FISCAL
        	</a>
        </div>
    	<div id="botonera">
    		<a href="index.php?mod=contacto">
    			CONTACTENOS
    		</a>
    	</div>
  </div>
<div id="banner"><img src="imag/banner1.png" width="960" height="235"></div>
<?php
	if($_GET['mod']==''){
		?>
			<div id="servicios">
			    <div id="serviciosbotones">
			          <a href="index.php?mod=areasnegocios&sm=ic" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','botones/ipngn.png',1)"><img src="botones/ipngg.png" width="178" height="196" id="Image4"></a>
				</div>
			    <div id="serviciosbotones">
			      <a href="index.php?mod=areasnegocios&sm=ii" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','botones/iign.png',1)"><img src="botones/iigg.png" width="178" height="196" id="Image5"></a> 
			    </div>
			    <div id="serviciosbotones">
			    	<a href="index.php?mod=areasnegocios&sm=pt" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','botones/ptgn.png',1)"><img src="botones/ptgg.png" width="178" height="196" id="Image6"></a> 
			    </div>
			    <div id="serviciosbotones">
			          <a href="index.php?mod=areasnegocios&sm=ot" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','botones/otgn.png',1)"><img src="botones/otgg.png" width="178" height="196" id="Image7"></a>
				</div>
				<div id="serviciosbotones">
			            <a href="index.php?mod=areasnegocios&sm=alt" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','botones/atgn.png',1)"><img src="botones/atgg.png" width="178" height="196" id="Image8"></a>
				</div>
			</div>
		<?php
	}
	
	if($_GET['mod']!=''){
		?>
	  <div id="contenedorcontenido" style="top:55px;">
	  	<?php
	}
else{
		?>
	  <div id="contenedorcontenido">
	  	<?php
}
  		if($_GET['mod']==''){
  	?>
   	  <div id="contenedorcontenidogral">
        <div id="contenedornoticias">
              <div id="noticias">
              	<h1>ACTUALIDAD TRIBUTARIA</h1>
				<?php
					//NOTICIAS
					$limit=2;
					$sqlsel="SELECT * FROM noticias WHERE tipo='NOTICIA' ORDER BY ID DESC LIMIT ".$limit;
					$pedidosel=mysql_query($sqlsel,$conexion);
					if($pedidosel){
						$filassel=mysql_num_rows($pedidosel);
						if($filassel>0){
							$i=0;
							while($datserv=mysql_fetch_array($pedidosel)){
								$titulonotice=ucwords(strtolower($datserv['titulo']));
								$cuerponotice=substr($datserv['cuerpo'], 0,130);
								$cuerponotice=$cuerponotice."...";
								$fechanotice=$datserv['fecha'];
								$idnot=$datserv['ID'];
								?>
									<table>
										<tr>
											<td style="width: 330px;border: 0px;height: 20px;">
												<p style="color:black;margin-top: 3%; font-size: 14px; font-weight: bolder;">
													<?php
														echo($titulonotice);
													?>
												</p>
											</td>
										</tr>
										<tr>
											<td style="width: 330px;border: 0px;">
												<p style="font-size: 10px; font-weight: normal;">
													<?php
														echo($cuerponotice);
													?>
												</p>
											</td>
										</tr>
										<tr>
											<td style="width: 330px;border: 0px;">
												<?php
													echo("<div id=\"botongenral\"><a href=\"index.php?&mod=noticias&tiponoticia=NOTICIA&idnotice=".$idnot."\">Leer Mas...</a></div>");
												?>
											</td>
										</tr>
									</table>
									<?php
									if($filassel!=($i+1)){
										?>
											<div id="lineahorizontal"></div>
										<?php
									}
									?>
								<?php
								$i++;
							}
						}
					}
				?>
				</div>
			</div>
            <div id="lineavertical"></div>
            <div id="contenedortw">
				<a class="twitter-timeline"  href="https://twitter.com/Plafincorp"  data-widget-id="428638068409511937" height="310">Tweets por @Plafincorp</a>
				    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
       		</div>
           <div id="lineavertical">
        </div>
       	<form method="GET" enctype="multipart/form-data">
            <div id="contenedorcontactos">
            	<a href="?mod=calendariof">
            		<img src="img/bannerprorroga.png" style="width: 285px;height:auto;float:right;">
            	</a>
            </div>
       		 </form>
            <div id="marcadeagua"></div>
	  </div>
<?php
  		}
else{
	$nombremod=$_GET['mod'].".php";
	if(file_exists($nombremod)){
		include($nombremod);
	}
	else{
		echo("El modulo que desea cargar no existe");
	}
}
?>
	</div>
	<?php
	
	if($_GET['mod']=="empresa" && $_GET['sm']=='qsomos'){
		?>
	<div style="position: relative;margin-bottom: 300px;height: auto;">
		
	</div>
		<?php
	}
	if($_GET['mod']=="calendariof"){
		?>
	<div style="position: relative;margin-bottom: 100px;height: auto;">
		
	</div>
		<?php
	}	
	if($_GET['mod']==""){
		?>
	<div style="position: relative;margin-bottom:-80px;height: auto;">
		
	</div>
		<?php
	}	
	?>
	
	
	<div style="position:relative; margin: 0px auto;">
	<div id="logoscompanias">
    	<div id="titulologos">
    	  <h1>EMPRESAS ALIADAS</h1>
    	</div>
        <div id="linealogos">
        </div>
        		<div id="logos">
                
                	<div id="logossolos">
                		<a href="http://subastafiscal.com/" target="_blank">
                			<img src="imag/logosubasta.png" width="142" height="65">
                		</a>
                    </div>
                    <div id="logossolos">
                    	<a href="http://cefincorp.com/" target="_blank">
                    		<img src="imag/cefincorp.png" width="162" height="65"> 
                    	</a>
                    </div>
                    <div id="logossolos">
                    	<a href="http://catyc.com/" target="_blank">
                    		<img src="imag/catyc.png" width="172" height="55"> 
                    	</a>
                    </div>
                    <div id="logossolos">
                    	<a href="http://xumbadevenezuela.com/" target="_blank">
                    		<img src="imag/xumba.png" style="width:172px;height:auto;"> 
                    	</a>
                    </div>
                </div>
    
    
    </div>
	</div>
</div>

			<div id="footer">
			  <div id="footercontend">
                <div id="footercontend2" style="left: -10px;">
                	<p style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;margin-top: 5px;">
                		<a href="index.php" style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;">
							HOME
                		</a>
                	</p>
                </div>
                <div id="footercontend3" style="left: 178px;vertical-align: top;">
                </div>
                <div id="footercontend2" style="left: 190px;vertical-align: top;">
                	<p  style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;margin-top: 5px;vertical-align: top;">
                		<a href="index.php"  style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;">
							LA EMPRESA
                		</a>
                		<p  style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;vertical-align: top;position: relative;margin-top: -11px;font-weight: normal;">
                			<a style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: normal;text-decoration: none;" href="index.php?mod=empresa&sm=qsomos">
                				- Qui&eacute;nes Somos
                			</a>
                		</p>
                		<p style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;vertical-align: top;position: relative;margin-top: -11px;font-weight: normal;">
                			<a style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: normal;text-decoration: none;" href="index.php?mod=empresa&sm=directores">
                				- Directores
                			</a>
                		</p>
                	</p>
                </div>
                <div id="footercontend3" style="left: 378px;">
                </div>
                <div id="footercontend2" style="left: 390px;">
                	<p style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;margin-top: 5px;">
                		<a href="index.php?mod=areasnegocios&sm=ic" style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;">
							AREAS DE NEGOCIO
                		</a>
                		<br>
                		<a href="index.php?mod=areasnegocios&sm=ic" style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;font-weight: normal;">
							- Impuestos Corporativos
                		</a>
                		<br>
                		<a href="index.php?mod=areasnegocios&sm=ii" style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;font-weight: normal;">
							- Impuestos Internacionales
                		</a>
                		<br>
                		<a href="index.php?mod=areasnegocios&sm=pt" style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;font-weight: normal;">
							- Precios de Transferencia
                		</a>
                		<br>
                		<a href="index.php?mod=areasnegocios&sm=ot" style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;font-weight: normal;">
							- Otros Tributos
                		</a>
                		<br>
                		<a href="index.php?mod=areasnegocios&sm=alt" style="font-family: Arial, Helvetica, sans-serif; color: white;text-decoration: none;font-weight: normal;">
							- Asesor&iacute;a Legal Tributaria
                		</a>
                	</p>
                </div>
                <div id="footercontend3" style="left: 578px;">
                </div>
                <div id="footercontend2" style="left: 590px;">
                	<p style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;margin-top: 5px;">
                		<a href="index.php?mod=calendariof" style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;">
							CALENDARIO FISCAL
                		</a>
                	</p>
                </div>
                <div id="footercontend3" style="left: 778px;">
                </div>
                <div id="footercontend2" style="left: 790px;">
                	<p style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;margin-top: 5px;">
                		<a href="index.php?mod=contacto" style="font-family: Arial, Helvetica, sans-serif; color: white; font-weight: bolder;text-decoration: none;">
							CONTACTENOS
                		</a>
                	</p>
                </div>
              </div>
			</div>
			<div id="footercreditos">
				<div style="margin: 0px auto;font-family: Arial, Helvetica, sans-serif; color: black; font-weight: normal;width: 1024px;font-size: 12px;">
					<div style="position:absolute;margin-top:10px;width: 1024px;">
						<div style="float:left;text-align: left;">
							Diseño y Programación <a style="font-family: Arial, Helvetica, sans-serif; color: black; font-weight: bolder;width: 1024px;font-size: 12px;text-decoration:none;" href="http://xumbadevenezuela.com"><b>Xumba de Venezuela</b></a> 
						</div>
						<div style="float:right;text-align: right;">
							2012 &copy; Todos los derechos reservados <b style="font-weight: bolder;">Grupo Consultor Plafincorp, C.A.</b><br>
							Rif: J-29920907-4
						</div>
					</div>
				</div>
			</div>
</body>
</html>
