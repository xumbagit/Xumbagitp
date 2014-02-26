<?php
	if($_GET['mod']==''){
	?>
		<!DOCTYPE html>
		<html>
		<head>
		<?php
			getheader();
			if($_GET['mod']==''){
				getPreloaderComplete();
			}
		?>
	<script type="text/javascript">
	    $(document).ready(function () {
	        $('#fotoshome').cycle({
	            fx: 'fade',
	            timeout: 100,
	            slideResize: true,
				containerResize: false,
				width: '100%',
				fit: 1
	        });
	    });
	</script>
		<script type="text/javascript">
		    $(document).ready(function () {
		        $('#banner_content_slide').cycle({
		            fx: 'fade',
		            timeout: 3000,
		            slideResize: true,
					containerResize: false,
					width: '100%',
					fit: 1, 
		            pager:  '#slidelist_nav',
				    // callback fn that creates a thumbnail to use as pager anchor 
				    pagerAnchorBuilder: function(idx, slide) { 
				        return "<li></li>"; 
				    } 
		        });
		    });
		</script>
		</head>
		<body class="<?php echo($_SESSION['estilo']); ?>">
		<?php
			getMenu($conexion);
			getSocialArea();
		?>
		    <div id="banner_content_slide" class="slide_show">
		        <div id="s1" class="slide" style="width:100%;height:auto;">
		            <img src="img/slide1.jpg" border="0"/>
		        </div>
		        <div id="s2" class="slide" style="width:100%;height:auto;">
		        	<img src="img/slide2.jpg" border="0"/>
		        </div>
		        <div id="s3" class="slide" style="width:100%;height:auto;">
		        	<img src="img/slide3.jpg" border="0"/>
		        </div>
		        <div id="s4" class="slide" style="width:100%;height:auto;">
		        	<img src="img/slide1.jpg" border="0"/>
		        </div>
		        <div id="s5" class="slide" style="width:100%;height:auto;">
		        	<img src="img/slide2.jpg" border="0"/>
		        </div>
		    </div>
		    <div class="nav_slide dark">
		        <ul id="slidelist_nav" class="slide_list"></ul>
		    </div>
			<div class="content_home">
				<div class="content_modules">
			        <div class="sep"></div>
		        	<?php
		        		getThumbnailNotice($conexion);
		        		getpublicidad($conexion);
		        	?>
		        </div>
		    </div>
		</div>
		
		<!--END CONTENT-->
		<?php
			getfooter();
		?>
		</body>
		</html>
	<?php
	}
	else{
		$nombremod="mods/".$_GET['mod'].".php";
		include($nombremod);
	}
?>