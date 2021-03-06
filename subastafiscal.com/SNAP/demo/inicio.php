﻿<script type="text/javascript" src="js/numberFormat154.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

getSubastadatos(8);
setInterval('getSubastadatos(8)',1000*5);
function getSubastadatos(topereg){		
	var seccionpage = 1;
	var request = $.ajax({
		type: "POST",
  		data: {accionpage : seccionpage, prm_valor:topereg },
		dataType:"json",
		url: "lib/function_gen.php"
	});
	
	//Transaccion exitosa
	request.done(function(data){
		subastaTabla(data);	 
    });

	//Error en Transaccion
	request.fail(function(jqXHR, textStatus) { 
		//alert( "Request failed: " + textStatus ); 
	});
	
}

function subastaTabla(data){
 	$.each(data,function(index,value) {
		$("#vn"+index).html(format_numero(data[index].valor_nominal));
		$("#orig"+index).html(data[index].origen);
		$("#mpo"+index).html(format_numero(data[index].MPO_ACT));
		$("#subDetalle"+index).html(data[index].botdetalle);
				
	});
}

function format_numero(obj){
	var num = new NumberFormat();
	num.setInputDecimal('.');
	num.setNumber(obj); // obj.value is '0.9'
	num.setPlaces('2', false);
	num.setCurrencyValue('');
	num.setCurrency(true);
	num.setCurrencyPosition(num.LEFT_OUTSIDE);
	num.setNegativeFormat(num.LEFT_DASH);
	num.setNegativeRed(false);
	num.setSeparators(true, ',', ',');
	obj = num.toFormatted();
	return obj; 
}

</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
<script src="js/slides.min.jquery.js"></script>
<script language="javascript" >
	
$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 6000,
				//pause: 2500,
				pause: 20000,
				hoverPause: true,
				animationStart: function(current){
					
					$('.caption').animate({	bottom:-35},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
					
				},
				animationComplete: function(current){
					//$('.caption').animate({	bottom:0},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					//$('.caption').animate({	bottom:0},200);
				}
			});
		});
	
	
		
</script>
    
 <div id="separador1">
<span class="slogan"><span class="verdeoscuro">Líderes</span> en Asesoría Tributaria y Financiera</span>
</div>
<div id="resultado"></div>  
<div id="banner_home">
<div id="container">
    <div id="slides">
	  <div class="slides_container">
					
                  	<div class="slide">
			        <a href="index.php?webpage=22" ><img src="img/foro_isrl.jpg" width="590" height="305"  border="0"/></a>
                    </div>
                   
                    <div class="slide">
			        <object width="590" height="305">
                    <param name="movie" value="http://www.youtube.com/v/ThAH2TTzSoU?hl=es_ES&amp;version=3&amp;rel=0"></param>
                    <param name="allowFullScreen" value="true"></param>
                    <param name="allowscriptaccess" value="always"></param>
                    <embed src="http://www.youtube.com/v/ThAH2TTzSoU?hl=es_ES&amp;version=3&amp;rel=0" type="application/x-shockwave-flash" width="590" height="305" allowscriptaccess="always" allowfullscreen="true">
                    </embed>
                    </object>
                    </div>
                    <div class="slide">
			        <a href="usosubastaportal.html" target="_blank"><img src="img/usoportal.png" width="590" height="305" alt="Presiona Click...y aprenderás a usar nuestro portal!" border="0"/></a>
					</div>
                  
                    <div class="slide">
					<a href="index.php?webpage=6"><img src="img/plafincorp1.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
					<div class="slide">
					<a href="index.php?webpage=6"><img src="img/xumba1.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
                    <div class="slide">
					<a href="index.php?webpage=6"><img src="img/catic1.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
                     <div class="slide">
					<a href="index.php?webpage=14"><img src="img/biblioteca_fiscal1.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
                    <div class="slide">
					<a href="#"><img src="img/asesoria-online.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
                    <div class="slide">
					<a href="index.php?webpage=2"><img src="img/subasta_banner1.jpg" width="590" height="305" alt="" border="0"/></a>
					</div>
                    
      </div>
       <a href="#" class="prev"><img src="img/flecha1.png" width="14" height="83" border="0" alt="Arrow Prev"></a>
	   <a href="#" class="next"><img src="img/flecha2.png" width="14" height="83" border="0" alt="Arrow Next"></a>
    </div>
    </div>
    </div>
	<div id="contenedor_subasta">
	    <div id="subatadatos"></div>
        <table width="300" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td colspan="4">
            	<span id="pestana">
	          		<h6>Subasta de Valores Fiscales</h6>
	          	</span></td>
          </tr>
          <tr>
	        <td width="100px"><span class="valores">Valor Nominal</span></td>
	        <td width="62px"><span class="valores">Origen</span></td>
	        <td width="60px"><span class="valores">MPO %</span></td>
	        <td width="80px"><span class="valores"></span></td>
          </tr>
          <tr class="fila_blanca">
              <td><span class="casillas" id="vn0"></span></td>
              <td><span class="casillas_origen" id="orig0"></span></td>
              <td><span class="casillas_mpo" id="mpo0"></span></td>
              <td><span class="detalle" id="subDetalle0"></span></td>
          </tr>
          <tr>
              <td><span class="casillas" id="vn1"></span></td>
              <td><span class="casillas_origen" id="orig1"></span></td>
              <td><span class="casillas_mpo" id="mpo1"></span></td>
              <td><span class="detalle" id="subDetalle1"></span></td>
          </tr>
          <tr class="fila_blanca">
              <td ><span class="casillas" id="vn2"></span></td>
              <td><span class="casillas_origen" id="orig2"></span></td>
              <td><span class="casillas_mpo" id="mpo2"></span></td>
              <td><span class="detalle" id="subDetalle2"></span></td>
          </tr>
          <tr>
              <td><span class="casillas" id="vn3"></span></td>
              <td><span class="casillas_origen" id="orig3"></span></td>
              <td><span class="casillas_mpo" id="mpo3"></span></td>
              <td><span class="detalle" id="subDetalle3"></span></td>
          </tr>
          <tr class="fila_blanca">
              <td ><span class="casillas" id="vn4"></span></td>
              <td><span class="casillas_origen" id="orig4"></span></td>
              <td><span class="casillas_mpo" id="mpo4"></span></td>
              <td><span class="detalle" id="subDetalle4"></span></td>
          </tr>
          <tr>
              <td><span class="casillas" id="vn5"></span></td>
              <td><span class="casillas_origen" id="orig5"></span></td>
              <td><span class="casillas_mpo" id="mpo5"></span></td>
              <td><span class="detalle" id="subDetalle5"></span></td>
          </tr>
          <tr class="fila_blanca">
              <td ><span class="casillas" id="vn6"></span></td>
              <td><span class="casillas_origen" id="orig6"></span></td>
              <td><span class="casillas_mpo" id="mpo6"></span></td>
              <td><span class="detalle" id="subDetalle6"></span></td>
          </tr>
          <tr>
              <td><span class="casillas" id="vn7"></span></td>
              <td><span class="casillas_origen" id="orig7"></span></td>
              <td><span class="casillas_mpo" id="mpo7"></span></td>
              <td><span class="detalle" id="subDetalle7"></span></td>
          </tr>
          <tr class="fila_blanca_final">
	        <td colspan="4"><span class="celda_final bold">¡Participa en la Subasta ahora!</span><span class="boton_verde_d"><a href="index.php?webpage=2" >ver todas</a></span></td>
          </tr>
          
        </table>
  </div>
	
	<div class="banner_home2">
    <!--<a href="http://www.cefincorp.com" target="_blank"><img src="img/cefincorp1.jpg" width="940" height="100" border="0" /></a>-->
    <a href="index.php?webpage=22" ><img src="img/foro_isrl_h.jpg" width="940" height="100" border="0" /></a>
    </div>
    
  <div id="contenedor_noticias">
    	<div id="pestana"><span id="boton-prev"><a href="#"><<</a></span><h6>Actualidad Fiscal</h6>
            <span id="boton-next"><a href="#">>></a></span>
        </div>
        <div class="modulos">
        	<div id="titulo_noticia">Ahorra pagando el #ISLR
            </div>
            <div id="fecha_noticia">12/03/2013
            </div>
          <div id="contenido_noticia">Lamentamos el luto que vive el país por motivo de la desaparición física del Presidente de la Republica Bolivariana de Venezuela...
          </div>
            <span class="boton_verde_i"><a href="index.php?webpage=10" target="_self">leer más</a></span>
    </div>
        <div class="modulos">
        	<div id="titulo_noticia">Entorno Tributario Venezolano 
            </div>
            <div id="fecha_noticia">12/03/2013
            </div>
          <div id="contenido_noticia">Se avecina el plazo para la declaración del #ISLR tanto de personas como de empresas, las cuales se denominan Naturales y Personas Jurídicas...
          </div>
            <span class="boton_verde_i"><a href="index.php?webpage=11" target="_self">leer más</a></span>
    </div>
         <div class="modulos">
        	<div id="titulo_noticia">FAOV, LOCTI, ONA y Deporte
            </div>
            <div id="fecha_noticia">12/03/2013
            </div>
          <div id="contenido_noticia">Se interpreta que la creación de nuevos tributos tiene la finalidad de generar recursos, bajo el espíritu de promover socialmente aquellos...
          </div>
            <span class="boton_verde_i"><a href="index.php?webpage=12" target="_self">leer más</a></span>
         </div>
         
        </div>
        
        <div id="twitter">
        <!--<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>-->
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
         <div id="banner3">
         	<center>
            <font face="Verdana, Geneva, sans-serif" size="+2" color="#00CC00"><b>Pago de ISLR</b></font>
            <br>
            <font face="Arial, Helvetica, sans-serif" size="2" ><b>Recauda tus impuestos On-Line</b></font>
            <br>
            <img src="img/alcaldia_islr.png" border="0">
            <br>
            <iframe frameborder="0" height="130px" width="250px" src="http://190.153.48.115/msBotonDePago/index.jsp?nbproveedor=ALCADIASOTILLO&ancho=190px" scrolling="no">
		 	</iframe>
            </center>
         </div>
         <div id="banner3">
         		<a href="javascript:getSUBID(12,0);" target="_self">
                <img src="img/banner_balance.png" width="300" height="224" border="0" />
                </a>
        </div>
        <div id="banner4">
        	<a href="http://www.asodeco.org" target="_blank">
        		<img src="img/banner_asodeco.png" width="300" height="360" border="0" />
        	</a>
        </div>
   <div id="separador">
</div>    
        

