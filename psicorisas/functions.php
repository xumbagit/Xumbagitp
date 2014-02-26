<?php
@session_start();
function striprif($cedrif){
	$cadena=trim($cedrif);
	$cadena=str_replace("-","",$cadena);
	$cadena=str_replace(".","",$cadena);
	$cadena=str_replace(" ","",$cadena);
	$cadena=strtoupper($cadena);
	$cadena=trim($cedrif);
	return $cadena; 
}

function rmBOM($str=""){
    if(substr($str,0,3) == pack("CCC",0xef,0xbb,0xbf)){
		$str=substr($str,3);
    }
    return $str;
}

function getDiaSem($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	// 0->domingo	 | 6->sabado
	$diaresult= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
	$dias_semana=array("domingo","lunes","martes","miércoles" ,"jueves","viernes","sábado");
	$str_dia=strtoupper($dias_semana[$diaresult]);
	return $str_dia;
}

function getMesFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	// 1->enero	 | 12->diciembre
	$diaresult= date("n",mktime(0, 0, 0, $mes, $dia, $ano));
	$dias_semana=array("ene","feb","mar","abr" ,"may","jun","jul","ago","sep","oct","nov","dic");
	$str_dia=strtoupper($dias_semana[($diaresult-1)]);
	return $str_dia;
}


function getMesSolo($fecha){
	$mes=$fecha;
	$dias_semana=array("ENERO","FEBRERO","MARZO","ABRIL" ,"MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$str_dia=strtoupper($dias_semana[($mes-1)]);
	return $str_dia;
}

function getMesFechaNumStr($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	// 1->enero	 | 12->diciembre
	$dias_semana=array("ENERO","FEBRERO","MARZO","ABRIL" ,"MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	$str_dia=strtoupper($dias_semana[($mes-1)]);
	return $str_dia;
}

function getMesFechaNum($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	return $mes;
}

function getDiaFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	return $dia;
}

function getAnioFecha($fecha){
	$arrfecha=explode("-",$fecha);
	$ano=$arrfecha[0];
	$mes=$arrfecha[1];
	$dia=$arrfecha[2];
	return $ano;
}

function getheader(){
	?>
		<meta charset="UTF-8">
		<title> PSICO RISAS - ASESORIA MOTIVACIONAL Y TERAPÉUTICA -</title>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/footer.css" rel="stylesheet" type="text/css">
		<link href="css/detalle.css" rel="stylesheet" type="text/css">
		<link href="css/form.css" rel="stylesheet" type="text/css">
		<link href="css/contacto.css" rel="stylesheet" type="text/css">
		<link href="css/statics.css" rel="stylesheet" type="text/css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
	<?php
}

function getfooter(){
	?>
        <div class="nav_footer">
            <ul class="nav">
                <li class="nav_btn" onclick="location.href='index.php';">HOME</li>
                <li class="nav_btn" onclick="location.href='?idweb=qsomos';">QUIENES SOMOS</li>
                <li class="nav_btn" onclick="location.href='?idweb=aterapeutica';">ASESORÍA TERAPÉUTICA</li>
                <li class="nav_btn" onclick="location.href='?programacion=true';">TALLERES, SEMINARIOS, CONFERENCIAS</li>
                <li class="nav_btn" onclick="location.href='?idweb=contacto';">CLUB</li>
                <li class="nav_btn" onclick="location.href='?idweb=contacto';">CONTACTO</li>
            </ul>
        </div>
        <div class="content_credits">
            <div class="credits"> 
            	® Todos los Derechos Reservados, Psico Risas Canadá •  Diseño y Desarrollo por <a href="http://www.xumbadevenezuela.com" target="_blank"><div class="logo_xumba"></div></a>
			</div>
            </div>
        </div>
	<?php
}
function getMenu(){
	session_start();
	?>
	    <div class="header">
	    	<a href="index.php">
	    		<div class="logo"></div>
	    	</a>
	        <div class="content_nav">
	            <ul class="nav">
	                <li class="nav_btn" onclick="location.href='?idweb=qsomos';">QUIENES<br/>SOMOS
	                    <div class="icon" id="i1"></div>
	                </li>
	                <li class="dot"></li>
	                <li class="nav_btn" onclick="location.href='?idweb=aterapeutica';">ASESORIA<br/> TERAPÉUTICA
	                    <div class="icon" id="i2"></div>
	                </li>
	                <li class="dot"></li>
	                <li class="nav_btn" onclick="location.href='?programacion=true';">PROGRAMACIÓN <br />TALLERES, SEMINARIOS
	                    <div class="icon" id="i3"></div>
	                </li>
	                <li class="dot"></li>
	                <li class="nav_btn" onclick="location.href='?idweb=contacto';">CONTACTO
	                    <div class="icon" id="i4"></div>
	                </li>
	            </ul>
	        </div>
	    </div>
	<?php
}

function getCSSAcce(){
	?>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/collections2.css" rel="stylesheet" type="text/css">
		<link href="css/collections_detalles.css" rel="stylesheet" type="text/css">
	<?php
}
function getCSSCol(){
	?>
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/collections2.css" media="screen" />
		<link rel="stylesheet" href="css/collections_detalles.css" type="text/css" media="screen" />
	<?php
}

function getFavIcon(){
	?>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon2.png">
	<?php
}

function getDOCTYPE(){
	?>
		<!DOCTYPE hmtl>
	<?php
}

function getTitle($titulo){
	?>
		<title><?php echo($titulo); ?></title>
	<?php
}

function getJquery(){
	?>
    	<script type="text/javascript" src="libs/jquery-1.10.1.min.js"></script>
	<?php
}

function getRedesSoc(){
	?>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<?php
}

function getFunctionsJqueryMenu(){
	?>
	<script type="text/javascript">
		//Abrir colapsar
		jQuery(document).ready(function(){
		  jQuery("#submenuCollection").hide();
		  //toggle the componenet with class msg_body
		  jQuery("#ClickCollection").click(function(e){
		  	e.preventDefault();
		    jQuery(this).next("#submenuCollection").slideToggle(150);
		  });
		});
	</script>
	<?php
}


function getFunctionsJquery(){
	?>
	<script type="text/javascript">
		$(function() {
		    $('#slideshow').cycle({
		    	fx:      	'fade',
		        pager:      '#nav',
			    slideResize: true,
			    containerResize: false,
			    width: '100%',
			    fit: 1,
		        pagerAnchorBuilder: buildPagerBox
		    });
		    
		    function buildPagerBox(i, el) {
		        // you can return whatever markup you want for the pager
		        return '<a href="#" class="box"></a>';
		    }
		});

		$(function() {
    		var video;
			$("#slideshow").hide();
			$("#nav").hide();
			$("#fotosdespues").show();
    		video = document.getElementById('videoOscar');
    		/*
    		 	OTRA ALTERNATIVA
    		 *   $("#myVideoTag").bind('ended', function(){
        			alert("All done, function!");
  				});
    		 * 
    		 * */
		    $('#videoOscar').bind('ended', function () {
		        $('#videoOscar').unbind('ended');
				$("#fotosdespues").delay(350).fadeOut(800);
				$("#slideshow").delay(500).fadeIn(800);
				$("#nav").delay(500).fadeIn(800);
		    });
		});
		
		function crearSlide(){
			$(function() {
			    $('#fotosdespues').cycle({
			    	fx:      	'fade',
				    slideResize: true,
				    containerResize: false,
				    delay: 5000
			    });
			});				
		}
		
		setTimeout(crearSlide(),61000);
	</script>
	<?php
}

function showSlides(){
	/*
 			<video autoplay preload="metadata" id="videoOscar" class="videohome" height="360" width="640" style="width:auto; min-height:500px; max-height:100%; display:block;margin:0 auto;z-index: 50;float:none;">
		        <source style="width:100%; height:auto; display:block;" src="img/video_oscar.mp4" type="video/mp4"/>
		        <source style="width:100%; height:auto; display:block;" src="img/video_oscar.webm" type="video/webm"/>
		        <source style="width:100%; height:auto; display:block;" src="img/video_oscar.ogv" type="video/ogg"/>
			  	Your browser does not support the video tag.
			</video>
	 * */
	?>
	<div style="position: relative;width:1198px;margin: 0 auto; min-height:500px; max-height:100%;top:150px;float:none;">
		<div id="fotosdespues" class="content_videohome2" style="width:auto;display:block;margin-right:auto;margin-left:auto;z-index: 50;"></div>
	</div>
			<script type='text/javascript' src='libs/jQuery.tubeplayer.min.js'></script>
			<script type="text/javascript" language="JavaScript">
				jQuery("#fotosdespues").tubeplayer({
					allowFullScreen: "false", // true by default, allow user to go full screen
					autoPlay: "true", // true by default, allow user to go full screen
					initialVideo: "-OJlRNSYwIA", // the video that is loaded into the player
					preferredQuality: "default",// preferred quality: default, small, medium, large, hd720
					showinfo: false, // if you want the player to include details about the video
					modestbranding: true, // specify to include/exclude the YouTube watermark
					showControls: 0, // whether the player should have the controls visible, 0 or 1
					showRelated: 0, // show the related videos when the player ends, 0 or 1 
					autoHide: true, 
					onPlay: function(id){}, // after the play method is called
					onPause: function(){}, // after the pause method is called
					onStop: function(){}, // after the player is stopped
					onSeek: function(time){}, // after the video has been seeked to a defined point
					onMute: function(){}, // after the player is muted
					onPlayerEnded: function(){
						$("#fotosdespues").delay(350).fadeOut(800);
						$("#slideshow").delay(500).fadeIn(800);
						$("#nav").delay(500).fadeIn(800);
					},
					onUnMute: function(){} // after the player is unmuted
				});
			</script>
			<!-- COLOCAR VIDEO EN HTML5 !-->
			<!-- ------  			<object style="width:1440px; min-height:500px; max-height:100%; display:block;margin:0 auto;z-index: 50;float:none;"><param name="movie" value="http://www.youtube.com/v/7IyEbBBkeHc?hl=es_ES&amp;version=3&controls=0&autoplay=1&autohide=1&showinfo=0&modestbranding=1&theme=light"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed style="position: relative;margin: 0 auto;width:1440px;" src="http://www.youtube.com/v/7IyEbBBkeHc?hl=es_ES&amp;version=3&controls=0&autoplay=1&autohide=1&showinfo=0&modestbranding=1&theme=light" type="application/x-shockwave-flash" width="1440" height="810" allowscriptaccess="always" allowfullscreen="true"></embed></object>  --------------- !-->
    	<div id="nav" style="display:none;top:200px;"></div>
		<div id="slideshow" style="display:none;top:-350px;">
			<img style="width:1440px;height:auto;position: relative;margin: 0 auto;" src="img/img01.jpg" />
			<img style="width:1440px;height:auto;position: relative;margin: 0 auto;" src="img/img02.jpg" />
			<img style="width:1440px;height:auto;position: relative;margin: 0 auto;" src="img/img03.jpg" />
			<img style="width:1440px;height:auto;position: relative;margin: 0 auto;" src="img/img04.jpg" />
			<img style="width:1440px;height:auto;position: relative;margin: 0 auto;" src="img/img05.jpg" />
		</div>
	<?php
}

function getAjax(){
	?>
		<script type="text/javascript" src="libs/ajax.js"></script>
		<script type="text/javascript" src="libs/lib.js"></script>
	<?php
}

function getLibsOthers(){
	?>
	    <script src="libs/jquery.cycle.all.js" type="text/javascript"></script>
		<script src="libs/jquery-ui-1.10.3.custom.js"></script>
		<script src="libs/jquery.colorbox.js"></script>
		<script src="libs/vendor.js"></script>
		<script src="libs/si.files.js" type="text/javascript"></script>
	<?php
}

function getCSS(){
	?>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" media="screen" />
		<link rel="stylesheet" href="css/vendor.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen" />
		<?php
			if($_GET['idweb']==''){
				?>
					<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
				<?php
			}
		?>
		<link rel="stylesheet" href="css/cycle.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/content.css" type="text/css" media="screen" />
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
	<?php
}

function getCSSCole(){
			if($_GET['idweb']==''){
				?>
					<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
				<?php
			}
		?>
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/content.css" type="text/css" media="screen" />
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/collections2.css" rel="stylesheet" type="text/css">
		<link href="css/collections_detalles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
	<?php
}

function getCSSCole2(){
			if($_GET['idweb']==''){
				?>
					<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
				<?php
			}
		?>
			<link href="css/header.css" rel="stylesheet" type="text/css">
			<link href="css/content.css" rel="stylesheet" type="text/css">
			<link href="css/pruebas.css" rel="stylesheet" type="text/css">
			<link href="css/blog.css" rel="stylesheet" type="text/css">
			<link href="css/collections.css" rel="stylesheet" type="text/css">
			<link href="css/collections_detalles.css" rel="stylesheet" type="text/css">
			<link href="css/collections_detalles2.css" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
	<?php
}

function getCSSContact(){
	?>
	<link href="css/header.css" rel="stylesheet" type="text/css">
	<link href="css/content.css" rel="stylesheet" type="text/css">
	<link href="css/blog.css" rel="stylesheet" type="text/css">
	<link href="css/pruebas.css" rel="stylesheet" type="text/css">
	<link href="css/contact.css" rel="stylesheet" type="text/css">
	<link href="css/collections2.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/colorbox1.css" type="text/css" media="screen" />
	<?php
}

function getCSSBlog(){
	?>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" media="screen" />
		<link rel="stylesheet" href="css/vendor.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/cycle.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/content.css" type="text/css" media="screen" />
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen" />
	<?php
}

function getPreloaderComplete(){
	?>
		<script src="libs/jpreloader.js"></script>
		<link rel="stylesheet" href="css/jpreloader.css" type="text/css" media="screen" />
	<?php	
	getJpreloader();
}

function getCSSBio(){
	?>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/collections2.css" rel="stylesheet" type="text/css">
		<link href="css/collections_detalles.css" rel="stylesheet" type="text/css">
		<link href="css/bio5.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<?php
}

function getPreloaderComplete_bio(){
	?>
		<script src="libs/jpreloader.js"></script>
<link href="css/bio5.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/jpreloader1.css" type="text/css" media="screen" />
	<?php	
	getJpreloader_bio();
}

function getJpreloader_bio(){
?>
	<script>
	var timer_bio;
	var controles;
	$(document).ready( function() {
		var timer;	//timer for splash screen
		var onComplete;
		
		onComplete=function(){
			mostrar_controles();
			mostrar_slides();
			timer_bio=setInterval("mostrar_slides()", 15000);
		}
		//navigation swap
		$('#navigation a').on('click', function() {
			if( !$(this).hasClass('btn-main') ) {
				$('#navigation a')
				.toggleClass('btn-secondary')
				.toggleClass('btn-main');
				
				var tar = $(this).attr('href');
				$('.holder').fadeOut(500, function() {
					$(tar).fadeIn(500);
				});
			}
			return false;
		});
		$('#set2').hide();
		$('#header').css('top', '-100px');
		$('#footer').css('bottom', '-100px');
		$('#wrapper').hide();
	
		
		//calling jPreLoader
		$('body').jpreLoader({
			showSplash: true,
			splashID: "#jSplash",
			loaderVPos: '75%',
			autoClose: true,
			closeBtnText: "Entrar",
			splashFunction: function() {  
				//passing Splash Screen script to jPreLoader
				$('#jSplash').children('section').not('.selected').hide();
				$('#jSplash').hide().fadeIn(800);
				
				timer = setInterval(function() {
					splashRotator();
				}, 4000);
			}
		}, function() {	//callback function
			clearInterval(timer);
			$('#footer')
			.animate({"bottom":0}, 500);
			$('#header')
			.animate({"top":0}, 800, function() {
				$('#wrapper').fadeIn(1000);
			});
			onComplete();
		});
		
		//create splash screen animation
		function splashRotator(){
			var cur = $('#jSplash').children('.selected');
			var next = $(cur).next();
			
			if($(next).length != 0) {
				$(next).addClass('selected');
			} else {
				$('#jSplash').children('section:first-child').addClass('selected');
				next = $('#jSplash').children('section:first-child');
			}
				
			$(cur).removeClass('selected').fadeOut(800, function() {
				$(next).fadeIn(800);
			});
		}
	});
	</script>
	<section id="jSplash">
		<section class="selected">
	   		<div class="content_cover_bio">
	            <div class="content_loader">
					<img style="margin-top: -250px;width:243px;height:255px;" width="345" alt="" src="img/bio/logo-oc2.png">
	                <div class="separador6"></div>
	                <div class="frase2"></div>
	            </div>
	        </div>
		</section>
	</section>
<?php
}
function getHeaderBio(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	if($_GET['idweb']==''){
		getFunctionsJquery();
	}
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSSBio();
	}
	?>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
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
		</script>
	<?php
}

function getBlogCSS(){
	?>
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/pagination.css" rel="stylesheet" type="text/css">
	<?php
}

function getLineaHeader(){
	echo("style=\"background-image:url(img/blog/bg_linea.jpg);\"");
}

function getHeaderHome(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	getFunctionsJquery();
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSS();
	}
	else{
		getCSSBlog();
	}
	
	if($_GET['idweb']=='collections' || $_GET['idweb']=='contact'){
		getCSSCol();
	}
}


function getHeaderAcce(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	getFunctionsJquery();
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSSAcce();
	}
}


function getHeaderContact(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	getCSSContact();
}

function getHeaderWrapper(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	if($_GET['idweb']==''){
		getFunctionsJquery();
	}
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSS();
	}
	else{
		getCSSBlog();
	}
	if($_GET['idweb']=='collections'){
		getCSSCol();
	}
}

function getHeaderWrapperCole(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	if($_GET['idweb']==''){
		getFunctionsJquery();
	}
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSSCole();
	}
}

function getHeaderWrapperCole2(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	if($_GET['idweb']==''){
		getFunctionsJquery();
	}
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSSCole2();
	}
}

function getHeaderWrapperVideo(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	if($_GET['idweb']==''){
		getFunctionsJquery();
	}
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	if($_GET['idweb']!='blog'){
		getCSSVideo();
	}
	?>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
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
		</script>
	<?php
}

function getCSSVideo(){
	?>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/video.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/vendor.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/colorbox2.css" type="text/css" media="screen" />
	<?php
}


function getCSSAppoinment(){
	?>
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
		<link href="../css/header.css" rel="stylesheet" type="text/css">
		<link href="../css/content.css" rel="stylesheet" type="text/css">
		<link href="../css/blog.css" rel="stylesheet" type="text/css">
		<link href="../css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="../css/contact.css" rel="stylesheet" type="text/css">
		<link href="../css/collections2.css" rel="stylesheet" type="text/css">
		<link href="../css/emergente.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<?php
}

function getCSSArtwork(){
	?>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
		<link href="css/collections2.css" rel="stylesheet" type="text/css">
		<link href="css/collections_detalles.css" rel="stylesheet" type="text/css">
	<?php
}

function getHeaderArtwork(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	getLibsOthers();
	getRedesSoc();
	getFavIcon();
	getCSSArtwork();
}


function getHeaderAppoinment(){
	getTitle("OSCAR CARVALLO PARIS");
	getFavIcon();
	getCSSAppoinment();
}

function getMenuCategBlog(){
	session_start();
	if($_SESSION['lang']=="es"){
		?>
			<ul class="menu_categoria">
	        <span class="titulo"><h4>CATEGORIAS</h4></span>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=PRESS">PRENSA</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=EVENTS">EVENTOS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=RECENT.NEWS">NOTICIAS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=BACKSTAGE">BACKSTAGE</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=INSPIRATION">INSPIRATION</a></span></li>
	        </ul>
		<?php
	}
	elseif($_SESSION['lang']=="fr"){
		?>
			<ul class="menu_categoria">
	        <span class="titulo"><h4>CATÉGORIES</h4></span>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=PRESS">PRESSE</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=EVENTS">ÉVÉNEMENTS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=RECENT.NEWS">NOUVELLES</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=BACKSTAGE">BACKSTAGE</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=INSPIRATION">INSPIRATION</a></span></li>
	        </ul>
		<?php
	}
	else{
		?>
			<ul class="menu_categoria">
	        <span class="titulo"><h4>CATEGORIES</h4></span>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=PRESS">PRESS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=EVENTS">EVENTS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=RECENT.NEWS">RECENT NEWS</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=BACKSTAGE">BACKSTAGE</a></span></li>
	        <li><span class="boton_categoria"><a href="index.php?idweb=blog&t=dm&tiponoticia=INSPIRATION">INSPIRATION</a></span></li>
	        </ul>
		<?php
	}
}

function getRedesButtons($conexion){
	$urlmedia=$media; 

	$sql="SELECT * FROM noticias WHERE ID='".$_GET['iddetalle']."'";
	$pedido=mysql_query($sql,$conexion);
	echo(mysql_error());
	if($pedido){
		$filas=mysql_num_rows($pedido);
		if($filas>0){
			$datos=mysql_fetch_array($pedido);
			$fechart=$datos['fechacons'];
			$titulo_redes=$datos['titulo'];
			$cuerpo=$datos['cuerpo'];
			$IDnoticiaMenu=$datos['ID'];
			$categoria=$datos['tipo'];
			$imagenportada="admin/".$datos['fotodir'];
			$caducado=$datos['caducado'];
			if($caducado!='true'){
				$caducadostr="&caducado=false";
			}
			else{
				$caducadostr="&caducado=true";
			}
			$enlacearticuloppal="?getdetalle=true&iddetalle=".$IDnoticiaMenu.$caducadostr;
		}
	}
?>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
    <meta name="Title" content="<?php echo($titulo_redes); ?>"  />
    <meta name="og:title" content="<?php echo($titulo_redes); ?>" />
    <meta name="description" content="<?php echo(strip_tags($cuerpo)); ?>"/>
    <meta name="og:description" content="<?php echo(strip_tags($cuerpo)); ?>" />
    <div class="share_area">
			<table style="display:block;margin-top: -5px;margin-bottom: 20px;">
				<tr>
					<td style="width: 100px;">
						<a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Compartir</a>
					</td>
					<td style="width: 2px;">
						
					</td>
					<td style="width: 45px;">
						    <a href="https://twitter.com/share" class="twitter-share-button" data-related="psicorisas" data-lang="en" data-size="medium" data-count="horizontal" data-text="<?php echo(strip_tags($titulo_redes)); ?>" data-url="<?php echo("http://xumbadevenezuela.com/entorno_prueba_psicorisas/".$enlacearticuloppal); ?>">Tweet</a>
    						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</td>
				</tr>
			</table>
    </div>
	<?php
}

function getJpreloader(){
?>
	<script>
	$(document).ready( function() {
		var timer;	//timer for splash screen
		
		//navigation swap
		$('#navigation a').on('click', function() {
			if( !$(this).hasClass('btn-main') ) {
				$('#navigation a')
				.toggleClass('btn-secondary')
				.toggleClass('btn-main');
				
				var tar = $(this).attr('href');
				$('.holder').fadeOut(500, function() {
					$(tar).fadeIn(500);
				});
			}
			return false;
		});
		$('#set2').hide();
		$('#header').css('top', '-100px');
		$('#footer').css('bottom', '-100px');
		$('#wrapper').hide();
	
		
		//calling jPreLoader
		$('body').jpreLoader({
			showSplash: true,
			splashID: "#jSplash",
			loaderVPos: '75%',
			autoClose: true,
			closeBtnText: "Entrar",
			splashFunction: function() {  
				//passing Splash Screen script to jPreLoader
				$('#jSplash').children('section').not('.selected').hide();
				$('#jSplash').hide().fadeIn(800);
				
				timer = setInterval(function() {
					splashRotator();
				}, 4000);
			}
		}, function() {	//callback function
			clearInterval(timer);
			$('#footer')
			.animate({"bottom":0}, 500);
			$('#header')
			.animate({"top":0}, 800, function() {
				$('#wrapper').fadeIn(1000);
			});
		});
		
		//create splash screen animation
		function splashRotator(){
			var cur = $('#jSplash').children('.selected');
			var next = $(cur).next();
			
			if($(next).length != 0) {
				$(next).addClass('selected');
			} else {
				$('#jSplash').children('section:first-child').addClass('selected');
				next = $('#jSplash').children('section:first-child');
			}
				
			$(cur).removeClass('selected').fadeOut(800, function() {
				$(next).fadeIn(800);
			});
		}
	});
	</script>
	<section id="jSplash">
		<section class="selected" style="margin-top: -200px;">
			<img width="345" alt="" src="img/logo.png">
		</section>
	</section>
<?php
}

function get_blogfooter(){
	?>
		<div class="blog-footer">
		</div>
	<?php
}

function get_nav_cover(){
	?>
	<script type="text/javascript" language="JavaScript">
		$(function() {
			//Slideshow de los covers
			var contc;
			var contdiv;
			var nomdiv;
			var contcd;
			var colecnom;
			var maxslides;
			var minslides;
			var tiposlides;
			minslides=0;
			contc=0;
			contcd=0;
			contdiv=0;
			colecnom=gup('tipocol');
			tiposlides=gup('showslideart');
			
			if(tiposlides=="true"){
				maxslides=5;
			}
			else{
				maxslides=7;
			}
			//COLECCIONES
			if(colecnom=="eagleye"){
				contc=0;
			}
			if(colecnom=="fishwoman"){
				contc=1;
			}
			if(colecnom=="palaisroyal"){
				contc=2;
			}
			if(colecnom=="sinnombre"){
				contc=3;
			}
			if(colecnom=="metalnature"){
				contc=4;
			}
			if(colecnom=="neptuna"){
				contc=5;
			}
			if(colecnom=="marcaribe"){
				contc=6;
			}
			if(colecnom=="thepeacockfeather"){
				contc=7;
			}
			//ARTWORK
			if(colecnom=="cruzdiez"){
				contc=0;
			}
			if(colecnom=="chicchica"){
				contc=1;
			}
			if(colecnom=="bic"){
				contc=2;
			}
			if(colecnom=="yasminhamdamsamar"){
				contc=3;
			}
			if(colecnom=="toys"){
				contc=4;
			}
			if(colecnom=="swarovski"){
				contc=5;
			}
			if(contc==0){
				$("#flechaeste").fadeOut(300);
			}
			if(contc==maxslides){
				$("#flechaoeste").fadeOut(300);
			}
			nomdiv="SLIDE_" + contc;
			$("#cover_prev").click(function(e) {
				e.preventDefault();
				if(contc==0){
					contc=maxslides;
					//alert(contc);
					nomaslide="#SLIDE_" + (contc-1);
					nomnslide="#SLIDE_" + minslides;
					$(nomnslide).fadeOut(300);
					$(nomaslide).delay(400).fadeIn(300);
					$("#flechaeste").fadeIn(300);
				}
				else{
					if(contc==1){
						$("#flechaoeste").show();
						$("#flechaeste").hide();
					}
					nomaslide="#SLIDE_" + (contc-1);
					nomnslide="#SLIDE_" + contc;
					$(nomnslide).toggle("slide");
					$(nomaslide).delay(400).fadeIn(300);
					--contc;
				}
			 });
			$("#cover_next").click(function(e) {
				e.preventDefault();
				if(contc==maxslides){
					contc=0;
					nomaslide="#SLIDE_" + contc;
					nomnslide="#SLIDE_" + (contc+1);
					$(nomaslide).fadeOut(300);
					$(nomnslide).delay(400).fadeIn(300);
					$("#flechaoeste").fadeOut(300);
				}
				else{
					if(contc==(maxslides-1)){
						$("#flechaoeste").hide();
						$("#flechaeste").show();
					}
					nomaslide="#SLIDE_" + contc;
					nomnslide="#SLIDE_" + (contc+1);
					$(nomaslide).toggle("slide");
					$(nomnslide).delay(400).fadeIn(300);
					++contc;
				}
			 });
		});
	</script>
		<div class="navigation" style="z-index:2000; resize:vertical; float:none; position:fixed; margin-top:-170px; top:50%;">
			<div id="flechaeste" class="div_flecha_e-">
			<a id="cover_prev" class="flecha_e" href="#"><img class="flecha_e-" src="img/fecha_e.png" width="64" height="29" border="0" /></a>
			</div>
			<div id="flechaoeste" class="div_flecha_o-">
			<a id="cover_next" class="flecha_o-" href="#"><img class="flecha_o-" src="img/fecha_o.png" width="64" height="29" border="0" /></a>
			</div>
		</div>
	<?php
}

function get_nav_bio(){
	?>
		<script type="text/javascript" language="JavaScript">
			//Slideshow de los covers
			var contc;
			var contdiv;
			var nomdiv;
			var contcd;
			var colecnom;
			var maxslides;
			var minslides;
			var tiposlides;
			minslides=0;
			contc=-1;
			contcd=0;
			contdiv=0;
			maxslides=28;
			nomdiv="SLIDE_" + contc;
			
			function mostrar_slides(){
				$(function(){
					if(contc==0){
						$("#cover_prev").hide();
					}
					else{
						$("#cover_prev").show();
					}
					if(contc==maxslides){
						contc=0;
						nomaslide="#SLIDE_" + maxslides;
						nomnslide="#SLIDE_" + (contc);
						$(nomaslide).fadeOut(300);
						$(nomnslide).delay(300).fadeIn(300);
					}
					else{
						nomaslide="#SLIDE_" + contc;
						nomnslide="#SLIDE_" + (contc+1);
						$(nomaslide).fadeOut(150);
						if(contc==-1){
							//$(nomnslide).show();
						}
						else{
							$(nomnslide).delay(150).fadeIn(300);
						}
						++contc;
					}
				});
			}
			
			function mostrar_controles(){
				$(function(){
					$("#cover_prev").click(function(e) {
						e.preventDefault();
						clearInterval(timer_bio);
						timer_bio=setInterval("mostrar_slides()", 15000);
						if(contc==0){
							contc=maxslides;
							//alert(contc);
							nomaslide="#SLIDE_" + maxslides;
							nomnslide="#SLIDE_" + 0;
							$(nomnslide).fadeOut(300);
							$(nomaslide).delay(300).fadeIn(300);
						}
						else{
							nomaslide="#SLIDE_" + (contc-1);
							nomnslide="#SLIDE_" + contc;
							$(nomnslide).fadeOut(300);
							$(nomaslide).delay(300).fadeIn(300);
							--contc;
						}
					 });
					$("#cover_next").click(function(e) {
						e.preventDefault();
						clearInterval(timer_bio);
						timer_bio=setInterval("mostrar_slides()", 15000);
						if(contc==maxslides){
							contc=0;
							nomaslide="#SLIDE_" + maxslides;
							nomnslide="#SLIDE_" + (contc);
							$(nomaslide).fadeOut(300);
							$(nomnslide).delay(300).fadeIn(300);
						}
						else{
							nomaslide="#SLIDE_" + contc;
							nomnslide="#SLIDE_" + (contc+1);
							$(nomaslide).fadeOut(300);
							$(nomnslide).delay(300).fadeIn(300);
							++contc;
						}
					 });
				});
			}
		</script>
		<div class="navigation" style="z-index:2000; resize:vertical; float:none; position:fixed;top:19%;">
			<div id="flechaeste" class="div_flecha_e-">
			<a id="cover_prev" class="flecha_e" href="#" style="background: #666;"><img class="flecha_e-" src="img/fecha_e.png" width="64" height="29" border="0" /></a>
			</div>
			<div id="flechaoeste" class="div_flecha_o-">
			<a id="cover_next" class="flecha_o-" href="#" style="background: #666;"><img class="flecha_o-" src="img/fecha_o.png" width="64" height="29" border="0" /></a>
			</div>
		</div>
	<?php
}

function get_nav(){
	?>
		<div class="navigation" style="z-index:2000; resize:vertical; float:none; position:fixed; margin-top:-170px; top:50%;">
			<div class="div_flecha_e-">
			<a id="prev" class="flecha_e" href="#"><img class="flecha_e-" src="img/fecha_e.png" width="64" height="29" border="0" /></a>
			</div>
			<div class="div_flecha_o-">
			<a id="next" class="flecha_o-" href="#"><img class="flecha_o-" src="img/fecha_o.png" width="64" height="29" border="0" /></a>
			</div>
		</div>
	<?php
}

function get_share(){
	?>
		<a href="<?php echo("mods/appoinment.php?tipocol=".$_GET['tipocol']."&detalle=".$_GET['detalle']."&indice=".$_GET['indice']); ?>" class="group1">SCHEDULE AN APPOINTMENT</a>
	<?php
}

function the_permalink(){
	$permalink="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $permalink; 
}

function get_header(){
	?>
		<meta charset="UTF-8">
		<title> PSICO RISAS - ASESORIA MOTIVACIONAL Y TERAPÉUTICA -</title>
		<link href="css/header.css" rel="stylesheet" type="text/css">
		<link href="css/content.css" rel="stylesheet" type="text/css">
		<link href="css/footer.css" rel="stylesheet" type="text/css">
	<?php
}
?>